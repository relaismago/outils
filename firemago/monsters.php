<?php
	include_once ("../functions_auth.php");
	include_once ( "../admin_functions_db.php" );
	include_once ( "../bestiaire2/Libs/functions.php" );
	include_once ( "../bestiaire2/DB/inc_initdata.php" );
	include_once ( "../easyem/easyem_functions.php" );
	include_once ( "../pimpmytroll/class/c_Troll.php" );
	include_once ( "firemago_functions.php" );
	
	if (userIsGuilde() || userIsGroupSpec()) 
	{		
	
		echo "try { \n";
		
		$arrayCaracPrim = array( "att", "esq", "deg", "reg", "arm", "vue", "dla" );
		$arrayCaracs = array_merge ( $arrayCaracPrim, array ( "pdv", "mm", "rm", "nbatt", "vitdep", "vlc", "attdist" ) );
		$carac = array ();
		$etageTroll = $_REQUEST["etageTroll"];
		$idTroll = $_SESSION["AuthTroll"];
		$monstersDists = $_REQUEST['monsterDists'];
		$monsterIds = $_REQUEST['monsterIds'];
		$monsterNames = $_REQUEST['monsterNames'];
		$monsterAges = $_REQUEST['monsterAges'];
		$monsterEtages = $_REQUEST['monsterEtages'];
		$begin = $_REQUEST['begin'];
		$arrayGuildeGowaps = getGuildGowap( $monsterIds, $db_vue_rm );
		$vttTroll = getVttTroll( $idTroll, $db_vue_rm );
		$degbm = 0;
		
		/*if ( is_file("../pimpmytroll/trolls/" .$idTroll. ".xml") ){
			$c_Troll = new c_Troll($idTroll);
			$c_Troll->getTroll();
			$c_Troll->applyEquipement();
			$degbm = $c_Troll->getVar("DégâtsBMM");	
		}*/
		
		// Regarde si le troll appartient à un ggc
		$sql = "SELECT id_groupe FROM ggc_troll WHERE id_troll = '" .$_SESSION['AuthTroll']. "' AND id_groupe != 0;";
		$query = mysql_query($sql,$db_vue_rm);
		if ( mysql_error() )
			echo "alert('".mysql_error()."');";
		if ( mysql_num_rows($query) > 0 )	
			$ggc = mysql_fetch_assoc($query);		
		
		for ( $i = 0; $i < count ($monsterIds); $i++ )
		{
			$rang = $i*2 + $begin;
			$dist = $monstersDists[$i];
		    $name = ereg_replace('[\\]',"",$monsterNames[$i]);
			$infos = getInfoFromMonstre($name);
			$caracs_moyennes = SelectCaracMoyMonstre($infos['id_race'],$infos['id_template'],$infos['id_age']);
			$caracs_spe = SelectCapSpe($infos['id_race'],$infos['id_template'],$infos['id_age']);
			$tab_cdm_mh = SelectCdM_mh($monsterIds[$i],$infos['id_race'],$infos['id_age']);
			$infos["monstre"] = addslashes($infos["monstre"]);
			$txtmonster = addslashes($monsterNames[$i]);	
			$insulte = 0;
		
			// Initialisation des variables js
			echo "
				var colortd = '';	
				anchorRow = tableMonsters[$rang];
				anchorCellID = tableMonsters[$rang].childNodes[1]; // ANCHOR
				anchorCellNiv = tableMonsters[$rang].childNodes[2]; // ANCHOR
				anchorCellDesc = tableMonsters[$rang].childNodes[3]; // ANCHOR
				anchorCellPV = tableMonsters[$rang].childNodes[4]; // ANCHOR
				monsterStyle = new String ( anchorCellDesc.getElementsByTagName ( 'a' )[0].getAttribute ( 'class' ) );
			   	$(anchorCellID).html(\"<a class='\"+monsterStyle+\"' href='javascript:EMV($monsterIds[$i] ,750,550)'>$monsterIds[$i]</a>\");	
			";
				
			$urlmonster = "URLBestiaire + escape ('" .$infos["monstre"]. "') + '&IDAge=' + escape ('" .$infos["id_age"]. "') + '&MH=$monsterIds[$i]'";
			
			$mm=$rm=$dla="";	
			if ($tab_cdm_mh)
			{
				$last_cdm = count($tab_cdm_mh)-1;
				$titre = "cdm recoupées du monstre au ".$tab_cdm_mh[$last_cdm]['date_cdm'];
				$colPV = ($tab_cdm_mh[$last_cdm]['nbj_cdm'] > 5) ? 1 : 0;
				if ( $tab_cdm_mh[$last_cdm]['pdvmax_cdm'] != 999 )
				{
					$carac["pdv"] = "entre ". $tab_cdm_mh[$last_cdm]['pdvmin_cdm'] ." et ". $tab_cdm_mh[$last_cdm]['pdvmax_cdm'] ." --> <b>".($tab_cdm_mh[$last_cdm]['pdvmin_cdm']+$tab_cdm_mh[$last_cdm]['pdvmax_cdm'])/2 . " </b>PV";
					if ( $tab_cdm_mh[$last_cdm]['blessure_cdm'] != 0 )
						$ble = $tab_cdm_mh[$last_cdm]['blessure_cdm']." % : reste entre ". (floor ( $tab_cdm_mh[$last_cdm]['pdvmin_cdm'] * ( 95 - $tab_cdm_mh[$last_cdm]['blessure_cdm'] ) / 100 ) + 1). " et ". (floor ( $tab_cdm_mh[$last_cdm]['pdvmax_cdm'] * ( 105 - $tab_cdm_mh[$last_cdm]['blessure_cdm'] ) / 100 ));
					else 
						$ble = "0%";
					echo "$(anchorCellPV).append ( createBarrePV($colPV,".$tab_cdm_mh[$last_cdm]['pdvmax_cdm']."-".$tab_cdm_mh[$last_cdm]['blessure_cdm']."*".$tab_cdm_mh[$last_cdm]['pdvmax_cdm']."/100,".$tab_cdm_mh[$last_cdm]['pdvmax_cdm'].",'$ble') );";
				}
				else
				{
					$carac["pdv"] = "> à  ".$tab_cdm_mh[$last_cdm]['pdvmin_cdm']." (bestiaire : ".$caracs_moyennes[pdv].")";
					$ble = $tab_cdm_mh[$last_cdm]['blessure_cdm']."%";
					echo "$(anchorCellPV).append ( createBarrePV($colPV,".$tab_cdm_mh[$last_cdm]['pdvmin_cdm']."-".$tab_cdm_mh[$last_cdm]['blessure_cdm']."*".$tab_cdm_mh[$last_cdm]['pdvmin_cdm']."/100,".$tab_cdm_mh[$last_cdm]['pdvmin_cdm'].",'$ble') );";
				}
				foreach ( $arrayCaracPrim as $nameCarac )
					$carac[$nameCarac] = getCaracPrimCdM( $nameCarac, $tab_cdm_mh[$last_cdm], $caracs_moyennes );
				$carac["mm"] = getCaracSeconCdM( "mm", $tab_cdm_mh[$last_cdm], $caracs_moyennes );
				$carac["rm"] = getCaracSeconCdM( "rm", $tab_cdm_mh[$last_cdm], $caracs_moyennes );			
				$carac["nbatt"] = $tab_cdm_mh[$last_cdm]['nbatt_cdm']." (bestiaire : ".$caracs_moyennes["nbatt"].")";
				$carac["vitdep"] = $tab_cdm_mh[$last_cdm]['vitdep_cdm']." (bestiaire : ".$caracs_moyennes["vitdep"].")";
				$carac["vlc"] = $tab_cdm_mh[$last_cdm]['vlc_cdm']." (bestiaire : ".$caracs_moyennes["vlc"].")";
				$carac["attdist"] = $tab_cdm_mh[$last_cdm]['attdist_cdm']." (bestiaire : ".$caracs_moyennes["attdist"].")";
				$etatdla = $tab_cdm_mh[$last_cdm]['etatdla_cdm'];
				$charge = $tab_cdm_mh[$last_cdm]['charge_cdm'];
				$bm = ereg_replace("'"," ",$tab_cdm_mh[$last_cdm]['bm_cdm']);
				
			} 
			else //pas de cdm pour ce monstre, on calcule la moyenne
			{
				$titre = "caracs moyennes du monstre";
				$ble = "???";
				$etatdla = "";
				$charge = "";
				$bm = "";		
				foreach ( $arrayCaracs as $nameCarac )
					$carac[$nameCarac] = $caracs_moyennes[$nameCarac];
			}
			$caracTot = $titre.";".$infos["niv"].";".$carac["pdv"].";".$ble.";".$carac["att"].";".$carac["esq"].";".$carac["deg"].";";
			$caracTot .= $carac["reg"].";".$carac["arm"].";".$carac["vue"].";".$carac["mm"].";".$carac["rm"].";".$carac["nbatt"].";".$carac["vitdep"].";".$carac["vlc"].";".$carac["attdist"].";";
			$caracTot .= $carac["dla"].";".$caracs_spe[4].";".$caracs_spe[5].";".$caracs_spe[10].";".$etatdla.";".$charge.";".$bm;
			$monsterNames[$i] = ereg_replace("\'","&#39;",$monsterNames[$i] );
				
			// ajoute une couleur si le monstre est au même niveau	
			if ( $monsterEtages[$i] == $etageTroll ){
				echo "
					anchorRow.setAttribute ( 'class', '' );
					anchorRow.setAttribute ( 'style', 'background-color:' + colorSearch );
				";
			}		
			
			// ajoute une couleur si le monstre est sur la case
			if ( $dist == 0 ){
				echo "
					anchorRow.setAttribute ( 'class', '' );
					anchorRow.setAttribute ( 'style', 'background-color:' + colorUrg );
				";
			}	
				
			// Si le monstre est un Gowap de la guilde	
	    	if ( isset($arrayGuildeGowaps[$monsterIds[$i]]) ) 
			{
	      		$gowap = $arrayGuildeGowaps[$monsterIds[$i]];
	      		$txtmonster .= " appartient à ".addslashes($gowap["nom_troll"]);
	      		$urlmonster =  "URLGowap + '$monsterIds[$i]'";
				echo "
					colortd = colorRM;
					anchorRow.setAttribute ( 'class', '' );
					anchorRow.setAttribute ( 'style', 'background-color:' + colorRM );
				";
	    	}				
				
			echo "
				$(anchorCellDesc).html( \"<a class='\"+monsterStyle+\"' href=\"+$urlmonster+\" target='_blank'>$txtmonster</a>\" );
				$(anchorCellNiv).html('" .$infos["niv"]. "');
				$(anchorCellNiv).attr ( 'onmouseover', 'this.style.cursor = \'pointer\';this.style.background = \'white\';');
				$(anchorCellNiv).attr ( 'onclick', 'infoBulle (\'$monsterNames[$i]\',event,\'caracMonster\',\'$caracTot\');');
				$(anchorCellNiv).attr ( 'onmouseout', 'this.style.background=\'' + colortd + '\'');	
			";		
			
			// Ajoute le texte de recherche de CdM
			if ( !empty($infos["id_template"]) && !empty($infos["id_age"]) ) 
		    	if ( !count(SelectCdMs($infos["race"],$infos["id_template"],$infos["id_age"],"-1","-1", true)) )
					echo "$(anchorCellDesc).append(' <span class=\'mh_monstres\' style=\'color:red;\'><strong>Allo Houston, veuillez faire une CdM !</strong></span>');";
				
			// Si le troll appartient à un groupe de chasse
			if ( isset($ggc) ){
				
				// Regarde si le monstre a été insulté
				$sql = "SELECT t.nom_troll, e.date, e.texte FROM ggc_event e, ggc_troll t WHERE e.id_cible = '" .$monsterIds[$i]. "' AND e.nom = 'Insulte' AND e.id_lanceur = t.id_troll AND t.id_troll IN ( SELECT id_troll FROM ggc_troll WHERE id_groupe = '".$ggc["id_groupe"]."' ) ORDER BY e.date DESC;";
				$insultes = mysql_query($sql,$db_vue_rm);
				if ( mysql_error() )
					echo "alert('".mysql_error()."');";		
		    	if ( mysql_num_rows($insultes) > 0 ) 
					while ( $insulte = mysql_fetch_assoc($insultes) )
						if ( preg_match( "#.*Elle vous prendra dorénavant comme adversaire privilégié.*#", $insulte["texte"] ) ){
							echo "$(anchorCellDesc).append(' <img align=\'ABSMIDDLE\' title=\'Insulté par " .addslashes($insulte["nom_troll"]). " le ".$insulte["date"]." \' src=\'http://outilsrm.cat-the-psion.net/newfiremago/img/insulte.png\'/> ');";
							$insulte = addslashes($insulte["nom_troll"]) ." à ". $insulte["date"];
							break;
						}
				
			}			
			
			// Ajoute des icones
			if ( $monsterEtages[$i] == $etageTroll )
				echo "$(anchorCellDesc).append('" .addIcon( $vttTroll, $dist, $degbm ). "');";
			if ( isMonsterSearch($name) && !preg_match( "#.*Gowap.*#", $name ) )
				echo "$(anchorCellDesc).append('" .addEMIcon($name). "');";
			if ( preg_match( "#.*abishaii|ame-en-peine|aragnarok du chaos|banshee|barghest|behemoth|beholder|bouj'dla placide|champi-glouton|chauve-souris geante|chevalier du chaos|chimere|daemonite|diablotin|ectoplasme|effrit|elémentaire d'air|erinyes|essaim craterien|essaim sanguinaire|fantôme|fumeux|fungus géant|fungus violet|gnu|goule|gritche|hellrot|incube|marilith|molosse satanique|momie|nécrochore|nécromant|ombre|ombre de roches|palefroi infernal|phoenix|pititabeille|plante carnivore|shai|sorcière|sphinx|squelette|succube|tertre errant|tubercule tueur|vampire|zombie.*#i", $name ) )
				echo "$(anchorCellDesc).append('".addVLC()."');";						
			
			// Ajoute le monstre au Cr
			if ( $dist <= 5 && $monsterEtages[$i] == $etageTroll && !preg_match( "#.*Gowap.*#", $name ) || $dist <= 3 && $monsterEtages[$i] != $etageTroll && !preg_match( "#.*Gowap.*#", $name ) )
				echo addMonsterInCr( $name, $monsterIds[$i], $caracTot, $insulte );
			
		}
		
		echo "if ( uncookifyButton ( document.getElementsByName ( 'delgowap' )[0] ) ) 	{ toggleGowap (); }
			} catch ( e ) { 
			alert ( e, 'Monsters Colouring error' );
		} \n";
		
		if ( $_REQUEST["end"] )
			echo "$('#cr').append('[/quote]');";
	
	}

?>
