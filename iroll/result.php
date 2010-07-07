<?
require_once ( "../top.php" );
?>
	<div id="main" class="mh_tdpage">
		<?php
		
			include "functions.php";
			
			// affiche le résultat de l'attribution
			if ( isset($_POST['hidden']))
				echo get_result($_POST['hidden']);
		
		?>
		<a href="index.php" style="text-decoration:none;"><img src="img/flecheg.jpg" alt="back"/></a>
	</div>
</body>
</html>