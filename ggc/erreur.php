<?php
require_once("fonction_affichage.php");
include("../top.php");

/*---------------------------------------------------------------*/
/*                      ENTETE DE LA PAGE HTML                   */
/*---------------------------------------------------------------*/
echo "<html>\n";
echo "<head>\n";
echo "<meta>\n";
echo "<title>Erreur</title>\n";
echo "<link rel='stylesheet' href='css/MH_Style_Play.css' type='text/css'>\n";
echo "<body>";

//Affichage de la page de confirmation
AfficheConfirmation("Erreur","Connexion","Il faut se connecter sur le site des R&M","<a href=../index.php>Me connecter sur la VUE2D</a>");


/*-----------------------------------------------------------------*/
/*	                PIED DE LA PAGE HTML                           */
/*-----------------------------------------------------------------*/
echo "</body>";
echo "</html>";

?>
