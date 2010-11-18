<?

#######################################
# Engine des baronnies
#######################################
function engine_baronnie($isAdmin,$id)
{

	// Si l'on vient de remplir le formulaire d'ajout ou d"édition 
	// d'une baronnie, on met à jour la bdd
	if ($id == "edit")
		editDbBaronnie(); // editDbBaronnie ne prend pas de parametre
	
	// On affiche le formulaire si l'on connait l'id de la baronnie
	// ou que l'on veut en créer une nouvelle
	elseif ( (is_numeric($id)) || ($id == "new") ) {
		afficherFicheBaronnie($id);
	
	// Sinon, on affiche la liste des baronnies afin de donner un 
	// lien pour les éditer
	}else {
		if ($isAdmin) $button = "<a href='engine_view.php?baronnie=new'>Ajouter une baronnie</a>";
		afficher_titre_tableau("Les Baronnies ".RELAISMAGO,$button);
		afficherListeBaronnies();
	}
}

######################################
# Engine des guildes
#####################################
function engine_guilde($isAdmin,$id)
{
	afficher_titre_tableau("Les Guildes");
	
	// Si l'on vient de remplir le formulaire d'ajout ou d"édition 
	// d'une guilde, on met à jour la bdd
	if (($id == "edit") && ( ($isAdmin) || isConseilOrDiplo() ))
		editDbGuilde(); // editDbGuilde ne prend pas de parametre
	
	// On affiche le formulaire si l'on connait l'id de la guilde 
	// => c'est que l'on veut la fiche
	elseif (is_numeric($id)) {
		afficherFicheGuilde($id);
	
	// Sinon, on affiche la liste des baronnies afin de donner un 
	// lien pour les éditer
	}else {
		// l'ajout des guildes dans la bdd se fait avec update_troll.php
		// Donc on fait pas de liens "ajouter une guilde"
		// $id peut valoir sort_diplomatie pour trier par diplomatie
		afficherListeGuildes($id);
	}
}

###############################
# Engine des trolls
###############################
function engine_troll($isAdmin,$id, $troll_type_action, $troll_action)
{
	afficher_titre_tableau("Les Trolls");

	if ($troll_type_action == "grief"){
		if (($troll_action == "new") && ($isAdmin)) {
			afficherFicheGrief($id,"new");
		} elseif (($troll_action == "editdb") && ($isAdmin)) {
			editDbGrief (); // editDbGrief ne prend pas de parametre
		} elseif (($troll_action == "del") && ($isAdmin)) {
			deleteDbGrief(); // deleteDbGrief ne prend pas de parametre
		} elseif (is_numeric($troll_action)) {
			afficherFicheGrief($id,$troll_action);
		}

	} elseif ($troll_type_action == "venge") {
		if (($troll_action == "new") && ($isAdmin)) {
			afficherFicheVengeance($id,"new");
		} elseif (($troll_action == "editdb") && ($isAdmin)) {
			editDbVengeance(); // editDbVengeance ne prend pas de parametre
		} elseif (($troll_action == "del") && ($isAdmin)) {
			deleteDbVengeance(); // deleteDbVengeance ne prend pas de parametre
		} elseif (is_numeric($troll_action)) {
			afficherFicheVengeance($id,$troll_action);
		}

	} elseif ($troll_type_action == "equipement") {
		if ($troll_action == "editdb") {
			editDbEquipement(); // editDbEquipement ne prend pas de parametre
		} elseif ($troll_action == "voir") {
			afficherFicheEquipement($id);
		}

	// Si l'on vient de remplir le formulaire d'ajout ou d'édition 
	// d'un Troll, on met à jour la bdd
	} elseif (($id == "edit") && ($isAdmin)) {
		 editDbTroll(); // editDbTroll ne prend pas de parametre
	
	// On affiche le formulaire si l'on connait l'id du Troll
	// => c'est que l'on veut la fiche
	} elseif (is_numeric($id)) {
		afficherFicheTroll($id);
	
	// Sinon, on affiche la liste des baronnies afin de donner un 
	// lien pour les éditer
	} else {
		// l'ajout des Trolls dans la bdd se fait avec update_troll.php
		// Donc on fait pas de liens "ajouter un troll"
		// $id peut valoir sort_tk, sort_wanted, all, guilde_diplomatie pour trier 
		afficherListeTrolls($id);
	}
}

######################################
# Engine des gowaps
#####################################
function engine_gowap($isAdmin,$id)
{
	// exceptionnel de mettre cela ici, c'est pour aller vite pour ce soir
	$id_troll_gowap = $_REQUEST[id_troll_gowap];
	$id_gowap = $_REQUEST[id_gowap];

	// Si l'on vient de remplir le formulaire d'ajout ou d"édition 
	// d'un gowap, on met à jour la bdd
	if ($id == "edit") {
		editDbGowap(); // editDbGowap ne prend pas de parametre
		
 	} elseif ($id == "del") {
		afficher_titre_tableau("Suppression d'un Gowap");
		deleteDbGowap(); // deleteDbGowap ne prend pas de parametre
		
	} elseif ($id == "new") {
		afficher_titre_tableau("Ajout d'un Gowap");
		afficherFicheGowap($id,$id_troll_gowap);

	} elseif ($id == "liste") {
		afficher_titre_tableau("Le Cheptel ".RELAISMAGO);
		afficherCheptelGowaps($id,$id_troll_gowap);
	
	// On affiche le formulaire si l'on connait l'id du gowap
	// => c'est que l'on veut la fiche
	} elseif (is_numeric($id)) {
		afficher_titre_tableau("Fiche d'un Gowap ".RELAISMAGO);
		afficherFicheGowap($id);
	}
}

######################################
# Engine des Tanieres
#####################################
function engine_taniere($isAdmin,$id)
{
	
	// exceptionnel de mettre cela ici, c'est pour aller vite pour ce soir
	$id_troll_taniere = $_REQUEST[id_troll_taniere];
	$id_taniere = $_REQUEST[id_taniere];

	// Si l'on vient de remplir le formulaire d'ajout ou d"édition 
	// d'une taniere, on met à jour la bdd
	if ($id == "edit") {
		editDbTaniere(); // editDbTaniere ne prend pas de parametre
		
	} elseif ($id == "del") {
		afficher_titre_tableau("Supprimer une tanière");
		deleteDbTaniere(); // deleteDbTaniere ne prend pas de parametre
		
	} elseif ($id == "new") {
		afficher_titre_tableau("Ajouter une tanière");
		afficherFicheTaniere($id,$id_troll_taniere);

	} elseif ($id == "cadastre"){
		afficher_titre_tableau("Cadastre ".RELAISMAGO);
		afficherCadastreTanieres();
	}
	
	// On affiche le formulaire si l'on connait l'id de la taniere
	// => c'est que l'on veut la fiche
	elseif (is_numeric($id)) {
		afficher_titre_tableau("Fiche d'une tanière ".RELAISMAGO);
		afficherFicheTaniere($id);
	}
}


function engine_recherche($recherche,$display_header=false)
{
	if ($recherche == 'trolls') {
		if ($display_header) afficherRechercheNouvelle();
		afficherRechercheTrolls($display_header);
	} elseif ($recherche == 'monstres') {
		if ($display_header) afficherRechercheNouvelle();
		afficherRechercheMonstres($display_header);
	} elseif ($recherche == 'lieux') {
		if ($display_header) afficherRechercheNouvelle();
		afficherRechercheLieux($display_header);
	} elseif ($recherche == 'chargement') {
		if ($display_header) afficherRechercheNouvelle();
		afficherRechercheChargement();
	} elseif ($recherche == 'champignons') {
		if ($display_header) afficherRechercheNouvelle();
		afficherRechercheChampignons();
	} elseif ($recherche == 'tresors') {
		if ($display_header) afficherRechercheNouvelle();
		afficherRechercheTresors();
	} elseif ($recherche == 'new') {
		afficherRechercheNouvelle();
	}
}

############################
# Permet de change le mot de passe d'un troll
############################
function engine_bdd($isAdmin,$bdd)
{
	if ( (md5($_REQUEST['pass']) == MD5_PASS_EXTERNE) || 
			 (isControlAdministrateur())
		 )
	{ 
		// accès autorisé
		$isAdmin = true;
	} else {
		die('Accès refusé');
	}

	$fichier = "vues/dump.sql";

	if (($bdd == "dumpvue") && ($isAdmin)) {
		
		$cmd = "rm -f $fichier ; rm -f ".$fichier.".gz ;";
		$cmd .= "mysqldump -u ".$GLOBALS['base_vue']."  --password=\"".$GLOBALS['pass_vue']."\" ". $GLOBALS['base_vue'];
		$cmd .= " > $fichier && gzip $fichier";
		//passthru($cmd);
		echo "CMD=".exec($cmd);
		echo "<br><br>Vous pouvez récupérer le dump à l'adresse ci-dessous dans 1 min max.<br> ";
		echo "<b>Cliquez sur le bouton droit et faites <i>enregister-sous</i> svp </b>: ";
		echo " : <a href='/$fichier.gz'>$fichier.gz</a><br><br>";
		echo "<font color=red>Une fois récupéré, veuillez le supprimer à l'aide de ce lien </font> : ";
		echo "<a href='engine_view.php?bdd=deldump'>Suppression</a>";
		echo "<h4>C'est très important de le supprimer !</h4>";
		
	} else if (($bdd == "deldump") && ($isAdmin)) {
		echo "Suppression du dump en cours...<br>";
		$ret = unlink($fichier.".gz");
		if ($ret)
			echo "Suppression ok. Merci.<br>";
		elseif (!$ret) {
			echo "<font color='red'>Erreur dans la suppression du fichier temporaire.";
			echo " Veuillez prévenir Bodéga (49145)en MP en copiant/collant le warning ci-dessus.</font><br>";
		}
	} else {
		echo "<br> <a href='engine_view.php?bdd=dumpvue'>[ ";
		echo "Dump de la base générale (vue2drm) ]</a> <br>";
	}
}

function engine_avatar($isAdmin,$avatar)
{
	isControlAdministrateur("yes"); // Control strict de l'administrateur	

	echo "<br><br>";

	if (($avatar == "liste") && ($isAdmin)) {
		afficherAvatarListe();	
	} else if (is_numeric($avatar) && ($isAdmin)) {
		generateAvatar($avatar);
	}
}

######################################
# Engine des Distinctions
#####################################
function engine_distinction($isAdmin,$id)
{

	// Si l'on vient de remplir le formulaire d'ajout ou d"édition 
	// d'une distinction, on met à jour la bdd
	if ($id == "edit") {
		editDbDistinction(); // editDbDistinction ne prend pas de parametre
		
 	} elseif ($id == "del") {
		afficher_titre_tableau("Suppression d'une Distinction");
		deleteDbDistinction(); // deleteDbDistinction ne prend pas de parametre
		
	} elseif ($id == "new") {
		afficher_titre_tableau("Ajout d'une Distinction");
		afficherFicheDistinction($id);

	} elseif ($id == "liste") {
		afficher_titre_tableau("Les distinctions ".RELAISMAGO);
		afficherListeDistinctions($id);
	
	// => c'est que l'on veut la fiche
	} elseif (is_numeric($id)) {
		afficher_titre_tableau("Modification d'une Distinction ".RELAISMAGO);
		afficherFicheDistinction($id);
	}
}

######################################
# Engine des Composants
#####################################
function engine_composant($isAdmin,$id)
{

	// Si l'on vient de remplir le formulaire d'ajout ou d"édition 
	// d'un composant, on met à jour la bdd
	if ($id == "edit") {
		editDbComposant(); // editDbDistinction ne prend pas de parametre
		
 	} elseif ($id == "del") {
		afficher_titre_tableau("Suppression d'un Composant Prioritaire ".RELAISMAGO);
		deleteDbComposant(); // deleteDbComposant ne prend pas de parametre
		
	} elseif ($id == "new") {
		afficher_titre_tableau("Ajout d'un Composant Prioritaire ".RELAISMAGO);
		afficherFicheComposant($id);

	} elseif ($id == "liste") {
		afficher_titre_tableau("Les composants prioritaires pour les scribes ".RELAISMAGO);
		afficherListeComposants($id);
	
	// => c'est que l'on veut la fiche
	} elseif (is_numeric($id)) {
		afficher_titre_tableau("Modification d'un Composant Prioritaire ".RELAISMAGO);
		afficherFicheComposant($id);
	}
}

function engine_stats_vue_publique($isAdmin) 
{
	isControlAdministrateur("yes"); // Control strict de l'administrateur	

	afficher_titre_tableau("Log d'utilisation de la vue publique");

	if (file_exists("vues/list.txt")) {
		$tmpfile=fopen ("vues/list.txt","r");
		
		while ( $line = fgets($tmpfile, 1024) ) {
			$i++;
			echo $i." - ".$line;
			preg_match("/(.*):(.*)/",$line,$parts);
			echo gethostbyaddr($parts[2])."<br>";
		}
		fclose($tmpfile);

	} else {
		echo "Erreur, le fichier vues/list.txt n'existe pas";
	}
}

function engine_stats_refresh_auto($isAdmin) 
{
	isControlAdministrateur("yes"); // Control strict de l'administrateur	

	afficher_titre_tableau("Log d'utilisation des refresh auto");

	if (file_exists("vues/list_refresh_auto.txt")) {
		$tmpfile=fopen ("vues/list_refresh_auto.txt","r");
		
		while ( $line = fgets($tmpfile, 1024) ) {
			$i++;
			echo $line."<br>";
		}
		fclose($tmpfile);

	} else {
		echo "Erreur, le fichier vues/list_refresh_auto.txt n'existe pas";
	}

}

function engine_stats_connection($isAdmin) 
{
	isControlAdministrateur("yes"); // Control strict de l'administrateur	

	afficher_titre_tableau("Contrôle des visites sur les outils","Mis en place le 9 mai 2005");
	
	$lesTrolls = selectDbTrolls("","date_last_visit");

	?><table class='mh_tdborder' width='70%' align='center'>
	  <tr class='mh_tdpage'><td>
   <table width="100%" border="0" cellpadding="3" cellspacing="3">
	 <tr class='mh_tdtitre'><td>Troll</td><td>Dernière date de visite du troll sur les outils</td><td>guilde</td><td>Pnj</td></tr>
	<?

	for ($i = 1; $i<=count($lesTrolls); $i++) {
		$troll = $lesTrolls[$i];
		echo "<tr><td>$troll[nom_troll] n° $troll[id_troll]</td>";
		echo "<td> $troll[date_last_visit_troll]</td>";
		echo "<td> $troll[nom_guilde]</td>";
		echo "<td> $troll[is_pnj_troll]</td></tr>";
	}
	?>
	</table>
	</td></tr>
		</table>
	<?
}

function engine_list_passe_error($isAdmin) 
{
	isControlAdministrateur("yes"); // Control strict de l'administrateur	

	afficher_titre_tableau("Erreur mot de passe");

	if (file_exists("vues/list_mdp_error.txt")) {
		$tmpfile=fopen ("vues/list_mdp_error.txt","r");
		
		while ( $line = fgets($tmpfile, 1024) ) {
			$i++;
			echo $line;
			preg_match("/(.*) (\d+)/",$line,$parts);
  		$lesTrolls = selectDbTrolls($parts[2],"");
		  $res = $lesTrolls[1];
			echo " ".$res['nom_troll']."<br>";
		}
		fclose($tmpfile);

	} else {
		echo "Erreur, le fichier vues/list_mdp_error.txt n'existe pas";
	}
}

function engine_list_manual_refresh($isAdmin) 
{
	global $db_vue_rm;

	isControlAdministrateur("yes"); // Control strict de l'administrateur	

	afficher_titre_tableau("Dernier Refresh Manuels");
	$sql = "SELECT nom_troll, id_troll, date_last_refresh_manual_troll FROM trolls";
	$sql .= " WHERE guilde_troll = ".ID_GUILDE;
	$sql .= " ORDER BY date_last_refresh_manual_troll";

  $result=mysql_query($sql, $db_vue_rm);
  echo mysql_error();

	?><table class='mh_tdborder' width='70%' align='center'>
	  <tr class='mh_tdpage'><td>
   <table width="100%" border="0" cellpadding="3" cellspacing="3">
	 <tr class='mh_tdtitre'><td>Troll</td><td>Date de dernier refresh manuel par le troll lui même</td></tr>
	<?
  if (mysql_num_rows($result)>0) {
    while ($troll = mysql_fetch_array($result)) {
			?>
	
			<?
				echo "<tr><td>$troll[nom_troll] n° $troll[id_troll]</td>";
				echo "<td> $troll[date_last_refresh_manual_troll]</td></tr>";
			?>
		<?
		}
	}
	?>
	</table>
	</td></tr>
		</table><?

}

############################
# Permet de change le mot de passe d'un troll
############################
function engine_change_password($isAdmin,$change_password)
{

	if (($change_password == "edit") && ($isAdmin))
		editDbPassword(); // editDbPassword ne prend pas de parametre
	// On affiche le formulaire de choix de trolls
	elseif ($isAdmin)
		afficherChoixTrollsChangePassword($change_password);
}

function engine_info_ftp_files($isAdmin)
{

	isControlAdministrateur("yes"); // Control strict de l'administrateur	

	$mtime=filemtime("vues/Public_Trolls.txt");
	$date_fichier_trolls=date ("d/m/Y H:i", $mtime);

	$mtime=filemtime("vues/Public_Guildes.txt");
	$date_fichier_guildes=date ("d/m/Y H:i", $mtime);
	$text = "Si le fichier des trolls ou des guildes était vide, ce n'est pas indiqué ici.";
	afficher_titre_tableau("Date de mise à jour de la base avec les fichiers ftp de MH",$text);
	?>
    <table class='mh_tdborder' width='70%' align='center'>
     <tr class='mh_tdpage'><td>

   		 <table width="100%" border="0" cellpadding="3" cellspacing="3">
      	<tr>
        	<td align='center'>
				<?
				echo "Public_Trolls.txt :".$date_fichier_trolls."<br><br>";
				echo "Public_Guildes.txt : $date_fichier_guildes";
				?>
				<br>
				</td></tr>
			</table>
		</td></tr>
	</table>
	<br>
	<?
}

?>
