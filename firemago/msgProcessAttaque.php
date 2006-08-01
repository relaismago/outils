<html>
<body>
<?
	echo ( 'ATTAQUE - Pour le moment, cette fonctionnalite effectue les calculs sans rensigner le bestiaire. N oubliez pas de poster les bugs sur le forum ! <br>' );
	$error = '';
	$titleLine = $_GET['cpTitle'];
	$trollLine = $_GET['cpTroll'];
	$msgLine = $_GET['cpMsg'];
	
	/*
	echo ( 'title : ' . $titleLine . '<br><br>' );
	echo ( 'troll : ' . $trollLine . '<br><br>' );
	echo ( 'msg : ' . $msgLine . '<br><br>' );
	*/
	
	if ( preg_match ( '/.*\((\d*),.*/', $trollLine, $regs ) ) { $trollId = $regs[1]; } else { $error = 'troll id not found'; }
	if ( preg_match ( '/.*Vous.*\((\d*)\).*/', $msgLine, $regs ) ) { $targetId = $regs[1]; } else { $error = 'target id not found'; }
	if ( preg_match ( '/.*RAT.*/', $msgLine, $regs ) ) { $attackSuccess = 'false'; }
	if ( preg_match ( '/.*TOUCH.*/', $msgLine, $regs ) ) { $attackSuccess = 'true'; }
	if ( $attackSuccess == '' ) { $error = 'could not assess attack result'; }
	if ( preg_match ( '/.*Seuil de .* de la Cible.*\D*(\d*)\D*%/', $msgLine, $regs ) ) { $sr = $regs[1]; }
	
	if ( $error != '' ) { echo ( 'Error : ' . $error . '<br>' ); return; }

	// Get troll MM
	$mm = 65;
	if ( $sr != '' ) {
		if ( $sr == 5 || $sr == 95 ) { $rm = 'indefinie'; }
		else {
			if ( $sr <= 50 ) { $rm = ( $sr * $mm ) / 50; } else { $rm = ( $mm * 50 ) / ( 100 - $sr ); }
			$rm = round ( $rm );
		}
	}
	
	echo ( '<br>' );
	echo ( 'Informations collectées : <br>' );
	echo ( 'id troll : ' . $trollId . '<br>' );
	echo ( 'id cible : ' . $targetId . '<br>' );
	echo ( 'attaque réussie : ' . $attackSuccess . '<br>' );
	if ( $sr != '' ) { echo ( 'sr trouvé : ' . $attackSuccess . '<br>' ); }

	echo ( 'Informations calculées : <br>' );
	if ( $rm != '' ) { echo ( 'rm : ' . $rm . '<br>' ); }

?>

</body>
</html>