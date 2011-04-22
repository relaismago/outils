<?php
/*
function TestSecurite($id) {
require("conf.php");
// CONNEXION MYSQL
$db_link = @mysql_connect($serveur,$user,$password);
if(!$db_link) {echo "Connexion impossible à la base de données <b>$sql_bdd</b> sur le serveur <b>$sql_server</b><br>Vérifiez les paramètres du fichier conf.php3"; exit;}
mysql_select_db($bdd);

// SELECTION DE L'ENREGISTREMENT CONTENANT L'ID EN COURS
$requete=mysql_db_query($bdd,"select * from ggc_membre where id='$id'",$db_link) or die(mysql_error());
$id_troll = mysql_result($requete,0,"id_troll");
// SI L'ID N'EXISTE PAS
if(mysql_num_rows($requete)==0)
	{
	// REDIRECTION PAGE ERREUR
	header("Location:erreur.php");
	echo $id;
	exit;
	}
mysql_free_result($requete);

return $id_troll;

}
*/

function TestSecurite() {
	require("conf.php");
	
	// CONNEXION MYSQL
	$db_link = @mysql_connect($serveur,$user,$password);

	if(!$db_link) {
		echo "Connexion impossible à la base de données <b>$sql_bdd</b> sur le serveur <b>$sql_server</b><br>Vérifiez les paramètres du fichier conf.php3"; exit;
	}
	mysql_select_db($bdd);

	if( $_SESSION['AuthTroll'] > 0 && userIsGuilde() || $_SESSION['AuthTroll'] > 0 && userIsGroupSpec() ){
	//Le troll est connecté chez R&M

	  $sql = "select id_troll from ggc_troll where id_troll='$_SESSION[AuthTroll]'";

	  $result=mysql_query($sql,$db_link);
	  echo mysql_error();
	  list($nb)=mysql_fetch_array($result);

		if($nb>0) {
			//Le troll est inscrit c'est bon	
			$id_troll = $_SESSION[AuthTroll];
			return $id_troll;
		}else{
		//Le troll n'est pas inscrit au GGC-> vers page d'inscription
			echo "<script language='JavaScript'>";
			echo "document.location.href='inscription.php'";
			echo "</script>";
			exit;
		}
		mysql_free_result($requete);
	}else{
	//Le troll n'est pas connecté R&M
			echo "<script language='JavaScript'>";
			echo "document.location.href='erreur.php'";
			echo "</script>";	
			exit;		
	}
}

?>
