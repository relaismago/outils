<?PHP
/******************************************************************************
*                                                                             *
* newcaracs - fichier pour entrer des caracs calculées                        *
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

require_once("../../inc_connect.php3");
require_once("../Libs/functions.php");
require_once("../Libs/init_functions.php");

/* Libs/init_racemonstre.php */
$tab = getInfoMonstre();
$Monstre = $tab[0];
$Race = $tab[1];
$races = $tab[2];
$Age = $tab[3];
$agebasic = $tab[4];
$Famille = $tab[5];
$image = $tab[6];

$MonstreAge=makeMonsterName($Monstre,$Age);

/*Libs/init_caracs.php*/
$tab = getCaracteristiques($MonstreAge,$Famille);
$mlevel = $tab[0];
$AttDLA = $tab[1];
$DurDLA = $tab[2];
$RM     = $tab[3];

if(strpos($mlevel,'-')){
  $mlevel=substr($mlevel,0,strpos($mlevel,'-'))+1;
}

$tablvl=array('?','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','44','45','46','47','48','49','50','51','52','53','54','55','56','57','58','59','60');



function levelselect($level,$tablvl)
{
  $option="";
  foreach($tablvl as $lvl){
    $option.="<option label=\"".$lvl."\" value=\"".$lvl;
    if($lvl==$level) $option.="\" selected >";
    else             $option.="\">";
    $option.=$lvl."</option>";
  }
  return $option;
}


?>

<script language="JavaScript" src="Libs/functions.js"></script>
<script language="JavaScript">
// En cas de sélection du Race, redirection sur l'url avec affectation du
// paramètre Race
function RaceSelectMenu() // 
{
  var r=getSelectVal(document.form_newcaracs.race_streum);
  document.form_newcaracs.RACE.value=r;
  location.href='newcaracs.php?Race='+r;
}
//
// Lors de la selection d'une famille, on récupère la valeur
function FamilleSelectMenu() // 
{
  var r=getSelectVal(document.form_newcaracs.famille_streum);
  document.form_newcaracs.Famille.value=r;
}
// En cas de sélection d'un monstre, récupération de la race et du monstre et
// redirection sur l'url avec affectation des paramètres Race et Monstre
function MonstreSelectMenu()
{
  var r=getSelectVal(document.form_newcaracs.race_streum);
  document.form_newcaracs.RACE.value=r;
  var m=getSelectVal(document.form_newcaracs.name_streum);
  document.form_newcaracs.TEMPLATE.value=m;
  var a=getSelectVal(document.form_newcaracs.age_streum);
  var age=a.substr(a.indexOf('-')+2);
  document.form_newcaracs.AGE.value=age;
  location.href='newcaracs.php?Race='+r+'&Monstre='+m+'&Age='+age;
}
// En cas de sélection d'un age, récupération de la race, du monstre, de l'âge et
// redirection sur l'url avec affectation des paramètres Race et Monstre et Age
function AgeSelectMenu()
{
  var r=getSelectVal(document.form_newcaracs.race_streum);
  document.form_newcaracs.RACE.value=r;
  var m=getSelectVal(document.form_newcaracs.name_streum);
  document.form_newcaracs.TEMPLATE.value=m;
  var a=getSelectVal(document.form_newcaracs.age_streum);
  var age=a.substr(a.indexOf('-')+2);
  document.form_newcaracs.AGE.value=age;
  location.href='newcaracs.php?Race='+r+'&Monstre='+m+'&Age='+age;
}

</script> 

<html>
<head>
<title>Nouvelles Caracs</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>


<body bgcolor="#30395D" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" oncontextmenu="return false" ondragstart="return false" onselectstart="return false">
 <div align="center">
 <table width="800" border="0" cellspacing="1" bgcolor="#30395D">
   <tr> <!-- ligne contenant l\'image et une table pour les caracs principales -->
     <td>
       <table align="center">
       <tr>
         <th width="200" height="200" >
           <img src="../<?echo $image; ?>" border="2" align="center" bgcolor="#30395D">
         </th>
       </tr>
       <tr align="center">
         <th>
           <form name="form_newcaracs" method="POST" action="confirmcaracs.php">
           <table width=800><!-- les 3 lignes pour les 3 tables race/nom, carac et pxtron-->
             <tr align="center"><th>
               <input type="hidden" name="RACE"  value="<?echo $Race; ?>">
               <input type="hidden" name="TEMPLATE"  value="<?echo $Monstre; ?>">
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
                	 <th width="180" bgcolor="#F75007"><font size="+1">Race</font></th>
                	 <th width="180" bgcolor="#F75007"><font size="+1">Nom</font></th>
                	 <th width="180" bgcolor="#F75007"><font size="+1">Âge</font></th>
                	 <th width="180" bgcolor="#F75007"><font size="+1">Famille</font></th>
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
       	     <tr><th>  <!-- début 1ère ligne - caracs principales -->
       	       <table width="850" border="0" cellspacing="1" bgcolor="#000000">
       	         <caption>
	           <font color="#FFFFFF" size="+1"><b><em>Caractéristiques Principales :</em></b></font>
       	         </caption>
       	         <tr align="center">
       	           <th align="center" width="150" bgcolor="#F32394"><font size="+1">Niveau</font></th>
       	           <th align="center" width="200" bgcolor="#F32394"><font size="+1">Attaques/DLA</font></th>
       	           <th align="center" width="150" bgcolor="#F32394"><font size="+1">Duree DLA</font></th>
       	           <th align="center" width="100" bgcolor="#F32394"><font size="+1">RM</font></th>
                   <th align="center" width="100" bgcolor="#FF9966">Date</th>
                   <th align="center" width="150" bgcolor="#FF9966">Source</th>
       	         </tr>
       	         <tr align="center">
	   	 <th bgcolor=#B7B7DB>
                     <SELECT name="Niveau">
	   	   <? echo levelselect($mlevel,$tablvl);?>
                     </SELECT>
                   </th>
	   	 <th bgcolor=#B7B7DB><input name="AttDLA" size=4 value=<?echo $AttDLA;?> /></th>
	   	 <th bgcolor=#B7B7DB><input name="DurDLA" size=4 value=<?echo $DurDLA;?> /></th>
	   	 <th bgcolor=#B7B7DB><input name="RM"    size=10 value=<?echo $RM;?>     /></th>
           	 <th bgcolor="#B7B7DB">
	   	    <INPUT NAME="DatCdm" READONLY TYPE=TEXT VALUE='<? echo date("d/m/Y"); ?>' READONLY></INPUT></th>
	   	 <th bgcolor="#B7B7DB">
           	    <INPUT NAME="Src" TYPE='TEXT' VALUE="Autre"></INPUT></th>
       	         </tr>
       	       </table></th>
             </tr><!-- fin caracs principales --> 
             <tr><th>&nbsp;</th></tr>
   	     <tr>
               <th>
                 <INPUT TYPE=SUBMIT VALUE="ajout des caracs"></INPUT>
               </th>
             </tr>
   	     <tr><th>&nbsp;</th></tr>
           </table><!-- fin table des 3 lignes pour les 3 tables race/nom, carac et pxtron-->
           </form>
         </th>
       </tr>
       </table>
     </td>
   </tr> <!-- fin de la partie supérieure contenant nom/race & caracs principales -->
         <!-- début de la seconde partie avec toutes les cdm -->

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
 </table>
</div>
</body>
</html>
