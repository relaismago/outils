<?php
	require_once('easyem_functions.php');
	include ("../top.php");
 
	if ( !userIsGuilde() )
		die("<h1 style='color:red'>Vous n'avez pas acc�s � cette page !</h1>");
	if ( !isset($_GET["position"]) && !isset($_GET["id"]) )
		die;

?>
<table width="80%" class='mh_tdborder' align='center' cellpadding='0' cellspacing='0'>
	<tr class='mh_tdtitre' align='center'>
		<td class='mh_tdpage'>
			<br/>
			<form method='post' action='view_recette.php?id=<?php echo $_GET["id"]; ?>'>
				<span>Nom du monstre :</span>
				<select name="nom_monstre" onKeyUp="getComposant('composant');" onClick="getComposant('composant');">
					<option value="Dindon">Dindon</option>
					<option value="Fungus G�ant">Fungus G�ant</option>
					<option value="Fungus Violet">Fungus Violet</option>
					<option value="Gnu Sauvage">Gnu Sauvage</option>
					<option value="Goblin">Goblin</option>							
					<option value="Limace G�ante">Limace G�ante</option>
					<option value="Phoenix">Phoenix</option>					
					<option value="Rat G�ant">Rat G�ant</option>					
					<option value="Scarab�e G�ant">Scarab�e G�ant</option>							
					<option value="Ver Carnivore G�ant">Ver Carnivore G�ant</option>					
					<option value="Vouivre">Vouivre</option>
				</select>
				<span>Emplacement :</span>				
				<select name="emplacement" onKeyUp="getComposant('composant');" onClick="getComposant('composant');">
					<option value="Corps">Corps</option>
					<option value="Membre">Membre</option>
					<option value="Sp�cial">Sp�cial</option>
					<option value="T�te">T�te</option>
				</select>	
				<br/>
				<br/>					
				<select name="nom_composant">
					<option value="Tripes d'un Dindon">Tripes d'un Dindon</option>
				</select>	
				<select name="qualit�">
					<option value='Bonne'>Bonne</option>
					<option value='Tr�s Bonne'>Tr�s Bonne</option>
				</select>																	
				<input type='submit' value='Valider'/>
				<input name="clear" type="submit" value="Composant inconnu"/>
				<input name='position' type='hidden' value='<?php echo $_GET["position"]; ?>'/>				
			</form>
			<br/>
		</td>
	</tr>	
</table>
<?php

	include('../foot.php');
	
?>