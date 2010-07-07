<?
require_once ( "../top.php" );
?>
	<div id="main" class="mh_tdpage">
		<?php
		
			require_once "functions.php";
						
			$post = $_POST;		
				
			// Création d'une attribution			
			if ( array_key_exists('attrib',$post) && array_key_exists('pseudo',$post) ){
				
				$nom_attrib = trim($post['attrib']);
				$pseudo = trim($post['pseudo']);
				
				// vérifie les saisies
				if ( empty($nom_attrib) )
					echo "<p>Veuillez saisir un nom d'attribution !</p>";
				if ( empty($pseudo) )
					echo "<p>Veuillez saisir un nom de Troll !</p>";
					
				if ( !empty($nom_attrib) && !empty($pseudo) ){
					
					echo "<h3>Nom de l'attribution : " .$nom_attrib. "</h3>";
					
					// ajoute l'attribution au fichier xml si le nom n'existe pas
					if ( check_name($nom_attrib) ){
						
						create_attrib($nom_attrib,$pseudo);
						echo create_troll_form($nom_attrib);
					
					} else
						echo "<p>Le nom d'attribution existe déja !</p>";					
					
				}
										
			}
					
			// Création d'un participant								
			if ( array_key_exists('chance',$post) && array_key_exists('pseudo',$post) ){
				
				$nom_attrib = $post['hidden'];
				$chance = intval(trim($post['chance']));
				$pseudo = trim($post['pseudo']);
				
				echo "<h3>Nom de l'attribution : " .$nom_attrib. "</h3>";
				
				// vérifie les saisies
				if ( empty($pseudo) )
					echo "<p>Veuillez saisir un nom de Troll !</p>";				
				if ( empty($chance) || !is_int($chance) || $chance <= 0 )
					echo "<p>Le nombre de chance est incorrecte ! ( Seulement un chiffre strictement supérieur à  0 )</p>";	
					
				// ajoute le participant au fichier xml	
				if ( !empty($pseudo) && !empty($chance) && is_int($chance) && $chance > 0 )
					create_participant($nom_attrib,$pseudo,$chance);
					
				// affiche les deux formulaires ainsi que les participants
				echo create_troll_form($nom_attrib);
				if ( check_participants($nom_attrib) )
					echo get_participants($nom_attrib);	
				echo "<br/>";
				echo create_validation_form($nom_attrib);					
				
			}
				
		?>
		<br/>
		<a href="index.php" style="text-decoration:none;"><img src="img/flecheg.jpg" alt="back"/></a>
	</div>
</body>
</html>