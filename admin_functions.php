<?

include_once ("inc_connect.php");
include_once ("admin_functions_db.php");

define("COULEUR_RM","#eec614");
define("RELAISMAGO","<font color=".COULEUR_RM.">Relais</font>&<font color=".COULEUR_RM.">Mago</font>");

global $MUNDIDAY;

$MUNDIDAY=array('du Phoenix','de la Mouche','du Dindon','du Goblin','du Démon','de la Limace','du Rat','de l\'Hydre','du Ver','du Fungus','de la Vouivre','du Gnu','du Scarabée');

####################################
## Affiche la fiche d'une barronie
####################################
function afficherFicheBaronnie($id_baronnie)
{
	global $db_vue_rm;

	if ($id_baronnie == "new") {
		$titre = "<h3>Ajout d'une baronnie</h3>";
	} else {
		$lesBaronnies = selectDbBaronnies($id_baronnie);
		$res = $lesBaronnies[1];

		$id_baronnie = $res['id_baronnie'];
		$nom_baronnie = $res['nom_baronnie'];
		$id_baron_baronnie = $res['id_baron_baronnie'];
		$blason_baronnie = $res['blason_baronnie'];
		$img_blason_baronnie = $res['img_blason_baronnie'];
		$img_mini_blason_baronnie = $res['img_mini_blason_baronnie'];
		$img_drapeau_baronnie = $res['img_drapeau_baronnie'];
		$x_deb_baronnie = $res['x_deb_baronnie'];
		$y_deb_baronnie = $res['y_deb_baronnie'];
		$z_deb_baronnie = $res['z_deb_baronnie'];
		$x_fin_baronnie = $res['x_fin_baronnie'];
		$y_fin_baronnie = $res['y_fin_baronnie'];
		$z_fin_baronnie = $res['z_fin_baronnie'];
		$x_trone_baronnie = $res['x_trone_baronnie'];
		$y_trone_baronnie = $res['y_trone_baronnie'];
		$z_trone_baronnie = $res['z_trone_baronnie'];
		$couleur1_baronnie = $res['couleur1_baronnie'];
		$couleur2_baronnie = $res['couleur2_baronnie'];
		
		$titre = "<h2>Baronnie : ".htmlentities(stripslashes($nom_baronnie))."</h2>";
	}
	
	$page = "engine_view.php";

	echo "<form action='$page?baronnie=edit' method='POST'>";
	echo "<br><br>";
	echo "<table style='background-color:#6f7ca2;' class='fiche'>";
	echo "<tr><th colspan='2'>$titre</th></tr>";
	
	//id_baronnie contient new pour une nouvelle baronnie
	echo "<input type='hidden' name='id_baronnie' value='$id_baronnie'>";

	echo "<tr><td><b>Nom baronnie</b></td>";
	echo "<td><input type='text' name='nom_baronnie'";
	echo " value=\"".htmlentities(stripslashes($nom_baronnie))."\" size='50' maxlength='50'></td>";
	echo "</tr><tr>";
	echo "<td><b>N° du Baron</b></td>";
	echo "<td>";//<input type='text' name='id_baron_baronnie' value='$id_baron_baronnie' size='8' maxlength='8'>";
	echo "<select name='id_baron_baronnie'>";
	afficher_listbox_troll_rm_select($id_baron_baronnie, "non");
	echo "</select>";
	if ($id_baronnie != "new") {
		$lien = "href=$page?troll=$id_baron_baronnie";
		echo " <a $lien>Voir sa fiche</a>";
	}
	echo "</td>";
	echo "</tr><tr><td><b>Description Blason</b></td>";
	echo " <td><textarea cols=60 rows=4 name='blason_baronnie'>";
	echo stripslashes($blason_baronnie);
	echo "</textarea>";
	echo "</td></tr>";
	
	echo "<tr><td><b>Image du Blason</b></td>";
	echo "<td><img src='$img_blason_baronnie'><br>";

	// Si c'est l'admin ou le baron
	if (isControlAdministrateur() || ($_SESSION[AuthTroll] == $id_baron_baronnie)) {
		echo "<input type='text' name='img_blason_baronnie' ";
		echo "value='".stripslashes($img_blason_baronnie)."' size='50' maxlength='250'></td>";
	}
	echo "</tr><tr>";

	echo "<tr><td><b>Image du petit Blason</b> <img src='$img_mini_blason_baronnie'></td>";
	echo "<td>";

	// Si c'est l'admin ou le baron
	if (isControlAdministrateur() || ($_SESSION[AuthTroll] == $id_baron_baronnie)) {
		echo "<input type='text' name='img_mini_blason_baronnie' ";
		echo "value='".stripslashes($img_mini_blason_baronnie)."' size='50' maxlength='250'>";
	}
	echo "</td></tr><tr>";

	echo "<tr><td valign='bottom'><b>Image du Drapeau</b> <img src='$img_drapeau_baronnie'></td>";
	echo "<td valign='bottom'>";

	// Si c'est l'admin ou le baron
	if (isControlAdministrateur() || ($_SESSION[AuthTroll] == $id_baron_baronnie)) {
		echo "<input type='text' name='img_drapeau_baronnie' ";
		echo "value='".stripslashes($img_drapeau_baronnie)."' size='50' maxlength='250'>";
	}
	echo "</td></tr><tr>";
	
	echo "<td valign='top'><b><br>Positions</b> <br>";
	echo "<td>";
	
	/* -------- Début coordonnées ------- */
	echo "<table>";
	echo "<tr><td>";

	echo "<b>X début</b></td>";
	echo "<td><input type='text' name='x_deb_baronnie' value='$x_deb_baronnie' size='5' maxlength='5'></td>";
	echo "<td><b>X trone</b></td>";
	echo "<td><input type='text' name='x_trone_baronnie' value='$x_trone_baronnie' size='5' maxlength='5'></td>";
	echo "<td><b>X fin</b></td>";
	echo "<td><input type='text' name='x_fin_baronnie' value='$x_fin_baronnie' size='5' maxlength='5'></td>";
	echo "</tr>";
	
	echo "<tr>";
	echo "<td><b>Y début</b></td>";
	echo "<td><input type='text' name='y_deb_baronnie' value='$y_deb_baronnie' size='5' maxlength='5'></td>";
	echo "<td><b>Y trone</b></td>";
	echo "<td><input type='text' name='y_trone_baronnie' value='$y_trone_baronnie' size='5' maxlength='5'></td>";
	echo "<td><b>Y fin</b></td>";
	echo "<td><input type='text' name='y_fin_baronnie' value='$y_fin_baronnie' size='5' maxlength='5'></td>";
	echo "</tr>";
	
	echo "<tr>";
	echo "<td><b>Z début</b></td>";
	echo "<td><input type='text' name='z_deb_baronnie' value='$z_deb_baronnie' size='5' maxlength='5'></td>";
	echo "<td><b>Z trone</b></td>";
	echo "<td><input type='text' name='z_trone_baronnie' value='$z_trone_baronnie' size='5' maxlength='5'></td>";
	echo "<td><b>Z fin</b></td>";
	echo "<td><input type='text' name='z_fin_baronnie' value=' $z_fin_baronnie' size='5' maxlength='5'></td>";
	echo "</tr>";

	echo "</table><br><br>";
	/* ---------- Fin coordonnées --------- */

	echo "</td></tr><tr>";
	echo "<td><b>Couleurs</b></td>";
	echo "<td>Couleur 1 : <input type='text' name='couleur1_baronnie' value='$couleur1_baronnie' size='6' maxlength='6'>";
	echo "&nbsp;<span style='background: #$couleur1_baronnie'>";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "</span><br>";
	
	echo "Couleur 2 : <input type='text' name='couleur2_baronnie' value='$couleur2_baronnie' size='6' maxlength='6'>";
	echo "&nbsp;<span style='background: #$couleur2_baronnie'>";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "</span>";
	echo "</td></tr>";

	echo "<tr><td>";
	// Bouton ajout Trolls ou supprimer si c'est l'admin ou le baron
	if (isControlAdministrateur() || ($_SESSION[AuthTroll] == $id_baron_baronnie) && ($id_baronnie!="new")) {
		if ($id_baronnie != "new")

			echo "Enlever le troll suivant de la baronnie :</td>";
			echo "<td><select name='enleve_id_troll'>";
			echo "<option value='-1'></option>";

			$lesTrolls = selectDbTrolls("","",$id_baronnie);
			$nbTrolls = count($lesTrolls);

			for($i=1;$i<=$nbTrolls;$i++) {
				$res = $lesTrolls[$i];
				echo "<option value='$res[id_troll]'>".stripslashes($res[nom_troll])." ($res[id_troll])</option>";
			}
			echo "</select></td></tr>";

			echo "<tr><td>Ajouter le troll suivant dans la baronnie :</td><td>";
			echo "<select name='ajoute_id_troll'>";
			afficher_listbox_troll_rm_select();
			echo "</select>";
	}
	echo "</td></tr>";
	echo "</table>";

	// Bouton ajout ou modifier si c'est l'admin ou le baron
	if (isControlAdministrateur() || ($_SESSION[AuthTroll] == $id_baron_baronnie)) {
		if ($id_baronnie == "new")
			echo "<input type='submit' name='submit' value='Ajouter'>&nbsp;";
		else
			echo "<input type='submit' name='submit' value='Modifier'>&nbsp;";
	}

	echo "<input type='Button' value='Retour'";
	echo " onClick='JavaScript=document.location.href=\"$page?baronnie=liste\"'>";
	
	if ($id_baronnie != "new") {
		echo "<h3>Liste des Trolls de la Baronnie ".htmlentities(stripslashes($nom_baronnie))."</h3>";
		afficherListeTrollsBaronnie($id_baronnie);
	}
	echo "</form>";
	
}

####################################
## Affiche la fiche d'une guilde
####################################
function afficherFicheGuilde($id_guilde)
{
	global $db_vue_rm;
	
	$page = "engine_view.php";
	
	$lesGuildes = selectDbGuildes($id_guilde);
	$res = $lesGuildes[1];

	$id_guilde = $res[id_guilde];
	$nom_guilde = $res[nom_guilde];
	$statut_guilde = $res[statut_guilde];
	$gestionnaire_id_troll_guilde = $res[gestionnaire_id_troll_guilde];
  $contact_id_troll_guilde = $res[contact_id_troll_guilde];
  $info_1_guilde = $res[info_1_guilde];
  $diplomate_id_troll_guilde = $res[diplomate_id_troll_guilde];
  $web_guilde = $res[web_guilde];
  $historique_guilde = $res[historique_guilde];
  $nom_gestionnaire = stripslashes($res[nom_gestionnaire]);
  $nom_contact = stripslashes($res[nom_contact]);
  $nom_diplomate = stripslashes($res[nom_diplomate]);

	/* --- On regarde si le troll fait parti de la diplo ou du conseil --- */	
	$isAuthorized = isConseilOrDiplo();
	
	echo "<form action='engine_view.php?guilde=edit' method='POST'>";
	?>
   <table  border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'width='70%'>
     <tr class='mh_tdpage'><td align='center'>
    	<table  border='0' cellpadding='0' cellspacing='1' width='100%' align='center'>
     	 <tr class='mh_tdtitre'>
        <td align='center' colspan='2'><h2>
					<? echo htmlentities(stripslashes($nom_guilde)); ?> </h2>
				</td>
				</tr>
	<?

	echo "<input type='hidden' name='id_guilde' value='$id_guilde'>";
	echo "<input type='hidden' name='nom_guilde' value=\"".htmlentities(stripslashes($nom_guilde))."\">";

	echo "<tr><td><b>Diplomatie</b></td><td>";

	if (isControlAdministrateur() || $isAuthorized) {
		echo "<select name='statut_guilde'>";
		afficher_listbox_select("neutre", $statut_guilde);
		afficher_listbox_select("tk", $statut_guilde);
		afficher_listbox_select("ennemie", $statut_guilde);
		afficher_listbox_select("amie", $statut_guilde);
		afficher_listbox_select("alliee", $statut_guilde, "alliée");
		echo "</select>";
	} else {
		echo $statut_guilde;
	}
	echo "</td></tr>";

	if ($gestionnaire_id_troll_guilde != 0)
		$info_gestionnaire = $nom_gestionnaire;

	if ($contact_id_troll_guilde != 0)
		$info_contact = $nom_contact;

	echo "<tr><td><b>N° Gestionnaire (chef de la guilde) </b></td><td>";
	if (isControlAdministrateur() || $isAuthorized) {
		echo "<input type='textbox' name='gestionnaire_id_troll_guilde' value='$gestionnaire_id_troll_guilde'>";
	}
	echo " $info_gestionnaire ($gestionnaire_id_troll_guilde) ";
	echo "<font size=1>";
	afficherLien("troll","fiche",$gestionnaire_id_troll_guilde);
	echo "</font></td></tr>";

	echo "<tr><td><b>N° Contact </b></td><td>";
	if (isControlAdministrateur() || $isAuthorized) {
		echo "<input type='textbox' name='contact_id_troll_guilde' value='$contact_id_troll_guilde'>";
	}
	echo " $info_contact ($contact_id_troll_guilde)";
	echo "<font size=1>";
	afficherLien("troll","fiche",$contact_id_troll_guilde);
	echo "</font></td></tr>";

	echo "<tr><td><b>Diplomate RM chargé </b></td><td>";
	if (isControlAdministrateur() || $isAuthorized) {
		echo "<select name='diplomate_id_troll_guilde'>";
		afficher_listbox_troll_rm_select($diplomate_id_troll_guilde,"",0);
		echo "</select>";
	}
	echo " $nom_diplomate ($diplomate_id_troll_guilde) ";
	afficherLien("troll","fiche",$gestionnaire_id_troll_guilde);
	echo "</td></tr>";

	echo "<tr><td><b>Site web </b></td><td>";
	if (isControlAdministrateur() || $isAuthorized) {
		echo "<input type='textbox' name='web_guilde' maxlength='250' size=50 value='$web_guilde'> ";
		echo "<a href='$web_guilde'>Voir</a>";
	} else {
		echo "<a href='$web_guilde'>$web_guilde</a>";
	}
	echo "</td></tr>";

	echo "<tr><td><b>Sur MountyHall </b></td><td>";
	$lien_mh = "http://games.mountyhall.com/mountyhall/View/AllianceView.php?ai_IDAlliance=$id_guilde";
	echo "<a href='$lien_mh'>fiche Mh</a>";
	echo "</td></tr>";

	echo "<tr><td colspan='2'><b>Circonstances du premier contact </b></td></tr><tr><td colspan='2'>";
	if (isControlAdministrateur() || $isAuthorized) {
		echo "<textarea name='info_1_guilde' cols='50' rows='5'>";
		echo stripslashes($info_1_guilde);
		echo "</textarea>";
	} else {
		$info_1_guilde = preg_replace("/\n/","<br>",$info_1_guilde);
		echo stripslashes($info_1_guilde);
	}
	echo "</td></tr>";

	echo "<tr><td colspan='2'><b>Historique </b></td></tr><tr><td colspan='2'>";
	if (isControlAdministrateur() || $isAuthorized) {
		echo "<textarea name='historique_guilde' cols='50' rows='5'>";
		echo stripslashes($historique_guilde);
		echo "</textarea>";
	} else {
		$historique_guilde = preg_replace("/\n/","<br>",$historique_guilde);
		echo stripslashes($historique_guilde);
	}
	echo "</tr></td></tr>";

	echo "</table>";

	echo "<a href='$page?troll=filter_guilde_".$id_guilde."'>Voir tous les trolls de cette guilde</a><br><br>";

	/* ---- bouton modifier pour l'administrateur ou pour le conseil / diplo --- */
	if (isControlAdministrateur() || $isAuthorized) {
		echo "<input type='submit' name='submit' value='Modifier' class='mh_form_submit'>&nbsp;";
	}
	echo "<input type='Button' value='Retour Liste' class='mh_form_submit'";
	echo " onClick='JavaScript=document.location.href=\"$page?guilde=liste\">";
	echo "</td></tr></table>";
	echo "</td></tr></table>";
}

#############################
# Affiche une valeur dans une listbox
#############################
function afficher_listbox_select($val, $val_to_select,$display="")
{
	if ($display == "")
		$display = $val;
	if ($val_to_select == $val)
		$selected = "selected";
	else
		$selected="";
	echo "<option value='$val' $selected>$display</option>";
}

#############################
# Affiche une valeur dans une listbox
#############################
function afficher_radio($name, $val, $val_to_select,$display)
{
  echo "<input type='radio' name='$name' value='$val'";
  if ( ($val == $val_to_select) || ($val == "")) echo "CHECKED";
  echo ">";
  echo $display;

}


####################################
## Affiche la fiche d'un Troll
####################################
function afficherFicheTroll($id_troll)
{
	global $db_vue_rm;
	
	$page = "engine_view.php";

	$lesTrolls = selectDbTrolls($id_troll, "");
	$res = $lesTrolls[1];

  // Si le troll n'existe pas dans la base de données, on stoppe
	if ($res[id_troll] == "")
		die("<font color=red>Le troll $id_troll n'existe pas, ou plus, dans la base de données</font>");
				
	$id_troll = $res['id_troll'];
	$nom_troll = $res['nom_troll'];
	$nom_image_troll = $res['nom_image_troll'];
	$id_guilde = $res['id_guilde'];
	$nom_guilde = $res['nom_guilde'];
	$statut_guilde = $res['statut_guilde'];
	$is_tk_troll = $res['is_tk_troll'];
	$is_wanted_troll = $res['is_wanted_troll'];
	$is_venge_troll = $res['is_venge_troll'];
	$is_admin_troll = $res['is_admin_troll'];
	$historique_troll = $res['historique_troll'];
	$id_diplomate_troll= $res['id_diplomate_troll'];
	$statut_troll = $res['statut_troll'];
	$x_troll = $res['x_troll'];
	$y_troll = $res['y_troll'];
	$z_troll = $res['z_troll'];
	$race_troll = $res['race_troll'];
	$date_troll = date("d/m/Y H:i",$res['date_troll']);
	$is_seen_troll = $res['is_seen_troll'];
	$groupe_rm_troll = $res['groupe_rm_troll'];
	$id_distinction = $res['id_distinction'];
	$nom_rang = $res['nom_rang_troll'];
	$num_rang = $res['num_rang_troll'];
	$nom_image_distinction = $res['nom_image_distinction'];
	$nom_image_titre_distinction = $res['nom_image_titre_distinction'];
	$niveau_troll = $res['niveau_troll'];
	$equipement_troll = $res['equipement_troll'];
	$equipement2_troll = $res['equipement2_troll'];
	$nb_mouches = $res['nb_mouches_troll'];
	$nb_morts = $res['nb_morts_troll'];
	$nb_kills = $res['nb_kills_troll'];
	$distinction = $res['distinction_troll'];
	$is_pnj = $res['is_pnj_troll'];
	$majgrpspec = $res['maj_groupe_spec_troll'];
	
	if ($race_troll == "Durakuir")
		$image_race = "durak";
	elseif ($race_troll == "Tomawak")
		$image_race = "tom";
	else
		$image_race = $race_troll;

	// si le troll est tk ou wanted, on affiche l'image tk 
	if (($is_tk_troll == 'oui') || ($is_wanted_troll == 'oui'))
		$image_race = $image_race."-tk";
	?>
 <table  border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'width='70%'>
     <tr class='mh_tdpage'><td >
    	<table  border='0' cellpadding='0' cellspacing='1' width='100%' align='center'>
     	 <tr class='mh_tdtitre'>
        <td align='center' colspan='2'>
					<? afficherGotToRmFiche($id_troll) ?>
				</td></tr></table>
		</td></tr></table>
<?

	echo "<div align='center'><form action='$page?troll=edit' method='POST'>";
	echo "<input type='hidden' name='id_troll' value='$id_troll'>";
	echo "<input type='hidden' name='nom_troll' value=\"".htmlentities(addslashes($nom_troll))."\">";
	
	if ($id_guilde == ID_GUILDE) {
		$img = "images/".strtolower($image_race)."RM.gif";
	} else {
		$img = "images/".strtolower($image_race).".gif";
	}
		
	echo "<img src='$img'><br>";
	?>
 	<?
	echo "<table>";
	/* ------------ première colonne du cadre RM ------------- */
	echo "<tr><td valign='top'>";

	/* ------- Boite de stratégie du troll ------- */	
	afficherFicheTrollInformationsStrategiques($is_tk_troll, $is_venge_troll, $is_wanted_troll, $statut_troll,
																						$id_diplomate_troll, $historique_troll) ;
	
	/* ------- Boite d'Identité du troll ------- */	
	afficherFicheTrollIdentite($nom_troll,$id_troll,$nom_image_troll,$race_troll,$id_guilde,
															$is_seen_troll,$x_troll,$y_troll,$z_troll,$date_troll,
															$is_admin_troll,$nom_guilde,$id_guilde, $statut_guilde,$groupe_rm_troll,
															$id_distinction, $nom_rang, $num_rang, $nom_image_distinction,
															$nom_image_titre_distinction, $niveau_troll,
															$distinction, $nb_mouches,$nb_morts,$nb_kills, $id_pnj_troll, $majgrpspec
															);

	echo "</td><td valign='top'>";

	/* ------------ seconde colonne  ------------- */
	if ($id_guilde == ID_GUILDE) {
		afficherFicheTrollVtt($id_troll) ;
		afficherFicheTrollMouches($id_troll);
	} else {
		afficheFicheTrollAnatomique($id_troll);
	}	

	echo "</td><td valign='top'>";

	/* ------------ troisième colonne  ------------- */
	/* ------------ Blason RM ------------- */
	if ($id_guilde == ID_GUILDE) {
		$img = "http://www.pipeshow.net/RM/blasons/".$nom_image_troll.".gif";
		echo "<img src='$img'>";
	} elseif ($nom_image_troll != "") {
		echo "<img src='$nom_image_troll' width='150' height='231'>";
	}
	echo "<br/>";
	afficherFicheTrollEquipement($id_troll,$equipement_troll,$equipement2_troll);
	/* -------- Boutons ---------- */
	/* ------------ fin du tableu ------------- */
	echo "</td></tr></table>";


	if ($id_guilde == ID_GUILDE) {
	?>
   <table  border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'width='100%'>
     <tr class='mh_tdpage'><td >
    	<table  border='0' cellpadding='0' cellspacing='1' width='100%' align='center'>
     	 <tr class='mh_tdtitre'>
        <td align='center' colspan='2'>
					Autres informations <? echo RELAISMAGO ?>
				</td>
				</tr>
	<?
		echo "<tr class='mh_tdpage'><td width='50%' valign='top'>";
		/* ------ liste gowaps ------- */
		echo "<h3>Liste des Gowaps</h3>";
		afficherListeGowaps($id_troll);

			// Un bouton d'ajout de Gowap pour l'administrateur
		if ((isControlAdministrateur()) || ($_SESSION['AuthTroll'] == $id_troll)) {
			echo "<input type='button' value='Ajouter un gowap' class='mh_form_submit'";
			echo " onClick=\"JavaScript=document.location.href='$page?";
			echo "gowap=new&id_troll_gowap=$id_troll'\">";
		}
		/* ------ fin liste gowaps ------- */
		echo "</td><td width='50%' valign='top'>";	
		/* ------ liste tanières ------- */
		echo "<h3>Liste des Tanières</h3>";
		afficherListeTanieres($id_troll);

		/* ---- bouton d'ajout de tanière pour le troll ou les admin --- */
		if ((isControlAdministrateur()) || ($_SESSION['AuthTroll'] == $id_troll)) {
			echo "<input type='button' value='Ajouter une tanière' class='mh_form_submit'";
			echo " onClick=\"JavaScript=document.location.href='$page?";
			echo "taniere=new&id_troll_taniere=$id_troll'\">";
		}
	/* ------ fin liste tanières ------- */
		echo "</td></tr></table>";
		echo "</td></tr></table><br>";
	}
	
	/* ------ liste griefs ------ */
	?>
   <table  border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'width='100%'>
     <tr class='mh_tdpage'><td >
    	<table  border='0' cellpadding='0' cellspacing='1' width='100%' align='center'>
     	 <tr class='mh_tdtitre'>
        <td align='center' colspan='2'>
					Stratégie
				</td>
				</tr>
	<?

	echo "<tr><td width='50%'>";
	echo "<h3>Liste des Griefs</h3>";
	afficherListeGriefs($id_troll);	

	/* ----- bouton ajout grief ---- */	
	if (isControlAdministrateur()) {
		echo "<input type='button' value='Ajouter un grief' class='mh_form_submit'";
		echo " onClick=\"JavaScript=document.location.href='engine_view.php?troll=$id_troll";
		echo "&troll_type_action=grief&troll_action=new'\">";
	}

	/* ------ fin liste giefs ------ */
	echo "<hr noshade></td><td width='50%'>";	
	/* ------ liste vengeances ------ */
	echo "<h3>Liste des Châtiemenents</h3>";
	afficherListeVengeances($id_troll);	

	/* ----- bouton ajout vengeance ---- */	
	if (isControlAdministrateur()) {
		echo "<input type='button' value='Ajouter un châtiement' class='mh_form_submit'";
		echo " onClick=\"JavaScript=document.location.href='engine_view.php?troll=$id_troll";
		echo "&troll_type_action=venge&troll_action=new'\"><br>";
	}
	/* ------ fin liste vengeances ------ */
	
	if ($is_wanted_troll == 'oui') 
		echo "<font color='red'><b>$nom_troll (N°$id_troll) est WANTED ".RELAISMAGO." !</b></font><br>";
	
	// Si le troll est wanted et non chatié
	if (($is_venge_troll == 'non') && ($is_wanted_troll == 'oui'))
		echo "<font color='red'><h3><b>Nom d'un Streum ! Il est Wanted et pas Châtié !</b><h3></font>";

	/* ------ liste griefs subis --------- */
	echo "<hr noshade></td></tr>";
	echo "<tr><td width='50%' valign='top'>";
	echo "<h3>Liste des Griefs subis</h3>";
	afficherListeGriefs("",$id_troll);	
	/* ------ fin liste griefs subis --------- */
	echo "</td><td width='50%' valign='top'>";
	/* ------ liste griefs subis --------- */
	echo "<h3>Liste des vengeances</h3>";
	afficherListeVengeances("",$id_troll);	
	/* ------ liste griefs subis --------- */
	echo "</td></tr></table>";
	echo "</td></tr></table>";

	echo "</form></div>";
}

##############################
# Informations sur l'identité d'un troll
# est inclu dans la fiche d'un troll 
##############################
function afficherFicheTrollIdentite($nom_troll,$id_troll,$nom_image_troll,$race_troll,$id_guilde,
																		$is_seen_troll,$x_troll,$y_troll,$z_troll,$date_troll,
																		$is_admin_troll,$nom_guilde, $id_guilde, $statut_guilde, $groupe_rm_troll,
																		$id_distinction, $nom_rang,$num_rang, $nom_image_distinction,
																		$nom_image_titre_distinction, $niveau_troll,
																		$distinction, $nb_mouches,$nb_morts,$nb_kills,$is_pnj_troll,$majgrpspec)
{

?><br>
   <table  border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'width='100%'>
     <tr class='mh_tdpage'><td >
    	<table  border='0' cellpadding='0' cellspacing='1' width='100%' align='center'>
     	 <tr class='mh_tdtitre'>
        <td align='center' colspan='2'>
					<? echo "$nom_troll (n°$id_troll)" ?>
				</td>
				</tr>
<?

	/* -- affichage de l'avatar si c'est un RelaisMago ---*/
	if ($id_guilde == ID_GUILDE)  {
	  $img = "http://www.pipeshow.net/RM/avatars/complets/".$nom_image_troll."_avatar.gif";
		?>
    <tr class='mh_tdpage'><td colspan='2'>
		<table  border='0' class='mh_tdborder' cellpadding='0' cellspacing='1' align='center'>
		<tr class='mh_tdtitre'><td valign='bottom' align='center'>
		<font color=black><img src='<? echo $img ?>'></font>
		</td></tr>
		</table>

		<?
	}

	if (isControlAdministrateur()) {
		echo "<tr class='mh_tdpage'><td>Image Blason</td><td><input name='nom_image_troll' value='$nom_image_troll'>";
		echo "</td></tr>";
	}

	echo "<tr class='mh_tdpage'><td>Date mise à jour</td><td>$date_troll</td></tr>";

	echo "<tr class='mh_tdpage'><td>Visible</td><td>";
	echo "$is_seen_troll";
	if ($is_pnj_troll == 1)
		echo "<b>Troll PNJ</b>";
	echo "</td></tr>";
	
	if ($majgrpspec == 'oui' && !userIsGroupSpec())
	{
		$x_troll = 0;
		$y_troll = 0;
		$z_troll =0;
	}
	
	echo "<tr class='mh_tdpage'><td>Position</td><td>";
	echo "$x_troll | $y_troll | $z_troll"; 
	echo "&nbsp;<font size=1>";
	afficherLien("troll","vue2d",$id_troll,$x_troll,$y_troll,$z_troll);
	afficherLien("troll","gps",$id_troll,$x_troll,$y_troll,$z_troll);
	echo "<font></td></tr>";

	echo "<tr class='mh_tdpage'><td>Guilde</td>";
	if ($nom_guilde != "?")
		echo "<td class='objetsProches.ligne $statut_guilde'><a href='/engine_view.php?guilde=$id_guilde'>$nom_guilde</a> ($statut_guilde)";
	else
		echo "<td>$nom_guilde";
	echo "</td></tr>";

	echo "<tr class='mh_tdpage'><td>Mounty Hall</td><td>";
	afficherLien("troll","mh_profil",$id_troll,"","","","Profil");
	afficherLien("troll","mh_evenements",$id_troll,"","","","Évènements");
	afficherLien("troll","mh_classement",$id_troll,"","","","Classement");
	echo "</td></tr>";
	
	echo "<tr class='mh_tdpage'><td>Race </td>";
	echo "<td>$race_troll</tr>";

	if ($id_guilde == ID_GUILDE) {
		echo "<tr class='mh_tdpage'><td>Distinction </td>";
		$distinction = preg_replace("/\|/","<br>",$distinction);
		echo "<td>$distinction</td>";
		echo "</tr>";
	
		echo "<tr class='mh_tdpage'><td>Niveau </td>";
		echo "<td>$niveau_troll</tr>";
	
		echo "<tr class='mh_tdpage'><td>Nb Mouches </td>";
		echo "<td>$nb_mouches</td>";
		echo "</tr>";
	
		echo "<tr class='mh_tdpage'><td>Nb Morts </td>";
		echo "<td>$nb_morts</td>";
		echo "</tr>";
		
		echo "<tr class='mh_tdpage'><td>Nb Kills </td>";
		echo "<td>$nb_kills</td></tr>";
	
		echo "</td></tr>";
	
		echo "<tr class='mh_tdtitre'><td colspan='2'>Informations ".RELAISMAGO."</td></tr>";
		echo "<tr class='mh_tdpage'><td>Section </td><td>";
		if (isControlAdministrateur()) {
			echo "<select name='groupe_rm_troll'>";
			afficher_listbox_select("", $groupe_rm_troll);
			afficher_listbox_select("conseil", $groupe_rm_troll);
			afficher_listbox_select("diplomate", $groupe_rm_troll);
			echo "</select>";
		} else {
			if ($groupe_rm_troll != "") {
				echo $groupe_rm_troll;
			} else {
				echo "Aucun";
			}
		}
		echo "</td></tr>";
/*
		echo "<tr class='mh_tdpage'><td>Rang Officiel </td><td>";
		if (isControlAdministrateur()) {
			echo "<select name='id_distinction'>";
			afficher_listbox_rm_distinction_select($id_distinction);
			echo "</select>";
		} else {
			echo $nom_distinction;
		}
		echo "</td></tr>";

	*/
		echo "<tr class='mh_tdpage'><td>Rang Officiel </td><td>";
		echo $nom_rang;
		echo "</td></tr></table>";

		echo "<tr class='mh_tdpage'><td colspan='2'>Administrateurs Outils ".RELAISMAGO." : $is_admin_troll</td>";
	}

	if (isControlAdministrateur()) {
		echo "<tr class='mh_tdpage'><td align='center'>";
		echo "<input type='submit' action='submit' value='Modifier' class='mh_form_submit'>";
		echo "</td></tr>";
	}

	echo "</table>";
}

##############################
# Informations stratégiques d'un troll
# est inclu dans la fiche d'un troll 
##############################
function afficherFicheTrollInformationsStrategiques($is_tk_troll, $is_venge_troll, $is_wanted_troll, $statut_troll,
																										$id_diplomate_troll, $historique_troll) 
{
	/* ------ Informations stratégiques ------- */
?>
   <table  border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'width='100%'>
     <tr class='mh_tdpage'><td >
    	<table  border='0' cellpadding='0' cellspacing='1' width='100%' align='center'>
     	 <tr class='mh_tdtitre'>
        <td align='center' colspan='4'>
					Informations Stratégiques
				</td>
				</tr>
     	 <tr class='mh_tdpage'>

<?
	/* ------ TK ------- */
	echo "<td>TK</td><td>";
	
	if (isControlAdministrateur()) {
		echo "<select name='is_tk_troll' class='mh_form_submit'>";
		afficher_listbox_select("non", $is_tk_troll);
		afficher_listbox_select("oui", $is_tk_troll);
		echo "</select>";
	} else {
		echo $is_tk_troll;
	}
	echo "</td>";

	/* ------ Wanted ------- */
	echo "<td>Wanted</td><td>";
	if (isControlAdministrateur()) {
		echo "<select name='is_wanted_troll' class='mh_form_submit'>";
		afficher_listbox_select("non", $is_wanted_troll);
		afficher_listbox_select("oui", $is_wanted_troll);
		echo "</select>";
	} else {
		echo $is_wanted_troll;
	}
	echo "</td></tr>";

	/* ------ Chatié ------- */
	echo "<tr class='mh_tdpage'><td>Chatié</td><td>";
	if (isControlAdministrateur()) {
		echo "<select name='is_venge_troll' class='mh_form_submit'>";
		afficher_listbox_select("non", $is_venge_troll);
		afficher_listbox_select("oui", $is_venge_troll);
		echo "</select>";
	} else {
		echo $is_venge_troll;
	}
	echo "</td>";

	/* ------ Diplomatie ------- */
	echo "<td>Diplomatie</td><td>";
	if (isControlAdministrateur()) {
		echo "<select name='statut_troll' class='mh_form_submit'>";
		afficher_listbox_select("neutre", $statut_troll);
		afficher_listbox_select("tk", $statut_troll);
		afficher_listbox_select("ennemie", $statut_troll);
		afficher_listbox_select("amie", $statut_troll);
		afficher_listbox_select("alliee", $statut_troll, "alliée");
		echo "</select>";
	} else {
		echo $statut_troll;
	}
	echo "</td></tr>";
	echo "</table>";
	echo "</td></tr>";
	echo "<tr class='mh_tdpage'><td>";
	echo "Diplomate en charge : ";
	echo "<select name='id_diplomate_troll' class='mh_form_submit'>";
	afficher_listbox_troll_rm_select($id_diplomate_troll);
	echo "</select>";
	echo "</td></tr>";
	echo "<tr class='mh_tdpage'><td>";
	echo "Historique : ";
	echo "<textarea name='historique_troll' cols='50' rows='2'>";
	echo stripslashes($historique_troll);
	echo "</textarea>";
	echo "</td></tr>";
	echo "</table>";
}

#################################################
# Affiche l'équipement d'un troll
#################################################
function afficherFicheEquipement($id_troll)
{
	global $db_vue_rm, $admin;

	$page = "engine_view.php";
	
	// On va chercher les informations du troll
	$leTrollEquipement = selectDbEquipement($id_troll);
	$troll = $leTrollEquipement[1];
	$equipement_troll = $troll['equipement_troll'];
	$nom_troll = $troll['nom_troll'];
	?>
   <table  border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'width='60%'>
     <tr class='mh_tdpage'><td >
    	<table  border='0' cellpadding='0' cellspacing='1' width='100%' align='center'>
     	 <tr class='mh_tdtitre'>
        <td align='center' colspan='4'>
					<? echo "Edition de l'équipement de $nom_troll (N° $id_troll)" ?>
				</td>
				</tr>
     	 <tr class='mh_tdpage'><td align='center'>

<?	
	echo "<form action='$page'>";

	echo "<input type='hidden' name='troll_type_action' value='equipement'>";
	echo "<input type='hidden' name='troll_action' value='editdb'>";
	echo "<input type='hidden' name='troll' value='$id_troll'>";
	echo "<input type='hidden' name='id_troll' value='$id_troll'>";
	
	echo "<table>";
	echo "<tr><td><b>Vous pouvez renseigner ici l'équipement que vous portez</b><br><br>";
	echo "Exemple : <br>";
	?>
 	Tete : Casque en métal Vue : -1 | Armure : +2 | RM : +8 %<br>
	Cou : Gorgeron en cuir Armure : +1<br>
	Main gauche : Gantelet # ATT : -2 # ESQ : +1 # DEG : +1 # Armure : +2<br>
	Armure : Cuir Bouilli # ESQ : -1 # Armure : +3 # RM : +30 %<br>
	Main droite :Rondache en bois # ESQ : +1 # Armure : +1<br>
	Pieds: Jambières en fourrure Armure : +1 | RM : +9 % <br>

	<?
	echo "</td></tr>";
	echo "<tr><td><textarea name='equipement_troll' cols='90' rows='20'>";
	echo stripslashes($equipement_troll)."</textarea></td></tr></table>";
	
	if ((isControlAdministrateur()) || ($_SESSION['AuthTroll'] == $id_troll)) {
		echo "<input type='submit' name='submit' value='Valider' class='mh_form_submit'>";
	}

	echo " <input type='button' onClick='JavaScript=history.back();' value='Annuler' class='mh_form_submit'>";
	echo "</form>";
	echo "</td></tr></table>";
	echo "</td></tr></table>";
}

#################################################
# Affiche les informations VTT d'un trolls RM dans sa fiche
#################################################
function afficherFicheTrollVtt($id_troll)
{

	$vtt = selectDbVtt($id_troll);

	/* ------ Informations stratégiques ------- */
	?>
   <table  border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'width='100%'>
     <tr class='mh_tdpage'><td valign='top'>
    	<table  border='0' cellpadding='0' cellspacing='1' width='100%' align='center'>
     	 <tr class='mh_tdtitre'>
        <td align='center' colspan='2' >
	<?
	echo "Informations VTT ".RELAISMAGO." - maj le ".date("d/m/y H:i",$vtt["date_maj"])."";
	
	echo " &nbsp;<img src=\"vtt/bullet_";
	if ($vtt["DateMaj"]=="20040331000000") {
		echo "white.gif\" alt=\"jamais\" title=\"jamais\"";
	} else if ($vtt["Peremption"]<=7) {
		echo "green.gif\" alt=\"< 1 semaine\" title=\"< 1 semaine\"";
	} else if ($vtt["Peremption"]<=30) {
		echo "blue.gif\" alt=\"< 1 mois\" title=\"< 1 mois\"";
	} else {
		echo "red.gif\" alt=\"> 1 mois\" title=\"> 1 mois\"";
	} echo ">";

	echo "</td></tr>";

	echo "<tr class='mh_tdpage'><td width='120' valign='top'>";

	/* --------- gauche ----- */
	echo "<table>";
	echo "<tr>";
	echo "<td>Race</td><td align=center>";
	echo htmlspecialchars($vtt["race_troll"])."</td>";
	
	echo "<tr><td>DLA</td><td align=center>";
	$dla = htmlspecialchars($vtt["DLAH"]."h");
	$dla .= ($vtt["DLAM"]<10)?"0":"";
	$dla .= htmlspecialchars($vtt["DLAM"]);
	echo ecrireCacherTexte($cacherdata,$dla);
	echo "</td></tr>";

	echo "<tr><td>";
	echo "Taille Vue";
	echo "<td align=center>";
	echo ecrireCacherTexte($cacherdata,htmlspecialchars($vtt["VUE"]).plus($vtt["VUEB"]).htmlspecialchars($vtt["VUEB"]));
	echo "</td></tr>";
	
  echo "<tr><td>Niveau</td><td align=center>"; 
	echo htmlspecialchars($vtt["niveau_troll"]); 
	echo "</td></tr>";

	echo "<tr><td>Pv</td><td align=center>"; 
	echo ecrireCacherTexte($cacherdata,htmlspecialchars($vtt["PVs"]));
	echo "</td></tr>";
	echo "<tr><td>REG</td><td align=center>"; 
	echo ecrireCacherTexte($cacherdata,htmlspecialchars($vtt["REG"])."D3".plus($vtt["REGB"]).htmlspecialchars($vtt["REGB"]));
	echo "</td></tr>";
	echo "<tr><td>ATT</td><td align=center>";
	echo ecrireCacherTexte($cacherdata,htmlspecialchars($vtt["ATT"])."D6".plus($vtt["ATTB"]).htmlspecialchars($vtt["ATTB"]));
	echo "</td></tr>";
	echo "<tr><td>ESQ</td><td align=center>";
	echo ecrireCacherTexte($cacherdata,htmlspecialchars($vtt["ESQ"])."D6".plus($vtt["ESQB"]).htmlspecialchars($vtt["ESQB"]));
	echo "</td></tr>";
	echo "<tr><td>DEG</td><td align=center>";
	echo ecrireCacherTexte($cacherdata,htmlspecialchars($vtt["DEG"])."D3".plus($vtt["DEGB"]).htmlspecialchars($vtt["DEGB"]));
	echo "</td></tr>";
	echo "<tr><td>ARM</td><td align=center>";
	echo ecrireCacherTexte($cacherdata,htmlspecialchars($vtt["ARM"]).plus($vtt["ARMB"]).htmlspecialchars($vtt["ARMB"]));
	echo "</td></tr>";

	echo "</table>";
	/* --------- fin gauche --------- */
	echo "</td><td valign='top' width='280'>";
	/* --------- début droite --------- */
	echo "<table>";

	echo "<tr><td valign='top'>Kills</td><td>";
	echo htmlspecialchars($vtt["KILLs"]); 
	echo "</td></tr>";
	echo "<tr><td>Morts</td><td>"; 
	echo htmlspecialchars($vtt["DEADs"]); 
	echo "</td></tr>";

	echo "<tr><td>RM</td><td>"; 
	echo ecrireCacherTexte($cacherdata,htmlspecialchars($vtt["RM"]).plus($vtt["RMB"]).htmlspecialchars($vtt["RMB"]));
	echo "</td></tr>";

	echo "<tr><td>MM</td><td>"; 
	echo ecrireCacherTexte($cacherdata,htmlspecialchars($vtt["MM"]).plus($vtt["MMB"]).htmlspecialchars($vtt["MMB"]));
	echo"</td></tr>";
	

	echo "<tr valign='top'><td>Sorts</td><td align=left>&nbsp;"; 
	echo ecrireCacherTexte($cacherdata,htmlspecialchars($vtt["Sorts"]));
	echo "</td></tr>";	
	
	echo "<tr><td valign='top'>Compétences</td>"; 
	echo "<td align=left valign='top'>&nbsp;"; 
	$comp = preg_replace("/,/","<br>",$vtt["Comps"]);
	echo ecrireCacherTexte($cacherdata,$comp);
	echo "</td></tr>";	
	echo "</table>";
	/* -------- fin droite ---------- */
	echo "</td></tr>";
	echo "</table>";

	
	if ($_SESSION['AuthTroll'] == $id_troll) {
		echo "<center>";
		echo "<input type=button class='mh_form_submit' onClick='javascript=document.location.href=\"";
		echo "/vtt/parser_profil.php?id=$id_troll\"' value='Mettre à jour'>";
		echo "</center>";
	}
	echo "</td></tr>";
	echo "</table>";
}

function afficherFicheTrollEquipement($id_troll,$equipement_troll,$equipement2_troll)
{
	?>
		<br>
   <table  border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'width='100%'>
     <tr class='mh_tdtitre'>
       <td align='center' colspan='2'>
					Équipement
				</td>
			</tr>
     <tr class='mh_tdpage'>
     	<td>
     		<p>
				<?
				
				$equipement2_troll = explode("|",$equipement2_troll);
				for ($i=0; $i<count($equipement2_troll); $i++)
					echo stripslashes(preg_replace( "#,(.+)#", " <strong>$1</strong>", substr($equipement2_troll[$i], 2) ))."<br/>";
				
				?>
			</p>	
		</td>
	</tr>
      <tr class='mh_tdtitre'>
       <td align='center' colspan='2'>
				Détails
			</td>
			</tr>
     	<tr class='mh_tdpage'><td>
		<?
		$lien = "$page?troll=$id_troll&troll_type_action=equipement&troll_action=voir";

		$equipement_troll = preg_replace("/\n/","<br>",$equipement_troll);
		echo stripslashes($equipement_troll);

		if ((isControlAdministrateur()) || ($_SESSION['AuthTroll'] == $id_troll)) {
			echo "<br><center><input type='button' value='Mettre à jour' class='mh_form_submit'";
			echo " onClick=\"JavaScript=document.location.href='$lien'\"></center>";
		}
		echo "</td></tr></table>";

}

function afficherFicheTrollMouches($id_troll)
{
	$lesMouches = selectDbMouches($id_troll);
  $nbMouches = count($lesMouches);
	if ($nbMouches == 0)
		return ;

	$options = selectDbOptions($id_troll);
	if ($options[1][display_mouches_option] != 'oui')
		return;

	$display_nom = $options[1][display_noms_mouches_option];

	?><br>
   <table  border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'width='100%'>
     <tr class='mh_tdtitre'>
      <td align='center' colspan='6' >
					Mouches
			</td>
			<?
				for ($i = 1;$i<=count($lesMouches); $i++) {
					$mouche = $lesMouches[$i];	
					if ($display_nom != 'non')
						$nom = $mouche[nom_mouche];
					else
						$nom = '-';
						
					echo "<tr class='mh_tdpage'>";
					echo "<td>$mouche[id_mouche]</td>";
					echo "<td>$nom</td>";
					echo "<td>$mouche[type_mouche]</td>";
					echo "<td>$mouche[age_mouche] jours</td>";
					echo "<td>Présence $mouche[presence_mouche]</td>";
				 echo "</tr>";
				}
			?>
	</table>
<?
}

function ecrireCacherTexte($cacher,$text)
{
  if (!$cacher)
		echo $text;
	else
		echo "--";
}

function afficheFicheTrollAnatomique($id_troll)
{
	include_once('anatomique/anat_functions_db.php');

  $lesAnats = selectDbAnalyseAnatomique($id_troll);
  $nbAnats = count($lesAnats);
	if ($nbAnats == 0)
		return ;

	$res = $lesAnats[1];

	$lien = "href='/engine_view.php?troll=$res[id_troll_anatomique]'";


	?>
   <table  border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'width='100%'>
     <tr class='mh_tdpage'><td valign='top'>
    	<table  border='0' cellpadding='0' cellspacing='1' width='100%' align='center'>
     	 <tr class='mh_tdtitre'>
        <td align='center' colspan='2' >
					Analyse Anatomique 
				</td>
			 </tr>
     	 
        <td align='center' colspan='2' >
					<?
					$trtd = "<tr class='mh_tdpage'><td nowrap>";
					$tdtr = "</td></tr>";
					$tdtd = "</td><td>";
					echo "$trtd Points de Vie $tdtd $res[pv_anatomique]$tdtr";
					echo "$trtd Dés d'Attaque $tdtd $res[att_anatomique]$tdtr";
					echo "$trtd Dés d'Esquive $tdtd $res[esq_anatomique]$tdtr";
					echo "$trtd Dés de Dégat $tdtd $res[deg_anatomique]$tdtr";
					echo "$trtd Dés de Régénération $tdtd $res[reg_anatomique]$tdtr";
					echo "$trtd Vue $tdtd $res[vue_anatomique]$tdtr";
					echo "$trtd Armure $tdtd $res[arm_anatomique]$tdtr";
					echo "$trtd Date $tdtd $res[date_anatomique]$tdtr";
					echo "$trtd Source $tdtd $res[source_anatomique]$tdtr";
				?>
				</td>
			 </tr>
			</table>
		 </td>
		</tr>
	</table>
<?
}

#################################################
# Affiche la fiche d'un grief 
#################################################
function afficherFicheGrief($id_troll,$grief_id)
{
	global $db_vue_rm, $admin;
	
	isControlAdministrateur("yes"); // Control strict de l'administrateur
	
	if ($grief_id == "new") {
		$titre = "<h3>Ajout d'un grief</h3>";
	} else {
		// On va chercher les informations du grief
		$lesGriefs = selectDbGriefs($id_troll,$grief_id);
		$res = $lesGriefs[1];
  
		$grief_id = $res['grief_id'];
		$tk_id = $res['tk_id']; // $tk_id = $id_troll
		$date_grief = $res['date_grief'];
		$troll_impacte = $res['troll_impacte'];
		$description = $res['description'];
		$type= $res['type'];

		// Puis du troll concerné
		$lesTrolls = selectDbTrolls($troll_impacte);
		$troll = $lesTrolls[1];
				
		$titre = "<h3>Edition d'un Grief</h3>";
	}

	if ($description=="") $description="...."; 

	echo "<form action='engine_view.php'>";

	echo "<input type='hidden' name='troll_type_action' value='grief'>";
	echo "<input type='hidden' name='troll_action' value='editdb'>";
	echo "<input type='hidden' name='troll' value='$id_troll'>";
	echo "<input type=hidden name='grief_id' value='$grief_id'>";
	
	echo "<table style='background-color:#6f7ca2;' class='fiche'>";
	echo "<tr><th colspan=2>$titre</th></tr>";
	echo "<tr><td><b>N° du troll Tk</b></td>";
	echo "<td><input type='text' name='tk_id' value='$id_troll' size='8' maxlength='8'>";
	afficherLien("troll","fiche",$id_troll);
	afficherLien("troll","mh_evenements",$id_troll);
	echo "</td>";
	echo "</tr><tr><td><b>Date du grief</b></td>";
	echo "<td><input type='text' name='date_grief' value='$date_grief' size=10 maxlength=10> JJ/MM/AAAA</td>";
	echo "</tr><tr><td><b>N° du Troll impacté</b></td>";

	echo "<td><input type='text' name='troll_impacte' value='$troll_impacte' size='8' maxlength='8'>";
	
	if ($grief_id != "new") {
		echo " $troll[nom_troll] ($troll_impacte) ";
		afficherLien("troll","fiche",$troll_impacte);
		afficherLien("troll","mh_evenements",$troll_impacte);
	}

	echo "</td></tr><tr><td><b>Type</b></td><td>";
	echo "<select name='type'>";

	afficher_listbox_select("vol", $type,"Vol de trucs");
	afficher_listbox_select("meurtre",  $type,"Meurtre avec ou sans pré[post]médication");
	afficher_listbox_select("asso malfrats", $type,"Association de malfratitudes");
	afficher_listbox_select("coups", $type,"Coups et blessures avec intention de faire bronzer");
	afficher_listbox_select("traitrise", $type,"Traitrise envers la guilde");
	afficher_listbox_select("fourberie", $type,"Fourberie, tromperie et toutes cette sorte de chose");
	afficher_listbox_select("insulte", $type,"Langage particulièrement ordurier");
	afficher_listbox_select("employe microsoft", $type,"Employé par Microsoft");

	echo "</select>";
	echo "</td></tr>";
	echo "<tr><td><b>Description</b></td>";
	echo "<td><textarea name='description' cols='60' rows='3'>";
	echo stripslashes($description)."</textarea></td></tr></table>";
	echo "<input type='submit' name='submit' value='Valider'>&nbsp;";
	if ( $grief_id != 'new') {
		echo "<input type='button' name='suppression' value='Supprimer' class='mh_form_submit'";
		echo " onClick=\"javascript=";
		echo " k=confirm('Confirmer la suppression du grief ?');";
		echo " if (k==true) {document.location.href=";
		echo "'engine_view.php?troll=$id_troll&grief_id=$grief_id&troll_action=del&troll_type_action=grief';}";
		echo "\"'>&nbsp;";
	}
	echo " <input type='button' onClick='JavaScript=history.back();' value='Annuler' class='mh_form_submit'>";
	echo "</form>";
}


#################################################
# Affiche la fiche d'une vengeance
#################################################
function afficherFicheVengeance($id_troll,$vengeance_id)
{
	global $db_vue_rm, $admin;
	
	isControlAdministrateur("yes"); // Control strict de l'administrateur

	if ($vengeance_id == "new") {
		$titre = "<h3>Ajout d'un Châtiement</h3>";
	} else {
		// On va chercher les informations du venge 
		$lesVengeances = selectDbVengeances($id_troll,$vengeance_id);
		$res = $lesVengeances[1];
  
		$vengeance_id = $res['vengeance_id'];
		$tk_id = $res['tk_id']; // $tk_id = $id_troll
		$date_vengeance = $res['date_vengeance'];
		$troll_vengeur = $res['troll_vengeur'];
		$description = $res['description'];

		// Puis du troll concerné
		$lesTrolls = selectDbTrolls($troll_vengeur);
		$troll = $lesTrolls[1];
				
		$titre = "<h3>Edition d'une Vengeance</h3>";
	}

	if ($description=="") $description="...."; 

	echo "<form action='engine_view.php'>";

	echo "<input type='hidden' name='troll_type_action' value='venge'>";
	echo "<input type='hidden' name='troll_action' value='editdb'>";
	echo "<input type='hidden' name='troll' value='$id_troll'>";
	echo "<input type=hidden name='vengeance_id' value='$vengeance_id'>";
	
	echo "<table style='background-color:#6f7ca2;' class='fiche'>";
	echo "<tr><th colspan=2>$titre</th></tr>";
	echo "<tr><td><b>N° du troll Tk</b></td>";
	echo "<td><input type='text' name='tk_id' value='$id_troll' size='8' maxlength='8'>";
	afficherLien("troll","fiche",$id_troll);
	afficherLien("troll","mh_evenements",$id_troll);
	echo "</td>";
	echo "</tr><tr><td><b>Date Vengeance</b></td>";
	echo "<td><input type='text' name='date_vengeance' value='$date_vengeance' size=10 maxlength=10> JJ/MM/AAAA</td>";
	echo "</tr><tr><td><b>N° du Troll Vengeur</b></td>";
	echo "<td><input type='text' name='troll_vengeur' value='$troll_vengeur' size='8' maxlength='8'>";
	
	if ($vengeance_id != "new") {
		echo " $troll[nom_troll] ($troll_vengeur) ";
		afficherLien("troll","fiche",$troll_vengeur);
		afficherLien("troll","mh_evenements",$troll_vengeur);

	}
	
	echo "</td></tr><tr><td><b>Description</b></td>";
	echo "<td><textarea name='description' cols='60' rows='3'>";
	echo stripslashes($description)."</textarea></td></tr></table>";

	echo "<input type='submit' name='submit' value='Valider'>";

	if ( $vengeance_id != 'new') {
		echo "&nbsp;<input type='button' name='suppression' value='Supprimer' class='mh_form_submit'";
		echo " onClick=\"javascript=";
		echo " k=confirm('Confirmer la suppression de la vengeance ?');";
		echo " if (k==true) {document.location.href=";
		echo "'engine_view.php?troll=$id_troll&vengeance_id=$vengeance_id&troll_action=del&troll_type_action=venge';}";
		echo "\"'>&nbsp;";
	}

	echo " <input type='button' onClick='JavaScript=history.back();' value='Annuler' class='mh_form_submit'>";
	echo "</form>";
}

####################################
## Affiche la fiche d'un Gowap
####################################
function afficherFicheGowap($id_gowap, $id_troll_gowap="")
{
	include_once("gps_advanced_js.php"); // pour la fonction swap

	global $db_vue_rm;
	
	$page = "engine_view.php";

	if ($id_gowap == "new") {
		//$id_troll_gowap = $id_troll_gowap; => pour info
		$info = "Ajouter";
	} else {
		$lesGowaps = selectDbGowaps($id_gowap);
		$res = $lesGowaps[1];

		$id_gowap = $res[id_gowap];
		$id_troll_gowap = $res[id_troll_gowap];
		$nom_troll = $res[nom_troll];
		$nom_image_troll = $res[nom_image_troll];
		$description_gowap = stripslashes($res[description_gowap]);
		$profil_gowap = stripslashes($res[profil_gowap]);
		$chargement_gowap = stripslashes($res[chargement_gowap]);
		$x_monstre = $res[x_monstre];
		$y_monstre = $res[y_monstre];
		$z_monstre = $res[z_monstre];
		$is_seen_monstre = $res[is_seen_monstre];
		$date_monstre = $res[date_monstre];
		$info = "Modifier";
	}
	
	echo "<form action='$page?gowap=edit' method='POST'>";
	echo "<table >";
	echo "<input type='hidden' name='act' value='$id_gowap'>";
	echo "<tr><td valign='top' width=400>";
	afficherFicheGowapIdentite($id_gowap,$id_troll_gowap,$nom_troll,$x_monstre,$y_monstre,$z_monstre,
														 $date_monstre,$is_seen_monstre,$nom_image_troll);
	/* ------- description ------ */
	afficherFicheGowapDescription($description_gowap);
	/* ------- profil ------ */
	afficherFicheGowapProfil($profil_gowap);
	echo "</td><td valign='top'>";
	/* ------- équipement ------ */
	afficherFicheGowapEquipement($chargement_gowap);
	echo "</td></tr>";
	echo "</table>";

	// Un bouton modifier pour l'administrateur ou pour le proprio du gowap
	if ((isControlAdministrateur()) || ($_SESSION[AuthTroll] == $id_troll_gowap)) {
		afficherFicheGowapMajInformations($description_gowap,$profil_gowap,$chargement_gowap);
		echo "<input type='submit' name='submit' value='$info' class='mh_form_submit'>&nbsp;";
		if ($id_gowap != "new") {
			echo "<input type='button' name='suppression' value='Supprimer' class='mh_form_submit'";
			echo " onClick=\"javascript=";
			echo " k=confirm('Confirmer la suppression du gowap ?');";
			echo " if (k==true) {document.location.href='$page?gowap=del&id_gowap=$id_gowap';}";
			echo "\">&nbsp;";
		}
	}	
	echo "<input type='Button' value='Retour à la fiche du propriétaire' class='mh_form_submit'";
	echo " onClick='JavaScript=document.location.href=\"$page?troll=$id_troll_gowap\">";
	echo "</form>";
}

function afficherFicheGowapIdentite($id_gowap,$id_troll_gowap,$nom_troll,$x_monstre,$y_monstre,$z_monstre,
																		$date_monstre,$is_seen_monstre,$nom_image_troll)
{
?>
   <table  border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'width='100%'>
     <tr class='mh_tdpage'><td >
    	<table  border='0' cellpadding='0' cellspacing='1' width='100%' align='center'>
     	 <tr class='mh_tdtitre'>
        <td align='center' colspan='2'>
					Identité
				</td>
				</tr>
     	 <tr class='mh_tdpage'>

<?
	echo "<tr><td align='center' colspan=2>";
	echo "<img src='images/gowapRM.gif'> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<font color='black'>";
	$img = "http://www.pipeshow.net/RM/avatars/complets/".$nom_image_troll."_avatar.gif";
	echo "<img src='$img' border=5>";
	echo "</font>";
	echo "</td></tr>";
	echo "<tr><td>Id</td>";
	echo "<td><input type='textbox' name='id_gowap' value='$id_gowap'></td></tr>";
	echo "<input type='hidden' name='id_troll_gowap' value='$id_troll_gowap'";
	
	echo "<tr><td>Propriétaire :</td>";
	echo "<td>$nom_troll ($id_troll_gowap)</td></tr>";

	echo "<tr><td>Position :</td>";
	echo "<td>X=$x_monstre, Y=$y_monstre, Z=$z_monstre</td></tr>";

	echo "<tr><td>Vu :</td>";
	echo "<td>$is_seen_monstre (".date("d/m/y H:i",$date_monstre).")";
	echo " <font size=1>";
	afficherLien("gowap","vue2d",$id_gowap,$x_monstre,$y_monstre,$z_monstre);
	afficherLien("gowap","gps",$id_gowap,$x_monstre,$y_monstre,$z_monstre);
	echo "</font>";
	
	echo "</td></tr></table>";
	echo "</td></tr></table>";
}

function afficherFicheGowapMajInformations($description_gowap,$profil_gowap,$chargement_gowap)
{	
?>
   <table  border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'width='100%'>
     <tr class='mh_tdpage'><td >
    	<table  border='0' cellpadding='0' cellspacing='1' width='100%' align='center'>
     	 <tr class='mh_tdtitre'>
        <td align='center' colspan='2'>
					Équipement
				</td>
				</tr>
     	 <tr class='mh_tdpage'>

<?
	/* ------- maj profil ------ */
	$act = "onClick=\"JavaScript:swapSpan('sdescription','img_sdescription','swap_sdescription')\"";
	echo "<td colspan='2'>";
  echo "<img id='img_sdescription' src='images/triangle-bleu.gif' $act> ";
	echo "<input type='hidden' id='swap_sdescription' name='swap_sdescrption' value='none'>";
  echo "<span $act>Mettre à jour la description</span><br>";
  echo "<span id='sdescription' style='display: none;'>";
	echo "Copiez/collez ici la description de votre gowap (Ctrl+a puis Ctrl+c sur MountyHall, Ctrl+v ci-dessous)<br>";
	echo " <textarea cols=80 rows=10 name='description_gowap'>";
	echo $description_gowap;
	echo "</textarea></span></td></tr>";


	/* ------- maj profil ------ */
	$act = "onClick=\"JavaScript:swapSpan('sprofil','img_sprofil','swap_sprofil')\"";
	echo "<td colspan='2'>";
  echo "<img id='img_sprofil' src='images/triangle-bleu.gif' $act> ";
	echo "<input type='hidden' id='swap_sprofil' name='swap_sprofil' value='none'>";
  echo "<span $act>Mettre à jour le profil</span><br>";
  echo "<span id='sprofil' style='display: none;'>";
	echo "Copiez/collez ici le profil de votre gowap (Ctrl+a puis Ctrl+c sur MountyHall, Ctrl+v ci-dessous)<br>";
	echo " <textarea cols=80 rows=10 name='profil_gowap'>";
	echo $profil_gowap;
	echo "</textarea></span></td></tr>";

	/* ------- maj equipement ------ */
	$act = "onClick=\"JavaScript:swapSpan('sequipement','img_sequipement','swap_sequipement')\"";
	echo "<td colspan='2'>";
  echo "<img id='img_sequipement' src='images/triangle-bleu.gif' $act> ";
	echo "<input type='hidden' id='swap_sequipement' name='swap_sequipement' value='none'>";
  echo "<span $act>Mettre à jour l'équipement</span><br>";
  echo "<span id='sequipement' style='display: none;'>";
	echo "Copiez/collez ici l'équipement de votre gowap (Ctrl+a puis Ctrl+c sur MountyHall, Ctrl+v ci-dessous)<br>";
	echo " <textarea cols=80 rows=10 name='chargement_gowap'>";
	echo $chargement_gowap;
	echo "</textarea></span></td></tr>";
	echo "</table>";
	echo "</td></tr></table>";
}

###############################################
# Affiche la description d'un gowap. Est inclu dans la fiche d'un gowap
##############################################
function afficherFicheGowapDescription($description_gowap)
{
?><br>
   <table  border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'width='100%'>
     <tr class='mh_tdpage'><td >
    	<table  border='0' cellpadding='0' cellspacing='1' width='100%' align='center'>
     	 <tr class='mh_tdtitre'>
        <td align='center' colspan='2'>
					Description
				</td>
				</tr>
     	 <tr class='mh_tdpage'>

<?
	echo "<tr><td>";
	$description_gowap = preg_replace("/\[Refresh\]\[Logout\].?\n/","",$description_gowap); 
	$description_gowap = preg_replace("/Profil.?\|.?Ordres.?\|.?Equipement.?\|.?Description.?\n/","",$description_gowap); 
	$description_gowap = preg_replace("/<br>.?<br>/","<br>",$description_gowap); // suppression lignes blanches
	$description_gowap = preg_replace("/\[Contact.*/","",$description_gowap); 
	echo "$description_gowap";
	echo "</td></tr></table>";
	echo "</td></tr></table>";
}
###############################################
# Affiche le profil d'un gowap. Est inclu dans la fiche d'un gowap
##############################################
function afficherFicheGowapProfil($profil_gowap)
{
?><br>
   <table  border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'width='100%'>
     <tr class='mh_tdpage'><td >
    	<table  border='0' cellpadding='0' cellspacing='1' width='100%' align='center'>
     	 <tr class='mh_tdtitre'>
        <td align='center'>
					Profil	
				</td>
				</tr>
     	 <tr class='mh_tdpage'>

<?
	echo "<tr><td>";
	$profil_gowap = preg_replace("/\[Refresh\]\[Logout\].?\n/","",$profil_gowap); 
	$profil_gowap = preg_replace("/Profil.?\|.?Ordres.?\|.?Equipement.?\|.?Description.?\n/","",$profil_gowap); 
	$profil_gowap = preg_replace("/Fiche de Monstre.*\n/","",$profil_gowap); 
	$profil_gowap = preg_replace("/Description Identifiant.*\n/","",$profil_gowap); 
	$profil_gowap = preg_replace("/Race.*\n/","",$profil_gowap); 
	$profil_gowap = preg_replace("/Echéance du Tour Date Limite d.*Action/","Date de mise à jour du profil",$profil_gowap); 
	$profil_gowap = preg_replace("/Position.*/","",$profil_gowap); 
	$profil_gowap = preg_replace("/Point de Vie.*/","",$profil_gowap); 
	$profil_gowap = preg_replace("/Actuels.*/","",$profil_gowap); 
	$profil_gowap = preg_replace("/Maximum\.?/","Points de vie Maximum",$profil_gowap); 
	$profil_gowap = preg_replace("/Nb d.*Attaques subies ce Tour.*/","",$profil_gowap); 
	$profil_gowap = preg_replace("/Il lui reste.*/","",$profil_gowap); 
	$profil_gowap = preg_replace("/\n/","<br>",stripslashes($profil_gowap));

	$profil_gowap = preg_replace("/<br>.?<br>/","<br>",$profil_gowap); // suppression lignes blanches
	$profil_gowap = preg_replace("/\[Contact.*/","",$profil_gowap); 
	echo "$profil_gowap </td></tr>";
	echo "</table>";
	echo "</td></tr></table>";
}

function afficherFicheGowapEquipement($chargement_gowap)
{
?>
   <table  border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'width='100%'>
     <tr class='mh_tdpage'><td >
    	<table  border='0' cellpadding='0' cellspacing='1' width='100%' align='center'>
     	 <tr class='mh_tdtitre'>
        <td align='center'>
					Équipement
				</td>
				</tr>
     	 <tr class='mh_tdpage'>

<?
	echo "<tr><td>";
	$chargement_gowap= preg_replace("/\[Refresh\]\[Logout\].?\n/","",$chargement_gowap); 
	$chargement_gowap= preg_replace("/Profil.?\|.?Ordres.?\|.?Equipement.?\|.?Description.?\n/","",$chargement_gowap); 
	$chargement_gowap= preg_replace("/Equipement.*\n/","",$chargement_gowap); 
	$chargement_gowap= preg_replace("/\[Contact.*/","",$chargement_gowap);
	$chargement_gowap= preg_replace("/\n/","<br>",stripslashes($chargement_gowap));
	echo "$chargement_gowap</td></tr>";
	echo "</table>";
	echo "</td></tr></table>";

}
####################################
## Affiche le cheptel des gowaps RM 
####################################
function afficherCheptelGowaps()
{
	$lesGowaps= selectDbGowaps();
	afficherTableauObjetRM("gowaps",$lesGowaps);
}

####################################
## Affiche le cadastre des tanières RM 
####################################
function afficherCadastreTanieres()
{
	$lesTanieres = selectDbTanieres();
	afficherTableauObjetRM("tanieres",$lesTanieres);
}

function afficherTableauObjetRM($type,$sql_res)
{

	$nb_res = count($sql_res);

	?>
    <table  border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'width='90%'>
     <tr class='mh_tdpage'><td >
    	<table  border='0' class='mh_tdborder' cellpadding='0' cellspacing='1' width='100%' align='center'>
     	 <tr class='mh_tdpage'>
        <td align='center'>

	<?
	$id_troll_previous = -1;
	$id_troll = -2;
	$n=1;
	for($i=1;$i<=$nb_res;$i++) {
		$res = $sql_res[$i];
		
		if ($type != "baronnies") {
			$id_troll = $res[id_troll];
		}
		
		if ($id_troll != $id_troll_previous) {
			if ($n != 1) {
				echo "</td>";
			}
			if (($n%3) == 1) {
				if ($i != 1) {
					echo "</tr>";
				}
				echo "<tr class='mh_tdpage'>";
			}
			echo "<td width='30%' valign='top'>";
			if ($type != "baronnies") {
				afficherCadreEntete($res);
			}
			$n++;
		}

		if ($type == "tanieres")
			afficherCadastreTaniereCadre($res);
		elseif ($type=="gowaps")
			afficherCheptelGowapCadre($res);
		elseif ($type=="baronnies")
			afficherListeBaronniesCadreBaronnie($res);
		
		if ($type != "baronnies") {
			$id_troll_previous = $id_troll;
		}
	}
	echo "</td>";
	$td = "<td width='30%'>&nbsp;</td>";

	if (($n%3) == 0) { 
		echo "$td </tr>";
	} elseif (($n%3) == 2) {
		echo "$td $td</tr>";
	} elseif (($n%3) == 1) {
		echo "</tr>";
	}
	?>
	</td></tr></table>
	</td></tr></table>
	<?
}

function afficherCadreEntete($res)
{

		$lien = "href='engine_view.php?troll=$res[id_troll]'";
		echo "<center>";
		echo "<table><tr><td>";
		
		$img = "http://www.pipeshow.net/RM/avatars/complets/".$res[nom_image_troll]."_avatar.gif";
		echo "<font color='black'> <img src='$img' border='5' ></font><br>";
		
		echo "</td><td>";
		echo "<h3>Propriétaire : <a $lien>$res[nom_troll]</a></h3>";
		echo "</td></tr></table>";
		echo "</center>";
}
function afficherCheptelGowapCadre($res)
{
		$lien = "href='engine_view.php?gowap=$res[id_gowap]'";
		echo "<hr noshade><table><tr><td>";
		echo "<img src='images/gowapRM.gif'>";
		
		echo "</td><td>";
		
		echo "<a $lien>$res[nom_monstre] ($res[id_gowap])</a></br>";
		echo "X=$res[x_monstre], Y=$res[y_monstre], Z=$res[z_monstre]</br>";
		echo "Vu : $res[is_seen_monstre] (".date("d/m/y H:i",$res[date_monstre]).")</br>";
		echo "<font size=1>";
		afficherLien("gowap","vue2d",$res[id_gowap], $res[x_monstre], $res[y_monstre], $res[z_monstre]);
		afficherLien("gowap","gps",$res[id_gowap], $res[x_monstre], $res[y_monstre], $res[z_monstre]);
		echo "</font>";

		echo "</td></tr></table>";
		
		//echo "$res[]</br>";
}
function afficherCadastreTaniereCadre($res)
{

		$lien = "href='engine_view.php?taniere=$res[id_taniere]'";
		echo "<hr noshade><table><tr><td>";
		echo "<img src='images/taniereRM.gif'>";
		
		echo "</td><td>";
		
		echo "<a $lien>".stripslashes($res[nom_lieu])." ($res[id_taniere])</a></br>";
		echo "X=$res[x_lieu], Y=$res[y_lieu], Z=$res[z_lieu]</br>";
		echo "<font size=1>";
		afficherLien("taniere","vue2d",$res[id_taniere],$res[x_lieu], $res[y_lieu], $res[z_lieu]);
		afficherLien("taniere","gps",$res[id_taniere],$res[x_lieu], $res[y_lieu], $res[z_lieu]);
		echo "</font>";

		echo "</td></tr></table>";
		$description_taniere = 	preg_replace("/\n/","<br>",$res["description_taniere"]);
		echo stripslashes($description_taniere)."</br>";
}

####################################
## Affiche la fiche d'une Taniere 
####################################
function afficherFicheTaniere($id_taniere, $id_troll_taniere="")
{

	include_once("gps_advanced_js.php"); // pour la fonction swap
	$page = "engine_view.php";

	if ($id_taniere == "new") {
		//$id_troll_taniere = $id_troll_taniere; => pour info
		$info = "Ajouter";
	} else {
		$lesTanieres = selectDbTanieres($id_taniere);
		$res = $lesTanieres[1];

		$id_taniere = $res[id_taniere];
		$nom_lieu = stripslashes($res[nom_lieu]);
		$nom_troll = stripslashes($res[nom_troll]);
		$nom_image_troll = stripslashes($res[nom_image_troll]);
		$id_troll_taniere = $res[id_troll_taniere];
		$description_taniere = stripslashes($res[description_taniere]);
		$contenu_taniere = stripslashes($res[contenu_taniere]);
		$vente_taniere = stripslashes($res[vente_taniere]);
		$date_maj_taniere = $res[date_maj_taniere];
		$x_lieu = $res[x_lieu];
		$y_lieu = $res[y_lieu];
		$z_lieu = $res[z_lieu];
		$info = "Modifier";
	}
	
	echo "<form action='$page?taniere=edit' method='POST'>";
	echo "<input type='hidden' name='act' value='$id_taniere'>";
	echo "<input type='hidden' name='id_troll_taniere' value='$id_troll_taniere'";

	echo "<table>";
	
	echo "<tr><td valign='top' width=400>";
	afficherFicheTaniereIdentite($id_taniere,$nom_lieu,$id_troll_taniere,$nom_troll,$nom_image_troll,
																$x_lieu, $y_lieu, $z_lieu);
	afficherFicheTaniereDescription($description_taniere);
	
	echo "</td><td valign='top'>";
	
	afficherFicheTaniereContenu($contenu_taniere);
	afficherFicheTaniereVente($vente_taniere);
	
	echo "</td></tr></table>";
	
	// Un bouton modifier pour l'administrateur ou pour le proprio du gowap
	if ((isControlAdministrateur()) || ($_SESSION[AuthTroll] == $id_troll_taniere)) {
		afficherFicheTaniereMajInformations($description_taniere,$contenu_taniere, $vente_taniere);
		echo "<input type='submit' name='submit' value='$info' class='mh_form_submit'>&nbsp;";
		if ($id_taniere != "new") {
			echo "<input type='button' name='suppression' value='Supprimer' class='mh_form_submit'";
			echo " onClick=\"javascript=";
			echo " k=confirm('Confirmer la suppression de la tanière ?');";
			echo " if (k==true) {document.location.href='$page?taniere=del&id_taniere=$id_taniere';}";
			echo "\">&nbsp;";
		}
	}	

	echo "<input type='Button' value='Retour à la fiche du troll' class='mh_form_submit'";
	echo " onClick='JavaScript=document.location.href=\"$page?troll=$id_troll_taniere\"><br>";
}

function afficherFicheTaniereIdentite($id_taniere,$nom_lieu,$id_troll_taniere,$nom_troll, $nom_image_troll,																				$x_lieu, $y_lieu, $z_lieu)
{
?>
   <table  border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'width='100%'>
     <tr class='mh_tdpage'><td >
    	<table  border='0' cellpadding='0' cellspacing='1' width='100%' align='center'>
     	 <tr class='mh_tdtitre'>
        <td align='center' colspan='2'>
	
					<? if ($id_taniere != "new") echo stripslashes($nom_lieu); ?>
				</td>
				</tr>
     	 <tr class='mh_tdpage'>

<?
	echo "<tr><td colspan='2' align='center'>";
	echo "<img src='images/taniereRM.gif'> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<font color='black'>";
	$img = "http://www.pipeshow.net/RM/avatars/complets/".$nom_image_troll."_avatar.gif";
	echo "<img src='$img' border=5>";
	echo "</font>";
	echo "</td></tr>";
	
	echo "<tr><td>N° Taniere</td>";
	if ((isControlAdministrateur()) || ($_SESSION[AuthTroll] == $id_troll_taniere))
		echo "<td><input type='textbox' name='id_taniere' value='$id_taniere'></td></tr>";
	else
		echo "<td>$id_taniere</td></tr>";

	echo "<tr><td>Propriétaire </td>";
	echo "<td>$nom_troll ($id_troll_taniere)</td></tr>";

	echo "<tr><td>Position </td>";
	echo "<td>X=$x_lieu, Y=$y_lieu, Z=$z_lieu";
	
	
	echo "<font size=1>";
	afficherLien("taniere","vue2d",$id_taniere,$x_lieu, $y_lieu, $z_lieu);
	afficherLien("taniere","gps",$id_taniere,$x_lieu, $y_lieu, $z_lieu);
	echo "</font>";
	echo "</td></tr>";
	echo "</table>";
	echo "</td></tr>";
	echo "</table>";
}

function afficherFicheTaniereDescription($description_taniere)
{
?>
   <table  border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'width='100%'>
     <tr class='mh_tdpage'><td >
    	<table  border='0' cellpadding='0' cellspacing='1' width='100%' align='center'>
     	 <tr class='mh_tdtitre'>
        <td align='center' colspan='2'>
					Description
				</td>
				</tr>
     	 <tr class='mh_tdpage'>

<?
	echo "<td>";
	//echo " <textarea cols=120 rows=10 name='description_taniere'>";
	$description_taniere = preg_replace("/\n/","<br>",$description_taniere);
	echo stripslashes($description_taniere);
	//echo "</textarea>";
	echo " </td></tr>";
	echo "</table>";
	echo " </td></tr>";
	echo "</table>";
}

function afficherFicheTaniereContenu($contenu_taniere)
{
?>
   <table  border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'width='100%'>
     <tr class='mh_tdpage'><td >
    	<table  border='0' cellpadding='0' cellspacing='1' width='100%' align='center'>
     	 <tr class='mh_tdtitre'>
        <td align='center' colspan='2'>
					Contenu
				</td>
				</tr>
     	 <tr class='mh_tdpage'>

<?
	echo "<td>";
	//echo " <textarea cols=120 rows=20 name='contenu_taniere'>";
	$contenu_taniere = preg_replace("/\n/","<br>",$contenu_taniere);
	echo stripslashes($contenu_taniere);
	//echo "</textarea>";
	echo " </td></tr>";
	echo "</table>";
	echo " </td></tr>";
	echo "</table>";
}
function afficherFicheTaniereVente($vente_taniere)
{
?>
   <table  border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'width='100%'>
     <tr class='mh_tdpage'><td >
    	<table  border='0' cellpadding='0' cellspacing='1' width='100%' align='center'>
     	 <tr class='mh_tdtitre'>
        <td align='center' colspan='2'>
					Vente
				</td>
				</tr>
     	 <tr class='mh_tdpage'>

<?
	echo "<td>";
	//echo " <textarea cols=120 rows=20 name='vente_taniere'>";
	$vente_taniere = preg_replace("/\n/","<br>",$vente_taniere);
	echo stripslashes($vente_taniere);
	//echo "</textarea>";
	echo " </td></tr>";
	echo "</table>";
	echo " </td></tr>";
	echo "</table>";
}

function afficherFicheTaniereMajInformations($description_taniere,$contenu_taniere, $vente_taniere)
{	
?>
   <table  border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'width='100%'>
     <tr class='mh_tdpage'><td >
    	<table  border='0' cellpadding='0' cellspacing='1' width='100%' align='center'>
     	 <tr class='mh_tdtitre'>
        <td align='center' colspan='2'>
					Vente
				</td>
				</tr>
     	 <tr class='mh_tdpage'>

<?
	/* ------- maj description ------ */
	$act = "onClick=\"JavaScript:swapSpan('sdescription','img_sdescription','swap_sdescription')\"";
	echo "<td colspan='2'>";
  echo "<img id='img_sdescription' src='images/triangle-bleu.gif' $act> ";
	echo "<input type='hidden' id='swap_sdescription' name='swap_sdescrption' value='none'>";
  echo "<span $act>Mettre à jour la description</span><br>";
  echo "<span id='sdescription' style='display: none;'>";
	echo "Copiez/collez ici la description de votre gowap (Ctrl+a puis Ctrl+c sur MountyHall, Ctrl+v ci-dessous)<br>";
	echo " <textarea cols=80 rows=10 name='description_taniere'>";
	echo $description_taniere;
	echo "</textarea></span></td></tr>";


	/* ------- maj contenu ------ */
	$act = "onClick=\"JavaScript:swapSpan('scontenu','img_scontenu','swap_scontenu')\"";
	echo "<td colspan='2'>";
  echo "<img id='img_scontenu' src='images/triangle-bleu.gif' $act> ";
	echo "<input type='hidden' id='swap_scontenu' name='swap_scontenu' value='none'>";
  echo "<span $act>Mettre à jour le contenu</span><br>";
  echo "<span id='scontenu' style='display: none;'>";
	echo "Copiez/collez ici le contenu de votre tanière (Ctrl+a puis Ctrl+c sur MountyHall, Ctrl+v ci-dessous)<br>";
	echo " <textarea cols=80 rows=10 name='contenu_taniere'>";
	echo $contenu_taniere;
	echo "</textarea></span></td></tr>";

	/* ------- maj vente ------ */
	$act = "onClick=\"JavaScript:swapSpan('svente','img_svente','swap_svente')\"";
	echo "<td colspan='2'>";
  echo "<img id='img_svente' src='images/triangle-bleu.gif' $act> ";
	echo "<input type='hidden' id='swap_svente' name='swap_svente' value='none'>";
  echo "<span $act>Mettre à jour les objets en vente</span><br>";
  echo "<span id='svente' style='display: none;'>";
	echo "Copiez/collez ici les objets en vente dans de votre tanière (Ctrl+a puis Ctrl+c sur MountyHall, Ctrl+v ci-dessous)<br>";
	echo " <textarea cols=80 rows=10 name='vente_taniere'>";
	echo $vente_taniere;
	echo "</textarea></span></td></tr>";
	echo "</table>";
	echo "</td></tr>";
	echo "</table>";
}

######################################
# Affiche la liste des Baronnies
#####################################
function afficherListeBaronnies()
{

	$lesBaronnies = selectDbBaronnies();
	afficherTableauObjetRM("baronnies",$lesBaronnies);
}

##################################
# Affiche un cadre de la baronnie dans la liste des baronnies
#################################
function afficherListeBaronniesCadreBaronnie($baronnie)
{
	$lien = "href='$page?baronnie=$baronnie[id_baronnie]'";

	$lien_gps  = "href='gps_advanced.php?x=$baronnie[x_trone_baronnie]&y=$baronnie[y_trone_baronnie]";
	$lien_gps .= "&swap_poi=block&baronnies_old=non&baronnies=on&swap_affutage=block&vue=50";
	$lien_gps .= "&relaismago_old=on&relaismago=on&allies_old=non&ennemis_old=non'";
	
	echo "<center>";
	echo "<table width='100%'><tr>";
	echo "<td width='50%' style='background-color:#$baronnie[couleur1_baronnie];'>&nbsp;</td>";
	echo "<td width='50%' style='background-color:#$baronnie[couleur2_baronnie];'>&nbsp;</td>";
	echo "</tr></table>";

	echo "<a $lien>".stripslashes($baronnie[nom_baronnie])."</a><br>";
	echo stripslashes($baronnie[nom_troll])."<br>";
	echo "<img src='$baronnie[img_blason_baronnie]'></center><br>";
	echo "<table align='center'>";
	echo "<tr><td>";
	echo " <img src='$baronnie[img_drapeau_baronnie]'> ";
	echo "</td>";
	echo "<td align='center' width='100%'>";
	echo "<i>".stripslashes($baronnie[blason_baronnie])."</i><br>";
	echo " <img src='$baronnie[img_mini_blason_baronnie]'> ";
	echo " <img src='$baronnie[img_mini_blason_baronnie]'>";
	echo "</td></tr>";
	echo "</table> ";
	echo "<center><font size=1><a $lien_gps>Voir sur le gps</a></font>";
	echo "<hr>Membres : <br><br></center>";

	$lesTrolls = selectDbTrolls("","",$baronnie[id_baronnie]);
	$nbTrolls = count($lesTrolls);
	
	echo "<table>";
	for($i=1;$i<=$nbTrolls;$i++) {
		$res = $lesTrolls[$i];
		$lien_fiche = "href='engine_view.php?troll=$res[id_troll]'";

		$lien_gps_adv = "href='gps_advanced.php?swap_affutage=block&";
		$lien_gps_adv .= "swap_reglage=block&vue=40&poi_viseur_id_troll=$res[id_troll]&";
		$lien_gps_adv .= "relaismago_old=on&relaismago=on&allies_old=on&ennemis_old=on'";
	
		$lien_vue2d="href='cockpit.php?centrer=on&cX=$res[x_troll]&cY=$res[y_troll]&cZ=$res[z_troll]'";	
		$lien_mh = "href='http://games.mountyhall.com/mountyhall/View/PJView.php?ai_IDPJ=$res[id_troll]' target='troll'";

		echo "<tr><td valign=bottom align=center>";

		$img = "http://www.pipeshow.net/RM/avatars/complets/".$res[nom_image_troll]."_avatar.gif";
		echo "<font color='black'> <img src='$img' border='5' ></font><br>";
		echo "<a $lien_fiche>".stripslashes($res[nom_troll])." ($res[id_troll])";
		echo "</td><td valign=bottom>";
		echo "<font size=1>X=$res[x_troll], Y=$res[y_troll], Z=$res[z_troll]<br>";
		echo "vue : $res[is_seen_troll] (".date("d/m/Y H:i",$res[date_troll]).")<br>";
		echo "<a $lien_vue2d>vue2d</a> <a $lien_gps_adv>gps</a> <a $lien_mh>mh</a></font>";
		echo "</tr>";
	}
	echo "</table><br>";
}

######################################
# Affiche la liste des Trolls d'une Baronnie
#####################################
function afficherListeTrollsBaronnie($id_baronnie)
{
	global $db_vue_rm;

	$page = "engine_view.php";

	echo "<table class='list'>";
	echo "<tr class='titre-tableau' style='background-color:#6f7ca2;'>";
	echo "<td>Nom</td>";
	echo "<td>Info</td>";
	echo "<td>Position</td>";
	echo "<td>Accès</td></tr>";
	$lesTrolls = selectDbTrolls("","",$id_baronnie);

	$nbTrolls = count($lesTrolls);

	for($i=1;$i<=$nbTrolls;$i++) {
		$res = $lesTrolls[$i];
		$lien = "href='$page?troll=$res[id_troll]'";
		echo "<tr class=\"item-impair\" onmouseover=\"this.className='item-mouseover'\"";
		echo "onmouseout=\"this.className='item-impair'\">";
		echo "<td><a $lien>".stripslashes($res[nom_troll])."</a></td>";
		echo "<td>".date("d/m/Y H:i",$res[date_troll])."</td>";

		$lien_vue2d = "href='cockpit.php?centrer=on&cX=$res[x_troll]&cY=$res[y_troll]&cZ=$res[z_troll]'";
		$lien_gps_adv = "href='gps_advanced.php?taille_map=600&vue=40&x=$res[x_troll]&y=$res[y_troll]'";

		echo "<td>X=$res[x_troll], Y=$res[y_troll], Z=$res[z_troll]</td>";
		echo "<td><a $lien_vue2d>vue2d</a> <a $lien_gps_adv>gps</a></td>";
		echo "</tr>";
	}
	echo "</table>";
}

####################################
# Affiche la liste des Guildes
####################################
function afficherListeGuildes($sort)
{
	global $db_vue_rm;

	$page = "engine_view.php";

	echo "<form action='$page'>";
	?>
   <table class='mh_tdborder' width='70%' align='center'>
      <tr><td>
        <table width='100%' cellspacing='0'>
          <tr class='mh_tdpage' align="center">
            <td>

	<?
	echo "<a href='$page?guilde=sort_diplomatie'>Trier suivant leur Diplomatie</a><br>";
	echo "<a href='$page?guilde=sort_diplomate'>Trier suivant le Diplomate ".RELAISMAGO."</a><br>";
	echo "Affiche les guildes avec le statut : ";
	echo "<select name='guilde'>";
	afficher_listbox_select("liste", $sort," ");
	afficher_listbox_select("neutre", $sort);
	afficher_listbox_select("tk", $sort);
	afficher_listbox_select("ennemie", $sort);
	afficher_listbox_select("amie", $sort);
	afficher_listbox_select("alliee", $sort, "alliée");
	echo "</select>";
	echo "<input type='submit' value='Afficher' class='mh_form_submit'>";
	echo "<br><br>";
	?>
		</td></tr></table>
		</td></tr></table><br>
	<?
	
	$lesGuildes = selectDbGuildes("",$sort);
	$nbGuildes = count($lesGuildes);

	?>
   <table class='mh_tdborder' width='70%' align='center'>
      <tr><td>
        <table width='100%' cellspacing='0'>
          <tr class='mh_tdpage' align="center">
            <td>

	<?
	echo "<table class='list'>";
	echo "<tr class='titre-tableau yvo'>";
	echo "<td>Liste des Guildes</td>";
	echo "<td>Diplomatie</td>";
	echo "<td>Gestionnaire (chef)</td>";
	echo "<td>Contact</td>";
	echo "<td>Diplomate".RELAISMAGO."</td>";
	echo "<td>Mh</td>";
	echo "</tr>";

	for($i=1;$i<=$nbGuildes;$i++) {
		$res = $lesGuildes[$i];
	
		$id_guilde = $res[id_guilde];
		$nom_guilde = stripslashes($res[nom_guilde]);
		//$nom_guilde = htmlentities(stripslashes($res[nom_guilde])); // bug signalé par P&T
		$statut_guilde = $res[statut_guilde];
		$gestionnaire_id_troll_guilde = $res[gestionnaire_id_troll_guilde];
	  $contact_id_troll_guilde = $res[contact_id_troll_guilde];
	  $info_1_guilde = $res[info_1_guilde];
	  $diplomate_id_troll_guilde = $res[diplomate_id_troll_guilde];
	  $web_guilde = $res[web_guilde];
	  $historique_guilde = $res[historique_guilde];
	  $nom_gestionnaire = stripslashes($res[nom_gestionnaire]);
	  $nom_contact = stripslashes($res[nom_contact]);
	  $nom_diplomate = stripslashes($res[nom_diplomate]);

		if ($gestionnaire_id_troll_guilde == 0)
			$gestionnaire_id_troll_guilde ="";
		if ($contact_id_troll_guilde == 0)
			$contact_id_troll_guilde = "";
		if ($diplomate_id_troll_guilde == 0)
			$diplomate_id_troll_guilde = "";

		$lien = "href='$page?guilde=$id_guilde'";
		$lien_fiche="href='engine_view.php?troll=";
		echo "<tr class=\"item-impair\" onmouseover=\"this.className='item-mouseover'\"";
		echo "onmouseout=\"this.className='item-impair'\">";
		//echo "<td nowrap><a $lien>".htmlentities(stripslashes($res[nom_guilde]))."</a></td>"; // boulet ! :)
		echo "<td nowrap><a $lien>".stripslashes($res[nom_guilde])."</a></td>";
		echo "<td nowrap>$statut_guilde</td>";
		echo "<td nowrap><a $lien_fiche$gestionnaire_id_troll_guilde'>$nom_gestionnaire $gestionnaire_id_troll_guilde</a></td>";
		echo "<td nowrap><a $lien_fiche$contact_id_troll_guilde'>$nom_contact $contact_id_troll_guilde</a></td>";
		echo "<td nowrap><a $lien_fiche$diplomate_id_troll_guilde'>$nom_diplomate $diplomate_id_troll_guilde</a></td>";
		$lien_mh = "http://games.mountyhall.com/mountyhall/View/AllianceView.php?ai_IDAlliance=$id_guilde";
		echo "<td nowrap><a href='$lien_mh'>Mh</a></td>";
		echo "</tr>";
	}
	
	echo "</table>";
	echo "</td></tr></table>";
	echo "</td></tr></table>";
}


####################################
# Affiche la liste des Trolls 
####################################
function afficherListeTrolls($sort)
{
	global $db_vue_rm;
	
	$page = "engine_view.php";

	// Désactiver pour éviter les charges serveur...
	//echo "<a href='admin.php?troll=all'>Afficher tous les trolls</a> - ";
	?>
   <table class='mh_tdborder' width='80%' align='center'>
      <tr><td>
        <table width='100%' cellspacing='0'>
          <tr class='mh_tdpage' align="center">
            <td>

	<?
	echo "<a href='$page?troll=filter_guilde_".ID_GUILDE."'>Trolls ".RELAISMAGO." </a>- ";
	echo "<a href='$page?troll=filter_grief'>Trolls avec Grief</a> - ";
	echo "<a href='$page?troll=filter_tk'>Trolls TK</a> - ";
	echo "<a href='$page?troll=filter_wanted'>Trolls wanted </a> - ";
	echo "<a href='$page?troll=filter_venge'>Trolls chatiés </a> - ";
	echo "<a href='$page?troll=filter_wanted_not_venge'>Trolls wanted non châtiés </a> - ";
	echo "<a href='$page?troll=filter_guilde_ennemie_and_tk'>Trolls avec guilde ennemie</a><br>";

	if (iscontroladministrateur()) {
		echo "<br>Filtres d'administration - ";
		echo "<a href='$page?troll=filter_wanted_without_grief'>Trolls wanted sans griefs </a> - ";
		echo "<a href='$page?troll=filter_tk_or_wanted_with_statut_neutre'> ";
		echo "Trolls tk ou wanted mais avec statut (du troll et de sa guilde) neutre</a> - ";
		echo "<a href='$page?troll=filter_statut_tk_or_wanted_without_istk_or_iswanted'>";
		echo "Trolls statut tk ou ennemi sans être noté Tk ou Wanted</a><br>";
	}

	echo "<br><br>";
	afficherGotToRmFiche($_SESSION[AuthTroll]);

	echo "<br>";
	echo "<form name='go_fiche_b' action='$page'>";
	echo "Afficher la fiche du Troll n° : ";
	echo "<input type='textbox' name='troll' size='6' maxlength='6' class='mh_form_submit'> ";
	echo "<input type='submit' value='Voir' class='mh_form_submit'>";
	echo "</form>";

 // Mini formulaire de recherche qui renvoit sur la recherche d'un troll
  echo "<form name='go_fiche_recherche' action='$page'>";
  echo "<br>";
  echo "Recherche d'un troll par son nom : ";
  echo "<input type='hidden' name='recherche' value='trolls'>";
  echo "<input type='textbox' name='nom_troll' size='6' class='mh_form_submit'>";
  echo " <input type='submit' value='Voir' class='mh_form_submit'>";
  echo "</form>";

	echo "<form name='go_list' action='$page'>";
	echo "Voir par statut diplomatique <font size='1'>(du Troll ou de sa guilde) :</font>";
	echo "<select name='troll' class='mh_form_submit'>";
	afficher_listbox_select("-", $sort);
	afficher_listbox_select("neutre", $sort);
	afficher_listbox_select("tk", $sort);
	afficher_listbox_select("ennemie", $sort);
	afficher_listbox_select("amie", $sort);
	afficher_listbox_select("alliee", $sort, "alliée");
	echo "</select> &nbsp;";
	echo "<input type='submit' value='Voir' class='mh_form_submit'>";
	echo "</form>";
	
	if ($sort == "liste") {
		echo "<br><b><font color=red>Vous devez choisir un filtre</b></font>";
	}
	?>
            </td>
          </tr>
        </table>
      </td></tr>
    </table>
		<br>

	<?
	if ($sort == "liste") {
		return;
	}

	?>
   <table class='mh_tdborder' width='70%' align='center'>
      <tr><td>
        <table width='100%' cellspacing='0'>
          <tr class='mh_tdpage' align="center">
            <td>

	<?
	echo "<br><table class='list' width='100%'>";
	echo "<tr class='titre-tableau'>";
	echo "<td nowrap>Nom</td>";
	echo "<td nowrap>Tk</td>";
	echo "<td nowrap>Châtié</td>";
	echo "<td nowrap>Wanted</td>";
	echo "<td nowrap>Guilde</td>";
	echo "<td nowrap>Diplomatie Guilde</td>";
	echo "<td nowrap>Diplomatie du Troll</td>";
	
	if (preg_match("/filter_guilde_(\d+)/",$sort,$parts))
		$sort = $parts[1];

	$lesTrolls = selectDbTrolls("",$sort);
	$nbTrolls = count($lesTrolls);

	for($i=1;$i<=$nbTrolls;$i++) {
		
		$res = $lesTrolls[$i];

		if (($res[is_venge_troll] == 'non') && ($res[is_wanted_troll] =='oui')) {
				$info_venge = " (Jamais Chatié!)";
		}	
		$lien = "href='$page?troll=$res[id_troll]'";
		$lien_guilde = "href='$page?guilde=$res[id_guilde]'";

		echo "<tr class=\"item-impair\" onmouseover=\"this.className='item-mouseover'\"";
		echo "onmouseout=\"this.className='item-impair'\">";
		echo "<td nowrap><a $lien>$res[nom_troll] ($res[id_troll])</a></td>";
		echo "<td>$res[is_tk_troll]</td>";
		echo "<td>$res[is_venge_troll]</td>";
		echo "<td>$res[is_wanted_troll]";
		if (($res[is_venge_troll] == 'non') && ($res[is_wanted_troll] =='oui'))
			echo $info_venge;
		echo "</td>";
		echo "<td nowrap><a $lien_guilde>$res[nom_guilde]</a></td>";
		echo "<td>$res[statut_guilde]</td>";
		echo "<td>$res[statut_troll]</td>";
		echo "</tr>";
	}
	echo "</table>";
	echo "</tr></td></table>";
	echo "</tr></td></table>";
}

######################
# Affiche une listbox permettant d'aller directement sur la fiche d'un RM.
######################
function afficherGotToRmFiche($id_troll="")
{
	echo "<form name='go_fiche_a' action='$page'>";
	echo "Afficher la fiche du Troll ".RELAISMAGO." : ";
	echo "<select name='troll' class='mh_form_submit'>";
	afficher_listbox_troll_rm_select($id_troll);
	echo "</select>";
	echo " <input type='submit' value='Voir' class='mh_form_submit'>";
	echo "</form>";
}


#######################################
# Affiche la liste des griefs pour un troll
#######################################
function afficherListeGriefs($id_troll, $id_troll_impacte="")
{
	global $db_vue_rm;

	echo "<table class='list' width='100%'>";
	echo "<tr class='titre-tableau'>";
	echo "<td>Le grieffeur</td>";
	echo "<td>Date</td>";
	echo "<td>Type</td>";
	echo "<td>Description</td>";
	echo "<td>Troll Impacté</td>";
	echo "</tr>";

	if ($id_troll_impacte!="") {
		$lesGriefs = selectDbGriefs("","","",$id_troll_impacte);
	} else {
		$lesGriefs = selectDbGriefs($id_troll);
	}
	$nbGriefs = count($lesGriefs);

	for($i=1;$i<=$nbGriefs;$i++) {
		$res = $lesGriefs[$i];

		// Troll vengeur, peut-être améliorer pour pas faire
		// de req sql pour chaque ligne...
		$lesTrolls = selectDbTrolls($res[tk_id]);
		$troll_tk = $lesTrolls[1];

		$lesTrolls = selectDbTrolls($res[troll_impacte]);
		$troll_impacte = $lesTrolls[1];

		if (iscontroladministrateur()) {
			$lien = "href='engine_view.php?troll=$res[tk_id]&troll_type_action=grief&troll_action=$res[grief_id]'";
		}
		echo "<tr class=\"item-impair\" onmouseover=\"this.className='item-mouseover'\"";
		echo "onmouseout=\"this.className='item-impair'\">";
		echo "<td><a $lien>$troll_tk[nom_troll] ($res[tk_id])</a></td>";
		echo "<td><a $lien>$res[date_grief]</a></td>";
		echo "<td><a $lien>$res[type]</a></td>";
		echo "<td><a $lien>$res[description]</a></td>";
		echo "<td><a $lien>$troll_impacte[nom_troll] ($troll_impacte[id_troll])</a></td>";
		echo "</tr>";

	}
	echo "</table>";
}

#####################################
# Affiche la liste des chatiements d'un troll
#####################################
function afficherListeVengeances($id_troll,$id_troll_vengeur="")
{
	global $db_vue_rm;

	echo "<table class='list' width='100%'>";
	echo "<tr class='titre-tableau'>";
	echo "<td>Troll Chatié</td>";
	echo "<td>Date Vengeance</td>";
	echo "<td>Description</td>";
	echo "<td>Troll Vengeur</td>";
	echo "</tr>";


	if ($id_troll_vengeur!="") {
		$lesVengeances = selectDbVengeances("","",$id_troll_vengeur);
	} else {
		$lesVengeances = selectDbVengeances($id_troll);
	}
	$nbVengeances = count($lesVengeances);
	
	for($i=1;$i<=$nbVengeances;$i++) {
		$res = $lesVengeances[$i];

		// Troll vengeur, peut-être améliorer pour pas faire
		// de req sql pour chaque ligne...
		$lesTrolls = selectDbTrolls($res[tk_id]);
		$troll_chatie = $lesTrolls[1];

		$lesTrolls = selectDbTrolls($res[troll_vengeur]);
		$troll_vengeur = $lesTrolls[1];
		
		if (iscontroladministrateur()) {
			$lien = "href='engine_view.php?troll=$res[tk_id]&troll_type_action=venge&troll_action=$res[vengeance_id]'";
		}
		echo "<tr class=\"item-impair\" onmouseover=\"this.className='item-mouseover'\"";
		echo "onmouseout=\"this.className='item-impair'\">";
		echo "<td><a $lien>$troll_chatie[nom_troll] ($res[tk_id])</a></td>";
		echo "<td><a $lien>$res[date_vengeance]</a></td>";
		echo "<td><a $lien>$res[description]</a></td>";
		echo "<td><a $lien>$troll_vengeur[nom_troll] ($troll_vengeur[id_troll])</a></td>";
		echo "</tr>";
	}
	echo "</table>";
}

#####################################
# Affiche la liste des gowaps d'un troll
#####################################
function afficherListeGowaps($id_troll)
{
	global $db_vue_rm;
	
	$page = "engine_view.php";

	echo "<table class='list'>";
	echo "<tr class='titre-tableau'>";
	echo "<td nowrap>Id Gowap</td>";
	echo "<td nowrap>Vu</td>";
	echo "<td nowrap>Position</td>";
	echo "<td>date de mise à jour du chargement</td>";
	echo "<td nowrap>Accès</td>";
	echo "</tr>";

	$lesGowaps = selectDbGowaps("",$id_troll);
	$nbGowaps = count($lesGowaps);
	
	for($i=1;$i<=$nbGowaps;$i++) {
		$res = $lesGowaps[$i];
		$liste_gowap_id[$i] = $res[id_gowap];

		$lien_vue2d = "href='cockpit.php?centrer=on&cX=$res[x_monstre]&cY=$res[y_monstre]&cZ=$res[z_monstre]'";
		$lien_gps_adv = "href='gps_advanced.php?taille_map=600&vue=40&x=$res[x_monstre]&y=$res[y_monstre]'";

		$lien = "href='$page?gowap=$res[id_gowap]'";
		echo "<tr class=\"item-impair\" onmouseover=\"this.className='item-mouseover'\"";
		echo "onmouseout=\"this.className='item-impair'\">";
		echo "<td nowrap><a $lien>$res[id_gowap]</a></td>";
		echo "<td nowrap><a $lien>$res[is_seen_monstre] (".date("d/m/y H:i",$res[date_monstre]).")</a></td>";
		echo "<td nowrap><a $lien>X=$res[x_monstre], Y=$res[y_monstre], Z=$res[z_monstre]</a></td>";
		echo "<td nowrap><a $lien>$res[date_chargement_gowap]</a></td>";
		echo "<td nowrap>accès : <a $lien_vue2d>vue 2d</a>,<a $lien_gps_adv> GPS</a></td>";
		echo "</tr>";
	}

	echo "</table>";
	
	// On regarde s'il n'y a pas d'erreur => si tous les gowaps sont dans la table gowaps
	if ((isControlAdministrateur()) || ($_SESSION[AuthTroll] == $id_troll)) {
		echo "<table class='fiche'>";
		$lesGowaps = selectDbGowapsFromTableGowap("",$id_troll);
		$nbGowaps = count($lesGowaps);
		
		for($i=1;$i<=$nbGowaps;$i++) {
			$res = $lesGowaps[$i];
			$flag=false;
			for ($j=1;$j<=count($liste_gowap_id);$j++)
				if ($res[id_gowap] == $liste_gowap_id[$j])
					$flag=true;
	
			if (!$flag) {
				echo "<tr><td><font color=red><b>ERREUR détectée <b>";
				$lien_del = "href='$page?gowap=del&id_gowap=$res[id_gowap]'";
				echo "<a $lien_del>Supprimer l'erreur ($res[id_gowap])</a>";
				echo "</font></td></tr>";
			}
		}
		echo "</table>";
	}
}

#####################################
# Affiche la liste des tanières d'un troll
#####################################
function afficherListeTanieres($id_troll)
{
	global $db_vue_rm;
	
	$page = "engine_view.php";

	$lesTanieres = selectDbTanieres("",$id_troll);
	$nbTanieres = count($lesTanieres);

	echo "<table class='list' width='1OO%'>";
	echo "<tr class='titre-tableau'>";
	echo "<td nowrap>Nom Tanière</td>";
	echo "<td nowrap>Id</td>";
	echo "<td>Position</td>";
	echo "<td>date de maj (fiche)</td>";
	echo "<td nowrap>Accès</td>";
	echo "</tr>";

	for($i=1;$i<=$nbTanieres;$i++) {
		$res = $lesTanieres[$i];
		$liste_taniere_id[$i] = $res[id_taniere];

		$lien_vue2d = "href='cockpit.php?centrer=on&cX=$res[x_lieu]&cY=$res[y_lieu]&cZ=$res[z_lieu]'";
		$lien_gps_adv = "href='gps_advanced.php?taille_map=600&vue=40&x=$res[x_lieu]&y=$res[y_lieu]&";
		$lien_gps_adv .= "tanieres_rm_old=non&tanieres_rm=on&allies_old=non&allies=non&ennemis_old=non&ennemis=non";
		$lien_gps_adv .="&swap_poi=block&vue=20'";

		$lien = "href='$page?taniere=$res[id_taniere]'";
		echo "<tr class=\"item-impair\" onmouseover=\"this.className='item-mouseover'\"";
		echo "onmouseout=\"this.className='item-impair'\">";
		echo "<td nowrap><a $lien>$res[nom_lieu]</a></td>";
		echo "<td nowrap><a $lien>$res[id_taniere]</a></td>";
		echo "<td nowrap><a $lien>X=$res[x_lieu], Y=$res[y_lieu], Z=$res[z_lieu]</a></td>";
		echo "<td nowrap><a $lien>$res[date_maj_taniere]</a></td>";
		echo "<td nowrap>accès : <a $lien_vue2d>vue 2d</a>,<a $lien_gps_adv> GPS</a></td>";
		echo "</tr>";
	}
	echo "</table>";

	// On regarde s'il n'y a pas d'erreur => si tous les gowaps sont dans la table gowaps
	if ((isControlAdministrateur()) || ($_SESSION[AuthTroll] == $id_troll)) {
		echo "<table class='fiche'>";
		$lesTanieres = selectDbTanieresFromTableTanieres("",$id_troll);
		$nbTanieres = count($lesTanieres);
		
		for($i=1;$i<=$nbTanieres;$i++) {
			$res = $lesTanieres[$i];
			$flag=false;
			for ($j=1;$j<=count($liste_taniere_id);$j++)
				if ($res[id_taniere] == $liste_taniere_id[$j])
					$flag=true;
	
			if (!$flag) {
				echo "<tr><td><font color=red><b>ERREUR détectée <b>";
				$lien_del = "href='$page?taniere=del&id_taniere=$res[id_taniere]'";
				echo "<a $lien_del>Supprimer l'erreur ($res[id_taniere])</a>";
				echo "</font></td></tr>";
			}
		}
		echo "</table>";
	}
}


###############################
# Liens vers les différentes recherches
###############################
function afficherRechercheNouvelle()
{

	$page = "engine_view.php";
?>
   <table  border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'width='100%'>
     <tr class='mh_tdpage'><td >
    	<table  border='0' cellpadding='0' cellspacing='1' width='100%' align='center'>
     	 <tr class='mh_tdtitre'>
        <td align='center' colspan='2'>
							
				</td>
				</tr>
     	 <tr class='mh_tdpage'>

<?
	//echo "<a href='$page?recherche=trolls'>Recherche Trolls </a> - ";
	//echo "<a href='$page?recherche=monstres'>Recherche Monstres </a> - ";
	echo "<center>";
	$src_img="src='images/recherchator.gif'";
	echo "<br><img $src_img border=0><br><br>";
	
	echo "Pour la recherche de Trolls - Monstres - Lieux => passez pas le cockpit.<br><br>";
/*	echo "<a href='$page?recherche=trolls'>[Recherche Trolls]</a> - ";
	echo "<a href='$page?recherche=monstres'>[Recherche Monstres]</a> - ";
	echo "<a href='$page?recherche=lieux'>[Recherche Lieux]</a> - ";*/
	echo "<a href='$page?recherche=tresors'>[Recherche Trésors]</a> - ";
	echo "<a href='$page?recherche=champignons'>[Recherche Champignons]</a> - ";
	echo "<a href='$page?recherche=chargement'>[Recherche Chargement / Equipement / Contenu]</a>";
	echo "</center>";
	echo "<br><br>";
	echo "</td></tr></table>";
	echo "</td></tr></table>";
}

################################
# Affiche le résultat d'une recherche
# de trolls 
################################
function afficherRechercheTrolls($display_form=false)
{

//	$chargement_id_troll = $_REQUEST[chargement_id_troll];

	$id_troll = $_REQUEST[id_troll];
	$nom_troll = $_REQUEST[nom_troll];
	$race_troll = $_REQUEST[race_troll];
	$nom_guilde = $_REQUEST[nom_guilde];
	$niveau_troll = $_REQUEST[niveau_troll];
	$is_tk_troll = $_REQUEST[is_tk_troll];
	$is_wanted_troll = $_REQUEST[is_wanted_troll];
	$is_venge_troll = $_REQUEST[is_venge_troll];
	$x_troll = $_REQUEST[x_troll];
	$y_troll = $_REQUEST[y_troll];
	$z_troll = $_REQUEST[z_troll];
	$limite  = $_REQUEST[limite_troll];
	$statut_troll = $_REQUEST[statut_troll];
	$statut_guilde = $_REQUEST[statut_guilde];
	
	if ($x_troll =="" && $y_troll == "" && $z_troll == "") {
		$lesTrolls = selectDbTrolls($_SESSION[AuthTroll]);
		$x_troll = $lesTrolls[1][x_troll];
		$y_troll = $lesTrolls[1][y_troll];
		$z_troll = $lesTrolls[1][z_troll];
	}

	if ($display_form)
		afficherRechercheTrollsFormulaire($id_troll, $nom_troll, $race_troll, $nom_guilde, $niveau_troll, 
																	  $is_tk_troll, $is_wanted_troll, $is_venge_troll,
																	  $x_troll, $y_troll, $z_troll, $limite, $statut_troll, $statut_guilde);
	$flag = false;

	if ( ($id_troll !="")||($nom_troll!="")||($race_troll!="")||($nom_guilde!="")||($niveau_troll!="")||
		 ($is_tk_trol!="")||($is_wanted_troll!="")||($is_venge_troll!="")||($statut_troll!="")||($statut_guilde !="")||
		 (($x_troll!="")&&($y_troll!="")&&($z_troll!="")) )
		 $flag = true;
	if ($flag == true)
		afficherRechercheTrollsResultat($id_troll, $nom_troll, $race_troll, $nom_guilde, $niveau_troll, 
																	  $is_tk_troll, $is_wanted_troll, $is_venge_troll,
																	  $x_troll, $y_troll, $z_troll, $limite, $statut_troll, $statut_guilde);
		
}


################################
# Affiche le résultat d'une recherche
# de Monstres
################################
function afficherRechercheMonstres($display_form=false)
{

	$id_monstre = $_REQUEST[id_monstre];
	$nom_monstre = $_REQUEST[nom_monstre];
	$x_monstre = $_REQUEST[x_monstre];
	$y_monstre = $_REQUEST[y_monstre];
	$z_monstre = $_REQUEST[z_monstre];
	$limite  = $_REQUEST[limite_monstre];
	$race = $_REQUEST[race_monstre];
	$famille = $_REQUEST[famille_monstre];
	$niveau = $_REQUEST[niveau_monstre];

	if ($x_monstre =="" && $y_monstre == "" && $z_monstre == "") {
		$lesTrolls = selectDbTrolls($_SESSION[AuthTroll]);
		$x_monstre = $lesTrolls[1][x_troll];
		$y_monstre = $lesTrolls[1][y_troll];
		$z_monstre = $lesTrolls[1][z_troll];
	}


	if ($display_form)
		afficherRechercheMonstresFormulaire($id_monstre, $nom_monstre, $x_monstre, $y_monstre, $z_monstre, $limite, $race, $famille, $niveau);

	$flag = false;

	if ( ($id_monstre !="")||($nom_monstre!="")||
		   (($x_monstre !="")&&($y_monstre!="")&&($z_monstre!="")) )
		 $flag = true;

	if ($flag == true)
		afficherRechercheMonstresResultat($id_monstre, $nom_monstre, $x_monstre, $y_monstre, $z_monstre, $limite, $race, $famille, $niveau);
		
}

################################
# Affiche le résultat d'une recherche sur 
# les lieux
################################
function afficherRechercheLieux($display_form=false)
{

//	$chargement_id_troll = $_REQUEST[chargement_id_troll];
	$id_lieu = $_REQUEST[id_lieu];
	$nom_lieu = $_REQUEST[nom_lieu];
	$x_lieu = $_REQUEST[x_lieu];
	$y_lieu = $_REQUEST[y_lieu];
	$z_lieu = $_REQUEST[z_lieu];
	$limite = $_REQUEST[limite_lieu];

	if ($x_lieu =="" && $y_lieu == "" && $z_lieu == "") {
		$lesTrolls = selectDbTrolls($_SESSION[AuthTroll]);
		$x_lieu = $lesTrolls[1][x_troll];
		$y_lieu = $lesTrolls[1][y_troll];
		$z_lieu = $lesTrolls[1][z_troll];
	}


	if ($display_form)
		afficherRechercheLieuxFormulaire($lieu_1, $lieu_2, $lieu_3, $x_lieu, $y_lieu, $z_lieu,$limite);
	//if ($lieu_1 != "")
		afficherRechercheLieuxResultat($id_lieu, $nom_lieu, $x_lieu, $y_lieu, $z_lieu,$limite);
}

################################
# Affiche le résultat d'une recherche
# de Monstres
################################
function afficherRechercheChampignons()
{

	$id_champi = $_REQUEST[id_champi];
	$nom_champi= $_REQUEST[nom_champi];
	$x_champi  = $_REQUEST[x_champi];
	$y_champi  = $_REQUEST[y_champi];
	$z_champi  = $_REQUEST[z_champi];
	$limite    = $_REQUEST[limite_champi];
	$is_seen_champi = $_REQUEST[is_seen_champi];

	afficherRechercheChampignonsFormulaire($id_champi, $nom_champi, $x_champi, $y_champi, $z_champi,
																				 $limite, $is_seen_champi);
	$flag = false;

	if ( ($id_champi !="")||($nom_champi !="")|| ($is_seen_champi !="")||
		   (($x_champi !="")&&($y_champi !="")&&($z_champi !="")) )
		 $flag = true;
	if ($flag == true)
		afficherRechercheChampignonsResultat($id_champi, $nom_champi, $x_champi, $y_champi, $z_champi, 
																				 $limite, $is_seen_champi);
		
}


################################
# Affiche le résultat d'une recherche
# de Trésors 
################################
function afficherRechercheTresors()
{

	$id_tresor  = $_REQUEST[id_tresor];
	$nom_tresor = $_REQUEST[nom_tresor];
	$x_tresor   = $_REQUEST[x_tresor];
	$y_tresor   = $_REQUEST[y_tresor];
	$z_tresor   = $_REQUEST[z_tresor];
	$limite     = $_REQUEST[limite_tresor];

	afficherRechercheTresorsFormulaire($id_tresor, $nom_tresor, $x_tresor, $y_tresor, $z_tresor, $limite);

	$flag = false;

	if ( ($id_tresor !="")||($nom_tresor !="")||
		   (($x_tresor !="")&&($y_tresor !="")&&($z_tresor !="")) )
		 $flag = true;
	if ($flag == true)
		afficherRechercheTresorsResultat($id_tresor, $nom_tresor, $x_tresor, $y_tresor, $z_tresor, $limite);
		
}

################################
# Affiche le résultat d'une recherche sur 
# le chargement des trolls / gowaps
################################
function afficherRechercheChargement()
{

	$chargement_id_troll = $_REQUEST[chargement_id_troll];
	$chargement_1 = $_REQUEST[chargement_1];
	$chargement_2 = $_REQUEST[chargement_2];
	$chargement_3 = $_REQUEST[chargement_3];

	afficherRechercheChargementFormulaire($chargement_id_troll, $chargement_1, $chargement_2, $chargement_3);
	if ($chargement_1 != "")
		afficherRechercheChargementResultat($chargement_id_troll, $chargement_1, $chargement_2, $chargement_3);
}

##################################
# Affiche le formulaire de recherche 
# des trolls
#################################
function afficherRechercheTrollsFormulaire($id_troll, $nom_troll, $race_troll, $nom_guilde, $niveau_troll, 
																					 $is_tk_troll, $is_wanted_troll, $is_venge_troll,
																					 $x_troll, $y_troll, $z_troll, $limite, $statut_troll, $statut_guilde)
{

	$page = "engine_view.php";
	
	echo "<form name='rechercheForm' action='$page'>";
	echo "<input type='hidden' name='recherche' value='trolls'>";
	echo "<h2>Recherche de trolls:</h2> <br>";

	echo "<table class='controls'>";
	echo "<tr class='titre'><td colspan=3>Identité</td></tr>";
	echo "<tr><td>N°</td>";
	echo "<td><input type='text' name='id_troll' size=7 value='$id_troll'></td></tr>";
	echo "<tr><td>Nom</td>";
	echo "<td><input type='text' name='nom_troll' size=30 value='$nom_troll'></td></tr>";
	echo "<tr><td></td><td><small>Un % remplace un ou plusieurs caractères. Ex : Woy<b>%</b>ek</small></td></tr>";
	echo "<tr><td>Niveau</td>";
	echo "<td><input type='text' name='niveau_troll' size=3 value='$niveau_troll'>";
	echo "<span onmouseover=\"poplink(' <span class=\'lieuxText red\'>5+ ou >5 pour afficher les trolls de niveau supérieur à 5<br> &lt; 30 ou 30- pour afficher les trolls de niveau &lt; 30</span>')\" onmouseout=\"killlink()\">";
	echo "<span class=\"red\">[?]</span></span>";
	echo "</td></tr>";
	echo "<tr><td>Guilde</td>";
	echo "<td><input type='text' name='nom_guilde' size=40 value='$nom_guilde'></td></tr>";
	echo "<tr><td>Race</td>";
	echo "<td><select name='race_troll'>";
	afficher_listbox_select("", $race_troll);
	afficher_listbox_select("Durakuir", $race_troll);
	afficher_listbox_select("Kastar", $race_troll);
	afficher_listbox_select("Skrim", $race_troll);
	afficher_listbox_select("Tomawak", $race_troll);
	echo "</select></td></tr>";

	echo "<tr class='titre'><td colspan=3>Diplomatie</td></tr>";
	echo "<tr><td>Est Tk :</td>";
	echo "<td><select name='is_tk_troll'>";
	afficher_listbox_select("", $is_tk_troll);
	afficher_listbox_select("non", $is_tk_troll);
	afficher_listbox_select("oui", $is_tk_troll);
	echo "</select></td></tr>";

	echo "<tr><td>Est Wanted : </td>";
	echo "<td><select name='is_wanted_troll'>";
	afficher_listbox_select("", $is_wanted_troll);
	afficher_listbox_select("non", $is_wanted_troll);
	afficher_listbox_select("oui", $is_wanted_troll);
	echo "</select></td></tr>";

	echo "<tr><td>Est Chatié :</td>";
	echo "<td><select name='is_venge_troll'>";
	afficher_listbox_select("", $is_venge_troll);
	afficher_listbox_select("non", $is_venge_troll);
	afficher_listbox_select("oui", $is_venge_troll);
	echo "</select></td></tr>";

	echo "<tr><td>Diplomatie Troll</td>";
	echo "<td><select name='statut_troll'>";
	afficher_listbox_select("", $statut_troll);
	afficher_listbox_select("neutre", $statut_troll);
	afficher_listbox_select("tk", $statut_troll);
	afficher_listbox_select("ennemie", $statut_troll);
	afficher_listbox_select("amie", $statut_troll);
	afficher_listbox_select("alliee", $statut_troll, "alliée");
	echo "</select></td></tr>";

	echo "<tr><td>Diplomatie Guilde</td>";
	echo "<td><select name='statut_guilde'>";
	afficher_listbox_select("", $statut_guilde);
	afficher_listbox_select("neutre", $statut_guilde);
	afficher_listbox_select("tk", $statut_guilde);
	afficher_listbox_select("ennemie", $statut_guilde);
	afficher_listbox_select("amie", $statut_guilde);
	afficher_listbox_select("alliee", $statut_guilde, "alliée");
	echo "</select></td></tr>";

	echo "<tr class='titre'><td colspan=3>Position</td></tr>";
	echo "<tr><td>X/Y/Z</td><td>";
	formulaire_listbox("x_troll",-150,150,1,$x_troll,"plusmoins","yes");
	formulaire_listbox("y_troll",-150,150,1,$y_troll,"plusmoins","yes");
	formulaire_listbox("z_troll",0,100,1,$z_troll,"plusmoins","yes");
	echo "</td></tr>";
	echo "<tr><td colspan=2>Limiter à ";
	if ($limite<1) 
	  $limite=4;
    formulaire_listbox("limite_troll",1,100,1,$limite,"moinsplus","yes");
	echo " cases</td><td>";
	echo "</td></tr>";

	echo "</table>";
	echo "<br>";	
	echo "<input type='submit' value='Rechercher'>";
	echo "</form>";
}

##################################
# Affiche le formulaire de recherche 
# des Monstres
#################################
function afficherRechercheMonstresFormulaire($id_monstre, $nom_monstre, $x_monstre, $y_monstre, $z_monstre, $limite, $race, $famille, $niveau)
{

	$page = "engine_view.php";
	
	echo "<form name='rechercheForm' action='$page'>";
	echo "<input type='hidden' name='recherche' value='monstres'>";
	echo "<h2>Recherche de Monstres : </h2><br>";

	echo "<table>";
	echo "<tr><td>N° de Monstre</td>";
	echo "<td><input type='text' name='id_monstre' value='$id_monstre'></td></tr>";
	echo "<tr><td>Nom Monstre</td>";
	echo "<td><input type='text' name='nom_monstre' value='$nom_monstre'></td></tr>";

	echo "<tr><td>X=</td><td>";
	formulaire_listbox("x_monstre",-200,200,1,$x_monstre,"plusmoins","yes");
	echo "<font size=1> obligatoire si vous renseignez y et z</font></td></tr>";
	echo "<tr><td>Y=</td><td>";
	formulaire_listbox("y_monstre",-200,200,1,$y_monstre,"plusmoins","yes");
	echo "<font size=1> obligatoire si vous renseignez x et z</font></td></tr>";
	echo "<tr><td>Z=</td><td>";
	formulaire_listbox("z_monstre",0,200,1,$z_monstre,"plusmoins","yes");
	echo "<font size=1> obligatoire si vous renseignez x et y</font></td></tr>";
	echo "<tr><td>Limite +/-</td><td>";
	formulaire_listbox("limite_monstre",0,100,1,$limite,"","yes");
	echo "</td></tr>";

	echo "<tr><td>Niveau</td><td>";
	formulaire_listbox("niveau_monstre",0,40,1,$niveau,"","yes");
	echo "</td></tr>";

	echo "</table>";
	echo "<br>";	
	echo "<input type='submit' value='Rechercher'>";
	echo "</form>";
}


##################################
# Affiche le formulaire de recherche 
# des Champignons 
#################################
function afficherRechercheChampignonsFormulaire($id_champi, $nom_champi, $x_champi, $y_champi, $z_champi, 
																								$limite, $is_seen_champi)
{

	$page = "engine_view.php";
	
	echo "<form name='rechercheForm' action='$page'>";
	echo "<input type='hidden' name='recherche' value='champignons'>";
	echo "<h2>Recherche de Champignons : </h2><br>";

	echo "<table>";
	echo "<tr><td>N° de Champignon</td>";
	echo "<td><input type='text' name='id_champi' value='$id_champi'></td></tr>";
	echo "<tr><td>Nom Champignon</td>";
	echo "<td><input type='text' name='nom_champi' value='$nom_champi'></td></tr>";

	echo "<tr><td>X=</td><td>";
	formulaire_listbox("x_champi",-200,200,1,$x_champi,"plusmoins","yes");
	echo "<font size=1> obligatoire si vous renseignez y et z</font></td></tr>";
	echo "<tr><td>Y=</td><td>";
	formulaire_listbox("y_champi",-200,200,1,$y_champi,"plusmoins","yes");
	echo "<font size=1> obligatoire si vous renseignez x et z</font></td></tr>";
	echo "<tr><td>Z=</td><td>";
	formulaire_listbox("z_champi",0,200,1,$z_champi,"plusmoins","yes");
	echo "<font size=1> obligatoire si vous renseignez x et y</font></td></tr>";
	echo "<tr><td>Limite +/-</td><td>";
	formulaire_listbox("limite_champi",0,100,1,$limite,"","yes");
	echo "</td></tr>";
	
	echo "<tr><td>Vu actuellement <font size=1>(ou il y a moins de 5 jours)</font></td>";
	echo "<td><select name='is_seen_champi'>";
	afficher_listbox_select("", $is_seen_champi);
	afficher_listbox_select("non", $is_seen_champi);
	afficher_listbox_select("oui", $is_seen_champi);
	echo "</select></td></tr>";
	
	echo "</table>";
	echo "<br>";	
	echo "<input type='submit' value='Rechercher'>";
	echo "</form>";
}


##################################
# Affiche le formulaire de recherche 
# des tresors
#################################
function afficherRechercheTresorsFormulaire($id_tresor, $nom_tresor, $x_tresor, $y_tresor, $z_tresor, $limite)
{

	$page = "engine_view.php";
	
	echo "<form name='rechercheForm' action='$page'>";
	echo "<input type='hidden' name='recherche' value='tresors'>";
	echo "<h2>Recherche de Trésors : </h2><br>";

	echo "<table>";
	echo "<tr><td>N° de Trésors</td>";
	echo "<td><input type='text' name='id_tresor' value='$id_tresor'></td></tr>";
	echo "<tr><td>Nom Trésor</td>";
	echo "<td><input type='text' name='nom_tresor' value='$nom_tresor'></td></tr>";

	echo "<tr><td>X=</td><td>";
	formulaire_listbox("x_tresor",-200,200,1,$x_tresor,"plusmoins","yes");
	echo "<font size=1> obligatoire si vous renseignez y et z</font></td></tr>";
	echo "<tr><td>Y=</td><td>";
	formulaire_listbox("y_tresor",-200,200,1,$y_tresor,"plusmoins","yes");
	echo "<font size=1> obligatoire si vous renseignez x et z</font></td></tr>";
	echo "<tr><td>Z=</td><td>";
	formulaire_listbox("z_tresor",0,200,1,$z_tresor,"plusmoins","yes");
	echo "<font size=1> obligatoire si vous renseignez x et y</font></td></tr>";
	echo "<tr><td>Limite +/-</td><td>";
	formulaire_listbox("limite_tresor",0,100,1,$limite,"","yes");
	echo "</td></tr>";
	
	echo "</table>";
	echo "<br>";	
	echo "<input type='submit' value='Rechercher'>";
	echo "</form>";
}


##################################
# Affiche le formulaire de recherche 
# sur les lieux
#################################
function afficherRechercheLieuxFormulaire($lieu_1, $lieu_2, $lieu_3)
{

	$page = "engine_view.php";
die('NON A JOUR, PASSEZ PAR LE COCKPIT - Bodéga');
	echo "<form name='rechercheForm' action='$page'>";
	echo "<input type='hidden' name='recherche' value='lieux'>";
	echo "<h2>Lieux à rechercher :</h2> <br>";
	echo "<input type='text' name='lieu_1' value='$lieu_1'>";
	echo "<font size='-1'>(obligatoire, % peut servir de jocker pour afficher tous les lieux)</font><br>";
	echo "<input type='text' name='lieu_2' value='$lieu_2'><font size='-1'>(non obligatoire)</font><br>";
	echo "<input type='text' name='lieu_3' value='$lieu_3'><font size='-1'>(non obligatoire)</font><br>";
	echo "</select><br>";	
	echo "<input type='submit' value='Rechercher'>";
	echo "</form>";
}
##################################
# Affiche le formulaire de recherche 
# sur le chargement
#################################
function afficherRechercheChargementFormulaire($chargement_id_troll, $chargement_1, $chargement_2, $chargement_3)
{

	$page = "engine_view.php";

	echo "<form name='rechercheForm' action='$page'>";
	echo "<input type='hidden' name='recherche' value='chargement'>";
	echo "<h2>À Rechercher dans les chargements / équipement : </h2><br>";
	echo "<input type='text' name='chargement_1' value='$chargement_1'>";
	echo "<font size='-1'>(obligatoire)</font><br>";
	echo "<input type='text' name='chargement_2' value='$chargement_2'><font size='-1'>(non obligatoire)</font><br>";
	echo "<input type='text' name='chargement_3' value='$chargement_3'><font size='-1'>(non obligatoire)</font><br>";
	echo "sur le Troll (ou ses gowaps, ou dans ses tanières) :";
	echo "<select name='chargement_id_troll'>";
	afficher_listbox_troll_rm_select($chargement_id_troll);
	echo "</select>";
	echo "<font size='-1'>(non obligatoire)</font><br>";
	echo "<input type='submit' value='Rechercher'>";
	echo "</form>";
}

##################################
# Affiche le résultat d'une recherche 
# de trolls
#################################
function afficherRechercheTrollsResultat($id_troll, $nom_troll, $race_troll, $nom_guilde, $niveau_troll, 
																			   $is_tk_troll, $is_wanted_troll, $is_venge_troll,
																			   $x_troll, $y_troll, $z_troll, $limite, $statut_troll, $statut_guilde, $lesTrolls="")
{
	if (!isset($lesTrolls)) {
		$lesTrolls = selectDbRechercheTrolls($id_troll, $nom_troll, $race_troll, $nom_guilde, $niveau_troll, 
																			 $is_tk_troll, $is_wanted_troll, $is_venge_troll,
																			 $x_troll, $y_troll, $z_troll, $limite, $statut_troll, $statut_guilde);
	}
	$nbTrolls = count($lesTrolls);
?> <br>
   <table  border='0' cellpadding='0' cellspacing='0' class='mh_tdborder' align='center'width='100%'>
     <tr class='mh_tdtitre'>
      <td align='center' colspan='15'>
				<? echo "R&eacute;sultat de la recherche de trolls : $nbTrolls trouv&eacute;(s). Position d&eacute;part : ";
					 echo "X=$x_troll/Y=$y_troll/Z=$z_troll" ?>
			</td>
			</tr>
			<?
				if ($nbTrolls == 0) {
					echo "</table>";
					return;
				}
			?>
      <tr class='mh_tdtitre'>
			<?
				if ( is_numeric($x_troll) && is_numeric($y_troll) && is_numeric($z_troll) )
					echo "<td>Distance en PA</td>";
			?>
				<td>Nom</td>
				<td>Guilde</td>
				<td>Race</td>
				<td>Niveau</td>
				<td>Tk</td>
				<td>Wanted</td>
				<td>Chati&eacute;</td>
				<td>Diplo Troll</td>
				<td>Diplo Guilde</td>
				<td colspan=3>Position</td>
				<td>Date de Mise &agrave; jour </td>
				<td>Acc&egrave;s </td>
				</tr>
<?


	usort($lesTrolls,"callbackSortDistancePa");

	while (list ($key, $res) = each ($lesTrolls)) {

		$i++;
		if ($res[maj_groupe_spec_troll] == 'oui' && !userIsGroupSpec())
		{
			$res[distance_pa]='?';
			$res[x_troll] = '?';
			$res[y_troll] = '?';
			$res[z_troll] ='?';
		}
		echo "<tr class='mh_tdpage'>";
		
		if ( is_numeric($x_troll) && is_numeric($y_troll) && is_numeric($z_troll) )
		echo "<td >$res[distance_pa]</a></td>";

		echo "<td>";
		afficherLien("troll","fiche",$res[id_troll],"","","",htmlentities($res[nom_troll])." ($res[id_troll])");
		echo "</td>";
		$lien_guilde = "href='/engine_view.php?guilde=$res[id_guilde]'";
		echo "<td ><a $lien_guilde>".htmlentities($res[nom_guilde])."</a></td>";
		echo "<td align=center>$res[race_troll]</td>";
		echo "<td align=center>$res[niveau_troll]</td>";
		echo "<td align=center>$res[is_tk_troll]</td>";
		echo "<td align=center>$res[is_wanted_troll]</td>";
		echo "<td align=center>$res[is_venge_troll]</td>";
		echo "<td align=center>$res[statut_troll]</td>";
		echo "<td align=center>$res[statut_guilde]</td>";
		echo "<td width=10>X=$res[x_troll]</td>";
		echo "<td width=10>Y=$res[y_troll]</td>";
		echo "<td width=40>N=$res[z_troll]</td>";
		echo "<td>$res[date_troll]";
		if ($res['is_seen_troll'] == 'non') {
			$title = "Disparu depuis le ".date ("d/m H:i", $res['date_troll'])."";
			echo "<img src='images/puce_disparu.gif' title='$title'>";
		}
		echo "</td>";
		
		echo "<td>";
		afficherLien("troll","fiche",$res[id_troll]);
		afficherLien("troll","vue2d",$res[id_troll]);
		afficherLien("troll","gps",$res[id_troll]);
		afficherLien("troll","mh_evenements",$res[id_troll]);
		echo "</td>";
		echo "</tr>";
		if ($i > 299) {
 		 	echo "<tr><td colspan='10'><h2><b>Il n'y a que les 300 premiers r&eacute;sultats d'affich&eacute;s, affinez votre recherche si vous voulez...</b></h2></td></tr>";
			break;
		}
	}
	echo "</table>";
	echo "</td></tr></table><br>";
}


##################################
# Affiche le résultat d'une recherche 
# de monstres
#################################
function afficherRechercheMonstresResultat($id_monstre, $nom_monstre, $x_monstre, $y_monstre, $z_monstre, $limite, $race, $famille, $niveau,$lesMonstres="")
{
	
	if (!isset($lesMonstres))
		$lesMonstres = selectDbRechercheMonstres($id_monstre, $nom_monstre, $x_monstre, $y_monstre, $z_monstre, $limite, $race, $famille, $niveau);

	$nbMonstres = count($lesMonstres);
	
?> <br>
   <table  border='0' cellpadding='0' cellspacing='0' class='mh_tdborder' align='center'width='100%'>
   	<tr class='mh_tdtitre'>
      <td align='center' colspan='15'>
				<? echo "R&eacute;sultat de la recherche de Monstres : $nbMonstres trouv&eacute;(s). Position d&eacute;part : ";
					 echo "X=$x_monstre/Y=$y_monstre/Z=$z_monstre Limite=$limite" ?>
			</td>
		</tr>
	<?
	if ($nbMonstres == 0) {
		echo "</table>";
		return;
	}
	?>
   	<tr class='mh_tdtitre'>
			<?
				if ( is_numeric($x_monstre) && is_numeric($y_monstre) && is_numeric($z_monstre) )
					echo "<td>Distance en PA</td>";
			?>
			<td>Nom</td>
			<td colspan=3>Position</td>
			<td>Race</td>
			<td>Famille</td>
			<td>Niveau</td>
			<td>Date de Mise &agrave; jour </td>
			<td>Acc&egrave;s</td>

<?

	usort($lesMonstres,"callbackSortDistancePa");

	while (list ($key, $res) = each ($lesMonstres)) {
		$i++;
		echo "<tr class='mh_tdpage'>";
		if ( is_numeric($x_monstre) && is_numeric($y_monstre) && is_numeric($z_monstre) ) {
			echo "<td width='1%'>$res[distance_pa]</td>";
		}
		
		echo "<td>".htmlentities($res[nom_monstre])." ($res[id_monstre])</td>";
		echo "<td width=10>X=$res[x_monstre]</td>";
		echo "<td width=10>Y=$res[y_monstre]</td>";
		echo "<td width=40>N=$res[z_monstre]</td>";
		echo "<td>".htmlentities($res[race])."</td>";
		echo "<td>".htmlentities($res[famille])."</td>";
		echo "<td align='center'>".htmlentities($res[niveau])."</td>";
		echo "<td>$res[date_monstre]</td>";
		
		echo "<td>";

		afficherLien("gowap","vue2d",$res[id_monstre], $res[x_monstre], $res[y_monstre], $res[z_monstre]);
		afficherLien("gowap","gps",$res[id_monstre], $res[x_monstre], $res[y_monstre], $res[z_monstre]);
		afficherLien("gowap","mh_evenements",$res[id_monstre], $res[x_monstre], $res[y_monstre], $res[z_monstre]);
		echo "</td>";

		if ($i > 99) {
  		echo "</tr><tr><td colspan='10'><h2><b>Il n'y a que les 100 premiers r&eacute;sultats d'affich&eacute;s, ";
			echo "affinez votre recherche si vous voulez...</b></h2></td>";
			break;
  	}
		echo "</tr>";
	}

	echo "</table>";
	echo "</td></tr></table>";
}

function callbackSortDistancePa($a,$b)
{
	if ($a[distance_pa] == $b[distance_pa]) return 0;
	elseif ($a[distance_pa] > $b[distance_pa]) return 1;
	elseif ($a[distance_pa] < $b[distance_pa]) return -1;
}

##################################
# Affiche le résultat d'une recherche 
# de Champignons 
#################################
function afficherRechercheChampignonsResultat($id_champi, $nom_champi, $x_champi, $y_champi, $z_champi, 
																							$limite, $is_seen_champi,$lesChampignons="")
{
	if (!isset($lesChampignons))	
	$lesChampignons = selectDbRechercheChampignons($id_champi, $nom_champi, $x_champi, $y_champi, $z_champi, 
																								 $limite, $is_seen_champi);
	$nbChampignons = count($lesChampignons);

	usort($lesChampignons,"callbackSortDistancePa");

?><br>
   <table  border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'width='100%'>
    <tr class='mh_tdtitre'>
      <td align='center' colspan='15'>
				<? echo "R&eacute;sultat de la recherche sur les Champignons: $nbChampignons trouv&eacute;(s). Position d&eacute;part : ";
					 echo " X=$x_champi/Y=$y_champi/Z=$z_champi";
				?>
			</td>
		</tr>
		<?
			if ($nbChampignons == 0) {
			echo "</table>";
			return;
		}
	
	echo "<tr class='mh_tdtitre'>";
	echo "<td>Distance</td>";
	echo "<td>Nom</td>";
	echo "<td colspan=3>Position</td>";
	echo "<td>Vu </td>";
	echo "<td>Date de Mise à jour </td>";
	echo "<td>&nbsp;</td>";

	for($i=1;$i<=$nbChampignons;$i++) {
		$res = $lesChampignons[$i];

		echo "<tr class='mh_tdpage'>";

		if ( is_numeric($x_champi) && is_numeric($y_champi) && is_numeric($z_champi) ) {
			echo "<td width='1%'>$res[distance_pa]</td>";
		}	
		echo "<td>".htmlentities($res[nom_champi])." ($res[nombre_champi])</td>";
		echo "<td width=10>X=$res[x_champi]</td>";
		echo "<td width=10>Y=$res[y_champi]</td>";
		echo "<td width=40>N=$res[z_champi]</td>";
		echo "<td width=40>N=$res[is_seen_champi]</td>";
		echo "<td>$res[date_champi]</td>";
		
		$lien_vue2d = "href='cockpit.php?cX=$res[x_champi]&cY=$res[y_champi]&cZ=$res[z_champi]'";
		$lien_gps_adv = "href='gps_advanced.php?taille_map=600&vue=40&x=$res[x_champi]&y=$res[y_champi]'";
		echo "<td>acc&egrave;s : <a $lien_vue2d>vue 2d</a>,<a $lien_gps_adv> GPS</a></td>";

		echo "</tr>";
		if ($i > 99) {
			echo "</tr><tr><td colspan=10>Il n'y a que les 100 premiers r&eacute;sultats d'affich&eacute;s, affinez votre recherche si vous voulez...</td></tr>";
			break;
		}
	}
	echo "</table>";

}

##################################
# Affiche le résultat d'une recherche 
# de Trésors
#################################
function afficherRechercheTresorsResultat($id_tresor, $nom_tresor, $x_tresor, $y_tresor, $z_tresor, $limite)
{
	
	$lesTresors = selectDbRechercheTresors($id_tresor, $nom_tresor, $x_tresor, $y_tresor, $z_tresor, $limite);
	$nbTresors = count($lesTresors);
	
	?>
   <table  border='0' cellpadding='0' cellspacing='0' class='mh_tdborder' align='center'width='100%'>
   	 <tr class='mh_tdtitre'>
       <td align='center' colspan='15'>
				<? echo "Résultat de la recherche de Trésors : $nbTresors trouvé(s)" ?>
			</td>
		</tr>
   	<tr class='mh_tdtitre'>
			<td>Nom</td>
			<td colspan=3>Position</td>
			<td>Date de Mise à jour </td>
			<td>Accès</td>
<?
	for($i=1;$i<=$nbTresors;$i++) {
		$res = $lesTresors[$i];

		echo "<tr class='mh_tdpage'>";
		
		echo "<td>$res[nom_tresor] ($res[id_tresor])</td>";
		echo "<td width=10>X=$res[x_tresor]</td>";
		echo "<td width=10>Y=$res[y_tresor]</td>";
		echo "<td width=40>N=$res[z_tresor]</td>";
		echo "<td>$res[date_tresor]</td>";

		echo "<td>";	
		afficherLien("tresor","vue2d",$res[id_tresor], $res[x_tresor], $res[y_tresor], $res[z_tresor]);
		afficherLien("tresor","gps",$res[id_tresor], $res[x_tresor], $res[y_tresor], $res[z_tresor]);
		echo "</td>";	

		echo "</tr>";
	}
	echo "</table>";
	if ($i > 99) {
  	echo "<h2><b>Il n'y a que les 100 premiers résultats d'affichés, affinez votre recherche si vous voulez...</b></h2>";
		break;
	}
}

##################################
# Affiche le résultat d'une recherche 
# sur les lieux 
#################################
function afficherRechercheLieuxResultat($id_lieu,$nom_lieu,$x_lieu,$y_lieu,$z_lieu,$limite,$lesLieux="")
{
	if (!isset($lesLieux))	
	$lesLieux = selectDbLieux($id_lieu,$nom_lieu,$x_lieu,$y_lieu,$z_lieu,$limite);

	$nbLieux = count($lesLieux);

?><br>
   <table  border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'width='100%'>
    <tr class='mh_tdtitre'>
      <td align='center' colspan='15'>
				<? echo "R&eacute;sultat de la recherche sur les Lieux : $nbLieux trouv&eacute;(s). Position d&eacute;part : ";
					 echo " X=$x_lieu/Y=$y_lieu/Z=$z_lieu";
				?>
			</td>
		</tr>
		<?
			if ($nbLieux == 0) {
			echo "</table>";
			return;
		}
		?>
     	 <tr class='mh_tdtitre'>
			<?
				if ( is_numeric($x_lieu) && is_numeric($y_lieu) && is_numeric($z_lieu) )
					echo "<td>Distance en PA</td>";
			?>
				<td>Nom</td>
				<td colspan=3>Info</td>
				<td>Date de Mise &agrave; jour </td>
				<td>Acc&egrave;s</td>
<?


	usort($lesLieux,"callbackSortDistancePa");

	while (list ($key, $res) = each ($lesLieux)) {

		$i++;
		echo "<tr class='mh_tdpage'>";
		if ( is_numeric($x_lieu) && is_numeric($y_lieu) && is_numeric($z_lieu) ) {
			echo "<td>$res[distance_pa]</td>";
		}
		
		echo "<td>".htmlentities($res[nom_lieu])." ($res[id_lieu])</td>";
		echo "<td width=10>X=$res[x_lieu]</td>";
		echo "<td width=10>Y=$res[y_lieu]</td>";
		echo "<td width=40>N=$res[z_lieu]</td>";
		echo "<td>$res[date_lieu]</td>";

		echo "<td>";	
		afficherLien("lieu","vue2d",$res[id_lieu], $res[x_lieu], $res[y_lieu], $res[z_lieu]);
		afficherLien("lieu","gps",$res[id_lieu], $res[x_lieu], $res[y_lieu], $res[z_lieu]);
		echo "</td>";	

		echo "</tr>";
		if ($i > 99) {
			echo "<tr><td colspan='10'><h2><b>Il n'y a que les 100 premiers r&eacute;sultats d'affich&eacute;s, ";
			echo "affinez votre recherche si vous voulez...</b></h2></td></tr>";
			break;
		}
	}
	echo "</table>";
}

##################################
# Affiche le résultat d'une recherche sur le chargement
# sur le chargement
#################################
function afficherRechercheChargementResultat($chargement_id_troll, $chargement_1, $chargement_2, $chargement_3)
{
	
	$lesChargements = selectDbChargement($chargement_id_troll, $chargement_1, $chargement_2, $chargement_3);
	$nbChargements = count($lesChargements);

	echo "<table class='list'>";
	echo "<h2>Résultat de la recherche sur les chargements de troll(s) ou gowap(s), ou dans les tanières</h2>";
	echo "<tr class='titre-tableau' style='background-color:#6f7ca2;'>";
	echo "<td>Nom</td>";
	echo "<td>Id Gowap</td>";
	echo "<td>Id Tanière</td>";
	echo "<td>Sur le troll</td>";
	echo "<td>Sur le gowap</td>";
	echo "<td>Dans une tanière</td>";

	for($i=1;$i<=$nbChargements;$i++) {
		$res = $lesChargements[$i];

		echo "<tr class=\"item-impair\" onmouseover=\"this.className='item-mouseover'\"";
		echo "onmouseout=\"this.className='item-impair'\">";
		
		$lien = "href='$page?troll=$res[id_troll]'";
		echo "<td><a $lien>$res[nom_troll]</a></td>";
		
		$lien = "href='$page?gowap=$res[id_gowap]'";
		echo "<td><a $lien>$res[id_gowap]</a></td>";

		$lien = "href='$page?taniere=$res[id_taniere]'";
		echo "<td><a $lien>$res[id_taniere]</a></td>";

		if ($res[chargement_gowap] != "")
			$info_gowap ='oui';

		if ($res[chargement_troll] != "")
			$info_troll ='oui';
			
		if ($res[chargement_taniere] != "")
			$info_taniere ='oui';

		echo "<td>$info_troll</a></td>";
		echo "<td>$info_gowap</a></td>";
		echo "<td>$info_taniere</a></td>";

		$info_troll ='';
		$info_gowap ='';
		$info_taniere ='';
		echo "</tr>";
	}
	echo "</table>";
}

#############################
# Affiche la liste des trolls RM dans une listbox 
#############################
function afficher_listbox_troll_rm_select($val_to_select="", $no_not="", $not_defaut=-1, $display=true)
{

	$lesTrolls = selectDbTrolls("",ID_GUILDE);
	$nbTrolls = count($lesTrolls);

	if ($no_not == "") $text = "<option value='$not_defaut'></option>";
	for($i=1;$i<=$nbTrolls;$i++) {
		$res = $lesTrolls[$i];
		$selected = "";
		if ($val_to_select == $res[id_troll])
			$selected = "selected";
		$text .="<option value='$res[id_troll]' $selected>".stripslashes($res[nom_troll]);
		$text .= " ($res[id_troll])</option>";
	}

	if ($display)
		echo $text;
	else
		return $text;
}


#########################
# Affiche une listbox 
#	formulaire_listbox("limite",1,100,1,$limite,"moinsplus","4");
#########################
function formulaire_listbox($name,$val_init,$val_max,$increment,$val_to_select,$sens="moinsplus", $default2nul="no",$nul=true,$display = true, $option="")
{

  $ret = "<select name='$name' $option>";

  for ($i=$val_init; $i<=$val_max; $i=$i+$increment) {
    // On regarde si l'on met les nombres positif avant ou après
    if ($sens == "moinsplus")
      $val = $i;
    else
      $val = -$i;

    $selected="";
    if ($val_to_select == $val) $selected="selected";
    $ret .= "<option $selected value='$val'>$val</option>";
  }
  $selected="";
  if ($default2nul == "yes")
		if ($val_to_select == "") $selected="selected";
		if ($nul) $ret .= "<option $selected value=''></option>";

  $ret .= "</select>";

	if ( $display )
		echo $ret;
	else
		return $ret;
}

###############################
# Affiche un formulaire de choix de trolls RM
# avec une textbox password pour changer le passe
# du troll.
###############################
function afficherChoixTrollsChangePassword($change_password)
{

	isControlAdministrateur("yes"); // Control strict de l'administrateur

	echo "<h2>Changement de mot de passe</h2>";

	if ($change_password != 'next') {

		echo "Un troll Relais&Mago n'arrive plus à se connecter sur les outils ?<br>";
		echo "Choississez un troll dans la liste, remplissez le champ <b>mot de passe md5</b>";
		echo "et cliquez sur le bouton <b>Suivant</b><br><br>";
		echo "Vous pouvez calculer le md5 <a href='md5.php'>ici</a><br><br>";

		echo "<form action='engine_view.php'>";
		echo "<input type='hidden' name='change_password' value='next'>";
		echo "Choisissez un troll : <br>";

		echo "<select name='id_troll'>";
		afficher_listbox_troll_rm_select();
		echo "</select><br><br>";
		echo "Nouveau mot de passe MD5 : <br>";
		echo "<input type='text' name='pass_troll' value='' size='32' maxlength='32'><br><br>";

		echo "<input type='submit' value='Suivant'>";
		echo "</form>";
		echo "<br>";
		echo "Le clic sur le bouton <b>Suivant</b> vous demandera ensuite une confirmation";

	} else {

		if ($_REQUEST[id_troll] == '-1')
			die("<font color=red>ERREUR : Vous devez choisir un troll</font>");	

		if (strlen($_REQUEST[pass_troll]) != 32)
			die("<font color=red>ERREUR Le mot de passe md5 que vous avez rentré ne fait pas 32 caractères</font>");	


		$lesTrolls = selectDbTrolls($_REQUEST[id_troll]);
		$troll = $lesTrolls[1];
		
		echo "Vous allez maintenant changer le mot de passe du troll";
		echo " $troll[nom_troll] ($troll[id_troll])<br><br>";
		echo " Ancien mot de passe MD5 : $troll[pass_troll]<br>";
		echo " Nouveau mot de passe MD5 : $_REQUEST[pass_troll]<br>";
		
		echo "<form action='engine_view.php'>";
		echo "<input type='hidden' name='change_password' value='edit'>";
		echo "<input type='hidden' name='id_troll' value='$_REQUEST[id_troll]'><br><br>";
		echo "<input type='hidden' name='nom_troll' value='$troll[nom_troll]'><br><br>";
		echo "<input type='hidden' name='pass_troll' value='$_REQUEST[pass_troll]'><br><br>";
		echo "<input type='submit' value='Valider'>";
		echo "</form>";
	}
}

###################################
# Controle de l'administrateur avec la variable de session
# Si strict est != "", alors le controle est strict et remvoit sur Disney 
# si c'est pas un administrateur
###################################
function isControlAdministrateur($control_strict="")
{
	$flag = false;

	if ($_SESSION['admin'] == "authenticated") {
		$flag=true;
	}

	if (($flag==false) && ($control_strict != "" )) {
		die(" C'est là que tu veux aller => <a href='http://www.google.fr/search?q=DisneyLand'>oui, là !</a>");
		exit;
	}
	return $flag;
}

function plus($valeur_champ)
{
	if ($valeur_champ >=0)
		return "+";
	else
		return "";
}

#####################################
# Regarde si le troll connecté est membre du groupe conseil ou diplomate
#####################################
function isConseilOrDiplo()
{
	$isAuthorized = false;
	$lesTrolls = selectDbTrolls($_SESSION[AuthTroll],"diplo_conseil");
	$nbTrolls = count($lesTrolls);
	if ($nbTrolls == 1)
		$isAuthorized = true;
	return $isAuthorized;
}

######################################
# Affiche une distinction
######################################
function afficherFicheDistinction($id_distinction)
{

	isControlAdministrateur("yes"); // Control strict de l'administrateur

	$page = "engine_view.php";

	if ($id_distinction == "new") {
		//$id_troll_gowap = $id_troll_gowap; => pour info
		$nom_image_distinction = "images/avatars/aucune.png";
		$nom_image_titre_distinction = "images/avatars/aucune.png";
		$info = "Ajouter";
	} else {
		$lesDistinctions = selectDbDistinctions($id_distinction);
		$res = $lesDistinctions[1];

		$id_distinction = $res[id_distinction];
		$nom_distinction = stripslashes($res[nom_distinction]);
		$nom_image_distinction = $res[nom_image_distinction];
		$nom_image_titre_distinction = $res[nom_image_titre_distinction];
		$info = "Modifier";
	}
	
	echo "<form action='$page?distinction=edit' method='post'>";
	echo "<input type='hidden' name='act' value='$id_distinction'>";
	echo "<input type='hidden' name='id_distinction' value='$id_distinction'>";

	echo "<table style='background-color:#6f7ca2;' class='fiche'>";
	echo "<tr><td>Nom</td>";
	echo "<td><input type='textbox' value=\"$nom_distinction\" name='nom_distinction' size='50'</td></tr>";	
	echo "<tr><td valign='bottom'>Image</td>";

	echo "<td valign='bottom'><img src='$nom_image_distinction'><br>";
	echo "<input type='textbox' value='$nom_image_distinction' name='nom_image_distinction' size='50'></td></tr>";	

	echo "<tr><td valign='bottom'>Image Titre</td>";
	echo "<td valign='bottom'><img src='$nom_image_titre_distinction'><br>";
	echo "<input type='textbox' value='$nom_image_titre_distinction' name='nom_image_titre_distinction' size='50'></td></tr>";
	echo "</table>";

	// Un bouton modifier pour l'administrateur
	if (isControlAdministrateur()) {
		echo "<input type='submit' name='submit' value='$info'>&nbsp;";
		if ($id_gowap != "new") {
			echo "<input type='button' name='suppression' value='Supprimer' class='mh_form_submit'";
			echo " onClick=\"javascript=";
			echo " k=confirm('Confirmer la suppression de la distinction ?');";
			echo " if (k==true) {document.location.href='$page?distinction=del&id_distinction=$id_distinction';}";
			echo "\">&nbsp;";
		}
	}	
	echo "<input type='Button' value='Retour à la liste'";
	echo " onClick='JavaScript=document.location.href=\"$page?distinction=liste\">";
	echo "</form>";
}

#####################################
# affiche la liste des distinctions
#####################################
function afficherListeDistinctions()
{	

	$lesDistinctions = selectDbDistinctions();
	$nbDistinctions = count($lesDistinctions);
	
	echo "<br><br>";
	echo "<a href='engine_view.php?distinction=new'>Ajouter une distinction</a>";
	echo "<br><br>";

	echo "<table style='background-color:#6f7ca2;' class='fiche'>";
	echo "<tr><th>Nom</th>";
	echo "<th>Image</th>";
	echo "<th>Image Titre</th>";
	echo "<th>Editer</th>";
	echo "</tr>";

	for($i=1;$i<=$nbDistinctions;$i++) {
		$res = $lesDistinctions[$i];
		
		$lien="engine_view.php?distinction=$res[id_distinction]";

		echo "<tr><td valign='bottom'>".stripslashes($res[nom_distinction]). "</td>";
		echo "<td valign='bottom'><img src=\"$res[nom_image_distinction]\"><br>";
		echo "$res[nom_image_distinction]</td>";
		echo "<td valign='bottom'><img src=\"$res[nom_image_titre_distinction]\"><br>";
		echo "$res[nom_image_titre_distinction]</td>";
		echo "<td valign='bottom'><a href='$lien'>Editer</td>";
		echo "</tr>";
	}
	echo "</table>";
}

#############################
# Affiche la liste des distinctions RM dans une listbox 
#############################
function afficher_listbox_rm_distinction_select($val_to_select="")
{

	$lesDistinctions = selectDbDistinctions();
	$nbDistinctions = count($lesDistinctions);

	for($i=1;$i<=$nbDistinctions;$i++) {
		$res = $lesDistinctions[$i];
		$nom_distinction = html_entity_decode($res[nom_distinction]);
    if(strlen($nom_distinction)>=15) {
			$nom_distinction = substr($nom_distinction,0,15)."...";
		}
		$selected = "";
		if ($val_to_select == $res[id_distinction])
			$selected = "selected";
		echo "<option value='$res[id_distinction]' $selected>".stripslashes($nom_distinction)."</option>";
	}
}
#####################################
# affiche la liste des avatars
#####################################
function afficherAvatarListe()
{	

	$lesTrolls = selectDbTrolls("",ID_GUILDE);
	$nbTrolls = count($lesTrolls);
	
	echo "<br><br>";
	echo "<table style='background-color:#6f7ca2;' class='fiche'>";
	echo "<tr><th>Avatar actuel sur pipeshow</th>";
	echo "<th>Nom</th>";
	echo "<th>Nom Avatar</th>";
	echo "<th>Niveau</th>";
	echo "<th>Rang</th>";
	echo "<th></th></tr>";

	for($i=1;$i<=$nbTrolls;$i++) {
		$res = $lesTrolls[$i];
		
		$img = "http://www.pipeshow.net/RM/avatars/complets/".$res[nom_image_troll]."_avatar.gif";

		echo "<tr><td><img src='$img'></td>";
		echo "<td>".stripslashes($res[nom_troll]). "($res[id_troll])";
	  afficherLien("troll","fiche",$res[id_troll]);	
	  afficherLien("troll","mh_profil",$res[id_troll]);	
		echo "</td>";
		echo "<td>";
		if ($res[nom_image_troll] == "")
			echo "<b><font color='red'>Nom image non Renseigné RG</font></b>";
		else
			echo $res[nom_image_troll];
		echo "<td>";

		echo "<td>$res[niveau_troll]</td>";
		echo "<td>$res[nom_rang_troll]</td>";
		echo "<td><img src='images/avatars/cache/$res[nom_image_troll]_avatar.gif'><br><a href='engine_view.php?avatar=$res[id_troll]'>Générer</a></td>";
		echo "</tr>";

	}
	echo "</table>";

}

#####################################
# Génération d'un avatar
#####################################
function generateAvatar($id_avatar)
{
	echo "<h2> Génération </h2>";
	
	$lesTrolls = selectDbTrolls($id_avatar);
	$nbTrolls = count($lesTrolls);
	$res = $lesTrolls[1];

	echo "<div style='background-color: #a9b1d3;'><img src='generate_avatar.php?id=$id_avatar'></div>";
	echo " il faut sauvegarder cette image en ".$res[nom_image_troll]."_avatar.gif";
}

######################################
# Affiche la fiche d'un composant prioritaire
######################################
function afficherFicheComposant($id_composant)
{
	global $MUNDIDEY;

	$page = "engine_view.php";

	if ($id_composant== "new") {
		$info = "Ajouter";
		$nom_composant="";
		$commentaire_composant = "";
		$id_race_composant = "";
		$priorite_composant = "";
	} else {
		$lesComposants = selectDbComposants($id_composant);
		$res = $lesComposants[1];
		$id_composant = $res[id_composant];
		$nom_composant = stripslashes($res[nom_composant]);
		$id_race_composant = stripslashes($res[id_race_composant]); // c'est une chaine !
		$priorite_composant = $res[priorite_composant];
		$commentaire_composant = html_entity_decode(stripslashes($res[commentaire_composant]));
		$info = "Modifier";
	}
	
	echo "<form action='$page?composant=edit' method='post' name='formulaire_compo'>";
	echo "<input type='hidden' name='act' value='$id_composant'>";
	echo "<input type='hidden' name='id_composant' value='$id_composant'>";

	echo "<table style='background-color:#6f7ca2;' class='fiche'>";
	echo "<tr><td>Nom</td>";
	echo "<td><input type='textbox' value=\"".$nom_composant."\" name='nom_composant' size='50'</td></tr>";	

	echo "<tr><td>Race</td>";
	echo "<td>";
	echo "<select name='id_race_composant'>";
	afficher_listbox_race_bestiaire_select($id_race_composant);
	echo "</select>";
	echo "</td></tr>";	

	echo "<tr><td>Priorité</td>";
	echo "<td>";
	echo "<select name='priorite_composant'>";
	afficher_listbox_select("aucune", $priorite_composant,"Hein ?");
	afficher_listbox_select("tresbasse", $priorite_composant,"Pour l'an prochain");
	afficher_listbox_select("basse", $priorite_composant,"Recherché");
	afficher_listbox_select("moyenne", $priorite_composant,"Urgent");
	afficher_listbox_select("haute", $priorite_composant,"Super urgent");
	afficher_listbox_select("superhaute", $priorite_composant,"Pour hier");
	echo "</select>";
	echo "</td></tr>";	

	echo "<tr><td>Commentaire</td>";
	echo "<td><textarea name='commentaire_composant'cols='50' rows='10'>";
	echo $commentaire_composant;	
	echo "</textarea></td></tr>";	

	echo "</table>";
	
	$res = selectDbVtt($_SESSION['AuthTroll'], "Ecriture Magique");

	// Un bouton modifier pour l'administrateur
	// >10 c'est normal !! 
	if (isControlAdministrateur() || (count($res)>10)) {
		echo "<input type='submit' name='submit' value='$info' class='mh_form_submit'>&nbsp;";
		if ($id_composant != "new") {
			echo "<input type='button' name='suppression' value='Supprimer' class='mh_form_submit'";
			echo " onClick=\"javascript=";
			echo " k=confirm('Confirmer la suppression du composant prioritaire ?');";
			echo " if (k==true) {document.location.href='$page?composant=del&id_composant=$id_composant';}";
			echo "\">&nbsp;";
		}
	}	
	echo "<input type='Button' value='Retour à la liste'";
	echo " onClick='JavaScript=document.location.href=\"$page?composant=liste\"' class='mh_form_submit'>";
	echo "</form>";
}

#####################################
# affiche la liste des composants prioritaire
#####################################
function afficherListeComposants()
{	

	$lesComposants = selectDbComposants();
	$nbComposants = count($lesComposants);
	
	?><br>
   <table  border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'width='100%'>
     <tr class='mh_tdpage'><td >
    	<table  border='0' cellpadding='0' cellspacing='1' width='100%' align='center'>
     	 <tr class='mh_tdtitre'>
        <td align='center'>
					<h2>Liste des Composants prioritaires	</h2>
					<? afficherDateTroll(); ?><br>
					<input type='button' onClick='Javascript:document.location.href="engine_view.php?composant=new"' value="Ajouter un composant prioritaire" class='mh_form_submit'><br><br>
				</td>
				</tr>
     	 <tr class='mh_tdpage'>

<?
	echo "<table width='100%'>";
	echo "<tr class='mh_tdtitre'><td>Nom</td>";
	echo "<td>Race</td>";
	echo "<td>Priorité</td>";
	echo "<td>Commentaire</td>";
	echo "<td>Editer</td>";
	echo "</tr>";

	for($i=1;$i<=$nbComposants;$i++) {
		$res = $lesComposants[$i];
		
		$lien="engine_view.php?composant=$res[id_composant]";

		echo "<tr><td>".stripslashes($res['nom_composant']). "</td>";
		echo "<td>".stripslashes($res['id_race_composant']). "</td>";
		echo "<td>".$res['priorite_composant']."</td>";
		echo "<td>".stripslashes($res['commentaire_composant'])."</td>";
		echo "<td><a href='$lien'>Editer</td>";
		echo "</tr>";
	}
	echo "</table>";
	echo "</td></tr></table>";
	echo "</td></tr></table>";
}

#############################
# Affiche la liste des races du bestiaire
#############################
function afficher_listbox_race_bestiaire_select($val_to_select="",$blank=false)
{
	$lesRaces = selectDbBestiareRaces();
	$nbRaces= count($lesRaces);
	
	if ($blank)
		echo "<option value=''></option>";

	for($i=1;$i<=$nbRaces;$i++) {
		$res = $lesRaces[$i];
		$nom_race = stripslashes($res['nom_race']);
		$nom_famille = substr(stripslashes($res['famille_race']),0,15);

		$selected = "";
		if ($val_to_select == $nom_race)
			$selected = "selected";
		echo "<option value=\"$nom_race\" $selected>$nom_race ($nom_famille)</option>";
	}
}

#############################
# Affiche la liste des familles du bestiaire
#############################
function afficher_listbox_famille_bestiaire_select($val_to_select="",$blank=false)
{
	$lesFamilles = selectDbBestiareFamilles();
	$nbFamilles = count($lesFamilles);
	
	if ($blank)
		echo "<option value=''></option>";

	for($i=1;$i<=$nbFamilles;$i++) {
		$res = $lesFamilles[$i];
		$nom_famille = substr(stripslashes($res['nom_famille']),0,15);

		$selected = "";
		if ($val_to_select == $nom_famille)
			$selected = "selected";
		echo "<option value=\"$nom_famille\" $selected>$nom_famille</option>";
	}
}
?>
