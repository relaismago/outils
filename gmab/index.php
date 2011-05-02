<?php
	
	require_once ('../top.php');
	require_once ('../functions.php');
	require_once ('functions_gmab.php');
	require_once ('../bestiaire2/Libs/functions.php');	

?>
<table class='mh_tdborder' width='70%' align='center'>
	<tr>
		<td>
			<table width='100%' cellspacing='0' >
				<tr class='mh_tdtitre' align='center'>
					<td>
						<h2>Give Me A Battlefield</h2>
					</td>
				</tr>
				<tr class='mh_tdtitre' align='center'>
					<td>
						<h3>Le Tom-Tom des Trolls !</h3>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<br/>
<table class='mh_tdborder' width='70%' align='center'>
	<tr class='mh_tdtitre' align='center'>
		<td><h2>Faire une recherche : </h2></td>
	</tr>
	<tr class='mh_tdtitre' align='center'>
		<td class='mh_tdpage'>
			<form action='result.php' method='post'>
				<table>
					<tr>
						<td>
							<label for='id'>Choix du Troll</label>
						</td>
						<td>
							<select name='id'>
								<?php
									showListeCache($_SESSION["AuthTroll"]);		
								?>
							</select>
						</td>
					</tr>	
					<tr>
						<td><label for='range'>Distance horizontale maximal</label></td>
						<td align='right'><input id='range' name='range' type='text' value='1' size='3'/></td>
					</tr>					
					<tr>
						<td><label for='level'>Niveau minimum du spot</label></td>
						<td align='right'><input id='level' name='level' type='text' value='1' size='3'/></td>
					</tr>
					<tr>
						<td><label for='number'>Nombre minimum de monstres</label></td>
						<td align='right'><input id='number' name='number' type='text' value='2' size='3'/></td>
					</tr>
				</table>					
				<input type='submit' value='Find Them !'/>
			</form>
		</td>
	</tr>	
	<tr class='mh_tdtitre' align='center'><td><h3>Recherches effectuées :</h3></td></tr>

<?php 

	$files = getArchive('save/');
	sort($files);
	foreach(array_reverse($files) as $file)
		echo "<tr class='mh_tdtitre' align='center'><td class='mh_tdpage'><h3><a href='save/" .$file. "'>" .str_replace('.php','',str_replace('_',' ',str_replace('-','/',$file))). "</a></h3></td></tr>"; 

?>
</table>
<?php 	
		include("../foot.php");	
?>