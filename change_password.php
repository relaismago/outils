<?
session_start();
require_once('functions_auth.php');

include('top.php');

displayChangePasswordHaut();

if (is_numeric($_REQUEST[id_troll]))
	changeDbPassword();
else
	initChangePassword($_REQUEST[act]);
	
displayChangePasswordBas();

include('foot.php');

function displayChangePasswordHaut()
{
?>
	 <table class='mh_tdborder' width='70%' align='center' >
      <tr><td>
        <table width='100%' cellspacing='0'>
          <tr class='mh_tdtitre' align="center">
            <td>
							<h2>Renseignement de Mot de passe</h2>
             </td>
           </tr>
         </table>
       </td></tr>
<?
}

function displayChangePasswordBas()
{
?>
			</td>
			</tr>
		</table>
	<br>

<?

}

function initChangePassword($act="")
{
?>
      <tr class='mh_tdpage' align='center'>
				<td>
					<?	if ($act == "premiere") { ?>
					Vous �tes nouveau dans les outils <? echo RELAISMAGO ?>, vous devez renseigner ici votre mot de passe.<br><br>
					Celui-ci doit �tre le m�me que sur Mountyhall, une v�rification va �tre effectu�e.<br><br>
					<? } else { ?>
					Si vous avez chang� de mot de passe sur Mountyhall, vous devez changer le mot de passe restreint dans les outils.<br><br>
					<? } ?>
					Renseignez les informations n�cessaires ci-dessous puis cliquer sur Changer.<br><br>
					Si toutefois vous avez des soucis, envoyez un MP � glupglup (51166)<br>
				</td>
			</tr>
			
      <tr class='mh_tdpage' align='center'>
				<td>

								<form name="change_password" action="change_password.php" method='POST'>
								<br>
								Num�ro de votre Troll <br>
								<input type='textbox' name='id_troll'><br><br>
								Nouveau mot de passe<br>
								<input type='password' name='new_password'><br><br>
								<a href="http://sp.mountyhall.com/md5.php">Mot de passe restreint MH qui servira pour les appels aux scripts publics</a><br>
								<input type='password' name='mh_password'><br><br>
								<input type='submit' value='Mettre � jour' class='mh_form_submit'><br>
	
<?
}

function changeDbPassword()
{
	include('inc_connect.php');

  global $db_vue_rm;


  $id_troll = $_REQUEST[id_troll];
  $md5_new = $_REQUEST[mh_password];
  $pass_troll = md5($_REQUEST[new_password]);
  $erreur = "";
  
  if ($_REQUEST[new_password] == "") {
  	$erreur .= "Le mot de passe doit contenir plusieurs caract�res !<br>";
  }
  
  $date=date("Y-m-d H-i-s");
  $date_less_24=date("Y-m-d H-i-s", mktime(date("H"), date("i"), date("s"), date("m")  , date("d")-1, date("Y")));

  /* On v�rifie le nombre de fois que le script public � �t� utilis� en moins de 24 heures */
  $sql = "SELECT COUNT(*) FROM refresh_count";
  $sql .= " WHERE date_refresh >= '$date_less_24'";
  $sql .= " AND id_troll_refresh = $id_troll";
	$sql .= " AND categorie_refresh = 'classiques'";
	$sql .= " AND script_name_refresh = 'SP_Vue2'";

  if ($DEV) echo "DEBUG refreshVue() $sql <br>\n";
  $result=mysql_query($sql,$db_vue_rm);
  echo mysql_error();
	
  if (mysql_affected_rows() >0)
    list($nb)=mysql_fetch_array($result);
  else
    $nb = 0;

  /* Si le script public a �t� utilis� 24 fois en moins de 24 heures, alors on ne continues pas */
  if ($nb >=24)
    die("Vous avez utilis� plus de 24 fois le script public en moins de 24 heures.");

	/* On r�cup�re le fichier public pour voir si c'est le bon password */
	$fp = fopen("http://sp.mountyhall.com/SP_Vue2.php?Numero=$id_troll&Motdepasse=$md5_new&Tresors=1&Lieux=1&Champignons=1","r");

	if ($fp == FALSE)
		die ("Erreur lors de l'appel au script public.");
	
  while ( ($line=fgets($fp)) && (!$error) ){
    if ($deb<1) {
      if (strpos($line,"Erreur")!==false) {
        $error=true;
        if (strpos($line,"Erreur 3")!==false) {

          $date=date("Y-m-d H-i-s");
          $tmpfile=fopen ("vues/list_mdp_error.txt","a");
          fwrite($tmpfile,$date.": Troll n� ".$id."\n");
          fclose($tmpfile);

          $erreur .= "<br><b class=red>Le mot de passe restreint de MH n'est pas bon - essayez encore.</b><br>";
          break;
        } elseif (preg_match("/Erreur (4|5)/",$line)) {
          $erreur .= "<br><b class=red>Erreur du serveur.</b><br>
              Il est encore en vrac. Il faudra repasser plus tard
              quand les DM l'auront remis en route...<br>";
          break;
        } elseif (strpos($line,"Erreur 1")!==false) {
          $erreur .= "<br><b class=red>Param�tres incorrects</b><br>
               Mais... qu'est-ce que vous avez donc tap� ? Envoyez-moi un mail avec vos param�tres,
               je tenterais de d�bugguer le truc.<br>";
          break;
        }
        $erreur .= "erreur Inconnue : $line";
        break;

			} else {
				break ; // pas d'erreur
			}
    	$deb++;
    }
    //fputs ($v2, $line);
  }
  fclose($fp);

	
	// On rajoute le fait que le troll � utilis� la vue publique
	$date = date("Y-m-d H-i-s");

	$sql = "INSERT INTO refresh_count";
	$sql .= " (id_troll_refresh, date_refresh, by_me_refresh, categorie_refresh, script_name_refresh)";
	$sql .= " VALUES ($id_troll, '$date','oui','classiques','SP_Vue2')";

	mysql_query($sql,$db_vue_rm);
	echo mysql_error();

	// Puis on supprime les acc�s qui date de plus de 24 heures
	// de toutes les entr�es qui sont dans la table refresh_count
	$sql = "DELETE FROM refresh_count";
	$sql .= " WHERE date_refresh <= '$date_less_24'";
	mysql_query($sql,$db_vue_rm);
	echo mysql_error();

	if ( $erreur == "") {
	
		$sql = " UPDATE trolls SET"; 	
		$sql .= " pass_troll='$md5_new',";
		$sql .= " pass_outils_troll='$pass_troll'";
		$sql .= " WHERE id_troll=$id_troll";

		if (!$result=mysql_query($sql,$db_vue_rm)) {
			echo mysql_error(); 	         
			$erreur .=  "<br>chaine sql = $sql<br>";
			$erreur .=  "<font color=red>Erreur dans le changement du mot de passe du troll."; 	 
			$erreur .=   "Copiez / Collez ce que vous voyez et postez"; 	 
			$erreur .=   " cela dans le forum outils. Merci (ou contactez glupglup 51166)</font>"; 	 
		} else { 	 
			$erreur .= 	 "<h2>Le mot de passe du troll n� $id_troll est modifi�</h2>"; 	 
			$erreur .= 	 "Connectez-vous, puis allez sur le cockpit.<br><br>"; 	 
			$erreur .= 	 "Ensuite rafraichissez votre vue avec les scripts publics pour tester le changement de mot de passe."; 	 
			$erreur .= 	 "<br><br>"; 	 
		
			$erreur .= 	 "Si toutefois vous avez des soucis, envoyez un MP � glupglup (51166)"; 	 
				$erreur .= 	 " avec le md5 de votre actuel mot de passe calcul� l� =>"; 	 
			$erreur .= 	 "<a href='/md5.php'>MD5</a>"; 	 
		}
	} else {
		$erreur .=  "<font color=red>Erreur dans le changement du mot de passe du troll.</font>"; 	 
	}

		?>
      <tr class='mh_tdpage' align='center'>
        <td>
					<h1><? echo $erreur; ?></h1>
        </td>
      </tr>
		<?
		initChangePassword();
		return ;
}
?>
