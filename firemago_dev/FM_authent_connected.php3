<?

global $Auth, $AuthTroll, $AuthGuilde;

session_start ();

include_once ( "../inc_connect.php3" );
include_once ( "inc_FM_authent.php3" );

// Affiche la boite de deconnexion
function displayFormLogout ()
{
	$URLStylesheet = $_GET['URLStylesheet'];
	?>
	
	<html> <head> <link rel="stylesheet" href="<?= $URLStylesheet ?>" type="text/css"> </head> <body>
	<form name='select_troll' method='POST' action='FM_authent.php3?URLStylesheet=<?= $URLStylesheet ?>'>
	<table class="mh_tdborder" width='100%'>
	<tr class='mh_tdpage'>
		<td align='left' class="mh_tdtitre"> Vous êtes connecté aux outils R&amp;M </td>
	</tr>
	<tr class='mh_tdpage'>
		<td align='right' class="mh_tdtitre"> <input type=submit name='logout' value='déconnexion' class="mh_form_submit"> </td>
	</tr>
	</table>
	</form>
	</body> </html>
	
	<?
	exit;
}

displayFormLogout ( );

?>
