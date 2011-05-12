<?php
	include_once ("../functions_auth.php");
	include_once ( "../admin_functions_db.php" );
	include_once ( "firemago_functions.php" );
	
	if (userIsGuilde() || userIsGroupSpec()) 
	{
		
		$index = $_REQUEST["index"];
		$idLanceurs = $_REQUEST["idLanceurs"];
		$idCibles = $_REQUEST["idCibles"];
		$eventDates = $_REQUEST["eventDates"];
		$eventTypes = $_REQUEST["eventTypes"];
		$arrayFormat = array( "\r\n" => "<|>", "'" => "&#039;", "\"" => "&quot;" );
	
		$sql = "SELECT * FROM ggc_troll WHERE id_troll = '" .$_SESSION['AuthTroll']. "' AND id_groupe != 0;";
		$result = mysql_query($sql,$db_vue_rm);
		if ( mysql_error() )
			echo "alert('".mysql_error()."');";
			
		// Si le troll appartient à un groupe affichage des textes personnalisés	
		if ( mysql_num_rows($result) > 0 ){
			
			echo "try { \n";	
			echo "var event;";
			 	 
			$ggc_troll = mysql_fetch_assoc($result); 
			foreach ( $eventDates as $i => $eventDate ){				
									
				echo "event = $('>tr:eq(" .$index[$i]. ")',anchorEvent);";					
												
				$date = getTimeWithMhDate($eventDate);
				$sql = "SELECT * FROM ggc_event e WHERE id_lanceur = '" .$idLanceurs[$i]. "' ";
				$sql .= "AND id_cible = '" .$idCibles[$i]. "' ";
				$sql .= "AND UNIX_TIMESTAMP(STR_TO_DATE( (SELECT date FROM ggc_event WHERE id_event = e.id_event), '%d/%m/%Y %H:%i:%s' )) - '" .$date. "' > -10 AND UNIX_TIMESTAMP(STR_TO_DATE( (SELECT date FROM ggc_event WHERE id_event = e.id_event), '%d/%m/%Y %H:%i:%s' )) - '" .$date. "' < 10 ";
				$sql .= "AND type = '" .$eventTypes[$i]. "' AND (id_lanceur IN ( SELECT id_troll FROM ggc_troll WHERE id_groupe = '" .$ggc_troll["id_groupe"]. "' ) OR id_cible IN ( SELECT id_troll FROM ggc_troll WHERE id_groupe = '" .$ggc_troll["id_groupe"]. "' ));";

				$result = mysql_query($sql,$db_vue_rm);
				if ( mysql_error() )
					echo "alert('".mysql_error()."');";
				if ( mysql_num_rows($result) > 0 ){ 		
				
					$ggc_info = mysql_fetch_assoc($result);
					$namefonction = ( $ggc_info["nom"] == "AA" || $ggc_info["nom"] == "CdM" ) ? "caracMonster" : "compSort";
			
					echo "$('>td:eq(2)',event).html('" .getEventText( $ggc_info["type"], $ggc_info["nom"], str_replace( "<|>", "", strip_tags($ggc_info["texte"]) ) ). "');";					
					echo "$('>td:eq(2)',event).attr ( 'onmouseover', 'this.style.cursor = \'pointer\';this.style.background = \'white\';');";
					echo "$('>td:eq(2)',event).attr ( 'onclick', 'infoBulle (\'" .$ggc_info["nom"]. "\',event,\'$namefonction\',\'" .strtr( $ggc_info["texte"], $arrayFormat ). "\');');";
					echo "$('>td:eq(2)',event).attr ( 'onmouseout', 'this.style.background=\'\'');";					
					if ( $ggc_info["type"] != "MORT" )
						echo "$('>td:eq(1)',event).html('" .$ggc_info["nom"]. "');";								
					
				}			
				
			}		 
			
			echo "} catch ( e ) { error ( e, 'Event Error' ); } \n";	
			
		}
		
	}

?>