<?
require("conf.php");
include("../top.php");

$num_troll = $_POST[num_troll];
$passe = $_POST[passe];

function RandomId($taille) {
	$lettres = "abcdefghijklmnopqrstuvwxyz0123456789";
	srand(time());
	for ($i=0;$i<$taille;$i++)
		{
		$id.=substr($lettres,(rand()%(strlen($lettres))),1);
		}
	return $id;
}

/*-----------------------------------------------------------------*/
/*	PROGRAMME PRINCIPAL			*/
/*-----------------------------------------------------------------*/

// CONNEXION A LA BASE DE DONNEE
$db_link = @mysql_connect($serveur,$user,$password);
$requete=mysql_db_query($bdd,"select id_troll,passe from ggc_membre where id_troll='$num_troll' and passe='$passe'",$db_link) or die(mysql_error());

// SI AUCUN ENREGISTREMENT NE CORRESPOND
if(mysql_num_rows($requete)==0)
	{
	// REDIRECTION VERS LA PAGE ERREUR
	header("Location:erreur.php");
	}

// SI LE LOGIN ET MOT DE PASSE SONT EXACTS	
else
	{
	$id = RandomId(20);
	// MISE A JOUR DE L'IDENTIFIANT DANS LA TABLE 
	$requete=mysql_db_query($bdd,"update ggc_membre set id='$id' where id_troll='$num_troll' and passe='$passe'",$db_link) or die(mysql_error());
	
	// REDIRECTION VERS UNE PAGE PROTEGEE AVEC L'IDENTIFIANT SERVANT DE CLE
	header("Location:accueil.php?id=$id");
	}	

// DECONNEXION MYSQL
mysql_close($db_link);
?>
