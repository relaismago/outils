<?
require_once("conf.php");
require_once("fonction_affichage.php");
require_once("fonction_connexion.php");
include("../top.php");


$num_troll = $_POST[num_troll];
$passe_membre = $_POST[passe_membre];
$action = $_POST[action];

/*---------------------------------------------------------------*/
/*                      ENTETE DE LA PAGE HTML                   */
/*---------------------------------------------------------------*/
AfficheEnTete("Inscription","'file:images/retour2_over.gif'");


switch($action) {
/*-----------------------------------------------------------------*/
/*	CREATION DU COMPTE DANS LA BASE                                */
/*-----------------------------------------------------------------*/


case "add":
// CONNEXION A LA BASE DE DONNEE
$db_link = @mysql_connect($serveur,$user,$password);
if(!$db_link) {echo "Connexion impossible à la base de données <b>$bdd</b> sur le serveur <b>$sql_server</b><br>Vérifiez les paramètres du fichier conf.php3"; exit;}

// TEST SUR LES VALEURS SAISIES
if($passe_membre==""){
	AfficheErreur("Inscription","Vous devez choisir un mot de passe !");
exit;
}

if($num_troll==""){
	AfficheErreur("Inscription","Il faut saisir un numéro de troll pour s'inscrire !");
exit;
}
//L'ID SAISIE DOIT ETRE UN NOMBRE
if (!ereg("^[0-9]+$",$num_troll)) {
	AfficheErreur("Inscription","Le numéro de troll doit être composé de chiffres !");
exit;
}

// ON VERIFIE SI CE TROLL EXISTE DEJA
$requete=mysql_db_query($bdd,"select * from ggc_membre where id_troll='$num_troll'",$db_link) or die(mysql_error());
$num=mysql_num_rows($requete);
if($num!=0)
	{
	AfficheErreur("Inscription","Ce Troll est déjà enregistré !");
	exit;	
	}
else
	{
	// CREATION D'UN IDENTIFIANT ALEATOIRE
	$taille = 20;
	$lettres = "abcdefghijklmnopqrstuvwxyz0123456789";
	srand(time());
	for ($i=0;$i<$taille;$i++)
		{
		$id.=substr($lettres,(rand()%(strlen($lettres))),1);
		}
		
	// ON RECHERCHE L'ID MAXIMUM DE LA TABLE
	$requete=mysql_db_query($bdd,"select max(id_membre) from ggc_membre",$db_link) or die(mysql_error());
	$idmax=mysql_result($requete,0,"max(id_membre)");
	
	// insertion dans la table ggc_membre
	$idnew=$idmax+1;
	$requete=mysql_db_query($bdd,"insert into ggc_membre values ($idnew,'$id','$num_troll','$passe_membre')",$db_link) or die(mysql_error());
	// creation du troll dans la table ggc_troll
	$date=mktime(date("h"), date("i"), 0, date("m"), date("d"), date("y"));
	$sql = "insert into ggc_troll ( id_troll , nom_troll , niveau_troll , race , dla_en_cours , dla_suivante , dla_prevue , position_x , position_y , position_z , pv_actuel , pv_max , fatigue_kastar , date_maj , id_groupe ) values ( '$num_troll', null , null , null , null , null , null , null , null , null , null , null , null , $date , 0 )";
	$requete=mysql_db_query($bdd,$sql,$db_link) or die(mysql_error());
	

//Affichage de la page de confirmation
AfficheConfirmation("Inscription","Inscription à l'outil de Gestion des Groupes de Chasse des Relais&Mago","Te voila inscrit !","<a href=index.php>Un petit clic ici pour retourner la page de connexion !</a>");

	}

break;


/*-----------------------------------------------------------------*/
/*	AFFICHAGE DU FORMULAIRE D'INSCRIPTION                          */
/*-----------------------------------------------------------------*/

default:
echo "<center>\n";
echo "<H1>Inscription</H1>\n";
echo "<H2>Inscription à l'outil de Gestion des Groupes de Chasse des Relais&Mago</H2>\n";
echo "<br><table width='75%' border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'>";
echo "<tr class='mh_tdtitre'><td>";
echo "<table border='0' class='mh_tdborder' cellpadding='0' cellspacing='1' width='100%' align='center'>";
echo "<form action='inscription.php' method='post'>";
	echo "<tr valign='middle' class='mh_tdtitre'>";
	echo "<td height='35' width='100%' align='center' >On remplit tout ça vite fait !<br></TD>";
	echo "</tr>";
	echo "<tr valign='middle' class='mh_tdpage'>";
	echo "<td width='100%' align='center'>";
	echo "<input type='hidden' name='action' value='add'>";
	echo "<br>Votre numéro de troll chez MountyHall<br><input type='text' name='num_troll' value='$id_troll_session'><br>";
	echo "<br>Choisissez un mot de passe<br><input type='password' name='passe_membre'><br>";
	echo "<br><br><input CLASS='mh_form_submit' type='submit' value='Inscris moi vite !'><br>";
	echo "<br><a href='index.php' onMouseOut='MM_swapImgRestore()' onMouseOver=\"MM_swapImage('retour','','images/retour2_over.gif',1)\"><img src='images/retour2.gif' name='retour' border='0'></a><br>";
	echo "</td>";
	echo "</tr>";
	echo "<tr class='mh_tdtitre'>";
	echo "<td>&nbsp;</td>";
	echo "</tr>";
echo "</form></table>";
echo "</td></tr>";
echo "</table>";

break;
}

/*-----------------------------------------------------------------*/
/*	                PIED DE LA PAGE HTML                           */
/*-----------------------------------------------------------------*/
AfficheBasPage ();

?>

