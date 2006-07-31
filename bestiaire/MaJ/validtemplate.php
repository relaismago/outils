<?PHP
/******************************************************************************
*                                                                             *
* validtemplate   - enregistre un nouveau template                            *
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

if (isset($_POST['Race'])) $Race = stripslashes($_POST['Race']);
else $Race="";
if (isset($_POST['Template'])) $Template = stripslashes($_POST['Template']);
else $$Template="";
$Famille = stripslashes($_POST['Famille']);

if( ($Race!="") && ($Template!="")){
  print("<html>");
  print("<head>");
  print("<title>Insertion d'un nouveau template</title>");
  print("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\"></head>");
  print("<body bgcolor=\"#30395D\" text=\"#000000\">");
  //print("$Race/$Famille<br>");

  // NivStd=0 pour niveau standard inconnu
  $sql="INSERT INTO monstres(Race,Monstre,NivStd) VALUES(\"".$Race."\",\"".$Template."\",\"0\");";
  if(!mysql_query($sql,$db_bestiaire)){
    die("l'insertion du nouveau template a échoué<br>$sql<br>");
  }
  else{
    print("$Race/$Template<br>");
  }
  print("</body>");
  print("</html>");
  print("<html><meta http-equiv=\"refresh\" content=\"1; url=../bestiaire.php?Race=".urlencode($Race)."&Monstre=".urlencode($Template)."\"></html>");
}
else{
  print("<html><meta http-equiv=\"refresh\" content=\"1; url=../bestiaire.php\"></html>");
}



?>
