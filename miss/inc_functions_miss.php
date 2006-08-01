<?


function verif_identite_troll( $id_troll, $pass_troll )
{

  global $db_vue_rm;

	$pass_troll = md5($pass_troll);

  $date = date("Y-m-d H-i-s");
  $date_less_24 = date("Y-m-d H-i-s", mktime(date("H"), date("i"), date("s"), date("m")  , date("d")-1, date("Y")));

  /* On vérifie le nombre de fois que le script public à été utilisé en moins de 24 heures */
  $sql = "SELECT COUNT(*) FROM refresh_count";
  $sql .= " WHERE date_refresh >= '$date_less_24'";
  $sql .= " AND id_troll_refresh = $id_troll";
  $sql .= " AND categorie_refresh = 'compteurs_appels'";
  $sql .= " AND script_name_refresh = 'SP_Appels'";

  if ($DEV) echo "DEBUG refreshVue() $sql <br>\n";
  $result = mysql_query($sql,$db_vue_rm);

	$erreur_db = mysql_error();

	if ($erreur_db != "") {
		echo $erreur_db. " sql=$sql<br>";
	}

  if (mysql_affected_rows() >0)
    list($nb) = mysql_fetch_array($result);
  else
    $nb = 0;

  /* Si le script public a été utilisé 24 fois en moins de 24 heures, alors on ne continues pas */
	/* A priori, il ne devrait pas y avoir d'erreur ici, mais c'est au cas où si l'on utilise
		 la catégorie compteurs d'appels dans 2004 et que l'on se rappelle plus que l'outil Miss est en route */
  if ($nb >= 4) {
	  afficher_titre_tableau ("Vous avez utilisé plus de 4 fois le script public catégorie compteurs d'appels en moins de 24 heures.");
		return false;
	} 


  /* On récupère le fichier public pour voir si c'est le bon password */
	$chaine = "http://games.mountyhall.com/mountyhall/ScriptPublic/SP_Appels.php?Numero=$id_troll&Motdepasse=$pass_troll&categorie=1";
//	echo $chaine;
  $fp = fopen($chaine, "r");
  if ($fp == FALSE) {
    afficher_titre_tableau ("Erreur lors de l'appel au script public.");
		return false;
	}

  $erreur = "";
  while ( ($line=fgets($fp)) && (!$error) ){

    if ($deb<1) {
      if (strpos($line,"Erreur")!==false) {
        $error=true;
        if (strpos($line,"Erreur 3")!==false) {
          $erreur = "<br><b class=red>Il faut mettre le même mot de passe que sur MountyHall - essayez encore.</b><br>";
          break;
        } elseif (preg_match("/Erreur (4|5)/",$line)) {
          $erreur = "<br><b class=red>Erreur du serveur.</b><br>
              Il est encore en vrac. Il faudra repasser plus tard
              quand les DM l'auront remis enroute...<br>";
          break;
        } elseif (strpos($line,"Erreur 1")!==false) {
          $erreur = "<br><b class=red>Paramètres incorrects</b><br>
               Mais... qu'est-ce que vous avez donc tapé ? Envoyez-moi un mail avec vos paramètres,
               je tenterais de débugguer le truc.<br>";
          break;
        }
        $erreur = "erreur Inconnue : $line";
        break;

      } else {
        break ; // pas d'erreur
      }
      $deb++;
    }
  }
  fclose($fp);


  // On rajoute le fait que le troll à utilisé la vue publique
  $date = date("Y-m-d H-i-s");

  $sql = "INSERT INTO refresh_count";
  $sql .= " (id_troll_refresh, date_refresh, by_me_refresh,categorie_refresh, script_name_refresh )";
  $sql .= " VALUES ($id_troll, '$date','oui','compteurs_appels','SP_Appels')";

  mysql_query($sql,$db_vue_rm);

	$erreur_db = mysql_error();

	if ($erreur_db != "") {
		echo $erreur_db. " sql=$sql<br>";
	}

  if ($erreur != "") {
		afficher_titre_tableau($erreur);
		return false;
	} else {
		return true;
	}

}

function afficher_liste_miss( $annee, $genre ,$type, $admin = false)
{
  
	$lesMiss = selectDbMiss($annee, $genre, $type);
	$nbMiss = count($lesMiss);

	?>
	<table  border='0' cellpadding='0' cellspacing='1' class='mh_tdborder' align='center'width='80%'>
		<tr class='mh_tdtitre'>
			<td align="center" colspan="3"><h2>Candidates</h2></td>
		</tr>
		<?
		for($i=1; $i<=$nbMiss; $i++) {
			$res = $lesMiss[$i];
			?>
	  
			<tr class='mh_tdpage'>
				<td align='center'>
					<? 
					$petit_blason = "<img src='$res[image_1_miss]' width='70' height='70'>";
					$blason = "<img src='$res[image_2_miss]'>";
					affiche_popup("Blason $res[id_troll_miss]","yellow",$blason,$petit_blason);
					?>
				</td>
				<td>
					<b>Trollette</b> :  <? echo $res[nom_troll]." (".$res[id_troll_miss].")" ?> <br>
					<b>Slogan</b> :  <? echo stripslashes($res[description_miss]); ?><br><br>
					<b>Question</b> :  <? echo stripslashes($res[question_miss]); ?><br>
					<b>Réponse</b> :  <? echo stripslashes($res[reponse_miss]); ?>
				</td>
				<?
					if ($admin) {
						echo "<td align='center'>";
						$link = 'document.location.href="/miss/miss.php?act_miss=admin&id_troll_miss='.$res[id_troll_miss].'&act_admin=edit"';
						echo "<input type='button' class='mh_form_submit' value='Éditer' onClick='javascript:$link'>";
						afficherLien('troll','mh_evenements',$res[id_troll_miss],"","","","",true);

						echo "</td>";
					}
				?>
				
			</tr> 
			<? 
		}
	?>
	</table>
	<?
} 

function afficher_proposition_vote( $annee, $genre, $type )
{
	afficher_proposition_vote_js();
	
	$lesMiss = selectDbMiss($annee, $genre, $type);
	$nbMiss = count($lesMiss);

	?><br>
	<form action='' method='POST' name='formMiss'>
		<table  border='0' cellpadding='0' cellspacing='0' class='mh_tdborder' align='center'width='60%'>
			<tr class='mh_tdtitre'>
				<td colspan="2" align="center"><h2>Bulletin de vote</h2></td>
			</tr>
			<?
			if ( $nbMiss == 0)
			 echo "<tr><td colspan='2' align='center'><h3> Pas de miss enregistrée (année = $annee, genre = $genre, type=$type). </h3></td></tr>";

			?>
			<td align='right' width='50%'>Vote Blanc</td>
			<td align='left' width='50%'>
				<input type='radio' name='id_miss_vote' value='0' id='vote_blanc' checked > 
			</td>
			<?
			
			for($i=1; $i<=$nbMiss; $i++) {
				$res = $lesMiss[$i];
				?>
		  
				<tr class='mh_tdpage'>
					<td align='right' width='50%'>
					<? echo "$res[nom_troll] ($res[id_troll_miss])"; ?>
					</td>
					<td align='left' width='50%'>
						<input type='radio' name='id_miss_vote' value='<? echo $res[id_troll_miss] ?>' id='<? echo $res[id_troll_miss] ?>'> 
					</td>
				</tr> 
				<? 
			}
		?>
		<tr>	
			<td class='mh_tdpage' align='center' colspan='2'><br>
				Mon numéro de troll<br>
				<input type='textbox' name='id_troll_vote' value=''><br><br>

				Mon mot de passe sur Mountyhall<br>
				<input type='password' name='pass_troll_vote' value=''><br><br>
			
				<input type='button' class='mh_form_submit' value='Je vote !' onClick='javascript:control_vote()'><br><br>
			</td>
		</tr>
		</table>
	</form>
	<?
		
}

function afficher_proposition_vote_js()
{
	?>
	<script language='Javascript'>
		function control_vote(){

			myForm = document.formMiss;
			id_troll_vote = myForm.id_troll_vote.value;
			pass_troll_vote = myForm.pass_troll_vote.value;
				
			go_submit = false;

			if (id_troll_vote == "") {
				alert('Renseignez votre numéro de troll');

			} else if (pass_troll_vote == "") {
				alert('Renseignez votre mot de passe');
				
			}else if (document.getElementById('vote_blanc').checked == true) {
				if (confirm('Confirmez le vote blanc ?') == true) {
					go_sumbit = true;
				}
			} else {
				go_submit = true;
			}

			if (go_submit == true) {
				myForm.submit();
			}
		}
	</script>
	<?
}

function afficher_regles_votes()
{
	$regles = "Chaque troll de Mountyhall a le droit à un vote.<br>";
	//$regles = "Chaque trollette ".RELAISMAGO." a le droit à un vote.<br>";
	$regles .= "Une vérification à l'aide du numéro de troll et du mot de passe utilisé sur Mountyhall est effectuée.<br><br>";
	$regles .= "Vous avez la possibilité de voter blanc.<br><br>";

	
	$regles .= "Confiance ".RELAISMAGO." ".afficher_confiance_vote();
	
	return $regles;
}

function afficher_confiance_vote()
{
	$titre = "Confiance ".RELAISMAGO;
	$titre_couleur = "yellow";

	$text = "La guilde ".RELAISMAGO.", organisatrice des élections Miss Mountyhall, respecte les points suivants : <br>";

	$text .= " - 1 : 1 vote possible par troll présent sur Mountyhall.<br>";
	$text .= " - 2 : Obligation de renseigner le numéro de trolls et le mot de passe utilisés sur Mountyhall.<br>";
	$text .= " - 3 : Aucun mot de passe ".RELAISMAGO." n'est stocké dans les outils ".RELAISMAGO." suite à un vote, ou à une tentative de vote.<br>";
	$text .= " - 4 : La vérification du numéro avec le mot de passe s'effectue avec un script public.<br>";
	$text .= " - 5 : La liste des trolls ayant voté sera donné au DM pour confirmation de l'élue.<br>";
	$text .= " <br> <b>Pour les petits curieux :</b <br>";
	$text .= " - 6a : Le script public utilisé est SP_APPEL, de la catégorie <i>compteurs d'appels</i>.<br>";
	$text .= " - 6b : Voir le site http://sp.mountyhall.com/ pour plus de détails.<br>";
	$text .= " <br> <b>Pour les grands curieux :</b <br>";
	$text .= " - 7a : Les sources des outils ".RELAISMAGO." se trouvent sur http://cvs.lipyx.net<br>";
	$text .= " - 7b : Le programme d'élection de Miss se situe dans le répertoire miss/ <br><br>";

	$text .= " Si toutefois vous avez un soucis, veuillez contacter Bodéga (49145). Merci.";

	return affiche_popup($titre, $titre_couleur, $text,"",true, false);
}

function afficher_nombre_votes($annee, $genre, $type)
{
	$text = "Nombre de votes enregistrés : ";
	$text .= nombre_votes_db($annee, $genre, $type);
	afficher_contenu_tableau($text);
}

function afficher_proposition_candidature( $annee, $genre, $type )
{
	afficher_proposition_candidature_js();
	
	$question[1] = "Quand ton Troll mâle rentre de la chasse, que t'empresses-tu de lui faire ?";
	$question[2] = "Que feras-tu si tu es élue Miss et que l'on te propose de poser dans PlayTroll contre beaucoup de GGs ? Quelle est ton opinion sur ce type de revues ?"; 
	$question[3] = " Quelle sera ta première décision/action en tant que Miss MountyHall si tu es élue ?";
	$question[4] = " Si tu avais un crédit illimité de GG, tu en ferais quoi ?";
	$question[5] = " Quels sont les trois objets que tu emmenerais dans une caverne déserte ?";

	$n = rand(1,5);
	

	?><br>
	<form action='' method='POST' name='formCandidature'>
		<input type='hidden' name='act_miss' value='enregistrement'>

		<table  border='0' cellpadding='0' cellspacing='0' class='mh_tdborder' align='center'width='70%'>
			<tr class='mh_tdtitre'>
				<td colspan="2" align="center"><h2>Bulletin de candidature</h2></td>
			</tr>
			<tr class='mh_tdpage'>
			<tr>	
				<td class='mh_tdpage' align='center' colspan='2'><br>
					Mon numéro de troll<br>
					<input type='textbox' name='id_troll_candidature' value=''><br><br>

					Mon mot de passe sur Mountyhall<br>
					<input type='password' name='pass_troll_candidature' value=''><br><br>

					Mon slogan !<br>
					<textarea name='slogan_candidature' size='60' maxlength='65000' value='' cols=60 rows=4></textarea>	
					<br><br>
					Question : <? echo $question[$n] ?><br>
					<input type='hidden' name='question_candidature' value="<? echo $question[$n] ?>">
					<textarea name='reponse_candidature' size='60' maxlength='65000' value='' cols=60 rows=4></textarea><br><br>
			
					<input type='button' class='mh_form_submit' value='Valider !' onClick='javascript:control_candidature()'><br><br>
				</td>
			</tr>
		</table>
	</form>
	<?
		
}

function afficher_proposition_candidature_js()
{
	?>
	<script language='Javascript'>
		function control_candidature(){

			myForm = document.formCandidature;
			id_troll_candidature = myForm.id_troll_candidature.value;
			pass_troll_candidature = myForm.pass_troll_candidature.value;
			slogan_candidature = myForm.slogan_candidature.value;
				
			go_submit = false;

			if (id_troll_candidature == "") {
				alert('Renseignez votre numéro de troll');

			} else if (pass_troll_candidature == "") {
				alert('Renseignez votre mot de passe');

			} else if (slogan_candidature == "") {
				alert('Renseignez votre slogan !');
				
			} else {
				go_submit = true;
			}

			if (go_submit == true) {
				myForm.submit();
			}
		}
	</script>
	<?
}

function afficher_regles_candidature()
{
	$regles = "<table width='100%'><tr><td>";
	$regles .= "Chaque troll de Mountyhall a le droit à une candidature.<br>";
	//$regles = "Chaque trollette Relais&Mago a le droit à une candidature.<br>";
	$regles .= "Une vérification à l'aide du numéro de troll et du mot de passe utilisé sur Mountyhall est effectuée.<br><br>";
	$regles .= "La présente élection est destinée aux Trollettes.<br><br>";
	$regles .= "Une validation des candidatures sera effectuée, vous recevrez un message de confirmation en Message Privé sur Mountyhall.<br><br>";
	$regles .= "Ce message sera envoyé 2 à 3 jours avant le début des votes.<br><br>";
	$regles .= "Pour toute question, contactez Bodéga (49145).<br><br>";

	$regles .= "</td>";

	//$regles .= "<td><img src='/images/missRM.gif'></td>";
	$regles .= "<td><img src='/images/missMH.gif'></td>";
	
	$regles .= "</tr></table>";

	return $regles;
}

function afficher_nombre_candidatures($annee, $genre, $type)
{
	$text = "Nombre de candidatures enregistrés : ";
	$text .= nombre_candidatures_db($annee, $genre, $type);
	afficher_contenu_tableau($text);
}

function afficher_administration_miss($annee, $genre, $type)
{
	afficher_liste_miss($annee, $genre, $type, true);
}

function afficher_administration_miss_fiche($annee, $genre, $type,  $id_troll_miss)
{
	afficher_titre_tableau("Fiche de Miss");

	$lesMiss = selectDbMiss($annee ,$genre, $type, $id_troll_miss);
	$res = $lesMiss[1];

	$id_troll_miss = $res[id_troll_miss];
	$nom_troll = $res[nom_troll];
	$image_1_miss = $res[image_1_miss];
	$image_2_miss = $res[image_2_miss];
	$description_miss = stripslashes($res[description_miss]);
	$question_miss = stripslashes($res[question_miss]);
	$reponse_miss = stripslashes($res[reponse_miss]);

	?>
	<form method='post' action=''>
	<input type='hidden' name='id_troll_miss' value='<? echo $id_troll_miss ?>'>
	<input type='hidden' name='act_admin' value='editdb'>

	<table class='mh_tdborder' width='70%'  border='0' cellpadding='0' cellspacing='1' align='center'>
		<tr class='mh_tdtitre'>
			<td colspan="2" align="center">
				 <h2>
				 	<? 
				 		echo $nom_troll." ($id_troll_miss) ";
				 		afficherLien('troll','mh_evenements',$id_troll_miss,"","","","",true);
					?>
					</h2>
			</td>
		</tr>
		<tr class='mh_tdpage'>
			<td align='center'>
			Slogan : <br>
			<? echo $description_miss ?>
			</td>
			<td>

				<textarea name='description_miss' size='60' maxlength='65000' value='' cols=60 rows=4><? echo $description_miss ?></textarea>
			</td>
		</tr>

		<tr class='mh_tdpage'>
			<td align='center'>
			Question : <br>
			<? echo $question_miss ?>
			</td>
			<td>
				<textarea name='question_miss' size='60' maxlength='65000' value='' cols=60 rows=4><? echo $question_miss ?></textarea>
			</td>
		</tr>

		<tr class='mh_tdpage'>
			<td align='center'>
			Réponse : <br>
			<? echo $reponse_miss ?>
			</td>
			<td>
				<textarea name='reponse_miss' size='60' maxlength='65000' value='' cols=60 rows=4><? echo $reponse_miss ?></textarea>
			</td>
		</tr>
		<tr class='mh_tdpage'>
			<td align='center'>
				Petite image<br>
				<? echo "<img src='$image_1_miss'>" ?>
			</td>
			<td>
				<input type='textbox' name='image_1_miss' size='50' maxlength='240' value='<? echo $image_1_miss ?>'>
			</td>
		</tr>
		<tr class='mh_tdpage'>
			<td align='center'>
			Grande image<br>
			<? echo "<img src='$image_2_miss'>" ?>
			</td>
			<td>
				<input type='textbox' name='image_2_miss' size='50' maxlength='240' value='<? echo $image_2_miss ?>'>
			</td>
		</tr>
		<tr class='mh_tdtitre'>
			<td align='center' colspan='2'>
				<?
					$link_del = 'document.location.href="/miss/miss.php?act_miss=admin&act_admin=deldb&id_troll_miss='.$id_troll_miss.'";';
					$link_back = 'document.location.href="/miss/miss.php?act_miss=admin"';
				?>
					
				<input type='submit' value='Modifier' class='mh_form_submit'>	
				<input type='button' value='Supprimer' class='mh_form_submit' onClick='javascript:if(confirm("Confirmer la suppression ?")) {<? echo $link_del ?>}'>	
				<input type='button' value='Retour Liste' class='mh_form_submit' onClick='javascript:<? echo $link_back ?>'>	
			</td>
		</tr>
	</table>
	</form>

	<?
}

?>
