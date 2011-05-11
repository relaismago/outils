<?php

	include ("../top.php");
	require_once ("class/c_Troll.php");
	require_once ("functions_pmt.php");	
	
?>
<br/>
<table class='mh_tdborder' width='70%' align='center'>
	<tr>
		<td>
			<table width='100%' cellspacing='0' >
				<tr class='mh_tdtitre' align='center'>
					<td>
						<h2>Pimp My Troll</h2>
					</td>
				</tr>
				<tr class='mh_tdtitre' align='center'>
					<td>
						<h3>Viens tunninger ton Troll !</h3>
					</td>
				</tr>			
			</table>
		</td>
	</tr>
</table>
	<br/>
	<br/>
<table width="80%" class='mh_tdborder' align='center' cellspacing='0'>
	<tr class='mh_tdtitre' align='center'>
		<td  width='70%' class='mh_tdpage'>
			<?php
			
				// Vérifie que l'utilisateur est bien connecté
				if ( !isset($_SESSION["AuthTroll"]) )
					echo "<span style='font-size:20;'>Il faut être connecté pour mettre à jour !</span>";
				else {
					
					// Met à jour le Troll si l'appel de script n'a pas été dépassé
					if ( $_POST["updateType"] == "Mettre à jour mon Troll !" )				
						if ( checkScriptCall($_SESSION["AuthTroll"],$db_vue_rm,"SP_Profil") && checkScriptCall($_SESSION["AuthTroll"],$db_vue_rm,"SP_Mouche") && checkScriptCall($_SESSION["AuthTroll"],$db_vue_rm,"SP_Equipement") ){
							
							// Mise à jour des appels de scripts
							updateScriptCall($_SESSION["AuthTroll"],$db_vue_rm,"SP_Profil");
							sleep(1);
							updateScriptCall($_SESSION["AuthTroll"],$db_vue_rm,"SP_Mouche");
							sleep(1);
							updateScriptCall($_SESSION["AuthTroll"],$db_vue_rm,"SP_Equipement");							
							
							// Création de l'objet Troll, mise à jour et sauvegarde
							$troll = new c_Troll( $_SESSION["AuthTroll"], $_SESSION["AuthNomTroll"] );
							$troll->updateTroll($_SESSION);
							$troll->saveTroll();
							
							echo "Le Troll a bien été mis à jour !";
							
						}						

					// Met à jour les Tanières si l'appel de script n'a pas été dépassé
					if ( $_POST["updateType"] == "Mettre à jour les tanières !" )					
						if ( checkScriptCall($_SESSION["AuthTroll"],$db_vue_rm,"SP_Tanieres") ){
							
							// Mise à jour des appels de scripts
							updateScriptCall($_SESSION["AuthTroll"],$db_vue_rm,"SP_Tanieres");
							
							// Mise à jour des tanières
							updateTanieres($_SESSION);
							
							echo "Les tanières sont maintenant à jour !";
							
						}
					
				}

			
			?>
		</td>
		<tr class='mh_tdtitre' align='center'><td class='mh_tdpage'>
			<a href="index.php" style="text-decoration:none;"><img src="img/flecheg.jpg" alt="back"/></a>
		</tr>		
	</tr>
</table>
<?php

	include('../foot.php');
	
?>
