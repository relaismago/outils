<?php
	require_once('easyem_functions.php');
	include ("../top.php");

	if ( !userIsGuilde() )
		die("<h1 style='color:red'>Vous n'avez pas accés à cette page !</h1>");	

?>
<table width="80%" class='mh_tdborder' align='center' cellpadding='5' cellspacing='5'>
	<tr align='center' class='mh_tdborder'>
		<th class="mh_tdpage" style="color:white;">Famille du Monstre</th>
		<th class="mh_tdpage" style="color:white;">Nom du Monstre</th>
		<th class="mh_tdpage" style="color:white;">Emplacement</th>
		<th class="mh_tdpage" style="color:white;">Niveau du Monstre</th>						
	</tr>
	<tr align='center' class='mh_tdborder'>
		<td class="mh_tdpage">
			<select id="famille_montres" onClick="updateSelect();">
				<option value="">Tous</option>
				<option value="Animal">Animal</option>
				<option value="Démon">Démon</option>
				<option value="Humanoïde">Humanoïde</option>
				<option value="Insecte">Insecte</option>
				<option value="Monstre">Monstre</option>
				<option value="Mort-Vivant">Mort-Vivant</option>		
			</select>
		</td>
		<td class="mh_tdpage">
			<select id="nom_monstre" onClick="updateNiveau();">
				<option value="">Tous</option>
				<?php
				
					$xpath = new DOMXPath(getComposant());
					foreach( $xpath->query("/Elements/Element") as $monstre )
						if ( $monstre->previousSibling == NULL || $monstre->previousSibling->getAttribute("monstre") != $monstre->getAttribute("monstre") )
							echo '<option value="' .utf8_decode($monstre->getAttribute("monstre")). '">' .utf8_decode($monstre->getAttribute("monstre")). '</option>';
				
				?>			
			</select>
		</td>
		<td class="mh_tdpage">
			<label for="Tête">Tête</label>
			<input checked onClick="getCompoTroll();" id="Tête" class="emplacement" type="checkbox" value="Tête"/>
			<label for="Corps">Corps</label>
			<input checked onClick="getCompoTroll();" id="Corps" class="emplacement" type="checkbox" value="Corps"/>
			<label for="Membre">Membre</label>
			<input checked onClick="getCompoTroll();" id="Membre" class="emplacement" type="checkbox" value="Membre"/>
			<label for="Spécial">Spécial</label>
			<input checked onClick="getCompoTroll();" id="Spécial" class="emplacement" type="checkbox" value="Spécial"/>	
		</td>
		<td class='mh_tdpage'>							
			Niveau min :
			<input id="min" onKeyUp="getCompoTroll();" type="text" size="3" value="0"/>
			Niveau max :
			<input id="max" onKeyUp="getCompoTroll();" type="text" size="3" value="40"/>
		</td>
	</tr>
	<tr align='center' class='mh_tdborder'>
		<td class="mh_tdpage" colspan="4">	
			<br/>
			<br/>
			<table id="table_result" width="50%" class='mh_tdborder' align='center' cellpadding='5' cellspacing='5'>
				<?php
				
					$xpath = new DOMXPath(getComposant());	
					$composants = $xpath->query('/Elements/Element');		
					foreach ( $composants as $composant )
						echo "<tr align='center' class='mh_tdborder'><td class='mh_tdpage'>" .utf8_decode($composant->getAttribute("famille")). "</td><td class='mh_tdpage'>" .utf8_decode($composant->nodeValue). "</td><td class='mh_tdpage'>" .utf8_decode($composant->getAttribute("emplacement")). "</td><td class='mh_tdpage'>" .utf8_decode($composant->getAttribute("niveau")). "</td></tr>";	
				
				?>
			</table>
			<br/>
			<br/>
		</td>
	</tr>
    <tr class='mh_tdtitre' align='center'>
		<td class='mh_tdpage'  colspan='4'><a href="index.php" style="text-decoration:none;"><img src="img/flecheg.jpg" alt="back"/></a></td>
    </tr>  		
</table>
<?php

	include('../foot.php');
	
?>