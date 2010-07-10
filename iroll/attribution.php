<?
require_once ( "../top.php" );
require_once ( "functions.php" );
?>
<br/>
<table class='mh_tdborder' width='70%' align='center'>
	<tr>
		<td>
			<table width='100%' cellspacing='0' >
				<tr class='mh_tdtitre' align='center'>
					<td>
						<h2>IROLL</h2>
					</td>
				</tr>
				<tr class='mh_tdtitre' align='center'>
					<td>
						<h3>L'outil qui fait de l'ombre à notre Liche !</h3>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<br/>
<br/>
<table width="80%" class='mh_tdborder' align='center' cellspacing='0'>
	<?php echo do_attrib($_POST); ?>
	<br/>
	<tr class='mh_tdtitre' align='center'><td class='mh_tdpage'>
		<a href="index.php" style="text-decoration:none;"><img src="img/flecheg.jpg" alt="back"/></a>
	</tr>
</table>
<?
include('../foot.php');
?>