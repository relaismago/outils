<?PHP

include('../top.php');

/******************************************************************************
*                                                                             *
* allniv - affiche tous les templates d'un certain niveau                     *
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

if (isset($_GET['Niv'])) $Niv=stripslashes($_GET['Niv']); else $Niv="-1";

print("<div align='center'>");
print("<p>");
afficheMenuBestiaire($Niv,'');
print("</p>");
print("<p>");
print("<form name=\"niveau\">");
print("<table border=\"0\" cellspacing=\"0\" class='mh_tdborder'>");
print("<tr align='center' class='mh_tdpage'>");
print("  <td align=right>Niveau recherché :</td>");
print("  <td align=left><input name=\"Niv\" type=\"text\" size=\"8\" value=\"$Niv\"/></td>");
print("</tr>");
print("<tr align='center' class='mh_tdpage'>");
print("  <td colspan=2><INPUT type=submit action='allniv.php' class='mh_form_submit' method=GET value=\"vas-y cherche...\"/></td>");
print("</tr>");
print("</table>");
print("</form>");
print("</p>");
print("</div>");

if($Niv!="-1"){
  print("<br><br><table class='mh_tdborder' align='center' width='80%'>");
  print("<tr class='mh_tdtitre'><td align='center'><font size=+2><b>Monstres de niveau $Niv déterminé par croisement de CdMs</b></font></td></tr>");

  print("");
  // on commence par afficher les monstres qui ont le bon niveau
  $sqlmonstre="SELECT * FROM `best_monstres` WHERE `nivsom_monstre`!=0 ORDER BY `id_race_monstre` ASC ";
  $querymonstre=mysql_query($sqlmonstre,$db_vue_rm);
  if(!$querymonstre) die("Erreur lors de l'accès à la table des monstres - $sqlmonstre:".mysql_error());
  while($monstre=mysql_fetch_array($querymonstre)){
    if(round($monstre['nivsom_monstre']/$monstre['nivnbr_monstre'])==$Niv){
      $sqlrace="SELECT `nom_race` FROM `best_races` WHERE `id_race`=".$monstre['id_race_monstre']." LIMIT 1";
      $queryrace=mysql_query($sqlrace,$db_vue_rm);
      if(!$queryrace) die("Erreur lors de l'accès à la table des races - $sqlrace:".mysql_error());
      $race=mysql_fetch_array($queryrace);
      print("<tr class='mh_tdpage'><td align='center'><a href=\"bestiaire.php?Race=".urlencode($race[0])."&Template=".$monstre['id_template_monstre']."&IDAge=".$monstre['id_age_monstre']."\">".$monstre['nom_monstre']."</a></td></tr>");
    }
  }
  print("</table><br><br>");

  // maintenant on va calculer
  // on récupère d'abord l'âge d'ordre max
  $sqlage="SELECT * FROM `best_ages` ORDER  BY `ordre_age` DESC Limit 1";
  $queryage=mysql_query($sqlage,$db_vue_rm);
  if(!$queryage) die("Erreur lors de l'accès à la table des âges - $sqlage:".mysql_error());

  // puis les templates
  $sqltemplate="SELECT * FROM `best_templates` ORDER  BY `modif_niveau_template` DESC Limit 1";
  $querytemplate=mysql_query($sqltemplate,$db_vue_rm);
  if(!$querytemplate) die("Erreur lors de l'accès à la table des template - $sqltemplate:".mysql_error());

  // on détermine le modificateur max pour limiter le nombre de races examinées
  $age=mysql_fetch_array($queryage);
  $modifmax=$age['ordre_age'];
  $template=mysql_fetch_array($querytemplate);
  $modifmax+=$template['modif_niveau_template'];

  $nivmin=$Niv-$modifmax;
  $nivmax=$Niv;

  print("<table class='mh_tdborder' align='center' width='80%'>");
  print("<tr class='mh_tdtitre'><td align='center'><font size=+2><b>Monstres au template connu et au niveau estimé à $Niv (en fonction des connaissances actuelles)</b></font></td></tr>");


  // On récupère toutes les races
  $sqlrace="SELECT * FROM `best_races` WHERE `niv_base` <=$nivmax AND `niv_base` >=$nivmin ORDER  BY `nom_race` ASC ";
  $queryrace=mysql_query($sqlrace,$db_vue_rm);
  if(!$queryrace) die("Erreur lors de l'accès à la table des races - $sqlrace:".mysql_error());

  print("");
  // et on boucle
  while($race=mysql_fetch_array($queryrace)){
    // on récupère les âges candidats
    $nivminage=$Niv-$race['niv_base'];
    $nivmaxage=$race['niv_base'];
    $sqlage="SELECT * FROM `best_ages` WHERE `id_famille_age`=".$race['id_famille_race']." AND `ordre_age` <=$nivmaxage AND `ordre_age` >=$nivminage ORDER  BY `ordre_age` ASC ";
    $queryage=mysql_query($sqlage,$db_vue_rm);
    if(!$queryage) die("Erreur lors de l'accès à la table des âges - $sqlage:".mysql_error());
    while($age=mysql_fetch_array($queryage)){
      $nivtemp=$Niv-$race['niv_base']-$age['ordre_age'];
      $sqlracetemplate="SELECT * FROM `best_racetemplate` WHERE `id_race_racetemplate`=".$race['id_race']." ORDER BY `id_template_racetemplate` ASC ";
      $queryracetemplate=mysql_query($sqlracetemplate,$db_vue_rm);
      if(!$queryracetemplate) die("Erreur lors de l'accès à la table des races/templates - $sqlracetemplate:".mysql_error());
      while($racetemplate=mysql_fetch_array($queryracetemplate)){
	$sqltemplate="SELECT * FROM `best_templates` WHERE `id_template`=".$racetemplate['id_template_racetemplate']." AND `modif_niveau_template`=$nivtemp";
	$querytemplate=mysql_query($sqltemplate,$db_vue_rm);
	if(!$querytemplate) die("Erreur lors de l'accès à la table des template - $sqltemplate:".mysql_error());
	if(mysql_numrows($querytemplate)>0){
	  $template=mysql_fetch_array($querytemplate);
	  $monstrename=makeMonsterName($race['nom_race'],$template['id_template'],$age[$race['genre_race'].'_age']);
	  if($monstrename) print("<tr class='mh_tdpage'><td align='center'><a href=\"bestiaire.php?Race=".urlencode($race['nom_race'])."&Template=".$template['id_template']."&IDAge=".$age['id_age']."\">".$monstrename."</a></td></tr>");
	}
      }
    }
  }
  print("</table><br><br>");


  print("<table class='mh_tdborder' align='center' width='80%'>");
  print("<tr class='mh_tdtitre'><td align='center'><font size=+2><b>Monstres possibles au niveau estimé à $Niv (en fonction des connaissances actuelles)</b></font></td></tr>");

  // On récupère toutes les races
  $sqlrace="SELECT * FROM `best_races` WHERE `niv_base` <=$nivmax AND `niv_base` >=$nivmin ORDER  BY `nom_race` ASC ";
  $queryrace=mysql_query($sqlrace,$db_vue_rm);
  if(!$queryrace) die("Erreur lors de l'accès à la table des races - $sqlrace:".mysql_error());

  print("");
  // et on boucle
  while($race=mysql_fetch_array($queryrace)){
    // on récupère les âges candidats
    $nivminage=$Niv-$race['niv_base'];
    $nivmaxage=$race['niv_base'];
    $sqlage="SELECT * FROM `best_ages` WHERE `id_famille_age`=".$race['id_famille_race']." AND `ordre_age` <=$nivmaxage AND `ordre_age` >=$nivminage ORDER  BY `ordre_age` ASC ";
    $queryage=mysql_query($sqlage,$db_vue_rm);
    if(!$queryage) die("Erreur lors de l'accès à la table des âges - $sqlage:".mysql_error());
    while($age=mysql_fetch_array($queryage)){
      $nivtemp=$Niv-$race['niv_base']-$age['ordre_age'];
      $sqltemplate="SELECT * FROM `best_templates` WHERE `modif_niveau_template`=$nivtemp ORDER BY `id_template` ASC ";
      $querytemplate=mysql_query($sqltemplate,$db_vue_rm);
      if(!$querytemplate) die("Erreur lors de l'accès à la table des template - $sqltemplate:".mysql_error());
      while($template=mysql_fetch_array($querytemplate)){
	$monstrename=makeMonsterName($race['nom_race'],$template['id_template'],$age[$race['genre_race'].'_age']);
	if($monstrename) print("<tr class='mh_tdpage'><td align='center'><a href=\"bestiaire.php?Race=".urlencode($race['nom_race'])."&Template=".$template['id_template']."&IDAge=".$age['id_age']."\">".$monstrename."</a></td></tr>");
      }
    }
  }
  print("</table><br><br>");
}


include('../foot.php');

?>
