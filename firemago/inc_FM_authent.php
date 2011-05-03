<?
require_once ("../functions_auth.php");
/**
 * Authentifie le num�ro de troll et un mot de pas hash� contre la base de donn�e, et positionne les variables de
 * session en cons�quence.
 * @return true si l'authentification a r�ussie
 * @return false si elle a �chou�e (mot de passe incorrecte ou troll inexistant)
 */
function userLogin ( $numTroll, $md5pass )
{
	global $db_vue_rm;
	// On regarde si le troll existe dans la base de donn�es
	$sql = "SELECT pass_outils_troll, guilde_troll, nom_troll";
	$sql .= " FROM trolls WHERE id_troll=$numTroll";
  	$result = mysql_query ( $sql, $db_vue_rm);
	if ( $result == false ) { return false; }
	
	list ( $DBmd5pass, $DBAuthGuilde, $DBNomTroll ) = mysql_fetch_array ( $result );
	
	if ( ( mysql_affected_rows () > 0 ) && ( $DBmd5pass != "" ) && ( $DBmd5pass == $md5pass ) )
	{
		$_SESSION['AuthTroll'] = $numTroll;
		$_SESSION['Auth'] = $md5pass;
		$_SESSION['AuthGuilde'] = $DBAuthGuilde;
		$_SESSION['AuthNomTroll'] = $DBNomTroll;
	
	if ( userIsGuilde() || userIsGroupSpec()) {
		// Controle de l'administrateur
		// Remplis la variable de session
		if ( isDbAdministration() )
		$_SESSION['admin'] = "authenticated";
		else
		$_SESSION['admin'] = "notauthorized";
		
		$_SESSION['Status']="authentified";
		setcookie ("cookie_id_troll", $_SESSION['AuthTroll'],time()+31536000); // on garde le cookie 1 an
		
		enregistre_connection( $_SESSION['AuthTroll'] );
		return true;
	} 

	} 
	return false;
}

/**
 * R�initialise les variables de session li�es � l'identit� d'un utilisateur.
 */
function userLogout ()
{
	$_SESSION['Status'] = "";
	$_SESSION['AuthTroll'] = "";
	$_SESSION['AuthGuilde'] = "";
	$_SESSION['Auth'] = "";

	session_unset ();
	session_destroy ();
}

/**
 * V�rifie si un utilisateur est authentifi� comme membre de la guilde.
 * @deprecated utiliser userIsGuilde de functions_auth.php
 */
/*
function userIsRM ()
{
	return ( $_SESSION['AuthGuilde'] == 450 );
}
*/
/**
 * Renvoie le num�ro de guilde d'un utilisateur.
 */
function userGuild ()
{
	return $_SESSION['AuthGuilde'];
}

?>
