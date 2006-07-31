<?PHP
/******************************************************************************
*                                                                             *
* confirmcaracs - affiche les caracs à valider pour confirmation              *
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

if (isset($_POST['RACE'])) $Race = stripslashes($_POST['RACE']);
else                       $Race="";
if (isset($_POST['AGE']))  $Age = stripslashes($_POST['AGE']);
else                       $Age="";
if (isset($_POST['FAMILLE'])) $Famille = stripslashes($_POST['FAMILLE']);
else                          $Famille="";
if (isset($_POST['NOM']))     $MonstreAge = stripslashes($_POST['NOM']);
else                          $MonstreAge="";
if (isset($_POST['TEMPLATE'])) $Template = stripslashes($_POST['TEMPLATE']);
else                           $Template="";
if (isset($_POST['Niveau']))  $Niveau = stripslashes($_POST['Niveau']);
else                          $Niveau="";
if (isset($_POST['AttDLA']))  $AttDLA = stripslashes($_POST['AttDLA']);
else                          $AttDLA="";
if (isset($_POST['DurDLA']))  $DurDLA = stripslashes($_POST['DurDLA']);
else                          $DurDLA="";
if (isset($_POST['RM']))      $RM = stripslashes($_POST['RM']);
else                          $RM="";
$Date = stripslashes($_POST['DateSql']);
$Src = stripslashes($_POST['Src']);

if( ($Niveau!="") && ($AttDLA!="") && ($DurDLA!="") && ($RM!="") ){
print("<html>");
print("<head>");
print("<title>Confirmer nouvelle CdM</title>");
print("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\"></head>");
print("<body bgcolor=\"#30395D\" text=\"#000000\">");
print("<div align=\"center\">");
print("<table align=\"center\" width=\"560\" border=\"0\" cellspacing=\"1\" bgcolor=\"#000000\">");
print("  <caption>");
print("    <p><font color=\"#FFFFFF\" size=\"+1\"><b><em>Nouvelles Caractéristiques :</em></b></font></p>");
print("    <p>&nbsp;</p>");
print("  </caption>");
print("<tr align=\"center\">");
print("  <th align=\"center\" width=\"260\" bgcolor=\"#F75007\"><font size=\"+1\">Nom</font></th>");
print("  <th align=\"center\" width=\"180\" bgcolor=\"#F75007\"><font size=\"+1\">Race</font></th>");
print("  <th align=\"center\" width=\"120\" bgcolor=\"#F75007\"><font size=\"+1\">Famille</font></th>");
print("</tr>");
print("<tr align=\"center\">");
print("  <th bgcolor=\"#B7B7DB\">$MonstreAge</th>");
print("  <th bgcolor=\"#B7B7DB\">$Race</th>");
print("  <th bgcolor=\"#B7B7DB\">$Famille</th>");
print("</tr>");
print("</table>");
print("<table align=\"center\" width=\"560\" border=\"0\" cellspacing=\"1\" bgcolor=\"#000000\">");
print("<tr align=\"center\">");
print("  <th align=\"center\" width=\"260\" bgcolor=\"#F32394\">Niveau</th>");
print("  <th align=\"center\" width=\"180\" bgcolor=\"#F32394\">Att/DLA</th>");
print("  <th align=\"center\" width=\"120\" bgcolor=\"#F32394\">Durée DLA</th>");
print("  <th align=\"center\" width=\"120\" bgcolor=\"#F32394\">RM</th>");
print("</tr>");
print("<tr align=\"center\">");
print("  <th bgcolor=\"#B7B7DB\">$Niveau</th>");
print("  <th bgcolor=\"#B7B7DB\">$AttDLA</th>");
print("  <th bgcolor=\"#B7B7DB\">$DurDLA</th>");
print("  <th bgcolor=\"#B7B7DB\">$RM</th>");
print("</tr>");
print("</table>");
print("<form name=\"valid_cdm\" action=\"validcaracs.php\" method=\"POST\" >");
print("<INPUT TYPE=HIDDEN NAME=\"Monstre\" VALUE=\"$MonstreAge\"></INPUT>");
print("<INPUT TYPE=HIDDEN NAME=\"Template\" VALUE=\"$Template\"></INPUT>");
print("<INPUT TYPE=HIDDEN NAME=\"Age\" VALUE=\"$Age\"></INPUT>");
print("<INPUT TYPE=HIDDEN NAME=\"Race\" VALUE=\"$Race\"></INPUT>");
print("<INPUT TYPE=HIDDEN NAME=\"Famille\" VALUE=\"$Famille\"></INPUT>");
print("<INPUT TYPE=HIDDEN NAME=\"Niveau\" VALUE=\"$Niveau\"></INPUT>");
print("<INPUT TYPE=HIDDEN NAME=\"AttDLA\" VALUE=\"$AttDLA\"></INPUT>");
print("<INPUT TYPE=HIDDEN NAME=\"DurDLA\" VALUE=\"$DurDLA\"></INPUT>");
print("<INPUT TYPE=HIDDEN NAME=\"RM\" VALUE=\"$RM\"></INPUT>");
print("<INPUT TYPE=HIDDEN NAME=\"Date\" VALUE=\"$Date\"></INPUT>");
print("<INPUT TYPE=HIDDEN NAME=\"Src\" VALUE=\"$Src\"></INPUT>");
print("<INPUT TYPE=submit Value=\"Confirmer\"></input>");
print("</form>");
print("</div>");
print("</body>");
print("</html>");
}
else{
  print("<html><meta http-equiv=\"refresh\" content=\"1; url=../bestiaire.php?Race=".urlencode($Race)."&Monstre=".urlencode($Template)."&Age=".urlencode($Age)."\"></html>");
}

?>
