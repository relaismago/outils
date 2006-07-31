<?PHP
/******************************************************************************
*                                                                             *
* newtemplate   - saisie d'un nouveau template                                *
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


?>

<script language="JavaScript" src="../Libs/functions.js"></script>
<script language="JavaScript">

// En cas de sélection du Race, redirection sur l'url avec affectation du
// paramètre Race
function RaceSelectMenu() // 
{
  var r=getSelectVal(document.form_template.race_streum);
  document.form_template.Race.value=r;
  document.form_template.Template.value=r;
  location.href='newtemplate.php?Race='+r;;
}
</script>


<html>
<head>
<title>Nouveau Template</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>
<body bgcolor="#30395D" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" oncontextmenu="return false" ondragstart="return false" onselectstart="return false">
 <div align="center">


  <table width="720" border="0" cellspacing="1">
  <tr><th width=350 height=280>
         <img src="../<?echo $image; ?>"  border="2" align="center" bgcolor="#30395D">
  </th></tr>
  </table>
  <form name="form_template" method=POST action="validtemplate.php">
  <input type="hidden" name="Race"  value="<?echo $Race?>">
  <table width=800 border="0" cellspacing="1" bgcolor="#000000"> <!-- table race/nom -->
    <tr align="center">
      <th align="center" width=180 bgcolor="#F75007"><font size="+1">Race</font></th>
      <th align="center" width=180 bgcolor="#F75007"><font size="+1">Template</font></th>
      <th align="center" width=120 bgcolor="#F75007"><font size="+1">Famille</font></th>
      <th width="80" bgcolor="#B7B7DB" rowspan=2>
        <img src="<? print("Familles/".famille2gif($Famille));?>" alt="<? print($Famille);?>"/>
      </th>
    </tr>
    <tr align="center">
      <th bgcolor="#B7B7DB">
        <SELECT name="race_streum" onChange="RaceSelectMenu();">
          <? echo showListRaces($races,$Race);?>
        </SELECT>
      </th>
      <th bgcolor="#B7B7DB">
        <input name="Template" value="<? echo $Race; ?>" size=64/>
      </th>
      <th bgcolor="#B7B7DB" name="th_famille">
        <? echo $Famille; ?>
      </th>
    </tr>
  </table>
  <p>&nbsp;</p>
  <input type="submit" value="Enregistrer le nouveau template"/>
  </form>
</div>
</body>
</html>
