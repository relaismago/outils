<?php
	include_once ("../functions_auth.php");
	include_once ( "../inc_define_vars.php" );
	include_once ( "../admin_functions_db.php" );
	include_once ( "../pimpmytroll/class/c_Troll.php" );	
	include_once ( "firemago_functions.php" );
	
	if (userIsGuilde() || userIsGroupSpec()) 
	{
		echo "try { \n";
		
		$etageTroll = $_REQUEST["etageTroll"];
		$idTroll = $_SESSION["AuthTroll"];
		$trollsid = $_REQUEST['trollsid'];
		$trollDists = $_REQUEST['trollDists'];
		$trollEtages = $_REQUEST['trollEtages'];
		$begin = $_REQUEST['begin'];		
		$arrayVtt = getVttTrolls( $trollsid, $db_vue_rm );
		$arrayAna = getAnaTrolls( $trollsid, $db_vue_rm );
		$vttTroll = getVttTroll( $idTroll, $db_vue_rm );
		$degbm = 0;
		
		if ( is_file("../pimpmytroll/trolls/" .$idTroll. ".xml") ){
			$c_Troll = new c_Troll($idTroll);
			$c_Troll->getTroll();
			$c_Troll->applyEquipement();
			$degbm = $c_Troll->getVar("DégâtsBMM");	
		}

		for ( $i = 0; $i < count ( $trollsid ); $i++ )
		{
			$dist = $trollDists[$i];
			$lesTrolls = selectDbTrolls ( $trollsid[$i], "" );
			$troll = $lesTrolls[1];
			$nom_troll = htmlentities( $troll["nom_troll"], ENT_QUOTES );
			$rang = $i*2 + $begin;
			$colorTroll = "";
			
			// ajoute une couleur si le troll est au même niveau	
			if ( $trollEtages[$i] == $etageTroll ){
				echo "
					tableTrolls[$rang].setAttribute ( 'class', '' );
					tableTrolls[$rang].setAttribute ( 'style', 'background-color:' + colorSearch );
				";
				$colorTroll = "colorSearch";
			}	
			
			// ajoute une couleur si le troll est sur la case
			if ( $dist == 0 ){
				echo "
					tableTrolls[$rang].setAttribute ( 'class', '' );
					tableTrolls[$rang].setAttribute ( 'style', 'background-color:' + colorUrg );
				";
				$colorTroll = "colorUrg";
			}			
			
			// ajoute une couleur en fonction de la diplomatie
			if (($troll["statut_troll"] != "neutre" && $troll["statut_troll"] != "") || $troll["is_tk_troll"] == "oui" || $troll["is_wanted_troll"] == "oui")
			{
				
				if ( $troll["is_tk_troll"] == "oui" || $troll["statut_troll"] == "tk" )
					$colorTroll = "colorTK";
				if ( $troll["is_wanted_troll"] == "oui" || $troll["statut_troll"] == "ennemie")
					$colorTroll = "colorEnemy";
				if ( $troll["statut_troll"] == "amie" )
					$colorTroll = "colorFriend";
				if ( $troll["statut_troll"] == "alliee" )
					$colorTroll = "colorAlly";
				for ( $j=0; $j<5; ++$j ){
					echo "tableTrolls[$rang].childNodes[$j].setAttribute ( 'background', '' ); \n";			
					echo "tableTrolls[$rang].childNodes[$j].setAttribute ( 'bgcolor', $colorTroll ); \n";	
					echo "tableTrolls[$rang].childNodes[$j].setAttribute ( 'bgcolor', $colorTroll ); \n";			
				}	
				
			}
			
			// infobulle contenant les stats du troll à partir du VTT
			if ( isset($arrayVtt[$trollsid[$i]]) ){
				
				$vtt = $arrayVtt[$trollsid[$i]];
				$caracTot="MaJ faite le ".$vtt["date_maj"].";";
				$caracTot.=$vtt["DLAH"]."h".$vtt["DLAM"].";";
				$caracTot.=$vtt["PV_ACTUELS"]."/".$vtt["PVs"].";";
				$caracTot.=$vtt["ATT"]."+".$vtt["ATTB"].";";
				$caracTot.=$vtt["ESQ"]."+".$vtt["ESQB"].";";
				$caracTot.=$vtt["DEG"]."+".$vtt["DEGB"].";";
				$caracTot.=$vtt["REG"]."+".$vtt["REGB"].";";
				$caracTot.=$vtt["ARM"]."+".$vtt["ARMB"].";";
				$caracTot.=$vtt["VUE"]."+".$vtt["VUEB"].";";
				$caracTot.=$vtt["RM"]."+".$vtt["RMB"].";";
				$caracTot.=$vtt["MM"]."+".$vtt["MMB"].";";
			
				$colPV = ($vtt["Peremption"]/24 > 5) ? 1 : 0;
	
				if ( $vtt["PV_ACTUELS"] )
					echo "tableTrolls[$rang].childNodes[6].appendChild( createBarrePV($colPV,$vtt[PV_ACTUELS],$vtt[PVs],'$vtt[PV_ACTUELS]/$vtt[PVs]') );";
				
				echo "tableTrolls[$rang].childNodes[3].setAttribute ( 'onmouseover', 'this.style.cursor = \'pointer\';this.className = \'mh_tdtitre\';');";
				echo "tableTrolls[$rang].childNodes[3].setAttribute ( 'onclick', 'infoBulle (\'$nom_troll\',event,\'caracTroll\',\'$caracTot\');');";
				echo "tableTrolls[$rang].childNodes[3].setAttribute ( 'onmouseout', '";			
					 echo ( !empty($colorTroll) ) ? "$(this).attr(\'class\',\'\');$(this).css(\'background-color\',$colorTroll);" : "this.className = \'mh_tdpage\';";
				echo "' );";
				
			}
			
			// infobulle contenant les stats du troll à partir des AA
			if ( isset($arrayAna[$trollsid[$i]]) ){
				
				
				echo "tableTrolls[$rang].childNodes[3].setAttribute ( 'onmouseover', 'this.style.cursor = \'pointer\';this.className = \'mh_tdtitre\';');";
				echo "tableTrolls[$rang].childNodes[3].setAttribute ( 'onclick', 'infoBulle (\'$nom_troll\',event,\'caracTrollAna\',\'" .addslashes(htmlspecialchars(implode('|',$arrayAna[$trollsid[$i]]),ENT_QUOTES)). "\');');";
				echo "tableTrolls[$rang].childNodes[3].setAttribute ( 'onmouseout', '";			
					 echo ( !empty($colorTroll) ) ? "$(this).attr(\'class\',\'\');$(this).css(\'background-color\',$colorTroll);" : "this.className = \'mh_tdpage\';";
				echo "' );";				
				
			}
			
			// Ajoute les icônes pour la charge/projo/...
			if ( $trollEtages[$i] == $etageTroll )		
				echo "$('>*:eq(2)',tableTrolls[$rang]).append('" .addIcon( $vttTroll, $dist, $degbm ). "');";							
			
		}

		echo "if ( uncookifyButton ( document.getElementsByName ( 'delint' )[0] ) ) 	{ toggleIntangible (); }";
		echo "} catch ( e ) { error ( e, 'Troll Colouring error' ); } \n";
	
	}

?>
