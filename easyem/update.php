<?php
	require_once('easyem_functions.php');
	include ("../top.php");

	if ( !userIsGuilde() )
		die("<h1 style='color:red'>Vous n'avez pas accés à cette page !</h1>");
	
	if ( isset($_GET["type"]) ) {
			
		if ( $_GET["type"] == "recettes" )	
			updateRecettesEM(getMundidey(time()));					
		
		if ( $_GET["type"] == "compotroll" )	
			updateCompoTroll( $_SESSION["AuthTroll"], $_SESSION["AuthNomTroll"], $_POST );	
			
		if ( $_GET["type"] == "composant" )	
			updateTanieresComposant();							
		
	} else
		die;

?>
<table width="80%" class='mh_tdborder' align='center' cellpadding='0' cellspacing='0'>
	<tr class='mh_tdtitre' align='center'>
		<td class='mh_tdpage'>
			<h3>Mise à jour réussie !</h3>
		</td>
	</tr>
    <tr class='mh_tdtitre' align='center'>
		<td class='mh_tdpage'><a href="index.php" style="text-decoration:none;"><img src="img/flecheg.jpg" alt="back"/></a></td>
    </tr>  		
</table>
<?php

	include('../foot.php');
	
?>