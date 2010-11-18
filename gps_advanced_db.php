<?php
##############################################################################
#                        gps_advanced_db.php
##############################################################################

include_once("admin_functions_db.php");

global $db_vue_rm;

#######################################
# Sélectionne un groupe de trolls
# $type = allies, ennemis
# ou encore $type = id_guilde que l'on souhaite
#######################################
function selectDbGpsTrolls($x_min,$x_max,$y_min,$y_max,$type)
{
	global $db_vue_rm;

	$sql = "SELECT id_troll, nom_troll, nom_guilde, id_guilde, statut_guilde, ";
	$sql .= " is_wanted_troll, is_tk_troll, is_venge_troll, is_admin_troll, ";
	$sql .= " x_troll, y_troll, z_troll, UNIX_TIMESTAMP(date_troll) as date_troll, statut_troll, race_troll,";
	$sql .= " nom_image_troll, is_seen_troll, pass_troll, ";
	$sql .= " niveau_troll, equipement_troll, maj_groupe_spec_troll, ";
	$sql .= " TO_DAYS(NOW()) - TO_DAYS(date_troll) delai";

	$sql .= " FROM trolls t, guildes";
		
	$sql .= " WHERE x_troll >=$x_min";
	$sql .= " AND x_troll <=$x_max";
	$sql .= " AND y_troll >=$y_min";
	$sql .= " AND y_troll <=$y_max";
	$sql .= " AND is_seen_troll = 'oui'";

	$sql .= " AND guilde_troll = id_guilde";

	if ($type == "allies"){
		$sql .= " AND guilde_troll = id_guilde";
		$sql .= " AND ( (statut_guilde = 'amie'";
		$sql .= " OR statut_guilde = 'alliee')";
		$sql .= " OR ( statut_troll = 'alliee'";
		$sql .= " OR statut_troll = 'amie'))";
		$sql .= " AND guilde_troll != ".ID_GUILDE; // on affiche pas les rm dans la liste des alliés
	} elseif (($type == "ennemis") || ($type == "guildes_ennemies")) {
		$sql .= " AND guilde_troll = id_guilde";
		$sql .= " AND ( (statut_guilde = 'tk'";
		$sql .= " OR statut_guilde = 'ennemie')";
		$sql .= " OR ( statut_troll = 'tk'";
		$sql .= " OR statut_troll = 'ennemie'))";
	} elseif (is_numeric($type)) {
		$sql .= " AND t.guilde_troll=$type";
	}
	
	if (!userIsGroupSpec()){
		$sql .= " AND t.maj_groupe_spec_troll != 'oui'";
	}

	$sql .= " ORDER by t.nom_troll";

	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
		echo "Chaine SQL = $sql<br>";
	} else {
		$i=1;
		while ($trolls = mysql_fetch_assoc($result)) {
			if($trolls[x_troll]!="") {
				$lesTrolls[$i][delai]=$trolls[delai];

   		  $lesTrolls[$i][id_troll]=$trolls[id_troll];
	      $lesTrolls[$i][nom_troll]=$trolls[nom_troll];
	      $lesTrolls[$i][nom_image_troll]=$trolls[nom_image_troll];
	      $lesTrolls[$i][id_guilde]=$trolls[id_guilde];
	      $lesTrolls[$i][nom_guilde]=$trolls[nom_guilde];
	      $lesTrolls[$i][statut_guilde]=$trolls[statut_guilde];
	      $lesTrolls[$i][is_tk_troll]=$trolls[is_tk_troll];
	      $lesTrolls[$i][is_wanted_troll]=$trolls[is_wanted_troll];
	      $lesTrolls[$i][is_venge_troll]=$trolls[is_venge_troll];
	      $lesTrolls[$i][is_admin_troll]=$trolls[is_admin_troll];
	      $lesTrolls[$i][statut_troll]=$trolls[statut_troll];
	      $lesTrolls[$i][x_troll]=$trolls[x_troll];
	      $lesTrolls[$i][y_troll]=$trolls[y_troll];
	      $lesTrolls[$i][z_troll]=$trolls[z_troll];
  	      $lesTrolls[$i][date_troll]=$trolls[date_troll];
	      $lesTrolls[$i][race_troll]=$trolls[race_troll];
	      $lesTrolls[$i][niveau_troll]=$trolls[niveau_troll];
		  $lesTrolls[$i][is_seen_troll]=$trolls[is_seen_troll];
	      $lesTrolls[$i][equipement_troll]=$trolls[equipement_troll];
		  $lesTrolls[$i][maj_groupe_spec_troll]=$trolls[maj_groupe_spec_troll];	
				$i++;
			}
		} 
	}
	return $lesTrolls;
}


#######################################
# Sélectionne un groupe de baronnies 
#######################################
function selectDbGpsBaronnies($x_min,$x_max,$y_min,$y_max)
{
	global $db_vue_rm;

  $sql = "SELECT x_deb_baronnie, y_deb_baronnie, z_deb_baronnie,";
  $sql .= " x_fin_baronnie, y_fin_baronnie, z_fin_baronnie,";
  $sql .= " x_trone_baronnie, y_trone_baronnie, z_trone_baronnie,";
  $sql .= " nom_baronnie, id_baron_baronnie, id_baronnie,nom_troll as nom_baron ";
  $sql .= " FROM baronnies,trolls";
  $sql .= " WHERE x_fin_baronnie >= $x_min";
  $sql .= " AND x_deb_baronnie <= $x_max";
  $sql .= " AND y_fin_baronnie >= $y_min";
  $sql .= " AND y_deb_baronnie <= $y_max";
  $sql .= " AND id_troll = id_baron_baronnie";

	$sql .= " ORDER by nom_baronnie";

	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
	} else {
		$i=1;
		while ($baronnies = mysql_fetch_assoc($result)) {
			$lesBaronnies[$i][id_baronnie]=$baronnies[id_baronnie];
			$lesBaronnies[$i][nom_baronnie]=$baronnies[nom_baronnie];
			$lesBaronnies[$i][x_deb_baronnie]=$baronnies[x_deb_baronnie];
			$lesBaronnies[$i][y_deb_baronnie]=$baronnies[y_deb_baronnie];
			$lesBaronnies[$i][z_deb_baronnie]=$baronnies[z_deb_baronnie];
			$lesBaronnies[$i][x_fin_baronnie]=$baronnies[x_fin_baronnie];
			$lesBaronnies[$i][y_fin_baronnie]=$baronnies[y_fin_baronnie];
			$lesBaronnies[$i][z_fin_baronnie]=$baronnies[z_fin_baronnie];
			$lesBaronnies[$i][x_trone_baronnie]=$baronnies[x_trone_baronnie];
			$lesBaronnies[$i][y_trone_baronnie]=$baronnies[y_trone_baronnie];
			$lesBaronnies[$i][z_trone_baronnie]=$baronnies[z_trone_baronnie];
			$lesBaronnies[$i][id_baron_baronnie]=$baronnies[id_baron_baronnie];
			$lesBaronnies[$i][nom_baron]=$baronnies[nom_baron];
			$i++;
		} 
	}
	return $lesBaronnies;
}

#######################################
# Sélectionne un groupe de Tanières
#######################################
function selectDbGpsTanieres($x_min,$x_max,$y_min,$y_max)
{
	global $db_vue_rm;

  $sql = "SELECT id_taniere, nom_troll, nom_lieu, x_lieu, y_lieu, z_lieu";
  $sql .= " FROM tanieres,trolls,lieux";
  $sql .= " WHERE x_lieu>= $x_min";
  $sql .= " AND x_lieu<= $x_max";
  $sql .= " AND y_lieu>= $y_min";
  $sql .= " AND y_lieu<= $y_max";
  $sql .= " AND id_troll = id_troll_taniere";
  $sql .= " AND id_taniere = id_lieu";

	$sql .= " ORDER by nom_troll";

	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
	} else {
		$i=1;
		while ($taniere = mysql_fetch_assoc($result)) {
			$lesTanieres[$i][id_taniere]=$taniere[id_taniere];
			$lesTanieres[$i][nom_troll]=$taniere[nom_troll];
			$lesTanieres[$i][nom_lieu]=$taniere[nom_lieu];
			$lesTanieres[$i][x_lieu]=$taniere[x_lieu];
			$lesTanieres[$i][y_lieu]=$taniere[y_lieu];
			$lesTanieres[$i][z_lieu]=$taniere[z_lieu];
			$i++;
		} 
	}
	return $lesTanieres;
}

#######################################
# Sélectionne un groupe de Gowaps
#######################################
function selectDbGpsGowaps($x_min,$x_max,$y_min,$y_max)
{
	global $db_vue_rm;

  $sql = "SELECT id_gowap, nom_troll, nom_monstre, x_monstre, y_monstre, z_monstre";
  $sql .= " FROM gowaps,trolls,monstres";
  $sql .= " WHERE x_monstre>= $x_min";
  $sql .= " AND x_monstre<= $x_max";
  $sql .= " AND y_monstre>= $y_min";
  $sql .= " AND y_monstre<= $y_max";
  $sql .= " AND id_troll = id_troll_gowap";
  $sql .= " AND id_gowap = id_monstre";

	$sql .= " ORDER by nom_troll";

	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
	} else {
		$i=1;
		while ($gowap = mysql_fetch_assoc($result)) {
			$lesGowaps[$i][id_gowap]=$gowap[id_gowap];
			$lesGowaps[$i][nom_troll]=$gowap[nom_troll];
			$lesGowaps[$i][nom_monstre]=$gowap[nom_monstre];
			$lesGowaps[$i][x_monstre]=$gowap[x_monstre];
			$lesGowaps[$i][y_monstre]=$gowap[y_monstre];
			$lesGowaps[$i][z_monstre]=$gowap[z_monstre];
			$i++;
		} 
	}
	return $lesGowaps;
}


#######################################
# Sélectionne un groupe de Lieux
#######################################
function selectDbGpsLieux($x_min,$x_max,$y_min,$y_max,$nom_lieu)
{
	global $db_vue_rm;

  $sql = "SELECT id_lieu, nom_lieu, x_lieu, y_lieu, z_lieu";
  $sql .= " FROM lieux";
  $sql .= " WHERE x_lieu>= $x_min";
  $sql .= " AND x_lieu<= $x_max";
  $sql .= " AND y_lieu>= $y_min";
  $sql .= " AND y_lieu<= $y_max";
  $sql .= " AND nom_lieu like '$nom_lieu%'";
	$sql .= " ORDER by nom_lieu";

	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
	} else {
		$i=1;
		while ($lieu = mysql_fetch_assoc($result)) {
			$lesLieux[$i][id_lieu]=$lieu[id_lieu];
			$lesLieux[$i][nom_lieu]=$lieu[nom_lieu];
			$lesLieux[$i][x_lieu]=$lieu[x_lieu];
			$lesLieux[$i][y_lieu]=$lieu[y_lieu];
			$lesLieux[$i][z_lieu]=$lieu[z_lieu];
			$i++;
		} 
	}
	return $lesLieux;
}

#######################################
# Selectionne deux trolls pour le guide de Micheline
#######################################
function selectDbMicheline($id_objet_depart,$id_objet_arrivee,$type_objet_depart,$type_objet_arrivee)
{
	global $db_vue_rm;
	
	$id_objet = $id_objet_depart;
	$type_objet = $type_objet_depart;

	for ($i=0;$i<=1;$i++) {
		if ($i==1) {
			$id_objet = $id_objet_arrivee;
			$type_objet = $type_objet_arrivee;
			$x1 = $x;
			$y1 = $y;
			$z1 = $z;
			$nom1 = $nom;
		}

		switch ($type_objet) {
			case "troll":
				$res = selectDbTrolls($id_objet);
				$res = $res[1];
				if (!userIsGroupSpec() && $res[maj_groupe_spec_troll] =='oui' ){
					$res[x_troll]=0;
					$res[y_troll]=0;
					$res[z_troll]=0;
				}
				$x = $res[x_troll];
				$y = $res[y_troll];
				$z = $res[z_troll];
				$nom = $res[nom_troll];
				break;
			case "monstre":
				$res = selectDbRechercheMonstres($id_objet);
				$x = $res[x_monstre];
				$y = $res[y_monstre];
				$z = $res[z_monstre];
				$nom = $res[nom_monstre];	
				break;
			case "lieux":
				$res = selectDbLieux($id_objet);
				$x = $res[x_lieu];
				$y = $res[y_lieu];
				$z = $res[z_lieu];
				$nom = $res[nom_lieu];	
				break;
			case "champignons":
				$res = selectDbRechercheChampignons($id_objet);
				$x = $res[x_champi];
				$y = $res[y_champi];
				$z = $res[z_champi];
				$nom = $res[nom_champi];
				break;
		}
	}

	$tab[0]['x'] = $x1;
	$tab[0]['y'] = $y1;
	$tab[0]['z'] = $z1;
	$tab[0]['nom'] = $nom1;
	$tab[1]['x'] = $x;
	$tab[1]['y'] = $y;
	$tab[1]['z'] = $z;
	$tab[1]['nom'] = $nom;

	return $tab;
}

################################
# Regarde si l'id troll existe
# renvoit true si oui, false si non
################################
function selectIsExistIdTroll($id_troll)
{
	global $db_vue_rm;

	$sql = "SELECT count(*) as nb";
	$sql .= " FROM trolls";
	$sql .= " WHERE id_troll = $id_troll";
	
	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
		return false;
	} else {
		$res = mysql_fetch_assoc($result);
		if ($res[nb] > 0) 
			return true;
		else
			return false;
	}
}

########################################
# Selectionne des champignons
########################################
function selectDbChampignons($x_min,$x_max,$y_min,$y_max,$stat)
{
	global $db_vue_rm;
	
	$flag = false;

	if (($stat != 'vus' ) && (is_numeric($stat))) {
		$date_less_n=date("Y-m-d H-i-s", mktime(date("H"), date("i"), date("s"), date("m")  , date("d")-$stat, date("Y")));
		$flag = true;
	}

	if ($flag == true) {
		//$sql = "SELECT  count(*) as nb, 5-abs(nb/max(nb)*5) delai, c.nom_champi, x_champi, y_champi, z_champi";
		//$sql = "SELECT  count(*) as nb, 5-abs(count(*)/(count(*)*5)) delai, c.nom_champi, x_champi, y_champi, z_champi";

		$sql = "SELECT id_champi, ";
		$sql .= " nom_champi, x_champi, y_champi, z_champi, date_champi";
		$sql .= " FROM champignons";
		$sql .= " WHERE x_champi >=$x_min";
		$sql .= " AND x_champi <=$x_max";
		$sql .= " AND y_champi >=$y_min";
		$sql .= " AND y_champi <=$y_max";
		$sql .= " AND date_champi >= '$date_less_n'";
		$sql .= " ORDER by nom_champi";

	} else {
		//$sql = "SELECT (TO_DAYS(NOW()) - TO_DAYS(date_pousse_champi)) as delai,";
		$sql = "SELECT id_champi, nom_champi, x_champi, y_champi, z_champi, date_champi";
		$sql .= " FROM champignons";
		$sql .= " WHERE x_champi >=$x_min";
		$sql .= " AND x_champi <=$x_max";
		$sql .= " AND y_champi >=$y_min";
		$sql .= " AND y_champi <=$y_max";
		$sql .= " AND is_seen_champi ='oui'";
		$sql .= " ORDER by nom_champi";
	}

	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
	} else {
		$i=1;
		while ($champi = mysql_fetch_assoc($result)) {
	    $lesChampi[$i][id_champi]=$champi[id_champi];
	    $lesChampi[$i][nom_champi]=$champi[nom_champi];
	    $lesChampi[$i][x_champi]=$champi[x_champi];
	    $lesChampi[$i][y_champi]=$champi[y_champi];
	    $lesChampi[$i][z_champi]=$champi[z_champi];
	    $lesChampi[$i][date_champi]=$champi[date_champi];
	    $i++;
		}
	}
	return $lesChampi;
}

###################################
# Selection de guildes
###################################
function selectDbGuilde($id_guilde="",$type="")
{
	global $db_vue_rm;

	$sql = "SELECT id_guilde, nom_guilde, statut_guilde";
	$sql .= " FROM guildes" ;
	
	if (($id_guilde != "") || ($type != ""))
		$sql .= " WHERE";
	
	if ($type == "tk") {
		$sql .= " (statut_guilde like 'tk'" ;
		$sql .= " OR statut_guilde like 'ennemie')" ;
		$and = "AND";
	}
		
	if ($id_guilde != "") {
		$sql .= " $and id_guilde = $id_guilde";
	}

	$sql .= " ORDER by nom_guilde";

	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
	} else {
		$i=1;
		while ($guildes = mysql_fetch_assoc($result)) {
			$lesGuildes[$i][1]=$guildes[id_guilde];
			$lesGuildes[$i][2]=$guildes[nom_guilde];
			$lesGuildes[$i][3]=$guildes[statut_guilde];
			$i++;
		} 
	}
	return $lesGuildes;
}

?>
