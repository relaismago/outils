<?php
require_once("conf.php");
require_once("fonction_affichage.php");
require_once("fonction_connexion.php");
include("../top.php");

$action = $_POST[action];
$choix_monstre = $_POST[choix_monstre];

// CONNEXION MYSQL
$db_link = @mysql_connect($serveur,$user,$password);
mysql_select_db($bdd);

$id_troll=TestSecurite();

/*---------------------------------------------------------------*/
/*                 RECUPERATION D'INFOS                          */
/*---------------------------------------------------------------*/
//RECHERCHE DES INFOS DU TROLL CONNECTE
$requete_groupe=mysql_db_query($bdd,"select * from ggc_troll where id_troll=$id_troll",$db_link) or die(mysql_error());
$id_groupe = mysql_result($requete_groupe,0,"id_groupe");
//recup des infos des monstres
$sql = "select ggc_monstre.id_monstre,ggc_monstre.nom_monstre " .
    		"from ggc_monstre," .
    		"ggc_groupe," .
    		"ggc_evt" .
    		" where" .
    		"( ggc_groupe.id_groupe=ggc_evt.id_groupe  )" .
    		"and  ( ggc_evt.id_monstre=ggc_monstre.id_monstre)" .
    		"and  ( ggc_groupe.id_groupe  =  $id_groupe )" .
    		"group by id_monstre;";
$requete=mysql_db_query($bdd,$sql,$db_link) or die(mysql_error());


/*---------------------------------------------------------------*/
/*                      ENTETE DE LA PAGE HTML                   */
/*---------------------------------------------------------------*/
AfficheEnTete("Enlever un monstre","'file:images/retour2_over.gif'");


switch($action) {
/*-----------------------------------------------------------------*/
/*	SUPPRESSION DU MONSTRE                                         */
/*-----------------------------------------------------------------*/
    case "sup":

//Suppression en base des infos (TABLE GGC_MONSTRES)
$date=mktime(date("H"),date("i"), date("s"), date("m"), date("d"), date("Y"));
$sql = "delete from ggc_monstre where id_monstre=$choix_monstre;";
$requete=mysql_db_query($bdd,$sql,$db_link) or die(mysql_error());
//chargement en base des infos (table ggc_evt)
	//récupération du groupe du troll
$requete=mysql_db_query($bdd,"select * from ggc_troll where id_troll=$id_troll",$db_link) or die(mysql_error());
$id_groupe = mysql_result($requete,0,"id_groupe");
	//maj de la table
$sql = "insert into ggc_evt (id_groupe,id_troll,date_maj,type_evt,texte_evt,pv,id_monstre) values ($id_groupe,$id_troll,$date,'Sup.','Suppression des monstres à suivre',0,$choix_monstre);";
$requete=mysql_db_query($bdd,$sql,$db_link) or die(mysql_error());

//Affichage de la page de confirmation
AfficheConfirmation("Enlever un monstre","Suppression réussie !","Le monstre a bien été enlevé de la liste des monstres suivis !","<a href=groupe.php?id=$id>Un petit clic ici pour retourner au groupe !</a>");

	
break;

/*-----------------------------------------------------------------*/
/*	AFFICHAGE DU CHOIX DU MONSTRE                                  */
/*-----------------------------------------------------------------*/
    default:
    
	//CREATION DU MENU DEROULANT DES MONSTRES
	$menu = "<select class='mh_selectbox' name='choix_monstre' size='1' id='choix_monstre'>";
	$menu .="<option value='0' selected>--- Choix du monstre  ---</option>";
	while ($ligne = mysql_fetch_array($requete, MYSQL_NUM)){	
	$menu .= "<option value='".$ligne[0]."'>".$ligne[0]." - ".$ligne[1]."</option>";	
	}
	$menu .="</select>";
    
    echo "<center>\n";
	echo "<H1>Enlever un monstre</H1>\n";
	echo "<table width='75%' border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'>";
	echo "<tr class='mh_tdtitre'><td>";
	echo "<table border='0' class='mh_tdborder' cellpadding='0' cellspacing='1' width='100%' align='center'>";
	echo "<form action='enlever_monstre.php?id=".$id."' method='post'>";
	echo "<input type='hidden' name='action' value='sup'>";
	echo "<tr valign='middle' class='mh_tdtitre'>";
	echo "<td height='35' width='100%' align='center'>Choix du monstre<br>à enlever de la liste.</td>";
	echo "</tr>";
	echo "<tr valign='middle' class='mh_tdpage'>";
	echo "<td width='100%' align='center'><br>";
	echo $menu;
	echo "<br><br><input type='submit' name='soumettre' value='Je ne veux plus le voir !' class='mh_form_submit'><br>&nbsp;";
	echo "<br><a href='groupe.php?id=$id' onMouseOut='MM_swapImgRestore()' onMouseOver=\"MM_swapImage('retour','','images/retour2_over.gif',1)\"><img src='images/retour2.gif' name='retour' border='0'></a><br>";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>&nbsp;</td>";
	echo "</tr>";
	echo "</form>";
	echo "</table>";
	echo "</td></tr>";
	echo "</table>";    
    
    break;
}

/*-----------------------------------------------------------------*/
/*	                PIED DE LA PAGE HTML                           */
/*-----------------------------------------------------------------*/
AfficheBasPage ();

?>
