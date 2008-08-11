<?php
include_once('../top.php');
include_once('secure.php');

$query_result = my_mysql_query("SELECT * from "._TABLEVTT_.", trolls Where No ='".$_SESSION[AuthTroll]."' AND id_troll = No");
$row = mysql_fetch_array($query_result);

echo "<center>";
echo "<H1>Mise à jour des informations de<br>".htmlspecialchars($row["nom_troll"])."</H1>\n";
echo "<H2>1ère Etape : parser le profil de ".htmlspecialchars($row["nom_troll"])."</H2>\n";

echo "<table width='75%' border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'>";
echo "<tr class='mh_tdtitre'><td>";
echo "<table border='0' class='mh_tdborder' cellpadding='0' cellspacing='1' width='100%' align='center'>";
echo "<form action='completer_profil.php?id=".$id."' method='post'>";

	echo "<tr valign='middle' class='mh_tdtitre'>";
	echo "<td height='35' width='100%' align='center' >Données MH<br>Faire un copier coller de son profil MH</A></TD>";
	echo "</tr>";

	echo "<tr valign='middle' class='mh_tdpage'>";
	echo "<td width='100%' align='center' nowrap>";
	echo "<font color='black'><img src='/vtt/Grognon_run.gif' border=5></font>";
	echo "&nbsp;<textarea rows='10' cols='75' name='copiercoller'></textarea>&nbsp;";
	echo "<font color='black'><img src='/vtt/Grognon_run.gif' border=5></font>";
	echo "</td>";
	echo "</tr>";

	echo "<tr valign='middle' class='mh_tdpage'>";
	echo "<TD align='center'>";
	echo "&nbsp;<br><INPUT TYPE='submit' NAME='soumettre' VALUE='On parse le zinzin...' CLASS='mh_form_submit'><br>&nbsp;";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td align='left'>Merci à <b>Subigard</b> pour ce parser</td>";
	echo "</tr>";

echo "</form>";
echo "</table>";
echo "</td></tr>";

echo "</table>";

include_once('../foot.php');
?>
