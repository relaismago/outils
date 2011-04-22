<?
require_once("conf.php");
require_once("fonction_affichage.php");
include("../top.php");

/*---------------------------------------------------------------*/
/*                      ENTETE DE LA PAGE HTML                   */
/*---------------------------------------------------------------*/
AfficheEnTete("Bienvenue sur le GGC","'file:images/retour2_over.gif'");

/*---------------------------------------------------------------*/
/*                      PAGE                                     */
/*---------------------------------------------------------------*/	


AfficheConfirmation("Bienvenue","Connexion","A partir de maintenant pour accèder au GGC<br>" .
		"il faut passer par le lien dans la VUE 2D,<br>" .
		"Merci<br>","<a href=../index.php>Me connecter sur la VUE2D</a>" .
				"<br><br><a href=inscription.php>Je veux m'inscrire au GGC !</a>");


/*-----------------------------------------------------------------*/
/*	                PIED DE LA PAGE HTML                           */
/*-----------------------------------------------------------------*/
AfficheBasPage ();

?>
