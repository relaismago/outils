<?
session_start();

include_once('../inc_define_vars.php');

define("TAILLE_BARRE", 90);
define("TAILLE_HAUTEUR", 300);
   
if ( (md5($_REQUEST['pass']) != MD5_PASS_EXTERNE) &&
	($_SESSION[admin] != "authenticated") )
	die("Accès refusé");

include_once('../inc_connect.php3');
include_once('inc_functions_db_miss.php');

init_resultat_election();

global $image, $blanc, $noir, $gris , $gris2;

function init_resultat_election()
{
	global $image, $blanc, $noir, $gris, $gris2 ;

	header ("Content-type: image/png");
	$annee = $_REQUEST[annee];
	$genre = $_REQUEST[genre];
	$type = $_REQUEST[type];
	
	$lesMiss = selectDbMiss($annee, $genre, $type, "",true);

	usort($lesMiss,"callback_sort_nb_votes");
	
	$nb = count($lesMiss);

	$hauteur = TAILLE_BARRE * $nb;
	$largeur = TAILLE_HAUTEUR;
	
	$image = ImageCreate($hauteur, $largeur);
	
	// On passe en blanc le fond de l'image
	$blanc = imagecolorallocate ($image	,255,255,255);
	$noir = imagecolorallocate ($image,0,0,0);
	$gris = ImageColorAllocate($image, 190,190,190);
	$gris2 = ImageColorAllocate($image, 140,140,140);

	imagefilledrectangle ($image, 0, 0, $largeur, $hauteur,$blanc);

	$total_votes = nombre_votes_db( $annee, $genre, $type);
	dessine_nom_results_miss($lesMiss, $total_votes);

	// Génération de l'image
	ImagePng($image);

	// Desctruction de l'image
	ImageDestroy($image);

}


function dessine_nom_results_miss($lesMiss, $total_votes)
{
	global $image, $blanc, $noir, $gris, $gris2;

	for ($i=1; $i<=count($lesMiss); $i++) {
	
		$res = $lesMiss[$i];
		
		if ($i%2)
			$couleur = 	$gris;
		else
			$couleur = $gris2;
	
		$x1 = ($i - 1) * TAILLE_BARRE + 10;
		$x2 = ($i - 1) * TAILLE_BARRE + TAILLE_BARRE -10;

		$y1 = (TAILLE_HAUTEUR-45) - ( TAILLE_HAUTEUR * ($res[nb_votes] / $total_votes) ) ; //TAILLE_HAUTEUR - $res[nb_votes] * 30;
		$y2 =  TAILLE_HAUTEUR-45 ;
		
		imagefilledrectangle ($image, $x1, $y1, $x2, $y2 ,$couleur);

		imagestring ($image, 3, ($i-1) * TAILLE_BARRE + TAILLE_BARRE/2 , TAILLE_HAUTEUR - 60 , $res[nb_votes],$noir);
		/* noms */
		imagestring ($image, 3, ($i-1) * TAILLE_BARRE + 10, TAILLE_HAUTEUR - ( 30 + 13 * ($i % 2 ) ), $res[nom_troll],$noir);

	}
		imagestring ($image, 6, 3, TAILLE_HAUTEUR-15, "Nombre total de votes : ".$total_votes, $noir);

}

function callback_sort_nb_votes($a,$b)
{
	if ($a[nb_votes] == $b[nb_votes]) return 0;
	elseif ($a[nb_votes] > $b[nb_votes]) return 1;
	elseif ($a[nb_votes] < $b[nb_votes]) return -1;
}


?>
