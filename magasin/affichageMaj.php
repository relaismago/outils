<?php
global $HTTP_GET_VARS;

include('../top.php');
include_once('../secure.php');
include_once('../functions.php3');
include_once("./inc/tresor.inc.php");
include_once("./inc/fonctions.inc.php");

$no_troll=$_SESSION['AuthTroll']; // Id du troll connecté
if (!isDbAdministration() && !isGGT() ) die("<h1><font color=black><b>Vous n'avez pas accès à cette page</b></font></h1");

?>

<?
	$button = "<a href='./index.php'>[ Retour à l'index] </a>";

	afficher_titre_tableau("Contenu des Magasins ".NOM_GUILDE."<br/>",$button);
?>



<form action="./faireMaj.php" method="POST" name="majTaniere" style="text-align:center">
	<table  align="center" class='mh_tdborder'>
	
		<tr class='mh_tdpage'>
			<td>
				Indiquez votre login et mot de passe pour effectuer la mise à jour. Attention, le mot de passe doit être renseigné en clair (le md5 ne suffit pas !).
			</td>
		</tr>
		
		<tr class='mh_tdpage' style="text-align:center;">
			<td>
				<table style="margin:auto">
					<tr>
						<td style="text-align:right">Login :</td>
						<td><input type="text" name="login" value = "<?=$no_troll?>" /></td>
					</tr>
					<tr>
						<td style="text-align:right">Password :</td>
						<td><input type="password" name="password" /></td>
					</tr>
				</table>
			</td>
		</tr>
		
	</table>

<input type="submit" value="Envoyer" class='mh_form_submit'/>

</form>


<?php
include('../foot.php');
?>
