<?php
include('../top.php');
include_once('../secure.php');

$no_troll=$_SESSION['AuthTroll']; // Id du troll connecté


/*
CETTE PAGE SERT UNIQUEMENT A METTRE A JOUR LA STRUCTURE DE LA BASE PAR DES REQUETES SPECIFIQUES
MERCI DE SUPPRIMER VOS REQUETES APRES AVOIR FAIT LA MISE A JOUR
*/

//Kasseroll : mise en place magasin public
$query = "
ALTER TABLE 'stock_tresors' CHANGE 'en_vente_troll' 'en_vente_troll' INT(10) DEFAULT NULL  
";

global $db_vue_rm;
$query_result = mysql_query($query, $db_vue_rm);


include('../foot.php');
?>
