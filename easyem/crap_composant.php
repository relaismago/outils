<?php
	require_once('easyem_functions.php');
	include ("../top.php");
	
	if ( !userIsGuilde() )
		die("<h1 style='color:red'>Vous n'avez pas acc�s � cette page !</h1>");
	
?>
<table width="80%" class='mh_tdborder' align='center' cellpadding='0' cellspacing='0'>
	<tr align='center'>
		<td  class="mh_tdpage">
			<h1>Composants de Qualit� Tr�s Mauvaise : </h1>
			<h3>Les composants fixes/variables/compotroll ne sont pas pr�sent !</h3>
		</td>	
	</tr>	
	<tr align='center'>
		<td  class="mh_tdpage">
			<?php
			
				echo getCrapComposant();
			
			?>
		</td>	
	</tr>
    <tr class='mh_tdtitre' align='center'>
		<td class='mh_tdpage'><a href="index.php" style="text-decoration:none;"><img src="img/flecheg.jpg" alt="back"/></a></td>
    </tr>  		
</table>
<?php

	include('../foot.php');
	
?>