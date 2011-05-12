<?php
	include_once ("../functions_auth.php");
	include_once ( "../admin_functions_db.php" );
	
	if (userIsGuilde() || userIsGroupSpec()){
		
		$arrayColor = array( "" => "''", "neutre" => "''", "tk" => "colorTK", "ennemie" => "colorEnemy", "amie" => "colorFriend", "alliee" => "colorAlly" );
		$guildsid = $_REQUEST['guildsid'];
		echo "try { \n";	
	
		for ( $i = 0; $i < count( $guildsid ); $i++ ){
			
			$arrInfos = explode ( ";", $guildsid[$i] );
			$statut_guilde = selectDbGuildes ( $arrInfos[0], "" );
			$statut_guilde = $statut_guilde[1]["statut_guilde"];
	
			echo "tableTrolls[" .$arrInfos[1]. "].childNodes[5].setAttribute( 'background', '' ); \n";			
			echo ( $guildsid[$i] == 450 ) ? "tableTrolls[" .$arrInfos[1]. "].childNodes[5].setAttribute( 'bgcolor', colorRM ); \n" : "tableTrolls[" .$arrInfos[1]. "].childNodes[5].setAttribute( 'bgcolor', " .$arrayColor[$statut_guilde]. " );\n";
			
		}
		
		echo "} catch ( e ) { error ( e, 'Guild Colouring error' ); }\n";
	
	}

?>