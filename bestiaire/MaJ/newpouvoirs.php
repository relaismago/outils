<?PHP
/******************************************************************************
*                                                                             *
* newcaracs - fichier pour entrer un pouvoir magique                          *
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

/*Libs/init_capspe.php*/
$tab = getCapaciteSpeciales($MonstreAge,$Monstre,$Race, $agebasic);
$pouvoirs = $tab[0];
$pouvoirstemplate = $tab[1];


?>


<script language="JavaScript" src="Libs/functions.js"></script>
<script language="JavaScript">
// En cas de sélection du Race, redirection sur l'url avec affectation du
// paramètre Race
function RaceSelectMenu() // 
{
  var r=getSelectVal(document.form_pouvoir.race_streum);
  document.form_pouvoir.Race.value=r;
  location.href='newpouvoirs.php?Race='+r;
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
  var r=getSelectVal(document.form_pouvoir.race_streum);
  document.form_pouvoir.Race.value=r;
  var m=getSelectVal(document.form_pouvoir.name_streum);
  document.form_pouvoir.Template.value=m;
  var a=getSelectVal(document.form_pouvoir.age_streum);
  document.form_pouvoir.Age.value=a;
  location.href='newpouvoirs.php?Race='+r+'&Monstre='+m+'&Age='+a;
}
// En cas de sélection d'un age, récupération de la race, du monstre, de l'âge et
// redirection sur l'url avec affectation des paramètres Race et Monstre et Age
function AgeSelectMenu()
{
  var r=getSelectVal(document.form_pouvoir.race_streum);
  document.form_pouvoir.Race.value=r;
  var m=getSelectVal(document.form_pouvoir.name_streum);
  document.form_pouvoir.Template.value=m;
  var a=getSelectVal(document.form_pouvoir.age_streum);
  var age=a.substr(a.indexOf('-')+2);
  document.form_pouvoir.Age.value=age;
  location.href='newpouvoirs.php?Race='+r+'&Monstre='+m+'&Age='+age;
}

</script> 

<html>
<head>
<title>Nouveau Pouvoir magique</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>
<body bgcolor="#30395D" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" oncontextmenu="return false" ondragstart="return false" onselectstart="return false">
 <div align="center">
 <p>&nbsp;</p>
 <table width="800" border="0" cellspacing="1" bgcolor="#30395D">
   <form name="form_pouvoir" method="POST" action="confirmpouvoirs.php">
   <input type="hidden" name="MonstreAge"     value="<?echo $MonstreAge; ?>">
   <input type="hidden" name="Race"     value="<?echo $Race; ?>">
   <input type="hidden" name="Template" value="<?echo $Monstre; ?>">
   <input type="hidden" name="Age"  	value="<?echo $Age; ?>">
   <input type="hidden" name="Nom"  	value="<?echo $MonstreAge; ?>">
   <input type="hidden" name="Famille"  value="<?echo $Famille; ?>">
   <tr> <!-- ligne contenant l\'image et une table pour les caracs principales -->
     <td>
       <table align="center">
       <tr>
         <th width="200" height="200" >
           <img src="<?echo $image; ?>"  border="2" align="center" bgcolor="#30395D">
         </th>
       </tr>
       <tr align="center"><th>
         <table width=800><!-- les 3 lignes pour les 3 tables race/nom, carac et pxtron-->
           <tr align="center"><th>
             <table width="720" align="center" border="0" cellspacing="1" bgcolor="#30395D"> <!-- table race/nom -->
               <tr align="center">
		 <th colspan=4 bgcolor="#FFCC00"><? echo $MonstreAge; ?></th>
               </tr>
               <tr align="center">
                 <th align="center" width="180" bgcolor="#F75007"><font size="+1">Race</font></th>
                 <th align="center" width="180" bgcolor="#F75007"><font size="+1">Nom</font></th>
                 <th align="center" width="180" bgcolor="#F75007"><font size="+1">Âge</font></th>
                 <th align="center" width="180" bgcolor="#F75007"><font size="+1">Famille</font></th>
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
       </tr>
       </table>
     </td>
   </tr> <!-- fin de la partie supérieure contenant nom/race & caracs principales -->
         <!-- début de la seconde partie avec toutes les cdm -->
 <tr><th>

   <table width="950" border="0" cellspacing="1" bgcolor="#000000">
   <caption>		 
      <font color="#FFFFFF" size="+1"><b><em>Nouvelle Capacité spéciale (pouvoir magique)</em></b></font>
   </caption>
   <tr align="center">
     <th align="center" width=32 bgcolor="#18D5BD">Pouvoir</th>
     <th colspan=3 align="center" width=96 bgcolor="#18D5BD">Description</th>
   </tr>
   <tr align="center">
     <th bgcolor="#B7B7DB"><input name="Pouvoir" width=64 size=32 value="<?echo $pouvoirs[0]['Pouvoir'];?>"/></th>
     <th colspan=3 bgcolor="#B7B7DB"><input name="Descript" width=128 size=96 value="<?echo $pouvoirs[0]['Descript'];?>"/></th>
   </tr>
   <tr align="center">
     <th align="center" bgcolor="#18D5BD">MM</th>
     <th align="center" bgcolor="#18D5BD">Durée Malus</th>
     <th align="center" bgcolor="#18D5BD">Séparé de l'attaque</th> <!-- ' -->
     <th align="center" bgcolor="#18D5BD">Effet de Zone</th>
   </tr>
   <tr align="center">
     <th bgcolor="#B7B7DB"><input name="MM" width=10 value="<?echo $pouvoirs[0]['MM'];?>"/></th>
     <th bgcolor="#B7B7DB">
      <select name="Duree">
        <option value="?" <?if($pouvoirs[0]['Duree']=='?') echo "selected"?>>?</option>
        <option value="0" <?if($pouvoirs[0]['Duree']=='1') echo "selected"?>>0</option>
        <option value="1" <?if($pouvoirs[0]['Duree']=='1') echo "selected"?>>1</option>
        <option value="2" <?if($pouvoirs[0]['Duree']=='2') echo "selected"?>>2</option>
        <option value="3" <?if($pouvoirs[0]['Duree']=='3') echo "selected"?>>3</option>
        <option value="4" <?if($pouvoirs[0]['Duree']=='4') echo "selected"?>>4</option>
        <option value="5" <?if($pouvoirs[0]['Duree']=='5') echo "selected"?>>5</option>
        <option value="6" <?if($pouvoirs[0]['Duree']=='6') echo "selected"?>>6</option>
        <option value="7" <?if($pouvoirs[0]['Duree']=='7') echo "selected"?>>7</option>
        <option value="8" <?if($pouvoirs[0]['Duree']=='8') echo "selected"?>>8</option>
        <option value="9" <?if($pouvoirs[0]['Duree']=='9') echo "selected"?>>9</option>
      </select>
     </th>
     <th bgcolor="#B7B7DB">
      <select name="Auto">
        <option value="?"
          <?if(($pouvoirs[0]['Auto']=='?')||($pouvoirs[0]['Auto']=='Aucun')) echo "selected"?>>?</option>
        <option value="Oui" <?if($pouvoirs[0]['Auto']=='Oui') echo "selected"?>>Oui</option>
        <option value="Non" <?if($pouvoirs[0]['Auto']=='Non') echo "selected"?>>Non</option>
      </select>
     </th>
     <th bgcolor="#B7B7DB">
      <select name="Zone">
        <option value="?" 
          <?if(($pouvoirs[0]['Zone']=='?')||($pouvoirs[0]['Zone']=='Aucun')) echo "selected"?>>?</option>
        <option value="Oui" <?if($pouvoirs[0]['Zone']=='Oui') echo "selected"?>>Oui</option>
        <option value="Non" <?if($pouvoirs[0]['Zone']=='Non') echo "selected"?>>Non</option>
      </select>
     </th>
   </tr>
   <tr align="center">
     <th bgcolor="#FF9966">Date</th>
     <th bgcolor="#FF9966" colspan=3>source</th>
   </tr>
   <tr align="center">
     <th bgcolor="#B7B7DB">
	<INPUT NAME="DatPouvoir" READONLY TYPE=TEXT VALUE='<? echo date("d/m/Y"); ?>'/>
     </th>
     <th bgcolor="#B7B7DB" colspan=4>
        <INPUT NAME="Source" TYPE='TEXT' VALUE="Autre"/>
     </th>
   </tr>
   </table>
 </th></tr>
 <tr><th>&nbsp;</th></tr>
 <tr><th><input type="submit" value="Enregistrer le nouveau pouvoir magique"/></th></tr>
 <tr><th>&nbsp;</th></tr>
 <tr><th bgcolor="#B7B7DB"><font color="#444444" size="+2"><em>Données déjà connnues</em></font></th></tr>
 <tr>
   <th>
     <!--  ------------------------------------ -->
     <? print_capspe($pouvoirs,$pouvoirstemplate,TRUE,FALSE);?> <!-- on les affiche toutes sauf la première -->
     <!--  ------------------------------------ -->
   </th>
 </tr>
 </form>
 </table>
</div>
</body>
</html>
