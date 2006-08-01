<?php
include_once('config.php');
include_once('variables.php');
include_once('../inc_define_vars.php');
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>

<HEAD>
    <TITLE>VisioTroll</TITLE>
<STYLE type="text/css">
</STYLE>
</HEAD>

<BODY bgcolor="#000000" TEXT="yellow" link="cyan" vlink="cyan">

<center>
<?php

$nbparligne = $_REQUEST["nbparligne"];

echo "<form method=post action=vt_avatars.php target=vtavatars>\n";
#======================
# ecriture de la QUERY
#======================
$query = "SELECT nom_image_troll from trolls WHERE guilde_troll = ".ID_GUILDE." ORDER BY nom_troll ASC";
# exécution de la query
$query_result = my_mysql_query($query);
$nbtrolls = mysql_num_rows($query_result);
echo "Nombre de Trolls : ".$nbtrolls."<br>\n";
echo "Nb de Trolls par ligne : <input name=nbparligne type=text size=2 maxlength=2 value=".$nbparligne."> <input type=submit value=\"Hop!\">\n";
echo "</form>\n";

echo "<table cellspacing=0 border=1 cellpadding=0>\n";

# initialisation du compteur de trolls pour le rangement
$no_troll = 1;
while ( $row = mysql_fetch_array($query_result) )
{
  if (($no_troll%$nbparligne) == 1)
  {
    echo "<tr>\n";
  }

  $Pseudo = $row["nom_image_troll"];
  echo "<td align=center><a href=\"vt_blason.php?blason=".$Pseudo."\" target=\"vtblason\">".$Pseudo."<br><IMG src=\"http://www.pipeshow.net/RM/".$Pseudo."_avatar.gif\" alt=".$Pseudo." border=0 width=110 height=110></a></td>\n";

  if (($no_troll%$nbparligne) == 0)
  {
    echo "</tr>\n";
  }
  $no_troll++;
}

echo "</table>\n";
echo "Nb total de trolls : ".$nbtrolls."\n";
?>

</center>

</BODY>
</HTML>
