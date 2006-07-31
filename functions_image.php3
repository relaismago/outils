<?

global $maxPA;

global $imgSizes;

$imgSizes=array('arme'      => array(40,46), 
								'armure'    => array(35,28), 
								'bidouille' => array(22,30), 
								'bottes'    => array(35,26),
								'bouclier'  => array(30,24),
								'casque'    => array(30,21),
								'compo_target'    => array(53,50),
								'gg'        => array(40,26),
								'parchemin' => array(35,23),
								'champignon' => array(35,32),
								'potion'    => array(30,35),
								'talisman'  => array(30,15),
								'tresor'    => array(40,30),

								'durak'			=> array(62,72),
								'durak-tk' => array(71,65),
								'kastar'		=> array(53,60),
								'kastar-tk'		=> array(50,64),
								'tom'				=> array(48,57),
								'tom-tk'				=> array(50,69),
								'durakRM'			=> array(62,72),
								'kastarRM'		=> array(53,60),
								'tomRM'				=> array(48,57),
								'groupe'		=> array(80,64),
								'groupeRM'		=> array(80,64),
								'groupe-malade'		=> array(80,64),
								'groupe-tk'		=> array(80,64),
								'groupeRM-malade'		=> array(80,64),
								'groupeRM-tk'		=> array(80,64),
								'groupeRM-malade-tk'		=> array(80,64),
								'groupe-malade-tk'		=> array(80,64),
								'fantome'		=> array(39,60),
								'malade'		=> array(55,46),
								'skrim'			=> array(77,58),
								'skrim-tk'			=> array(60,67),
								'skrimRM'			=> array(77,58),

								'baronnie'	=> array(34,70),
								'geyser'		=> array(54,79),
								'gowapier'	=> array(105,65),
								'oeuf'			=> array(75,63),
								'lieu'			=> array(69,80),
								'portail'		=> array(60,77),
								'puit'			=> array(120,51),
								'taniere'		=> array(80,72),
								'lac'	=> array(175,72),
								'taniereRM'	=> array(80,72),
								'taniere-oqp'	=> array(80,72),
								'taniere-vide'	=> array(80,72),
								'taniere_grande'	=> array(130,137),
								'taniere_grandeRM'	=> array(130,137),

								'dindon'		=> array(40,46),
								'dindon-plus'		=> array(40,46),
								'Animal'		=> array(57,55),
								'Demon'			=> array(52,55),
								'Humanoide'	=> array(52,58),
								'Insecte'		=> array(56,55),
								'Monstre'		=> array(46,55),
								'Mort-Vivant'	=> array(35,50),
								'tasdem'	=> array(80,64),
								'tasdem_recherche'	=> array(80,64),
								'laliche'	=> array(90,102),
								'beholder'	=> array(80,92),

								'gowap'			=> array(39,70),
								'gowap-plus'		=> array(39,70),
								'gowapRM'		=> array(39,70),
								'gowap-plusRM'		=> array(39,70),
								'inconnu'		=> array(34,51),
               );

if ($maxPA<1) $maxPA=10;

############################
# Retourne l'image d'un lieu
# WARN : il faut modifier aussi gps_advanced_img.php s'il y 
# y modifier d'un nom de fichier dans cette fonction
############################
function imgLieu($lieu) 
{
	if (preg_match("/Puit.*/",$lieu[nom],$matches)) {
		$img="puit";
	}
	elseif (preg_match("/Lac.*/",$lieu[nom],$matches)) {
		$img="lac";
	}
	elseif (preg_match("/Geyser.*/",$lieu[nom],$matches)) {
		$img="geyser";
	}
	elseif (preg_match("/Nid|Couvoir|Portail Démoniaque|Cocon|Porte d'Outre-monde/",$lieu[nom],$matches)) {
		$img="oeuf";

	} elseif (preg_match("/Tani.re de (.*)/",$lieu[nom],$matches)) {
				 
		if ($matches[1] == "trõll") {
			$img="taniere-vide";
		} else {
			// On regarde si la tanière appartient à un troll RM
			if (is_numeric($lieu[id_troll_taniere]))
				$img="taniereRM";
			else
				$img="taniere-oqp";
		}
	} elseif (preg_match("/.*\((\d+)\)$/",chop($lieu[nom]),$matches)){
		if (is_numeric($lieu[id_troll_taniere]))
			$img="taniere_grandeRM";
		else 
			$img="taniere_grande";
	} elseif (preg_match("/Gowapier de (.*)/",$lieu[nom],$matches)) {
		$img="gowapier";
	} else {
		switch ($lieu[nom]) {
			case 'Portail de Téléportation': $img="portail"; break;
			case 'Tanière de trõll': $img="taniere-vide"; break;
			default: $img="lieu"; break;
		}
	}
	return $img;
}


#############################
# Retourne l'image d'un objet
#############################
function imgObjet($nom) 
{
	switch ($nom) {
		case 'Arme (1 main)': $img="arme"; break;
		case 'Arme (2 mains)': $img="arme"; break;
		case 'Bouclier': $img="bouclier"; break;
		case 'Armure': $img="armure"; break;
		case 'Gigots de Gob': $img="gg"; break;
		case 'Potion': $img="potion"; break;
		case 'Parchemin': $img="parchemin"; break;
		case 'Bidouille': $img="bidouille"; break;
		case 'Bottes': $img="bottes"; break;
		case 'Talisman': $img="talisman"; break;
		#case 'Spécial': $img[special]="special.gif"; break;
		default: $img="tresor"; break;
	}
	return $img;
}


#############################
# Retourne l'image d'un troll
#############################
function imgTroll($troll) 
{

	if ( userIsGuilde() ) {
		if  (($troll[wanted] == 'oui') || 
				 ($troll[diplomatie] == 'ennemie') || 
				 ($troll[diplomatie]=='tk') || 
				 ($troll[tk] == 'oui'))
		{
			$is_tk="-tk";
		}

		if (($troll[guilde_troll] == ID_GUILDE) || 
				($troll[guilde]=='RELAIS&MAGO') || 
				($troll[guilde]=='RELAISamp;&MAGO') )
		{
			$is_guilde="RM";
		}
	}

	switch ($troll[race]) {  # Detection type de troll
		case 'Durakuir': $img="durak$is_guilde$is_tk"; 	break;
		case 'Kastar':   $img="kastar$is_guilde$is_tk"; break;
		case 'Tomawak':  $img="tom$is_guilde$is_tk"; 		break;
		case 'Skrim':    $img="skrim$is_guilde$is_tk"; 	break;
		default : $img="skrim"; break;
	}

	if ($troll[malade] != "") {
		$is_malade="-malade";
		$img="malade";
	}

	if ($troll[is_seen] == "non") {
		$img="fantome";
	}

	$tab["is_guilde"] = $is_guilde;
	$tab["is_malade"] = $is_malade;
	$tab["is_tk"] = $is_tk;
	$tab["img"] = $img;

	return $tab;
}


###############################
# Retourne l'image d'un monstre.
###############################
function imgStreum($streum)
{

	if ($streum[recherche]!='') {
		$img="compo_target";
		$recherche="_recherche";
	}	elseif (preg_match("/Gowap/",$streum[nom])) {
		if ($streum[id_troll_gowap] != "")
			$img="gowapRM";
		else
			$img="gowap";
	} elseif (preg_match("/Dindon/",$streum[nom])) {
		$img="dindon";
	} elseif (preg_match("/Liche/",$streum[nom])) {
		$img="laliche";
	} else {
  	switch ($streum[famille]) {
	    case 'Mort-Vivant':$img="Mort-Vivant"; break;	
	    case 'Insecte':    $img="Insecte"; break;	
	    case 'Animal':    $img="Animal"; break;	
	    case 'Démon':     $img=htmlentities("Demon"); break;	
	    case 'Humanoïde': $img=htmlentities("Humanoide"); break;	
	    case 'Monstre':   $img="Monstre"; break;	
	    default:          $img="inconnu"; break;	
		}
  }
	// Si l'on utilise la vue publique
	if ($_SESSION[AuthGuilde] != ID_GUILDE)
	    $img="Monstre";
	
	$tab["recherche"] = $recherche;
	$tab["img"] = $img;

	return $tab;
}

#################################
# Calcul du coût en PA d'un déplacement depuis i
# X,Y,Z (position du troll) vers une zone donnée.
#################################
function calcPA($X,$Y,$Z,$X2,$Y2,$Z2)
{
//	global $objetsProches,$maxPA;

	$PA2 = 0;

	# calcul direct
	$zPA=abs($Z-$Z2);
	$PA=$zPA +
	max(
		abs($X-$X2),
		abs($Y-$Y2),
		$zPA
	);

	# Calcul surface
	$zPA=abs($Z+$Z2);
	$surfPA=max(
		ceil(abs($X-$X2)/2),
		ceil(abs($Y-$Y2)/2),
		$zPA+1
	)+$zPA;
	$PA2=min($PA,$surfPA);

/*	if ($PA2<=$maxPA) {
		$objet[type]=$type;
		$tab_objets[$PA2][$type][]=$objet;
	}
	$tab[tab_objets] = $tab_objets;
	$tab[pa] = $PA2; */
	return $PA2;
}
?>
