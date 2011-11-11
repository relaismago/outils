<?

//require_once("../inc_connect.php3"); // pour test en local (� commenter avant le commit)
include('../top.php');

/******************************************************************************
*                                                                             *
* bestiaire.php - page principale du bestiare - consultation des donn�es      *
*                                             - menu pour ajout/modif         *
*                                                                             *
* Version initiale en html de Kkwet                                           *
* Copyright (C) 2004  Cormyr (cormyr@cat-the-psion.net) - version 2           *
* Copyright (C) 2005  Cormyr (cormyr@cat-the-psion.net) - version 3           *
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

require_once("DB/inc_initdata.php");     // recup des donn�es statiques
require_once("Libs/functions.php");
require_once("Libs/inc_affichage.php");


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

//
// Initialisation des param�tres de la page
//


// Initialisation des variables Race,IDTemplate et Age pour la pr�-s�lection d'un affichage
// on est oblig� d'utiliser stripslashes car certains noms contiennent des
// apostrophes et ils se retrouvent prot�g�s par un \ ce qui fausse ensuite les
// recherches en table.

if (isset($_GET['Race']))     $Race       = stripslashes($_GET['Race']); else $Race="-1";
if (isset($_GET['Template'])) $IDTemplate = stripslashes($_GET['Template']); else $IDTemplate="-1";
if (isset($_GET['IDAge']) && is_numeric($_GET['IDAge']))    $IDAge      = stripslashes($_GET['IDAge']); else $IDAge="-1";
if (isset($_GET['Age']))      $Age        = stripslashes($_GET['Age']); else $Age="-1";
if (isset($_GET['MH']) && is_numeric($_GET['MH']))       $MH         = stripslashes($_GET['MH']); else $MH="-1";
if (isset($_GET['Monstre']))  $Monstre    = stripslashes($_GET['Monstre']); else $Monstre="-1";

//print("DEBUG 1. Race=$Race - Monstre=$Monstre - Template=$IDTemplate - Age=$IDAge - Age=Age  - Famille=$Famille<br>");

//
// on traite d'abord l'id MH, c'est prioritaire et il est suffisant � lui tout seul
//
// on va checher les infos dans la base
$sql="SELECT * FROM `best_cdms` WHERE `id_mh`=$MH";
// on va v�rifier que cet id est bon
$query=mysql_query($sql,$db_vue_rm);
if(!$query) die("Erreur lors d'une requ�te de cdm - $sql:".mysql_error());
if(mysql_numrows($query)>0){ // y en a au moins une, on peut continuer l'analyse
  $ret=mysql_fetch_array($query); // on r�cup�re la premi�re
  $id_famille=$ret['id_famille_cdm']; // l'id de la famille
  $IDTemplate=$ret['id_template_cdm']; // l'id du template
  // on cherche la race
  $sqlrace="SELECT `nom_race` FROM `best_races` WHERE `id_race`=".$ret['id_race_cdm'];
  if($queryrace=mysql_query($sqlrace,$db_vue_rm)){
    $tab_race=mysql_fetch_array($queryrace);
    $Race=$tab_race[0];
  }
  else die("Erreur lors de la requ�te de la race :".mysql_error());
  // si on n'a pas l'id de l'�ge mais seulement son nom, on recherche l'id
  if(($IDAge=="-1")&&($Age!="-1")){
    $tab_ages=$best_ages_nom[$id_famille][$best_races[$Race]['genre_race']];
    if(!in_array($Age,$tab_ages)) $Age="-1";
    else $IDAge=$best_ages_id[$id_famille][$Age];
  }
}
else $MH="-1"; // pas de cdm avec cet id


//
// v�rification de la race
//
if($Race=="-1"){ // race inconnue
  if($Monstre=="-1"){ // le monstre n'est m�me pas connu, on prend une race par d�faut
    $Race='Abishaii Bleu'; // l'Abishaii est le grand gagnant 
  }
  else{ // on va d�terminer la race et le template d'apr�s le monstre.
    $desc_template=splitmonstre_racetemplate($Monstre,$Race);
    if(!$desc_template) die("Monstre totalement inconnu, impossible d'en analyser le nom : $Monstre");
    $IDTemplate=$desc_template['id_template'];
  }
}
$id_famille=$best_races[$Race]['id_famille_race']; // id de la famille donn�e par la race
$genre_race=$best_races[$Race]['genre_race'];      // genre ('M','F') de la race


//
// v�rification de l'�ge
//
$IDAge_select=$IDAge; // on sauvegarde l'Id demand� � des fins d'affichage
$Age_select=$Age;     // m�me chose pour le nom de l'�ge
if($IDAge_select!="-1")    $Age_select=$best_ages[$IDAge_select][$genre_race.'_age']; // priorit� � l'id
else if($Age_select!="-1") $IDAge_select=$best_ages_id[$id_famille][$Age_select];     // id d'apr�s le nom

// v�rification de la validit� de l'�ge
// A-t-on l'ID ? si oui, on le v�rifie et on calcule le nom de l'Age
if($IDAge!="-1"){
  $tab_ages=$best_ages_id[$id_famille]; 
  $Age=array_search($IDAge,$tab_ages); // on v�rifie ainsi que cet �ge est bien associ� � cette famille
  if($Age===false){$IDAge="-1";$Age='';}
}
else if($Age!="-1"){ // sinon, a-t-on au moins le nom de l'�ge ?
  $tab_ages=$best_ages_nom[$id_famille][$genre_race];
  if(!in_array($Age,$tab_ages)) $Age="-1";
	else $IDAge=$best_ages_id[$id_famille][$Age]; 
}

// v�rification du template
$tab_templates=$best_racetemplate[$best_races[$Race]['id_race']];
if(!in_array($IDTemplate,$tab_templates)) $IDTemplate="-1";


$Famille=array_search($id_famille,$best_familles);

//print("DEBUG 2. Race=$Race - Template=$IDTemplate - Age=$Age - IDAge=$IDAge - Famille=$Famille<br>");

// on essaie d'estimer le niveau
$niv_estim=estimeNivMonstre($Race,$IDTemplate,$IDAge);
//  if(($Race!="-1")&&($best_races[$Race]['niv_base']>0)){
//    $niv_estim=$best_races[$Race]['niv_base'];
//    if ($IDTemplate!="-1")        $niv_estim+=$best_templates[$IDTemplate]['modif_niveau_template'];
//    if ($IDAge_select!="-1")      $niv_estim+=$best_ages[$IDAge_select]['ordre_age'];
//  }
//  else $niv_estim="?";

//
// Affichage de la Page du Bestiaire
//

// scripts javascrips pour la gestion des menus et calculs (pxotron)
print("<script language='JavaScript' src='functions.js'></script>");
print("<script language='JavaScript' src='bestiaire.js'></script>");

// les diff�rentes affichage en fonctionfonctionnalit�s offertes par le bestiaire
print("<div align='center'>");
print("<p>");
afficheMenuBestiaire($niv_estim,$Famille);
print("</p>");
print("<p>");
afficheTitreMonstre($Race,$IDTemplate,$Age_select,$Famille,$niv_estim);
print("</p>");
print("<p>");
afficheSelecteursMonstre($Race,$IDTemplate,$IDAge,$Age,$Famille);
print("</p>");
print("<p>");
if($niv_estim!='?') afficheCalculateurPX($niv_estim);
else                afficheCalculateurPX('1');
print("</p>");
print("<p>&nbsp;</p>");
// on peut maintenant afficher les cdms
if($MH!="-1"){
  $tab_cdm=SelectCdM_mh($MH,$Race,$IDAge);
  if(count($tab_cdm)>0){
    print("<p>");
    print("<b>CdM du monstre MH (".$MH.")</b><br>");
    affiche_liste_cdms($tab_cdm);
    print("</p>");
  }
}
if(($Race!="-1")&&($IDTemplate!="-1")&&($IDAge!="-1")){
  $tab_monstre=SelectMonstre($Race,$IDTemplate,$IDAge,$Age);
  if(count($tab_monstre['monstre'])>0){
    print("<p>");
    print("<b>Caract�ristiques moyennes �tablies pour ce monstre</b><br>");
    affiche_monstre($tab_monstre['monstre'],$tab_monstre['capspe'],$tab_monstre['caracs']);
    print("</p>");
  }
  $tab_cdm=SelectCdMs($Race,$IDTemplate,$IDAge,"-1","-1");
  if(count($tab_cdm)>0){
    print("<p>");
    print("<b>CdM m�me race, m�me template et m�me �ge</b><br>");
    affiche_liste_cdms($tab_cdm);
    print("</p>");
  }
}
if(($Race!="-1")&&($IDTemplate!="-1")){ // selection des cdms de m�me template
  $tab_cdm=SelectCdMs($Race,$IDTemplate,"-1","-1",$IDAge);
  if(count($tab_cdm)>0){
    print("<p>");
    if($IDAge!="-1") print("<b>CdM de la m�me race avec le m�me template mais pas le m�me �ge</b><br>");
    else             print("<b>CdM de la m�me race avec le m�me template</b><br>");
    affiche_liste_cdms($tab_cdm);
    print("</p>");
  }
}
if(($Race!="-1")&&($IDAge!="-1")){      // selection des cdms de m�me �ge
  $tab_cdm=SelectCdMs($Race,"-1",$IDAge,$IDTemplate,"-1");
  if(count($tab_cdm)>0){
    print("<p>");
    if($IDTemplate!="-1") print("<b>CdM de la m�me race avec le m�me �ge mais pas le m�me template</b><br>");
    else                  print("<b>CdM de la m�me race avec le m�me �ge</b><br>");
    affiche_liste_cdms($tab_cdm);
    print("</p>");
  }
}
if(($Race!="-1")){
  $tab_cdm=SelectCdMs($Race,"-1","-1",$IDTemplate,$IDAge);
  if(count($tab_cdm)>0){
    print("<p>");
    if(($IDTemplate!="-1")&&($IDAge!="-1"))      print("<b>CdM de la m�me race mais pas les m�mes template et �ge</b><br>");
    else if(($IDTemplate=="-1")&&($IDAge=="-1")) print("<b>CdM de la m�me race</b><br>");
    else if($IDTemplate=="-1")                   print("<b>CdM de la m�me race mais le m�me �ge</b><br>");
    else if($IDAge     =="-1")                   print("<b>CdM de la m�me race mais le m�me template</b><br>");
    affiche_liste_cdms($tab_cdm);
    print("</p>");
  }
}
print("</div>");



include_once('../foot.php');
?>
