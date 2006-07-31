<?PHP

die("ERREUR : fichier de dev pour restauration de la table uniquement");

require_once ("../inc_connect.php3"); // connexion à la base
require_once ("./DB/inc_initdata.php");     // recup des données statiques

/******************************************************************************
*                                                                             *
* make_racetemplate_from_monstre: construit la table indexant les templates   *
*   sur les races en fonction des données de la table best_monstres           *
*   utile qu'à des fins de développement                                      *
*                                                                             *
* Copyright (C) 2005  Cormyr (cormyr@cat-the-psion.net)                       *
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

global $best_races,$best_templates;



while(list($race,$tab_race)=each($best_races)){ // on passe en revue toutes les races connues
  $id_race=$tab_race['id_race'];
  $id_template=0;
  $sql="SELECT * FROM `best_monstres` WHERE `id_race_monstre`=\"".$id_race."\" ORDER BY `id_template_monstre`";
  $query=mysql_query($sql,$db_vue_rm); 
  if(!$query) die("Erreur lors de la requête sur la table des monstres : $sql");
  while($tab_monstre=mysql_fetch_array($query)){ // tous les templates pour cette race
    if($tab_monstre['id_template_monstre']!=$id_template){ // template différent du précédent examiné
      $id_template=$tab_monstre['id_template_monstre'];
      // on vérifie si il est déjà dans la base
      $sql="SELECT * FROM `best_racetemplate` WHERE `id_race_racetemplate`=\"".$id_race."\" AND `id_template_racetemplate`=\"".$id_template."\"";
      $query2=mysql_query($sql,$db_vue_rm);
      if(!$query2) die("Erreur lors de la requête sur la table racetemplate : $sql");
      if(mysql_numrows($query2)===0){ // cette entrée n'existe pas, l'association race/template n'est pas connue
	$sql="INSERT INTO best_racetemplate(id_race_racetemplate,id_template_racetemplate) VALUES(\"".$id_race."\",\"".$id_template."\")";
	$query2=mysql_query($sql,$db_vue_rm);
	if(!$query2) die("insertion du nouveau couple $id_race/$id_template a échoué : $sql");
	else print("insertion de $id_race(".$race.")/$id_template (".$best_templates[$id_template]['nom_template'].")<br>");
      }
    } 
    // si même template que le précédent, couple déjà examiné, on ne fait rien, on passe au suivant
  }
}

?>
