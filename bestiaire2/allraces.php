<?PHP

include('../top.php');

/******************************************************************************
*                                                                             *
* allraces - affiche toutes les races d'une même famille                      *
* Copyright (C) 2004,2005  Cormyr (cormyr@cat-the-psion.net)                  *
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
require_once("DB/inc_initdata.php");     // recup des données statiques
require_once("Libs/functions.php");      // quelques fonctions
require_once("Libs/inc_affichage.php");  // gestion de l'affichage

//
// Variables globales
//

// $best_races[nom_race]               	    = race[]
// $best_templates[id_template]        	    = template[]
// $best_ages[id_age]                       = age[]
// $best_ages_nom[id_famille][genre][ordre] = nom_age
// $best_ages_id[id_famille][nom_age]  	    = id_age
// $best_racetemplates[id_race][]      	    = id_template
// $best_familles[nom_famille]         	    = id_famille
global $best_races,$best_templates,$best_ages,$best_ages_nom,$best_ages_id,$best_racetemplate,$best_familles;
global $db_vue_rm;

if (isset($_GET['Famille'])) $Famille=stripslashes($_GET['Famille']); else $Famille="-1";

// scripts javascrips pour la gestion des menus et calculs (pxotron)
print("<script language='JavaScript' src='functions.js'></script>");
print("<script language='JavaScript' src='allraces.js'></script>");

print("<div align='center'>");
print("<p>");
afficheMenuBestiaire('',$Famille);
print("</p>");
print("<p>");
print("<form name=\"select_famille\" method=\"GET\" action=\"allraces.php\"/>");
print("<input type=\"hidden\" name=\"Famille\" value=\"$Famille\"/>");
print("<table border=\"0\" cellspacing=\"0\" class='mh_tdborder'>");
print("<tr align='center' class='mh_tdpage'>");
print("  <td align=right>Famille dont on veut connaître les races</td>");
//print("  <td align=left><input name=\"Famille\" type=\"text\" size=\"15\" value=\"$Famille\"/></td>");
print("</tr>");
print("<tr align='center' class='mh_tdpage'>");
print("    <td align=center>");
print("      <select name=\"famille\" onChange=\"FamilleSelectMenu();\">");
print(          showListFamilles($Famille)); // liste des options du menu Race
print("      </select>");
print("    </td>");
//print("  <td colspan=2><INPUT type=submit action='allrace.php' method=GET value=\"vas-y cherche...\"/></td>");
print("</tr>");
print("</table>");
print("</form>");
print("</p>");
print("</div>");

if($Famille!="-1"){
  print("<table class='mh_tdborder' align='center' width='60%'>");
  print("<tr class='mh_tdtitre'><td colspan='100' align='center' nowrap><font size=+2><b>Races appartenant à la famille $Famille</b></font></td></tr>");

  $id_famille=$best_familles[$Famille];
  $sql="SELECT `nom_race` FROM `best_races` WHERE `id_famille_race`=".$id_famille." ORDER BY `nom_race` ASC";
  if(!($query=mysql_query($sql,$db_vue_rm))) die("Erreur lors de l'accès à la table des races - $sql:".mysql_error());
  else{
    while($race=mysql_fetch_array($query)){
      print("<tr class='mh_tdpage'><td align='center'><a href=\"bestiaire.php?Race=".urlencode($race['nom_race'])."\">".$race['nom_race']."</a></td></tr>");

    }
  }
  print("</table>");
}


include('../foot.php');

?>


