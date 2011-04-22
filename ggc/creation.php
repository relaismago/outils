<?php
require_once("conf.php");
require_once("fonction_affichage.php");
require_once("fonction_connexion.php");
include("../top.php");

$action = $_POST[action];
$nom_groupe = $_POST[nom_groupe];

// CONNEXION MYSQL
$db_link = @mysql_connect($serveur,$user,$password);
mysql_select_db($bdd);

$id_troll=TestSecurite();

/*---------------------------------------------------------------*/
/*                      ENTETE DE LA PAGE HTML                   */
/*---------------------------------------------------------------*/
AfficheEnTete("Création d'un groupe","'file:images/retour2_over.gif'");

switch($action) {
/*-----------------------------------------------------------------*/
/*	CREATION DU GROUPE ET AFFECTATION DU TROLL AU GROUPE           */
/*-----------------------------------------------------------------*/
case "add";
if($nom_groupe==""){
	AfficheErreur("Création d'un groupe de chasse","Il faut saisir nom pour que cela fonctionne !");
exit;
}

$nom_groupe = addslashes($nom_groupe);

// ON VERIFIE SI CE NOM DE GROUPE EXISTE DEJA
$requete=mysql_db_query($bdd,"select * from ggc_groupe where nom_groupe='$nom_groupe'",$db_link) or die(mysql_error());
$num=mysql_num_rows($requete);
if($num!=0)
	{
	AfficheErreur("Ce groupe existe déjà ... il faut en choisir un autre !");	
	}
else
	{
	// ON RECHERCHE L'ID_GROUPE MAXIMUM DE LA TABLE
	$requete=mysql_db_query($bdd,"select max(id_groupe) from ggc_groupe",$db_link) or die(mysql_error());
	$idmax=mysql_result($requete,0,"max(id_groupe)");
	//ON INCREMENTE, ET RECUPERE LA DATE
	$idmax = $idmax + 1 ;
	$date=mktime(date("H"), date("i"), 0, date("m"), date("d"), date("Y"));
	//ON CREE LE NOUVEAU GROUPE
	$sql = "insert into ggc_groupe ( id_groupe , nom_groupe , nb_trolls , nb_monstres , nb_px , nb_gg , date_maj ) values ( '$idmax', '$nom_groupe', '1', '0', '0', '0', '$date' );";
	$requete=mysql_db_query($bdd,$sql,$db_link) or die(mysql_error());
	//le troll a un groupe de chasse maintenant
	$sql = "update ggc_troll set date_maj = '$date', id_groupe = '$idmax' where id_troll = '$id_troll';";
	$requete=mysql_db_query($bdd,$sql,$db_link) or die(mysql_error());

//Affichage de la page de confirmation
AfficheConfirmation("Création d'un Groupe de Chasse","Création réussie !","Le Groupe de chasse est créé !<br>Tu peux aller sur l'interface maintenant !<br>","<a href='accueil.php?id=$id'>Un petit clic ici pour retourner au menu !</a>");
}

break;

/*-----------------------------------------------------------------*/
/*	AFFICHAGE DU FORMULAIRE DE CREATION DE GROUPE                  */
/*-----------------------------------------------------------------*/
case !"add";	
echo "<br><table width='90%' height='90%' border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'>";
echo "<tr class='mh_tdtitre'><td>";
echo "<table border='0' class='mh_tdborder' cellpadding='0' cellspacing='1' width='100%' height='100%' align='center'>";
echo "<form action='creation.php?id=$id' method='post'>";
	echo "<tr valign='middle' class='mh_tdtitre'>";
	echo "<td height='35' width='100%' align='center' ><em>Vous serez automatiquement affecté<br>au nouveau groupe de chasse</em></TD>";
	echo "</tr>";
	echo "<tr valign='middle' class='mh_tdpage'>";
	echo "<td width='100%' align='center'>";
	echo "<input type='hidden' name='action' value='add'>";
	echo "<br>Choisit un pitit nom pour le groupe:<br><br><input type='text' name='nom_groupe' maxlength='100'><br>";
	echo "<br><br><br><input CLASS='mh_form_submit' type='submit' value='Crée ce groupe\nÔ Grand Créateur !'>";
	echo "<br><br><br><a href='accueil.php?id=$id' onMouseOut='MM_swapImgRestore()' onMouseOver=\"MM_swapImage('retour','','images/retour2_over.gif',1)\"><img src='images/retour2.gif' name='retour' border='0'></a><br>";
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
mysql_close($db_link);

?>

