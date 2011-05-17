<?php
	require_once('easyem_functions.php');
	include ("../top.php");

	if ( !userIsGuilde() )
		die("<h1 style='color:red'>Vous n'avez pas accés à cette page !</h1>");
	
?>
<script language="javascript" type="text/javascript" src="/js/overlib.js"></script>
<script language="javascript" type="text/javascript" src="/js/overlib_exclusive.js"></script>
<script language="javascript" type="text/javascript" src="/js/ajax.js"></script>
<script language="javascript" type="text/javascript" src="/js/recherche.js"></script>
<script language="javascript" type="text/javascript" src="/js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="/js/easyem.js"></script>
<script language="javascript" type="text/javascript">var $j = jQuery.noConflict();</script>
<table width="80%" class='mh_tdborder' align='center' cellpadding='5' cellspacing='5'>
	<tr align='center'>
		<td  class="mh_tdpage" style="border: 1px solid #F9BB2F;">
			<?php
			
				echo "<br/><h2>Le Mundidey courant est " .getMundidey(time()). "</h2>";
			
			?>
		</td>	
	</tr>
	<tr  align='center'>
		<td class="mh_tdpage" style="border: 1px solid #F9BB2F;" onClick="location.href='update.php?type=recettes';" onMouseOut="this.style.backgroundColor = '#30385C';" onMouseOver="this.style.backgroundColor = '#F9BB2F';this.style.cursor='pointer'">
			<h2>Mettre à jour les recettes.</h2>
			<p>Mets à jour le statut/composant des recettes</p>
			<p>Les composants variables seront effacés si le mundidey du composant est obsolète !</p>
		</td>		
	</tr>		
</table>
<br/>
<table width="90%" class='mh_tdborder' align='center' cellpadding='10' cellspacing='10'>
	<?php
	
		echo htmlRecettes();
		
	?>	
	<td  class="mh_tdpage" style="border: 1px solid #F9BB2F;" onClick="location.href='crap_composant.php';" onMouseOut="this.style.backgroundColor = '#30385C';" onMouseOver="this.style.backgroundColor = '#F9BB2F';this.style.cursor='pointer'">
		<h3>Liste de composants inutiles</h3>
	</td>
	<td  class="mh_tdpage" style="border: 1px solid #F9BB2F;" onClick="location.href='compotroll_search.php';" onMouseOut="this.style.backgroundColor = '#30385C';" onMouseOver="this.style.backgroundColor = '#F9BB2F';this.style.cursor='pointer'">
		<h3>Trouver facilement mon CompoTroll</h3>
	</td>	
	<td  class="mh_tdpage" style="border: 1px solid #F9BB2F;" onClick="location.href='composant.php';" onMouseOut="this.style.backgroundColor = '#30385C';" onMouseOver="this.style.backgroundColor = '#F9BB2F';this.style.cursor='pointer'">
		<h3>Nos composants</h3>
	</td>		
	</tr>
</table>
<?php

	include('../foot.php');
	
?>