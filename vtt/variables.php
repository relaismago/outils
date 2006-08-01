<?

/*--------------------------------------------------------------------------------------
VARIABLES DE CONNEXION A LA BASE DE DONNEE
--------------------------------------------------------------------------------------*/

define ("_TABLEVTT_", "vtt"); // nom de la table utilisée

/*--------------------------------------------------------------------------------------
AUTRES VARIABLES
--------------------------------------------------------------------------------------*/
$validitesession = 10000; // durée de validité de la session (1 heure hhmmss)
#$validitesession = 10; // durée de validité de la session
$pagelogin = 'accueilvisiotrollotron.php'; // page de login et de sortie
$pagelogged = 'visiotrollotron.php'; // page suivant la connexion
$noadmin = 2690;

#initialisation de la table des sorts
$sorts = array (
	'AA' => 'Analyse Anatomique',
	'AE' => 'Armure Eth&eacute;r&eacute;e',
	'AdA' => 'Augmentation de l\'Attaque',
	'AdD' => 'Augmentation des D&eacute;gats',
	'AdE' => 'Augmentation de l\'Esquive',
	'Bam' => 'Bulle d\'Anti-Magie',
	'Exp' => 'Explosion',
	'FPa' => 'Faiblesse Passag&egrave;re',
	'FAv' => 'Flash Aveuglant',
	'Glu' => 'Glue',
	'GdS' => 'Griffe du Sorcier',
	'Inv' => 'Invisibilit&eacute;',
	'Pro' => 'Projection',
	'Sac' => 'Sacrifice',
	'VlC' => 'Voir le cach&eacute;',
	'Tpt' => 'T&eacute;l&eacute;portation',
	'Tkn' => 'T&eacute;l&eacute;kin&eacute;sie',
	'VA' => 'Vision Accrue',
	'VL' => 'Vision Lointaine',
	'VT' => 'Vue Troubl&eacute;e'
	);
?>
