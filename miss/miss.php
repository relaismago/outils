<?

require_once('../top.php');
require_once('inc_functions_miss.php');
require_once('inc_functions_db_miss.php');

//include_once('../secure.php');

function miss_mh_2003 () {
	$img = "<img src='http://www.relaismago.com/images/miss-bandeau.gif'>";	
	afficher_titre_tableau("$img");

	$img = "<img src='resultats/miss_mh_2005_podium.png'>";	
	$base = "<a href='http://games.mountyhall.com/mountyhall/View/PJView_Events.php?ai_IDPJ=";

	$text = "<table><tr><td>";
	$text .= "<img src='http://www.relaismago.com/images/missMH.gif'>";
	$text .= "</td>";
	$text .= "<td valign='top'>";
	$text .= "$img";
	$text .= "<br>Félicitations à la Miss <b>Xardel</b> (n° 17434)! ".$base."17434'>Profil</a>";
	$text .= "<br>La suite des évènements ici et sur le Forum MH.";
	$text .= "<br>Merci de votre participation !<br>";
	$text .= "<br>1ère dauphine : Krapounia (45951) ".$base."45951'>Profil</a>";
	$text .= "<br>Seconde dauphine : HellenRolles (16965) ".$base."16965'>Profil</a><br><br>";
	$text .= "<a href='resultats/miss_mh_2005.png'>[Résultats complets]</a>";	
	$text .= "</td></tr></table>";
	
	afficher_titre_tableau("Résultat de Miss MountyHall 2005 ","$text");
	init_miss( 2005, "f", "mh", false);
}

miss_mh_2003 ();
die();

$ANNEE_MISS = "2005";
$GENRE_MISS = "f";
$TYPE_MISS = "mh";

if ( isDbAdministration() ) {
	$text = "Vous êtes administrateur des outils ".RELAISMAGO." vous avez donc accès à l'administration de l'outil Miss.<br>";
	$text .= " <h5><font color='red'>Dépôt de candidature : <a href='/miss/miss.php?act_miss=enregistrement'>ICI</a></font>";
	$text .= " <font color='red'>Administration des Miss : <a href='/miss/miss.php?act_miss=admin'>ICI</a></font>";
	$text .= " <font color='red'>Résultats en cours : <a href='/miss/miss.php?act_miss=resultats'>ICI</a></font></h5>";

	afficher_titre_tableau("Administration",$text);
}


	if ( $_REQUEST[act_miss] == "enregistrement" ) {
		init_inscription_miss( $ANNEE_MISS, $GENRE_MISS, $TYPE_MISS );

	} elseif ( $_REQUEST[act_miss] == "admin" ) {
		if ( isDbAdministration() ) {
			afficher_titre_tableau("Administration des Miss");
			init_admin_miss( $ANNEE_MISS, $GENRE_MISS, $TYPE_MISS );
			
		} else {
			afficher_titre_tableau('Accès réservé aux administrateurs');
		}

	} elseif ( $_REQUEST[act_miss] == "resultats" ) {
		if ( isDbAdministration() ) {
			afficher_titre_tableau("Résultats");
			resultats_miss( $ANNEE_MISS, $GENRE_MISS, $TYPE_MISS );
			
		} else {
			afficher_titre_tableau('Accès réservé aux administrateurs');
		}
	}	else {
		//init_inscription_miss( $ANNEE_MISS, $GENRE_MISS, $TYPE_MISS );
		init_miss( $ANNEE_MISS, $GENRE_MISS, $TYPE_MISS, true );
	}

require_once('../foot.php');

function init_miss( $ANNEE_MISS, $GENRE_MISS, $TYPE_MISS , $is_vote = false)
{
//	die('Votes non commencés');
	
	$display_proposition = false;

//	$text .= " <h5><font color='red'>Déposition de candidature : <a href='/miss/miss.php?act_miss=enregistrement'>ICI</a></font><br>";
	//afficher_titre_tableau("Élection Miss Mountyhall 2005", $text." ".afficher_regles_candidature());
	if ( $is_vote ) {
		afficher_titre_tableau('Élection de Miss Mountyhall 2005', afficher_regles_votes());
	}

	if ( $_POST[id_troll_vote] != ""  && $is_vote ) {

		if ( verif_nombre_vote_troll_db ($_POST[id_troll_vote], $ANNEE_MISS, $GENRE_MISS, $TYPE_MISS) ) {
			afficher_titre_tableau("Vous avez déjà voté !");
				
		} else if ( verif_identite_troll( $_POST[id_troll_vote], $_POST[pass_troll_vote]) ) {
		
			if ( !enregistre_vote_db( $_POST[id_troll_vote], $ANNEE_MISS, $_POST[id_miss_vote], $GENRE_MISS, $TYPE_MISS)) {
				afficher_titre_tableau("Erreur : Contactez Bodéga (49145) en copiant / collant ce que vous voyez. Merci");
			} else {
				afficher_titre_tableau("Votre vote est bien pris en compte. Merci.");
			}
		} else {
			afficher_titre_tableau('Erreur dans la prise en compte du vote',"Si vous pensez que c'est pas normal, contactez Bodéga (49145)");
			die(' ');
		}
	} else {
		$display_proposition = true; 
	}

	afficher_liste_miss($ANNEE_MISS, $GENRE_MISS, $TYPE_MISS);

	if ($display_proposition && $is_vote ) {
		afficher_proposition_vote( $ANNEE_MISS, $GENRE_MISS , $TYPE_MISS );
	}
	afficher_nombre_votes($ANNEE_MISS, $GENRE_MISS, $TYPE_MISS);
}


function init_inscription_miss( $ANNEE_MISS, $GENRE_MISS, $TYPE_MISS ) 
{
	die('Pas d\'inscription en cours.');

	$img = "<img src='http://www.relaismago.com/images/miss-bandeau.gif'>";	
	afficher_titre_tableau("Élection Miss Mountyhall 2005<br>", afficher_regles_candidature());

	if ( $_REQUEST[id_troll_candidature] != "" ) {

		if ( verif_nombre_candidature_troll_db ($_REQUEST[id_troll_candidature], $ANNEE_MISS, $GENRE_MISS,$TYPE_MISS) ) {
			afficher_titre_tableau("Vous avez déjà déposé votre candidature");
				
		} else if ( verif_identite_troll( $_REQUEST[id_troll_candidature], $_REQUEST[pass_troll_candidature]) ) {
		
			if ( !enregistre_candidature_db( $_REQUEST[id_troll_candidature], $ANNEE_MISS, $_REQUEST[slogan_candidature], $_REQUEST[question_candidature], $_REQUEST[reponse_candidature],  $GENRE_MISS, $TYPE_MISS)) {
				afficher_titre_tableau("Erreur : Contactez Bodéga (49145) en copiant / collant ce que vous voyez. Merci.");
			} else {
				afficher_titre_tableau("Votre candidature est bien prise en compte. Merci.");
			}
		} else {
			afficher_titre_tableau("Erreur dans la prise en compte de la candidature","Si vous pensez que c'est pas normal, contactez Bodéga (49145)");
			die(' ');
		}
	} else {
		$display_proposition = true; 
	}
	
	if ($display_proposition) {
		afficher_proposition_candidature( $ANNEE_MISS, $GENRE_MISS, $TYPE_MISS );
	}

	afficher_nombre_candidatures($ANNEE_MISS, $GENRE_MISS, $TYPE_MISS);
}


function init_admin_miss( $ANNEE_MISS, $GENRE_MISS, $TYPE_MISS )
{
	if ($_REQUEST[act_admin] == "edit") {
		afficher_administration_miss_fiche($ANNEE_MISS, $GENRE_MISS, $TYPE_MISS, $_REQUEST[id_troll_miss]);

	} else if ($_REQUEST[act_admin] == "editdb") {
		if (edit_miss_db($ANNEE_MISS, $GENRE_MISS, $TYPE_MISS) ) {
			afficher_titre_tableau("Modification effectuée", "<a href='/miss/miss.php?act_miss=admin'>Retour</a>");
		} else {
		 	afficher_titre_tableau("Erreur : Contactez Bodéga (49145) en copiant / collant ce que vous voyez. Merci.");
		}


	} else if ($_REQUEST[act_admin] == "deldb") {
		if (delete_miss_db($ANNEE_MISS, $GENRE_MISS, $TYPE_MISS) ) {
			afficher_titre_tableau("Suppression effectuée", "<a href='/miss/miss.php?act_miss=admin'>Retour</a>");
		} else {
		 	afficher_titre_tableau("Erreur : Contactez Bodéga (49145) en copiant / collant ce que vous voyez. Merci.");
		}

	} else {
		afficher_administration_miss( $ANNEE_MISS, $GENRE_MISS , $TYPE_MISS );
	}
}


function resultats_miss( $ANNEE_MISS, $GENRE_MISS, $TYPE_MISS )
{
	?>
	<table class='mh_tdborder' width='70%' align='center'>
		<tr class='mh_tdtitre'>
			<td align='center'>
				<h2>Élection <? echo $ANNEE_MISS ?> - Genre <? echo $GENRE_MISS ?> - Type <? echo $TYPE_MISS ?> </h2>
			</td>
		</tr>
		<tr class='mh_tdpage'>
			<td align='center'>
					<? echo "<img src='/miss/resultats_miss_img.php?annee=$ANNEE_MISS&genre=$GENRE_MISS&type=$TYPE_MISS'>"; ?>
			</td>
		</tr>
	</table>
	<?	
}

?>
