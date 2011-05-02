<?php
	
	require_once ('../top.php');
	require_once ('../functions.php');
	require_once ('../bestiaire2/Libs/functions.php');
	require_once ('functions_gmab.php');

?>
<table class='mh_tdborder' width='70%' align='center'>
	<tr>
		<td>
			<table width='100%' cellspacing='0' >
				<tr class='mh_tdtitre' align='center'>
					<td>
						<h2>Give Me A Battlefield</h2>
					</td>
				</tr>
				<tr class='mh_tdtitre' align='center'>
					<td>
						<h3>Le Tom-Tom des Trolls !</h3>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<br/>
<table class='mh_tdborder' width='70%' align='center'>
<?php 

	$start = "<tr class='mh_tdtitre' align='center'><td class='mh_tdpage'><h3>";
	$end = "</h3></td></tr>";		
	
	// Efface le fichier de recherche du troll s'il existe
	foreach(getArchive("save/") as $file)
		if ( preg_match("#.*" .$_POST["troll"]. ".*#i",$file) )
			unlink("save/".$file);	
			
	//set_time_limit (0);			
	// Enregistrement du fichier de recherche		
	date_default_timezone_set('Europe/Berlin');		
	$string = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			   <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
			   <head>
					<title>Give Me A Battlefield</title>
					<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
					<link rel="stylesheet" type="text/css" href="../gmab.css" />
			   </head>
			   <body>
					<div id="main" class="mh_tdpage">'
						.stripslashes(html_entity_decode($_POST["save"],ENT_QUOTES)).
					'<a href="../index.php" style="text-decoration:none;"><img src="../img/flecheg.jpg" alt="back"/></a>
					</div>	
				</body>
				</html>';
	$file = fopen("save/" .strftime($_POST["troll"]. "_le_%d-%m-%Y_%Hh%Mm.php"),"w");
	fwrite($file,$string);
	fclose($file);
	
	echo $start ."Ecriture effectuée !";

?>

<tr class='mh_tdtitre' align='center'><td class='mh_tdpage'>
	<a href="index.php" style="text-decoration:none;"><img src="img/flecheg.jpg" alt="back"/></a>
</tr>
</table>
<?php 

	include("../foot.php");	

?>