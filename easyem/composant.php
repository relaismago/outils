<?php
	require_once('easyem_functions.php');
	include ("../top.php");
	
	if ( !userIsGuilde() )
		die("<h1 style='color:red'>Vous n'avez pas acc�s � cette page !</h1>");
	
?>
<table width="80%" class="mh_tdborder" align="center" cellpadding="0" cellspacing="5">
	<tr align="center">
		<td class="mh_tdpage">
			<h1>Nos composants en tani�res</h1>
		</td>	
	</tr>	
	<tr align="center">
		<td class="mh_tdpage" onClick="location.href='update.php?type=composant';" onMouseOut="this.style.backgroundColor = '#30385C';" onMouseOver="this.style.backgroundColor = '#F9BB2F';this.style.cursor='pointer'">
			<h2>Mettre � jour les composants.</h2>
		</td>		
	</tr>	
	<tr align="center">
		<td  class="mh_tdpage">
			<label for="sortilege">Sortil�ge :</label>
			<select id="sortilege" onChange="getComposantBySortilege();">
				<option value="0">Tous</option>
				<?php
					
					$xpath = new DOMXPATH(getEMRecettes());
					foreach ( $xpath->query("/Recettes/Recette") as $recette )
						echo "<option value=\"" .utf8_decode($recette->getAttribute("nom")). "\">" .utf8_decode($recette->getAttribute("nom")). "</option>";
				
				?>
			</select>
			<label for="mundidey">Mundidey :</label>
			<select id="mundidey" onChange="getComposantByMundidey();">
				<option value="0">Tous</option>
				<?php
					
					$xpath = new DOMXPATH(getEMRecettes());
					foreach ( array( "du Hum ...", "du Phoenix", "de la Mouche", "du Dindon", "du Goblin", "du D�mon", "de la Limace", "du Rat", "de l'Hydre", "du Ver", "du Fungus", "de la Vouivre", "du Gnu", "du Scarab�e" ) as $mundidey )
						echo '<option value="' .$mundidey. '">' .$mundidey. '</option>';
				
				?>
			</select>			
		</td>	
	</tr>			
	<tr align="center">
		<td  class="mh_tdpage">
			<table id="composant_taniere" border="1"  cellpadding="5" cellspacing="5">
				<?php
				
					echo getTanieresComposant();
				
				?>
			</table>	
		</td>	
	</tr>
    <tr class="mh_tdtitre" align="center">
		<td class="mh_tdpage"><a href="index.php" style="text-decoration:none;"><img src="img/flecheg.jpg" alt="back"/></a></td>
    </tr>  		
</table>
<?php

	include("../foot.php");
	
?>