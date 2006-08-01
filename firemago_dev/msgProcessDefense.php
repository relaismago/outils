<html>
<body>
<?
	echo ( 'DEFENSE - Pour le moment, cette fonctionnalite effectue les calculs sans rensigner le bestiaire. N oubliez pas de poster les bugs sur le forum ! <br>' );
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
	if ( preg_match ( '/.*\((\d*)\).*/', $titleLine, $regs ) ) { $attackerId = $regs[1]; } else { $error = 'id attaquant not found'; }
	//if ( preg_match ( '/.*(\d\d)\s*%.*/', $msgLine, $regs ) ) { $sr = $regs[1]; } else { $error = 'SR not found'; }
	
	if ( $error != '' ) { echo ( 'Error : ' . $error . '<br>' ); return; }

	echo ( '<br>' );
	echo ( 'Informations collectées : <br>' );
	echo ( 'id troll : ' . $trollId . '<br>' );
	echo ( 'id attaquant : ' . $attackerId . '<br>');	
?>

</body>
</html>