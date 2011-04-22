<?php
require_once("conf.php");
require_once("fonction_affichage.php");
require_once("fonction_connexion.php");
include("../top.php");

$action = $_POST[action];
$id_monstre = $_POST[id_monstre];
$choix_monstre = $_POST[choix_monstre];
$nom_monstre = $_POST[nom];
$pv_min = $_POST[pv_min];
$pv_max = $_POST[pv_max];
$race = $_POST[race];
$monstre = $_POST[monstre];
$template = $_POST[template];

// CONNEXION MYSQL
$db_link = @mysql_connect($serveur,$user,$password);
mysql_select_db($bdd);

$id_troll=TestSecurite();

/*---------------------------------------------------------------*/
/*                      ENTETE DE LA PAGE HTML                   */
/*---------------------------------------------------------------*/
AfficheEnTete("Modification des données d'un monstre","'file:images/retour2_over.gif'");

switch($action) {
/*-----------------------------------------------------------------*/
/*	ENVOI DU FORMULAIRE EN BASE                                    */
/*-----------------------------------------------------------------*/
    case "add":
//Tests de Validité des données saisies
//Les PV doivent être des nombres
if($pv_min!="" and $pv_max!=""){
	if (!ereg("^[0-9]+$",$pv_min) and !ereg("^[0-9]+$",$pv_max)) {
		AfficheErreur("Les PV doivent être composés de chiffres !");
	exit;
	}
}else{
//si ce n'est pas saisi alors on met 0
	$pv_min=0;
	$pv_max=0;
}

//Tests sur les champs obligatoires
if($nom_monstre==""){
	AfficheErreur("Modification des données d'un monstre","Il faut saisir un nom pour le monstre pour pouvoir l'ajouter !");
exit;
}
if($race==""){
	AfficheErreur("Modification des données d'un monstre","Il faut saisir la race du monstre pour pouvoir l'ajouter !");
exit;
}
if($monstre==""){
	AfficheErreur("Modification des données d'un monstre","Il faut saisir le champ monstre pour pouvoir l'ajouter !");
exit;
}
if($template==""){
	AfficheErreur("Modification des données d'un monstre","Il faut saisir le template du monstre pour pouvoir l'ajouter !");
exit;
}

//Chargement en base des infos
$date=mktime(date("H"), date("i"), 0, date("m"), date("d"), date("Y"));

$sql = "UPDATE ggc_monstre SET NOM_MONSTRE='$nom_monstre', PV_MIN=$pv_min, PV_MAX=$pv_max, RACE='$race', MONSTRE='$monstre', TEMPLATE='$template', DATE_MAJ=$date WHERE ID_MONSTRE = $id_monstre";
$requete=mysql_db_query($bdd,$sql,$db_link) or die(mysql_error());


//Affichage de la page de confirmation
AfficheConfirmation("Modification des données d'un monstre","Modifications effectuées ! !","Le monstre a été modifié !","<a href=groupe.php?id=$id>Un petit clic ici pour retourner au groupe !</a>");

    break;

/*-----------------------------------------------------------------*/
/*	MODIF DES CARACTERISTIQUES DU MONSTRE                          */
/*-----------------------------------------------------------------*/
    case "modif":
	
    //Recup des infos du monstre
	$requete=mysql_db_query($bdd,"select * from ggc_monstre where id_monstre=$choix_monstre",$db_link) or die(mysql_error());
	$ligne = mysql_fetch_array($requete, MYSQL_NUM);

    echo "<center>\n";
	echo "<H1>Modification des données d'un monstre</H1>\n";
	echo "<table width='75%' border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'>";
	echo "<tr class='mh_tdtitre'><td>";
	echo "<table border='0' class='mh_tdborder' cellpadding='0' cellspacing='1' width='100%' align='center'>";
	echo "<form action='modifier_monstre.php?id=".$id."' method='post'>";
	echo "<input type='hidden' name='action' value='add'>";
	echo "<tr valign='middle' class='mh_tdtitre'>";
	echo "<td height='35' width='100%' align='center' >Données MH<br>Au boulot ! Faut saisir pour l'instant !</TD>";
	echo "</tr>";
	
	echo "<tr valign='middle' class='mh_tdpage'>";
	echo "<td width='100%' align='center'><br>";
	echo "<input type='hidden' name='id_monstre' value='".$ligne[0]."'>";	
	echo "Identifiant du monstre : <b>".$ligne[0]."</b><br><br>";
	echo "Nom du  monstre <b>*</b><br><input name='nom' type='text' maxlength='100' value='".$ligne[1]."'><br><br>";
	echo "PV minimum<br><input name='pv_min' type='text' maxlength='3' value='".$ligne[2]."'><br><br>";
	echo "PV maximum<br><input name='pv_max' type='text' maxlength='3' value='".$ligne[3]."'><br><br>";	
	echo "Race <b>*</b><br><input name='race' type='text' maxlength='100' value='".$ligne[4]."'><br><em>Par exemple, la race d'un Gnou Sauvage [Jeune] c'est Gnou</em><br><br>";
	echo "Monstre <b>*</b><br><input name='monstre' type='text' maxlength='100' value='".$ligne[5]."'><br><em>Par exemple, le nom du monstre d'un Gnou Sauvage [Jeune] c'est Gnou Sauvage</em><br><br>";
	echo "Template <b>*</b><br><input name='template' type='text' maxlength='100' value='".$ligne[6]."'><br><em>Par exemple, le template d'un Gnou Sauvage [Jeune] c'est Jeune</em><br><br>";	
	echo "<br><em><b>Les champs marqués d'un * sont obligatoires sinon ça marche pô !</b></em>";
	echo "<br><input type='submit' name='soumettre' value='Modifier !' class='mh_form_submit'><br>";
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


/*-----------------------------------------------------------------*/
/*	AFFICHAGE DU CHOIX DU MONSTRE                                  */
/*-----------------------------------------------------------------*/
    default:
    
    //Recup des infos des monstres
	$requete=mysql_db_query($bdd,"select * from ggc_monstre",$db_link) or die(mysql_error());
	//CREATION DU MENU DEROULANT DES MONSTRES
	$menu = "<select class='mh_selectbox' name='choix_monstre' size='1' id='choix_monstre'>";
	$menu .="<option value='0' selected>--- Choix du monstre  ---</option>";
	while ($ligne = mysql_fetch_array($requete, MYSQL_NUM)){	
	$menu .= "<option value='".$ligne[0]."'>".$ligne[0]." - ".$ligne[1]."</option>";	
	}
	$menu .="</select>";    
    
    echo "<center>\n";
	echo "<H1>Modification des données d'un monstre</H1>\n";
	echo "<table width='75%' border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'>";
	echo "<tr class='mh_tdtitre'><td>";
	echo "<table border='0' class='mh_tdborder' cellpadding='0' cellspacing='1' width='100%' align='center'>";
	echo "<form action='modifier_monstre.php?id=".$id."' method='post'>";
	echo "<input type='hidden' name='action' value='modif'>";
	echo "<tr valign='middle' class='mh_tdtitre'>";
	echo "<td height='35' width='100%' align='center' >Données MH<br>Choix du monstre à modifier</TD>";
	echo "</tr>";
	echo "<tr valign='middle' class='mh_tdpage'>";
	echo "<td width='100%' align='center'><br>";
	echo $menu;
	echo "<br>";
	echo "&nbsp;<br><INPUT TYPE='submit' NAME='soumettre' VALUE='Je veux modifier celui là !' CLASS='mh_form_submit'><br>&nbsp;";
	echo "<br><a href='groupe.php?id=$id' onMouseOut='MM_swapImgRestore()' onMouseOver='MM_swapImage('retour','','images/retour2_over.gif',1)'><img src='images/retour2.gif' name='retour' border='0'></a><br>";
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
mysql_close($db_link);

?>
