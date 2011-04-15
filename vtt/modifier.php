<?php
include_once('../top.php');
include_once('secure.php');

$query_result = my_mysql_query("SELECT *, nom_troll from vtt, trolls Where No='".$id."' and id_troll=No");
$row = mysql_fetch_array($query_result);

echo "<center>\n";
echo "<H1>Mise à jour des informations de<br>".htmlspecialchars($row["nom_troll"])."</H1>\n";
echo "<FORM ACTION=\"verifier_maj.php?id=".$id."&no=".$row["No"]."\" method=post>\n";

echo "<br>&nbsp;<br>\n";
echo "<table cellspacing=0 border=1 cellpadding=1 class=impair>\n";
echo "<tr><td align=right>Race</td>"
        ."<td align=left><select name=race size=1>"
  	."<option".(($row["Race"] == "Kastar")?" SELECTED":"").">Kastar</option>"
  	."<option".(($row["Race"] == "Skrim")?" SELECTED":"").">Skrim</option>"
  	."<option".(($row["Race"] == "Durakuir")?" SELECTED":"").">Durakuir</option>"
  	."<option".(($row["Race"] == "Tomawak")?" SELECTED":"").">Tomawak</option>"
  	."</select></td>"
        ."</tr>\n";
echo "<tr><td align=right>DLA<br>(Duree normale du Tour<br>+ Bonus/Malus sur la dur&eacute;e<br>+ Poids de l'&eacute;quipement)</td>"
	."<td align=left><input name=dlah size=2 maxlength=2 value='".htmlspecialchars($row["DLAH"], ENT_QUOTES)."'>h"
  	."<input name=dlam size=2 maxlength=2 value='".htmlspecialchars($row["DLAM"], ENT_QUOTES)."'>min</td>"
  	."</tr>\n";
echo "<tr><td align=right>VUE</td>"
	."<td align=left><input name=vue size=2 maxlength=2 value='".htmlspecialchars($row["VUE"], ENT_QUOTES)."'>"
  	."<input name=vueb size=3 maxlength=3 value='".plus($row["VUEB"]).htmlspecialchars($row["VUEB"], ENT_QUOTES)."'></td>"
  	."</tr>\n";
echo "<tr><td align=right>Niv</td><td align=left><input name=niveau size=2 maxlength=2 value='".htmlspecialchars($row["Niveau"], ENT_QUOTES)."'></td></tr>\n";
echo "<tr><td align=right>PVs</td><td align=left><input name=pvs size=3 maxlength=3 value='".htmlspecialchars($row["PVs"], ENT_QUOTES)."'></td></tr>\n";
echo "<tr><td align=right>REG</td>"
	."<td align=left><input name=reg size=2 maxlength=2 value='".htmlspecialchars($row["REG"], ENT_QUOTES)."'>D3"
  	."<input name=regb size=3 maxlength=3 value='".plus($row["REGB"]).htmlspecialchars($row["REGB"], ENT_QUOTES)."'></td>"
  	."</tr>\n";
echo "<tr><td align=right>ATT</td>"
	."<td align=left><input name=att size=2 maxlength=2 value='".htmlspecialchars($row["ATT"], ENT_QUOTES)."'>D6"
  	."<input name=attb size=3 maxlength=3 value='".plus($row["ATTB"]).htmlspecialchars($row["ATTB"], ENT_QUOTES)."'></td>"
  	."</tr>\n";
echo "<tr><td align=right>ESQ</td>"
	."<td align=left><input name=esq size=2 maxlength=2 value='".htmlspecialchars($row["ESQ"], ENT_QUOTES)."'>D6"
  	."<input name=esqb size=3 maxlength=3 value='".plus($row["ESQB"]).htmlspecialchars($row["ESQB"], ENT_QUOTES)."'></td>"
  	."</tr>\n";
echo "<tr><td align=right>DEG</td>"
	."<td align=left><input name=deg size=2 maxlength=2 value='".htmlspecialchars($row["DEG"], ENT_QUOTES)."'>D3"
  	."<input name=degb size=3 maxlength=3 value='".plus($row["DEGB"]).htmlspecialchars($row["DEGB"], ENT_QUOTES)."'></td>"
  	."</tr>\n";
echo "<tr><td align=right>ARM</td>"
	."<td align=left><input name=arm size=2 maxlength=2 value='".htmlspecialchars($row["ARM"], ENT_QUOTES)."'>"
  	."<input name=armb size=2 maxlength=2 value='".plus($row["ARMB"]).htmlspecialchars($row["ARMB"], ENT_QUOTES)."'></td>"
  	."</tr>\n";
echo "<tr><td align=right>KILLs</td><td align=left><input name=kills size=3 maxlength=3 value='".htmlspecialchars($row["KILLs"], ENT_QUOTES)."'></td></tr>\n";
echo "<tr><td align=right>Décès</td><td align=left><input name=deads size=2 maxlength=2 value='".htmlspecialchars($row["DEADs"], ENT_QUOTES)."'></td></tr>\n";
echo "<tr><td align=right>RM</td>"
	."<td align=left><input name=rm size=4 maxlength=4 value='".htmlspecialchars($row["RM"], ENT_QUOTES)."'>"
  	."<input name=rmb size=5 maxlength=5 value='".plus($row["RMB"]).htmlspecialchars($row["RMB"], ENT_QUOTES)."'></td>"
  	."</tr>\n";
echo "<tr><td align=right>MM</td>"
	."<td align=left><input name=mm size=4 maxlength=4 value='".htmlspecialchars($row["MM"])."'>"
  	."<input name=mmb size=5 maxlength=5 value='".plus($row["MMB"]).htmlspecialchars($row["MMB"])."'></td>"
  	."</tr>\n";
# fin de la 1ère table
echo "</table>\n";
echo "<br>&nbsp;<br>\n";
# début de la 2nde table
echo "<table cellspacing=0 border=1 cellpadding=1 class=impair>\n";
echo "<tr><td align=right>Nom (complet) du Troll</td><td align=left>".$row[nom_troll]."></td></tr>\n";
echo "<tr><td align=right>Joueur</td><td class=pair align=left><input name=joueur size=50 maxlength=50 value='".htmlspecialchars($row["Joueur"], ENT_QUOTES)."'></td></tr>\n";
echo "<tr><td align=right>Age du Joueur</td><td class=pair align=left><input name=agejoueur size=3 maxlength=3 value='".htmlspecialchars($row["AgeJoueur"], ENT_QUOTES)."'></td></tr>\n";
echo "<tr><td align=right>Ville du Joueur</td><td class=pair align=left><input name=villejoueur size=50 maxlength=50 value='".htmlspecialchars($row["VilleJoueur"], ENT_QUOTES)."'></td></tr>\n";
echo "<tr><td align=right>MSN</td><td class=pair align=left><input name=msn size=50 maxlength=255 value='".htmlspecialchars($row["MSN"], ENT_QUOTES)."'></td></tr>\n";
echo "<tr><td align=right>ICQ</td><td class=pair align=left><input name=icq size=20 maxlength=20 value='".htmlspecialchars($row["ICQ"], ENT_QUOTES)."'></td></tr>\n";
echo "<tr><td align=right>Email</td><td class=pair align=left><input name=email size=50 maxlength=255 value='".htmlspecialchars($row["EMail"], ENT_QUOTES)."'></td></tr>\n";
echo "<tr><td align=right>Divers</td><td class=pair align=left><textarea name=divers cols=50 rows=5>".htmlspecialchars($row["Divers"], ENT_QUOTES)."</textarea></td></tr>\n";
# fin de la 2nde table
echo "</table>\n";

echo "<br>&nbsp;<br>\n";
# début de la 3ème table
echo "<table cellspacing=0 border=1 cellpadding=1 class=impair>\n";
echo "<tr><td colspan=2 align=center><b>Sorts Appris</b></td></td></tr>\n";
foreach ($sorts as $acr => $label)
	{
		echo "<tr><td align=right>$label</td><td class=pair align=left><input type=checkbox name=input$acr value=\"gotit\"".($row["Sort$acr"]?" CHECKED":"")."></td></tr>\n";
	}
# fin de la 2nde table
echo "</table>\n";

# le bouton de validation
echo "<br><input type=submit value=\"Mettre à Jour\">\n";

echo "</form>\n";
echo "</center>\n";

//echo "<br><a href=\"login.php?login=1&id=".$id."\" target=\"_parent\">Se déconnecter</a>";
include_once('../top.php');
?>

