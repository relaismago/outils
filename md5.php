<form action="md5.php">
Cette page vous permet de convertir votre mot de passe
en un "MD5".
C'est un cryptage de votre mot de passe, qui permet d'utiliser les divers outils, sans toutefois
permettre d'accéder à l'interface de jeu.
Ainsi, vous pouvez utiliser sans risques les outils des différentes guildes (donc Relais&Mago, bien sûr)
<br>Mot de passe à transformer :
<input type="text" name="passe"/>
<input type=submit value="Envoyer le MD5 !"/>
</form>
<?php 
	if ( !empty($_REQUEST["passe"]) ) 
		echo "MD5 : ". md5($_REQUEST["passe"]); 
?>
