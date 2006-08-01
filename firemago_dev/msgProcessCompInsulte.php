<html>
<body>
<?
	echo ( 'Pour le moment, cette fonctionnalite effectue les calculs sans rensigner le bestiaire. N oubliez pas de poster les bugs sur le forum ! <br>' );
	$error = '';
	$titleLine = $_GET['cpTitle'];
	$trollLine = $_GET['cpTroll'];
	$msgLine = $_GET['cpMsg'];
	if ( preg_match ( '/.*\((\d*),.*/', $trollLine, $regs ) ) { $trollId = $regs[1]; } else { $error = 'troll id not found'; }
	if ( preg_match ( '/.*\((\d*)\).*/', $titleLine, $regs ) ) { $monsterId = $regs[1]; } else { $error = 'monster id not found'; }
	if ( preg_match ( '/.*(\d\d)\s*%.*/', $msgLine, $regs ) ) { $sr = $regs[1]; } else { $error = 'SR not found'; }
	// Get troll MM
	$mm = 65;
	
	if ( $error != '' ) { echo ( 'Error : ' . $error . '<br>' ); return; }
	
	if ( $sr == 5 || $sr == 95 ) { $rm = 'indefinie'; }
	else {
		if ( $sr <= 50 ) { $rm = ( $sr * $mm ) / 50; } else { $rm = ( $mm * 50 ) / ( 100 - $sr ); }
		$rm = round ( $rm );
	}
/*	if ( $sr == 5 || $sr == 95 ) { echo ( 'mm indefinie <br>' ); return; }	
	if ( $sr <= 50 ) { $rm = ( $sr * $mm ) / 50; } else { $rm = ( $mm * 50 ) / ( 100 - $sr ); }
	$rm = round ( $rm );
*/	
	echo ( '<br>' );
	echo ( 'Informations collectées : <br>' );
	
	echo ( 'id troll : ' . $trollId . '<br>' );
	echo ( 'id monstre : ' . $monsterId . '<br>' );
	echo ( 'RM = ' . $rm . '<br>' );
?>

</body>
</html>