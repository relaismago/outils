<?php
include_once('config.php');
include_once('variables.php');
include_once('inc_define_vars.php');
?>

<?php
$blason = $_REQUEST["blason"];

if ($blason=="init")
{
	# il faut tirer au sort le troll à afficher
	# tirage au sort d'une ligne de la table
	$query_result = my_mysql_query("SELECT nom_image_troll FROM trolls WHERE guilde_troll=".ID_GUILDE." ORDER BY rand() LIMIT 1");
  $row = mysql_fetch_array($query_result);
  $pseudo = $row["nom_image_troll"];
}
else
{
	$pseudo = $blason;
}
# récupération des infos
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>

<HEAD>
    <TITLE>Blason</TITLE>
</HEAD>

<BODY bgcolor="#000000" TEXT="yellow" link="cyan" vlink="cyan">

<center>
<h1>BLASON</h1>
<br>
<?php
echo "<img src=\"http://www.pipeshow.net/RM/blasons/".$pseudo.".gif\" alt=\"[".$pseudo."]\" border=0 name=\"vtblason\">\n";
?>
</center>

</BODY>
</HTML>
