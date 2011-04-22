<?php
require_once("conf.php");
require_once("fonction_affichage.php");
require_once("fonction_connexion.php");
include("../top.php");

$action = $_POST[action];
$groupe_choix = $_POST[groupe_choix];

// CONNEXION MYSQL
$db_link = @mysql_connect($serveur,$user,$password);
mysql_select_db($bdd);

$id_troll=TestSecurite();
	
/*---------------------------------------------------------------*/
/*                      ENTETE DE LA PAGE HTML                   */
/*---------------------------------------------------------------*/
AfficheEnTete("Rejoindre un groupe","'file:images/retour2_over.gif'");
	
switch($action) {
/*-----------------------------------------------------------------*/
/*	AFFECTATION DU GROUPE AU TROLL                                 */
/*-----------------------------------------------------------------*/
case "add";

//Test groupe sélectionné
if($groupe_choix=="0"){
	AfficheErreur("Choix d'un Groupe de Chasse","Il faut choisir un groupe !");
exit;
}

//RECUPERATION DE LA DATE
$date=mktime(date("H"), date("i"), 0, date("m"), date("d"), date("Y"));

//MISE A JOUR DE LA TABLE GCC_TROLL
$sql = "update ggc_troll set date_maj = '$date', id_groupe = '$groupe_choix' where id_troll = '$id_troll';";
$requete=mysql_db_query($bdd,$sql,$db_link) or die(mysql_error());

//mise a jour de la table gcc_groupe
//on selectionne le groupe
$requete=mysql_db_query($bdd,"select * from ggc_groupe where id_groupe='$groupe_choix'",$db_link) or die(mysql_error());
$nom_groupe = mysql_result($requete,0,"nom_groupe");

//incrementation du nb de troll du groupe
$sql = "update ggc_groupe set nb_trolls=nb_trolls+1, date_maj=$date where id_groupe=$groupe_choix";
$requete=mysql_db_query($bdd,$sql,$db_link) or die(mysql_error());


//Affichage de la page de confirmation
AfficheConfirmation("rejoindre un groupe","Te voila dans un groupe !","Tu as rejoins le groupe :<br><b>".stripslashes($nom_groupe)."</b>","<a href=accueil.php?id=$id>Un petit clic ici pour retourner au menu !</a>");


break;

/*-----------------------------------------------------------------*/
/*	AFFICHAGE DU FORMULAIRE POUR REJOINDRE UN GROUPE               */
/*-----------------------------------------------------------------*/
case !"add";

$requete=mysql_db_query($bdd,"select * from ggc_groupe",$db_link) or die(mysql_error());
//CREATION DU MENU DEROULANT DES GROUPES
$menu = "<select class='mh_selectbox' name='groupe_choix' size='1' id='groupe_choix'>";
$menu .="<option value='0' selected>--- Choix du groupe  ---</option>";
while ($ligne = mysql_fetch_array($requete, MYSQL_NUM)){	
	$menu .= "<option value='".$ligne[0]."'>".stripslashes($ligne[1])."</option>";	
	}
	$menu .="</select>";

echo "<br><table width='90%' height='90%' border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'>";
echo "<tr class='mh_tdtitre'><td>";
echo "<table border='0' class='mh_tdborder' cellpadding='0' cellspacing='1' width='100%' height='100%' align='center'>";
echo "<form action='rejoindre.php?id=$id' method='post'>";
	echo "<tr valign='middle' class='mh_tdtitre'>";
	echo "<td height='35' width='100%' align='center' ><b>Rejoindre un groupe de chasse</b></TD>";
	echo "</tr>";
	echo "<tr valign='middle' class='mh_tdpage'>";
	echo "<td width='100%' align='center'>";
	echo "<input type='hidden' name='action' value='add'>";
	echo "<br><br>";
	echo $menu;
	echo "<br><br><br><br><input CLASS='mh_form_submit' type='submit' value='Et hop !\nJe rejoins ce groupe'>";
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
