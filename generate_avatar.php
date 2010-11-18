<?
session_start();

include_once('inc_define_vars.php');

// Taille de l'avatar
define("TAILLE_AVATAR", 110);
define("PATH_IMG", "images/avatars/");

$id_avatar = $_REQUEST[id];

if ( (md5($_REQUEST['pass']) != MD5_PASS_EXTERNE) &&
	   ($_SESSION[admin] != "authenticated") )
	die("Accès refusé");

include_once('inc_connect.php');
include_once('admin_functions_db.php');

global $db_vue_rm;

if ($_REQUEST[id]=='all')
	generate_all($_REQUEST[sombre]);
elseif ($_REQUEST[id]=='viewall')
	view_all($_REQUEST[sombre]);
else
	init_avatar($id_avatar);

@mysql_close($db_vue_rm);

function imagemergealpha($i) {

 //create a new image
 $s = imagecreatetruecolor(imagesx($i[0]),imagesy($i[1]));
 $back_color=imagecolorallocate($s,0xa9,0xb1,0xd3);
 
 //merge all images
 imagealphablending($s,true);
 $z = $i;
 while($d = each($z)) {
  imagecopy($s,$d[1],0,0,0,0,imagesx($d[1]),imagesy($d[1]));
 }
 
 //restore the transparency
 imagealphablending($s,false);
 $w = imagesx($s);
 $h = imagesy($s);
 for($x=0;$x<$w;$x++) {
  for($y=0;$y<$h;$y++) {
   $c = imagecolorat($s,$x,$y);
   $c = imagecolorsforindex($s,$c);
   $z = $i;
   $t = 0;
   while($d = each($z)) {
   $ta = imagecolorat($d[1],$x,$y);
   $ta = imagecolorsforindex($d[1],$ta);
   $t += 127-$ta['alpha'];
   }
   $t = ($t > 127) ? 127 : $t;
   $t = 127-$t;
   $c = imagecolorallocatealpha($s,$c['red'],$c['green'],$c['blue'],$t);
   imagesetpixel($s,$x,$y,$c);
  }
 }
 imagesavealpha($s,true);
 return $s;
}

function init_avatar($id_avatar)
{
  $lesTrolls = selectDbTrolls($id_avatar);
  $nbTrolls = count($lesTrolls);
  $res = $lesTrolls[1];

if ($res[nom_image_troll] == 'inconnu') {
	return;
}
	if (file_exists(PATH_IMG.$res[nom_image_troll]."_avatar.png")) {
	  $nom_image_troll = PATH_IMG.$res[nom_image_troll]."_avatar.png";	
	} else {
	  $nom_image_troll = PATH_IMG."inconnu.png";
	}
	if (file_exists(PATH_IMG.'race/'.$res[race_troll].".png")) {
	  $race_troll = PATH_IMG.'race/'.$res[race_troll].".png";	
	} else {
	  $race_troll = PATH_IMG.'distinct/'."aucune.png";
	}
	if (file_exists(PATH_IMG.'nivo/'.$res[niveau_troll].".png")) {
	  $niveau_troll = PATH_IMG.'nivo/'.$res[niveau_troll].".png";
	} else {
	  $niveau_troll = PATH_IMG.'distinct/'."aucune.png";
	}

	$rang = $res[num_rang_troll];
	$nom_image = "aucune.png";

	switch($rang) {
		case 20:
			$nom_image = "roi.png";
			break;
		case 19:
			$nom_image = "sergent.png";
			break;
		case 18:
			$nom_image = "general.png";
			break;
		case 17:
			$nom_image = "taulier.png";
			break;
		case 16:
			$nom_image = "scribe.png";
			break;
		case 15:
			$nom_image = "sergent.png";
			break;
		case 14:
			$nom_image = "happyface.png";
			break;
		case 13:
			$nom_image = "barons.png";
			break;
		case 12:
			$nom_image = "capitaines.png";
			break;
		case 11:
			$nom_image = "heros.png";
			break;
		case 10:
		case 9:
		case 8:
		case 7:
		case 6:
		case 5:
		case 4:
			break;
		case 3:
			$nom_image = "lone_ranger.png";
			break;
		case 2:
		case 1:
			break;
	}

	$nom_image_distinction = PATH_IMG.'distinct/'.$nom_image;

	//$nom_image_distinction = $res[nom_image_distinction];
	if (!file_exists($nom_image_distinction)) {
	  $nom_image_distinction = PATH_IMG.'distinct/'."aucune.png";
	}

	if ($res[niveau_troll] < 5 ) {
		$image_rang = PATH_IMG.'rang/'."tetine.png";
	} elseif ($res[niveau_troll] < 10 ){ 
		$image_rang = PATH_IMG.'distinct/'."aucune.png";
	} elseif ($res[niveau_troll] < 20 ){ 
		$image_rang = PATH_IMG.'rang/'."rang1.png";
	} elseif ($res[niveau_troll] < 30 ){
		$image_rang = PATH_IMG.'rang/'."rang2.png";
	} elseif ($res[niveau_troll] < 40 ){
		$image_rang = PATH_IMG.'rang/'."rang3.png";
	} elseif ($res[niveau_troll] < 50 ){
		$image_rang = PATH_IMG.'rang/'."rang4.png";
	} elseif ($res[niveau_troll] < 100 ){
		$image_rang = PATH_IMG.'rang/'."rang5.png";
	}

	if ($_REQUEST["sombre"] == "") {
		$images=array( 
      ImageCreateFromPng("images/avatars/fondclair.png")
    , ImageCreateFromPng("images/avatars/fond.png")
	  , ImageCreateFromPng($nom_image_troll)
	  , ImageCreateFromPng($race_troll)
	  , ImageCreateFromPng($niveau_troll)
	  , ImageCreateFromPng($nom_image_distinction)
	  , ImageCreateFromPng($image_rang)
		);
	} else {
		$images=array( 
      ImageCreateFromPng("images/avatars/fondsombre.png")
    , ImageCreateFromPng("images/avatars/fond.png")
	  , ImageCreateFromPng($nom_image_troll)
		);
	}

  $image=imagemergealpha($images);

  /* -------- Destruction ------- */
	foreach ($images as $img) {
		ImageDestroy($img);
	}

  /* -------- Génération ------- */
	/* ImagePng($image,PATH_IMG.'cache/'.$res[nom_image_troll]."_avatar.png"); */

	/* -------- Cache -------- */

	Header('Content-Type: image/gif');

	if ($_REQUEST["sombre"] == "") {
		$fondclair=ImageCreateFromPng(PATH_IMG.'fondclair.png');
	  $gifclair=imagemergealpha(array($fondclair,$image));
	  $back_color=imagecolorallocate($gifclair,0xa9,0xb1,0xd3);
		//ImageColorTransparent($gifclair,$back_color);
		ImageTrueColorToPalette($gifclair,false,256);
		ImageGif($gifclair,PATH_IMG.'cache/'.$res[nom_image_troll]."_avatar.gif");

	  //BUG PHP5 imageGif($gifclair);
		$string = file_get_contents(PATH_IMG.'cache/'.$res[nom_image_troll]."_avatar.gif");
		echo $string;

	  ImageDestroy($fondclair);
	  ImageDestroy($gifclair);

	} else {
		$fondsombre=ImageCreateFromPng(PATH_IMG.'fondsombre.png');
	  $gifsombre=imagemergealpha(array($fondsombre,$image));
	  $dark_back_color=imagecolorallocate($gifsombre,0x30,0x38,0x5c);
		//ImageColorTransparent($gifsombre,$dark_back_color);
		ImageTrueColorToPalette($gifsombre,false,256);
		ImageGif($gifsombre,PATH_IMG.'cache/'.$res[nom_image_troll]."_avatar_bleu.gif");

	  // BUG PHP5 ImageGif($gifsombre);
		$string = file_get_contents(PATH_IMG.'cache/'.$res[nom_image_troll]."_avatar_bleu.gif");
		echo $string;

	  ImageDestroy($fondsombre);
	  ImageDestroy($gifsombre);
	}

	/* -------- Affichage -------- */
	
}

function generate_all($sombre)
{

  if ($sombre=='oui') {
    update_traitement("AVATARS_SOMBRES", "EN_COURS");
  } else {
    update_traitement("AVATARS_CLAIRS", "EN_COURS");
  }

  $lesTrolls = selectDbTrolls("",ID_GUILDE);
  $nbTrolls = count($lesTrolls);

  for($i=1;$i<=$nbTrolls;$i++) {
    $res = $lesTrolls[$i];
		$rang = $res[num_rang_troll];

		if ($res[id_troll] != 11466) {
		//	if ( ( $rang != 19 && $rang != 18 && $sombre == "" ) ||
		//		 ( $sombre != "" ) ) {
				echo "<img src='generate_avatar.php?id=$res[id_troll]&sombre=$sombre&pass=".$_REQUEST['pass']."'>";
		//	}
		}
  }

  if ($sombre=='oui') {
    update_traitement("AVATARS_SOMBRES", "OK");
  } else {
    update_traitement("AVATARS_CLAIRS", "OK");
  }
}

function view_all($sombre=false)
{

  $lesTrolls = selectDbTrolls("","avatar_to_bollock");
  $nbTrolls = count($lesTrolls);

  for($i=1;$i<=$nbTrolls;$i++) {
    $res = $lesTrolls[$i];
    //echo "<img src='images/avatars/cache/$res[nom_image_troll]_avatar.png'>";

		if ($res[id_troll] != 11466 && $res[id_troll] != 18610) { 
			if ($sombre != false) {
		    echo "<img src='images/avatars/cache/$res[nom_image_troll]_avatar_bleu.gif'>";
			} else {
				//if ( ( $rang != 19 && $rang != 18 && $sombre == "" ) ||
			//		 ( $sombre != "" ) ) {
		 	 echo "<img src='images/avatars/cache/$res[nom_image_troll]_avatar.gif'>";
			}
		}
	}
}

function update_traitement($code,$etat) {
    global $db_vue_rm ;
    $date=date("Y-m-d H-i-s");
    $sql = "UPDATE traitements SET ";
    $sql .= " date_traitement= '$date', ";
    $sql .= " etat_traitement= '$etat' ";
    $sql .= " WHERE code_traitement='$code'";

    mysql_query($sql,$db_vue_rm);
    echo mysql_error();
}

?>
