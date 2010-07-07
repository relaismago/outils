<?
require_once ( "../top.php" );
?>
<br/>
<table class='mh_tdborder' width='70%' align='center'>
	<tr>
		<td>
			<table width='100%' cellspacing='0' >
				<tr class='mh_tdtitre' align="center">
					<td>
						<h2>IROLL</h2>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<br/>
<br/>
<table width="100%" class='mh_tdborder'>
	<tr class="mh_tdtitre">
		<td class='mh_tdpage'>Faire une nouvelle attribution : </td>
	</tr>
	<tr class="mh_tdtitre">
		<td class='mh_tdpage'>
		Eviter les caract&eacute;res sp&eacute;ciaux tel que "\/ pour chaque saisie.
		<form action="attribution.php" method="post" >
			<label for="attrib">Nom de l'attribution : </label>
			<input name="attrib" id="attrib" type="text" />
			<label for="pseudo">Nom du responsable : </label>
			<input name="pseudo" id="pseudo" type="text" />			
			<input type="submit" value="GO !" />
		</form>
		</td>
	</tr>
	<tr class="mh_tdtitre">
		<td class='mh_tdpage'>Attributions Effectu&eacute;es : </td>
	<tr>
		<td class='mh_tdpage'>
		<?php
		
			include "functions.php";
			
			// affiche les attributions effectuées
			echo get_attributions();
		
		?>
		</td>
	</tr>
</table>
</body>
</html>