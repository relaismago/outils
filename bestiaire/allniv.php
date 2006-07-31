<?PHP
/******************************************************************************
*                                                                             *
* allniv - affiche tous les templates d'un certain niveau                     *
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
include_once('../inc_connect.php3');
include_once('../inc_authent.php3');
include_once('../head.php3');
include_once('b_functions.php');

global $db_bestiaire;

?>

<html>
<head>
<title>Toutes les Templates pour un niveau donné</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>


<?

require_once("Libs/functions.php");

if (isset($_GET['Niv'])) $Niv = stripslashes($_GET['Niv']); 
else                     $Niv = 20;

//
// remplissage du tableau des races
//
$tab_race=array();
$sql="SELECT * FROM `races` ORDER by `Race` ASC;";
$query=mysql_query($sql,$db_bestiaire);
while($ret=mysql_fetch_array($query)){
  $tab_race[$ret[0]]=$ret;
}

//
// remplissage du tableau des familles
//
$tab_famille=array();
$sql="SELECT * FROM `famille` ORDER by `Famille` ASC;";
$query=mysql_query($sql,$db_bestiaire);
while($ret=mysql_fetch_array($query)){
  $tab_famille[$ret[0]]=$ret;
}

//
// remplissage du tableau des monstres
//
$tab_monstre=array();
$sql="SELECT * FROM `monstres` WHERE 1 ORDER by `NivStd` ASC;";
$query=mysql_query($sql,$db_bestiaire);
while($ret=mysql_fetch_array($query)){
  $tab_monstre[$ret[2]]=$ret;
}

function listemonstrelevel($Niv,&$tab_monstre,&$tab_race)
{
	global $db_bestiaire;

	$option="";
	
	foreach($tab_monstre as $monstre){
		// remplissage du tableau des âges
		$sql="SELECT * FROM `ages` WHERE `Famille`=\"".$tab_race[$monstre['Race']]['Famille'];
		$sql.="\" ORDER by `niveau` ASC;";
	
		$tab_age=array();
		$queryage=mysql_query($sql,$db_bestiaire);
		while($ret=mysql_fetch_array($queryage)){
		  $tab_age[$ret[1]]=$ret;
		}
		$m=end($tab_age);
		$max=$m['niveau'];
		if( (strpos($monstre['NivStd'],'>')===false) && (strpos($monstre['NivStd'],'<')===false) ){
			// le niveau n'est pas > ou < , on extrait la borne inf
			$i=strpos($monstre['NivStd'],'-');
			if($i===false){ // niveau unique
				$NivInf=$monstre['NivStd'];
				$NivSup=$NivInf;
			} else { // interval
				$NivInf=substr($monstre['NivStd'],0,$i-1);
				$NivSup=substr($monstre['NivStd'],$i+1);
			}
			// le monstre est-il un template valide ?
			$valide=($NivInf<=$Niv)&&(($NivInf+$max>=$Niv)||($NivSup+$max>=$Niv));
			if($valide){
				// vérifions pour quels âges il est valide
				foreach($tab_age as $age){
					if( ($NivSup+$age['niveau']>=$Niv)&&($NivInf+$age['niveau']<=$Niv) ){
						//$option.="<option>";
						$option.=$monstre['Monstre'];
						$genre=$tab_race[$monstre['Race']]['genre'];
						$option.=" [".$age[$genre]."]";
						$option.="\n";
						//$option.="</option>";
					}
				}
			}
		}
	}
	return $option;
}


?>

<script language="JavaScript" src="Libs/functions.js"></script>
<script language="JavaScript">

// En cas de sélection de la Famille lors de l'entrée d'une nouvelle race, 
// affectation du paramètre Famille
function NivSelectMenu() // 
{
	var r=getSelectVal(document.allniv.nivselect);
	document.allniv.Niveau.value=r;
	location.href='allniv.php?Niv='+r;;
}
</script> 

<? afficheMenuBestiaire() ?>

<div align="center">
<p>&nbsp;</p>
<form name="allniv">
<input type="hidden" name="Niveau"  value="<?echo $Niv;?>">
<table width="720" border="0" cellspacing="1" bgcolor="#000000"> <!-- table race/nom -->
<tr align="center">
<th align="center" width="180" bgcolor="#F75007"><font size="+1">Niveau</font></th>
<th align="center" width="180" bgcolor="#F75007"><font size="+1">Monstre</font></th>
</tr>
<tr align="center">
<th bgcolor="#B7B7DB">
<SELECT name="nivselect" onChange="NivSelectMenu()"><? echo options_value($tabnivuniq,$Niv); ?>
</SELECT>
</th>
<th bgcolor="#B7B7DB">
<textarea name="listemonstre" cols="50" rows="30" readonly="readonly"><? echo listemonstrelevel($Niv,$tab_monstre,$tab_race); ?></textarea>
</th>
</tr>
</table>
</form>
</div>
</body>
</html>
