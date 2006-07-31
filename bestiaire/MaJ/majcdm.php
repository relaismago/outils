<?PHP
/******************************************************************************
*                                                                             *
* majcdm - fichier pour gérer les maj des cdms existantes                     *
* Copyright (C) 2004  Cormyr (cormyr@cat-the-psion.net)                       *
*                                                                             *
* This program is free software; you can redistribute it and/or               *
* modify it under the terms of the GNU General Public License                 *
* as published by the Free Software Foundation; either version 2              *
* of the License, or (at your option) any later version.                      *
*                                                                             *
* This program is distributed in the hope that it will be useful,             *
* but WITHOUT ANY WARRANTY; without even the implied warranty of              *
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the               *
* GNU General Public License for more details.                                *
*                                                                             *
* You should have received a copy of the GNU General Public License           *
* along with this program; if not, write to the Free Software                 *
* Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA. *
*                                                                             *
*******************************************************************************/
include_once('../../inc_connect.php3');
include_once('../../inc_authent.php3');
include_once('../../head.php3');

if(isset($_POST['soumettre'])){
  require_once("parse_cdm.php");
  require_once("Libs/init_tabcdm.php");
  $cdmdef=array();
  $cdmdef['Nom']=$MonstreAge;
  $cdmdef['Race']=$Race;
  $cdmdef['Famille']=$Famille;
  $cdmdef['Niv']=$Niv;
  $cdmdef['PdV']=$PdV;
  $cdmdef['ATT']=$Att;
  $cdmdef['ESQ']=$Esq;
  $cdmdef['Degat']=$Deg;
  $cdmdef['Regen']=$Reg;
  $cdmdef['Armure']=$Arm;
  $cdmdef['Vue']=$Vue;
  $cdmdef['CapSpe']=$Cap;
  $cdmdef['Affecte']=$Aff;
  $cdmdef['source']=$Troll;
  $mlevel=$Niv;
}
else{
  require_once("Libs/init_racemonstre.php");
  if(count($cdm)==0){ // pas de cdm
    // on regarde si on a au moins le template standard comme val par défaut
    $sql="SELECT * FROM `cdms` WHERE `Nom`=\"$Monstre\" ORDER BY `cachet` DESC;";
    $query=mysql_query($sql);
    if(!$query) die("Echec de la requête :<br>$sql<br>");
    $cdmdef=mysql_fetch_array($query);
  }
  else{ // on prend la première comme valeur par défaut
    $cdmdef=$cdm[0];
  }
  // pour le niveau par défaut, on le fait si possible d'après le niveau standard
  // on calcule alors le niveau par rapport au niveau standard
  // on commmece par remplir le tableau des âges
  $tab_age=array();
  $sql="SELECT * FROM `ages` WHERE `Famille`=\"".$Famille."\" ORDER by `niveau` ASC;";
  $query=mysql_query($sql);
  while($ret=mysql_fetch_array($query)){
    $tab_age[$ret[1]]=$ret;
  }
  // on peut maintenant calculer l'âge standard de ce template
  $Niv=calculeagestd($MonstreAge,$tab_age);
  if($Niv!=0){ // si le niveau standard a bien été défini
    $cdmdef['Niv']=$Niv; // on le propose comme valeur par défaut
  }
  // pour les capspe et affecte, si rien alors aucun par défaut
  $cdmdef['source']="Autre";
}
if($cdmdef['CapSpe']=='') $cdmdef['CapSpe']="aucune";
if($cdmdef['Affecte']=='') $cdmdef['Affecte']="rien";



?>

<script language="JavaScript" src="Libs/functions.js"></script>
<script language="JavaScript">

function confirmCdM()
{
  var monstre=getVal(document.form_majcdm.MONSTRE);
  var age=getVal(document.form_majcdm.AGE);
  var nom=getVal(document.form_majcdm.NOM);
  var race=getVal(document.form_majcdm.RACE);
  var famille=getVal(document.form_majcdm.FAMILLE);
  var niv=getSelectVal(document.form_majcdm.NivCdm);
  var pdv=getSelectVal(document.form_majcdm.PdvCdm);
  var att=getSelectVal(document.form_majcdm.AttCdm);
  var esq=getSelectVal(document.form_majcdm.EsqCdm);
  var deg=getSelectVal(document.form_majcdm.DegCdm);
  var reg=getSelectVal(document.form_majcdm.RegCdm);
  var arm=getSelectVal(document.form_majcdm.ArmCdm);
  var vue=getSelectVal(document.form_majcdm.VueCdm);
  var dat=getVal(document.form_majcdm.DatCdm);
  var datesql=getVal(document.form_majcdm.DateSql);
  var src=getVal(document.form_majcdm.SrcCdm);
  var cap=getVal(document.form_majcdm.CapSpeCdm);
  var aff=getVal(document.form_majcdm.AffCdm);
  src=escape(src);
  cap=escape(cap);
  aff=escape(aff);
  var urlconfirm='confirmcdm.php?Monstre='+monstre+'&Age='+age+'&Nom='+nom+'&Race='+race+'&Famille='+famille+'&Niv='+niv+'&Pdv='+pdv+'&Att='+att+'&Esq='+esq+'&Deg='+deg+'&Reg='+reg+'&Arm='+arm+'&Vue='+vue+'&Date='+dat+'&DateSql='+datesql+'&Src='+src+'&Cap='+cap+'&Aff='+aff;
  document.form_majcdm.MLEVEL.value=datesql;
  //window.open(urlconfirm,"","width=600,height=380");
  location.href=urlconfirm;
}


// En cas de sélection du Race, redirection sur l'url avec affectation du
// paramètre Race
function RaceSelectMenu() // 
{
  var r=getSelectVal(document.form_majcdm.race_streum);
  document.form_majcdm.RACE.value=r;
  location.href='majcdm.php?Race='+r;
}
//
// Lors de la selection d'une famille, on récupère la valeur
function FamilleSelectMenu() // 
{
  var r=getSelectVal(document.form_race.famille_streum);
  document.form_race.Famille.value=r;
}
// En cas de sélection d'un monstre, récupération de la race et du monstre et
// redirection sur l'url avec affectation des paramètres Race et Monstre
function MonstreSelectMenu()
{
  var r=getSelectVal(document.form_majcdm.race_streum);
  document.form_majcdm.RACE.value=r;
  var m=getSelectVal(document.form_majcdm.name_streum);
  document.form_majcdm.MONSTRE.value=m;
  var a=getSelectVal(document.form_majcdm.age_streum);
  document.form_majcdm.AGE.value=a;
  location.href='majcdm.php?Race='+r+'&Monstre='+m+'&Age='+a;
}
// En cas de sélection d'un age, récupération de la race, du monstre, de l'âge et
// redirection sur l'url avec affectation des paramètres Race et Monstre et Age
function AgeSelectMenu()
{
  var r=getSelectVal(document.form_majcdm.race_streum);
  document.form_majcdm.RACE.value=r;
  var m=getSelectVal(document.form_majcdm.name_streum);
  document.form_majcdm.MONSTRE.value=m;
  var a=getSelectVal(document.form_majcdm.age_streum);
  var age=a.substr(a.indexOf('-')+2);
  document.form_majcdm.AGE.value=age;
  location.href='majcdm.php?Race='+r+'&Monstre='+m+'&Age='+age;
}

</script> 


<body bgcolor="#30395D" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" oncontextmenu="return false" ondragstart="return false" onselectstart="return false">
 <div align="center">
 <table width="800" border="0" cellspacing="1" bgcolor="#30395D">
   <form name="form_majcdm" method="GET">
   <tr> <!-- ligne contenant l\'image et une table pour les caracs principales -->
     <td>
       <table align="center">
   <caption>
     <p><font color="#FFFFFF" size="+1"><b><em>Ajout d'une Connaissance sur le monstre</em></b></font></p>
   </caption>
       <tr>
         <th width="200" height="200" >
           <img src="<?echo $image; ?>"  border="2" align="center" bgcolor="#30395D">
         </th>
       </tr>
       <tr align="center"><th>
         <table width=800><!-- les 3 lignes pour les 3 tables race/nom, carac et pxtron-->
           <tr align="center"><th>
             <input type="hidden" name="RACE"  value="<?echo $Race; ?>">
             <input type="hidden" name="MONSTRE"  value="<?echo $Monstre; ?>">
             <input type="hidden" name="AGE"  value="<?echo $Age; ?>">
             <input type="hidden" name="NOM"  value="<?echo $MonstreAge; ?>">
             <input type="hidden" name="FAMILLE"  value="<?echo $Famille; ?>">
             <input type="hidden" name="MLEVEL" value="<?echo $mlevel; ?>">
	     <input type="hidden" name="DateSql" VALUE='<? echo date("Y-m-d"); ?>'>
             <table width="800" align="center" border="0" cellspacing="1" bgcolor="#000000"> <!-- table race/nom -->
               <tr align="center">
	 	 <th colspan=5 bgcolor="#FFCC00"><? echo $MonstreAge; ?></th>
               </tr>
               <tr align="center">
                 <th align="center" width="180" bgcolor="#F75007"><font size="+1">Race</font></th>
                 <th align="center" width="180" bgcolor="#F75007"><font size="+1">Nom</font></th>
                 <th align="center" width="180" bgcolor="#F75007"><font size="+1">Âge</font></th>
                 <th align="center" width="180" bgcolor="#F75007"><font size="+1">Famille</font></th>
              	 <th width="80" bgcolor="#B7B7DB" rowspan=2>
                   <img src="<? print("Familles/".famille2gif($Famille));?>" alt="<? print($Famille);?>"/>
                 </th>
               </tr>
               <tr align="center">
                 <th bgcolor="#B7B7DB">
                 	 <SELECT name="race_streum" onChange="RaceSelectMenu();">
	       	   <? echo showListRaces($races,$Race); ?>
       	            </SELECT>
                 </th>
                 <th bgcolor="#B7B7DB">
                 	 <SELECT name="name_streum" onChange="MonstreSelectMenu()">
	       	   <? echo showListNames($Race,$Monstre); ?>
       	            </SELECT>
                 </th>
                 <th bgcolor="#B7B7DB">
                    <SELECT name="age_streum" onChange="AgeSelectMenu()">
                       <? echo showListAges($Race,$races[$Race]['genre'],$Monstre,$Famille,$Age); ?>
       	            </SELECT>
                 </th>
                 <th bgcolor="#B7B7DB">
	            <? echo $Famille; ?>
                 </th>
               </tr>
             </table></th>
           </tr><!-- fin première ligne - race/nom --> 
         </table>
         </th>
       </tr>
       </table>
     </td>
   </tr> <!-- fin de la partie supérieure contenant nom/race & caracs principales -->
         <!-- début de la seconde partie avec toutes les cdm -->
   <tr><th>  <!-- caracs physiques (cdm) -->
     <table width="950" border="0" cellspacing="1" bgcolor="#000000">
       <caption>
         <font color="#FFFFFF" size="+1"><b><em>Nouvelle CdM :</em></b></font>
       </caption>
       <tr align="center">
         <th align="center" width="80" bgcolor="#1AC611">Niv</th>
         <th align="center" width="80" bgcolor="#1AC611">PdV</th>
         <th align="center" width="80" bgcolor="#1AC611">Attaque</th>
         <th align="center" width="80" bgcolor="#1AC611">Esquive</th>
         <th align="center" width="80" bgcolor="#1AC611">Dégâts</th>
         <th align="center" width="80" bgcolor="#1AC611">Régen</th>
         <th align="center" width="80" bgcolor="#1AC611">Armure</th>
         <th align="center" width="80" bgcolor="#1AC611">Vue</th>
         <th align="center" width="100" bgcolor="#FF9966">Date</th>
         <th align="center" width="150" bgcolor="#FF9966">Source</th>
       </tr>
       <tr align="center">
         <th bgcolor="#B7B7DB">
            <SELECT name="NivCdm"><? echo options_value($tabniv,$cdmdef['Niv']); ?></SELECT></th>
         <th bgcolor="#B7B7DB">						    
            <SELECT name="PdvCdm"><? echo options_value($tabpdv,$cdmdef['PdV']); ?></SELECT></th>
         <th bgcolor="#B7B7DB">
            <SELECT name="AttCdm"><? echo options_value($tabcarac,$cdmdef['ATT']); ?></SELECT></th>
         <th bgcolor="#B7B7DB">
            <SELECT name="EsqCdm"><? echo options_value($tabcarac,$cdmdef['ESQ']); ?></SELECT></th>
         <th bgcolor="#B7B7DB">
            <SELECT name="DegCdm"><? echo options_value($tabcarac,$cdmdef['Degat']); ?></SELECT></th>
         <th bgcolor="#B7B7DB">
            <SELECT name="RegCdm"><? echo options_value($tabregen,$cdmdef['Regen']); ?></SELECT></th>
         <th bgcolor="#B7B7DB">
            <SELECT name="ArmCdm"><? echo options_value($tabcarac,$cdmdef['Armure']); ?></SELECT></th>
         <th bgcolor="#B7B7DB">
            <SELECT name="VueCdm"><? echo options_value($tabcarac,$cdmdef['Vue']); ?></SELECT></th>
         <th bgcolor="#B7B7DB">
	    <INPUT NAME="DatCdm" READONLY TYPE=TEXT VALUE='<? echo date("d/m/Y"); ?>' READONLY></INPUT></th>
	 <th bgcolor="#B7B7DB">
            <INPUT NAME="SrcCdm" TYPE='TEXT' VALUE="<? echo $cdmdef['source']; ?>"></INPUT></th>
     </table></th>
   </tr>
   <tr><th>
     <table width="950" border="0" cellspacing="1" bgcolor="#000000">
       <tr align="center">
         <th align="center" width="50%" bgcolor="#1AC611">Cap. Spéc.</th>
       </tr>
       <tr align="center">
         <th bgcolor="#B7B7DB"><INPUT NAME="CapSpeCdm" TYPE='TEXT' Size="64"
	     VALUE="<? echo $cdmdef['CapSpe']; ?>"></INPUT></th>
       </tr>
       <tr align="center">
         <th align="center" width="50%" bgcolor="#1AC611">Affecte</th>
       </tr>
       <tr align="center">
         <th bgcolor="#B7B7DB"><INPUT NAME="AffCdm" TYPE='TEXT' Size="128"
	     VALUE="<? echo $cdmdef['Affecte']; ?>"></INPUT></th>
       </tr>
     </table></th>
   </tr>
   <tr><th>&nbsp;</th></tr>
   <tr><th><INPUT TYPE=BUTTON OnClick="confirmCdM()" VALUE="ajout de la cdm"></INPUT></th></tr>
   <tr><th>&nbsp;</th></tr>
   <tr><th bgcolor="#B7B7DB"><font color="#444444" size="+2"><em>Données déjà connnues</em></font></th></tr>
   <tr>
     <th>
     <!--  ------------------------------------ -->
     <? print_cdm($cdm,FALSE); ?> <!-- on n\'affiche pas la première cdm -->
     <!--  ------------------------------------ -->
     </th>
   </tr>
   <tr><th>&nbsp;</th></tr>
   <tr><th>&nbsp;</th></tr>
   </table></td>
   </form>
 </table>
</div>
</body>
</html>
