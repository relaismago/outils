<?
global $Auth, $AuthTroll, $AuthGuilde;

session_start ();

include_once ( "../inc_connect.php3" );
include_once ( "inc_FM_authent.php3" );

// Affiche la boite d'authentification
function displayFormLogin ( $msg )
{
	$numTrollValue = $_COOKIE["cookie_id_troll"];
	// si on arrive sur la page de l'exterieur, on prend le cookie
	// si on boucle, on prend le controle, qui represente la valeur voulue par l'utilisateur
	if ( isset ( $_REQUEST['numTroll'] ) ) { $autologinValue = $_REQUEST['autologin']; } else { $autologinValue = $_COOKIE["autologin"]; }
	$URLStylesheet = $_GET['URLStylesheet'];
?>

	<html> <head> <link rel="stylesheet" href="<?= $URLStylesheet ?>" type="text/css"> </head> <body>
	<form name='select_troll' method='POST' action='FM_authent.php3?URLStylesheet=<?= $URLStylesheet ?>'>
	<table class="mh_tdborder" width='100%'>
	<tr class='mh_tdtitre'>
		<td colspan='6'><span class="Style1"> <?= $msg ?> </span> </td>
	</tr>
	<tr class='mh_tdtitre'>
		<td>
			numéro de troll : <input type='text' name='numTroll' size=6 value='<?= $numTrollValue ?>' class="TextboxV2">
			&nbsp; &nbsp; &nbsp; &nbsp;
			mot de passe : <input type='password' name='password' size=16 class="TextboxV2">
			&nbsp; &nbsp; &nbsp; &nbsp;
			auto-login : <input type='checkbox' name='autologin' class="TextboxV2" value="true" <?= $autologinValue ? "checked" : "" ?>>
		</td>
		<td width='*' align='right'> <input type=submit name='login' value='connexion' class="mh_form_submit"> </td>
	</tr>
	</table>
	</form>
	</body> </html>
<?
}

// ----------------------------------------
// Main
// ----------------------------------------

$numTroll = $_REQUEST['numTroll'];
$password = $_REQUEST['password'];
$submitLogout = $_REQUEST['logout'];
$submitLogin = $_REQUEST['login'];
$autologin = $_COOKIE['autologin'];
$URLStylesheet = $_GET['URLStylesheet'];
$msg = '';


// UTILISATEUR LOGGE
if ( userIsLogged () )
{
	if ( $submitLogout ) // Action utilisateur : SUBMIT LOGOUT
	{
		userLogout ();
		setcookie ( 'autologin', false, time()+365*24*3600, '/' );
		displayFormLogin ( "Vous devez vous authentifier pour utiliser les outils R&amp;M", true );
	}
	else
	{
		header ( 'Location: FM_authent_connected.php3?URLStylesheet='.$URLStylesheet );
	}
}
// UTILISATEUR NON LOGGE
else
{
	if ( isset ( $_REQUEST['numTroll'] ) && isset ( $_REQUEST['password'] ) )
	{
			setcookie ( 'autologin', $_REQUEST['autologin'], time()+365*24*3600, '/' );
			$password = md5 ( $password );
			if ( $_REQUEST['autologin'] )
			{
				setcookie ( 'hash_pass_troll', $password, time()+365*24*3600, '/' );
				setcookie ( 'num_troll', $_REQUEST['numTroll'], time()+365*24*3600, '/' );
			}
			if ( !userLogin ( $numTroll, $password ) )
			{
				// UNSET auto login
				displayFormLogin ( "Mot de passe incorrect", false );
			}
			else
			{
				header ( 'Location: FM_authent_connected.php3?URLStylesheet='.$URLStylesheet );
			}
	}
	else
	{
		if ( $autologin ) 
		{ 
			$numTroll = $_COOKIE["num_troll"];
			$password = $_COOKIE["hash_pass_troll"];
			if ( !userLogin ( $numTroll, $password ) )
      {
        // UNSET auto login
        displayFormLogin ( "Mot de passe incorrect", false );
      }
      else
      {
        header ( 'Location: FM_authent_connected.php3?URLStylesheet='.$URLStylesheet );
      }
			
		}
		else
		{
			displayFormLogin ( "Vous devez vous authentifier pour utiliser les outils R&amp;M", true );
		}
	}
}

?>
