<?php
include_once('config.php');
no_cache();
?>

<!doctype html public "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title> Login sur le VisioTrolloTron </title>
<meta name="Generator" content="EditPlus">
<meta name="Author" content="Grognon">
<meta name="Keywords" content="">
<meta name="Description" content="inspiré des travaux de Jean-Yves Fort pour son phpLogin 1.0">
</head>

<body bgcolor="#30395D" TEXT="white">

<form method="post" action="login.php">
<center>
<img src="visiotrollotron.gif">
<br>
<?php
if ($reason=="login")
{
	echo "<font color=yellow>Login refus&eacute;, veuillez essayer de nouveau</font><br>\n";
}
?>
Nom d'utilisateur : <SELECT name="no_membre">

<?php
# récupération des nos et des pseudos des trolls

$query_result = my_mysql_query("SELECT No, Pseudo from trolls ORDER BY Pseudo");
while ($row = mysql_fetch_array($query_result))
{
	echo "\n\t<OPTION value=\"".$row["No"]."\">".$row["Pseudo"]."</OPTION>";
}
?>

</SELECT>
Mot de passe : <input type="password" name="passe_membre"><br>
<br><input type="submit" name="SubmitVTT" value="VisioTrollotron">

</form>
</center>

<H4>Vous ne connaissez pas votre mot de passe ?</H4>
<H4>Vous avez oubli&eacute; votre mot de passe ?</H4>
<b><font color=yellow>Envoyez votre demande de mot de passe au Troll Lobo (no 10866), Garbrag (no 30271) ou Grognon (no 2690) qui vous le communiquera.</font></b>



</body>
</html>
