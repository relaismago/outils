<?PHP

/******************************************************************************
*                                                                             *
* inc_initdate - fichier pour l'intialisation des donnÃes statiques a partir  * 
*                des tables de la base                                        *
* Copyright (C) 2004  Cormyr (cormyr@cat-the-psion.net)                       *
* Copyright (C) 2004  Subigard                                                *
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

  //require_once ("../../inc_connect.php3"); // connexion à la base

global $db_vue_rm;
//
// Enregistrement des races dans un tableau global
// $best_races[nom_race]=race[]
//
$GLOBALS['best_races']=array(); // le tableau global
//$sql="SELECT * FROM `best_races` ORDER by `id_race`;"; // la requête permettant de les récupérer
// Edit Bodega : Correction bug 110 TrollForge, Order by nom_race au lieu de id_race
$sql="SELECT * FROM `best_races` ORDER by `nom_race`;"; // la requête permettant de les récupérer
if($query=mysql_query($sql,$db_vue_rm)){
  while($ret=mysql_fetch_array($query)){ // stocker toutes les races dans le
    $best_races[$ret[2]]=$ret;           // tableau global indexé par le nom
  }
}
else die("Erreur sur les races :".mysql_error());

//
// Enregistrement des templates dans un tableau global
// $best_templates[id_template]=template[]
//
$GLOBALS['best_templates']=array();
$sql="SELECT * FROM `best_templates` ORDER by `id_template`;"; // la requête permettant de les récupérer
if($query=mysql_query($sql,$db_vue_rm)){
  while($ret=mysql_fetch_array($query)){ // stocker tous les templates dans le
    $best_templates[$ret[0]]=$ret;       // tableau global des templates indexé par la clef
  }
}
else die("Erreur sur les templates :".mysql_error());

//
// Enregistrement des familles dans un tableau global
// $best_familles[nom_famille]=id_famille
//
$GLOBALS['best_familles']=array();
$sql="SELECT * FROM `best_familles` ORDER by `id_famille`;"; // la requête permettant de les récupérer
if($query=mysql_query($sql,$db_vue_rm)){ // stocker tous les templates dans le
  while($ret=mysql_fetch_array($query)){     // tableau global des familles indexé par le nom
    $best_familles[$ret[1]]=$ret[0];         // $ret[0]=id_template - $ret[1]=nom_template
  }
}
else die("Erreur sur les templates :".mysql_error());

//
// Enregistrement des ages dans trois tableaux globaux de la forme :
// $best_ages[id_age]                       = age[]
// $best_ages_nom[id_famille][genre][ordre] = nom_age
// $best_ages_id[id_famille][nom_age]       = id_age
//
$GLOBALS['best_ages']=array();
$GLOBALS['best_ages_nom']=array();
$GLOBALS['best_ages_id']=array();
foreach($best_familles as $id_famille){
  $best_ages_nom[$id_famille]     =array();
  $best_ages_nom[$id_famille]['M']=array();
  $best_ages_nom[$id_famille]['F']=array();
  $best_ages_id[$id_famille]  =array();
}
$sql="SELECT * FROM `best_ages` ORDER by `id_famille_age`;"; // la requête permettant de les récupérer
if($query=mysql_query($sql,$db_vue_rm)){
  while($ret=mysql_fetch_array($query)){ // 
    $best_ages[$ret[0]]=$ret;
    $best_ages_nom[$ret[1]]['M'][$ret[4]]=$ret[2]; // $ret[1]=id_famille, $ret[4]=ordre et $ret[2]=nom_masc
    $best_ages_nom[$ret[1]]['F'][$ret[4]]=$ret[3]; // $ret[1]=id_famille, $ret[4]=ordre et $ret[2]=nom_fem
    $best_ages_id[$ret[1]][$ret[2]]=$ret[0];       // id de l'âge masc pour cette famille
    $best_ages_id[$ret[1]][$ret[3]]=$ret[0];       // id de l'âge femi pour cette famille
  }
}
else die("Erreur sur les âges :".mysql_error());


//
// Enregistrement des templates des races dans un tableau global
// $best_racetemplates[id_race][]=id_template
//
$GLOBALS['best_racetemplate']=array();
foreach($best_races as $race) $best_racetemplate[$race['id_race']]=array();
$sql="SELECT * FROM `best_racetemplate` ORDER by `id_race_racetemplate`;"; // la requête permettant de les récupérer
if($query=mysql_query($sql,$db_vue_rm)){
  while($ret=mysql_fetch_array($query)){ // on parcours la base
    $best_racetemplate[$ret['id_race_racetemplate']][]=$ret['id_template_racetemplate']; 
  }
}
else die("Erreur sur les racetemplates :".mysql_error());


?>
