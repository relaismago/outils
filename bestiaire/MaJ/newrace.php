<?PHP
/******************************************************************************
*                                                                             *
* newrace - saisie d'une nouvelle race                                        *
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

//require_once("Libs/functions.php");
function famille2gif($nom)
{
  return strtr($nom,"éèêàèùûïî","eeeaeuuii");
}

if (isset($_POST['Famille'])) $Famille = stripslashes($_POST['Famille']); 
else                         $Famille = "Monstre";
if(  ($Famille!="Animal")&&($Famille!="Démon")&&($Famille!="Humanoïde")
     &&($Famille!="Insecte")&&($Famille!="Monstre")&&($Famille!="Mort-Vivant")
     &&($Famille!="Mort-Vivant")&&($Famille!="Spécial") ) $Famille = "Monstre";
     
?>

<script language="JavaScript" src="Libs/functions.js"></script>
<script language="JavaScript">

// En cas de sélection de la Famille lors de l'entrée d'une nouvelle race, 
// affectation du paramètre Famille
function FamilleSelectMenu() // 
{
  var r=getSelectVal(document.form_race.famille_streum);
  document.form_race.Famille.value=r;
}
</script> 



<body bgcolor="#30395D" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" oncontextmenu="return false" ondragstart="return false" onselectstart="return false">
 <div align="center">


 <p>&nbsp;</p>
 <form name="form_race" method=POST action="validrace.php">
 <input type="hidden" name="Famille"  value="<?echo $Famille;?>">
 <table width="720" border="0" cellspacing="1" bgcolor="#000000"> <!-- table race/nom -->
   <tr align="center">
     <th width="180" bgcolor="#F75007"><font size="+1">Famille</font></th>
     <th width="180" bgcolor="#F75007"><font size="+1">Race</font></th>
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
      <input name="Race" size=60></input>
    </th>
   </tr>
   </table>
   <p>&nbsp;</p>
   <input type="submit" value="Enregistrer la nouvelle race"/>
   </form>
</div>
</body>
</html>
