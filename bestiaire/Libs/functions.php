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

global $db_bestiaire;

// ShowListRaces($tab_races,$race)
// Input $tab_race : tableau contenant toutes les races
//       $race     : la race pré-sélectionnée
// Return : une chaine html décrivant toutes les options d'un SELECT pour la
//          sélection d'une race
//
function ShowListRaces($tab_races,$race)
{
  $option="";
  while(list($key,$trace)=each($tab_races)){
    if($key==$race) $option.="<option label=\"$key\" value=\"bestiaire.php?Race=$key\" selected>$key</option>";
    else            $option.="<option label=\"$key\" value=\"bestiaire.php?Race=$key\">$key</option>";
  }
  return $option;
}

// ShowListNames($races,$name)
// Input $race     : race des monstres à afficher
//       $monstre  : monstre pré-sélectionné
// Return : une chaine html décrivant toutes les options d'un SELECT pour la
//          sélection d'un monstre de race $race
//
function ShowListNames($race,$name)
{
	global $db_bestiaire;

  $option="";
  $sql="SELECT * FROM `monstres` WHERE `Race`=\"".$race."\";";
  $query=mysql_query($sql,$db_bestiaire);
  while($ret=mysql_fetch_array($query)){
    $option.="<option label=\"".$ret['Monstre']."\" value=\"bestiaire.php?Race=".$race."&Monstre=".$ret['Monstre'];
    if($ret['Monstre']==$name) $option.="\" selected >";
    else                       $option.="\">";
    $option.=$ret['Monstre']."</option>";
  }
  return $option;
}
  
// ShowListNames($races,$name)
// Input $race     : race des monstres à afficher
//       $monstre  : monstre pré-sélectionné
// Return : une chaine html décrivant toutes les options d'un SELECT pour la
//          sélection d'un monstre de race $race
//
function ShowListAges($race,$genre,$monstre,$famille,$age)
{
	global $db_bestiaire;

  $option="";
  $sql="SELECT * FROM `ages` WHERE `Famille`=\"".$famille."\" ORDER BY 'niveau';";
  $query=mysql_query($sql,$db_bestiaire);
  while($ret=mysql_fetch_array($query)){
    $option.="<option label=\"".$ret['niveau']." - ".$ret[$genre]."\" value=\"bestiaire.php?Race=".$race."&Monstre=".$monstre."&Age=".$ret[$genre];
    if($ret[$genre]==$age) $option.="\" selected >";
    else                  $option.="\">";
    $option.=$ret[$genre]."</option>";
  }
  return $option;
}
  
// get_cdm($race,$monstre)
// Input $race     : race des monstres dont on veut les cdms (plus utilisé)
//       $monstre  : monstre dont on veut les cdms
// Return : un tableau contenant toutes les cdms relatives à ce monstre
//
function get_cdm($race,$monstre)
{
	global $db_bestiaire;

  $sql="SELECT * FROM `cdms` WHERE `Nom`=\"$monstre\";";
  $query=mysql_query($sql,$db_bestiaire);
  while($ret=mysql_fetch_array($query)){
    $tabcdm[]=$ret;
  }
  return $tabcdm;
}

// makeMonsterName($Monstre,$Age)
// Input $monstre : nom du monstre (sans l'âge)
//       $age     : âge du monstre
// Return : le nom complet du monstre en tenant compte de son âge
//
function makeMonsterName($monstre,$age)
{
  if($age=='') return $monstre;
  else         return $monstre." [".$age."]";
}


//---------------------------------------------------------------------
//  Select option value
//---------------------------------------------------------------------

$tabnivuniq=array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '37', '38', '39', );
$tabniv=array('< 3','1-3','2-4','3-5','4-6','5-7','6-8','7-9','8-10','9-11','10-12','11-13','12-14','13-15','14-16','15-17','16-18','17-19','18-20','19-21','> 20','1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '37', '38', '39', '40', '41', '42', '43', '44', '45', '46', '47', '48', '49', '50', '51', '52', '53', '54', '55', '56', '57', '58', '59', '60');
$tabpdv=array('< 20','10-30','10-40','20-40','20-50','30-50','30-60','40-60','40-70','50-70','50-80','60-80','60-90','70-90','70-100','80-100','80-110','90-110','90-120','> 100','100-120','100-130','110-130','110-140','120-140','120-150','130-150','130-160','140-160','140-170','150-170','150-180','160-180','160-190','170-190','170-200','180-200','180-210','190-210','190-220','> 200');
$tabregen=array('> 1','1-2','< 2','2-3', '3-4', '4-5', '5-6', '6-7', '7-8', '8-9','> 9', '9-10', '> 10', '10-11', '11-12', '12-13', '13-14', '14-15', '15-16', '16-17', '17-18', '18-19', '19-20', '> 20', '20-21', '21-22', '22-23', '23-24', '24-25', '25-26', '26-27', '27-28', '28-29', '29-30', '> 30');
$tabcarac=array('< 1','< 2','< 3','1-3','2-4','3-5','4-6','5-7','6-8','7-9','8-10','9-11','> 10','10-12','11-13','12-14','13-15','14-16','15-17','16-18','17-19','18-20','19-21','> 19','> 20','20-22','21-23','22-24','23-25','24-26','25-27','26-28','27-29','28-30','29-31','> 30');

function options_value($tab,$val)
{
  $option="";
  foreach($tab as $tval){
    $option.="<option label=\"".$tval."\" value=\"".$tval;
    if($tval==$val) $option.="\" selected >";
    else            $option.="\">";
    $option.=$tval."</option>";
  }
  return $option;
}


//---------------------------------------------------------------------
//  Connaissance des Monstres
//---------------------------------------------------------------------


// print_cdm_row($val) : affiche une ligne d'une table de cdm
// Input $val : tableau contenant une cdm d'un monstre
function print_cdm_row($val)
{
  print('<tr align="center">');
  if(!isset($val)){
    print('  <td bgcolor="#B7B7DB">?</td>');
    print('  <td bgcolor="#B7B7DB">?</td>');
    print('  <td bgcolor="#B7B7DB">?</td>');
    print('  <td bgcolor="#B7B7DB">?</td>');
    print('  <td bgcolor="#B7B7DB">?</td>');
    print('  <td bgcolor="#B7B7DB">?</td>');
    print('  <td bgcolor="#B7B7DB">?</td>');
    print('  <td bgcolor="#B7B7DB">?</td>');
    print('  <td bgcolor="#B7B7DB">?</td>');
    print('  <td bgcolor="#B7B7DB">?</td>');
    print('  <td bgcolor="#B7B7DB">?</td>');
    print('  <td bgcolor="#B7B7DB">?</td>');
  }
  else{
    print('  <td bgcolor="#B7B7DB">'.$val['Niv'].'</td>');
    print('  <td bgcolor="#B7B7DB">'.$val['PdV'].'</td>');
    print('  <td bgcolor="#B7B7DB">'.$val['ATT'].'</td>');
    print('  <td bgcolor="#B7B7DB">'.$val['ESQ'].'</td>');
    print('  <td bgcolor="#B7B7DB">'.$val['Degat'].'</td>');
    print('  <td bgcolor="#B7B7DB">'.$val['Regen'].'</td>');
    print('  <td bgcolor="#B7B7DB">'.$val['Armure'].'</td>');
    print('  <td bgcolor="#B7B7DB">'.$val['Vue'].'</td>');
    print('  <td bgcolor="#B7B7DB">'.htmlentities($val['CapSpe']).'</td>');
    print('  <td bgcolor="#B7B7DB">'.htmlentities($val['Affecte']).'</td>');
    print('  <td bgcolor="#B7B7DB">'.mysqltimestamp_date($val['cachet']).'</td>');
    print('  <td bgcolor="#B7B7DB">'.htmlentities($val['source']).'</td>');
  }
  print('</tr>');
}

// print_cdm_row($val) : affiche toutes les lignes d'une table html des cdms
// Input $tab_val : liste de toutes les cdm à mettre dans la table html
//       $notfirst: boolean à vrai si on ne doit pas afficher la première
//                  
function print_cdm_rows($tab_cdm,$notfirst)
{
  reset($tab_cdm);
  if($notfirst) list($key,$val) = each($tab_cdm); // on saute la première
  while (list($key,$val) = each($tab_cdm)) {
    print_cdm_row($val);
  }
  reset($tab_cdm);
}

// print_cdm_colums() ; affichage des en-tête de colonne pour une table de cdm
function print_cdm_colums()
{
  print("<tr align=\"center\">");
  print("  <th align=\"center\" width=\"80\" >Niv</th>");
  print("  <th align=\"center\" width=\"80\" >PdV</th>");
  print("  <th align=\"center\" width=\"80\" >Attaque</th>");
  print("  <th align=\"center\" width=\"80\" >Esquive</th>");
  print("  <th align=\"center\" width=\"80\" >Dégâts</th>");
  print("  <th align=\"center\" width=\"80\" >Régen</th>");
  print("  <th align=\"center\" width=\"80\" >Armure</th>");
  print("  <th align=\"center\" width=\"80\" >Vue</th>");
  print("  <th align=\"center\" width=\"80\" >Cap. Spéc.</th>");
  print("  <th align=\"center\" width=\"80\" >Affecte</th>");
  print("  <th align=\"center\" width=\"100\" >Date</th>");
  print("  <th align=\"center\" width=\"150\" >Source</th>");
  print("</tr>");
}

// print_cdm($val): affiche une table html présentant toutes les cdms enregistrées
// Input $tab_val : liste de toutes les cdm à mettre dans la table html
//       $notfirst: boolean à vrai si on ne doit pas afficher la première
//                  
function print_cdm($tab_cdm,$notfirst)
{
  if(isset($tab_cdm[0])){ // on affiche que si il y a des cdms !
    // si on doit tous les afficher ou alors tous sauf le premier mais qu'il y a
    // plus d'une cdm alors on affiche, sinon on ne fait rien    
    if( (!$notfirst) || (count($tab_cdm)>1) ){
      print("<table width='950' border='0' cellspacing='1' style='background-color:#6f7ca2;' class='fiche'>");
      print("  <caption>");
      print("    <font color=\"#FFFFFF\" size=\"+1\"><b><em>Caractéristiques physiques :</em></b></font>");
      print("  </caption>");
      print_cdm_colums(); // on affiche le titre des colonnes
      print_cdm_rows($tab_cdm,$notfirst); // on affiche les lignes de la table
      print("</table></td>");
    }
  }
}



//---------------------------------------------------------------------
//  Capacité spéciale
//---------------------------------------------------------------------


// print_capspe_row($val) : affichage d'une ligne de table html décrivant une
//                          capacité spéciale
// Input $val : tableau contenant les données de la capacité spéciale
function print_capspe_row($val)
{
  if(!isset($val)){
    $val=array('Pouvoir'=>'?','Descript'=>'?','MM'=>'?','Duree'=>'?','Auto'=>'?','Zone'=>'?');
  }
  print("  <tr align=\"center\">");
  print("    <td bgcolor='#B7B7DB'>".$val['Pouvoir']."</td>");
  print("    <td bgcolor='#B7B7DB'>".$val['Descript']."</td>");
  print("    <td bgcolor='#B7B7DB'>".$val['MM']."</td>");
  print("    <td bgcolor='#B7B7DB'>".$val['Duree']."</td>");
  print("    <td bgcolor='#B7B7DB'>".$val['Auto']."</td>");
  print("    <td bgcolor='#B7B7DB'>".$val['Zone']."</td>");
  print("  </tr>");
}

// print_capspe_rows($tab_pouvoirs) : affichage des lignes d'une table html pour
//                                    la capacité spéciale d'un monstre
// Input $tab_pouvoirs : tableau contenant toutes les versions saisies de la
//                       capacité spéciale
//       $notfirst     : boolean à vrai si on ne doit pas afficher la première
function print_capspe_rows($tab_pouvoirs,$notfirst)
{
  reset($tab_pouvoirs);
  if($notfirst) list($key,$val) = each($tab_pouvoirs); // on saute le premier
  while (list($key,$val) = each($tab_pouvoirs)) {
    print_capspe_row($val);
  }
  reset($tab_pouvoirs);
}
// print_headcapse()
//
// affiche le debut d'une table pour les pouvoirs magiques`
//
function print_headtablecapspe($titre)
{
  print("<table width=\"950\" border=\"0\" cellspacing=\"1\" style='background-color:#6f7ca2;' class='bestiaire'>");
  print("  <caption>");
  print("    <font color=\"#FFFFFF\" size=\"+1\"><b><em>$titre</em></b></font>");
  print("  </caption>");
}
function print_headcolcapspe()
{
  print("  <tr align=\"center\">");
  print("    <th align=\"center\" width=\"200\" bgcolor=\"#18D5BD\">Pouvoir</th>");
  print("    <th align=\"center\" width=\"300\" bgcolor=\"#18D5BD\">Description</th>");
  print("    <th align=\"center\" width=\"100\" bgcolor=\"#18D5BD\">MM</th>");
  print("    <th align=\"center\" width=\"100\" bgcolor=\"#C33FC2\">Durée Malus</th>");
  print("    <th align=\"center\" width=\"150\" bgcolor=\"#C33FC2\">Séparé de l'Attaque</th>");
  print("    <th align=\"center\" width=\"150\" bgcolor=\"#C33FC2\">Effet de Zone</th>");
  print("  </tr>");
}
function print_headcapspe($titre)
{
  print_headtablecapspe($titre);
  print_headcolcapspe();
}



// print_capspe($tab_power,$all) : affichage d'une table html pour la capacité
//                                 spéciale d'un monstre.
// Input $tab_power : tableau contenant toutes les capacités spéciales
//                    renseignées
//       $all       : boolean vrai si on veut toutes les afficher, faux si on
//                    veut juste la première (le tableau sera en pratique
//                    ordonnée dans l'ordre inverse des dates, et donc la
//                    première du tableau sera la dernière saisie)
//       $notfirst  : boolean vrai si on ne veut pas afficher la première valeur
//                    (par exemple si elle a déjà été affichée comme référence)
function print_capspe(&$tab_power,&$temp_power,$all,$notfirst=FALSE)
{
  if(count($tab_power)>0){ // le monstre a bien un pouvoir magique
    if( (!$notfirst) || (count($tab_power)>1) ){ // si on ne veut pas la première valeur et qu'il y  
						 // en a qu'une, il n'y a rien à afficher sinon :
      print_headcapspe("Capacité spéciale (pouvoir magique)");
      if($all) print_capspe_rows($tab_power,$notfirst);
      else     print_capspe_row($tab_power[0]);
      print("</table></td>");
    }
  }
  else{
    if($temp_power!=0){
      print_headcapspe("<font color=\"#FF0000\">Donnée manquante :</font> pouvoir indicatif d'un(e) ".$temp_power['Nom']);
      print_capspe_row($tab_power[0]);
      print_capspe_row($temp_power);
    }
    // si on n'a rien trouvé ailleurs, on suppose qu'il n'a pas de pouvoir et on n'affiche rien
    else print_headtablecapspe("Capacité spéciale (pouvoir magique)");
    print("</table></td>");
  }
}

//---------------------------------------------------------------------
//  Pouvoir de Mort
//---------------------------------------------------------------------

// idem capspe mais pour le pouvoir déclenché à la mort
function print_death_row($val)
{
  if(!isset($val)){
    $val=array('Pouvoir'=>'?','Descript'=>'?','MM'=>'?','Duree'=>'?','Zone'=>'?');
  }
  print("    <tr align=\"center\">");
  print("      <td>".$val['Pouvoir']."</td>");
  print("      <td>".$val['Descript']."</td>");
  print("      <td>".$val['Duree']."</td>");
  print("      <td>".$val['Zone']."</td>");
  print("    </tr>");
}

// idem capspe mais pour le pouvoir déclenché à la mort
function print_death_rows($tab_deaths,$notfirst)
{
  reset($tab_deaths);
  if($notfirst) list($key,$val) = each($tab_deaths); // on saute le premier
  while (list($key,$val) = each($tab_deaths)) {
    print_death_row($val);
  }
  reset($tab_deaths);
}


// print_headdeath()
//
// affiche le debut d'une table pour les pouvoirs se déclenchant à la mort
//
function print_headtabledeath($titre)
{
  print("  <table width=\"950\" border=\"0\" cellspacing=\"1\" style='background-color:#6f7ca2;' class='fiche'>");
  print("    <caption>");
  print("      <font color=\"#FFFFFF\" size=\"+1\"><b><em>$titre</em></b></font>");
  print("    </caption>");  
}
function print_headcoldeath()
{
  print("    <tr align=\"center\">");
  print("      <th align=\"center\" width=\"200\" bgcolor=\"#18D5BD\">Pouvoir à la Mort</th>");
  print("      <th align=\"center\" width=\"300\" bgcolor=\"#18D5BD\">Description</th>");
  print("      <th align=\"center\" width=\"150\" bgcolor=\"#C33FC2\">Durée Malus</th>");
  print("      <th align=\"center\" width=\"150\" bgcolor=\"#C33FC2\">Effet de Zone</th>");
  print("    </tr>");
}
function print_headdeath($titre)
{
  print_headtabledeath($titre);
  print_headcoldeath();
}

// idem capspe mais pour le pouvoir déclenché à la mort
function print_death(&$tab_death,&$temp_death,$all,$notfirst=FALSE)
{
  if(count($tab_death)>0){ // le monstre a bien un pouvoir se déclenchant à la mort
    if( (!$notfirst) || (count($tab_death)>1) ){
      print("<tr><td>");
      print_headdeath("Pouvoir à la Mort");
      if($all) print_death_rows($tab_death,$notfirst);
      else     print_death_row($tab_death[0]);
      print("  </table></td>");
      print("</tr>");
    }
  }
  else{
    if($temp_death!=0){
      print_headdeath("<font color=\"#FF0000\">Donnée manquante :</font> pouvoir de mort indicatif d'un(e) ".$temp_death['Nom']);
      print_death_row($temp_death);
      print_death_row($tab_death[0]);
    }
    // si on n'a rien trouvé ailleurs, on suppose qu'il n'a pas de pouvoir et on n'affiche rien
    else print_headtabledeath("Pouvoir à la mort");
    print("</table></td>");
  }
}


//---------------------------------------------------------------------
//  Caracs calculées
//---------------------------------------------------------------------

// idem capspe mais pour les caracs
function print_caracs_row($val)
{
  print("    <tr align=\"center\">");
  print("      <td>".$val['Niv']."</td>");
  print("      <td>".$val['ATTDLA']."</td>");
  print("      <td>".$val['DurDLA']."</td>");
  print("      <td>".$val['RM']."</td>");
  print("      <td>".mysqltimestamp_date($val['cachet'])."</td>");
  print("      <td>".$val['source']."</td>");
  print("    </tr>");
}

// idem capspe mais pour les caracs
function print_caracs_rows($tab_caracs,$notfirst)
{
  reset($tab_caracs);
  if($notfirst) list($key,$val) = each($tab_caracs); // on saute le premier
  while (list($key,$val) = each($tab_caracs)) {
    print_caracs_row($val);
  }
  reset($tab_caracs);
}


// idem capspe mais pour les caracs mais avec gestion de la première valeur déjà affichée
function print_caracs($tab_caracs,$all,$notfirst=FALSE)
{
  if(count($tab_caracs)>0){ // le monstre a bien un pouvoir se déclenchant à la
			   // mort
    if( (!$notfirst) || (count($tab_caracs)>1) ){
      print("<tr><td>");
      print("  <table width=\"950\" border=\"0\" cellspacing=\"1\"  style='background-color:#6f7ca2;' class='bestiaire'>");
      print("    <caption>");
      print("      <font color=\"#FFFFFF\" size=\"+1\"><b><em>Caractéristiques principales</em></b></font>");
      print("</caption>");
      print("<tr align=\"center\">");
      print("<th align='center' width=\"200\"  bgcolor='#B7B7DB'>Niveau</th>");
      print("<th align='center' width=\"300\"  bgcolor='#B7B7DB'>Att/DLA</th>");
      print("<th align='center' width=\"150\"  bgcolor='#B7B7DB'>Durée DLA</th>");
      print("<th align='center' width=\"150\" bgcolor='#B7B7DB' >RM</th>");
      print("<th align='center' width=\"100\"  bgcolor='#B7B7DB'>Date</th>");
      print("<th align='center' width=\"150\"  bgcolor='#B7B7DB'>Source</th>");
      print("</tr>");

      if($all) print_caracs_rows($tab_caracs,$notfirst);
      else     print_caracs_row($tab_caracs[0]);
      print("  </table></td>");
      print("</tr>");
    }
  }
}


function getNivStd($Template)
{
	global $db_bestiaire;
	
  // on récupère son niveau standard
  $sql = "SELECT * FROM `monstres` WHERE 1 AND `Monstre`=\"".$Template."\";";
  $query=mysql_query($sql,$db_bestiaire);
  $ret=mysql_fetch_array($query);
  return $ret['NivStd'];
}

function calculeoffsetagestd($MonstreAge,&$tab_age,&$NomMonstre,&$Age)
{
  // on verifie si il a un âge ( [age] dans son nom )
  // et on extrait son nom de monstre et son âge
  // puis on détermine l'offset par rapport à l\'âge standard
  
  $i=strpos($MonstreAge,'[');
  if($i!==false){ // il a un âge
    $NomMonstre=substr($MonstreAge,0,$i-1); // le nom sans l'\âge
    $f=strpos($MonstreAge,']',$i+1);
    $Age=substr($MonstreAge,$i+1,$f-($i+1));
    $offset=$tab_age[$Age]['niveau'];       // l'offset
  }
  else{ // pas d'âge
    $NomMonstre = $MonstreAge;  // son nom ne comporte pas d\'âge
    $offset = 0;                // monstre de base donc pas d\'offset
  }
  return $offset;
}


function checkagestd($Niv,$MonstreAge,$Race,$Famille,&$Template,&$NivStd)
{
	global $db_bestiaire;

  // on cherche les infos sur le monstre
  $sql="SELECT * FROM `races` WHERE `Race`=\"".$Race."\" ;";
  $query=mysql_query($sql,$db_bestiaire);
  if(!$query) die("Echec de la requête $sql");
  $race=mysql_fetch_array($query);
  $genre=$race['genre'];
  // on construit la table des âges
  $tab_age=array();
  $sql="SELECT * FROM `ages` WHERE `Famille`=\"".$Famille."\" ORDER by `niveau` ASC;";
  $query=mysql_query($sql,$db_bestiaire);
  while($ret=mysql_fetch_array($query)){
    $tab_age[$ret[$genre]]=$ret;// on indexe suivant l'âge du bon genre (donné par race)
  }
  
  // on calcule son âge, son template, et l'offset de niveau dû à son âge
  $offset=calculeoffsetagestd($MonstreAge,$tab_age,$Template,$Age);
  // on récupère son niveau standard
  $NivStd = getNivStd($Template);
  $oldNivStd = $NivStd;
  if($NivStd==0){ // si pas de niveau standard encore
    // le niveau indiqué devient le niveau standard
    $NivStd = $Niv;
  }
  else{
    // on va comparer le NivStd et le Niv indiqué
    $i = strpos($Niv,'-');
    $g = strpos($Niv,'>');
    $l = strpos($Niv,'<');
    $is = strpos($NivStd,'-');
    $gs = strpos($NivStd,'>');
    $ls = strpos($NivStd,'<');
    if( ($i===false) && ($g===false) && ($l===false) ){
      // le niveau indiqué est un niveau pur, il est plus récent, il a priorité
      $NivStd = $Niv-$offset; // on le remplace en l'ajustant par l'offset
    }
    else if( ($is!==false) || ($gs!==false) || ($ls!==false) ){
      // le NivStd n'est pas pur, on peut donc éventuellement le remplacer par
      // le niveau indiqué
      if( ($g!==false) || ($l!==false) ){ // si le Niv est > ou >
	// on ne le remplace que si le NivStd est de la même forme, sinon on
	// touche à rien
	if( ($gs!==false) || ($ls!==false) ){
	  $NivStd = $Niv; // on ajuste pas les > ou < par l'offset
			  // car les valeurs autorisées ne le permettent pas
	}
      }
      // Niv pas pur, Niv pas < ou > donc Niv est un interval
      else{ // NivStd pas pur, c'est soit un interval, soit < ou > donc 
	// on remplace par un interval plus récent
	$NivStd = $Niv;
	// on récupère les deux bornes de l'interval pour ajustement par l'offset
	$Niv1=substr($NivStd,0,$i);
	$Niv2=substr($NivStd,$i+1);
	$Niv1-=$offset;
	$Niv2-=$offset;
	$NivStd=$Niv1."-".$Niv2;
      }
    }
  }
  return $NivStd!=$oldNivStd;
}


function calculeagestd($MonstreAge,&$tab_age)
{
  // on calcule son âge, son template, et l'offset de niveau dû à son âge
  $offset=calculeoffsetagestd($MonstreAge,$tab_age,$Template,$Age);
  
  // on récupère son niveau standard
  $Niv = getNivStd($Template);
  
  // on analyse le niveau trouvé
  $i=strpos($Niv,'>'); // si > on le garde tel quel
  if($i===false){
    $i=strpos($Niv,'<'); // si < on le garde tel quel
    if($i===false){
      $i=strpos($Niv,'-'); 
      if($i!==false){ // un interval est specifié on ajoute l'offset aux deux bornes
	$Niv1=substr($Niv,0,$i);
	$Niv2=substr($Niv,$i+1);
	$Niv1+=$offset;
	$Niv2+=$offset;
	$Niv=$Niv1."-".$Niv2;
      }
      else // sinon on ajoute l'offset au niveau simple
        $Niv+=$offset;
    }
  }
  
  return $Niv;
}


function mysqltimestamp_date($timestamp){ 
   $hour = substr($timestamp, 8, 2); 
   $minute = substr($timestamp, 10, 2);
   $second = substr($timestamp, 12, 2);
   $month = substr($timestamp, 4, 2);
   $day = substr($timestamp, 6, 2);
   $year = substr($timestamp, 0, 4);
   return "$day/$month/$year";
   //mktime($hour, $minute, $second, $month, $day, $year);
}

function date_mysqltimestamp($date)
{
  $ts=explode('-',$date);
  return $ts[0].$ts[1].$ts[2]."000000";
}


function famille2gif($nom)
{
  return strtr($nom,"éèêàèùûïî","eeeaeuuii").".gif";
}
