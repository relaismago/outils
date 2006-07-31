<?PHP
/******************************************************************************
*                                                                             *
* validcaracs - fichier pour gérer insérer de nouvelles caracs dans la base   *
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
include_once('Libs/functions.php');


global $db_bestiaire;

$Race = stripslashes($_POST['Race']);
$Age = stripslashes($_POST['Age']);
$Famille = stripslashes($_POST['Famille']);
$Monstre = stripslashes($_POST['Monstre']);
$Template = stripslashes($_POST['Template']);
$Niveau = stripslashes($_POST['Niveau']);
$AttDLA = stripslashes($_POST['AttDLA']);
$DurDLA = stripslashes($_POST['DurDLA']);
$RM = stripslashes($_POST['RM']);
$Date = stripslashes($_POST['Date']);
$Src = stripslashes($_POST['Src']);

print("<html>");
print("<head>");
print("<title>Insertion nouvelles caracs</title>");
print("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\"></head>");
print("<body bgcolor=\"#30395D\" text=\"#000000\">");

$sql="INSERT INTO caracs(Nom,Niv,ATTDLA,DurDLA,RM,source) VALUES(\"".$Monstre."\",\"".$Niveau."\",\"".$AttDLA."\",\"".$DurDLA."\",\"".$RM."\",\"".$Src."\");";
if(!mysql_query($sql,$db_bestiaire)){
  die("l'insertion des nouvelles caracs a échoué<br>$sql<br>");
}
else{
  print("Race=$Race/Monstre=$Monstre/Age=$Age/Famille=$Famille/Niveau=$Niveau/AttDLA=$AttDLA/DurDLA=$DurDLA/RM=$RM/Date=$Date/Src=$Src<br>");
  // on vérifie si le niveau standard a besoin d'une mise à jour
  if(checkagestd($Niveau,$Monstre,$Race,$Famille,$Template,$NivStd)){ // oui maj à faire
    print("tata<br>");
    $sql="UPDATE `monstres` SET `NivStd`=\"".$NivStd."\" WHERE `Monstre`=\"".$Template."\" LIMIT 1;";
    if(!mysql_query($sql,$db_bestiaire)){
      die("la mise à jour du niveau stand a échoué<br>$sql</br>");
    }
    else{
      print("$Template : $NivStd <br>");
    }
  }
}
print("</body>");
print("</html>");
print("<html><meta http-equiv=\"refresh\" content=\"1; url=../bestiaire.php?Race=".urlencode($Race)."&Monstre=".urlencode($Template)."&Age=".urlencode($Age)."\"></html>");

?>
