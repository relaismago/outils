<?
include_once ("inc_connect.php3");

##########################################
# Insertion ou modification d'une baronnie
# dans la base de données
##########################################
function editDbBaronnie()
{
	global $db_vue_rm;

  $page = "engine_view.php";

	//isControlAdministrateur("yes"); // Control strict de l'administrateur
	// Récupération des variables du formulaire
	$id_baronnie = $_REQUEST['id_baronnie'];
	$nom_baronnie = $_REQUEST['nom_baronnie'];
	$id_baron_baronnie = $_REQUEST['id_baron_baronnie'];
	$blason_baronnie = $_REQUEST['blason_baronnie'];
	$img_blason_baronnie = $_REQUEST['img_blason_baronnie'];
	$img_mini_blason_baronnie = $_REQUEST['img_mini_blason_baronnie'];
	$img_drapeau_baronnie = $_REQUEST['img_drapeau_baronnie'];
	$x_deb_baronnie = $_REQUEST['x_deb_baronnie'];
	$y_deb_baronnie = $_REQUEST['y_deb_baronnie'];
	$z_deb_baronnie = $_REQUEST['z_deb_baronnie'];
	$x_fin_baronnie = $_REQUEST['x_fin_baronnie'];
	$y_fin_baronnie = $_REQUEST['y_fin_baronnie'];
	$z_fin_baronnie = $_REQUEST['z_fin_baronnie'];
	$x_trone_baronnie = $_REQUEST['x_trone_baronnie'];
	$y_trone_baronnie = $_REQUEST['y_trone_baronnie'];
	$z_trone_baronnie = $_REQUEST['z_trone_baronnie'];
	$couleur1_baronnie = $_REQUEST['couleur1_baronnie'];
	$couleur2_baronnie = $_REQUEST['couleur2_baronnie'];
	$enleve_troll = $_REQUEST['enleve_id_troll'];
	$ajoute_troll = $_REQUEST['ajoute_id_troll'];

	// si c'est l'admin ou le baron (en modification uniquemenet pour le baron)
	if ( isControlAdministrateur() || (($_SESSION[AuthTroll] == $id_baron_baronnie) && ($id_baronnie != "new"))) {
		echo "<h1>Admnistration Baronnie</h1>";
	} else {
		die ("Vous n'avez pas le droit...");
	}

	// Si l'on veut ajouter la baronnie		
	if ($id_baronnie == "new") {
		// On l'ajoute dans la base de données
		mysql_query("INSERT into baronnies (nom_baronnie) VALUES ('".addslashes($nom_baronnie)."')");
		echo mysql_error();
		// puis on récupère l'identifiant qui vient de se faire rentrer
		$id_baronnie =mysql_insert_id($db_vue_rm); 
		$info_action = "ajoutée";
	} else {
		$info_action = "modifiée";
	}

	/*echo "WARNING d'Bodéga : l'upload de l'image n'est pas valide pour le moment";
	echo "(j'avais pas les images pour tester... ;-). Bodéga 49145 )<br><br>";*/
	//valid_upload("blason_baro_$id_baronnie.gif");
	
	$sql = " UPDATE baronnies SET nom_baronnie='".htmlentities(addslashes($nom_baronnie))."',";
	$sql .= " id_baron_baronnie='$id_baron_baronnie',";
	$sql .= " blason_baronnie='".htmlentities(addslashes($blason_baronnie))."',";
	$sql .= " img_blason_baronnie='".addslashes($img_blason_baronnie)."', ";
	$sql .= " img_mini_blason_baronnie='".addslashes($img_mini_blason_baronnie)."', ";
	$sql .= " img_drapeau_baronnie='".addslashes($img_drapeau_baronnie)."', ";
	$sql .= " x_deb_baronnie='$x_deb_baronnie', y_deb_baronnie='$y_deb_baronnie', z_deb_baronnie='$z_deb_baronnie',";
	$sql .= " x_fin_baronnie='$x_fin_baronnie', y_fin_baronnie='$y_fin_baronnie', z_fin_baronnie='$z_fin_baronnie',";
	$sql .= " x_trone_baronnie='$x_trone_baronnie', y_trone_baronnie='$y_trone_baronnie',";
	$sql .= " z_trone_baronnie='$z_trone_baronnie',";
	$sql .= " couleur1_baronnie='$couleur1_baronnie', couleur2_baronnie='$couleur2_baronnie'";
	$sql .= " WHERE id_baronnie=$id_baronnie";

	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
		echo "<br>chaine sql = $sql<br>";
		echo "Erreur dans la mise à jour de la baronnie. Copiez / Collez ce que vous voyez et postez";
		echo " cela dans le forum outils. Merci (ou contactez Bodéga 49145).";
		$erreur = "oui";
	}

	if ($ajoute_troll !="")
	{
		$sql = " UPDATE trolls SET id_baronnie_troll = $id_baronnie";
		$sql .= " WHERE id_troll = $ajoute_troll";	
		if (!$result=mysql_query($sql,$db_vue_rm)) {
		  echo mysql_error();
			echo "<br>chaine sql = $sql<br>";
			echo "Erreur dans la mise à jour de la baronnie (ajoute troll). Copiez / Collez ce que vous voyez et postez";
			echo " cela dans le forum outils. Merci (ou contactez Bodéga 49145).";
			$erreur = "oui";
		}
	}
	if ($enleve_troll !="")
	{
		$sql = " UPDATE trolls SET id_baronnie_troll = NULL";
		$sql .= " WHERE id_troll = $enleve_troll";	
		if (!$result=mysql_query($sql,$db_vue_rm)) {
		  echo mysql_error();
			echo "<br>chaine sql = $sql<br>";
			echo "Erreur dans la mise à jour de la baronnie (enleve troll). Copiez / Collez ce que vous voyez et postez";
			echo " cela dans le forum outils. Merci (ou contactez Bodéga 49145).";
			$erreur = "oui";
		}
	}

	if ($erreur != 'oui') {
		echo "<h1>La Baronnie ".stripslashes($nom_baronnie)." est $info_action</h1>";
		echo "<a href='$page?baronnie=liste'>Retour à la liste</a> ";
		echo "<a href='$page?baronnie=$id_baronnie'>Retour à la fiche de la baronnie</a>";
	}
	
}


######################################################
# Sélectionne une ou plusieurs baronnies dans la bdd
######################################################
function selectDbBaronnies($id="")
{
	global $db_vue_rm;
	
	$sql = " SELECT id_baronnie, id_baron_baronnie, nom_baronnie, blason_baronnie,";
	$sql .= " img_blason_baronnie, img_mini_blason_baronnie, img_drapeau_baronnie,";
	$sql .= " x_deb_baronnie, y_deb_baronnie, z_deb_baronnie, x_fin_baronnie, ";
	$sql .= " y_fin_baronnie, z_fin_baronnie, x_trone_baronnie, y_trone_baronnie, ";
	$sql .= " z_trone_baronnie, couleur1_baronnie, couleur2_baronnie, ";
	$sql .= " nom_troll";

	$sql .= " FROM baronnies, trolls";

	$sql .= " WHERE id_baron_baronnie = id_troll";
	if ($id != "")
		$sql .= " AND id_baronnie = $id";

	$sql .= " ORDER by nom_baronnie";

	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
	} else {
		$i=1;
		while ($baronnies = mysql_fetch_assoc($result)) {
			$lesBaronnies[$i]['id_baronnie']=$baronnies['id_baronnie'];
			$lesBaronnies[$i]['nom_baronnie']=$baronnies['nom_baronnie'];
			$lesBaronnies[$i]['id_baron_baronnie']=$baronnies['id_baron_baronnie'];
			$lesBaronnies[$i]['blason_baronnie']=$baronnies['blason_baronnie'];
			$lesBaronnies[$i]['img_blason_baronnie']=$baronnies['img_blason_baronnie'];
			$lesBaronnies[$i]['img_mini_blason_baronnie']=$baronnies['img_mini_blason_baronnie'];
			$lesBaronnies[$i]['img_drapeau_baronnie']=$baronnies['img_drapeau_baronnie'];
			$lesBaronnies[$i]['x_deb_baronnie']=$baronnies['x_deb_baronnie'];
			$lesBaronnies[$i]['y_deb_baronnie']=$baronnies['y_deb_baronnie'];
			$lesBaronnies[$i]['z_deb_baronnie']=$baronnies['z_deb_baronnie'];
			$lesBaronnies[$i]['x_fin_baronnie']=$baronnies['x_fin_baronnie'];
			$lesBaronnies[$i]['y_fin_baronnie']=$baronnies['y_fin_baronnie'];
			$lesBaronnies[$i]['z_fin_baronnie']=$baronnies['z_fin_baronnie'];
			$lesBaronnies[$i]['x_trone_baronnie']=$baronnies['x_trone_baronnie'];
			$lesBaronnies[$i]['y_trone_baronnie']=$baronnies['y_trone_baronnie'];
			$lesBaronnies[$i]['z_trone_baronnie']=$baronnies['z_trone_baronnie'];
			$lesBaronnies[$i]['couleur1_baronnie']=$baronnies['couleur1_baronnie'];
			$lesBaronnies[$i]['couleur2_baronnie']=$baronnies['couleur2_baronnie'];
			$lesBaronnies[$i]['nom_troll']=$baronnies['nom_troll'];
			$i++;
		} 
	}
	return $lesBaronnies;
}

##########################################
# Modification du statut d'une guilde 
# dans la base de données
##########################################
function editDbGuilde()
{
	global $db_vue_rm;

	if (!isControlAdministrateur() && (!isConseilOrDiplo()))
		isControlAdministrateur("yes");
	
	// Récupération des variables du formulaire
	$id_guilde = $_REQUEST['id_guilde'];
	$nom_guilde = $_REQUEST['nom_guilde'];
	$statut_guilde = $_REQUEST['statut_guilde'];
	$gestionnaire_id_troll_guilde = $_REQUEST['gestionnaire_id_troll_guilde'];
	$contact_id_troll_guilde = $_REQUEST['contact_id_troll_guilde'];
	$info_1_guilde = $_REQUEST['info_1_guilde'];
	$diplomate_id_troll_guilde = $_REQUEST['diplomate_id_troll_guilde'];
	$web_guilde = $_REQUEST['web_guilde'];
	$historique_guilde = $_REQUEST['historique_guilde'];
	
	$flag = true;

	$lesTrolls = selectDbTrolls($gestionnaire_id_troll_guilde);
	$nbTrolls = count($lesTrolls);;
	if ($nbTrolls == 0 ) {
		$msg = "<br><font color=red><b>N° Gestionnaire : le troll $gestionnaire_id_troll_guilde n'existe pas. </font></br>";
		$flag = false;
	}

	$lesTrolls = selectDbTrolls($contact_id_troll_guilde);
	$nbTrolls = count($lesTrolls);
	if ($nbTrolls == 0 ) {
		$msg = "<br><font color=red><b>N° Contact : le troll $contact_id_troll_guilde n'existe pas. </font></br>";
		$flag = false;
	}

	if (!$flag)
		die($msg. "Vous devez choisir un N° valide.");
	
	$sql = " UPDATE guildes SET ";
	$sql .= " statut_guilde='$statut_guilde',";
	$sql .= " gestionnaire_id_troll_guilde =$gestionnaire_id_troll_guilde,";
	$sql .= " contact_id_troll_guilde =$contact_id_troll_guilde,";
	$sql .= " info_1_guilde ='$info_1_guilde',";
	$sql .= " diplomate_id_troll_guilde =$diplomate_id_troll_guilde,";
	$sql .= " web_guilde ='$web_guilde',";
	$sql .= " historique_guilde ='$historique_guilde'";
	$sql .= " WHERE id_guilde=$id_guilde";
		
	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
		echo "<br>chaine sql = $sql<br>";
		echo "Erreur dans la mise à jour de la Guilde. Copiez / Collez ce que vous voyez et postez";
		echo " cela dans le forum outils. Merci (ou contactez Bodéga 49145).";
	} else {
		echo "<h1>La Guilde ".stripslashes($nom_guilde)." est modifiée</h1>";
		echo "<h2>Diplomatie : $statut_guilde</h2>";
		echo "<a href='engine_view.php?guilde=liste'>Retour à la liste</a> ";
		echo "<a href='engine_view.php?guilde=$id_guilde'>Retour à la fiche de la guilde</a>";
	}
}


######################################################
# Sélectionne une ou plusieurs guildes dans la bdd
######################################################
function selectDbGuildes($id="",$sort="")
{
	global $db_vue_rm;
	
	$sql = " SELECT id_guilde, nom_guilde, statut_guilde, gestionnaire_id_troll_guilde,";
	$sql .= " contact_id_troll_guilde , info_1_guilde,  diplomate_id_troll_guilde ,";
	$sql .= " web_guilde , historique_guilde, t1.nom_troll as nom_gestionnaire,";
	$sql .= " t2.nom_troll as nom_contact, t3.nom_troll as nom_diplomate";
	$sql .= " FROM guildes, trolls t1, trolls t2, trolls t3";
	$sql .= " WHERE t1.id_troll = gestionnaire_id_troll_guilde";
	$sql .= " AND t2.id_troll = contact_id_troll_guilde";
	$sql .= " AND t3.id_troll = diplomate_id_troll_guilde";

	if ($id != "")
		$sql .= " AND id_guilde = $id";
	if ($sort == "sort_diplomatie")
		$sql .= " ORDER by statut_guilde DESC, nom_guilde "; // on met les tk dans le haut de la liste
	elseif ($sort == "sort_diplomate") // trie suivant le nom du diplomate R&M
		$sql .= " AND t3.nom_troll != '' ORDER by nom_diplomate, statut_guilde DESC, nom_guilde "; 
	elseif (strlen($sort) >1  && ($sort != "liste"))
		$sql .= " AND statut_guilde = '$sort' ORDER by nom_guilde ";
	else
		$sql .= " ORDER by nom_guilde";

	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
	} else {
		$i=1;
		while ($guildes = mysql_fetch_assoc($result)) {
			$lesGuildes[$i]['id_guilde'] = $guildes['id_guilde'];
			$lesGuildes[$i]['nom_guilde'] = $guildes['nom_guilde'];
			$lesGuildes[$i]['statut_guilde'] = $guildes['statut_guilde'];
			$lesGuildes[$i]['nom_gestionnaire'] = $guildes['nom_gestionnaire'];
			$lesGuildes[$i]['gestionnaire_id_troll_guilde'] = $guildes['gestionnaire_id_troll_guilde'];
			$lesGuildes[$i]['nom_contact'] = $guildes['nom_contact'];
			$lesGuildes[$i]['contact_id_troll_guilde'] = $guildes['contact_id_troll_guilde'];
			$lesGuildes[$i]['info_1_guilde'] = $guildes['info_1_guilde'];
			$lesGuildes[$i]['nom_diplomate'] = $guildes['nom_diplomate'];
			$lesGuildes[$i]['diplomate_id_troll_guilde'] = $guildes['diplomate_id_troll_guilde'];
			$lesGuildes[$i]['web_guilde'] = $guildes['web_guilde'];
			$lesGuildes[$i]['historique_guilde'] = $guildes['historique_guilde'];
			$i++;
		} 
	}
	return $lesGuildes;
}


##########################################
# Modification du statut d'un troll (tk,wanted,venge)
# dans la base de données
##########################################
function editDbTroll()
{
	global $db_vue_rm;

	isControlAdministrateur("yes"); // Control strict de l'administrateur

	// Récupération des variables du formulaire
	$id_troll = $_REQUEST['id_troll'];
	$nom_troll = $_REQUEST['nom_troll'];
	$nom_image_troll = $_REQUEST['nom_image_troll'];
	if ($nom_image_troll == "") $nom_image_troll = NULL;

	$is_tk_troll = $_REQUEST['is_tk_troll'];
	$is_wanted_troll = $_REQUEST['is_wanted_troll'];
	$is_venge_troll = $_REQUEST['is_venge_troll'];
	$id_diplomate_troll = $_REQUEST['id_diplomate_troll'];
	$historique_troll = addslashes($_REQUEST['historique_troll']);
	$statut_troll = $_REQUEST['statut_troll'];
	$groupe_rm_troll = $_REQUEST['groupe_rm_troll'];
	$id_distinction = $_REQUEST['id_distinction'];

	if ($id_distinction== "")
		$id_distinction = 1;

	$sql = " UPDATE trolls SET";
	$sql .= " is_tk_troll='$is_tk_troll',";
	$sql .= " is_wanted_troll='$is_wanted_troll',";
	$sql .= " is_venge_troll='$is_venge_troll',";
	$sql .= " id_diplomate_troll='$id_diplomate_troll',";
	$sql .= " historique_troll ='$historique_troll',";
	$sql .= " statut_troll='$statut_troll',";
	$sql .= " nom_image_troll='$nom_image_troll',";
	$sql .= " groupe_rm_troll='$groupe_rm_troll',";
	$sql .= " id_distinction_troll=$id_distinction";
	$sql .= " WHERE id_troll=$id_troll";
		
	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
		echo "<br>chaine sql = $sql<br>";
		echo "Erreur dans la mise à jour du troll. Copiez / Collez ce que vous voyez et postez";
		echo " cela dans le forum outils. Merci (ou contactez Bodéga 49145).";
	} else {
		echo "<h1>Le Troll $nom_troll ($id_troll) est modifié</h1>";
		echo "<h2>Est Tk : $is_tk_troll</h2>";
		echo "<h2>Est Wanted : $is_wanted_troll</h2>";
		echo "<h2>Est Chatié : $is_venge_troll</h2>";
		echo "<h2>Diplomatie : $statut_troll</h2>";
		echo "<a href='engine_view.php?troll=liste'>Retour à la liste</a> ";
		echo "<a href='engine_view.php?troll=$id_troll'>Retour à la fiche du troll</a>";
	}
}

######################################################
# Sélectionne une ou plusieurs trolls  dans la bdd avec
# des filtres possibles
######################################################
function selectDbTrolls($id="",$sort="", $id_baronnie="",$id_distinction="")
{
	global $db_vue_rm;

	$sql = "SELECT id_troll, nom_troll, nom_guilde, id_guilde, statut_guilde, ";
	$sql .= " is_wanted_troll, is_tk_troll, is_venge_troll, is_admin_troll, ";
	$sql .= " x_troll, y_troll, z_troll, UNIX_TIMESTAMP(date_troll) as date_troll, statut_troll, race_troll,";
	$sql .= " nom_image_troll, is_seen_troll, pass_troll, groupe_rm_troll,";
	$sql .= " id_distinction, nom_distinction, nom_image_distinction, niveau_troll, ";
	$sql .= " nom_image_titre_distinction,equipement_troll,date_last_refresh_manual_troll, date_last_visit_troll, is_pnj_troll, ";
	$sql .= " date_inscription_troll,	email_troll ,	blason_troll ,	intangible_troll ,	nb_mouches_troll ,	nb_kills_troll ,";
	$sql .= "	nb_morts_troll,	num_rang_troll,	nom_rang_troll,	distinction_troll,	equipement2_troll, ";
	$sql .= "	id_diplomate_troll, historique_troll, maj_groupe_spec_troll ";
	$sql .= " FROM trolls, guildes, distinctions";

	if ($id_baronnie != "")
		$sql .= ", baronnies";
	
	if (($sort == "filter_tk") || ($sort == "filter_grief"))
		$sql .= " , tk_griefs";
		
	$sql .= " WHERE id_guilde = guilde_troll";
	$sql .= " AND id_distinction_troll = id_distinction";

	if ($id_distinction != "")
		$sql .= " AND id_distinction_troll = $id_distinction";

	if ($id_baronnie != "")
		$sql .= " AND id_baronnie_troll = $id_baronnie";

	if (($sort == "neutre") ||  ($sort == "tk") || ($sort == "ennemie") || 
			($sort == "amie") || ($sort == "alliee") ){
		$sql .= " AND (statut_troll = '$sort' OR statut_guilde = '$sort')";
	}

	if ($sort == "date_last_visit") {
		$sql .= " AND ( date_last_visit_troll not like '0000-00-00 00:00:00' ";
		$sql .= " OR id_guilde = ".ID_GUILDE." )" ;

	}

	if ($sort == "diplo_conseil")
		$sql .= " AND (groupe_rm_troll = 'conseil' OR groupe_rm_troll = 'diplomate')";

	if (is_numeric($id))
		$sql .= " AND id_troll = $id";

	if (is_numeric($sort)){
		$sql .= " AND id_guilde = $sort";
	
	} elseif ($sort == "filter_grief") {
		$sql .= " AND id_troll = tk_griefs.tk_id";
		
	} elseif ($sort == "filter_tk") {
		$sql .= " AND is_tk_troll like 'oui'";
		
	} elseif ($sort == "filter_guilde_ennemie_and_tk") {
		$sql .= " AND ( statut_guilde like 'ennemie'";
		$sql .= " OR statut_guilde like 'tk')";
		
	} elseif ($sort == "filter_wanted") {
		$sql .= " AND is_wanted_troll like 'oui'";

	} elseif ($sort == "filter_wanted_not_venge") {
		$sql .= " AND is_wanted_troll like 'oui'";
		$sql .= " AND is_venge_troll like 'non'";
		
	} elseif ($sort == "filter_venge") {
		$sql .= " AND is_venge_troll like 'oui'";
		
	} elseif ($sort == "filter_wanted_without_grief") {
		$sql .= " AND is_wanted_troll like 'oui'";
		
	} elseif ($sort == "filter_tk_or_wanted_with_statut_neutre") {
		$sql .= " AND (is_wanted_troll = 'oui' OR is_tk_troll = 'oui') ";
		$sql .= " AND (statut_troll = 'neutre'";
		$sql .= " OR statut_troll = '' )";
		$sql .= " AND statut_guilde = 'neutre'";

	} elseif ($sort == "filter_statut_tk_or_wanted_without_istk_or_iswanted") {
		$sql .= " AND (is_wanted_troll like 'non' AND is_tk_troll like 'non') ";
		$sql .= " AND (statut_troll = 'tk' OR statut_troll = 'ennemie') ";
		
	} elseif ($sort == "avatar_to_bollock") {
		$sql .= " AND id_guilde = ".ID_GUILDE;
#		$sql .= " AND id_distinction != 20 ";
#		$sql .= " AND id_distinction != 22 ";
	} elseif ($sort == "trombinoscope") {
		$sql .= " AND id_guilde = ".ID_GUILDE;
		$sql .= " ORDER by num_rang_troll DESC, nom_troll ";
	}
	
	if ($sort == "date_last_visit") {
		$sql .= " ORDER BY  date_last_visit_troll DESC, is_pnj_troll,nom_troll";
	} elseif ($sort != "trombinoscope") {
		$sql .= " GROUP by id_troll, nom_troll, nom_guilde, id_guilde, statut_guilde,";
		$sql .= " is_wanted_troll, is_tk_troll, is_venge_troll,is_admin_troll,";
		$sql .= " x_troll, y_troll, z_troll, date_troll, statut_troll, groupe_rm_troll,is_seen_troll, ";
		$sql .= " date_inscription_troll,	email_troll ,	blason_troll ,	intangible_troll ,	nb_mouches_troll ,	nb_kills_troll ,";
		$sql .= "	nb_morts_troll,	num_rang_troll,	nom_rang_troll,	distinction_troll,	equipement2_troll ";
		$sql .= " ORDER by nom_troll";
	}
	
	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
		echo "<br>chaine sql = $sql<br>";
	} else {
		$i=1;

		while ($trolls = mysql_fetch_assoc($result)) {
			if ($sort == "filter_wanted_without_grief") {
			  $lesGriefs = selectDbGriefs($trolls[id_troll]);
			  $nbGriefs = count($lesGriefs);
				if ($nbGriefs > 0)
					continue;
			}

			$lesTrolls[$i]['id_troll']=$trolls['id_troll'];
			$lesTrolls[$i]['nom_troll']=$trolls['nom_troll'];
			$lesTrolls[$i]['nom_image_troll']=$trolls['nom_image_troll'];
			$lesTrolls[$i]['id_guilde']=$trolls['id_guilde'];
			$lesTrolls[$i]['nom_guilde']=$trolls['nom_guilde'];
			$lesTrolls[$i]['statut_guilde']=$trolls['statut_guilde'];
			$lesTrolls[$i]['is_tk_troll']=$trolls['is_tk_troll'];
			$lesTrolls[$i]['is_wanted_troll']=$trolls['is_wanted_troll'];
			$lesTrolls[$i]['is_venge_troll']=$trolls['is_venge_troll'];
			$lesTrolls[$i]['is_admin_troll']=$trolls['is_admin_troll'];
			$lesTrolls[$i]['statut_troll']=$trolls['statut_troll'];
			$lesTrolls[$i]['x_troll']=$trolls['x_troll'];
			$lesTrolls[$i]['y_troll']=$trolls['y_troll'];
			$lesTrolls[$i]['z_troll']=$trolls['z_troll'];
			$lesTrolls[$i]['date_troll']=$trolls['date_troll'];
			$lesTrolls[$i]['race_troll']=$trolls['race_troll'];
			$lesTrolls[$i]['niveau_troll']=$trolls['niveau_troll'];
			$lesTrolls[$i]['is_seen_troll']=$trolls['is_seen_troll'];
			$lesTrolls[$i]['is_pnj_troll']=$trolls['is_pnj_troll'];
			$lesTrolls[$i]['groupe_rm_troll']=$trolls['groupe_rm_troll'];
			// accédé uniquement par l'administrateur pour le changement de mot de passe
			$lesTrolls[$i]['pass_troll']=$trolls['pass_troll']; 
			$lesTrolls[$i]['id_distinction']=$trolls['id_distinction']; 
			$lesTrolls[$i]['nom_distinction']=$trolls['nom_distinction']; 
			$lesTrolls[$i]['nom_image_distinction']=$trolls['nom_image_distinction']; 
			$lesTrolls[$i]['nom_image_titre_distinction']=$trolls['nom_image_titre_distinction']; 
			$lesTrolls[$i]['equipement_troll']=$trolls['equipement_troll']; 
			$lesTrolls[$i]['date_last_visit_troll']=$trolls['date_last_visit_troll']; 

			$lesTrolls[$i]['date_inscription_troll']=$trolls['date_inscription_troll']; 
			$lesTrolls[$i]['email_troll']=$trolls['email_troll']; 
			$lesTrolls[$i]['blason_troll']=$trolls['blason_troll']; 
			$lesTrolls[$i]['intangible_troll']=$trolls['intangible_troll']; 
			$lesTrolls[$i]['nb_mouches_troll']=$trolls['nb_mouches_troll']; 
			$lesTrolls[$i]['nb_kills_troll']=$trolls['nb_kills_troll']; 
			$lesTrolls[$i]['nb_morts_troll']=$trolls['nb_morts_troll']; 
			$lesTrolls[$i]['num_rang_troll']=$trolls['num_rang_troll']; 
			$lesTrolls[$i]['nom_rang_troll']=$trolls['nom_rang_troll']; 
			$lesTrolls[$i]['distinction_troll']=$trolls['distinction_troll']; 
			$lesTrolls[$i]['equipement2_troll']=$trolls['equipement2_troll']; 
			$lesTrolls[$i]['id_diplomate_troll']=$trolls['id_diplomate_troll'];
			$lesTrolls[$i]['maj_groupe_spec_troll']=$trolls['maj_groupe_spec_troll'];
			$lesTrolls[$i]['historique_troll']=stripslashes($trolls['historique_troll']); 

			$i++;
			//echo $i."<br>";
			if ($i > 400)
				die("<font color=red>Erreur Nbr Troll > 400 ! 
						Copié/collé ce que vous voyez et postez dans le topic vue2d</font>");
		} 
	}
	return $lesTrolls;
}

######################################################
# Sélectionne l'équipement d'un troll  
######################################################
function selectDbEquipement($id)
{
	global $db_vue_rm;

	$sql = "SELECT id_troll, nom_troll, equipement_troll";
	$sql .= " FROM trolls";
	$sql .= " WHERE id_troll = $id";

	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
		echo "<br>chaine sql = $sql<br>";
	} else {
		$i=1;

		while ($trolls = mysql_fetch_assoc($result)) {
			$leTrollEquipement[$i][id_troll]=$trolls[id_troll];
			$leTrollEquipement[$i][nom_troll]=$trolls[nom_troll];
			$leTrollEquipement[$i][equipement_troll]=$trolls[equipement_troll];
			$i++;
		} 
	}
	return $leTrollEquipement;
}

######################################################
# Sélectionne les mouches d'un troll  
######################################################
function selectDbMouches($id)
{
	global $db_vue_rm;

	$sql = "SELECT id_mouche,id_troll_mouche,nom_mouche,type_mouche,age_mouche,presence_mouche";
	$sql .= " FROM mouches";
	$sql .= " WHERE id_troll_mouche = $id";
	$sql .= " ORDER BY age_mouche DESC";

	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
		echo "<br>chaine sql = $sql<br>";
	} else {
		$i=1;

		while ($mouche = mysql_fetch_assoc($result)) {
			$leTrollMouches[$i]['id_mouche']=$mouche['id_mouche'];
			$leTrollMouches[$i]['id_troll_mouche']=$mouche['id_troll_mouche'];
			$leTrollMouches[$i]['nom_mouche']=$mouche['nom_mouche'];
			$leTrollMouches[$i]['type_mouche']=$mouche['type_mouche'];
			$leTrollMouches[$i]['age_mouche']=$mouche['age_mouche'];
			$leTrollMouches[$i]['presence_mouche']=$mouche['presence_mouche'];
			$i++;
		} 
	}
	return $leTrollMouches;
}
##########################################
# Modification d l'équipement d'un troll
# dans la base de données
##########################################
function editDbEquipement()
{
	global $db_vue_rm;

	//isControlAdministrateur("yes"); // Control strict de l'administrateur

	// Récupération des variables du formulaire
	$id_troll = $_REQUEST['id_troll'];
	$nom_troll = $_REQUEST['nom_troll'];
	$equipement_troll = $_REQUEST['equipement_troll'];

	// Si ce n'est pas l'administrateur et que ce n'est pas le troll en question
	// on strop
	if ((!iscontroladministrateur()) && ($_SESSION['AuthTroll'] != $id_troll)){
		echo "REFUSE, Erreur de Sécu ! <br>";
		exit;
	}

	$sql = " UPDATE trolls SET";
	$sql .= " equipement_troll ='".addslashes($equipement_troll)."'";
	$sql .= " WHERE id_troll=$id_troll";

	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
		echo "<br>chaine sql = $sql<br>";
		echo "Erreur dans la mise à jour de l'équipement du troll. Copiez / Collez ce que vous voyez et postez";
		echo " cela dans le forum outils. Merci (ou contactez glupglup 51166).";
	} else {
		echo "<h1>L'équipement du Troll $nom_troll ($id_troll) est modifié</h1>";
		echo "<a href='$page?troll=liste'>Retour à la liste</a> ";
		echo "<a href='$page?troll=$id_troll'>Retour à la fiche du troll</a>";
	}
}

##########################################
# Insertion ou modification d'un grief
# dans la base de données
##########################################
function editDbGrief()
{
	global $db_vue_rm;

	isControlAdministrateur("yes"); // Control strict de l'administrateur

	// Récupération des variables du formulaire
	$grief_id = $_REQUEST['grief_id'];
	$tk_id = $_REQUEST['tk_id'];
	$date_grief = $_REQUEST['date_grief'];
	$troll_impacte = $_REQUEST['troll_impacte'];
	$description = htmlentities(addslashes($_REQUEST['description']));
	$type = $_REQUEST[type];
	
	// Si l'on veut ajouter la baronnie		
	if ($grief_id == "new") {
		// On l'ajoute dans la base de données
		mysql_query("INSERT into tk_griefs (tk_id) VALUES ($tk_id)");
		echo mysql_error();
		// puis on récupère l'identifiant qui vient de se faire rentrer
		$grief_id =mysql_insert_id($db_vue_rm); 
		$info_action = "ajouté";
	} else {
		$info_action = "modifié";
	}
	
	$date_grief = substr($date_grief,6,4)."-".substr($date_grief,3,2)."-".substr($date_grief,0,2);
	
	$sql = " UPDATE tk_griefs SET ";
	$sql .=" description ='".$description."',";
	$sql .= " tk_id=$tk_id, type='$type',";
	$sql .= " troll_impacte=$troll_impacte, date_grief='$date_grief'";
	$sql .= " WHERE grief_id=$grief_id";
		
	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
		echo "<br>chaine sql = $sql<br>";
		echo "Erreur dans la mise à jour du Grief. Copiez / Collez ce que vous voyez et postez";
		echo " cela dans le forum outils. Merci (ou contactez Bodéga 49145).";
	} else {
		echo "<h1>Le grief est $info_action</h1>";
		echo "<a href='engine_view.php?troll=liste'>Retour à la liste des trolls</a> ";
		echo "<a href='engine_view.php?troll=$tk_id'>Retour à la fiche du troll</a>";
	}
}


##########################################
# Supprime un grief
# dans la base de données
##########################################
function deleteDbGrief()
{
	global $db_vue_rm;

	isControlAdministrateur("yes"); // Control strict de l'administrateur

	// Récupération des variables du formulaire
	$grief_id = $_REQUEST['grief_id'];
	$tk_id = $_REQUEST['troll'];
	
	$sql = " DELETE FROM tk_griefs ";
	$sql .= " WHERE grief_id=$grief_id";
		
	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
		echo "<br>chaine sql = $sql<br>";
		echo " Erreur dans la suppression du Grief. Copiez / Collez ce que vous voyez et postez";
		echo " cela dans le forum outils. Merci (ou contactez Bodéga 49145).";
	} else {
		echo "<h1>Le grief est supprimé</h1>";
		echo "<a href='engine_view.php?troll=liste'>Retour à la liste des trolls</a> ";
		echo "<a href='engine_view.php?troll=$tk_id'>Retour à la fiche du troll</a>";
	}
}


#####################################
# Selectionne un ou plusieurs griefs (d'un tk donné)
#####################################
function selectDbGriefs($id_tk, $grief_id="", $is_tk ="", $id_troll_impacte="")
{
	global $db_vue_rm;

	$sql = "SELECT grief_id, tk_id, date_grief, troll_impacte, type, description";
	$sql .= " FROM tk_griefs";
	if ($id_tk!="")
		$sql .= " WHERE tk_id=$id_tk";
	if ($id_troll_impacte!="")
		$sql .= " WHERE troll_impacte=$id_troll_impacte";
	if ($grief_id != "")
		$sql .= " AND grief_id=$grief_id";
	if ($is_tk != "")
		$sql .= " AND type like 'meurtre'";
	
	$sql .= " ORDER BY date_grief";

	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
		echo "<br>chaine sql = $sql<br>";
	} else {
		$i=1;
		while ($grief = mysql_fetch_assoc($result)) {

			$date_grief = $grief['date_grief'];
			$lesGriefs[$i]['grief_id']=$grief['grief_id'];
			$lesGriefs[$i]['tk_id']=$grief['tk_id'];
			$lesGriefs[$i]['date_grief']=substr($date_grief,8,2)."-".substr($date_grief,5,2)."-".substr($date_grief,0,4);
			$lesGriefs[$i]['troll_impacte']=$grief['troll_impacte'];
			$lesGriefs[$i]['type']=$grief['type'];
			$lesGriefs[$i]['description']=$grief['description'];
			$i++;
		} 
	}
	return $lesGriefs;
}


##########################################
# Insertion ou modification d'une vengeance 
# dans la base de données
##########################################
function editDbVengeance()
{
	global $db_vue_rm;

	isControlAdministrateur("yes"); // Control strict de l'administrateur

	// Récupération des variables du formulaire
	$vengeance_id = $_REQUEST['vengeance_id'];
	$tk_id = $_REQUEST['tk_id'];
	$date_vengeance = $_REQUEST['date_vengeance'];
	$troll_vengeur = $_REQUEST['troll_vengeur'];
	$description = $_REQUEST['description'];
	
	// Si l'on veut ajouter la baronnie		
	if ($vengeance_id == "new") {
		// On l'ajoute dans la base de données
		mysql_query("INSERT into tk_vengeances (tk_id) VALUES ($tk_id)");
		echo mysql_error();
		// puis on récupère l'identifiant qui vient de se faire rentrer
		$vengeance_id =mysql_insert_id($db_vue_rm); 
		$info_action = "ajoutée";
	} else {
		$info_action = "modifiée";
	}

	$date_vengeance = substr($date_vengeance,6,4)."-".substr($date_vengeance,3,2)."-".substr($date_vengeance,0,2);

	$sql = " UPDATE tk_vengeances SET ";
	$sql .=" description ='".htmlentities(addslashes($description))."',";
	$sql .= " tk_id=$tk_id,";
	$sql .= " troll_vengeur=$troll_vengeur, date_vengeance='$date_vengeance'";
	$sql .= " WHERE vengeance_id=$vengeance_id";
		
	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
		echo "<br>chaine sql = $sql<br>";
		echo "Erreur dans la mise à jour de la Vengeance. Copiez / Collez ce que vous voyez et postez";
		echo " cela dans le forum outils. Merci (ou contactez Bodéga 49145).";
	} else {
		echo "<h1>La vengeance est $info_action</h1>";
		echo "<a href='engine_view.php?troll=liste'>Retour à la liste des trolls</a> ";
		echo "<a href='engine_view.php?troll=$tk_id'>Retour à la fiche du troll</a>";
	}
}


##########################################
# Supprime un grief
# dans la base de données
##########################################
function deleteDbVengeance()
{
	global $db_vue_rm;

	isControlAdministrateur("yes"); // Control strict de l'administrateur

	// Récupération des variables du formulaire
	$vengeance_id = $_REQUEST['vengeance_id'];
	$tk_id = $_REQUEST['troll'];
	
	$sql = " DELETE FROM tk_vengeances ";
	$sql .= " WHERE vengeance_id=$vengeance_id";
		
	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
		echo "<br>chaine sql = $sql<br>";
		echo " Erreur dans la suppression de la vengeance. Copiez / Collez ce que vous voyez et postez";
		echo " cela dans le forum outils. Merci (ou contactez Bodéga 49145).";
	} else {
		echo "<h1>La vengeance est supprimée</h1>";
		echo "<a href='engine_view.php?troll=liste'>Retour à la liste des trolls</a> ";
		echo "<a href='engine_view.php?troll=$tk_id'>Retour à la fiche du troll</a>";
	}
}


#####################################
# Selectionne un ou plusieurs vengeances (d'un tk donné)
#####################################
function selectDbVengeances($id_tk, $vengeance_id="", $id_troll_vengeur="")
{
	global $db_vue_rm;

	$sql = "SELECT vengeance_id, tk_id, date_vengeance, troll_vengeur, description";
	$sql .= " FROM tk_vengeances";
	if ($id_tk != "")
		$sql .= " WHERE tk_id=$id_tk";
	if ($id_troll_vengeur != "")
		$sql .= " WHERE troll_vengeur=$id_troll_vengeur";

	if ($vengeance_id != "")
		$sql .= " AND vengeance_id=$vengeance_id";

	$sql .= " ORDER BY date_vengeance";

	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
		echo "<br>chaine sql = $sql<br>";
	} else {
		$i=1;
		while ($vengeance = mysql_fetch_assoc($result)) {
			$date_veng = $vengeance['date_vengeance'];

			$lesVengeances[$i]['vengeance_id']=$vengeance['vengeance_id'];
			$lesVengeances[$i]['tk_id']=$vengeance['tk_id'];
			$lesVengeances[$i]['date_vengeance']=substr($date_veng,8,2)."-".substr($date_veng,5,2)."-".substr($date_veng,0,4);
			$lesVengeances[$i]['troll_vengeur']=$vengeance['troll_vengeur'];
			$lesVengeances[$i]['description']=$vengeance['description'];
			$i++;
		} 
	}
	return $lesVengeances;
}

##########################################
# Modification d'un gowap
# dans la base de données
##########################################
function editDbGowap()
{
  global $db_vue_rm;

  $page = "engine_view.php";

  // Récupération des variables du formulaire
  $id_gowap = $_REQUEST['id_gowap'];
  $id_troll_gowap = $_REQUEST['id_troll_gowap'];
  $description_gowap = $_REQUEST['description_gowap'];
  $profil_gowap = $_REQUEST['profil_gowap'];
  $chargement_gowap = $_REQUEST['chargement_gowap'];
  $act = $_REQUEST['act'];

	$date=date("Y-m-d H-i-s");

	// Si l'on veut ajouter le gowap
	if ($act == "new") {

		// On regarde si le gowap existe dans la table monstres
		
		$lesMonstres = selectDbRechercheMonstres($id_gowap);
		$nbMonstres = count($lesMonstres);
		if ($nbMonstres == 0 ) {
			$msg = "<br><font color=red><b>Le gowap n'existe pas dans la base de données, il faut le voir pour le ";
			$msg .= " rajouter en tant que Gowap.</font></br>";
			die($msg);
		}

		// On l'ajoute dans la base de données
		mysql_query("INSERT into gowaps (id_gowap, id_troll_gowap) VALUES ($id_gowap, $id_troll_gowap)");
		echo mysql_error();
		$info_action = "ajouté";
	} else {
		$info_action = "modifié";
	}

  $sql = " UPDATE gowaps";
  $sql .= " SET id_troll_gowap=$id_troll_gowap,";
	if ($description_gowap != "")
	  $sql .= " description_gowap='".addslashes($description_gowap)."',";
	if ($profil_gowap != "")
	  $sql .= " profil_gowap='".addslashes($profil_gowap)."',";
	if ($chargement_gowap != "")
	  $sql .= " chargement_gowap='".addslashes($chargement_gowap)."',";
  $sql .= " date_chargement_gowap='".$date."'";
  $sql .= " WHERE id_gowap=$id_gowap";

  if (!$result=mysql_query($sql,$db_vue_rm)) {
    echo mysql_error();
    echo "<br>chaine sql = $sql<br>";
    echo "Erreur dans la mise à jour du Gowap. Copiez / Collez ce que vous voyez et postez";
    echo " cela dans le forum outils. Merci (ou contactez Bodéga 49145).";
  } else {
    echo "<h1>Le Gowap $id_gowap est $info_action</h1>";
    echo "<h2>Id Troll Maître  : $id_troll_gowap</h2>";
    echo "<a href='$page?troll=$id_troll_gowap'>Retour à la fiche du troll maître</a> ";
    echo "<a href='$page?gowap=$id_gowap'>Retour à la fiche du gowap</a>";
  }
}

##########################################
# Suppression d'un gowap
# dans la base de données
##########################################
function deleteDbGowap()
{
  global $db_vue_rm;

  $page = "engine_view.php";

  // Récupération des variables du formulaire
  $id_gowap = $_REQUEST['id_gowap'];
	
 	if (iscontroladministrateur()) {
		$lesGowaps = selectDbGowapsFromTableGowap($id_gowap);
	} else {
		$lesGowaps = selectDbGowapsFromTableGowap($id_gowap,$_SESSION['AuthTroll']);
	}

	if (count($lesGowaps) == 0 ) {
		echo "REFUSE, vous n'êtes pas le proprio ou admin ! <br>";
		exit;
	}

	$res = $lesGowaps[1];
	$id_troll_gowap = $res['id_troll_gowap'];
				
  $sql = " DELETE FROM gowaps";
  $sql .= " WHERE id_gowap=$id_gowap";

  if (!$result=mysql_query($sql,$db_vue_rm)) {
    echo mysql_error();
    echo "<br>chaine sql = $sql<br>";
    echo "Erreur dans la suppression du Gowap. Copiez / Collez ce que vous voyez et postez";
    echo " cela dans le forum outils. Merci (ou contactez Bodéga 49145).";
  } else {
    echo "<h1>Le Gowap $id_gowap est supprimé</h1>";
    echo "<h2>Id Troll Maître  : $id_troll_gowap</h2>";
    echo "<a href='$page?troll=$id_troll_gowap'>Retour à la fiche du troll propriétaire</a> ";
  }
}

#####################################
# Selectionne un ou plusieurs gowaps d'un troll donné (ou non si l'on connait l'id_gowap)
#####################################
function selectDbGowaps($id_gowap="", $id_troll_gowap="")
{
	global $db_vue_rm;

	$sql = "SELECT id_gowap, id_troll_gowap, chargement_gowap, profil_gowap, description_gowap,date_chargement_gowap,";
	$sql .= " x_monstre, y_monstre, z_monstre, is_seen_monstre, UNIX_TIMESTAMP(date_monstre) as date_monstre, ";
	$sql .= "nom_troll, nom_monstre, nom_image_troll";
	$sql .= " FROM gowaps, monstres, trolls";
	$sql .= " WHERE id_monstre = id_gowap";
	$sql .= " AND id_troll = id_troll_gowap";
	
	if ($id_gowap != "")
		$sql .= " AND id_gowap=$id_gowap";
		
	if ($id_troll_gowap != "")
		$sql .= " AND id_troll_gowap=$id_troll_gowap";
	
	$sql .= " ORDER BY nom_troll";

	$lesGowaps = array();
	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
		echo "<br>chaine sql = $sql<br>";
	} else {
		$i=1;
		while ($gowap = mysql_fetch_assoc($result)) {
			$lesGowaps[$i]['id_gowap']=$gowap['id_gowap'];
			$lesGowaps[$i]['id_troll_gowap']=$gowap['id_troll_gowap'];
			$lesGowaps[$i]['id_troll']=$gowap['id_troll_gowap']; // même chose que id_troll_gowap,ne pas supprimer
			$lesGowaps[$i]['description_gowap']=$gowap['description_gowap'];
			$lesGowaps[$i]['profil_gowap']=$gowap['profil_gowap'];
			$lesGowaps[$i]['chargement_gowap']=$gowap['chargement_gowap'];
			$lesGowaps[$i]['date_chargement_gowap']=$gowap['date_chargement_gowap'];
			$lesGowaps[$i]['nom_monstre']=$gowap['nom_monstre'];
			$lesGowaps[$i]['x_monstre']=$gowap['x_monstre'];
			$lesGowaps[$i]['y_monstre']=$gowap['y_monstre'];
			$lesGowaps[$i]['z_monstre']=$gowap['z_monstre'];
			$lesGowaps[$i]['is_seen_monstre']=$gowap['is_seen_monstre'];
			$lesGowaps[$i]['date_monstre']=$gowap['date_monstre'];
			$lesGowaps[$i]['nom_troll']=$gowap['nom_troll'];
			$lesGowaps[$i]['nom_image_troll']=$gowap['nom_image_troll'];
			$i++;
		} 
	}
	return $lesGowaps;
}

#####################################
# Selectionne un ou plusieurs gowaps d'un troll donné (ou non si l'on connait l'id_gowap)
# Mais uniquement depuis la table des gowaps (pour rechercher des erreurs d'id, 
# que l'on signale dans la fiche du troll
#####################################
function selectDbGowapsFromTableGowap($id_gowap, $id_troll="")
{
	global $db_vue_rm;

	$sql = "SELECT id_gowap, id_troll_gowap";
	$sql .= " FROM gowaps";
	$sql .= " WHERE ";

	if ($id_gowap != "")
		$sql .=" id_gowap = $id_gowap";
	
	$mot = "";
	if ($id_gowap != "")
		$mot = "AND";

	if ($id_troll != "")
		$sql .=" $mot id_troll_gowap = $id_troll";
	
	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
		echo "<br>chaine sql = $sql<br>";
	} else {
		$i=1;
		while ($gowap = mysql_fetch_assoc($result)) {
			$lesGowaps[$i]['id_gowap']=$gowap['id_gowap'];
			$lesGowaps[$i]['id_troll_gowap']=$gowap['id_troll_gowap'];
			$i++;
		} 
	}
	return $lesGowaps;
}
##########################################
# Modification d'une tanière
# dans la base de données
##########################################
function editDbTaniere()
{
  global $db_vue_rm;

  $page = "engine_view.php";

  // Récupération des variables du formulaire
  $id_taniere = $_REQUEST['id_taniere'];
  $id_troll_taniere = $_REQUEST['id_troll_taniere'];
  $description_taniere = $_REQUEST['description_taniere'];
  $contenu_taniere = $_REQUEST['contenu_taniere'];
  $vente_taniere = $_REQUEST['vente_taniere'];
  $date_maj_taniere = $_REQUEST['date_maj_taniere'];
  $act = $_REQUEST['act'];

	$date=date("Y-m-d H-i-s");

	// Si l'on veut ajouter la tanière
	if ($act == "new") {
			$lesLieux = selectDbLieux($id_taniere);
			$nbLieux = count($lesLieux);
			if ($nbLieux == 0 ) {
				$msg = "<br><font color=red><b>La tanière n'existe pas dans la base de données, il faut la voir pour le ";
				$msg .= " rajouter en tant que Tanière.</font></br>";
				die($msg);
			}

		// On l'ajoute dans la base de données
		mysql_query("INSERT into tanieres (id_taniere, id_troll_taniere) VALUES ($id_taniere, $id_troll_taniere)");
		echo mysql_error();
		$info_action = "ajouté";
	} else {
		$info_action = "modifié";
	}

  $sql = " UPDATE tanieres";
  $sql .= " SET id_troll_taniere=$id_troll_taniere,";
  $sql .= " description_taniere='".addslashes($description_taniere)."',";
  $sql .= " contenu_taniere='".addslashes($contenu_taniere)."',";
  $sql .= " vente_taniere='".addslashes($vente_taniere)."',";
  $sql .= " date_maj_taniere='".$date."'";
  $sql .= " WHERE id_taniere=$id_taniere";

  if (!$result=mysql_query($sql,$db_vue_rm)) {
    echo mysql_error();
    echo "<br>chaine sql = $sql<br>";
    echo "Erreur dans la mise à jour de la Tanière. Copiez / Collez ce que vous voyez et postez";
    echo " cela dans le forum outils. Merci (ou contactez Bodéga 49145).";
  } else {
    echo "<h1>La tanière $id_taniere est $info_action</h1>";
    echo "<h2>Id Troll Propriétaire  : $id_troll_taniere</h2>";
    echo "<a href='$page?troll=$id_troll_taniere'>Retour à la fiche du troll propriétaire</a> ";
    echo "<a href='$page?taniere=$id_taniere'>Retour à la fiche de la tanière</a>";
  }
}

##########################################
# Suppression d'une tanière
# dans la base de données
##########################################
function deleteDbTaniere()
{
  global $db_vue_rm;

  $page = "engine_view.php";

  // Récupération des variables du formulaire
  $id_taniere = $_REQUEST['id_taniere'];
	
 	if (iscontroladministrateur()) {
		$lesTanieres = selectDbTanieresFromTableTanieres($id_taniere);
	} else {
		$lesTanieres = selectDbTanieresFromTableTanieres($id_taniere,$_SESSION[AuthTroll]);
	}

	if (count($lesTanieres) == 0 ) {
		echo "REFUSE, vous n'êtes pas le proprio ou admin ! <br>";
		exit;
	}

	$res = $lesTanieres[1];
	$id_troll_taniere = $res['id_troll_taniere'];
				
  $sql = " DELETE FROM tanieres";
  $sql .= " WHERE id_taniere=$id_taniere";

  if (!$result=mysql_query($sql,$db_vue_rm)) {
    echo mysql_error();
    echo "<br>chaine sql = $sql<br>";
    echo "Erreur dans la suppression de la tanière. Copiez / Collez ce que vous voyez et postez";
    echo " cela dans le forum outils. Merci (ou contactez Bodéga 49145).";
  } else {
    echo "<h1>La Tanière $id_taniere est supprimée</h1>";
    echo "<h2>Id Troll Propriétaire  : $id_troll_taniere</h2>";
    echo "<a href='$page?troll=$id_troll_taniere'>Retour à la fiche du troll propriétaire</a> ";
  }
}

#####################################
# Selectionne une ou plusieurs tanieres 
# d'un troll donné (ou non si l'on connait l'id_taniere)
#####################################
function selectDbTanieres($id_taniere="", $id_troll_taniere="", $gt_only=false)
{
	global $db_vue_rm;

	$sql = "SELECT id_taniere, id_troll_taniere, description_taniere, ";
	$sql .= " contenu_taniere, vente_taniere, date_maj_taniere, nom_troll,nom_image_troll,";
	$sql .= " nom_lieu, x_lieu, y_lieu, z_lieu";
	$sql .= " FROM tanieres, lieux, trolls";
	$sql .= " WHERE id_taniere = id_lieu";
	$sql .= " AND id_troll_taniere = id_troll";
	
	if ($id_taniere != "")
		$sql .= " AND id_taniere=$id_taniere";
		
	if ($id_troll_taniere != "")
		$sql .= " AND id_troll_taniere=$id_troll_taniere";
		
	if ($gt_only)
		$sql .= " AND nom_lieu not like 'Tanière%'";

	$sql .= " ORDER BY nom_troll";

	$lesTanieres = false;

	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
		echo "<br>chaine sql = $sql<br>";
	} else {
		$i=1;
		while ($taniere = mysql_fetch_assoc($result)) {
			$lesTanieres[$i]['id_taniere']=$taniere['id_taniere'];
			$lesTanieres[$i]['nom_troll']=$taniere['nom_troll'];
			$lesTanieres[$i]['nom_image_troll']=$taniere['nom_image_troll'];
			$lesTanieres[$i]['id_troll_taniere']=$taniere['id_troll_taniere'];
			$lesTanieres[$i]['id_troll']=$taniere['id_troll_taniere']; // même chose que id_troll_taniere,ne pas supprimer
			$lesTanieres[$i]['description_taniere']=$taniere['description_taniere'];
			$lesTanieres[$i]['contenu_taniere']=$taniere['contenu_taniere'];
			$lesTanieres[$i]['vente_taniere']=$taniere['vente_taniere'];
			$lesTanieres[$i]['date_maj_taniere']=$taniere['date_maj_taniere'];
			$lesTanieres[$i]['nom_lieu']=$taniere['nom_lieu'];
			$lesTanieres[$i]['x_lieu']=$taniere['x_lieu'];
			$lesTanieres[$i]['y_lieu']=$taniere['y_lieu'];
			$lesTanieres[$i]['z_lieu']=$taniere['z_lieu'];

			$i++;
		} 
	}
	return $lesTanieres;
}

#####################################
# Selectionne une ou plusieurs tanières d'un troll donné (ou non si l'on connait l'id_taniere)
# Mais uniquement depuis la table des tanières (pour rechercher des erreurs d'id, 
# que l'on signale dans la fiche du troll)
#####################################
function selectDbTanieresFromTableTanieres($id_taniere="", $id_troll_taniere="")
{
	global $db_vue_rm;

	$sql = "SELECT id_taniere, id_troll_taniere, description_taniere ";
	$sql .= " FROM tanieres";
	$sql .= " WHERE ";
	
	if ($id_taniere != "")
		$sql .= " id_taniere=$id_taniere";

	$mot="";	
	if ($id_taniere != "")
		$mot = " AND ";
		
	if ($id_troll_taniere != "")
		$sql .= " $mot id_troll_taniere=$id_troll_taniere";
		
	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
		echo "<br>chaine sql = $sql<br>";
	} else {
		$i=1;
		while ($taniere = mysql_fetch_assoc($result)) {
			$lesTanieres[$i]['id_taniere']=$taniere['id_taniere'];
			$lesTanieres[$i]['id_troll_taniere']=$taniere['id_troll_taniere'];
			$i++;
		} 
	}
	return $lesTanieres;
}

#####################################
# Selectionne un ou plusieurs Trolls 
#####################################
function selectDbRechercheTrolls($id_troll, $nom_troll, $race_troll, $nom_guilde, $niveau_troll,
                                 $is_tk_troll, $is_wanted_troll, $is_venge_troll,
															 	 $x_troll, $y_troll, $z_troll, $limite, $statut_troll, $statut_guilde)
{
	global $db_vue_rm;

	$i=1;

	$sql = "SELECT id_troll, nom_troll, nom_guilde, id_guilde, statut_guilde, ";
	$sql .= " is_wanted_troll, is_tk_troll, is_venge_troll, is_admin_troll, ";
	$sql .= " x_troll, y_troll, z_troll, date_troll, statut_troll, race_troll,";
	$sql .= " nom_image_troll, is_seen_troll, niveau_troll, maj_groupe_spec_troll";
	$sql .= " FROM trolls, guildes";

	$sql .= " WHERE id_guilde = guilde_troll";
	
	if ($id_troll != "")
		$sql .= " AND id_troll like '%$id_troll%'";
	if ($nom_troll != "")
		$sql .= " AND nom_troll like '%".strtolower($nom_troll)."%'";
	if ($nom_guilde != "")
		$sql .= " AND nom_guilde like '%".strtolower($nom_guilde)."%'";
	if ($race_troll != "")
		$sql .= " AND race_troll = '$race_troll'";
	if ($niveau_troll != "") {
			$firstc=substr($niveau_troll,0,1);
			$lastc=substr($niveau_troll,strlen($niveau_troll)-1,1);
			echo "*L$lastc* -- *F$firstc* -- *N$niveau_troll*";
			if ($firstc<=0) {
				$level=substr($niveau_troll,1, strlen($niveau_troll)-1)+1;
				echo "first $level";
			}
			elseif ($lastc<=0) {
				$level=substr($niveau_troll,0, strlen($niveau_troll)-1)+1;
				$firstc=$lastc;
				echo "last $level";
			}
			else $level=$niveau_troll+1;
			switch ($firstc) {
				case "<": $oper="<"; break;
				case ">": $oper=">"; break;
				case "+": $oper=">"; break;
				case "-": $oper="<"; break;
				default: $oper="=";
			}
			$level=$level-1;
			echo "<h3>$oper *$level*</h3>";
			if ($level>-1)
				$sql .= " AND niveau_troll $oper $level";
		}
	if ($is_tk_troll != "")
		$sql .= " AND is_tk_troll = 'oui'";
	if ($is_wanted_troll != "")
		$sql .= " AND is_wanted_troll = 'oui'";
	if ($is_venge_troll != "")
		$sql .= " AND is_venge_troll = 'oui'";
	if ($statut_troll != "")
		$sql .= " AND statut_troll = '$statut_troll'";
	if ($statut_guilde != "")
		$sql .= " AND statut_guilde = '$statut_guilde'";
		
/*	if ( ($x_troll != "") && ($y_troll != "") && ($z_troll != "")) {
		$x_max = $x_troll + $limite;	
		$x_min = $x_troll - $limite;	
		$y_max = $y_troll + $limite;	
		$y_min = $y_troll - $limite;	
		$z_max = $z_troll + $limite;	
		$z_min = $z_troll - $limite;	
		
		$sql .= " AND x_troll >= $x_min";
		$sql .= " AND x_troll <= $x_max";
		$sql .= " AND y_troll >= $y_min";
		$sql .= " AND y_troll <= $y_max";
		$sql .= " AND z_troll >= $z_min";
		$sql .= " AND z_troll <= $z_max";
	}
	*/	
	$sql .= " ORDER BY nom_troll ";
	//$sql .= " LIMIT 0,100 ";

	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
		echo "<br>chaine sql = $sql<br>";
	} else {
		while ($troll = mysql_fetch_assoc($result)) {
			if ( is_numeric($x_troll) && is_numeric($y_troll) && is_numeric($z_troll) ) {
				$lesTrolls[$i]['distance_pa']= calcPA($x_troll,$y_troll,$z_troll,$troll[x_troll],$troll[y_troll],$troll[z_troll]);
			}
			$lesTrolls[$i]['id_troll']=$troll['id_troll'];
			$lesTrolls[$i]['nom_troll']=$troll['nom_troll'];
			$lesTrolls[$i]['nom_guilde']=$troll['nom_guilde'];
			$lesTrolls[$i]['id_guilde']=$troll['id_guilde'];
			$lesTrolls[$i]['x_troll']=$troll['x_troll'];
			$lesTrolls[$i]['y_troll']=$troll['y_troll'];
			$lesTrolls[$i]['z_troll']=$troll['z_troll'];
			$lesTrolls[$i]['race_troll']=$troll['race_troll'];
			$lesTrolls[$i]['date_troll']=$troll['date_troll'];
			$lesTrolls[$i]['statut_troll']=$troll['statut_troll'];
			$lesTrolls[$i]['statut_guilde']=$troll['statut_guilde'];
			$lesTrolls[$i]['is_tk_troll']=$troll['is_tk_troll'];
			$lesTrolls[$i]['is_wanted_troll']=$troll['is_wanted_troll'];
			$lesTrolls[$i]['is_venge_troll']=$troll['is_venge_troll'];
			$lesTrolls[$i]['is_seen_troll']=$troll['is_seen_troll'];
			$lesTrolls[$i]['niveau_troll']=$troll['niveau_troll'];
			$lesTrolls[$i]['maj_groupe_spec_troll']=$troll['maj_groupe_spec_troll'];
			$i++;
		} 
	}

	return $lesTrolls;
}

#####################################
# Selectionne un ou plusieurs Monstres 
#####################################
function selectDbRechercheMonstres($id_monstre, $nom_monstre="", 
																	 $x_monstre="", $y_monstre="", $z_monstre="", $limite="", $race="", $famille="", $niveau="")
{
	global $db_vue_rm;
	
	$i=1;

	$sql = "SELECT id_monstre, nom_monstre,";
	$sql .= " x_monstre, y_monstre, z_monstre, date_monstre";
	$sql .= " FROM monstres";
	
	// juste pour utiliser le where pour pas m'embetter avec après ! :)
	// à revoir surement... 
	$sql .= " WHERE date_monstre != ''"; 
	
	if ( ($x_monstre != "") && ($y_monstre != "") && ($z_monstre != "") && ($limite != "")) {
		$x_max = $x_monstre + $limite;	
		$x_min = $x_monstre - $limite;	
		$y_max = $y_monstre + $limite;	
		$y_min = $y_monstre - $limite;	
		$z_max = $z_monstre + $limite;	
		$z_min = $z_monstre - $limite;	
		
		$sql .= " AND x_monstre >= $x_min";
		$sql .= " AND x_monstre <= $x_max";
		$sql .= " AND y_monstre >= $y_min";
		$sql .= " AND y_monstre <= $y_max";
		$sql .= " AND z_monstre >= $z_min";
		$sql .= " AND z_monstre <= $z_max";
	}
	
	if ($id_monstre != "")
		$sql .= " AND id_monstre like '%$id_monstre%'";
	if ($nom_monstre != "")
		$sql .= " AND lower(nom_monstre) like '%".strtolower($nom_monstre)."%'";
		
	$sql .= " ORDER BY nom_monstre ";

	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
		echo "<br>chaine sql = $sql<br>";
	} else {
		while ($monstre = mysql_fetch_assoc($result)) {
			if ( is_numeric($x_monstre) && is_numeric($y_monstre) && is_numeric($z_monstre) ) {
				$lesMonstres[$i]['distance_pa']= calcPA($x_monstre,$y_monstre,$z_monstre,$monstre[x_monstre],$monstre[y_monstre],$monstre[z_monstre]);
			}
			
			unset($tab);
			$mNom = stripslashes(stripslashes($monstre['nom_monstre']));
			$tab = getInfoFromMonstre($mNom);


			$infos_monstre = $tab;
			$caracs_moyennes = SelectCaracMoyMonstre($tab['id_race'],$tab['id_template'],$tab['id_age']);

			//if($caracs_moyennes['niv']!='?' && $caracs_moyennes['niv']!='') 
			//	$tab['niv']=$caracs_moyennes['niv']; // niveau calculé		
			//else
			//	$tab['niv']=$tab['niv']; // niveau estimÃ©


			if ($niveau != "") {
				if ($niveau != $tab['niv'] && ($niveau+1) != $tab['niv'] && ($niveau-1) != $tab['niv'] ){
					continue;
				}
			}
			
			if ($race != "") {
				//if ($tab['race']	!= $race)
				if (!preg_match("/".strtolower($race)."/",strtolower($tab['race'])))
					continue;
			}

			if ($famille != "") {
				//if ($tab['famille']	!= $famille)
				if (!preg_match("/".strtolower($famille)."/",strtolower($tab['famille'])))
					continue;
			}
			
			$lesMonstres[$i]['niveau']= $tab['niv']; // niveau estim
			$lesMonstres[$i]['race']= $tab['race'];

			$lesMonstres[$i]['famille']=$tab['famille'];
			$lesMonstres[$i]['id_monstre']=$monstre['id_monstre'];
			$lesMonstres[$i]['nom_monstre']=$monstre['nom_monstre'];
			$lesMonstres[$i]['x_monstre']=$monstre['x_monstre'];
			$lesMonstres[$i]['y_monstre']=$monstre['y_monstre'];
			$lesMonstres[$i]['z_monstre']=$monstre['z_monstre'];
			$lesMonstres[$i]['date_monstre']=$monstre['date_monstre'];
			$i++;
		} 
	}
	return $lesMonstres;
}

#####################################
# Selectionne un ou plusieurs Lieux 
#####################################
function selectDbLieux($id_lieu="",$nom_lieu="", $x_lieu="", $y_lieu="", $z_lieu="",$limite="")
{
	global $db_vue_rm;

	$i=1;

	$sql = "SELECT id_lieu, nom_lieu, x_lieu, y_lieu, z_lieu, date_lieu";
	$sql .= " FROM lieux";

	if (($id_lieu != "") || ($nom_lieu != "") ||
			($x_lieu != "") && ($y_lieu != "") && ($z_lieu != ""))
		$sql .= " WHERE";

	if ($id_lieu != "")
		$sql .= " id_lieu like '%$id_lieu%'";
	
	$mot = "";
	if ($id_lieu != "" )
		$mot = " AND ";
		
//	if ($nom_lieu != "") {
		$sql .= "$mot nom_lieu like '%".strtolower($nom_lieu)."%'";
//		$mot = " AND ";
//	}
/*
	if ( ($x_lieu != "") && ($y_lieu != "") && ($z_lieu != "")) {
		$x_max = $x_lieu + $limite;	
		$x_min = $x_lieu - $limite;	
		$y_max = $y_lieu + $limite;	
		$y_min = $y_lieu - $limite;	
		$z_max = $z_lieu + $limite;	
		$z_min = $z_lieu - $limite;	
		
		$sql .= " $mot x_lieu >= $x_min";
		$sql .= " AND x_lieu <= $x_max";
		$sql .= " AND y_lieu >= $y_min";
		$sql .= " AND y_lieu <= $y_max";
		$sql .= " AND z_lieu >= $z_min";
		$sql .= " AND z_lieu <= $z_max";
	}*/

	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
		echo "<br>chaine sql = $sql<br>";
	} else {
		while ($lieu = mysql_fetch_assoc($result)) {
			if ( is_numeric($x_lieu) && is_numeric($y_lieu) && is_numeric($z_lieu) ) {
				$lesLieux[$i]['distance_pa']= calcPA($x_lieu,$y_lieu,$z_lieu,$lieu[x_lieu],$lieu[y_lieu],$lieu[z_lieu]);
			}
			$lesLieux[$i]['id_lieu']=$lieu['id_lieu'];
			$lesLieux[$i]['nom_lieu']=$lieu['nom_lieu'];
			$lesLieux[$i]['x_lieu']=$lieu['x_lieu'];
			$lesLieux[$i]['y_lieu']=$lieu['y_lieu'];
			$lesLieux[$i]['z_lieu']=$lieu['z_lieu'];
			$lesLieux[$i]['date_lieu']=$lieu['date_lieu'];
			$i++;
		} 
	}

	return $lesLieux;
}

#####################################
# Selectionne un ou plusieurs Champignons
#####################################
function selectDbRechercheChampignons($id_champi, $nom_champi="", $x_champi="", $y_champi="", $z_champi="", 
																			$limite="", $is_seen_champi="")
{
	global $db_vue_rm;

	$i=1;

	$sql = "SELECT id_champi, nom_champi,";
	$sql .= " x_champi, y_champi, z_champi, date_champi, is_seen_champi";
	$sql .= " FROM champignons";
	
	// juste pour utiliser le where pour pas m'embetter avec après ! :)
	// à revoir surement... 
	$sql .= " WHERE date_champi != ''"; 
	
	if ($id_champi != "")
		$sql .= " AND id_champi like '%$id_champi%'";
	if ($nom_champi != "")
		$sql .= " AND lower(nom_champi) like '%".strtolower($nom_champi)."%'";

	if ($is_seen_champi != "")
		$sql .= " AND is_seen_champi = '$is_seen_champi'";
/*		
	if ( ($x_champi != "") && ($y_champi != "") && ($z_champi != "")) {
		$x_max = $x_champi - $limite;	
		$x_min = $x_champi + $limite;	
		$y_max = $y_champi - $limite;	
		$y_min = $y_champi + $limite;	
		$z_max = $z_champi - $limite;	
		$z_min = $z_champi + $limite;	
		
		$sql .= " AND x_champi >= $x_min";
		$sql .= " AND x_champi <= $x_max";
		$sql .= " AND y_champi >= $y_min";
		$sql .= " AND y_champi <= $y_max";
		$sql .= " AND z_champi >= $z_min";
		$sql .= " AND z_champi <= $z_max";
	}
	*/	
	$sql .= " ORDER BY nom_champi ";
	//$sql .= " LIMIT 0,100 ";

	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
		echo "<br>chaine sql = $sql<br>";
	} else {
		while ($champi = mysql_fetch_assoc($result)) {
			if ( is_numeric($x_champi) && is_numeric($y_champi) && is_numeric($z_champi) ) {
				$lesChampignons[$i]['distance_pa']= calcPA($x_champi,$y_champi,$z_champi,$champi[x_champi],$champi[y_champi],$champi[z_champi]);
			}
			$lesChampignons[$i]['id_champi']=$champi['id_champi'];
			$lesChampignons[$i]['nom_champi']=$champi['nom_champi'];
			$lesChampignons[$i]['x_champi']=$champi['x_champi'];
			$lesChampignons[$i]['y_champi']=$champi['y_champi'];
			$lesChampignons[$i]['z_champi']=$champi['z_champi'];
			$lesChampignons[$i]['date_champi']=$champi['date_champi'];
			$lesChampignons[$i]['is_seen_champi']=$champi['is_seen_champi'];
			$i++;
		} 
	}
	return $lesChampignons;
}


#####################################
# Selectionne un ou plusieurs Tresors
#####################################
function selectDbRechercheTresors($id_tresor, $nom_tresor, $x_tresor, $y_tresor, $z_tresor,	$limite)
{
	global $db_vue_rm;

	$i=1;

	$sql = "SELECT id_tresor, nom_tresor,";
	$sql .= " x_tresor, y_tresor, z_tresor, date_tresor";
	$sql .= " FROM tresors";
	
	// juste pour utiliser le where pour pas m'embetter avec après ! :)
	// à revoir surement... 
	$sql .= " WHERE date_tresor != ''"; 
	
	if ($id_tresor!= "")
		$sql .= " AND id_tresor like '%$id_tresor%'";
	if ($nom_tresor!= "")
		$sql .= " AND lower(nom_tresor) like '%".strtolower($nom_tresor)."%'";
/*
	if ( ($x_tresor!= "") && ($y_tresor != "") && ($z_tresor != "")) {
		$x_max = $x_tresor - $limite;	
		$x_min = $x_tresor + $limite;	
		$y_max = $y_tresor - $limite;	
		$y_min = $y_tresor + $limite;	
		$z_max = $z_tresor - $limite;	
		$z_min = $z_tresor + $limite;	
		
		$sql .= " AND x_tresor >= $x_min";
		$sql .= " AND x_tresor <= $x_max";
		$sql .= " AND y_tresor >= $y_min";
		$sql .= " AND y_tresor <= $y_max";
		$sql .= " AND z_tresor >= $z_min";
		$sql .= " AND z_tresor <= $z_max";
	}
		*/
	$sql .= " ORDER BY nom_tresor ";
	//$sql .= " LIMIT 0,100 ";

	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
		echo "<br>chaine sql = $sql<br>";
	} else {
		while ($tresor = mysql_fetch_assoc($result)) {
			$lesTresors[$i]['id_tresor']=$tresor['id_tresor'];
			$lesTresors[$i]['nom_tresor']=$tresor['nom_tresor'];
			$lesTresors[$i]['x_tresor']=$tresor['x_tresor'];
			$lesTresors[$i]['y_tresor']=$tresor['y_tresor'];
			$lesTresors[$i]['z_tresor']=$tresor['z_tresor'];
			$lesTresors[$i]['date_tresor']=$tresor['date_tresor'];
			$i++;
		} 
	}
	return $lesTresors;
}

#####################################
# Selectionne un ou plusieurs trolls avec un chargement recherché 
#####################################
function selectDbChargement($chargement_id_troll, $chargement_1, $chargement_2, $chargement_3)
{
	global $db_vue_rm;

	// On peut faire ce traitement en une seule requ avec OUTER JOIN (mais la flême ce soir ;-) )

	$i=1;

	$sql = "SELECT id_troll, equipement_troll, nom_troll";
	$sql .= " FROM trolls";
	$sql .= " WHERE";
	$sql .= " ( equipement_troll like '%$chargement_1%'";

	if ($chargement_2 != "")
		$sql .= " OR equipement_troll like '%$chargement_2%'";
	if ($chargement_3 != "")
		$sql .= " OR equipement_troll like '%$chargement_3%'";

	$sql .= ")";

	if ($chargement_id_troll != -1)
		$sql .= " AND id_troll = $chargement_id_troll";
		
	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
		echo "<br>chaine sql = $sql<br>";
	} else {
		while ($chargement = mysql_fetch_assoc($result)) {
			$lesChargements[$i]['id_troll']=$chargement['id_troll'];
			$lesChargements[$i]['nom_troll']=$chargement['nom_troll'];
			$lesChargements[$i]['id_gowap']="";
			$lesChargements[$i]['chargement_troll']=$chargement['equipement_troll'];
			$lesChargements[$i]['chargement_gowap']="";
			$i++;
		} 
	}

	$sql = "SELECT id_gowap, id_troll_gowap, chargement_gowap, date_chargement_gowap, nom_troll";
	$sql .= " FROM gowaps, trolls";
	$sql .= " WHERE";
	$sql .= " id_troll = id_troll_gowap";
	$sql .= " AND ( chargement_gowap like '%$chargement_1%'";

	if ($chargement_2 != "")
		$sql .= " OR chargement_gowap like '%$chargement_2%'";
	if ($chargement_3 != "")
		$sql .= " OR chargement_gowap like '%$chargement_3%'";
	
	$sql .= ")";
	$sql .= " AND id_troll_gowap = id_troll";

	if ($chargement_id_troll != -1)
		$sql .= " AND id_troll_gowap = $chargement_id_troll";

	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
		echo "<br>chaine sql = $sql<br>";
	} else {
		while ($chargement = mysql_fetch_assoc($result)) {
			$lesChargements[$i]['id_troll']=$chargement['id_troll_gowap'];
			$lesChargements[$i]['nom_troll']=$chargement['nom_troll'];
			$lesChargements[$i]['id_gowap']=$chargement['id_gowap'];
			$lesChargements[$i]['chargement_troll']="";
			$lesChargements[$i]['chargement_gowap']=$chargement['chargement_gowap'];
			$i++;
		} 
	}

	$sql = "SELECT id_taniere, id_troll_taniere, contenu_taniere, vente_taniere,nom_troll, id_troll_taniere";
	$sql .= " FROM tanieres, trolls";
	$sql .= " WHERE";
	$sql .= " id_troll = id_troll_taniere";
	$sql .= " AND ( contenu_taniere like '%$chargement_1%'";
	$sql .= " OR vente_taniere like '%$chargement_1%'";

	if ($chargement_2 != "") {
		$sql .= " OR contenu_taniere like '%$chargement_2%'";
		$sql .= " OR vente_taniere like '%$chargement_2%'";
	}
	if ($chargement_3 != "") {
		$sql .= " OR contenu_taniere like '%$chargement_3%'";
		$sql .= " OR vente_taniere like '%$chargement_3%'";
	}
	
	$sql .= ")";
	$sql .= " AND id_troll_taniere = id_troll";

	if ($chargement_id_troll != -1)
		$sql .= " AND id_troll_taniere = $chargement_id_troll";

	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
		echo "<br>chaine sql = $sql<br>";
	} else {

		while ($chargement = mysql_fetch_assoc($result)) {
			$lesChargements[$i]['id_troll']=$chargement['id_troll_taniere'];
			$lesChargements[$i]['nom_troll']=$chargement['nom_troll'];
			$lesChargements[$i]['id_taniere']=$chargement['id_taniere'];
			$lesChargements[$i]['chargement_troll']="";
			$lesChargements[$i]['chargement_gowap']="";
			$lesChargements[$i]['chargement_taniere']="oui";
			$i++;
		} 
	}
	return $lesChargements;
}

######################################
# Modifie le mot de passe d'un troll dans
# la base de données
######################################
function editDbPassword()
{
	global $db_vue_rm;

	isControlAdministrateur("yes"); // Control strict de l'administrateur

	$id_troll = $_REQUEST['id_troll'];
	$nom_troll = $_REQUEST['nom_troll'];
	$pass_troll = $_REQUEST['pass_troll'];

	$sql = " UPDATE trolls SET";
	$sql .= " pass_troll='$pass_troll'";
	$sql .= " WHERE id_troll=$id_troll";
		
	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
		echo "<br>chaine sql = $sql<br>";
		echo "<font color=red>Erreur dans le changement du mot de passe du troll.";
		echo "Copiez / Collez ce que vous voyez et postez";
		echo " cela dans le forum outils. Merci (ou contactez Bodéga 49145)</font>";
	} else {
		echo "<h1>Le mot de passe du Troll $nom_troll ($id_troll) est modifié</h1>";
		echo "<a href='engine_view.php?troll=liste'>Liste des trolls</a> ";
		echo "<a href='engine_view.php?troll=$id_troll'>Fiche du troll</a>";
	}

}

########################################
# Sélectionne les caractéristiques d'un troll
# dans la table VTT
########################################
function selectDbVtt($id_troll, $Competence="")
{
	global $db_vue_rm;

	$sql ="SELECT *,";
	$sql .= " HOUR(TIMEDIFF(NOW(),DateMaj)) as Peremption,";
	$sql .= " UNIX_TIMESTAMP(DateMaj) as date_maj, race_troll, niveau_troll";
	$sql .= " FROM vtt,trolls";
	$sql .= " WHERE No = $id_troll";
	$sql .= " AND id_troll = No";

	if ($Competence != "")
		$sql .= " AND Comps like '%".$Competence."%'";
	
	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
		echo "<br>chaine sql = $sql<br>";
	} else {
		$vtt = mysql_fetch_assoc($result);
	}
	return $vtt;
}

##################################
# Modification d'une distinction dans la base de données
##################################
function editDbDistinction()
{
	global $db_vue_rm;

  $page = "engine_view.php";

	isControlAdministrateur("yes"); // Control strict de l'administrateur
	// Récupération des variables du formulaire
	$id_distinction = $_REQUEST['id_distinction'];
	$nom_distinction = $_REQUEST['nom_distinction'];
	$nom_image_distinction = $_REQUEST['nom_image_distinction'];
	$nom_image_titre_distinction = $_REQUEST['nom_image_titre_distinction'];

	// Si l'on veut ajouter la distinction
	if ($id_distinction == "new") {
		// On l'ajoute dans la base de données
		$sql = "INSERT into distinctions (nom_distinction)";
		$sql .= "VALUES ('".addslashes($nom_distinction)."')";
		mysql_query($sql,$db_vue_rm);

		echo mysql_error();
		// puis on récupère l'identifiant qui vient de se faire rentrer
		$id_distinction =mysql_insert_id($db_vue_rm); 
		$info_action = "ajoutée";
	} else {
		$info_action = "modifiée";
	}

	$sql = " UPDATE distinctions SET ";
	$sql .= " nom_distinction='".addslashes($nom_distinction)."',";
	$sql .= " nom_image_distinction='$nom_image_distinction',";
	$sql .= " nom_image_titre_distinction='$nom_image_titre_distinction'";
	$sql .= " WHERE id_distinction = $id_distinction";

	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
		echo "<br>chaine sql = $sql<br>";
		echo "Erreur dans la mise à jour de la distinction. Copiez / Collez ce que vous voyez et postez";
		echo " cela dans le forum outils. Merci (ou contactez Bodéga 49145).";
		$erreur = "oui";
	}

	if ($erreur != 'oui') {
		echo "<h1>La distinction ".stripslashes($nom_distinction)." est $info_action</h1>";
		echo "<a href='$page?distinction=liste'>Retour à la liste</a> ";
		echo "<a href='$page?distinction=$id_distinction'>Retour à la fiche de la distinction</a>";
	}
}


#####################################
# Selectionne les distinctions RM
#####################################
function selectDbDistinctions($id="")
{
	global $db_vue_rm;

	$i=1;

	$sql = "SELECT id_distinction, nom_distinction, nom_image_distinction, nom_image_titre_distinction";
	$sql .= " FROM distinctions";

	if ($id != "")
		$sql .= " WHERE id_distinction = $id";

	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
		echo "<br>chaine sql = $sql<br>";
	} else {
		while ($distinction = mysql_fetch_assoc($result)) {
			$lesDistinctions[$i]['id_distinction']=$distinction['id_distinction'];
			$lesDistinctions[$i]['nom_distinction']=$distinction['nom_distinction'];
			$lesDistinctions[$i]['nom_image_distinction']=$distinction['nom_image_distinction'];
			$lesDistinctions[$i]['nom_image_titre_distinction']=$distinction['nom_image_titre_distinction'];
			$i++;
		} 
	}
	return $lesDistinctions;
}

##########################################
# Suppression d'une distinction
# dans la base de données
##########################################
function deleteDbDistinction()
{
  global $db_vue_rm;

  $page = "engine_view.php";

  // Récupération des variables du formulaire
  $id_distinction = $_REQUEST[id_distinction];
	
	// On regarde si la distinction est utilisée 
	$lesTrolls = selectDbTrolls("","","",$id_distinction);
	$nbTrolls = count($lesTrolls);;
	if ($nbTrolls > 0 ) {
		$msg = "<br><font color=red><b>Suppression Impossible, ";
		$msg .= "la distinction est utilisée par un troll </font></br>";
		die($msg);
	}

  $sql = " DELETE FROM distinctions";
  $sql .= " WHERE id_distinction=$id_distinction";
	
	echo "$sql<br>";
  if (!$result=mysql_query($sql,$db_vue_rm)) {
    echo mysql_error();
    echo "<br>chaine sql = $sql<br>";
    echo "Erreur dans la suppression de la distinction. Copiez / Collez ce que vous voyez et postez";
    echo " cela dans le forum outils. Merci (ou contactez Bodéga 49145).";
  } else {
    echo "<h1>La distinction $id_distinction est supprimée</h1>";
    echo "<a href='$page?distinction=liste>Retour à la liste des distinctions</a> ";
  }
}

##################################
# Modification d'un composant prioritaire dans la base de données
##################################
function editDbComposant()
{
	global $db_vue_rm;

  $page = "engine_view.php";

	// Récupération des variables du formulaire
	$id_composant = $_REQUEST['id_composant'];
	$nom_composant = $_REQUEST['nom_composant'];
	$id_race_composant = $_REQUEST['id_race_composant'];
	$priorite_composant = $_REQUEST['priorite_composant'];
	$date_fin_composant = $_REQUEST['date_fin_composant'];
	$commentaire_composant = $_REQUEST['commentaire_composant'];

	$date_fin_composant = substr($date_fin_composant,6,4)."-".substr($date_fin_composant,3,2)."-".substr($date_fin_composant,0,2);

	// Si l'on veut ajouter le composant
	if ($id_composant == "new") {
		// On l'ajoute dans la base de données
		mysql_query("INSERT into composants (nom_composant) VALUES ('".addslashes($nom_composant)."')");
		echo mysql_error();
		// puis on récupère l'identifiant qui vient de se faire rentrer
		$id_composant =mysql_insert_id($db_vue_rm); 
		$info_action = "ajouté";
	} else {
		$info_action = "modifié";
	}

	$sql = " UPDATE composants SET ";
	$sql .= " nom_composant ='".addslashes($nom_composant)."',";
	$sql .= " id_race_composant ='".addslashes($id_race_composant)."',"; // C'est une chaine !
	$sql .= " priorite_composant ='".$priorite_composant."',";
	$sql .= " date_fin_composant ='".$date_fin_composant."',";
	$sql .= " commentaire_composant ='".htmlentities(addslashes($commentaire_composant))."'";
	$sql .= " WHERE id_composant = $id_composant";

	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
		echo "<br>chaine sql = $sql<br>";
		echo "Erreur dans la mise à jour du composant. Copiez / Collez ce que vous voyez et postez";
		echo " cela dans le forum outils. Merci (ou contactez Bodéga 49145).";
		$erreur = "oui";
	}

	if ($erreur != 'oui') {
		echo "<h1>Le composant prioritaire ".stripslashes($nom_composant)." est $info_action</h1>";
		echo "<a href='$page?composant=liste'>Retour à la liste</a> - ";
		echo "<a href='$page?composant=$id_composant'>Retour à la fiche du composant</a> - ";
		echo "<a href='$page?composant=new'>Insérer un nouveau composant</a>";
	}
}


#####################################
# Selectionne les composants Prioritaires
#####################################
function selectDbComposants($id="")
{
	global $db_vue_rm;

	$i=1;

	$sql = "SELECT id_composant, nom_composant, id_race_composant,";
	$sql .= " UNIX_TIMESTAMP(date_fin_composant) as date_fin_composant,";
	$sql .= " priorite_composant, commentaire_composant";
	$sql .= " FROM composants";

	if ($id != "")
		$sql .= " WHERE id_composant= $id";

	$sql .= " ORDER BY id_race_composant";

	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
		echo "<br>chaine sql = $sql<br>";
	} else {
		while ($composant = mysql_fetch_assoc($result)) {
			$lesComposants[$i]['id_composant']=$composant['id_composant'];
			$lesComposants[$i]['nom_composant']=$composant['nom_composant'];
			$lesComposants[$i]['priorite_composant']=$composant['priorite_composant'];
			$lesComposants[$i]['date_fin_composant']=$composant['date_fin_composant'];
			$lesComposants[$i]['id_race_composant']=$composant['id_race_composant'];
			$lesComposants[$i]['commentaire_composant']=$composant['commentaire_composant'];
			$i++;
		} 
	}
	return $lesComposants;
}

##########################################
# Suppression d'un composant prioritaire
# dans la base de données
##########################################
function deleteDbComposant()
{
  global $db_vue_rm;

  $page = "engine_view.php";

  // Récupération des variables du formulaire
	$id_composant = $_REQUEST['id_composant'];

  $sql = " DELETE FROM composants";
  $sql .= " WHERE id_composant=$id_composant";
	
	echo "$sql<br>";
  if (!$result=mysql_query($sql,$db_vue_rm)) {
    echo mysql_error();
    echo "<br>chaine sql = $sql<br>";
    echo "Erreur dans la suppression du composant prioritaire . Copiez / Collez ce que vous voyez et postez";
    echo " cela dans le forum outils. Merci (ou contactez Bodéga 49145).";
  } else {
    echo "<h1>Le composant prioritaire est supprimé</h1>";
    echo "<a href='$page?composant=liste'>Retour à la liste des composants</a> ";
  }
}


#####################################
# Selectionne les races des monstres dans le bestiaire
#####################################
function selectDbBestiareRaces($id="")
{
	global $db_vue_rm;

	$i=1;

	$sql = " SELECT nom_race, nom_famille, image_race ";
	$sql .= " FROM best_races, best_familles ";
	$sql .= " WHERE id_famille_race = id_famille";
	
	if ($id != "")
		$sql .= " WHERE id_race='$id'";
  $sql .= " ORDER by nom_race, nom_famille ";

	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
		echo "<br>chaine sql = $sql<br>";
	} else {
		while ($race = mysql_fetch_assoc($result)) {
			$lesRaces[$i]['nom_race']=$race['nom_race'];
			$lesRaces[$i]['famille_race']=$race['nom_famille'];
			$lesRaces[$i]['image_race']=$race['image_race'];
			$i++;
		} 
	}
	return $lesRaces;
}

#####################################
# Selectionne les famille des monstres dans le bestiaire
#####################################
function selectDbBestiareFamilles($id="")
{
	global $db_vue_rm;

	$i=1;

	$sql = " SELECT nom_famille ";
	$sql .= " FROM best_familles ";
	
	if ($id != "")
		$sql .= " WHERE id_famille='$id'";
  $sql .= " ORDER by nom_famille ";

	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
		echo "<br>chaine sql = $sql<br>";
	} else {
		while ($famille = mysql_fetch_assoc($result)) {
			$lesFamilles[$i]['nom_famille']=$famille['nom_famille'];
			$i++;
		} 
	}
	return $lesFamilles;
}

##############################
# Controle le mot de passe de l'administration
# revoit true si c'est bon
##############################
function isDbAdministration()
{
	global $db_vue_rm;

	$sql = "SELECT count(*) as nb";
	$sql .= " FROM trolls";
	$sql .= " WHERE is_admin_troll = 'oui'";
	$sql .= " AND id_troll = '$_SESSION[AuthTroll]'";

	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
		return false;
	} else {
		$res = mysql_fetch_assoc($result);
		if ($res['nb'] > 0) 
			return true;
		else
			return false;
	}
}


##########################
# Met à jour le VTT en fonction du n°
# appel du script sp_caract de mh
##############################
function updateVTT ($id="")
{
	global $db_vue_rm;
	
	$sql = "SELECT pass_troll ";
	$sql .= "FROM trolls ";
	$sql .= "WHERE id_troll=$id";
	if (!$result=mysql_query($sql,$db_vue_rm))
	{
	  echo mysql_error()." $sql";
	  return false;
	} 
	else 
	{
		$res = mysql_fetch_assoc($result);
		$pass = $res['pass_troll'];
	}
	$filename= "http://sp.mountyhall.com/SP_Caract.php?Numero=$id&Motdepasse=$pass";
	//$filename = "vues/SP_Caract.php";
	$fp = fopen ($filename,"r");
	if ($fp)
	{
		$i=0;
		while (($line = fgets($fp, 1024)))
		{
			if ( eregi("^Erreur",$line) )
			{
				echo "$id erreur appel script<br>";
				return false;
			}
			else
			{
				$liste=split (";",$line);
				if ( $i == 0 || $i == 1 )
				{
					$attb += $liste[1];
					$esqb += $liste[2];
					$degb += $liste[3];
					$regb += $liste[4];
					$vueb += $liste[7];
					$rmb += $liste[8];
					$mmb += $liste[9];
					$armb += $liste[10];
					$dla += $liste[11];
					$dla += $liste[12];
				}
				if ( $i == 2 )
				{
					$att = $liste[1];
					$esq = $liste[2];
					$deg = $liste[3];
					$reg = $liste[4];
					$pvmax = $liste[5];
					$pvact = $liste[6];
					$vue = $liste[7];
					$rm = $liste[8];
					$mm = $liste[9];
					$arm = $liste[10];
					$dlar = $liste[11];
					$dla += $liste[11];
					$dla += $liste[12];
				}
			}
  			$i++;
		}
		$dla += 250 / $pvmax * ($pvmax - $pvact);
		if ($dla < $dlar) $dla = $dlar;
		$dlah = floor($dla/60); 
		$dlam = floor($dla - (60*$dlah));
		$update = "UPDATE vtt SET ";
		$update .= "ATT = $att, ";
		$update .= "ATTB = $attb, ";
		$update .= "ESQ = $esq, ";
		$update .= "ESQB = $esqb, ";
		$update .= "DEG = $deg, ";
		$update .= "DEGB = $degb, ";
		$update .= "REG = $reg, ";
		$update .= "REGB = $regb, ";
		$update .= "PVs = $pvmax, ";
		$update .= "PV_ACTUELS = $pvact, ";
		$update .= "VUEB = $vueb, ";
		$update .= "VUE = $vue, ";
		$update .= "RMB = $rmb, ";
		$update .= "RM = $rm, ";
		$update .= "MMB = $mmb, ";
		$update .= "MM = $mm, ";
		$update .= "DLAH = $dlah, ";
		$update .= "DLAM = $dlam, ";
		$update .= "DateMaj = NOW() ";
		$update .= "WHERE No = $id ";
		
		if (!$result=mysql_query($update,$db_vue_rm)) 
		{
	    	echo mysql_error(). " $update i=$i";
	    	return false;
		}
	    echo $id." a jour<br>";
	    fclose ($fp);
		return true;
	}
	else
	{
		echo "pb ouverture fichier";
		return false;
	}

}
?>
