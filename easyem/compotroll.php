<?php
	require_once('easyem_functions.php');
	include ("../top.php");

	if ( !userIsGuilde() )
		die("<h1 style='color:red'>Vous n'avez pas accés à cette page !</h1>");
		
?>
<table width="80%" class='mh_tdborder' align='center' cellpadding='5' cellspacing='5'>
	<tr align='center'>
		<td  class="mh_tdpage">
			<h3>Mon CompoTroll actuel :</h3>
			<h3><?php echo getCompoTroll($_SESSION["AuthTroll"]); ?></h3>
		</td>	
	</tr>
	<tr align='center'>
		<td  class="mh_tdpage">
			<form action="update.php?type=compotroll" method="post">
				<span>Nom du monstre :</span>
				<select name="nom_monstre" onClick="getComposant('compotroll');" onKeyUp="getComposant('compotroll');">
					<option value="Abishaii Bleu">Abishaii Bleu</option>
					<option value="Abishaii Noir">Abishaii Noir</option>
					<option value="Abishaii Rouge">Abishaii Rouge</option>
					<option value="Abishaii Vert">Abishaii Vert</option>
					<option value="Ame-en-peine">Ame-en-peine</option>
					<option value="Amibe Géante">Amibe Géante</option>
					<option value="Anaconda des Catacombes">Anaconda des Catacombes</option>
					<option value="Ankheg">Ankheg</option>
					<option value="Anoploure Purpurin">Anoploure Purpurin</option>
					<option value="Aragnarok du Chaos">Aragnarok du Chaos</option>
					<option value="Araignée Géante">Araignée Géante</option>
					<option value="Ashashin">Ashashin</option>
					<option value="Balrog">Balrog</option>
					<option value="Banshee">Banshee</option>
					<option value="Barghest">Barghest</option>
					<option value="Basilisk">Basilisk</option>
					<option value="Behemoth">Behemoth</option>
					<option value="Behir">Behir</option>
					<option value="Beholder">Beholder</option>
					<option value="Boggart">Boggart</option>
					<option value="Bondin">Bondin</option>
					<option value="Bouj'Dla">Bouj'Dla</option>
					<option value="Bouj'Dla Placide">Bouj'Dla Placide</option>
					<option value="Bulette">Bulette</option>
					<option value="Caillouteux">Caillouteux</option>
					<option value="Capitan">Capitan</option>
					<option value="Carnosaure">Carnosaure</option>
					<option value="Champi-Glouton">Champi-Glouton</option>
					<option value="Chauve-Souris Géante">Chauve-Souris Géante</option>
					<option value="Cheval à Dents de Sabre">Cheval à Dents de Sabre</option>
					<option value="Chevalier du Chaos">Chevalier du Chaos</option>
					<option value="Chimère">Chimère</option>
					<option value="Chonchon">Chonchon</option>
					<option value="Coccicruelle">Coccicruelle</option>
					<option value="Cockatrice">Cockatrice</option>
					<option value="Crasc">Crasc</option>
					<option value="Crasc Maexus">Crasc Maexus</option>
					<option value="Crasc Médius">Crasc Médius</option>
					<option value="Croquemitaine">Croquemitaine</option>
					<option value="Cube Gélatineux">Cube Gélatineux</option>
					<option value="Daemonite">Daemonite</option>
					<option value="Diablotin">Diablotin</option>
					<option value="Dindon">Dindon</option>
					<option value="Dindon du Chaos">Dindon du Chaos</option>
					<option value="Dindon Du Feu">Dindon Du Feu</option>
					<option value="Dindon Du Glacier">Dindon Du Glacier</option>
					<option value="Dindon du Glouglou">Dindon du Glouglou</option>
					<option value="Dindon Du Hum">Dindon Du Hum</option>
					<option value="Dindon Du Manger">Dindon Du Manger</option>
					<option value="Dindon Effrayé">Dindon Effrayé</option>
					<option value="Djinn">Djinn</option>
					<option value="Ectoplasme">Ectoplasme</option>
					<option value="Effrit">Effrit</option>
					<option value="Elémentaire d'Air">Elémentaire d'Air</option>
					<option value="Elémentaire d'Eau">Elémentaire d'Eau</option>
					<option value="Elémentaire de Feu">Elémentaire de Feu</option>
					<option value="Elémentaire de Terre">Elémentaire de Terre</option>
					<option value="Erinyes">Erinyes</option>
					<option value="Esprit-Follet">Esprit-Follet</option>
					<option value="Essaim Sanguinaire">Essaim Sanguinaire</option>
					<option value="Ettin">Ettin</option>
					<option value="Fantôme">Fantôme</option>
					<option value="Feu Follet">Feu Follet</option>
					<option value="Flagelleur Mental">Flagelleur Mental</option>
					<option value="Flagelleur Mental Mutant">Flagelleur Mental Mutant</option>
					<option value="Foudroyeur">Foudroyeur</option>
					<option value="Fumeux">Fumeux</option>
					<option value="Fungus Géant">Fungus Géant</option>
					<option value="Fungus Violet">Fungus Violet</option>
					<option value="Furgolin">Furgolin</option>
					<option value="Gargouille">Gargouille</option>
					<option value="Géant de Pierre">Géant de Pierre</option>
					<option value="Géant des Gouffres">Géant des Gouffres</option>
					<option value="Geck'oo">Geck'oo</option>
					<option value="Geck'oo Majestueux">Geck'oo Majestueux</option>
					<option value="Glouton">Glouton</option>
					<option value="Gnoll">Gnoll</option>
					<option value="Gnu Sauvage">Gnu Sauvage</option>
					<option value="Goblin">Goblin</option>
					<option value="Goblours">Goblours</option>
					<option value="Golem d'Argile">Golem d'Argile</option>
					<option value="Golem de Chair">Golem de Chair</option>
					<option value="Golem de Fer">Golem de Fer</option>
					<option value="Golem de Pierre">Golem de Pierre</option>
					<option value="Gorgone">Gorgone</option>
					<option value="Goule">Goule</option>
					<option value="Gowap Apprivoisé">Gowap Apprivoisé</option>
					<option value="Gowap Sauvage">Gowap Sauvage</option>
					<option value="Gremlins">Gremlins</option>
					<option value="Gritche">Gritche</option>
					<option value="Grouilleux">Grouilleux</option>
					<option value="Grylle">Grylle</option>
					<option value="Harpie">Harpie</option>
					<option value="Hellrot">Hellrot</option>
					<option value="Homme-Lézard">Homme-Lézard</option>
					<option value="Hurleur">Hurleur</option>
					<option value="Hydre">Hydre</option>
					<option value="Incube">Incube</option>
					<option value="Kobold">Kobold</option>
					<option value="Labeilleux">Labeilleux</option>
					<option value="Lézard Géant">Lézard Géant</option>
					<option value="Liche">Liche</option>
					<option value="Limace Géante">Limace Géante</option>
					<option value="Loup-Garou">Loup-Garou</option>
					<option value="Lutin">Lutin</option>
					<option value="Mante Fulcreuse">Mante Fulcreuse</option>
					<option value="Manticore">Manticore</option>
					<option value="Marilith">Marilith</option>
					<option value="Méduse">Méduse</option>
					<option value="Mégacéphale">Mégacéphale</option>
					<option value="Mille-Pattes Géant">Mille-Pattes Géant</option>
					<option value="Mimique">Mimique</option>
					<option value="Minotaure">Minotaure</option>
					<option value="Molosse Satanique">Molosse Satanique</option>
					<option value="Momie">Momie</option>
					<option value="Monstre Rouilleur">Monstre Rouilleur</option>
					<option value="Mouch'oo Majestueux Sauvage">Mouch'oo Majestueux Sauvage</option>
					<option value="Mouch'oo Sauvage">Mouch'oo Sauvage</option>
					<option value="Naga">Naga</option>
					<option value="Nécrochore">Nécrochore</option>
					<option value="Nécrophage">Nécrophage</option>
					<option value="Nuage d'Insectes">Nuage d'Insectes</option>
					<option value="Nuée de Vermine">Nuée de Vermine</option>
					<option value="Ogre">Ogre</option>
					<option value="Ombre">Ombre</option>
					<option value="Ombre de Roches">Ombre de Roches</option>
					<option value="Orque">Orque</option>
					<option value="Ours-Garou">Ours-Garou</option>
					<option value="Palefroi Infernal">Palefroi Infernal</option>
					<option value="Phoenix">Phoenix</option>
					<option value="Plante Carnivore">Plante Carnivore</option>
					<option value="Pseudo-Dragon">Pseudo-Dragon</option>
					<option value="Rat Géant">Rat Géant</option>
					<option value="Rat-Garou">Rat-Garou</option>
					<option value="Rocketeux">Rocketeux</option>
					<option value="Sagouin">Sagouin</option>
					<option value="Scarabée Géant">Scarabée Géant</option>
					<option value="Scorpion Géant">Scorpion Géant</option>
					<option value="Shai">Shai</option>
					<option value="Slaad">Slaad</option>
					<option value="Sorcière">Sorcière</option>
					<option value="Spectre">Spectre</option>
					<option value="Sphinx">Sphinx</option>
					<option value="Squelette">Squelette</option>
					<option value="Strige">Strige</option>
					<option value="Succube">Succube</option>
					<option value="Tertre Errant">Tertre Errant</option>
					<option value="Thri-kreen">Thri-kreen</option>
					<option value="Tigre-Garou">Tigre-Garou</option>
					<option value="Titan">Titan</option>
					<option value="Trancheur">Trancheur</option>
					<option value="Tubercule Tueur">Tubercule Tueur</option>
					<option value="Tutoki">Tutoki</option>
					<option value="Vampire">Vampire</option>
					<option value="Ver Carnivore Géant">Ver Carnivore Géant</option>
					<option value="Veskan du Chaos">Veskan du Chaos</option>
					<option value="Vouivre">Vouivre</option>
					<option value="Worg">Worg</option>
					<option value="Xorn">Xorn</option>
					<option value="Yéti">Yéti</option>
					<option value="Yuan-ti">Yuan-ti</option>
					<option value="Zombie">Zombie</option>
					</select>
				</select>
				<select name="emplacement" onClick="getComposant('compotroll');" onKeyUp="getComposant('compotroll');">
					<option value="Corps">Corps</option>
					<option value="Membre">Membre</option>
					<option value="Spécial">Spécial</option>
					<option value="Tête">Tête</option>
				</select>											
				<br/>
				<br/>					
				<select name="nom_composant">
					<?php
					
						$xpath = new DOMXPath(getcomposant());	
						
						foreach ( $xpath->query("/Elements/Element[contains(child::text(),'Abishaii Bleu') and @emplacement='Corps']") as $composant )				
							echo "<option value=\"" .utf8_decode($composant->nodeValue). "\">" .utf8_decode($composant->nodeValue). "</option>";	
					
					?>
				</select>	
				<select name="qualité">
					<option value='Moyenne'>Moyenne</option>					
					<option value='Bonne'>Bonne</option>
					<option value='Très Bonne'>Très Bonne</option>
				</select>																	
				<input type='submit' value='Créer mon compotroll'/>		
			</form>
	</tr>	
    <tr class='mh_tdtitre' align='center'>
		<td class='mh_tdpage'><a href="index.php" style="text-decoration:none;"><img src="img/flecheg.jpg" alt="back"/></a></td>
    </tr>  			
</table>
<?php

	include('../foot.php');
	
?>