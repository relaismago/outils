<?PHP
/******************************************************************************
*                                                                             *
* validage    - enregistre un nouvel âge                                      *
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

global $db_bestiaire;

if (isset($_POST['Race']))    $Race = stripslashes($_POST['Race']);
else                          $Race="";
if (isset($_POST['M']))       $M = stripslashes($_POST['M']);
else                          $M="";
if (isset($_POST['F']))       $F = stripslashes($_POST['F']);
else                          $F="";
if (isset($_POST['Famille'])) $Famille = stripslashes($_POST['Famille']);
else                          $Famille="";
if (isset($_POST['NivSup']))  $NivSup = stripslashes($_POST['NivSup']);
else                          $NivSup="0";

if( ($Race!="") && ($M!="") && ($F!="") && ($Famille!="") ){
  print("<html>");
  print("<head>");
  print("<title>Insertion nouvel âge</title>");
  print("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\"></head>");
  print("<body bgcolor=\"#30395D\" text=\"#000000\">");

  $sql="INSERT INTO ages(Famille,M,F,niveau) VALUES(\"".$Famille."\",\"".$M."\",\"".$F."\",\"".$NivSup."\");";
  if(!mysql_query($sql,$db_bestiaire)){
    die("l'insertion du nouvel âge a échoué<br>$sql ".mysql_error()."<br>");
  }
  else{
    print("$Famille/$M/$F<br>");
  }
  print("</body>");
  print("</html>");
  print("<html><meta http-equiv=\"refresh\" content=\"1; url=../bestiaire.php?Race=".urlencode($Race)."\"></html>");
}
else{
  print("<html><meta http-equiv=\"refresh\" content=\"1; url=../bestiaire.php\"></html>");
}



?>
