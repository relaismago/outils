<?php
require_once("conf.php");
require_once("fonction_affichage.php");
require_once("fonction_connexion.php");
include("../top.php");

$id_monstre = $_GET[id_monstre];
$copiercoller = $_POST[copiercoller];
$action = $_POST[action];
$choix_evt = $_POST[choix_evt];
$monstre_parse = $_POST[monstre_parse];
$pehiks = $_POST[pehiks];
$degat = $_POST[degat];
$mort = $_POST[mort];
 

// CONNEXION MYSQL
$db_link = @mysql_connect($serveur,$user,$password);
mysql_select_db($bdd);
 
$id_troll=TestSecurite();
    
/*---------------------------------------------------------------*/
/*                 RECUPERATION D'INFOS                          */
/*---------------------------------------------------------------*/
//RECHERCHE DES INFOS DU TROLL CONNECTE
$requete_troll=mysql_db_query($bdd,"select * from ggc_troll where id_troll=$id_troll",$db_link) or die(mysql_error());
$nom_troll = mysql_result($requete_troll,0,"nom_troll");    
$id_groupe = mysql_result($requete_troll,0,"ID_GROUPE");
 
//Date/heure
$date = mktime(date("H"),date("i"), date("s"), date("m"), date("d"), date("Y"));
   
/*---------------------------------------------------------------*/
/*                      ENTETE DE LA PAGE HTML                   */
/*---------------------------------------------------------------*/
AfficheEnTete("Ajout d'un évènement","'file:images/retour2_over.gif'");
 

switch($action) {
 
    case "parse":
/*-----------------------------------------------------------------*/
/* PARSAGE DES DONNEES SI BESOIN                                           */
/*-----------------------------------------------------------------*/
 
if($choix_evt=="Att."){
    //PARSAGE DE l'EVENEMENT DANS LE CAS D'UNE ATTAQUE
    $lignes = explode("\n", htmlspecialchars(stripslashes($copiercoller)));
  $i=0;
  $j=0;   
 while ($lignes[$i]){   
  if(eregi("[ \t]*Vous avez attaqu.+[ \t]*\((.+)\)",$lignes[$i],$resultat)):
   $monstre_parse = trim(htmlspecialchars($resultat[1]));
  endif;   
  if(eregi("[ \t]*Vous lui avez inflig.+[ \t](.+) points de d.+",$lignes[$i],$resultat)):
   $degats = trim(htmlspecialchars($resultat[1]));
  endif;
  if(eregi("[ \t]*perdra.+[ \t](.+) points de vie.+",$lignes[$i],$resultat)):
   $perte_pv = trim(htmlspecialchars($resultat[1]));
  endif;
  if(eregi("[ \t]*Vous l\'avez[ \t](.+).+",$lignes[$i],$resultat)):
   $mort = trim(htmlspecialchars($resultat[1]));
  endif;
  if(eregi("[ \t]*vous avez gagné un total de[ \t](.+)PX.+",$lignes[$i],$resultat)):
   $pehiks = trim(htmlspecialchars($resultat[1]));
  endif;
  $i++;
 }
 
 if($perte_pv==""){
  $perte_pv = $degats; 
 }
 if($mort != ""){
  $mort = "Oui"; 
  if($pehiks != ""){
   $pehiks = $pehiks-2;
  } 
 }else{
  $pehiks = 0;
  $mort = "Non";
 }
 
 //Si l'id du monstre n'est pas le même que celui dans l'url on rejette
 if($id_monstre != $monstre_parse){
  AfficheErreur("Ajout d'un évènement","Ce n'est pas pour le bon monstre !");
 exit;
 }


 //Dans le cas (probable) ou l'on a 
 //l'id du monstre on va chercher ces infos dans la table des monstres
 if($monstre_parse != ""){
  $requete=mysql_db_query($bdd,"select nom_monstre from ggc_monstre where id_monstre=$monstre_parse",$db_link) or die(mysql_error());
  $nom_monstre = mysql_result($requete,0,"nom_monstre");    
 }else{
  $monstre_parse = "SAISIR L'ID DU MONSTRE !"; 
 }
    //Affichage de la page de vérification
    echo "<center>\n";
 echo "<H1>Ajout d'un évènement par <br>".htmlspecialchars(stripslashes($nom_troll))."</H1>\n";
 echo "<table width='75%' border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'>";
 echo "<tr class='mh_tdtitre'><td>";
 echo "<table border='0' class='mh_tdborder' cellpadding='0' cellspacing='1' width='100%' align='center'>";
 echo "<form action='ajout_evt.php?id=".$id."' method='post'>";
 echo "<input type='hidden' name='action' value='add'>";
 echo "<tr valign='middle' class='mh_tdtitre'>";
 echo "<td height='35' width='100%' align='center'>Données MH<br>Vérification</A></TD>";
 echo "</tr>";
 echo "<tr valign='middle' class='mh_tdpage'>";
 echo "<td width='100%' align='center'>";
 echo "Monstre :<br><b>$nom_monstre</b><br><br>";
 echo "Id du monstre :<br><input name='monstre_parse' type='text' value='$monstre_parse'><br><br>";
 echo "Dégats :<br><input name='degat' type='text' maxlength='3' value='$perte_pv'><br><br>";
 echo "Mort :<br><input name='mort' type='text' maxlength='3' value='$mort'><br><br>";
 echo "Péhiks (en cas de mort, sinon 0):<br><input name='pehiks' type='text' maxlength='3' value='$pehiks'><br><br>";
 echo "&nbsp;<br><br>&nbsp;";
 echo "&nbsp;<br><INPUT TYPE='submit' NAME='soumettre' VALUE='Ca me va bien !' CLASS='mh_form_submit'><br>&nbsp;";
 echo "<br><a href='groupe.php?id=$id' onMouseOut='MM_swapImgRestore()' onMouseOver=\"MM_swapImage('retour2','','images/retour2_over.gif',1)\"><img src='images/retour2.gif' name='retour2' border='0'></a><br>";
 echo "</td>";
 echo "</tr>";
 echo "<tr>";
 echo "<td>&nbsp;</td>";
 echo "</tr>";
 echo "</form>";
 echo "</table>";
 echo "</td></tr>";
 echo "</table>";
 
}elseif($choix_evt=="Autre"){
 //CE N'EST PAS UNE ATTAQUE
 $copiercoller = htmlspecialchars(addslashes($copiercoller));
 
 if($copiercoller==""){
  AfficheErreur("Ajout d'un évènement : type Autre","Il faut saisir une description !");
  exit;
 }
 //Chargement en base et fin
 //Mise à jour de la table ggc_evt
 $sql = "insert into ggc_evt (id_groupe,id_troll,date_maj,type_evt,texte_evt,pv,id_monstre) VALUES ($id_groupe,$id_troll,$date,'$choix_evt','$copiercoller',0,$id_monstre);";
 $requete=mysql_db_query($bdd,$sql,$db_link) or die(mysql_error());
 
 //Affichage de la page de confirmation
 AfficheConfirmation("Ajout d'un évènement","Ajout réussit !","L'évènement a été ajouté.","<a href=groupe.php?id=$id>Retourner voir le groupe</a>");
 
}else{
 //Pas de choix ... on sort en erreur
 AfficheErreur("Ajout d'un évènement","Il faut saisir un type d'évènement sinon Péhachepé y sais pas comment faire !");
 exit;
}
break;
 

    case "add":
/*-----------------------------------------------------------------*/
/* AJOUT EN BASE APRES PARSAGE                                    */
/*-----------------------------------------------------------------*/
 
if($mort=="Oui") {
 $type_evt="Mort";
 $texte = "On a eu sa peau ! Dégats : $degat. Gain : $pehiks péhiks.";
}else{
 $type_evt="Att.";
 $texte = "Tiens prend ça ! Dégats : $degat.";
}
 
//Mise à jour de la table ggc_evt
$sql = "insert into ggc_evt (id_groupe,id_troll,date_maj,type_evt,texte_evt,pv,id_monstre) VALUES ($id_groupe,$id_troll,$date,'$type_evt','$texte',$degat,$monstre_parse);";
$requete=mysql_db_query($bdd,$sql,$db_link) or die(mysql_error());
//Cas d'une mort on ajoute aussi dans la table du monstre
if($mort=="Oui"){
$sql = "update ggc_groupe set NB_MONSTRES=NB_MONSTRES+1, NB_PX=NB_PX+$pehiks, DATE_MAJ=$date where ID_GROUPE=$id_groupe";
$requete=mysql_db_query($bdd,$sql,$db_link) or die(mysql_error());
}
    
//Affichage de la page de confirmation
AfficheConfirmation("Ajout d'un évènement","Ajout réussit !","L'évènement a été ajouté.","<a href=groupe.php?id=$id>Retourner voir le groupe</a>");
 
    break;
 
/*-----------------------------------------------------------------*/
/* AFFICHAGE DU FORMULAIRE DE SAISIE DE L'EVT                    */
/*-----------------------------------------------------------------*/
    default:
 
 //MENU DEROULANT
 $menu = "<select class='mh_selectbox' name=\"choix_evt\" size=\"1\" id=\"choix_evt\">";
 $menu .="<option value=\"0\" selected>--- Choix du type d'évènement ---</option>";
 $menu .="<option value=\"Att.\">Attaque</option>";
 $menu .="<option value=\"Autre\">Autre</option>";
 $menu .="</select>";
 
    echo "<center>\n";
 echo "<H1>Ajout d'un évènement par <br>".htmlspecialchars(stripslashes($nom_troll))."</H1>\n";
 echo "<table width='75%' border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'>";
 echo "<tr class='mh_tdtitre'><td>";
 echo "<table border='0' class='mh_tdborder' cellpadding='0' cellspacing='1' width='100%' align='center'>";
 echo "<form action='ajout_evt.php?id=$id&id_monstre=$id_monstre' method='post'>";
 echo "<input type='hidden' name='action' value='parse'>";
 echo "<tr valign='middle' class='mh_tdtitre'>";
 echo "<td height='35' width='100%' align='center'>Dans le cas d'une attaque <br>faire un copié/collé de l'attaque.<br>Sinon mettre un texte descriptif.</td>";
 echo "</tr>";
 echo "<tr valign='middle' class='mh_tdpage'>";
 echo "<td width='100%' align='center'>";
 echo "&nbsp;<br>$menu<br>&nbsp;";
 echo "&nbsp;<br><textarea rows='10' cols='75' name='copiercoller' class='mh_selectbox'></textarea><br>&nbsp;";
 echo "&nbsp;<br><INPUT TYPE='submit' NAME='soumettre' VALUE='On parse le zinzin...' CLASS='mh_form_submit'><br>&nbsp;";
 echo "<br><a href='groupe.php?id=$id' onMouseOut='MM_swapImgRestore()' onMouseOver=\"MM_swapImage('retour1','','images/retour2_over.gif',1)\"><img src='images/retour2.gif' name='retour1' border='0'></a><br>";
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
/*                 PIED DE LA PAGE HTML                           */
/*-----------------------------------------------------------------*/
AfficheBasPage ();
mysql_close($db_link); 
 
?>
