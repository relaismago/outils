<?PHP
/******************************************************************************
*                                                                             *
* confirmdeathpower - affiche les caracs à valider pour confirmation          *
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
if (isset($_POST['Zone'])) $Zone = stripslashes($_POST['Zone']);
else $Zone="?";
if (isset($_POST['Source'])) $Source = stripslashes($_POST['Source']);
else $Source="R&M";

if( ($Pouvoir!="") && ($Template!="")){
  print("<html>");
  print("<head>");
  print("<title>Confirmation de l'insertion d'un nouveau pouvoir</title>");
  print("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\"></head>");
  print("<body bgcolor=\"#30395D\" text=\"#000000\">");
  print("<div align=\"center\">");
  print(" <table width=\"950\" border=\"0\" cellspacing=\"1\" bgcolor=\"#000000\">");
  print(" <form name=\"form_deathpower\" method=\"POST\" action=\"validpouvoirs.php\">");
  print(" <input type=\"hidden\" name=\"MonstreAge\"     value=\"$MonstreAge\">");
  print(" <input type=\"hidden\" name=\"Race\"     value=\"$Race\">");
  print(" <input type=\"hidden\" name=\"Template\" value=\"$Monstre\">");
  print(" <input type=\"hidden\" name=\"Age\"  	   value=\"$Age\">");
  print(" <input type=\"hidden\" name=\"Nom\"  	   value=\"$MonstreAge\">");
  print(" <caption>		 ");
  print("    <font color=\"#FFFFFF\" size=\"+1\"><b><em>Confirmez vous ce nouveau pouvoir à la mort ?</em></b></font>");
  print(" </caption>");
  print(" <tr align=\"center\">");
  print("   <th align=\"center\" width=32 bgcolor=\"#18D5BD\">Pouvoir</th>");
  print("   <th colspan=2 align=\"center\" width=96 bgcolor=\"#18D5BD\">Description</th>");
  print(" </tr>");
  print(" <tr align=\"center\">");
  print("   <th bgcolor=\"#B7B7DB\">");
  print("     <input name=\"Pouvoir\" width=64 size=32 READONLY value=\"$Pouvoir\"/></th>");
  print("   <th colspan=2 bgcolor=\"#B7B7DB\">");
  print("     <input name=\"Descript\" width=128 size=96 READONLY value=\"$Descript\"/></th>");
  print(" </tr>");
  print(" <tr align=\"center\">");      
  print("   <th align=\"center\" bgcolor=\"#18D5BD\">MM</th>");
  print("   <th align=\"center\" bgcolor=\"#18D5BD\">Durée Malus</th>");
  print("   <th align=\"center\" bgcolor=\"#18D5BD\">Effet de Zone</th>");
  print(" </tr>");						      
  print(" <tr align=\"center\">");			      
  print("   <th bgcolor=\"#B7B7DB\"><input name=\"MM\" width=10 READONLY value=\"$MM\"/></th>");
  print("   <th bgcolor=\"#B7B7DB\"><input name=\"Duree\" width=10 READONLY value=\"$Duree\"/></th>");
  print("   <th bgcolor=\"#B7B7DB\"><input name=\"Zone\" width=10 READONLY value=\"$Zone\"/></th>");
  print(" </tr>");
  print(" <tr align=\"center\">");						      
  print("   <th bgcolor=\"#FF9966\">Date</th>");
  print("   <th bgcolor=\"#FF9966\" colspan=2>source</th>");
  print(" </tr>");
  print(" <tr align=\"center\">");								  
  print("   <th bgcolor=\"#B7B7DB\">");
  print("      <INPUT NAME=\"DatPouvoir\" READONLY TYPE=TEXT VALUE='".date("d/m/Y")."'/>");			
  print("   </th>");												
  print("   <th bgcolor=\"#B7B7DB\" colspan=2>");
  print("      <INPUT NAME=\"Source\" TYPE='TEXT' VALUE=\"$Source\"/>");				      
  print("   </th>");												      
  print(" </tr>");
  print("</form>");
  print(" </table>");
  print(" <p>&nbsp;</p>");							  
  print("<form name=\"valid_deathpower\" action=\"validdeathpower.php\" method=\"POST\" >");
  print("<INPUT TYPE=hidden NAME=\"MonstreAge\" VALUE=\"$MonstreAge\"></INPUT>");
  print("<INPUT TYPE=hidden NAME=\"Template\" VALUE=\"$Template\"></INPUT>");
  print("<INPUT TYPE=hidden NAME=\"Age\" VALUE=\"$Age\"></INPUT>");
  print("<INPUT TYPE=hidden NAME=\"Race\" VALUE=\"$Race\"></INPUT>");
  print("<INPUT TYPE=hidden NAME=\"Pouvoir\" VALUE=\"$Pouvoir\"></INPUT>");
  print("<INPUT TYPE=hidden NAME=\"Descript\" VALUE=\"$Descript\"></INPUT>");
  print("<INPUT TYPE=hidden NAME=\"MM\" VALUE=\"$MM\"></INPUT>");
  print("<INPUT TYPE=hidden NAME=\"Duree\" VALUE=\"$Duree\"></INPUT>");
  print("<INPUT TYPE=hidden NAME=\"Zone\" VALUE=\"$Zone\"></INPUT>");
  print("<INPUT TYPE=hidden NAME=\"Source\" VALUE=\"$Source\"></INPUT>");
  print("<INPUT TYPE=submit Value=\"Confirmer\"/>");
  print("</form>");
  print("</div>");
  print("</body>");
  print("</html>");
}
else{
  print("<html><meta http-equiv=\"refresh\" content=\"1; url=../bestiaire.php?Race=".urlencode($Race)."&Monstre=".urlencode($Template)."&Age=".urlencode($Age)."\"></html>");
}
 

?>
