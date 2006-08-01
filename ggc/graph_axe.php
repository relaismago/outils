<?php
header ("Content-type: image/png");

setlocale (LC_TIME, 'fr_FR.ISO8859-1');
$date = $_GET[date];

$heure = date("H",$date);
$minute = date("i",$date);
$date_f = date("j/m/Y",$date);

function Espace($chaine) {
//sert à gérer les décalage en fonction de la longueur de chaine à afficher
if(strlen($chaine)==1){
	$espace = 2;
	}else{
	$espace = 4;
	}
return $espace;
}

$im = @imagecreatetruecolor (400,50) or die ("Impossible de crée un flux d'image GD");
// On passe en blanc le fond de l'image
$blanc = imagecolorallocate ($im,255,255,255);
$noir = imagecolorallocate ($im,0,0,0);
imagefilledrectangle ($im,0,0,400,50,$blanc);

$heure_trait = $heure-2;

//L'heure actuelle
imageline ($im,30,25,30,50,$noir);
imagestring ($im,3,20,12,$heure."h",$noir);
imagestring ($im,3,0,0,$date_f,$noir);

for ($i = 1 ;$i <= (($heure + 36) - ($heure-1)) ;$i++) {
	$j = $i*10+10;
	$heure_trait = $heure_trait+1;
	//24h ça fait 0h 
	if($heure_trait==24){$heure_trait = 0;}
		
	if($heure_trait==0 and $i>3):
	// Si c'est minuit trait plus long (sauf si c'est au début ...) 
	imageline ($im,$j,25,$j,50,$noir);
	imagestring ($im,3,$j-4,12,$heure_trait."h",$noir);

	elseif($heure_trait==12 and $i>2):
	// Si c'est midi trait plus long
	imageline ($im,$j,35,$j,50,$noir);
	imagestring ($im,2,$j-7,20,$heure_trait."h",$noir);
	
	else:	
	// Sinon trait normal
	imageline ($im,$j,45,$j,50,$noir);
	if($i!=2){
	imagestring ($im,1,$j-Espace($heure_trait),35,$heure_trait,$noir);
	}
	endif;

}



imagepng ($im);
imagedestroy($im);
?>
