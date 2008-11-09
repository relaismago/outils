<?php

session_start();

include_once('../inc_connect.php3');
/*-----------------------------------------------------------------*/
/*LES VARIABLES DU SITE
/*-----------------------------------------------------------------*/
setlocale (LC_TIME, 'fr_FR.ISO8859-1');


// SERVEUR SQL
$serveur="localhost";

// LOGIN SQL
$user=$GLOBALS['user_vue'];

// MOT DE PASSE SQL
$password=$GLOBALS['pass_vue'];

// NOM DE LA BASE DE DONNEES
$bdd=$GLOBALS['base_vue'];

// CSS
$css="/ggc/css/MH_Style_Play.css";

// répertoire des avatars
$rep_avatar = "http://www.pipeshow.net/RM/avatars/complets/";


?>
