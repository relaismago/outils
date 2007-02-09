<?PHP

/******************************************************************************
*                                                                             *
* Functions - fonctions pour le bestiaire (bestiaire.php)                     *
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

//
// function extract_racename
// extrait le nom de la race d'un monstre en fonction du template donné
// $template = expression régulière de remplacement décrivant le template
// $race     = expression régulière de recherche décrivant la race
// $monstre  = nom du monstre (sans l'âge) tel que extrait de la cdm
// return : le nom de la race extrait du nom du monstre en fonction des regexp 
//
function extract_racename($template,$race,$monstre)
{
  // la regexp de remplacement décrivant le template est transformée en regexp de recherche
  $tempregexp=str_replace('\1','(.+)',$template);
  // la regexp de recherche décrivant la race est transformée en regexp de remplacement
  $raceregexp=str_replace('(.+)',"\\1",$race);
  // on effectue le chercher/remplacer
  return ereg_replace($tempregexp,$raceregexp,$monstre);
}

//
// function splitmonstre_racetemplate($monstre,&$race)
// prend le libellé d'un monstre (sans l'âge) et en extrait la race et le template
// $monstre : le libellé du monstre
// return : un tableau décrivant le template (cf format de la base)
//          $race affecté du nom de la race
//
function splitmonstre_racetemplate($monstre,&$race)
{
  global $best_races,$best_templates,$db_vue_rm;

  $trouve=false;
  $race=$monstre;    // la race = le monstre (sans l'âge) pour initialiser le processus
  $template=$best_templates[1]; // on traite le premier cas à part car c'est le cas où le template est la race
  $trouve=array_key_exists($race,$best_races); // cette race existe-t-elle ?
  while( !$trouve && ($template=next($best_templates))){ // examen des templates pour trouver le nom de la race
    // cas masculin 
    // on extrait le nom de la race depuis le nom du monstre en fonction du template courant
    $race=extract_racename($template['regexp_masc_template'],$template['racem_template'],$monstre);
    $trouve=array_key_exists($race,$best_races); // cette race existe-t-elle ?
    if(!$trouve){   // cas féminin
      $race  =extract_racename($template['regexp_fem_template'],$template['racef_template'],$monstre);
      $trouve=array_key_exists($race,$best_races); // cette race existe-t-elle ?
    }
  }
  reset($best_templates); // si on ne le fait pas, un deuxième appel successif pour une recherche peut renvoyer une
			  // fausse info, la recherche pouvant échouer car le pointeur du tableau pas au début.
  if(!$trouve) $template=false;
  return $template;
}

//
// Transforme un timestamp mysql en date affichable
//
function mysqltimestamp_date($timestamp)
{ 
   $hour = substr($timestamp, 8, 2); 
   $minute = substr($timestamp, 10, 2);
   $second = substr($timestamp, 12, 2);
   $month = substr($timestamp, 5, 2);
   $day = substr($timestamp, 8, 2);
   $year = substr($timestamp, 0, 4);
   return $day."/".$month."/".$year;
   //mktime($hour, $minute, $second, $month, $day, $year);
}


function date_mysqltimestamp($date)
{
  $ts=explode('-',$date);
  return $ts[0].$ts[1].$ts[2]."000000";
}


// makeTemplateName(,$race,$idtemplate)
// Input $race       : nom de la race
//       $idtemplate : id du template
// Return : le nom du monstre en tenant compte de sa race et du template mais
//          pas de l'âge
//
function makeTemplateName($race,$idtemplate)
{
  global $best_races,$best_templates;
  $monstre=false;
  if($race=="-1") $race='Abishaii Bleu';
  if($idtemplate=="-1") $monstre=$race." (?)";
  else{
    if($best_races[$race]['genre_race']=='M'){
      $regexp_race=$best_templates[$idtemplate]['racem_template'];
      $regexp_temp=$best_templates[$idtemplate]['regexp_masc_template'];
    }
    else{
      $regexp_race=$best_templates[$idtemplate]['racef_template'];
      $regexp_temp=$best_templates[$idtemplate]['regexp_fem_template'];
    }
    if(ereg($regexp_race,$race)) $monstre=ereg_replace($regexp_race,$regexp_temp,$race);
  }
  return $monstre;
}

// makeMonsterName(,$race,$idtemplate,$age)
// Input $race       : nom de la race
//       $idtemplate : id du template
//       $age        : âge du monstre
// Return : le nom complet du monstre en tenant compte de sa race, son template
//          et son âge
//
function makeMonsterName($race,$idtemplate,$age)
{
  $monstre=makeTemplateName($race,$idtemplate);
  if($monstre){
    if(($age=='')||($age=="-1")) $monstre.=" [?]";
    else                         $monstre.=" [".$age."]";
  }
  return $monstre;
}

function nommh2gif($nom)
{
  return strtr($nom,"éèêàèùûïî","eeeaeuuii").".gif";
}


//
// function estimeNivMonstre($Race,$id_template,$id_age)
// cette fonction renvoie le niveau estimé du monstre
//  Race        : nom de la race, -1 si inconnue
//  id_template : id du template du monstre, -1 si inconnu
//  id_age      : id de l'âge du monstre, -1 si inconnu
//
function estimeNivMonstre($Race,$id_template,$id_age)
{
  global $best_races,$best_templates,$best_ages;
  $niv_estim="?";
  if(($Race!="-1")&&($best_races[$Race]['niv_base']>0)){
    $niv_estim=$best_races[$Race]['niv_base'];
    if ($id_template!="-1") $niv_estim+=$best_templates[$id_template]['modif_niveau_template'];
    if ($id_age!="-1")      $niv_estim+=$best_ages[$id_age]['ordre_age'];
  }
  return $niv_estim;
}



//
// getInfoFromMonstre($Monstre)
// récupère toutes les infos de ce monstre en fonction du monstre (nom complet
// avec l'âge)
//   Monstre : nom du monstre (race et template mais pas l'âge)
//   Age     : nom de l'âge
// --> Retour false si données d'entrée incohérentes
//     sinon un tableau contenant diverses infos
//           $ret['monstre']	 = nom du monstre (celui passé en paramètre)
//           $ret['id_race']	 = id de la race
//           $ret['race']   	 = nom de la race
//           $ret['genre']   	 = genre de la race
//           $ret['id_age'] 	 = id de l'âge
//           $ret['age']    	 = nom de l'âge
//           $ret['id_template'] = id du template
//           $ret['id_famille']  = id de la famille
//           $ret['famille']     = nom de la famille 
//
function getInfoFromMonstre($NomCreature)
{
  // $best_races[nom_race]                    = race[]
  // $best_familles[nom_famille]              = id_famille
  // $best_ages_nom[id_famille][genre][ordre] = nom_ag
  // $best_ages_id[id_famille][nom_age]       = id_age
  global $best_races,$best_familles,$best_ages_nom,$best_ages_id;
  $s=preg_split("/[\[\]]/",$NomCreature);
  $Monstre=trim($s[0]);
  $Age=trim($s[1]);
  $ret=array();
  $ret['monstre']=$Monstre;
  $ret['age']    =$Age;
  $ret['race']   =$Monstre;
  $desc_template=splitmonstre_racetemplate($Monstre,$ret['race']);  // $Race est une valeur de retour
  if($desc_template){
    $ret['id_race']    =$best_races[$ret['race']]['id_race'];
    $ret['id_template']=$desc_template['id_template'];         // id du template
    $ret['id_famille'] =$best_races[$ret['race']]['id_famille_race']; // id de la famille donnée par la race
    $ret['genre']      =$best_races[$ret['race']]['genre_race'];      // genre ('M','F') de la race
    $ret['famille']    =array_search($ret['id_famille'],$best_familles); // nom de la famille
    // on recherche l'id de l'âge :
    $tab_ages=$best_ages_nom[$ret['id_famille']][$ret['genre']];
    if(in_array($Age,$tab_ages)){
      $ret['id_age']=$best_ages_id[$ret['id_famille']][$Age];
    }
    else $ret=false; // ce nom d'âge est inconnu pour cette race
  }
  else $ret=false; // Monstre totalement inconnu, impossible d'en analyser le nom
  if($ret) $ret['niv']=estimeNivMonstre($ret['race'],$ret['id_template'],$ret['id_age']);
  return $ret;
}


//
// SelectCapSpe($id_race,$id_template,$id_age)
// retourne un tableau (correspondant à la table) décrivant la capspe d'un monstre 
// selon sa race, son template et son age
//   id_race     : id de la race
//   id_template : id du template
//   id_age      : id de l'âge
// --> retour False si ce monstre n'a pas de capspe ou si il y a une erreur dans la requête
//            tableau décrivant la capspe sinon
function SelectCapSpe($id_race,$id_template,$id_age)
{
	global $db_vue_rm;
  $sql="SELECT * from `best_capspe` WHERE `id_race_capspe`=".$id_race." AND `id_template_capspe`=".$id_template." AND `id_age_capspe`=".$id_age." LIMIT 1";
  $query=mysql_query($sql,$db_vue_rm);
  if(!$query) $ret=false;
  else{
    if(mysql_numrows($query)==0) $ret=false;
    else $ret=mysql_fetch_array($query);
  }
  return $ret;
}


//
// SelectCapSpeMonstre($id_monstre)
// retourne un tableau (correspondant à la table) décrivant la capspe d'un monstre 
// selon son id
//   id_monstre : id du monstre
// --> retour False si ce monstre n'a pas de capspe ou si il y a une erreur dans la requête
//            tableau décrivant la capspe sinon
function SelectCapSpeMonstre($id_monstre)
{
  $sql="SELECT * from `best_capspe` WHERE `id_monstre_capspe`=".$id_monstre." LIMIT 1";
  $query=mysql_query($sql,$db_vue_rm);
  if(!$query) $ret=false;
  else{
    if(mysql_numrows($query)==0) $ret=false;
    else $ret=mysql_fetch_array($query);
  }
  return $ret;
}


// carac_monstre
// calcule la carac moyenne d'un monstre
// renvoie '?' si aucune carac déjà calculée, la carac moyenne sinon
function carac_monstre($caracsom,$caracnbr)
{
  if($caracnbr==0) $carac='?';
  else             $carac=round($caracsom/$caracnbr);
  return $carac;
}


//
// SelectCaracMoyMonstre($id_race,$id_template,$id_age)
// renvoie les caractéristiques moyennes du monstre en fonction de sa race, template, age
//   id_race     : id de la race du monstre
//   id_template : id du template du monstre
//   id_age      : id de l'age du monstre
// --> retour false si on n'arrive pas à retrouver ce monstre en fonction des paramètres
//            tableau contenant les caracs moyenne ou '?' si celle-ci n'est pas connu, les indices sont :
//            ['niv']['pdv']['att']['esq']['deg']['reg']['arm']['vue']
function SelectCaracMoyMonstre($id_race,$id_template,$id_age)
{
	global $db_vue_rm;
  // on établit la requête cherchant le monstre avec ces caractéristiques
  $sql="SELECT * FROM `best_monstres` WHERE `id_race_monstre`=$id_race"; // la race
  $sql.=" AND `id_template_monstre`=$id_template"; // on complète par le template
  $sql.=" AND `id_age_monstre`=$id_age";// et on rajoute l'âge
  if($query=mysql_query($sql,$db_vue_rm)){
    if(mysql_numrows($query)>0){
      $monstre=mysql_fetch_array($query);

/*      $ret['niv']=carac_monstre($ret['nivsom_monstre'],$ret['nivnbr_monstre']);
      $ret['pdv']=carac_monstre($ret['pdvsom_monstre'],$ret['pdvnbr_monstre']);
      $ret['att']=carac_monstre($ret['attsom_monstre'],$ret['attnbr_monstre']);
      $ret['esq']=carac_monstre($ret['esqsom_monstre'],$ret['esqnbr_monstre']);
      $ret['deg']=carac_monstre($ret['degsom_monstre'],$ret['degnbr_monstre']);
      $ret['reg']=carac_monstre($ret['regsom_monstre'],$ret['regnbr_monstre']);
      $ret['arm']=carac_monstre($ret['armsom_monstre'],$ret['armnbr_monstre']);
      $ret['vue']=carac_monstre($ret['vuesom_monstre'],$ret['vuenbr_monstre']);      
*/		
/* Correction Bodéga : $montre à la place de $ret */
      $ret['niv']=carac_monstre($monstre['nivsom_monstre'],$monstre['nivnbr_monstre']);
      $ret['pdv']=carac_monstre($monstre['pdvsom_monstre'],$monstre['pdvnbr_monstre']);
      $ret['att']=carac_monstre($monstre['attsom_monstre'],$monstre['attnbr_monstre']);
      $ret['esq']=carac_monstre($monstre['esqsom_monstre'],$monstre['esqnbr_monstre']);
      $ret['deg']=carac_monstre($monstre['degsom_monstre'],$monstre['degnbr_monstre']);
      $ret['reg']=carac_monstre($monstre['regsom_monstre'],$monstre['regnbr_monstre']);
      $ret['arm']=carac_monstre($monstre['armsom_monstre'],$monstre['armnbr_monstre']);
      $ret['vue']=carac_monstre($monstre['vuesom_monstre'],$monstre['vuenbr_monstre']);     

    }
    else $ret=false;
  }
  else $ret=false; // Erreur lors de la requête sur le monstre
  return $ret;
}

//
// SelectMonstre($Race,$IDTemplate,$IDAge)
// sélectionne un monstre en fonction des paramètres passés en argument
//   Race       : nom de la race dont on doit afficher les CdMs
//   IDTemplate : Id du template du monstre
//   IDAge      : Id de l'age
//   Age        : nom de l'age
// 
// Retour : un tableau de 3 valeurs contenant le monstre, sa capspe et ses caracs.
//          les tableaux capspe et caracs sont vides si il n'en a pas
//          tab_monstre['monstre'] ; tab_monstre['capspe'] ; tab_monstre['caracs']
//
function SelectMonstre($Race,$IDTemplate,$IDAge,$Age)
{
  global $best_races,$db_vue_rm;
  $tab_monstre=array();
  $tab_monstre['monstre']=array();
  $tab_monstre['capspe']=array();
  $tab_monstre['caracs']=array();
  if( ($Race=="-1")||($IDTemplate=="-1")||($IDAge=="-1") ) return $tab_monstre;
  // on commence par rechercher les id de la race et de l'âge passés en paramètre
  $id_race_cdm=$best_races[$Race]['id_race'];
  $id_famille =$best_races[$Race]['id_famille_race'];
  // on établit la requête cherchant le monstre avec ces caractéristiques
  $sql="SELECT * FROM `best_monstres` WHERE `id_race_monstre`=$id_race_cdm"; // la race
  $sql.=" AND `id_template_monstre`=$IDTemplate"; // on complète par le template
  $sql.=" AND `id_age_monstre`=$IDAge";// et on rajoute l'âge
  if(!($query=mysql_query($sql,$db_vue_rm))) die("Erreur lors de la requête sur le monstre :".mysql_error());
  else if(mysql_numrows($query)>0){
    $tab_monstre['monstre']=mysql_fetch_array($query); // on récupère le monstre correspondant
    // on rajoute le nom de la race
    $tab_monstre['monstre']['nom_race']=$Race;
    // on ne teste pas le retour de makeMonsterName car on considère que le template passé en paramètre est bon !!!
    $tab_monstre['monstre']['nom_monstre']=makeMonsterName($Race,$IDTemplate,$Age);
    // on vérifie si ce monstre a une capacité spéciale
    $sql="SELECT * FROM `best_capspe` WHERE `id_monstre_capspe`=".$tab_monstre['monstre']['id_monstre'];
    if($query=mysql_query($sql,$db_vue_rm)){
      if(mysql_numrows($query)>0) $tab_monstre['capspe']=mysql_fetch_array($query); // on récupère la capspe
    }
    else die("Erreur lors de la requête sur la capacité spéciale du monstre :".mysql_error());
    // on vérifie si ce monstre a des caracs particulières
    $sql="SELECT * FROM `best_caracs` WHERE `id_monstre_caracs`=".$tab_monstre['monstre']['id_monstre'];
    if($query=mysql_query($sql,$db_vue_rm)){
      if(mysql_numrows($query)>0) $tab_monstre['caracs']=mysql_fetch_array($query); // on récupère la capspe
    }
    else die("Erreur lors de la requête sur les caractéristiques particulières du monstre :".mysql_error());    
  }
  return $tab_monstre;
}

//
// SelectCdM_mh($MH,$IDAge,)
// sélectionne une ou plusieurs cdm en fonction des paramètres passés en argument
// MH         : id MH
// Race       : nom de la race
// IDAge      : Id de l'age
//
function SelectCdM_mh($MH,$Race,$IDAge)
{
  global $db_vue_rm;
  $tab_cdm=array();
  $sql="SELECT * FROM `best_cdms` WHERE `id_mh`=$MH";
  // et on rajoute l'âge si on l'a
  if($IDAge!="-1") $sql.=" AND `id_age_cdm`=$IDAge";
  if($query=mysql_query($sql,$db_vue_rm)){
    while($ret=mysql_fetch_array($query)){ // pour toutes les cdms correspondantes
      $ret['nom_race']=$Race; // on rajoute le nom de la race (seul id_race est présent)
      // on va récupérer également le monstre correspondant à cette cdm
      $sql="SELECT `nom_monstre` FROM `best_monstres` WHERE `id_monstre`=".$ret['id_monstre_cdm'];
      if($query2=mysql_query($sql,$db_vue_rm)){
	$ret2=mysql_fetch_array($query2); // on récupère le nom du monstre
	$ret['monstre']=$ret2[0];        // on complète la cdm avec le nom du monstre
	$tab_cdm[]=$ret;                 // on la rajoute dans la liste des cdms
      }
      else die("Erreur lors de la requête d'un monstre :".mysql_error());
    }
  }
  else die("Erreur lors de la requête des cdms :".mysql_error());
  return $tab_cdm;
}

//
// SelectCdM($Race,$IDTemplate,$IDAge,$Famille,$MH)
// sélectionne une ou plusieurs cdm en fonction des paramètres passés en argument
//   Race       : nom de la race dont on doit afficher les CdMs
//   IDTemplate : Id du template du monstre
//   IDAge      : Id de l'age
//   NegTemplate: Id du template à ne pas sélectionner (si différent de "-1")
//   NegAge     : Id de l'age à ne pas sélectionner (si différent de "-1")
// 
// Ajout d'Bodéga pour le trollometer : $JustLastCdm
//	JustaLastCdm : si true, retourne la dernière cdm enrgistrée uniquement.
// Retour : un tableau de cdm telles que dans la table mais complété par le nom du monstre
//          tab_cdm['monstre']=nom_monstre;
//
function SelectCdMs($Race,$IDTemplate,$IDAge,$NegTemplate,$NegAge,$JustLastCdm = false)
{
  global $best_races,$db_vue_rm;
  $tab_cdm=array();
  // on commence par rechercher l'id de la race passée en paramètre
  $id_race_cdm= $best_races[$Race]['id_race'];
  // on établit la requête cherchant les cdms de cette race
  $sql="SELECT * FROM `best_cdms` WHERE `id_race_cdm`=$id_race_cdm";
  // on complète éventuellement par le template
  if($IDTemplate!="-1") $sql.=" AND `id_template_cdm`=$IDTemplate";
  // et on rajoute l'âge si on l'a
  if($IDAge!="-1") $sql.=" AND `id_age_cdm`=$IDAge";
  // on exclue certaines valeurs
  if($NegTemplate!="-1") $sql.=" AND `id_template_cdm`!=$NegTemplate";
  if($NegAge!="-1")      $sql.=" AND `id_age_cdm`!=$NegAge";
  $sql .= " ORDER BY date_cdm DESC";
	if ($JustLastCdm) {
		$sql .= " LIMIT 1";
	}
	// print("<div align=center>DEBUG: ".$sql."</div>");
  // on peut lancer la requête
  if($query=mysql_query($sql,$db_vue_rm)){
    while($ret=mysql_fetch_array($query)){ // pour toutes les cdms correspondantes
      $ret['nom_race']=$Race; // on rajoute le nom de la race (seul id_race est présent)
      // on va récupérer également le monstre correspondant à cette cdm
      $sql="SELECT `nom_monstre` FROM `best_monstres` WHERE `id_monstre`=".$ret['id_monstre_cdm'];
      if($query2=mysql_query($sql,$db_vue_rm)){
	$ret2=mysql_fetch_array($query2); // on récupère le nom du monstre
	$ret['monstre']=$ret2[0];        // on complète la cdm avec le nom du monstre
	$tab_cdm[]=$ret;                 // on la rajoute dans la liste des cdms
      }
      else die("Erreur lors de la requête d'un monstre :".mysql_error());
    }
  }
  else die("Erreur lors de la requête des cdms : $sql".mysql_error());
  return $tab_cdm;
}
?>
