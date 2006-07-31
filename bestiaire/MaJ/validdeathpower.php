<?PHP
/******************************************************************************
*                                                                             *
* validpouvoirs   - enregistre un nouveau pouvoir magique                     *
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
include_once('../Libs/functions.php');

global $db_bestiaire;

if (isset($_POST['MonstreAge'])) $MonstreAge = stripslashes($_POST['MonstreAge']);
else $MonstreAge="";
if (isset($_POST['Race'])) $Race = stripslashes($_POST['Race']);
else $Race="";
if (isset($_POST['Age'])) $Age = stripslashes($_POST['Age']);
else $Age="";
if (isset($_POST['Template'])) $Template = stripslashes($_POST['Template']);
else $Template="";
if (isset($_POST['Pouvoir'])) $Pouvoir = stripslashes($_POST['Pouvoir']);
else $Pouvoir="";
if (isset($_POST['Descript'])) $Descript = stripslashes($_POST['Descript']);
else $Descript="?";
if (isset($_POST['MM'])) $MM = stripslashes($_POST['MM']);
else $MM="?";
if (isset($_POST['Duree'])) $Duree = stripslashes($_POST['Duree']);
else $Duree="?";
if (isset($_POST['Auto'])) $Auto = stripslashes($_POST['Auto']);
else $Auto="?";
if (isset($_POST['Zone'])) $Zone = stripslashes($_POST['Zone']);
else $Zone="?";
if (isset($_POST['Source'])) $Source = stripslashes($_POST['Source']);
else $Source="R&M";


if( ($Pouvoir!="") && ($Template!="")){
  print("<html>");
  print("<head>");
  print("<title>Insertion d'un nouveau pouvoir à la mort</title>");
  print("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\"></head>");
  print("<body bgcolor=\"#30395D\" text=\"#000000\">");
  //print("$Template/$Pouvoir<br>");


  $sql="INSERT INTO derniersouffle(Nom,Pouvoir,Descript,MM,Duree,Zone,source) VALUES(\"".$Template."\",\"".$Pouvoir."\",\"".$Descript."\",\"".$MM."\",\"".$Duree."\",\"".$Zone."\",\"".$Source."\");";
  if(!mysql_query($sql,$db_bestiaire)){
    die("l'insertion du nouveau pouvoir a échoué<br>$sql<br>");
  }
  else{
    print("$Template/$Pouvoir/$Descript/$MM/$Duree/$Zone/$Source<br>");
  }
  print("</body>");
  print("</html>");
  print("<html><meta http-equiv=\"refresh\" content=\"1; url=../bestiaire.php?Race=".urlencode($Race)."&Monstre=".urlencode($Template)."&Age=".urlencode($Age)."\"></html>");
}
else{
  print("<html><meta http-equiv=\"refresh\" content=\"1; url=../bestiaire.php\"></html>");
}



?>
