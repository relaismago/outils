<?php 

// Taille des pointillé en largeur
define("TAILLE_POINTILLE", 1);
// Pas du quadrillage, toutes les 10 cases
define("PAS_QUADRILLAGE", 10);
// Pas des pointillé en cases sur les axes centraux 
define("PAS_POINTILLE", PAS_QUADRILLAGE/2);


if ($_SESSION[mode_radar] == "map_write") {
	$mode_radar = "map_write";
	define("D", 25);
} elseif ($_REQUEST[mode_radar] == "radar") {
	// espace réservé à la règle et au trait noir autour de la map
	// Taille en hauteur de la zone où l'on indique les informations (nb trolls...)
	define("D", 0);

} else {
	define("TAILLE_MAP_BOTTOM", 40);
	define("D", 25);
	$mode_radar = "mode_gps";
}
	

// Taille du Hall de MountyHall
define("TAILLE_HALL", 401);

// Taille de la map (l'image)
define("TAILLE_MAP", $_REQUEST[taille_map]);


global $image;
global $placex_bottom,$placey_bottom;
global $noir,$blanc,$gris,$gris2,$vert, $vert2, $tab_bleu,$tab_jaune,$tab_rouge,$tab_vert,$tab_gris;

include_once("inc_connect.php3");
include_once("functions_auth.php");
include_once("gps_advanced_db.php3");
include_once("functions_image.php3");
include_once("admin_functions.php3");

initAuth();
	
//Envoie des en-tetes => pour que l'image s'affiche dans un navigateur en appelant le 
// script directement
//header ("Content-type: image/png");  

	$x= $_REQUEST[x];
	$y= $_REQUEST[y];
	$vue= $_REQUEST[vue];
	$quadrillage= $_REQUEST[quadrillage];
	$repere= $_REQUEST[repere];
	$viseur= $_REQUEST[viseur];
	$info_text= $_REQUEST[info_text];
	$relaismago= $_REQUEST[relaismago];
	$baronnies= $_REQUEST[baronnies];
	$tanieres_rm= $_REQUEST[tanieres_rm];
	$gowaps_rm= $_REQUEST[gowaps_rm];
	$lieux= $_REQUEST[lieux];
	$allies= $_REQUEST[allies];
	$ennemis= $_REQUEST[ennemis];
	$guilde_ennemie= $_REQUEST[guilde_ennemie];
	$champignons= $_REQUEST[champignons];
	$id_objet_depart= $_REQUEST[id_objet_depart];
	$id_objet_arrivee= $_REQUEST[id_objet_arrivee];
	$type_objet_depart= $_REQUEST[type_objet_depart];
	$type_objet_arrivee= $_REQUEST[type_objet_arrivee];

init_image($x,$y,$vue,$quadrillage,
					 $repere,$viseur,$info_text,
					 $relaismago,$baronnies,$tanieres_rm,
					 $gowaps_rm,$lieux,
					 $allies,$ennemis,
					 $guilde_ennemie,$champignons,
					 $id_objet_depart,$id_objet_arrivee,
					 $type_objet_depart,$type_objet_arrivee,
					 $mode_radar
					 );

					 
##############################################################
### Fonction principale d'initialisation de l'image ########
# info_text : taille en cases minimum pour afficher le texte sur les points
##############################################################
function init_image($x,$y,$vue,$quadrillage,$repere,$viseur,
										$info_text,$relaismago,$baronnies,$tanieres_rm,$gowaps_rm,$lieux, $allies,$ennemis,
										$guilde_ennemie,$champignons,$id_objet_depart,$id_objet_arrivee,
										$type_objet_depart,$type_objet_arrivee,$mode)
{
	global $db_vue_rm,$DEV, $image;
	global $placex_bottom,$placey_bottom;
	global $noir,$blanc,$gris,$gris2,$vert, $vert2, $tab_bleu,$tab_jaune,$tab_rouge,$tab_vert,$tab_gris;

	// cela doit être un carré
	$taille = ($vue)*2;


	// Initialisation de l'image
	if ($mode == "map_write") {
		//
	} else {
		$image = ImageCreate(TAILLE_MAP+D*2,TAILLE_MAP+D*2+TAILLE_MAP_BOTTOM);
	}

	// Initialisation des couleurs, passage des valeurs par références.
	if ($mode != "map_write")
	init_image_color();

	// On définit la couleur blanche comme transparente
	//ImageColorTransparent ($image , $blanc );

	if ($mode == "map_write") {
		// rien
	} else {
		// Fond de l'image en gris => atteint uniquement la règle
		ImageFilledRectangle($image,0,0,TAILLE_MAP+D*2,TAILLE_MAP+D*2+TAILLE_MAP_BOTTOM,$noir);
	
		// Contour du gps en noir
		ImageFilledRectangle($image,D-2,D-2,D+TAILLE_MAP+2,D+TAILLE_MAP+2,$noir);

		//Puis on initialise le fond du terrain du gps à blanc
		ImageFilledRectangle($image,D,D,TAILLE_MAP+D,TAILLE_MAP+D,$noir);

		$placex_bottom = 80;
		$placey_bottom = D*2+TAILLE_MAP+2;

	}

	// 1 case vaut combien pour le gps => produit en croix avec * 1
	$pas = TAILLE_MAP / $taille;

	if ($mode != "map_write")
		dessine_bottom($noir);
	
	// Dessine les trolls relais&mago


	if (($baronnies == "on") && ($mode != "map_write"))
		dessine_baronnies($x,$y,
											$taille,$pas,$info_text,$tab_rouge,"Baronnies");

	if (($tanieres_rm == "on") && ($mode != "map_write"))
		dessine_tanieres_rm($x,$y,
											  $taille,$pas,$info_text,$tab_rouge,"Tanières RM");

	if (($gowaps_rm == "on") && ($mode != "map_write"))
		dessine_gowaps_rm($x,$y,
											  $taille,$pas,$info_text,$tab_rouge,"Gowaps RM");

	if (($lieux != "") && ($mode != "map_write"))
		dessine_lieux($x,$y,
								  $taille,$pas,$info_text,$tab_rouge,"Lieux",$lieux);

	if (($champignons != "non") && ($mode != "map_write"))
		dessine_champignons($x,$y,
												$taille,$pas,$info_text,$tab_gris,"Champignons",$champignons);

	if ($allies == "on")
		dessine_troll($mode,$x,$y,
									$taille,$pas,$info_text,$tab_vert,"allies","Alliés");
									
	if ($relaismago == "on")
		dessine_troll($mode,$x,$y,
									$taille,$pas,$info_text,$tab_bleu,ID_GUILDE,NOM_GUILDE);

	if ($ennemis == "on")
		dessine_troll($mode,$x,$y,
									$taille,$pas,$info_text,$tab_jaune,"ennemis","Ennemis");


	if ($guilde_ennemie != "-1") {
		// Le nom des guildes ennemies peuvent varier. On met donc le texte tout en bas
		// et donc, on réinitialise placey et placex
		$nom_guilde_ennemie = selectDbGuilde($guilde_ennemie);

		$placex_bottom =80;
		$placey_bottom = (D*2+TAILLE_MAP+2)+20;

		if ($guilde_ennemie == -2) {
			$nom_guilde = "Trolls de Guildes Ennemies";
			$guilde_ennemie = "guildes_ennemies"; 
		} else {
			$nom_guilde = $nom_guilde_ennemie[1][2];
			//$guilde_ennemie = $guilde_ennemie. pour infos
		}
		dessine_troll($mode,$x,$y,
									$taille,$pas,$info_text,$tab_rouge,$guilde_ennemie,$nom_guilde);
	}

	// Si l'on veut le guide de Micheline
	if (($id_objet_depart>0) && ($id_objet_arrivee>0)) {
		dessine_trace_micheline($x,$y,$pas,$id_objet_depart,$id_objet_arrivee,
														$type_objet_depart,$type_objet_arrivee,$tab_rouge);	
	}

	if ($mode != "map_write") {
		// Initialisation des axes et des règles
		init_image_axe($x,$y,$taille,$quadrillage,$repere,
									$viseur,$pas,$vert2,$blanc,$tab_rouge[0],$tab_rouge[0],$gris2);
	
		// Génération de l'image
		ImagePng($image);
		// Desctruction de l'image
		ImageDestroy($image);
	}
}

############################
# Initialise les couleurs 
# (passage par référence)
############################
function init_image_color()
{
	global $image;
	global $noir,$blanc,$gris,$gris2,$vert, $vert2, $tab_bleu,$tab_jaune,$tab_rouge,$tab_vert,$tab_gris;

	$colorRM=array("EECC00", "CC9900", "AA7700", "884400", "552200");
	$colorTK=array("FF0000", "DD0000", "AA0000", "880000", "550000");
	$colorEN=array("F214E0","C910BA","97058B","690261","3C0137");
	$colorALL=array("00DD00","00AA00", "009900", "006600", "003300");
	$colorCHAMP=array("888888","999999", "AAAAAA", "B9B9B9", "D0D0D0");

	$noir = ImageColorAllocate($image, 0,0,0); 
	$blanc = ImageColorAllocate($image, 222,222,222); 
	$gris = ImageColorAllocate($image, 190,190,190);
	$gris2 = ImageColorAllocate($image, 140,140,140);
	$vert = ImageColorAllocate($image, 0, 255, 0);  
	$vert2 = ImageColorAllocate($image, 0, 128, 0);  

	sscanf($colorCHAMP[0], "%2x%2x%2x", $red, $green, $blue);
	$gris_0 = ImageColorAllocate($image, $red, $green, $blue); 
	
	sscanf($colorCHAMP[1], "%2x%2x%2x", $red, $green, $blue);
	$gris_1 = ImageColorAllocate($image, $red, $green, $blue);
	sscanf($colorCHAMP[2], "%2x%2x%2x", $red, $green, $blue);
	$gris_2 = ImageColorAllocate($image, $red, $green, $blue);
	sscanf($colorCHAMP[3], "%2x%2x%2x", $red, $green, $blue);
	$gris_3 = ImageColorAllocate($image, $red, $green, $blue);
	sscanf($colorCHAMP[4], "%2x%2x%2x", $red, $green, $blue);

	sscanf($colorTK[0], "%2x%2x%2x", $red, $green, $blue);
	$rouge_0 = ImageColorAllocate($image, $red, $green, $blue); 
	sscanf($colorTK[1], "%2x%2x%2x", $red, $green, $blue);
	$rouge_1 = ImageColorAllocate($image, $red, $green, $blue);
	sscanf($colorTK[2], "%2x%2x%2x", $red, $green, $blue);
	$rouge_2 = ImageColorAllocate($image, $red, $green, $blue);
	sscanf($colorTK[3], "%2x%2x%2x", $red, $green, $blue);
	$rouge_3 = ImageColorAllocate($image, $red, $green, $blue);
	sscanf($colorTK[4], "%2x%2x%2x", $red, $green, $blue);
	$rouge_4 = ImageColorAllocate($image, $red, $green, $blue);   

	sscanf($colorEN[0], "%2x%2x%2x", $red, $green, $blue);
	$jaune_0 = ImageColorAllocate($image, $red, $green, $blue);
	sscanf($colorEN[1], "%2x%2x%2x", $red, $green, $blue);
	$jaune_1 = ImageColorAllocate($image, $red, $green, $blue);
	sscanf($colorEN[2], "%2x%2x%2x", $red, $green, $blue);
	$jaune_2 = ImageColorAllocate($image, $red, $green, $blue);
	sscanf($colorEN[3], "%2x%2x%2x", $red, $green, $blue);
	$jaune_3 = ImageColorAllocate($image, $red, $green, $blue);
	sscanf($colorEN[4], "%2x%2x%2x", $red, $green, $blue);
	$jaune_4 = ImageColorAllocate($image, $red, $green, $blue);
	
	sscanf($colorALL[0], "%2x%2x%2x", $red, $green, $blue);
	$vert_0 = ImageColorAllocate($image, $red, $green, $blue);
	sscanf($colorALL[1], "%2x%2x%2x", $red, $green, $blue);
	$vert_1 = ImageColorAllocate($image, $red, $green, $blue);
	sscanf($colorALL[2], "%2x%2x%2x", $red, $green, $blue);
	$vert_2 = ImageColorAllocate($image, $red, $green, $blue);
	sscanf($colorALL[3], "%2x%2x%2x", $red, $green, $blue);
	$vert_3 = ImageColorAllocate($image, $red, $green, $blue);
	sscanf($colorALL[4], "%2x%2x%2x", $red, $green, $blue);
	$vert_4 = ImageColorAllocate($image, $red, $green, $blue);
	
	sscanf($colorRM[0], "%2x%2x%2x", $red, $green, $blue);
	$bleu_0 = ImageColorAllocate($image, $red, $green, $blue);
	sscanf($colorRM[1], "%2x%2x%2x", $red, $green, $blue);
	$bleu_1 = ImageColorAllocate($image, $red, $green, $blue);
	sscanf($colorRM[2], "%2x%2x%2x", $red, $green, $blue);
	$bleu_2 = ImageColorAllocate($image, $red, $green, $blue);
	sscanf($colorRM[3], "%2x%2x%2x", $red, $green, $blue);
	$bleu_3 = ImageColorAllocate($image, $red, $green, $blue);
	sscanf($colorRM[4], "%2x%2x%2x", $red, $green, $blue);
	$bleu_4 = ImageColorAllocate($image, $red, $green, $blue);
	
	$tab_bleu=array($bleu_0,$bleu_1,$bleu_2,$bleu_3,$bleu_4);
	$tab_jaune=array($jaune_0,$jaune_1,$jaune_2,$jaune_3,$jaune_4);
	$tab_rouge=array($rouge_0,$rouge_1,$rouge_2,$rouge_3,$rouge_4);
	$tab_vert=array($vert_0,$vert_1,$vert_2,$vert_3,$vert_4);
	$tab_gris=array($gris_0,$gris_1,$gris_2,$gris_3,$gris_4);

}

#######################################
### Initialise les axes et les règles
#######################################
function init_image_axe($x,$y,$taille,$quadrillage,$repere,$viseur,$pas,
							$gris,$gris2,$couleur_pointille,$couleur_viseur,$couleur_repere)
						//	qudrill,axe central,viseur,viseur,repere	
{
	global $image, $blanc;

	// axe central vertical
	ImageLine($image,D+TAILLE_MAP/2,D+0,D+TAILLE_MAP/2,D+TAILLE_MAP,$gris2); 

	// axe central horizontal
	ImageLine($image,D+0,D+TAILLE_MAP/2,D+TAILLE_MAP,D+TAILLE_MAP/2,$gris2); 
	
	// On définit le pas des pointillés
	$ecart_pointille = $pas * 1 ; //PAS_POINTILLE ;
	// De même pour le quadrillage
	$ecart_quadrillage = $pas * PAS_QUADRILLAGE;

	// L'utilisateur veut-il voir le quadrillage
	if ($quadrillage == "on") 
		dessine_quadrillage($gris,$ecart_quadrillage);

	dessine_axe_pointille($couleur_pointille,$ecart_pointille);
	ecrit_regle($x,$y,$taille,$blanc,$ecart_quadrillage);
	// L'utilisateur veut-il voir le quadrillage
	if ($repere == "on") 
		dessine_repere($x,$y,$taille,$ecart_quadrillage,$couleur_repere);

	if ($viseur == "on") 
		dessine_viseur($couleur_viseur);
}

####################################################
## Dessine les axes pointillés sur le centre du gps
####################################################
function dessine_axe_pointille($couleur,$ecart_pointille)
{
	global $image;

	for ($i=D; $i<=TAILLE_MAP+D; $i=$i+$ecart_pointille) {
		ImageLine($image,D+TAILLE_MAP/2-TAILLE_POINTILLE,$i,D+TAILLE_MAP/2+TAILLE_POINTILLE,$i,$couleur); // verticaux
		ImageLine($image,$i,D+TAILLE_MAP/2-TAILLE_POINTILLE,$i,D+TAILLE_MAP/2+TAILLE_POINTILLE,$couleur); // horizontaux
	}
}

################################
# Dessine le viseur (colimateur)
################################
function dessine_viseur($couleur)
{
	global $image;
	// Trait sur le cercle
	// en haut à gauche du cercle
	ImageLine($image,(D+TAILLE_MAP/2)-25,(D+TAILLE_MAP/2)-25,(D+TAILLE_MAP/2)-18,(D+TAILLE_MAP/2)-18,$couleur);
	// en bas à droite du cercle
	ImageLine($image,(D+TAILLE_MAP/2)+25,(D+TAILLE_MAP/2)+25,(D+TAILLE_MAP/2)+18,(D+TAILLE_MAP/2)+18,$couleur); 
	// en haut à droite du cercle
	ImageLine($image,(D+TAILLE_MAP/2)+25,(D+TAILLE_MAP/2)-25,(D+TAILLE_MAP/2)+18,(D+TAILLE_MAP/2)-18,$couleur); 
	// en bas à gauche du cercle
	ImageLine($image,(D+TAILLE_MAP/2)-25,(D+TAILLE_MAP/2)+25,(D+TAILLE_MAP/2)-18,(D+TAILLE_MAP/2)+18,$couleur); 

	// Crois du milieur
	// trait : \
	ImageLine($image,(D+TAILLE_MAP/2)-5,(D+TAILLE_MAP/2)-5,(D+TAILLE_MAP/2)+5,(D+TAILLE_MAP/2)+5,$couleur); 
	// trait : /
	ImageLine($image,(D+TAILLE_MAP/2)-5,(D+TAILLE_MAP/2)+5,(D+TAILLE_MAP/2)+5,(D+TAILLE_MAP/2)-5,$couleur); 
	//cercle
	ImageEllipse($image, D+TAILLE_MAP/2, D+TAILLE_MAP/2, 50, 50, $couleur);
}

#########################
## Quadrillage
#########################
function dessine_quadrillage($gris,$ecart_quadrillage)
{
	global $image;
	for ($i=D; $i<=TAILLE_MAP+D; $i=$i+$ecart_quadrillage) {
		ImageLine($image,$i,D+0,$i,D+TAILLE_MAP,$gris); // axes verticaux
		ImageLine($image,D+0,$i,D+TAILLE_MAP,$i,$gris); // axes horizontaux
	}
}

###############################################
## Dessine un repere avec pour centre x=0, y=0
###############################################
function dessine_repere($x,$y,$taille,$ecart_quadrillage,$couleur_repere)
{
	global $image;
	// axe vertical
	ImageLine($image,D+(TAILLE_MAP/2)-($x*$ecart_quadrillage/10),D+0,
									 D+(TAILLE_MAP/2)-($x*$ecart_quadrillage/10),D+TAILLE_MAP,$couleur_repere); 
	// axe horizontal
	ImageLine($image,D+0,D+(TAILLE_MAP/2)-(-$y*$ecart_quadrillage/10),
									 D+TAILLE_MAP,D+(TAILLE_MAP/2)-(-$y*$ecart_quadrillage/10),$couleur_repere); 
}

##########################
## Ecrit la Règle 
##########################
function ecrit_regle($x,$y,$taille,$noir,$ecart_quadrillage)
{
	global $image;
	$px=0;
	$px2 = 0;
	$py=0;
	$p=0;
	
	for ($i=D; $i<=TAILLE_MAP+D; $i=$i+$ecart_quadrillage) {
		// Position du texte, une fois en haut, une fois en bas pour éviter le chevauchement
		if ($py == 10)
			$py=0;
		else
			$py=10;
		
		// réglage de la position px pour que le texte soit Pile au dessus de la ligne de 
		// quadrillage correspondant
		$textx = ((-$taille/2)+PAS_QUADRILLAGE*$p) + $x ;
		$texty = ((-$taille/2)+PAS_QUADRILLAGE*$p) - $y;

		if ($textx <=-100) {
			$px = -10; $px2 = 6;
		} elseif ($textx <=-10) {
			$px = -8; $px2 = 11;
		} elseif ($textx <0) {
			$px = -3; $px2 = 8;
		} elseif ($textx ==0) {
			$px = -0.5; $px2 = 16;
		} elseif ($textx >=100) {
			$px = -8; $px2 = 1;
		} elseif ($textx >=10) {
			$px = -5; $px2 = 6;
		}
			
		ImageString($image, 1, $i+$px, $py, $textx, $noir); // règle horizontale
		ImageString($image, 1, $i+$px, TAILLE_MAP+D+15-$py, $textx, $noir); // règle horizontale

		ImageString($image, 1, 0+3, $i-4, -$texty, $noir); // règle verticale 
		ImageString($image, 1, TAILLE_MAP+D+5, $i-4, -$texty, $noir); // règle verticale 
		$p++;
	}
}

#####################################
# Dessine des trolls 
#####################################
function dessine_troll($mode,$x,$y,$taille,
											 $pas,$info_text,$tab_couleur,$guilde,$info)
{
	global $image;
	$x_min = $x - $taille/2;
	$x_max = $x + $taille/2;
	$y_min = $y - $taille/2;
	$y_max = $y + $taille/2;

	$lesTrolls = selectDbGpsTrolls($x_min,$x_max,$y_min,$y_max,$guilde);
	$nbTrolls = count($lesTrolls);

  for($i=1;$i<=$nbTrolls;$i++) {
    $res = $lesTrolls[$i];
    if($res[z_troll]=='0') {
      $z = 0;
    } else {
      $z = $res[z_troll];
    }
    if($res[delai]<1) {
      $level=0;
    } elseif($res[delai]<2) {
      $level=1;
    } else if($res[delai]<3) {
      $level=2;
    } else if($res[delai]<5) {
      $level=3;
    } else {
      $level=4;
    }
		
		// Combien vaut x et y pour la map
		$x_map =  D+(TAILLE_MAP/2)-$x*$pas+($pas*$res[x_troll]);
		$y_map =  D+(TAILLE_MAP/2)+$y*$pas-($pas*$res[y_troll]);

    $id_troll = $res[id_troll];
    $nom_troll = $res[nom_troll];
    $race_troll = $res[race_troll];
    $niveau_troll = $res[niveau_troll];
    $x_troll = $res[x_troll];
    $y_troll = $res[y_troll];
    $z_troll = $res[z_troll];
    $date_troll = $res[date_troll];

		if ($mode=="map_write") {
	    $text = "<center><h3><font color=red>".htmlentities(addslashes($nom_troll));
			$text .= " N° $id_troll</font><font color=white> $race_troll ($niveau_troll)</font></h3>";
	    $text .= "<font color=white>Position  : X=$x_troll, Y=$y_troll, Z=$z_troll (";
	    $text .= date("d/m/Y H:i",$res[date_troll]);
	    $text .= ")<br>";
	    $text .= afficherLien("troll","fiche",$id_troll,$x_troll,$y_troll,$z_troll,"[RG]",false);
	    $text .= afficherLien("troll","mh_evenements",$id_troll,$x_troll,$y_troll,$z_troll,"[MH]",false);
	    $text .= afficherLien("troll","vue2d",$id_troll,$x_troll,$y_troll,$z_troll,"[Vue2d]",false);
	    $text .= afficherLien("troll","gps",$id_troll,$x_troll,$y_troll,$z_troll,"[GPS]",false);
	    if ($res[guilde_troll] != ID_GUILDE) {
	    	$text .= "<br><br>Diplomatie du troll<br>";
		    $text .= "TK : ".$res[is_tk_troll]."&nbsp;&nbsp;";
		    $text .= "Wanted : ".$res[is_tk_troll]."<br>";
		    $text .= "Guilde : ".$res[nom_guilde]."<br>";
		    $text .= "Diplomatie de la guilde :$res[statut_guilde]<br>";
	    }
	    $text .= "</font></center><br>";
	
	    echo "<area shape='circle' href='#' coords='$x_map,$y_map,8'";
	    echo " onmouseover=\"return overlib('<font color=red> <b>Clique ici !</b></font> <br>$text');\" ";
	    echo " onClick=\"return overlib('$text', STICKY, CAPTION, 'Informations', CLOSECLICK, EXCLUSIVE);\"";
	    echo " onmouseout=\"return nd();\">\n";
		
		} else {
			ImageFilledEllipse($image,$x_map,$y_map, 3, 3, $tab_couleur[$level]);

			// On affiche le nom du troll si la vue est <= 50, soit la taille <=100. 
			// et que la taille de la map est >= 400 Sinon, on voit rien
			// c'est devenu une option nommée info_text
			if (($taille<=$info_text*2) && (TAILLE_MAP >= 400)) {
				imagestring($image, 2, $x_map , $y_map,
									$res[nom_troll].'('.$res[x_troll].','.$res[y_troll].','.$z.' )', $tab_couleur[$level]);
			}
		}
	}

	if ($mode!="map_write")
		affiche_texte_bottom($info.":".$nbTrolls,$tab_couleur,$mode);
}

#####################################
# Dessine des baronnies 
#####################################
function dessine_baronnies($x,$y,$taille,
											 $pas,$info_text,$tab_couleur,$info)
{
	global $image;
	$x_min = $x - $taille/2;
	$x_max = $x + $taille/2;
	$y_min = $y - $taille/2;
	$y_max = $y + $taille/2;

	$lesBaronnies = selectDbGpsBaronnies($x_min,$x_max,$y_min,$y_max,$guilde);
	$nbBaronnies = count($lesBaronnies);

	for($i=1;$i<=$nbBaronnies;$i++) {
		$res = $lesBaronnies[$i];
		$level=3;
		
		// Combien vaut x et y pour la map
		$x_deb_map =  D+(TAILLE_MAP/2)-$x*$pas+($pas*$res[x_deb_baronnie]);
		$x_fin_map =  D+(TAILLE_MAP/2)-$x*$pas+($pas*$res[x_fin_baronnie]);
		$y_deb_map =  D+(TAILLE_MAP/2)+$y*$pas-($pas*$res[y_fin_baronnie]);
		$y_fin_map =  D+(TAILLE_MAP/2)+$y*$pas-($pas*$res[y_deb_baronnie]);

//		ImageFilledRectangle($image,280,400, 310, 570,$tab_couleur[$level]);
		ImageFilledRectangle($image,$x_deb_map,$y_deb_map, $x_fin_map, $y_fin_map, $tab_couleur[$level]);
		ImageRectangle($image,$x_deb_map,$y_deb_map, $x_fin_map, $y_fin_map, $tab_couleur[1]);

		$x_trone_map =  D+(TAILLE_MAP/2)-$x*$pas+($pas*$res[x_trone_baronnie]);
		$y_trone_map =  D+(TAILLE_MAP/2)+$y*$pas-($pas*$res[y_trone_baronnie]);
		// On affiche le nom du troll si la vue est <= 50, soit la taille <=100. 
		// et que la taille de la map est >= 400 Sinon, on voit rien
		// c'est devenu une option nommée info_text
		if (($taille<=$info_text*2) && (TAILLE_MAP >= 400)) {
			imagestring($image, 2, $x_trone_map , $y_trone_map,
								stripslashes($res[nom_baronnie]), $tab_couleur[0]);
		}
	}
	affiche_texte_bottom($info.":".$nbBaronnies,$tab_couleur);
}

function dessine_tanieres_rm($x,$y,$taille,
														 $pas,$info_text,$tab_couleur,$info)
{
	global $image;

	$x_min = $x - $taille/2;
	$x_max = $x + $taille/2;
	$y_min = $y - $taille/2;
	$y_max = $y + $taille/2;

	$lesTanieres = selectDbGpsTanieres($x_min,$x_max,$y_min,$y_max);
	$nbTanieres = count($lesTanieres);

	for($i=1;$i<=$nbTanieres;$i++) {
		$res = $lesTanieres[$i];
		if($res[z_lieu]=='0') {
			$z = 0;
		} else {
			$z = $res[z_lieu];
		}
		if($res[z_lieu]<1) {
			$level=0;
		} elseif($res[z_lieu]<2) {
			$level=1;
		} else if($res[z_lieu]<3) {
			$level=2;
		} else if($res[z_lieu]<5) {
			$level=3;
		} else {
			$level=4;
		}
		
		// Combien vaut x et y pour la map
		$x_map =  D+(TAILLE_MAP/2)-$x*$pas+($pas*$res[x_lieu]);
		$y_map =  D+(TAILLE_MAP/2)+$y*$pas-($pas*$res[y_lieu]);

		if ($taille > 40) {	
			ImageFilledEllipse($image,$x_map,$y_map, 3, 3, $tab_couleur[$level]);
		} else {

			$img_tanniere = ImageCreateFromPng("images/gps/tarmfixe.png");
			$img_t_src_w = imagesx($img_tanniere);
			$img_t_src_h = imagesy($img_tanniere);
			$img_t_dest_w = imagesx($img_tanniere)*$pas/60;
			$img_t_dest_h = imagesy($img_tanniere)*$pas/60;

			// centrage de l'image sur la position de la tanière
			$x_t_map = $x_map - ($img_t_dest_w/2);
			$y_t_map = $y_map - ($img_t_dest_h/2);

			ImageCopyResized($image,$img_tanniere, $x_t_map, $y_t_map, 0, 0,$img_t_dest_w, $img_t_dest_h,
											 $img_t_src_w, $img_t_src_h );
		}

		// On affiche le nom du troll si la vue est <= 50, soit la taille <=100. 
		// et que la taille de la map est >= 400 Sinon, on voit rien
		// c'est devenu une option nommée info_text
		if (($taille<=$info_text*2) && (TAILLE_MAP >= 400)) {
			imagestring($image, 2, $x_map , $y_map,
								$res[nom_lieu].'('.$res[x_lieu].','.$res[y_lieu].','.$z.' )', $tab_couleur[$level]);
		}
	}
	affiche_texte_bottom($info.":".$nbTanieres,$tab_couleur);
}

function dessine_gowaps_rm($x,$y,$taille,
														 $pas,$info_text,$tab_couleur,$info)
{
	global $image;

	$x_min = $x - $taille/2;
	$x_max = $x + $taille/2;
	$y_min = $y - $taille/2;
	$y_max = $y + $taille/2;

	$lesGowaps = selectDbGpsGowaps($x_min,$x_max,$y_min,$y_max);
	$nbGowaps = count($lesGowaps);

	for($i=1;$i<=$nbGowaps;$i++) {
		$res = $lesGowaps[$i];
		if($res[z_monstre]=='0') {
			$z = 0;
		} else {
			$z = $res[z_monstre];
		}
		if($res[z_monstre]<1) {
			$level=0;
		} elseif($res[z_monstre]<2) {
			$level=1;
		} else if($res[z_monstre]<3) {
			$level=2;
		} else if($res[z_monstre]<5) {
			$level=3;
		} else {
			$level=4;
		}
		
		// Combien vaut x et y pour la map
		$x_map =  D+(TAILLE_MAP/2)-$x*$pas+($pas*$res[x_monstre]);
		$y_map =  D+(TAILLE_MAP/2)+$y*$pas-($pas*$res[y_monstre]);

		if ($taille > 40) {	
			ImageFilledEllipse($image,$x_map,$y_map, 3, 3, $tab_couleur[$level]);
		} else {
			$img_gowap = ImageCreateFromPng("images/gps/gowaprm.png");
			$img_g_src_w = imagesx($img_gowap);
			$img_g_src_h = imagesy($img_gowap);
			$img_g_dest_w = imagesx($img_gowap)*$pas/50;
			$img_g_dest_h = imagesy($img_gowap)*$pas/50;

			// centrage de l'image sur la position du gowap
			$x_g_map = $x_map - ($img_g_dest_w/2);
			$y_g_map = $y_map - ($img_g_dest_h/2);

			ImageCopyResized($image,$img_gowap, $x_g_map, $y_g_map, 0, 0,$img_g_dest_w, $img_g_dest_h,
										 $img_g_src_w, $img_g_src_h );
		}

		// On affiche le nom du troll si la vue est <= 50, soit la taille <=100. 
		// et que la taille de la map est >= 400 Sinon, on voit rien
		// c'est devenu une option nommée info_text
		if (($taille<=$info_text*2) && (TAILLE_MAP >= 400)) {
			imagestring($image, 2, $x_map , $y_map,
								$res[nom_monstre].'('.$res[x_monstre].','.$res[y_monstre].','.$z.' )', $tab_couleur[$level]);
		}
	}
	affiche_texte_bottom($info.":".$nbGowaps,$tab_couleur);
}


function dessine_lieux($x,$y,$taille,
											 $pas,$info_text,$tab_couleur,$info,$nom_lieu)
{
	global $image;

	$x_min = $x - $taille/2;
	$x_max = $x + $taille/2;
	$y_min = $y - $taille/2;
	$y_max = $y + $taille/2;

	$lesLieux = selectDbGpsLieux($x_min,$x_max,$y_min,$y_max,$nom_lieu);
	$nbLieux = count($lesLieux);

	for($i=1;$i<=$nbLieux;$i++) {
		$res = $lesLieux[$i];
		if($res[z_lieu]=='0') {
			$z = 0;
		} else {
			$z = $res[z_lieu];
		}
		if($res[z_lieu]<1) {
			$level=0;
		} elseif($res[z_lieu]<2) {
			$level=1;
		} else if($res[z_lieu]<3) {
			$level=2;
		} else if($res[z_lieu]<5) {
			$level=3;
		} else {
			$level=4;
		}
		
		// Combien vaut x et y pour la map
		$x_map =  D+(TAILLE_MAP/2)-$x*$pas+($pas*$res[x_lieu]);
		$y_map =  D+(TAILLE_MAP/2)+$y*$pas-($pas*$res[y_lieu]);
		
		$img_file_lieux = imgLieu($res[nom_lieu]);
		
		switch ($img_file_lieux) {
			case "puit" :
				$img_file_lieux = "puit.png";
				break;
			case "geyser" :
				$img_file_lieux = "geyser.png";
				break;
			case "taniere-oqp" :
				$img_file_lieux = "tanoqp.png";
				break;
			case "taniere-vide" :
				$img_file_lieux = "tanvide.png";
				break;
			case "gowapier" :
				$img_file_lieux = "gowapier.png";
				break;
			case "portail" :
				$img_file_lieux = "portail.png";
				break;
			case "lieu" :
				$img_file_lieux = "lieu.png";
				break;
		}
		$img_lieux = ImageCreateFromPng("images/gps/$img_file_lieux");
		$img_l_src_w = imagesx($img_lieux);
		$img_l_src_h = imagesy($img_lieux);
		$img_l_dest_w = imagesx($img_lieux)*$pas/60;
		$img_l_dest_h = imagesy($img_lieux)*$pas/60;

		// centrage de l'image sur la position de la tanière
		$x_l_map = $x_map - ($img_l_dest_w/2);
		$y_l_map = $y_map - ($img_l_dest_h/2);

		ImageCopyResized($image,$img_lieux, $x_l_map, $y_l_map, 0, 0,$img_l_dest_w, $img_l_dest_h,
										 $img_l_src_w, $img_l_src_h );

		// On affiche le nom du troll si la vue est <= 50, soit la taille <=100. 
		// et que la taille de la map est >= 400 Sinon, on voit rien
		// c'est devenu une option nommée info_text
		if (($taille<=$info_text*2) && (TAILLE_MAP >= 400)) {
			imagestring($image, 2, $x_map , $y_map,
								stripslashes($res[nom_lieu]).'('.$res[x_lieu].','.$res[y_lieu].','.$z.' )', $tab_couleur[$level]);
		}
	}
	affiche_texte_bottom($info.":".$nbLieux,$tab_couleur);
}

###################################
# Dessine les champignons
###################################
function dessine_champignons($x,$y,
														 $taille,$pas,$info_text,$tab_couleur,$info,$champignons)
{
	global $db_vue_rm, $image;

	$x_min = $x - $taille/2;
	$x_max = $x + $taille/2;
	$y_min = $y - $taille/2;
	$y_max = $y + $taille/2;

	$lesChampis = selectDbChampignons($x_min,$x_max,$y_min,$y_max,$champignons);
	$nbChampis = count($lesChampis);

	for($i=1;$i<=$nbChampis;$i++) {
		$res = $lesChampis[$i];
		// Si l'on affiche uniquement les champignons que l'on voit
		// on met les couleurs suivant la positions z
		if ($champignons == 'vus') {
			if($res['z_champi']=='0') {
				$z = 0;
			} else {
				$z = $res['z_champi'];
			}
			if($res['z_champi']<1) {
				$level=0;
			} elseif($res['z_champi']<2) {
				$level=1;
			} else if($res['z_champi']<3) {
				$level=2;
			} else if($res['z_champi']<5) {
				$level=3;
			} else {
				$level=4;
			}
		} else { 
			// sinon, on met les couleurs suivant les dates
			$level=2;
		}
		
		// Combien vaut x et y pour la map
		$x_map =  D+(TAILLE_MAP/2)-$x*$pas+($pas*$res['x_champi']);
		$y_map =  D+(TAILLE_MAP/2)+$y*$pas-($pas*$res['y_champi']);
		
		ImageFilledEllipse($image,$x_map,$y_map, 3, 3, $tab_couleur[$level]);

		// On affiche la position du champignon si la vue est <= 50, soit la taille <=100. 
		// et que la taille de la map est >= 400 Sinon, on voit rien
		// c'est devenu une option nommée info_text
		//=> Illisible !
		//if (($taille<=$info_text*2) && (TAILLE_MAP >= 400)) {
		//	imagestring($image, 2, $x_map , $y_map,
		//						'('.$res[x_champi].','.$res[y_champi].','.$res[z_champi].' )', $tab_couleur[0]);
		//}
	}
	affiche_texte_bottom($info.":".$nbChampis,$tab_couleur);
}

##############################################
# Affiche un texte dans le bas de l'image. Gère les retour à la ligne
##############################################
function affiche_texte_bottom($text,$tab_couleur,$mode="")
{
	global $image;
	global $placex_bottom,$placey_bottom;

		// On affiche le nombre Total de trolls trouvés si la taille de la map est <= 400
//		if (TAILLE_MAP >= 400)
			ImageString($image, 2, $placex_bottom, $placey_bottom, $text, $tab_couleur[0]);

		// mise à jour de placex et placey (variables passées par référence)
		$placex_bottom += 100;

		// Si le texte arrive à droite, on va à la ligne en dessous
		if ($placex_bottom >= TAILLE_MAP-100) {
			$placex_bottom = 80; 
			$placey_bottom += 10;
	}
}

##################################
# Dessine le trait qui sépare le gps des infos
##################################
function dessine_bottom($couleur)
{
	global $image;
	ImageString($image, 2, 2 , TAILLE_MAP+D*2+2, 'Bison Futé:', $couleur);
	ImageLine($image, 0, TAILLE_MAP+D*2, D*2+TAILLE_MAP,TAILLE_MAP+D*2, $couleur); 	
}

###################################
# Trace un trait entre deux trolls
###################################
function dessine_trace_micheline($x,$y,$pas,$id_objet_depart,$id_objet_arrivee,
																 $type_objet_depart,$type_objet_arrivee,$couleur)
{
	global $image;

	$res = selectDbMicheline($id_objet_depart,$id_objet_arrivee,$type_objet_depart,$type_objet_arrivee);

	$depart = $res[0];
	$arrivee = $res[1];
	
	if (($depart[nom] != "") && ($arrivee[nom] != "")) {
		$x1_map =  D+(TAILLE_MAP/2)-$x*$pas+($pas*$depart['x']);
		$y1_map =  D+(TAILLE_MAP/2)+$y*$pas-($pas*$depart['y']);
	
		$x2_map =  D+(TAILLE_MAP/2)-$x*$pas+($pas*$arrivee['x']);
		$y2_map =  D+(TAILLE_MAP/2)+$y*$pas-($pas*$arrivee['y']);
	}
	ImageLine($image, $x1_map, $y1_map, $x2_map, $y2_map, $couleur[0]); 	
}

?>  
