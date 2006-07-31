<?PHP
/******************************************************************************
*                                                                             *
* allraces - affiche toutes les races d'une même famille                      *
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

require_once("Libs/functions.php");
include_once('../inc_connect.php3');
include_once('../inc_authent.php3');
include_once('../head.php3');
include_once('b_functions.php');

global $db_bestiaire;

?>

<html>
<head>
<title>Toutes les Races</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>


<?


if (isset($_GET['Famille'])) $Famille = stripslashes($_GET['Famille']); 
else                          $Famille = "Monstre";
if(  ($Famille!="Animal")&&($Famille!="Démon")&&($Famille!="Humanoïde")
     &&($Famille!="Insecte")&&($Famille!="Monstre")&&($Famille!="Mort-Vivant")
     &&($Famille!="Mort-Vivant")&&($Famille!="Spécial") ) $Famille = "Monstre";
     

//
// remplissage du tableau des races (sert à la construction du SELECT des races
//
$races=array();
$sql="SELECT * FROM `races` WHERE `Famille`=\"$Famille\" ORDER by `race` ASC;"; // récupérer toutes les races
$query=mysql_query($sql,$db_bestiaire);
while($ret=mysql_fetch_array($query)){ // stocker toutes les races dans le
  $races[$ret[0]]=$ret;                // tableau $races 
}
$Race=$races[0];

?>

<script language="JavaScript" src="Libs/functions.js"></script>
<script language="JavaScript">

// En cas de sélection de la Famille lors de l'entrée d'une nouvelle race, 
// affectation du paramètre Famille
function FamilleSelectMenu() // 
{
  var r=getSelectVal(document.allraces.famille_streum);
  document.allraces.Famille.value=r;
  location.href='allraces.php?Famille='+r;;
}
</script> 

<? afficheMenuBestiaire() ?>

 <div align="center">
 <p>&nbsp;</p>
 <form name="allraces" method=POST action="validrace.php">
 <input type="hidden" name="Famille"  value="<?echo $Famille;?>">
 <table width="720" border="0" cellspacing="1" bgcolor="#000000"> <!-- table race/nom -->
   <tr align="center">
     <th align="center" width="180" bgcolor="#F75007"><font size="+1">Famille</font></th>
     <th align="center" width="180" bgcolor="#F75007"><font size="+1">Race</font></th>
   </tr>
   <tr align="center">
     <th bgcolor="#B7B7DB">
       <SELECT name="famille_streum" width=20 onChange="FamilleSelectMenu();">
<?
  if($Famille=="Animal") $selected="selected"; else $selected="";
print("    <option label=\"Animal\" value=\"Animal\" $selected >Animal</option>");
  if($Famille=="Démon") $selected="selected"; else $selected="";
print("    <option label=\"Démon\" value=\"Démon\" $selected >Démon</option>");
  if($Famille=="Humanoïde") $selected="selected"; else $selected="";
print("    <option label=\"Humanoïde\" value=\"Humanoïde\" $selected >Humanoïde</option>");
  if($Famille=="Insecte") $selected="selected"; else $selected="";
print("    <option label=\"Insecte\" value=\"Insecte\" $selected >Insecte</option>");
  if($Famille=="Monstre") $selected="selected"; else $selected="";
print("    <option label=\"Monstre\" value=\"Monstre\" $selected >Monstre</option>");
  if($Famille=="Mort-Vivant") $selected="selected"; else $selected="";
print("    <option label=\"Mort-Vivant\" value=\"Mort-Vivant\" $selected >Mort-Vivant</option>");
  if($Famille=="Spécial") $selected="selected"; else $selected="";
print("    <option label=\"Spécial\" value=\"Spécial\">Spécial $selected </option>");
?>
         </SELECT>
       </th>
       <th bgcolor="#B7B7DB">
         <SELECT name="Races" size=40><?echo ShowListRaces($races,$Race);?></SELECT>
       </th>
     </tr>
   </table>
   </form>
</div>
</body>
</html>
