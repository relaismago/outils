<?php
	require_once('easyem_functions.php');
	include ("../top.php");
 
	if ( !userIsGuilde() )
		die("<h1 style='color:red'>Vous n'avez pas accés à cette page !</h1>");
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
					<option value="Fungus Géant">Fungus Géant</option>
					<option value="Fungus Violet">Fungus Violet</option>
					<option value="Gnu Sauvage">Gnu Sauvage</option>
					<option value="Goblin">Goblin</option>							
					<option value="Limace Géante">Limace Géante</option>
					<option value="Phoenix">Phoenix</option>					
					<option value="Rat Géant">Rat Géant</option>					
					<option value="Scarabée Géant">Scarabée Géant</option>							
					<option value="Ver Carnivore Géant">Ver Carnivore Géant</option>					
					<option value="Vouivre">Vouivre</option>
				</select>
				<span>Emplacement :</span>				
				<select name="emplacement" onKeyUp="getComposant('composant');" onClick="getComposant('composant');">
					<option value="Corps">Corps</option>
					<option value="Membre">Membre</option>
					<option value="Spécial">Spécial</option>
					<option value="Tête">Tête</option>
				</select>	
				<br/>
				<br/>					
				<select name="nom_composant">
					<option value="Tripes d'un Dindon">Tripes d'un Dindon</option>
				</select>	
				<select name="qualité">
					<option value='Bonne'>Bonne</option>
					<option value='Très Bonne'>Très Bonne</option>
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