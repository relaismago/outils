<?PHP
/******************************************************************************
*                                                                             *
* validcdm - enregistre une nouvelle cdm                                      *
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

$Monstre = stripslashes($_POST['Monstre']);
$Age = stripslashes($_POST['Age']);
$Nom = stripslashes($_POST['Nom']);
$Race = stripslashes($_POST['Race']);
$Famille = stripslashes($_POST['Famille']);
$Niv = stripslashes($_POST['Niv']);
$Pdv = stripslashes($_POST['Pdv']);
$Att = stripslashes($_POST['Att']);
$Esq = stripslashes($_POST['Esq']);
$Deg = stripslashes($_POST['Deg']);
$Reg = stripslashes($_POST['Reg']);
$Arm = stripslashes($_POST['Arm']);
$Vue = stripslashes($_POST['Vue']);
$Date = stripslashes($_POST['Date']);
$Src = stripslashes($_POST['Src']);
$Cap = stripslashes($_POST['Cap']);
$Aff = stripslashes($_POST['Aff']);

print("<html>");
print("<head>");
print("<title>Confirmer nouvelle CdM</title>");
print("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\"></head>");
print("<body bgcolor=\"#30395D\" text=\"#000000\">");
//print("$Nom/$Race/$Famille/$Niv/$Pdv/$Att/$Esq/$Deg/$Reg/$Arm/$Vue/$Date/$Src/$Cap/$Aff<br>");

$sql="INSERT INTO cdms(Nom,Race,Famille,Niv,PdV,ATT,ESQ,Degat,Regen,Armure,Vue,CapSpe,Affecte,source) VALUES(\"".$Nom."\",\"".$Race."\",\"".$Famille."\",\"".$Niv."\",\"".$Pdv."\",\"".$Att."\",\"".$Esq."\",\"".$Deg."\",\"".$Reg."\",\"".$Arm."\",\"".$Vue."\",\"".$Cap."\",\"".$Aff."\",\"".$Src."\");";
if(!mysql_query($sql,$db_bestiaire)){
  die("l'insertion de la cdm a échoué<br>$sql<br>");
}
else{
  print("$Nom/$Race/$Famille/$Niv/$Pdv/$Att/$Esq/$Deg/$Reg/$Arm/$Vue/$Date/$Src/$Cap/$Aff<br>");
  // on vérifie si le niveau standard a besoin d'une mise à jour
  if(checkagestd($Niv,$Nom,$Race,$Famille,$Template,$NivStd)){ // oui maj à faire
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

print("<html><meta http-equiv=\"refresh\" content=\"1; url=../bestiaire.php?Race=".urlencode($Race)."&Monstre=".urlencode($Monstre)."&Age=".urlencode($Age)."\"></html>");

?>

