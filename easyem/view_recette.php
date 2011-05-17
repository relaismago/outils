<?php
	require_once('easyem_functions.php');
	include ("../top.php");

	if ( !userIsGuilde() )
		die("<h1 style='color:red'>Vous n'avez pas accés à cette page !</h1>");
	if ( !isset($_GET["id"]) || empty($_GET["id"]) && $_GET["id"] != 0 || $_GET["id"] > 24 )
		die;
	if ( isset($_POST["nom_monstre"]) && isset($_POST["emplacement"]) && isset($_POST["nom_composant"]) && isset($_POST["qualité"]) && isset($_POST["position"]) )
		updateComposantVariable($_POST);	
		
	$recette = getEMRecettes()->getElementsByTagName("Recette")->item($_GET["id"]);
	
?>
<script language="javascript" type="text/javascript" src="/js/overlib.js"></script>
<script language="javascript" type="text/javascript" src="/js/overlib_exclusive.js"></script>
<script language="javascript" type="text/javascript" src="/js/ajax.js"></script>
<script language="javascript" type="text/javascript" src="/js/recherche.js"></script>
<script language="javascript" type="text/javascript" src="/js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="/js/easyem.js"></script>
<script language="javascript" type="text/javascript">var $j = jQuery.noConflict();</script>
<br/>
<table class='mh_tdborder' width='70%' align='center'>
	<tr>
		<td class='mh_tdpage' align="center" colspan='3'>		
			<h1><?php echo utf8_decode($recette->getAttribute("nom"));?></h1>				
		</td>
	</tr>
	<tr>
		<td  align="center" class='mh_tdpage' width='200px'>
			<h3 style='color:orange;'>CompoTroll</h3>
		</td>		
		<td class='mh_tdpage' align="center">		
			<h3 style='color:orange;'><?php if ( isset($_SESSION["AuthTroll"]) ) echo getCompoTroll($_SESSION["AuthTroll"]); else echo getCompoTroll(0); ?></h3>				
		</td>
		<td class='mh_tdpage' align="center">		
			<h3><a href="compotroll.php"  style='color:orange;'>Votre CompoTroll</a></h3>				
		</td>		
	</tr>
	<?php echo getRecetteComposants($recette);?>
</table>
<br/>
<table width="80%" class='mh_tdborder' align='center' cellspacing='5'>	
	<tr class='mh_tdtitre' align='center'>
		<td class='mh_tdpage' colspan='3'>	
			<h3>Maîtrise du sort ( 80% de base ) + Transe = 110%</h3>
		</td>	
	</tr>
				<?php			
				
					echo "<tr class='mh_tdtitre' align='center'><form>";					
					
						echo "<td class='mh_tdpage' width='200px'>";
							echo "<h3 style='color:gold;'>Parchemin</h3>";
						echo "</td>";
						
						echo getParcheminOption();
						
					echo "</tr>";							
					
					echo "<tr class='mh_tdtitre' align='center'>";					
					
						echo "<td class='mh_tdpage' width='200px'>";
							echo "<h3 style='color:orange;'>CompoTroll</h3>";
						echo "</td>";
						
						echo getCompoTrollOption();
						
					echo "</tr>";						
						
					echo "</tr>";							
					
					echo "<tr class='mh_tdtitre' align='center'>";					
					
						echo "<td class='mh_tdpage' width='200px'>";
							echo "<h3 style='color:silver;'>Champignon</h3>";
						echo "</td>";
						
						echo getChampignonOption();
						
					echo "</tr>";						

					foreach ( $recette->childNodes as $recetteComposant ){
					
						$couleur = ($recetteComposant->getAttribute("position")%2 == 0) ? "#F86F0A": "#F9BB2F";
						
						echo "<tr class='mh_tdtitre' align='center'>";
						
							echo "<td class='mh_tdpage' width='200px'>";
								echo "<h3 style='color:$couleur;'>Position ";
								echo $recetteComposant->getAttribute("position"). " (";
									echo ($recetteComposant->getAttribute("position")%2 == 0) ? "fixe": "variable";								
								echo ")</h3>";
							echo "</td>";
						
							echo getComposantOption( $recetteComposant );

						echo "</form></tr>";
								
					}								
				
				?>
	<tr class='mh_tdtitre' align='center'>
		<td colspan='3'><h1  style='display:inline;'>Copie réalisable à : </h1><h1 id='ajustement' style='display:inline;'><?php echo addColor($recette->getAttribute("ratio")."%");?></h1></td>
	</tr>
	<tr class='mh_tdtitre' align='center'>
		<td colspan='3'>
			<textarea id="textarea" cols="150" rows="8"></textarea>
		</td>
	</tr>	
    <tr class='mh_tdtitre' align='center'>
		<td class='mh_tdpage' colspan='3'><a href="index.php" style="text-decoration:none;"><img src="img/flecheg.jpg" alt="back"/></a></td>
    </tr>  	
</table>
<?php

	include('../foot.php');
	
?>