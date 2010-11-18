<?

session_start();

include_once("inc_define_vars.php");

include_once("inc_connect.php");
include_once("functions.php");
include_once("functions_vue.php");
include_once("functions_cockpit.php");
include_once ("admin_functions.php");
include_once ("admin_functions_db.php");
include_once ("functions_engine.php");

function afficherFormAuth()
{
	if ( userIsGuilde() || userIsGroupSpec() )
		afficheLogout();
	else
		afficheAuthentifie();
}

/*
 * Affiche la boite d'authentification
 * Utilisé dans top.php
 */
function afficheAuthentifie($DEV=FALSE)
{
	# si il y a un cookie, on l'utilise !
	if (isset($_COOKIE["cookie_id_troll"])) $CHTROLL = $_COOKIE["cookie_id_troll"]; else $CHTROLL = '';
	?>

	<form name='select_troll' method='POST' action='/cockpit.php'>

		<table class='mh_tdborder'>
			<tr>
				<td class='mh_tdpage'>N° troll
					<input type=text name='CHTROLL' size=6 value='<? echo $CHTROLL ?>'>
				</td>
				<td class='mh_tdpage'>Passe:
					<input type=password name='CHPASS' size=6>
					auto-login : <input type='checkbox' name='autologin' class="TextboxV2" value="true">
				</td>
			</tr>
			<tr>
				<td align='center' class='mh_tdpage' colspan='2'>
					<input type=submit name='Submit_Pass' value='Connexion' class='mh_form_submit'> &nbsp;
						<a href='change_password.php' title='Changement de Mot de passe, ou nouveau chez les Relais&Mago'>Changement de Mot de Passe ?</a>
						<? 
							$text = "Vous devez avoir le même mot de passe dans les outils ".RELAISMAGO." que dans Mountyhall.<br><br>";
							$text .= "Si vous êtes nouveau ou si vous venez de changer de mot de passe, veuillez cliquer <br>";
							$text .= "sur ce lien.";
							
							affiche_popup("Renseignement Mot de Passe","yellow",$text,"",false);
						?>
				</td>
			</tr>
		</table>
	</form>

	<?
}

function afficheLogout()
{
	?>
	<table class='mh_tdborder'>
		<tr>
			<td class='mh_tdpage' align='center' title='<? echo addslashes($_SESSION['AuthNomTroll']) ?>'>
				<? echo $_SESSION['AuthTroll']?> <br>
					<input type='button' value='Déconnexion' onClick='JavaScript:document.location.href="/cockpit.php?logout=true"' class='mh_form_submit'>
			</td>
		</tr>
	</table>
	<?
}

/* Initialisation de la connection 
 *
 */
function initAuth()
{
	global $db_vue_rm;

	if (isset($_SERVER['REQUEST_URI'])) $REQUEST_URI = $_SERVER['REQUEST_URI']; else $REQUEST_URI="";
	if (isset($_SERVER['HTTP_REFERER'])) $HTTP_REFERER = $_SERVER['HTTP_REFERER']; else $HTTP_REFERER="";
	if (isset($_REQUEST['CHTROLL'])) $CHTROLL = $_REQUEST['CHTROLL']; else $CHTROLL="";
	if (isset($_REQUEST['CHPASS'])) $CHPASS = $_REQUEST['CHPASS']; else $CHPASS="";
	if (isset($_REQUEST['logout'])) $logout = $_REQUEST['logout']; else $logout="";
	
	if (isset($_REQUEST['CHTROLL']) && isset($_REQUEST['CHPASS']))
	{
			setcookie ( 'autologin', $_REQUEST['autologin'], time()+365*24*3600 );
			if ($_REQUEST['autologin'])
			{
				 setcookie ( 'num_troll', $_REQUEST['CHTROLL'], time()+365*24*3600 );
				 setcookie ( 'hash_pass_troll', md5($_REQUEST['CHPASS']), time()+365*24*3600 );
			}
	}
	
	if (isset($_COOKIE['autologin'])) {
		$autologin = $_COOKIE['autologin'];
	} else {
		$autologin = false;
	}

	if ( $autologin )
	{
		$CHTROLL = $_COOKIE['num_troll'];
		$CHPASS = $_COOKIE['hash_pass_troll'];
	}

	if (($HTTP_REFERER=="") || (preg_match("/inc_authent/",$HTTP_REFERER)))
		$GOTO = $REQUEST_URI; // pour info, le temps de debug par Bodéga
	else
		$GOTO = $HTTP_REFERER;
	
	if ( (! preg_match("/inc_authent/",$GOTO)) && 
		   (! preg_match("/index/",$GOTO))
		 )
				
	  $_SESSION['uri']=$GOTO; 
	else
	  $_SESSION['uri']="/cockpit.php";
	
	# submit tout frais ?
	if (($CHTROLL>0) || ($CHPASS!="")) {
	  // Si le mot de passe n'est pas le mot de passe md5
	  if (strlen ($CHPASS) != 32) {
	    // On se débarasse du pass en clair
	    $CHPASS=md5($CHPASS);	
	  }
		$_SESSION['AuthTroll'] = $CHTROLL;
		$_SESSION['Auth'] = $CHPASS;
	}
			

	# demande de logout ?
	if ($logout) {
	  $_SESSION['Status']="";
	  $_SESSION['AuthTroll']="";
	  $_SESSION['AuthNomTroll']="";
	  $_SESSION['AuthGuilde']="";
	  $_SESSION['Auth']="";
	  $_SESSION['AuthGroupSpec']="";

	  session_unset();
	  session_destroy();
		
	  setcookie ( 'autologin', false );
		
	  echo "<script language='JavaScript'>";
	  echo "document.location.href='/index.php'";
	  echo "</script>";
	}

	# Si la personne est déjà authentifiée

	if (isset($_SESSION['Status']) && $_SESSION['Status']=="authentified") {
		return; 
	}

	# Vérification normale
	if ( (is_numeric($CHTROLL)) && ($_SESSION['Status']!="authentified")) {
	
		$md5pass="---"; // Initialisation, mais çà sert pas à grand chose ici
	
		// On regarde si le troll existe dans la base de données
		$sql = "SELECT pass_troll, guilde_troll, nom_troll, nom_rang_troll, groupe_spec_troll";
		$sql .= " FROM trolls WHERE id_troll=$CHTROLL";
	  $result=mysql_query($sql, $db_vue_rm);
	  echo mysql_error();
	
	  list($md5pass,$AuthGuilde,$AuthNomTroll,$nom_rang_troll,$groupe_spec_troll)=mysql_fetch_array($result);
		// S'il existe 

		if (preg_match("/essai/", $nom_rang_troll)) {
			die( "<h2>Vous êtes un troll à l'essai, vous n'avez pas accès aux outils pendant cette période<h2>");
		}

		if ( (mysql_affected_rows()>0) && ($md5pass!="") ) {
			// et que le mot de passe est correct
			if ($md5pass == $_SESSION['Auth'])
			{
				//$_SESSION[AuthTroll]=$_SESSION[AuthTroll]; // pour indiquer ici toutes les valeurs possibles de session
				$_SESSION['AuthGuilde'] = $AuthGuilde;
				$_SESSION['AuthNomTroll'] = $AuthNomTroll;
				$_SESSION['AuthGroupSpec'] = $groupe_spec_troll;
				//$_SESSION[Auth]=$_SESSION[Auth];
			} else {
				setcookie ( 'autologin', false );
				die( "<h2><font color='red'>Mot de passe incorrect</font></h2>");
			}
		// S'il n'existe pas dans la base de données
		} else {
			/* Premier connection du troll sur les outils */
			setcookie ( 'autologin', false );
			echo "<script language='JavaScript'>";
			echo "document.location.href='/change_password.php'";
			echo "</script>";
			echo "2 - Si vous n'etes pas redirigé automatiquement, cliquez ici : ";
			echo "<a href='/change_password.php?act=premiere'> Là j'tai dis !! </a>";
		}

		if ( userIsGuilde() || userIsGroupSpec() ) {
			// Controle de l'administrateur
			// Remplis la variable de session
			if ( isDbAdministration() )
				$_SESSION['admin'] = "authenticated";
			else
				$_SESSION['admin'] = "notauthorized";
		
			$_SESSION['Status']="authentified";
			setcookie ("cookie_id_troll", $_SESSION['AuthTroll'],time()+31536000); // on garde le cookie 1 an

			enregistre_connection( $_SESSION['AuthTroll'] );
			redirectAuth();
		} else {
  			setcookie ( 'autologin', false );
			session_unset();
			session_destroy();
			die( "<h2>Soit vous n'êtes pas un Relais&Mago
			<br> soit le mot de passe est incorrect
			<br> soit c'est votre première connexion (réessayez)<br>
			<br><br>Conclusion : 
			<br>Vous n'avez pas accès à ces pages<br>
			Contactez GlupGlup (51166) pour résoudre le problème.<br><br>
			");
		}
	}
}

function redirectAuth()
{
	if (preg_match("/cockpit/",$_SESSION['uri'])) {
		if (!preg_match("/id_troll/",$_SESSION['uri'])) {
			$_SESSION['uri'] .= "?id_troll=$_SESSION[AuthTroll]";
		}
	}
	
	if ($_SESSION['Status']=="authentified") {
		echo "<script language='JavaScript'>";
		echo "document.location.href='".$_SESSION['uri']."'";
		echo "</script>";
		echo "2 - Si vous n'etes pas redirigé automatiquement, cliquez ici : ";
		echo "<a href='/cockpit.php?id_troll=$_SESSION[AuthTroll]'> Là j'tai dis !! </a>";
	} else {
		afficheAuthentifie();
	}
}

/* Mise à jour de la date de connection du troll aux outils
 * Permet de déterminer quels sont les trolls qui ne viennent jamais
 */
function enregistre_connection($id_troll)
{
	global $db_vue_rm;
	
	$date = date("Y-m-d H-i-s");
	
	$sql = "UPDATE trolls set date_last_visit_troll = '$date' WHERE id_troll=$id_troll";
	mysql_query($sql,$db_vue_rm);
	echo mysql_error();
}

/**
 * Vérifie si un utilisateur est authentifié.
 */
function userIsLogged ()
{
	return ( $_SESSION['Status'] == 'authentified' );
}

/**
 * Vérifie si un utilisateur est authentifié comme membre de la guilde.
 */
function userIsGuilde ()
{
	if (!isset($_SESSION['AuthGuilde'])) return false; 
	else return ( $_SESSION['AuthGuilde'] == ID_GUILDE );
}

function userIsGroupSpec ()
{
	if (!isset($_SESSION['AuthGroupSpec'])) return false; 
	else return ( $_SESSION['AuthGroupSpec'] == 'oui' );
}
?>
