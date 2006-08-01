<!doctype html public "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<style>
<?php
	include('stylesheet.css');
?>
</style>
<title> AMotron </title>
<meta name="Generator" content="EditPlus">
<meta name="Author" content="Grognon">
<meta name="Keywords" content="">
<meta name="Description" content="">
</head>
<body bgcolor="#30395D" TEXT="white" link="yellow" vlink="yellow">
<center>
<img src="AMotron_titre.gif">
</center>
<form method="post" action="amotron.php">
<table cellspacing=10 cellpadding=0 border=0>
<tr><td align=right>DLA (en minutes)</td><td align=left><input type=text name=DLA size=10></td><td rowspan=7><img src="grognonAM.gif"></td></tr>
<tr><td align=right>Poids Equipement (en minutes)</td><td align=left><input type=text name=PE size=10></td></tr>
<tr><td align=right>Bonus de DLA (en minutes) en positif les gains<br>(ex. 4 Rivatants, saisir 80 et pas -80)</td><td align=left><input type=text name=BDLA size=10></td></tr>
<tr><td align=right>REG moyenne (en PVs)</td><td align=left><input type=text name=REG size=10></td></tr>
<tr><td align=right>max PVs</td><td align=left><input type=text name=maxPVs size=10></td></tr>
<tr><td colspan=2>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td align=center><input type=submit value="AMotron"></td></tr>
</table>
</body>
</html>
