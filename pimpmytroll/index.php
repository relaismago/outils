<?php

	include ("top.php");
	require_once ("functions_pmt.php");
	require_once ("class/c_Troll.php");
	require_once ("class/c_TrollHTML.php");	
	
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
				<tr class='mh_tdtitre' align='center'>
					<td>
						<form action="update.php" method="post">
							<input name="updateType" type="submit" value="Mettre à jour mon Troll !"/>
							<input name="updateType" type="submit" value="Mettre à jour les tanières !"/>
						</form>
						<?php if ( !isset($_SESSION["AuthTroll"]) )	echo "<p style='font-size:20;'>Il faut être connecté !</p>"; ?>
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
			<br/>
			<?php
			
				// Si le troll est connecté l'équipements est affiché
				if ( isset($_SESSION["AuthTroll"]) )
					echo htmlEquipements($_SESSION["AuthTroll"]);
					
			?>
			<br/>
		</td>
		<td id='pmt_troll' width='30%' class='mh_tdpage'>
			<?php 	
			
				// Si le troll est connecté ses stats sont affichées
				if ( isset($_SESSION["AuthTroll"]) ){
					$troll = new c_Troll( $_SESSION["AuthTroll"], $_SESSION["AuthNomTroll"] );
					$troll->getTroll();
					$troll->applyEquipement();
					$trollHTML = new c_TrollHTML($troll);				
					echo $trollHTML->htmlGetProfil();
				}
					
			?>
		</td>	
	</tr>
</table>
<?php

	include('../foot.php');
	
?>