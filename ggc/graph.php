<?php

header ("Content-type: image/png");

$date = $_GET[date];
$dla = $_GET[dla];
$dla2 = $_GET[dla2];
$dla3 = $_GET[dla3];
$pa = $_GET[pa];

function FinRectangle($dla,$date){
	$diff = $dla - $date;
	$diff_j = date("j",abs($diff))-1;
	$diff_h = date("H",abs($diff))-1;
	$diff_m = date("i",abs($diff));
	$diff_min = $diff_j*24*60 + $diff_h*60 + $diff_m;
	$diff_pix = ceil($diff_min/6);
	if($diff <= 0) {
		$fin_rec = 30-$diff_pix;
	}else{
		$fin_rec = 30+$diff_pix;
	}
	return $fin_rec;
}

//Calcul de la date minimum pour l'affichage
$date_min = mktime(date("H",$date)-1, 0, 0, date("m",$date), date("d",$date), date("Y",$date));

$im = @imagecreatetruecolor (400,55) or die ("Impossible de crée un flux d'image GD");
// On passe en blanc le fond de l'image
$blanc = imagecolorallocate ($im,255,255,255);
$noir = imagecolorallocate ($im,0,0,0);
$jaune1 = imagecolorallocate ($im,255,204,51); //clair
$jaune2  = imagecolorallocate ($im,204,119,51); //foncé
imagefilledrectangle ($im,0,0,400,55,$blanc);

//lignes des heures
for ($i = 1 ;$i <= (($heure + 36) - ($heure-1)) ;$i++) {
	$j = $i*10+10;
	imageline ($im,$j,0,$j,55,$noir);
}

//On affiche la DLA la plus éloignée en premier puis les autres par superposition
//en finissant par la DLA en cours
if($dla3 >= $date_min) {
	imagefilledrectangle ($im,0,20,FinRectangle($dla3,$date),35,$jaune1);
}

if($dla2 >= $date_min) {
	imagefilledrectangle ($im,0,20,FinRectangle($dla2,$date),35,$jaune2);
}

if($dla >= $date_min) {
	imagefilledrectangle ($im,0,20,FinRectangle($dla,$date),35,$jaune1);
	imagestring ($im,3,0,20,"Reste ".$pa." PA",$noir);
}

//Si toutes les DLAs sont obseletes alors on affiche un message
if($dla < $date_min and $dla2 < $date_min and $dla3 < $date_min){
imagefilledrectangle ($im,0,20,400,35,$blanc);
imagestring ($im,3,100,20,"Le profil n'est pas a jour ...",$noir);
}


imageline ($im,0,0,500,0,$noir);

imagepng ($im);
imagedestroy($im);
?>