<?PHP
/******************************************************************************
*                                                                             *
* newage - saisie d'un nouvel âge pour une famille donnée                     *
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

//require_once("Libs/init_racemonstre.php");

if (isset($_POST['Race'])) $Race = stripslashes($_POST['Race']); 
else                       $Race = "Abishaii Bleu";
if (isset($_POST['Famille'])) $Famille = stripslashes($_POST['Famille']); 
else                         $Famille = "Monstre";
if(  ($Famille!="Animal")&&($Famille!="Démon")&&($Famille!="Humanoïde")
     &&($Famille!="Insecte")&&($Famille!="Monstre")&&($Famille!="Mort-Vivant")
     &&($Famille!="Mort-Vivant")&&($Famille!="Spécial") ) $Famille = "Monstre";
     
//require_once("Libs/functions.php");
function famille2gif($nom)
{
  return strtr($nom,"éèêàèùûïî","eeeaeuuii");
}
?>

<script language="JavaScript" src="Libs/functions.js"></script>
<script language="JavaScript">

// En cas de sélection d'un age, récupération de la race, du monstre, de l'âge et
// redirection sur l'url avec affectation des paramètres Race et Monstre et Age
function AgeSelectMenu()
{
  var a=getSelectVal(document.form_age.sel_nivsup);
  document.form_age.NivSup.value=a;
}


// En cas de sélection de la Race lors de l'entrée d'un nouveau template, 
// redirection sur l'url avec affectation du paramètre Race
// En cas de sélection de la Famille lors de l'entrée d'une nouvelle race, 
// affectation du paramètre Famille
function FamilleSelectMenu() // 
{
  var r=getSelectVal(document.form_age.famille_streum);
  document.form_age.Famille.value=r;
}
</script> 



<body bgcolor="#30395D" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" oncontextmenu="return false" ondragstart="return false" onselectstart="return false">
 <div align="center">


 <p>&nbsp;</p>
 <form name="form_age" method=POST action="validage.php">
 <input type="hidden" name="Race"     value="<?echo $Race;?>">
 <input type="hidden" name="Famille"  value="<?echo $Famille;?>">
 <input type="hidden" name="NivSup"   value="0">
 <table width="720" border="0" cellspacing="1" bgcolor="#000000"> <!-- table race/nom -->
   <tr align="center">
     <th align="center" width="180" bgcolor="#F75007"><font size="+1">Famille</font></th>
     <th align="center" width="180" bgcolor="#F75007"><font size="+1">Âge Masculin</font></th>
     <th align="center" width="180" bgcolor="#F75007"><font size="+1">Âge Féminin</font></th>
     <th align="center" width="180" bgcolor="#F75007"><font size="+1">Niveau sup</font></th>
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
         <input name="M" size=20/>
       </th>
       <th bgcolor="#B7B7DB">
         <input name="F" size=20/>
       </th>
       <th bgcolor="#B7B7DB">
         <SELECT name="sel_nivsup" onChange="AgeSelectMenu()">
         <option label="0" value="0" selected>0</option>
         <option label="1" value="1">1</option>
         <option label="2" value="2">2</option>
         <option label="3" value="3">3</option>
         <option label="4" value="4">4</option>
         <option label="5" value="5">5</option>
         <option label="6" value="6">6</option>
         <option label="7" value="7">7</option>
         <option label="8" value="8">8</option>
         <option label="9" value="9">9</option>
         </SELECT>
       </th>
     </tr>
   </table>
   <p>&nbsp;</p>
   <input type="submit" value="Enregistrer le nouvel âge"/>
   </form>
</div>
</body>
</html>
