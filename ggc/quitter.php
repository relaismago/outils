<?php
require_once("conf.php");
require_once("fonction_affichage.php");
require_once("fonction_connexion.php");
include("../top.php");

$action = $_POST[action];

// CONNEXION MYSQL
$db_link = @mysql_connect($serveur,$user,$password);
mysql_select_db($bdd);

$id_troll=TestSecurite();

//RECUPERATION DU GROUPE DE CHASSE
$requete=mysql_db_query($bdd,"select * from ggc_troll where id_troll=$id_troll",$db_link) or die(mysql_error());
$id_groupe = mysql_result($requete,0,"id_groupe");
if($id_groupe!=0){
$requete_groupe=mysql_db_query($bdd,"select nom_groupe from ggc_groupe where id_groupe=$id_groupe",$db_link) or die(mysql_error());
$nom_groupe = mysql_result($requete_groupe,0,"nom_groupe");
}

/*---------------------------------------------------------------*/
/*                      ENTETE DE LA PAGE HTML                   */
/*---------------------------------------------------------------*/
AfficheEnTete("Quitter un groupe","'file:images/retour2_over.gif'");


switch($action) {
/*-----------------------------------------------------------------*/
/*	MISE A JOUR DE LA BASE                                         */
/*-----------------------------------------------------------------*/
case "add":

//RECUPERATION DE LA DATE
$date=mktime(date("H"), date("i"), 0, date("m"), date("d"), date("Y"));

//On met à jour la colonne de la table ggc_troll
$sql = "update ggc_troll set date_maj = '$date', id_groupe = '0' where id_troll = '$id_troll';";
$requete=mysql_db_query($bdd,$sql,$db_link) or die(mysql_error());

//on retire un membre de la table ggc_groupe
$sql = "update ggc_groupe set nb_trolls=nb_trolls-1, date_maj=$date where id_groupe=$id_groupe";
$requete=mysql_db_query($bdd,$sql,$db_link) or die(mysql_error());

//Affichage de la page de confirmation
AfficheConfirmation("Quitter un groupe de chasse","Enfin libre !","Tu as quitté le groupe :<br><b>".stripslashes($nom_groupe)."</b>","<a href=accueil.php?id=$id>Un petit clic ici pour retourner au menu !</a>");


break;

/*-----------------------------------------------------------------*/
/*	AFFICHAGE QUITTER GROUPE                                       */
/*-----------------------------------------------------------------*/
default:

echo "<br><table width='90%' height='90%' border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'>";
echo "<tr class='mh_tdtitre'><td>";
echo "<table border='0' class='mh_tdborder' cellpadding='0' cellspacing='1' width='100%' height='100%' align='center'>";
echo "<form action='quitter.php?id=$id' method='post'>";
	echo "<tr valign='middle' class='mh_tdtitre'>";
	echo "<td height='35' width='100%' align='center' >C'est la fin ...</TD>";
	echo "</tr>";
	echo "<tr valign='middle' class='mh_tdpage'>";
	echo "<td width='100%' align='center'>";
	echo "<input type='hidden' name='action' value='add'>";
	echo "<br>'C'est fini je craque ... je m'en vais de ce groupe !'<br><br>Vous allez quitter : <b>".stripslashes($nom_groupe)."</b>";
	echo "<br><br><br><input CLASS='mh_form_submit' type='submit' value='Adieu je vous aimais bien !'>";
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
