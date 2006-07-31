<?
session_start();
define("PATH_IMG", "images/wanted/");

include_once('inc_connect.php3');
include_once('inc_define_vars.php');
include_once('functions_auth.php');
include_once('admin_functions_db.php3');

if ($_REQUEST[id]=='all') {
	if ( (md5($_REQUEST['pass']) != MD5_PASS_EXTERNE) &
     ($_SESSION[admin] != "authenticated") )
	{
  	die("Accès refusé");
	} else {
  	generate_all();
	}
} elseif ($_REQUEST[id]=='viewall') {
	//if ( userIsGuilde()  )
	  view_all();
	/*else {
		include_once('top.php');
		die("<br><br><br><h1>Veuillez vous identifier</h1>");
	}*/
} elseif (is_numeric($_REQUEST[id])) {
	if (md5($_REQUEST['pass']) != MD5_PASS_EXTERNE) {
  		die("Accès refusé");
	} else {
  		init_wanted($_REQUEST[id]);
	}
}


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

function init_wanted($id_troll)
{
  $lesTrolls = selectDbTrolls($id_troll);
  $res = $lesTrolls[1];

  $lesVengeances = selectDbVengeances($id_troll);
  $nb_vengeances = count($lesVengeances);
	
	$lesGriefs = selectDbGriefs($id_troll);
  $nb_griefs = count($lesGriefs);	

	$impact = PATH_IMG."wanted_impact_$nb_vengeances.png";

  if ($res[nom_image_troll] != "")
		$fp=@fopen($res["nom_image_troll"],"r");
	else
		$fp = false;

/*	print_r($res);
	die("test $res[nom_image_troll]");*/
  $images=array(
      ImageCreateFromPng(PATH_IMG."wanted_fond.png")
    , ImageCreateFromPng(PATH_IMG."wanted_fond.png")
		, ImageCreateFromPng(PATH_IMG."wanted_transparent.png")
    , ImageCreateFromPng($impact)
    , ImageCreateFromPng(PATH_IMG."wanted_grief_$nb_griefs.png")
//    , ImageCreateFromPng($img_tete)
 //   , ImageCreateFromPng($nom_image_distinction)
 //   , ImageCreateFromPng($image_rang)
  );

  if ($fp == false)
    $images[2]=ImageCreateFromPng(PATH_IMG."wanted_interrogation.png");
	elseif (preg_match("/.*(png|Png|PNG)/",$res["nom_image_troll"]))
    $img=ImageCreateFromJpeg($res["nom_image_troll"]);
	elseif (preg_match("/.*(jpg|jpeg|JPG|JPEG)/",$res["nom_image_troll"]))
    $img=ImageCreateFromJpeg($res["nom_image_troll"]);
	elseif (preg_match("/.*(gif|Gif|GIF)/",$res["nom_image_troll"]))
    $img=ImageCreateFromGif($res["nom_image_troll"]);
	elseif (preg_match("/.*mountyhall.*Blason_PJ*./",$res["nom_image_troll"])) {
    $img=@ImageCreateFromGif($res["nom_image_troll"]);
		if (!$img) {
    	$img=@ImageCreateFromJpeg($res["nom_image_troll"]);
			if (!$img) {
    		$img=@ImageCreateFromPng($res["nom_image_troll"]);
				if (!$img) {
					$fp = false;
				}
			}
		}
	} else {
    $images[2]=ImageCreateFromPng(PATH_IMG."wanted_interrogation.png");
		fclose($fp);
		$fp = false;
	}

	if ($fp != false) {
		$img_src_w = imagesx($img);
		$img_src_h = imagesy($img);
		$img_dest_w = 43; //150 75 33
		$img_dest_h = 55; // 231 115 55
	
		imagecopyresized	($images[2],$img,30,44,0,0,$img_dest_w,$img_dest_h,$img_src_w,$img_src_h);
		fclose($fp);
	}

	  $image=imagemergealpha($images);
	
	
  /* -------- Destruction ------- */
  foreach ($images as $img) {
    ImageDestroy($img);
  }
	putenv('GDFONTPATH=' . realpath('.'));
	$font = "Wanted";
	$font_size = 5;

	$noir = ImageColorAllocate($image, 0,0,0);
	//imagettftext($image, $font_size, 0, 10, 38, $noir, $font, $res['nom_troll']);
	 imagestring($image, 2, 10 , 30,$res['nom_troll'], $noir);
	//imagettftext($image, $font_size, 0, 10, 38, $noir, $font, $res['nom_troll']);


  /* -------- Génération ------- */
  /* ImagePng($image,PATH_IMG.'cache/'.$res[nom_image_troll]."_avatar.png"); */

  /* -------- Cache -------- */
  $fondclair=ImageCreateFromPng(PATH_IMG.'wanted_fond.png');
  $gifclair=imagemergealpha(array($fondclair,$image));
  $back_color=imagecolorallocate($gifclair,0xa9,0xb1,0xd3);

  ImageTrueColorToPalette($gifclair,false,256);

  ImageGif($gifclair,PATH_IMG."cache/wanted_$id_troll.gif");

  /* -------- Affichage -------- */
  //Header('Content-Type: image/gif');
	// BUG PHP5
  //ImageGif($gifclair);
	$string = file_get_contents(PATH_IMG."cache/wanted_$id_troll.gif");
	echo $string;

  ImageDestroy($fondclair);
  ImageDestroy($gifclair);
}

function generate_all()
{

  $lesTrolls = selectDbTrolls("","filter_wanted");
  $nbTrolls = count($lesTrolls);

  for($i=1;$i<=$nbTrolls;$i++) {
    $res = $lesTrolls[$i];
    echo "<img src='wanted.php?id=$res[id_troll]&pass=".$_REQUEST['pass']."'>";
  }
}


function view_all()
{

  $lesTrolls = selectDbTrolls("","filter_wanted");
  $nbTrolls = count($lesTrolls);

	include_once('top.php');
	?>
	<table class='mh_tdborder' width='60%' align='center'>
	  <tr>
	    <td>
	    <table width='100%' cellspacing='0'>
	      <tr class='mh_tdtitre' align="center">
	      <td>
	       <img src='images/titre_wanted.gif'> 
	      </td>
	    </tr>
	    </table>
	    </tr>
	  </td>
	</table><br>

       <table class='mh_tdborder' width='60%' align='center' >
        <tr><td>
          <table width='100%' cellspacing='0'>
            <tr class='mh_tdtitre' align="center">
              <td>
                Bien que peu nombreux, ils existent : les trolls fous qui ont fait du tort à nos membres...
								Ils sont responsables d'au moins un vol de trésor, une agression "sauvage" voire de l'assassinat de l'un de nos membres.
								Un impact de balle sera ajouté à leur fiche pour chaque vengeance obtenue...
								Si vous laissez votre curseur de souris sur leur fiche (et/ou si vous cliquez dessus), vous aurez accès à plus d'informations...
              </td>
            </tr>
          </table>
        </td></tr>
        <tr class='mh_tdpage'><td width='50%'>

    <table width="750" border="5" cellpadding="3" cellspacing="3">
			<tr>
			<?

		  for($i=1;$i<=$nbTrolls;$i++) {
		    $res = $lesTrolls[$i];
					
				$text .= "";

				if (($i-1)%8 == 0)
	      	echo "<tr>";

	      echo "<td align='center'>";
				echo "<img src='images/wanted/cache/wanted_$res[id_troll].gif' ";
				afficheInfosWanted($res[id_troll],$res[nom_troll],$res[race_troll],$res[niveau_troll],$res[x_troll],$res[y_troll],$res[z_troll],date("d/m/Y H:i",$res[date_troll]));
				echo ">"; 
				echo "</td>";

				if (($i)%8 == 0)
					echo "</tr>";
				}
			?>

			</table>
			</td>
			</tr>
		</table>
		<br><br><br><br><br><br><br><br><br><br><br>
		<?	
}

function afficheInfosWanted($id_troll,$nom_troll,$race_troll,$niveau_troll,$x_troll,$y_troll,$z_troll,$date_troll)
{

	$lesGriefs = selectDbGriefs($id_troll);
	$nbGriefs = count($lesGriefs);

	$text .= "<center><h3><font color=red>$nom_troll N° $id_troll</font><font color=white> $race_troll ($niveau_troll)</font></h3>";
	$text .= "<font color=white>Position  : X=$x_troll, Y=$y_troll, Z=$z_troll ($date_troll)</font><br>";
	$text .= afficherLien("troll","fiche",$id_troll,$x_troll,$y_troll,$z_troll,"[RG]",false);
	$text .= afficherLien("troll","mh_evenements",$id_troll,$x_troll,$y_troll,$z_troll,"[MH]",false);
	$text .= afficherLien("troll","vue2d",$id_troll,$x_troll,$y_troll,$z_troll,"[Vue2d]",false);
	$text .= afficherLien("troll","gps",$id_troll,$x_troll,$y_troll,$z_troll,"[GPS]",false);
	$text .= "</center><br>";

	$text .= "<center><b><font color=red>Liste des Griefs</font></b></center><font color=white>";
	for($i=1;$i<=$nbGriefs;$i++) {
		$res = $lesGriefs[$i];
	
		$lesTrolls = selectDbTrolls($res[troll_impacte]);
		$troll_impacte = $lesTrolls[1];

		$text .= "$res[type] : le $res[date_grief]";
		$text .= " sur ".htmlentities($troll_impacte[nom_troll])." ($troll_impacte[id_troll]) : <br>";
		$text .= htmlentities(trim($res[description]))."<br>";
	}

	$lesVengeances = selectDbVengeances($id_troll);
	$nbVengeances = count($lesVengeances);

	$text .= "</font><center><b><font color=green>Liste des Châtiements</font></b></center><font color=white>";
	for($i=1;$i<=$nbVengeances;$i++) {
		$res = $lesVengeances[$i];
	
		$lesTrolls = selectDbTrolls($res[troll_vengeur]);
		$troll_vengeur = $lesTrolls[1];

		$text .= "Le $res[date_vengeance]";
		$text .= " par $troll_vengeur[nom_troll] ($troll_vengeur[id_troll]) : <br>";
		$text .= htmlentities(trim($res[description]))."<br>";
	}
	$text .= "</font>";


//	$text = str_replace("\r","",$text);
	$text = str_replace("\r\n","<br>",$text);
	$text = addslashes($text);
	//$text = preg_replace("/\n/","<br>",$text);
  echo " onmouseover=\"return overlib('<font color=red> <b>Cliquez là où vous êtes !</b></font> <br>$text');\" ";
  echo " onclick=\"return overlib('$text', STICKY, CAPTION, 'Informations',CLOSECLICK, EXCLUSIVE);\" ";
  echo " onmouseout=\"return nd();\"";

}

?>
