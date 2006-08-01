<?php
require_once("conf.php");
require_once("fonction_affichage.php");
require_once("fonction_connexion.php");
include("../top.php");

$action = $_POST[action];
$id_monstre = $_POST[id_monstre];
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
AfficheEnTete("Ajout d'un monstre","'file:images/retour2_over.gif'");

switch($action) {
/*-----------------------------------------------------------------*/
/*	ENVOI DU FORMULAIRE EN BASE                                    */
/*-----------------------------------------------------------------*/
    case "add":
//Tests de Validité des données saisies
//L'identifiant doit être un nombre :
if (!ereg("^[0-9]+$",$id_monstre)) {
	AfficheErreur("Ajout d'un monstre à suivre par le Groupe de Chasse","Le numéro de monstre doit être composé de chiffres !");
exit;
}

//Les PV doivent être des nombres
/*if($pv_min!="" and $pv_max!=""){
	if (!ereg("^[0-9]+$",$pv_min) and !ereg("^[0-9]+$",$pv_max)) {
		AfficheErreur("Ajout d'un monstre à suivre par le Groupe de Chasse","Les PV doivent être composés de chiffres !");
	exit;
	}
}else{
//si ce n'est pas saisi alors on met 0
	$pv_min=0;
	$pv_max=0;
}*/

//Tests sur les champs obligatoires
if($id_monstre==""){
	AfficheErreur("Ajout d'un monstre à suivre par le Groupe de Chasse","Il faut saisir un numéro de monstre pour l'ajouter !");
exit;
}
if($nom_monstre==""){
	AfficheErreur("Ajout d'un monstre à suivre par le Groupe de Chasse","Il faut saisir un nom pour le monstre pour pouvoir l'ajouter !");
exit;
}
//if($race==""){
//	AfficheErreur("Ajout d'un monstre à suivre par le Groupe de Chasse","Il faut saisir la race du monstre pour pouvoir l'ajouter !");
//exit;
//}
//if($monstre==""){
//	AfficheErreur("Ajout d'un monstre à suivre par le Groupe de Chasse","Il faut saisir le champ monstre pour pouvoir l'ajouter !");
//exit;
//}
//if($template==""){
//	AfficheErreur("Ajout d'un monstre à suivre par le Groupe de Chasse","Il faut saisir le template du monstre pour pouvoir l'ajouter !");
//exit;
//}

//Test si le monstre existe déjà dans la base
$requete=mysql_db_query($bdd,"select * from ggc_monstre where id_monstre='$id_monstre'",$db_link) or die(mysql_error());
$num=mysql_num_rows($requete);
if($num!=0){
	AfficheErreur("Ce monstre est déjà suivis par un groupe de chasse ... <br>Trouvez vous un autre gibier !");	
	exit;
}

//Chargement en base des infos (TABLE GGC_MONSTRES)
$date=mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
$sql = "insert into ggc_monstre (id_monstre,nom_monstre,date_maj) values ($id_monstre,'$nom_monstre',$date);";
$requete=mysql_db_query($bdd,$sql,$db_link) or die(mysql_error());
//Chargement en base des infos (TABLE GGC_EVT)
	//Récupération du groupe du troll
$requete=mysql_db_query($bdd,"select * from ggc_troll where id_troll=$id_troll",$db_link) or die(mysql_error());
$id_groupe = mysql_result($requete,0,"id_groupe");
	//maj de la table
$sql = "insert into ggc_evt (id_groupe,id_troll,date_maj,type_evt,texte_evt,pv,id_monstre) values ($id_groupe,$id_troll,$date,'Ajout','Ajout du monstre',0,$id_monstre);";
$requete=mysql_db_query($bdd,$sql,$db_link) or die(mysql_error());


//Affichage de la page de confirmation
AfficheConfirmation("Ajout d'un monstre à suivre par le Groupe de Chasse","Ajout réussi!","Le monstre a bien été ajouté à la liste !","<a href=groupe.php?id=$id>Un petit clic ici pour retourner au groupe !</a>");

    break;

/*-----------------------------------------------------------------*/
/*	AFFICHAGE DU FORMULAIRE DE SAISIE DU MONSTRE                    */
/*-----------------------------------------------------------------*/
    default:
    
    echo "<center>\n";
	echo "<H1>Ajout d'un monstre à suivre par le Groupe de Chasse</H1>\n";
	echo "<table width='75%' border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'>";
	echo "<tr class='mh_tdtitre'><td>";
	echo "<table border='0' class='mh_tdborder' cellpadding='0' cellspacing='1' width='100%' align='center'>";
	echo "<form action='ajouter_monstre.php?id=".$id."' method='post'>";
	echo "<input type='hidden' name='action' value='add'>";
	
	echo "<tr valign='middle' class='mh_tdtitre'>";
	echo "<td height='35' width='100%' align='center' >Données MH<br>Au boulot ! Faut saisir pour l'instant !</TD>";
	echo "</tr>";
	
	echo "<tr valign='middle' class='mh_tdpage'>";
	echo "<td width='100%' align='center'><br>";
	echo "Identifiant du monstre <b>*</b><br><input name='id_monstre' type='text' maxlength='10' class='mh_selectbox'><br><br>";
	echo "Nom du  monstre <b>*</b><br><input name='nom' type='text' maxlength='100' class='mh_selectbox'><br><br>";
//	echo "PV minimum<br><input name='pv_min' type='text' maxlength='3' class='mh_selectbox'><br><br>";
//	echo "PV maximum<br><input name='pv_max' type='text' maxlength='3' class='mh_selectbox'><br><br>";	
//	echo "Race <b>*</b><br><input name='race' type='text' maxlength='100' class='mh_selectbox'><br><em>Par exemple, la race d'un Gnou Sauvage [Jeune] c'est Gnou</em><br><br>";
//	echo "Monstre <b>*</b><br><input name='monstre' type='text' maxlength='100' class='mh_selectbox'><br><em>Par exemple, le nom du monstre d'un Gnou Sauvage [Jeune] c'est Gnou Sauvage</em><br><br>";
//	echo "Template <b>*</b><br><input name='template' type='text' maxlength='100' class='mh_selectbox'><br><em>Par exemple, le template d'un Gnou Sauvage [Jeune] c'est Jeune</em><br><br>";	
	echo "<br><em><b>Les champs marqués d'un * sont obligatoires sinon ça marche pô !</b></em>";
	echo "<br><input type='submit' name='soumettre' value='Ajouter !' class='mh_form_submit'><br>&nbsp;";
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
