<?php
	
	require_once ('../top.php');
	require_once ('../functions.php');
	require_once ('../lib/nusoap.php');	
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
	
	// Vérification du formulaire
	if ( intval($_POST["range"]) < 0 )
		echo $start ."Tu as un peu trop forcé sur le Calvok ! La distance ne peut être négative !". $end;
	if ( intval($_POST["level"]) < 1 )
		echo $start ."Tu veux rechercher un spot de sous-monstre ?". $end;
	if ( intval($_POST["number"]) < 2 )
		echo $start ."Un spot se compose d'au moins 2 monstres !". $end;		
	if ( $_POST["id"] == -1 )	
		echo $start ."Choisit un Troll !". $end;
	if ( !isset($_SESSION["AuthNomTroll"]) )	
		echo $start ."Il faut être connecté !". $end;
		
	// Affichage des spots
	if ( checkScriptCall($_POST["id"],$db_vue_rm) && isset($_SESSION["AuthNomTroll"]) && intval($_POST["range"]) >= 0 && intval($_POST["level"]) >= 1 && intval($_POST["number"]) >= 2 && $_POST["id"] != -1 ){	
		
		// Récupération du md5 du troll selectionné
		$sql = "SELECT pass_troll,nom_troll";
		$sql .= " FROM trolls WHERE id_troll='" .$_POST["id"]. "';";
		$troll = mysql_fetch_array(mysql_query($sql, $db_vue_rm),MYSQL_NUM);
		echo mysql_error();		
		$_POST["name"] = $troll["1"];
		
		/*$clientWs = new nusoap_client('http://sp.mountyhall.com/SP_WebService.php');
		$vue = $clientWs ->call('Vue', array('numero' => $_POST["id"], 'mdp' => $troll["0"]));		
		var_dump($vue);	
		die;*/
		
		// Récupération de la vue
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://sp.mountyhall.com/SP_Vue2.php?Numero=" .$_POST["id"]. "&Motdepasse=" .$troll["0"]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $_POST["view"] = curl_exec($ch);
        curl_close($ch);
		
        // Vérifie si la vue a bien été récupéré
	    if ( preg_match("#.*paramètres incorrects.*#", $_POST["view"]) || preg_match("#mot de passe incorrect#", $_POST["view"]) )
	       	echo $start .$_POST["view"]. $end;
	    else {				
			updateScriptCall($_POST["id"],$db_vue_rm);	
			//set_time_limit (0);
			echo $start .htmlDisplaySpots($_POST). $end;	
	    }
			
	}	
			
?>
<tr class='mh_tdtitre' align='center'><td class='mh_tdpage'>
	<a href="index.php" style="text-decoration:none;"><img src="img/flecheg.jpg" alt="back"/></a>
</tr>
</table>
<?php 

	include("../foot.php");	

?>