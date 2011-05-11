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
			
				// V�rifie que l'utilisateur est bien connect�
				if ( !isset($_SESSION["AuthTroll"]) )
					echo "<span style='font-size:20;'>Il faut �tre connect� pour mettre � jour !</span>";
				else {
					
					// Met � jour le Troll si l'appel de script n'a pas �t� d�pass�
					if ( $_POST["updateType"] == "Mettre � jour mon Troll !" )				
						if ( checkScriptCall($_SESSION["AuthTroll"],$db_vue_rm,"SP_Profil") && checkScriptCall($_SESSION["AuthTroll"],$db_vue_rm,"SP_Mouche") && checkScriptCall($_SESSION["AuthTroll"],$db_vue_rm,"SP_Equipement") ){
							
							// Mise � jour des appels de scripts
							updateScriptCall($_SESSION["AuthTroll"],$db_vue_rm,"SP_Profil");
							sleep(1);
							updateScriptCall($_SESSION["AuthTroll"],$db_vue_rm,"SP_Mouche");
							sleep(1);
							updateScriptCall($_SESSION["AuthTroll"],$db_vue_rm,"SP_Equipement");							
							
							// Cr�ation de l'objet Troll, mise � jour et sauvegarde
							$troll = new c_Troll( $_SESSION["AuthTroll"], $_SESSION["AuthNomTroll"] );
							$troll->updateTroll($_SESSION);
							$troll->saveTroll();
							
							echo "Le Troll a bien �t� mis � jour !";
							
						}						

					// Met � jour les Tani�res si l'appel de script n'a pas �t� d�pass�
					if ( $_POST["updateType"] == "Mettre � jour les tani�res !" )					
						if ( checkScriptCall($_SESSION["AuthTroll"],$db_vue_rm,"SP_Tanieres") ){
							
							// Mise � jour des appels de scripts
							updateScriptCall($_SESSION["AuthTroll"],$db_vue_rm,"SP_Tanieres");
							
							// Mise � jour des tani�res
							updateTanieres($_SESSION);
							
							echo "Les tani�res sont maintenant � jour !";
							
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
