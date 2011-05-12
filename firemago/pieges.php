<?php
	include_once ("../functions_auth.php");
	include_once ( "../admin_functions_db.php" );
	include_once ( "firemago_functions.php" );

	if (userIsGuilde() || userIsGroupSpec()) 
	{
		
		$vue = $_REQUEST["Vue"];
		$X = $_REQUEST["X"];
		$Y = $_REQUEST["Y"];
		$N = $_REQUEST["N"];						
		
		echo "try { \n";		
		
			echo "
				function piege(){
					
					$('.fm_piege').each(function(index) {
						
						$(this).css('background-color',colorUrg);
						
						if ( $(this).css('display') == 'none' )
							$(this).show();
						else
							$(this).hide();
						
					});	
				
				}	
					
			";
		
			echo "var anchorPlace = $('html>body>table>tbody>tr:eq(1)>td>table>tbody>tr>td:eq(1)>p>table:eq(4)>tbody>tr:eq(1)');";
		
			$sql = "SELECT * FROM ggc_piege WHERE abs(X-" .intval($X). ") < 6  AND abs(Y-" .intval($Y). ") < 6 AND abs(N-" .intval($N). ") < 6;";
	
			$pieges = mysql_query($sql,$db_vue_rm);
			if ( mysql_error() )
				echo "alert('".mysql_error()."');";		
	    	if ( mysql_num_rows($pieges) > 0 ) 
				while ( $piege = mysql_fetch_assoc($pieges) ){
					
					$dist = getDist( $X, $Y, $N, $piege["X"], $piege["Y"], $piege["N"] );
					echo "anchorPlace.after('<tr style=\"background-color:red;\"><td width=\"75\">" .$dist. "</td><td>Piège à " .$piege["type"]. "</td><td>" .addslashes($piege["date"]." ".$piege["texte"]). "</td><td align=\"center\">" .$piege["X"]. "</td><td align=\"center\">" .$piege["Y"]. "</td><td align=\"center\">" .$piege["N"]. "</td></tr>');";
					if ( $dist < 2 ){		
						echo "
								if ( $('#table_piege').length == 0 )
									$('html>body>table>tbody>tr:eq(1)>td>table>tbody>tr>td:eq(1)>p>table:eq(0)').before('<table id=\"table_piege\" class=\"mh_tdborder\" width=\"50%\"><tr style=\"background-color:red;\" onClick=\"piege();\" onMouseOver=\"this.style.cursor = \'pointer\';\"<td align=\"center\" colspan=\"6\">ATTENTION => Pièges à une cases de votre Troll !</td></tr></table><br/>');
							 ";			
						echo "$(\"#table_piege\").append('<tr class=\"fm_piege\" style=\"display:none\" align=\"center\"><td>Dist : " .$dist. "</td><td>Type : " .$piege["type"]. "</td><td>" .addslashes($piege["date"]." ".$piege["texte"]). "</td><td>X:" .$piege["X"]. "</td><td>Y:" .$piege["Y"]. "</td><td>N" .$piege["N"]. "</td></tr>');";						
					}
					
				}
						
	
		echo "} catch ( e ) { error ( e, 'Piege error' ); } \n";				
		
	}

?>