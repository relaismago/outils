<?


function loterie_informations($id_loterie)
{
	$loterie = new loterie($id_loterie);
	$loterie_participants = new loterie_participants($id_loterie);
	
	$text = "Loterie num&eacute;ro $id_loterie<br><br>";
	$text .= "Gain : ".$loterie->get_gain()."<br><br>";
	$text .= "Nombre de participants : ".$loterie_participants->get_nombre_participants()."<br><br>";
	$text .= "Somme &agrave; gagner : ".$loterie_participants->get_total_participe()." ";
	$text .= $loterie->get_valeur_type()." <br><br>";
	$text .= "Valeur de la mise : ".$loterie->get_valeur_participe()." ";
	$text .= $loterie->get_valeur_type()." <br><br>";
	
	$text .= "R&eacute;glement : <br> ";
	$text .= "Sortez vos boules !! Voici la Loterie de Guilde !!<br><br>
	
	Chaque semaine misez 1PX et participez &agrave; un tirage au sort qui designera le gagnant hebdomadaire du pactole !<br><br>
	
	Il vous suffit de vous inscrire &agrave; la loterie. Le tirage au sort est automatis&eacute; (Bod&eacute;ga a pil&eacute; plusieurs mains innocentes pour en tirer une substance purifi&eacute;e dont il s'est servit pour coder ce magnifique outil) et &agrave; chaque cloture des inscritions un gagnant sera d&eacute;sign&eacute;.<br><br>
	
	Le gagnant aura acc&egrave;s &agrave; une feuille des gains qui lui permettra de connaitre la liste de ses d&eacute;biteurs dont il cochera le nom au fur et &agrave; mesure du don, autorisant ces derniers &agrave; participer &agrave; la loterie suivante.<br> <br>Lobo";

	afficher_contenu_tableau($text);
}

function loterie_nouvelle_participation($id_loterie)
{
	$form .= "<form name='loterie' method='POST'>";
	$form .= "<input type='hidden' value='enregistre' name='actiondb'> ";
	$form .= "<input type='checkbox' value='oui' name='participe'> ";
	$form .= "Je veux participer &agrave; la loterie.<br><br>";
	$form .= "<input type='submit' value='valider' class='mh_form_submit'>";
	$form .= "</form>";
	afficher_contenu_tableau($form);

}

function loterie_participation_refusee()
{
	$text = "Vous ne pouvez pas participer &agrave; cette loterie. <br>";
	$text .= "Soit vous n'avez pas remis votre participation &agrave;";
	$text .= " une loterie ant&eacute;rieure, soit il y a un soucis.<br><br> ";
	$text .= " Contactez Bodega (49145) pour plus d'informations";
	afficher_contenu_tableau($text);
}

function loterie_participation_existante()
{
	afficher_contenu_tableau("Vous participez d&eacute;j&agrave; &agrave; cette loterie.");
}

function loterie_enregistre_participation($id_loterie)
{

	$loterie_participant = new loterie_participant($_SESSION[AuthTroll], $id_loterie);

	if (!$loterie_participant->insert_db()) {
		$text = "<br>Une erreur est survenue. Contactez Bodega (49145) pour plus d'informations, ";
		$text .= " en copiant/collant ce que vous voyez. ";
		afficher_contenu_tableau($text);
 	} else {
		afficher_contenu_tableau("Votre participation est enregistr&eacute;e.");
	}
}

function loterie_admin_liste()
{
	isControlAdministrateur("yes"); // Control strict de l'administrateur 

	$text = "Administration : liste des loteries.<br>";
	$text .= "<input type='button' value='Nouvelle Loterie' ";
	$text .= "class='mh_form_submit' onClick='Javascript:document.location.href=\"/loteries/loterie.php?admin=fiche";
	$text .= "&id_loterie=new\"'>";

	afficher_contenu_tableau($text);

	$loteries = new loteries();

	$list = $loteries->get_list();

	echo "<table class='mh_tdborder' align='center'>";
	echo "<tr class='mh_tdtitre'>";
	echo "<td>Date</td>";
	echo "<td>Etat</td>";
	echo "<td>Gain</td>";
	echo "<td>Total Gain</td>";
	echo "<td>Gagnant</td>";
	echo "<td>Editer</td>";
	echo "<td>Fiche Gain</td>";
	echo "</tr>";
	for ($i=1; $i<=count($list); $i++) {
		echo "<tr class='mh_tdpage'>";
		echo "<td>";
		echo $list[$i][date_creation_loterie];
		echo "</td>";
		echo "<td>";
		echo $list[$i][etat_loterie];
		echo "</td>";
		echo "<td>";
		echo stripslashes($list[$i][gain_loterie]);
		echo "</td>";
		echo "<td>";
		$loterie_participants = new loterie_participants($list[$i][id_loterie]);
		echo $loterie_participants->get_total_participe()." ";
		echo $list[$i][valeur_type_loterie]." <br><br>";
		echo "</td>";
		echo "<td>";

		if ($list[$i][etat_loterie] == 'clos') {
			//$troll = new troll($list[$i][id_gagnant_loterie]);
			echo $list[$i][nom_gagnant_loterie]." (".$list[$i][id_gagnant_loterie].")";
		}
		echo "</td>";
		echo "<td>";
		echo "<input type='button' class='mh_form_submit' value='Editer' onClick=\"";
		echo "javascript:document.location.href='/loteries/loterie.php?admin=fiche&id_loterie=".$list[$i][id_loterie]."'";
		echo "\">";
		echo "</td>";
		echo "<td>";
		echo "<input type='button' class='mh_form_submit' value='Editer' onClick=\"";
		echo "javascript:document.location.href='/loteries/loterie.php?gain=fiche&id_loterie=".$list[$i][id_loterie]."'";
		echo "\">";
		echo "</td>";
		echo "</tr>";
	}
	echo "</table>";
}

function loterie_toutes_closes()
{
	$loteries = new loteries();
		
	if (!$loteries->is_toutes_closes()) {
		$text = "Il faut que toutes les loteries pr&eacute;c&eacute;dentes soient closes";
		$text .= " pour en cr&eacute;er une nouvelle.<br><br>";

		$text .= "<input type='button' value='Retour Liste' class='mh_form_submit'";
		$text .= " onClick='Javascript:document.location.href=\"/loteries/loterie.php?admin=liste\"'>";

		afficher_contenu_tableau($text);
		die();
	}
}

function loterie_admin_fiche($id_loterie)
{
	isControlAdministrateur("yes"); // Control strict de l'administrateur 
	
	if ($id_loterie == "new") {
		$loterie = new loterie();
		$text = "Nouvelle Loterie<br><br>";
		loterie_toutes_closes(); // on regarde si toutes les loteries sont closes
		// valeur par defaut
		$gain = "Sommes des participations"; 
		$valeur_participe = "1";
		$valeur_type = "px";

	} else {
		$loterie = new loterie($id_loterie);
		$loterie_participants = new loterie_participants($id_loterie);
		$text = "Loterie num&eacute;ro $id_loterie<br><br>";
		$gain = $loterie->get_gain();
		$valeur_participe = $loterie->get_valeur_participe();
		$valeur_type = $loterie->get_valeur_type();
	}
	

	$text .= "<form method='POST' name='loterie'>";
	$text .= "<input type='hidden' value='enregistre' name='admin_post'> ";
	$text .= "<input type='hidden' value='$id_loterie' name='id_loterie'> ";
	$text .= "Gain (texte explicatif)<br>";
	$text .= "<input type='textbox' value=\"".$gain."\" name='gain'><br><br>";
	$text .= "Valeur de la participation (nombre entier)<br>";
	$text .= "<input type='textbox' value='".$valeur_participe."' name='valeur_participe'><br><br>";
	$text .= "Type de participation (px, ggs)<br>";
	$text .= "<input type='textbox' value='".$valeur_type."' name='valeur_type'><br><br>";
	
	if (is_numeric($id_loterie)) {
		$text .= "Nombre de participants : ".$loterie_participants->get_nombre_participants()."<br><br>";
		$text .= "Somme &agrave; gagner : ".$loterie_participants->get_total_participe()." ";
		$text .= $loterie->get_valeur_type()." <br><br>";
		$text .= "Etat : ".$loterie->get_etat()." ";

		switch($loterie->get_etat()) {
			case 'ouvert' :
				$text .= "<input type='button' value='Passer en-cours' class='mh_form_submit'";
				$text .= " onClick='Javascript:document.location.href=\"/loteries/loterie.php?admin=encours&id_loterie=$id_loterie\"'>";
				$text .= " <br><br>";
				$text .= "<input type='submit' value='valider' class='mh_form_submit'> ";
				break;
			case 'en_cours' :
				$text .= "<input type='button' value='Cl&ocirc;turer (d&eacute;termination du gagnant)' class='mh_form_submit'";
				$text .= " onClick='Javascript:document.location.href=\"/loteries/loterie.php?admin=cloturer&id_loterie=$id_loterie\"'>";
				break;
			case 'clos' :
				break;
			default :
				$text .= "Erreur Etat";
				break;
		}
	} else { // Nouvelle loterie
		$text .= "<input type='submit' value='Cr&eacute;er' class='mh_form_submit'> ";
	}

	$text .= "<input type='button' value='Retour Liste' class='mh_form_submit'";
	$text .= " onClick='Javascript:document.location.href=\"/loteries/loterie.php?admin=liste\"'>";


	$text .= "</form>";

	afficher_contenu_tableau($text);
}

function loterie_admin_enregistre($id_loterie)
{
	isControlAdministrateur("yes"); // Control strict de l'administrateur 
	afficher_contenu_tableau("Administration : mise &agrave; jour d'une loterie.");
	
	if ($id_loterie == "new") {
		$loterie = new loterie();
		loterie_toutes_closes();
	} else
		$loterie = new loterie($id_loterie);

	// on v&eacute;rifie que l'&eacute;tat &eacute;tait bien en_cours
	if ($loterie->get_etat() != 'ouvert')
		die('Erreur, l\&eacute;tat de la loterie n\'est pas ouvert<br>');
	
	$loterie->set_gain($_REQUEST[gain]);
	$loterie->set_valeur_participe($_REQUEST[valeur_participe]);
	$loterie->set_valeur_type($_REQUEST[valeur_type]);
	
	$loterie->write_db();
	
	$text = "Mise &agrave; jour effectu&eacute;e.<br>";
	$text .= "<input type='button' value='Retour Liste' class='mh_form_submit'";
	$text .= " onClick='Javascript:document.location.href=\"/loteries/loterie.php?admin=liste\"'>";

	afficher_contenu_tableau($text);
}

function loterie_admin_cloturer($id_loterie)
{
	isControlAdministrateur("yes"); // Control strict de l'administrateur 
	afficher_contenu_tableau("Administration : Cl&ocirc;ture d'une loterie. D&eacute;termination du gagnant");

	$loterie = new loterie($id_loterie);

	// on v&eacute;rifie que l'&eacute;tat &eacute;tait bien en_cours
	if ($loterie->get_etat() != 'en_cours') {
		afficher_contenu_tableau('Erreur, l\'&eacute;tat de la loterie n\'est pas en-cours<br>');
		die();
	}

	$id_gagnant = $loterie->calcul_gagnant();
	
	if ($id_gagnant == false) {
		afficher_contenu_tableau("Il n'y a aucun participants ! Cl&ocirc;ture impossible.<br>");
		die();	
	}
		
	$troll = new troll($id_gagnant);
	afficher_contenu_tableau("Le gagant est : ".$troll->get_nom_troll()." (".$id_gagnant.")");

	$loterie->set_etat('clos');
	$loterie->update_db();

}

function loterie_admin_encours($id_loterie)
{
	isControlAdministrateur("yes"); // Control strict de l'administrateur 
	afficher_contenu_tableau("Administration : Etat en-cours");

	$loterie = new loterie($id_loterie);
	// on v&eacute;rifie que l'&eacute;tat &eacute;tait bien ouvert

	if ($loterie->get_etat() != 'ouvert')
		die('Erreur, l\&eacute;tat de la loterie n\'est pas ouvert<br>');
	
	$loterie->set_etat('en_cours');
	$loterie->update_db();

	$text .= "Changement d'&eacute;tat effectu&eacute;<br><br>";
	$text .= "Les trolls peuvent maintenant participer &agrave; la loterie.<br><br>";
	$text .= "<input type='button' value='Retour Liste' class='mh_form_submit'";
	$text .= " onClick='Javascript:document.location.href=\"/loteries/loterie.php?admin=liste\"'>";

	afficher_contenu_tableau($text);
}


function loterie_interface_gain_liste($id_troll)
{
	$text = "Interface de gain. Liste des loteries gagn&eacute;es<br>";

	afficher_contenu_tableau($text);
	$loteries = new loteries();

	$list = $loteries->get_list_gagnee($id_troll);

	echo "<table class='mh_tdborder' align='center'>";
	echo "<tr class='mh_tdtitre'>";
	echo "<td>Date</td>";
	echo "<td>Etat</td>";
	echo "<td>Gain</td>";
	echo "<td>Total Gain</td>";
	echo "<td>Acc&egrave;s liste des remises</td>";
	echo "</tr>";
	for ($i=1; $i<=count($list); $i++) {
		echo "<tr class='mh_tdpage'>";
		echo "<td>";
		echo $list[$i][date_creation_loterie];
		echo "</td>";
		echo "<td>";
		echo $list[$i][etat_loterie];
		echo "</td>";
		echo "<td>";
		echo stripslashes($list[$i][gain_loterie]);
		echo "</td>";
		echo "<td>";
		$loterie_participants = new loterie_participants($list[$i][id_loterie]);
		echo $loterie_participants->get_total_participe()." ";
		echo $list[$i][valeur_type_loterie]." <br><br>";
		echo "</td>";
		echo "<td>";
		echo "<input type='button' class='mh_form_submit' value='Voir' onClick=\"";
		echo "javascript:document.location.href='/loteries/loterie.php?gain=fiche&id_loterie=".$list[$i][id_loterie]."'";
		echo "\">";
		echo "</td>";
		echo "</tr>";
	}
	echo "</table>";
}


function loterie_interface_gain_fiche($id_troll, $id_loterie)
{
	$loterie = new loterie($id_loterie);
	if ($_SESSION[admin] == 'authenticated' && $id_troll != "") {
	// rien ici
	} elseif ($id_troll != $loterie->get_id_gagnant() ) {
		afficher_contenu_tableau("Erreur. Vous n'&ecirc;tes pas admin, ou vous n'avez gagn&eacute; cette loterie, ou la loterie n'est pas close");
		die(' ');
	}

	$text = "Fiche de gain<br>";
	$text = "Gain : ".$loterie->get_gain()."<br>";
	$text .= "Chaque participant doit donner ";
	$text .= $loterie->get_valeur_participe()." ".$loterie->get_valeur_type().".<br>";
	afficher_contenu_tableau($text);

	$loterie_participants = new loterie_participants($id_loterie);
	$list = $loterie_participants->get_list();
	
	echo "<form name='fiche_gain' method='POST'>";
	echo "<input type='hidden' value='$id_loterie' name='gain_num_loterie'>";
	echo "<input type='hidden' value='enregistre' name='gain'>";
	echo "<table class='mh_tdborder' align='center'>";
	echo "<tr class='mh_tdtitre'>";
	echo "<td>Participant</td>";
	echo "<td>Remise effectu&eacute;e</td>";
	if ($_SESSION[admin] == 'authenticated') {
		echo "<td>Info Admin : date inscription</td>";
		echo "<td>Info Admin : date not&eacute;e remise</td>";
		echo "<td>Info Admin : ip vote</td>";
	}
	echo "<td>Remise</td>";
	echo "</tr>";
	for ($i=1; $i<=count($list); $i++) {
		echo "<tr class='mh_tdpage'>";
		echo "<td>";
		//$troll = new troll($list[$i][id_troll_loteriep]);
		echo $list[$i][nom_troll_loteriep]." (".$list[$i][id_troll_loteriep].")";
		echo "</td>";
		echo "<td>";
		if ($list[$i][date_remise_loteriep] != "")
			echo "Oui";
		else 
			echo "<b><font color='red'>Non</font></b>";
		echo "</td>";
		if ($_SESSION[admin] == 'authenticated') {
			echo "<td>";
			echo $list[$i][date_loteriep];
			echo "</td>";
			echo "<td>";
			echo $list[$i][date_remise_loteriep];
			echo "</td>";
			echo "<td>";
			echo $list[$i][ip_loteriep];
			echo "</td>";
		}
		if ($list[$i][date_remise_loteriep] == "") {
			echo "<td>";
			echo "Remise effectu&eacute;e<br> ";
			echo "<input type='checkbox' value='oui' name='remise_".$list[$i][id_troll_loteriep]."'>";
			echo "</td>";
		}
		echo "</tr>";
	}
	$lien = '/loteries/loterie.php?gain=liste';
	$lien2 = '/loteries/loterie.php?admin=liste';

	echo "<tr class='mh_tdtitre' align='center'>";
	echo "<td colspan='10'>";
	echo "<input type='submit' value='Valider' class='mh_form_submit'> ";
	if ($_SESSION[admin] == 'authenticated') {
		if ($loterie->get_id_gagnant() != false) {
			$lien = "/loteries/loterie.php?gain=liste&id_troll=".$loterie->get_id_gagnant();
			echo "<input type='button' value='Retour Liste' onClick='Javascript:document.location.href=\"$lien\"'  class='mh_form_submit'> ";
		}
	}	

	if ($_SESSION[admin] != 'authenticated') 
		echo "<input type='button' value='Retour Liste' onClick='Javascript:document.location.href=\"$lien\"'  class='mh_form_submit'> ";
	
	if ($_SESSION[admin] == 'authenticated')
		echo "<input type='button' value='Retour Liste Admin' onClick='Javascript:document.location.href=\"$lien2\"'  class='mh_form_submit'> ";
	echo "</tr>";
	echo "</table>";
	echo "</form>";
	
}

function loterie_interface_gain_enregistre($id_troll, $id_loterie)
{
	$loterie = new loterie($id_loterie);

	if ($_SESSION[admin] != 'authenticated') {
		if ($id_troll != $loterie->get_id_gagnant())  {
			afficher_contenu_tableau("Erreur. Vous n'&ecirc;tes pas admin, ou vous n'avez pas gagn&eacute; cette loterie, ou la loterie n'est pas close");
			die(' ');
		}
	}

	$loterie_participants = new loterie_participants($id_loterie);
	$list = $loterie_participants->get_list();

	for ($i=1; $i<=count($list); $i++) {
		if ($_POST["remise_".$list[$i][id_troll_loteriep]] == "oui") {
			$loterie_participant =  new loterie_participant($list[$i][id_troll_loteriep], $id_loterie);
			$loterie_participant->set_date_remise_db();
		}
	}

	$text = "Mise &agrave; jour effectu&eacute;e.<br>";
	$text .= "<input type='button' value='Retour Liste' class='mh_form_submit'";
	$text .= " onClick='Javascript:document.location.href=\"/loteries/loterie.php?gain=liste\"'>";

	afficher_contenu_tableau($text);
}

function loterie_info_top() {

	$loteries = new loteries();
	$id_loterie = $loteries->get_last_id_loterie();
  $loterie = new loterie($id_loterie);
  $loterie_participant = new loterie_participant($_SESSION['AuthTroll'], $id_loterie);
	
	$lien = "<a href='/loteries/loterie.php'>loterie</a>";
	$text = "";

	if (!$loterie_participant->can_participe($id_loterie)) {
		$text .= "<font color='red'>Vous n'avez pas r&eacute;gl&eacute; vos dettes de loterie.<br>";
		//$text .= "<font color='red'>Vous n'avez pas r&eacute;gl&eacute; vos dettes de loterie num&eacute;ro $id_loterie.<br>";
	} elseif (!$loterie_participant->is_participant() && $loterie->get_etat() == 'en_cours' ) {
		$text .= "<font color='red'>Vous n'&ecirc;tes pas encore inscrit pour la $lien num&eacute;ro $id_loterie.<br>";
	} elseif ($loterie_participant->is_participant() && $loterie->get_etat() == 'en_cours' ) {
		$text .= "Vous participez &agrave; la $lien num&eacute;ro $id_loterie.<br>";
	}

	if ($loterie->get_etat() == 'ouvert') {
		$text .= "Nouvelle  [$lien] en pr&eacute;paration, ouverture dans peu de temps.";
	} elseif ($loterie->get_etat() == 'clos') {
		$text .= "<font color='red'>La $lien num&eacute;ro $id_loterie est cl&ocirc;tur&eacute;e. Le gagnant est : ";
		$troll = new troll($loterie->get_id_gagnant());

		$text .= $troll->get_nom_troll()." (".$loterie->get_id_gagnant().")<br>";
		
		if ($loterie->get_id_gagnant() == $_SESSION['AuthTroll']) {
			$text .= "<font color='red'><b>Vous avez gagn&eacute; la $lien num&eacute;ro $id_loterie !<b></font> ";
			$text .= "[<a href='/loteries/loterie.php?gain=fiche&id_loterie=$id_loterie'>Acc&egrave;s interface de gain loterie $id_loterie</a>] ";
		}
	}

	// on regarde si le troll connecté n'a pas déjà été gagnant une fois
	if ($loteries->is_gagnant($_SESSION['AuthTroll'])) {
		$text .= "[<a href='/loteries/loterie.php?gain=liste'>Loteries gagn&eacute;es</a>]";
	}

	if ($text != "") {
		echo "<tr class='mh_tdpage'><td>";
		echo $text;
		echo "</td></tr>";
	}
}

?>
