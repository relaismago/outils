<?php

include_once('../top.php');

include_once('secure.php');

include('blason.php');

function non_vide($valeur_champ)
{
	return (strlen($valeur_champ)>=1);
}

function selectionner($champ, $critere_recu)
{
	if ($critere_recu==$champ)
	{
		return $champ." SELECTED";
	}
	else
	{
		return $champ;
	}
}
?>
<STYLE type="text/css">
<?php
  include('stylesheet.css');
	?>
	</STYLE>
<?

echo "<td>";

#=====================
# Les Stats de Guilde
#=====================
echo "<table border='5' class='mh_tdborder' cellpadding='0' cellspacing='1' align='center'>";
echo "<tr class='mh_tdpage'><td class='mh_tdtitre' align='center'><b>[<a href=statsdeguilde.php>les Stats de Guilde</a>]</td></tr>\n";
echo "<tr class='mh_tdpage'><td class='mh_tdtitre' align='center'><b>[<a href=stats_perso.php>Stats Perso</a>]</td></tr>\n";
echo "</table>";

#==============
# Les Critères
#==============
echo "<form action=\"vtt.php?id=".$_SESSION["AuthTroll"]."\" method=POST>\n";
?>
<table class='mh_tdborder' width='80%' align="center" >
  <tr><td class='mh_tdtitre' align="center">
     <img src='visiotrollotron_petit.gif' alt='Visiotrollotron'>
	</td>	 
  <td class='mh_tdpage'>

  <table width="90%" border="0" cellpadding="3" cellspacing="3">


<?
echo "<u>Crit&egrave;res de tri</u><br>\n";

for ($i=1; $i<=3; $i++)
{
	$crit_recu = $_REQUEST["c$i"];
	echo "<label>".$i.($i==1?"er":"i&egrave;me")." crit&egrave;re\n";
	echo "<select name=c".$i." size=1>\n";
	if ($i>1)
	{
		echo "<option value=aucun>(aucun)</option>\n";
	}
	echo "<option value=".selectionner("nom_troll",$crit_recu).">Pseudo</option>\n";
	echo "<option value=".selectionner("race_troll",$crit_recu).">Race</option>\n";
	echo "<option value=".selectionner("TDLA",$crit_recu).">DLA</option>\n";
	echo "<option value=".selectionner("TVUE",$crit_recu).">Vue</option>\n";
	echo "<option value=".selectionner("niveau_troll",$crit_recu).">Niveau</option>\n";
	echo "<option value=".selectionner("PVs",$crit_recu).">PVs</option>\n";
	echo "<option value=".selectionner("TREG",$crit_recu).">REG</option>\n";
	echo "<option value=".selectionner("TATT",$crit_recu).">ATT</option>\n";
	echo "<option value=".selectionner("TESQ",$crit_recu).">ESQ</option>\n";
	echo "<option value=".selectionner("TDEG",$crit_recu).">DEG</option>\n";
	echo "<option value=".selectionner("TARM",$crit_recu).">ARM</option>\n";
	echo "<option value=".selectionner("nb_kills_troll",$crit_recu).">KILLs</option>\n";
	echo "<option value=".selectionner("nb_morts_troll",$crit_recu).">D&eacute;c&egrave;s</option>\n";
	echo "<option value=".selectionner("TRM",$crit_recu).">RM</option>\n";
	echo "<option value=".selectionner("TMM",$crit_recu).">MM</option>\n";
	echo "<option value=".selectionner("NbSorts",$crit_recu).">Nb Sorts</option>\n";
	echo "</select></label>\n";
	echo "<label><img src=\"arrow_up5.gif\">\n";
	$ordre_recu = $_REQUEST["ordre$i"];
	echo "<input type=checkbox name=ordre".$i." value=\"croissant\"".($ordre_recu=="croissant"?" checked":"")."></label>\n";
}
echo "<input type=submit value=\"Go!\">\n";
echo "</form>\n";
echo "<br/>";
echo "<br/>";
echo "<form action=\"vtt.php?id=".$_SESSION["AuthTroll"]."\" method=POST>";
	echo "<label>Nom du sort/comp</label>\n";
	echo "<input name='nomCompSort' type='text' />\n";
	echo "<input type='submit' value='Rechercher' />";
echo "</form>";

#======================
# ecriture de la QUERY
#======================
$query = "SELECT *, -DLAH*60-DLAM as TDLA, VUE+VUEB as TVUE, REG*2+REGB as TREG, ATT*3.5+ATTB as TATT, ESQ*3.5+ESQB as TESQ, DEG*2+DEGB as TDEG, x_troll, y_troll, z_troll, race_troll, niveau_troll, "
				." ARM+ARMB as TARM, RM+RMB as TRM, MM+MMB as TMM, KILLs, DEADs,"
				." (TO_DAYS(NOW()) - TO_DAYS(DateMaj)) as Peremption"
				." from "._TABLEVTT_.", trolls"
				." WHERE id_troll = No";
if ( isset($_POST["nomCompSort"]) ){
	
	$query .= " AND ( Comps LIKE '%" .addslashes($_POST["nomCompSort"]). "%' OR Sorts LIKE '%" .addslashes($_POST["nomCompSort"]). "%' );"; 
	
} else if ( !isset($_REQUEST["c1"]) ) {
		
		$i=4;
		$query .= " ORDER BY nom_troll ";

} else {	
	# il y a au moins le 1er critère
	$query .= " ORDER BY CacherData ASC, ";
	for ($i=1; $i<=3; $i++){
		$critere = $_REQUEST["c$i"];
		# si c'est (aucun) qui a été choisi
		if ($i>1 and $critere=="aucun")
			$i=4;
		else {
			
			# il y a un critère positionné, différent de (aucun)
			if ($i>1)
				$query .= ",";
			$query .= " ".$critere;
			# récupération de l'ordre de ce critère
			$ordre = $_REQUEST["ordre$i"];
			$query .= ($ordre == "croissant") ? " ASC" : " DESC";
			
		}
	}
}

#========================
# Les indices de couleur
#========================
echo "</td></tr>";
echo "<tr class='mh_tdpage'><td>";
echo "date de dernière mise à jour";
echo "</td></tr>\n";

echo "<tr><td align=right>";
echo "<img src=\"bullet_green.gif\" alt=\"< 1 semaine\" title=\"< 1 semaine\"> moins d'une semaine. ";
echo "<img src=\"bullet_blue.gif\" alt=\"< 1 mois\" title=\"< 1 mois\"> moins d'1 mois. ";
echo "<img src=\"bullet_red.gif\" alt=\"> 1 mois\" title=\"> 1 mois\"> plus d'1 mois. ";
echo "<img src=\"bullet_white.gif\" alt=\"jamais\" title=\"jamais\"> jamais mis &agrave; jour. ";

echo "</td></tr></table>\n";

echo "</td></tr>";
echo "</table>\n";
#===================
# tables des avatars
#===================
echo "<br>\n";
?>

<table class='mh_tdborder' width='90%' align="center" >
  <tr><td>
    <table width='100%' cellspacing='0'>
      <tr class='mh_tdtitre' align="center">
<?
# exécution de la query
$query_result = my_mysql_query($query);

# initialisation du compteur de trolls pour le rangement
$no_troll = 1;
while ( $row = mysql_fetch_array($query_result) )
{
	if (($no_troll-1)%15 == 0)
	{
		# il faut afficher les entêtes
?>
<td colspan=3 align=center>Pseudo</td>
<td align=center>Race</td>
<td align=center>DLA</td>
<td align=center>Vue</td>
<td align=center>Niv</td>
<td align=center>PVs</td>
<td align=center>REG</td>
<td align=center>ATT</td>
<td align=center>ESQ</td>
<td align=center>DEG</td>
<td align=center>ARM</td>
<td align=center>KILLs</td>
<td align=center>Décès</td>
<td align=center>RM</td>
<td align=center>MM</td>
<td align=center>Sorts</td>
<td align=center>&nbsp;</td>
<td align=center>&nbsp;</td>
</tr>

 

<?php
	}
	
  $nom_blason = $row["nom_troll"];
  $no = $row["No"];
  $cacherdata = $row["CacherData"];

  //echo "<tr class=".(($no_troll%2)?"impair":"pair").">";
  echo "<tr class=mh_tdpage>";
// echo "<td>".$row["DateMaj"]."</td>\n";
  echo "<td align=center nowrap>";
	echo "$no_troll ";	
  echo "</td>";
  echo "<td align=center nowrap>";
	echo "<img src=\"bullet_"; 
	if ($row["DLAH"]=="") {
		echo "white.gif\" alt=\"jamais\" title=\"jamais\"";
	} else if ($row["Peremption"]<=7) {
		echo "green.gif\" alt=\"< 1 semaine\" title=\"< 1 semaine\"";
	} else if ($row["Peremption"]<=30) {
		echo "blue.gif\" alt=\"< 1 mois\" title=\"< 1 mois\"";
	} else {
		echo "red.gif\" alt=\"> 1 mois\" title=\"> 1 mois\"";
	} 
	echo "></td>\n";

	$text = initBlason($no);
  echo '<td align=center ';
  echo "onmouseover='return overlib(\"<font color=red> <b>Cliquez là où vous êtes !</b></font> <br>$text\");' ";
  echo "onclick='return overlib(\"$text\", STICKY, CAPTION, \"Informations Personnelles\", CLOSECLICK, EXCLUSIVE);' ";
  echo "onmouseout=\"return nd();\">";
	
	echo htmlspecialchars($nom_blason);

  echo "</td>\n";
  echo "<td align=center>"; 
	// Bouton Editer
	if ($_SESSION['AuthTroll'] == $row["No"]) {
		echo '&nbsp;<a href="parser_profil.php?id='.$row["No"].'" target="_parent"><img src="button_edit.png" alt="mettre à jour" border="0"></a>';
	}

	if (non_vide($row["race_troll"])) { echo htmlspecialchars($row["race_troll"]); } else { echo "&nbsp;"; } echo "</td>\n";
  if (!$cacherdata)
    {
      echo "<td align=center>"; if (non_vide($row["DLAH"])) { echo htmlspecialchars($row["DLAH"])."h".((non_vide($row["DLAM"]) and $row["DLAM"]<10)?"0":"").htmlspecialchars($row["DLAM"]); } else { echo "&nbsp;"; } echo "</td>\n";
      echo "<td align=center>"; if (non_vide($row["VUE"])) { echo htmlspecialchars($row["VUE"]).plus($row["VUEB"]).htmlspecialchars($row["VUEB"]); } else { echo "&nbsp;"; } echo "</td>\n";
    }
  else
    {
      echo "<td align=center>--</td>\n";
      echo "<td align=center>--</td>\n";
    }
  echo "<td align=center>"; if (non_vide($row["niveau_troll"])) { echo htmlspecialchars($row["niveau_troll"]); } else { echo "&nbsp;"; } echo "</td>\n";
  if (!$cacherdata)
    {
      echo "<td align=center>"; if (non_vide($row["PVs"])) { echo htmlspecialchars($row["PVs"]); } else { echo "&nbsp;"; } echo "</td>\n";
      echo "<td align=center>"; if (non_vide($row["REG"])) { echo htmlspecialchars($row["REG"])."D3".plus($row["REGB"]).htmlspecialchars($row["REGB"]); } else { echo "&nbsp;"; } echo "</td>\n";
      echo "<td align=center>"; if (non_vide($row["ATT"])) { echo htmlspecialchars($row["ATT"])."D6".plus($row["ATTB"]).htmlspecialchars($row["ATTB"]); } else { echo "&nbsp;"; } echo "</td>\n";
      echo "<td align=center>"; if (non_vide($row["ESQ"])) { echo htmlspecialchars($row["ESQ"])."D6".plus($row["ESQB"]).htmlspecialchars($row["ESQB"]); } else { echo "&nbsp;"; } echo "</td>\n";
      echo "<td align=center>"; if (non_vide($row["DEG"])) { echo htmlspecialchars($row["DEG"])."D3".plus($row["DEGB"]).htmlspecialchars($row["DEGB"]); } else { echo "&nbsp;"; } echo "</td>\n";
      echo "<td align=center>"; if (non_vide($row["ARM"])) { echo htmlspecialchars($row["ARM"]).plus($row["ARMB"]).htmlspecialchars($row["ARMB"]); } else { echo "&nbsp;"; } echo "</td>\n";
    }
  else
    {
      echo "<td align=center>--</td>\n";
      echo "<td align=center>--</td>\n";
      echo "<td align=center>--</td>\n";
      echo "<td align=center>--</td>\n";
      echo "<td align=center>--</td>\n";
      echo "<td align=center>--</td>\n";
    }
  echo "<td align=center>"; if (non_vide($row["KILLs"])) { echo htmlspecialchars($row["KILLs"]); } else { echo "&nbsp;"; } echo "</td>\n";
  echo "<td align=center>"; if (non_vide($row["DEADs"])) { echo htmlspecialchars($row["DEADs"]); } else { echo "&nbsp;"; } echo "</td>\n";
  if (!$cacherdata)
    {
      echo "<td align=center>"; if (non_vide($row["RM"])) { echo htmlspecialchars($row["RM"]).plus($row["RMB"]).htmlspecialchars($row["RMB"]); } else { echo "&nbsp;"; } echo "</td>\n";
      echo "<td align=center>"; if (non_vide($row["MM"])) { echo htmlspecialchars($row["MM"]).plus($row["MMB"]).htmlspecialchars($row["MMB"]); } else { echo "&nbsp;"; } echo "</td>\n";
			//$sort = preg_replace("/,/","<br>",htmlspecialchars($row["Sorts"]));
			$sort = htmlspecialchars($row["Sorts"]);
      echo "<td align=left>".$sort."&nbsp;</td>\n";
    }
  else
    {
      echo "<td align=center>--</td>\n";
      echo "<td align=center>--</td>\n";
      echo "<td align=center>--</td>\n";
    }

	$lien_fiche = "href='/engine_view.php?troll=".$row["No"]."'";
	$lien_stats = "href='/vtt/stats_perso.php?id_troll=".$row["No"]."'";

	echo "<td><a $lien_fiche><font color=black>[F]</font></a></td>";
	echo "<td><a $lien_stats><font color=black>[Stats]</font></a></td>";
  echo "</tr>";  
  
  $no_troll++;
}
$no_troll--;
?>

</table>
<h3>Nombre total de trolls : <?php echo $no_troll;?> </H3>

</center>
<?php

echo "</td></tr></table>"; // Fin tableau iframe
include('../foot.php');
?>
