<?PHP
/******************************************************************************
*                                                                             *
* confirmcdm - affiche la cdm à valider pour confirmation                     *
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

require_once("parse_cdm.php");

$Nom = $MonstreAge;
$Src = $Troll;
$Date = date("d/m/Y");

if(!isset($Aff)) $Aff="rien";
if(!isset($Cap)) $Cap="aucune";

print("<div align=\"center\">");
print("<table align=\"center\" width=\"560\" border=\"0\" cellspacing=\"1\" bgcolor=\"#000000\">");
print("  <caption>");
print("    <p><font color=\"#FFFFFF\" size=\"+1\"><b><em>Nouvelle Connaissance sur le monstre :</em></b></font></p>");
print("    <p>&nbsp;</p>");
print("  </caption>");
print("<tr align=\"center\">");
print("  <th align=\"center\" width=\"260\" bgcolor=\"#F75007\"><font size=\"+1\">Nom</font></th>");
print("  <th align=\"center\" width=\"180\" bgcolor=\"#F75007\"><font size=\"+1\">Race</font></th>");
print("  <th align=\"center\" width=\"120\" bgcolor=\"#F75007\"><font size=\"+1\">Famille</font></th>");
print("</tr>");
print("<tr align=\"center\">");
print("  <th bgcolor=\"#B7B7DB\">$Nom</th>");
print("  <th bgcolor=\"#B7B7DB\">$Race</th>");
print("  <th bgcolor=\"#B7B7DB\">$Famille</th>");
print("</tr>");
print("</table>");
print("<table align=\"center\" width=\"560\" border=\"0\" cellspacing=\"1\" bgcolor=\"#000000\">");
print("<tr align=\"center\">");
print("  <th align=\"center\" width=\"80\" bgcolor=\"#1AC611\">Niv</th>");
print("  <th align=\"center\" width=\"80\" bgcolor=\"#1AC611\">PdV</th>");
print("  <th align=\"center\" width=\"80\" bgcolor=\"#1AC611\">Attaque</th>");
print("  <th align=\"center\" width=\"80\" bgcolor=\"#1AC611\">Esquive</th>");
print("  <th align=\"center\" width=\"80\" bgcolor=\"#1AC611\">Dégâts</th>");
print("  <th align=\"center\" width=\"80\" bgcolor=\"#1AC611\">Régen</th>");
print("  <th align=\"center\" width=\"80\" bgcolor=\"#1AC611\">Armure</th>");
print("  <th align=\"center\" width=\"80\" bgcolor=\"#1AC611\">Vue</th>");
print("</tr>");
print("<tr align=\"center\">");
print("  <th bgcolor=\"#B7B7DB\">$Niv</th>");
print("  <th bgcolor=\"#B7B7DB\">$Pdv</th>");
print("  <th bgcolor=\"#B7B7DB\">$Att</th>");
print("  <th bgcolor=\"#B7B7DB\">$Esq</th>");
print("  <th bgcolor=\"#B7B7DB\">$Deg</th>");
print("  <th bgcolor=\"#B7B7DB\">$Reg</th>");
print("  <th bgcolor=\"#B7B7DB\">$Arm</th>");
print("  <th bgcolor=\"#B7B7DB\">$Vue</th>");
print("</tr>");
print("</table>");
print("<table align=\"center\" width=\"560\" border=\"0\" cellspacing=\"1\" bgcolor=\"#000000\">");
print("<tr align=\"center\">");
print("  <th align=\"center\" width=\"220\" bgcolor=\"#1AC611\">Cap. Spéc.</th>");
print("  <th align=\"center\" width=\"340\" bgcolor=\"#1AC611\">Affecte</th>");
print("</tr>");
print("<form name=\"valid_cdm\" action=\"validcdm.php\" method=\"POST\" >");
print("<tr align=\"center\">");
// print("  <th bgcolor=\"#B7B7DB\">&nbsp;".htmlentities($Cap)."&nbsp;</th>");
// print("  <th bgcolor=\"#B7B7DB\">&nbsp;".htmlentities($Aff)."&nbsp;</th>");
print("  <th bgcolor=\"#B7B7DB\"><INPUT TYPE=INPUT NAME=\"Cap\" VALUE=\"".htmlentities($Cap)."\"></INPUT></th>");
print("  <th bgcolor=\"#B7B7DB\"><INPUT TYPE=INPUT NAME=\"Aff\" VALUE=\"".htmlentities($Aff)."\"></INPUT></th>");
print("</tr>");
print("</table>");
print("<table align=\"center\" width=\"250\" border=\"0\" cellspacing=\"1\" bgcolor=\"#000000\">");
print("  <th align=\"center\" width=\"100\" bgcolor=\"#FF9966\">Date</th>");
print("  <th align=\"center\" width=\"150\" bgcolor=\"#FF9966\">Source</th>");
print("</tr>");
print("<tr align=\"center\">");
print("  <th bgcolor=\"#B7B7DB\">$Date</th>");
// print("  <th bgcolor=\"#B7B7DB\">".$Src."</th>");
print("  <th bgcolor=\"#B7B7DB\"><INPUT TYPE=INPUT NAME=\"Src\" VALUE=\"".htmlentities($Src)."\"></INPUT></th>");
print("</tr>");
print("</table>");
print("<p>&nbsp;</p>");
print("<INPUT TYPE=HIDDEN NAME=\"Monstre\" VALUE=\"$Monstre\"></INPUT>");
print("<INPUT TYPE=HIDDEN NAME=\"Age\" VALUE=\"$Age\"></INPUT>");
print("<INPUT TYPE=HIDDEN NAME=\"Nom\" VALUE=\"$Nom\"></INPUT>");
print("<INPUT TYPE=HIDDEN NAME=\"Race\" VALUE=\"$Race\"></INPUT>");
print("<INPUT TYPE=HIDDEN NAME=\"Famille\" VALUE=\"$Famille\"></INPUT>");
print("<INPUT TYPE=HIDDEN NAME=\"Niv\" VALUE=\"$Niv\"></INPUT>");
print("<INPUT TYPE=HIDDEN NAME=\"Pdv\" VALUE=\"$Pdv\"></INPUT>");
print("<INPUT TYPE=HIDDEN NAME=\"Att\" VALUE=\"$Att\"></INPUT>");
print("<INPUT TYPE=HIDDEN NAME=\"Esq\" VALUE=\"$Esq\"></INPUT>");
print("<INPUT TYPE=HIDDEN NAME=\"Deg\" VALUE=\"$Deg\"></INPUT>");
print("<INPUT TYPE=HIDDEN NAME=\"Reg\" VALUE=\"$Reg\"></INPUT>");
print("<INPUT TYPE=HIDDEN NAME=\"Arm\" VALUE=\"$Arm\"></INPUT>");
print("<INPUT TYPE=HIDDEN NAME=\"Vue\" VALUE=\"$Vue\"></INPUT>");
//print("<INPUT TYPE=HIDDEN NAME=\"Date\" VALUE=\"$DateSql\"></INPUT>");
// print("<INPUT TYPE=HIDDEN NAME=\"Src\" VALUE=\"$Src\"></INPUT>");
// print("<INPUT TYPE=HIDDEN NAME=\"Cap\" VALUE=\"$Cap\"></INPUT>");
// print("<INPUT TYPE=HIDDEN NAME=\"Aff\" VALUE=\"$Aff\"></INPUT>");
print("<INPUT TYPE=submit Value=\"Confirmer\"></input>");
print("</form>");
print("</div>");
print("</body>");
print("</html>");
?>

