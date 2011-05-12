<?php
	include_once ("../functions_auth.php");
	include_once ( "../admin_functions_db.php" );
	include_once ( "firemago_functions.php" );	
	
	if (userIsGuilde() || userIsGroupSpec()) 
	{		
	
		$vtt = getVttTroll( $_SESSION['AuthTroll'], $db_vue_rm );
			
		echo "try { \n";
		
		$etageTroll = $_REQUEST["etageTroll"];
		$treasureDists = $_REQUEST["treasureDists"];
		$treasureIds = $_REQUEST["treasureIds"];
		$treasureEtages = $_REQUEST["treasureEtages"];
		$begin = $_REQUEST["begin"];
		$porteeTelek = intval(($vtt["VUE"]+$vtt["VUEB"])/2);
		$arrayIdT = getTreasures( $treasureIds, $db_vue_rm );

		for ( $i = 0; $i < count ($treasureDists); $i++ )
		{

			$rang = $i*2 + $begin;
						
			echo "
					anchorRow = tableTreasures[$rang];
					anchorCellDesc = tableTreasures[$rang].childNodes[2];
			";
						
			if ( isset($arrayIdT[$treasureIds[$i]]) )			
				echo "$(anchorCellDesc).html('<b>" .addslashes($arrayIdT[$treasureIds[$i]]["nom"]." (".$arrayIdT[$treasureIds[$i]]["desc"]). ")</b>')";					
					
			if ( $treasureEtages[$i] == $etageTroll ){
						
				echo "
					if ( !anchorCellDesc.childNodes[0].childNodes[0].nodeValue.match(/Parchemin/) ) {
						anchorRow.setAttribute ( 'class', '' );
						anchorRow.setAttribute ( 'style', 'background-color:' + colorSearch );
					}
				";		
				if ( preg_match( "#.*Télékinésie.*#", $vtt["Sorts"] ) && $treasureDists[$i] <= $porteeTelek )		
					echo "$(anchorCellDesc).append(' <img align=\'ABSMIDDLE\' title=\'Utiliser la force !\' src=\'http://outilsrm.cat-the-psion.net/newfiremago/img/telekinesie.png\'/> ');";						

			}
	
		}

		echo "} catch ( e ) { 
			alert ( e, 'Treasures Colouring error' );
		} \n";		
	
	}

?>
