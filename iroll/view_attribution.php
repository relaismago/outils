<?
require_once ( "../top.php" );
?>
	<div id="main" class="mh_tdpage">
		<?php
		
			include "functions.php";
			
			// affiche les informations de l'attribution
			echo get_info_attribution($_GET['id']);
		
		?>
		<br/>
		<a href="index.php" style="text-decoration:none;"><img src="img/flecheg.jpg" alt="back"/></a>		
	</div>
</body>
</html>