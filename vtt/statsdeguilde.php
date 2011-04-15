<?php
include_once('../top.php');
include('secure.php');

echo "<center>\n";

#=====================
# Les Stats de Guilde
#=====================
echo "<h1>Statistiques VTT de la guilde</h1>";
echo "<table border='5' class='mh_tdborder' cellpadding='2' cellspacing='1' align='center'><tbody>";

$query_result = my_mysql_query("SELECT * from "._TABLEVTT_."");
$nb_trolls = mysql_num_rows($query_result);
echo "<tr class='mh_tdpage'><td class='mh_tdtitre'>"
."Nombre de Trolls dans la Guilde : ".$nb_trolls
."</td></tr>\n";

$query_result = my_mysql_query("SELECT No from "._TABLEVTT_." WHERE Race IS NOT NULL");
$nb_trolls_vtt = mysql_num_rows($query_result);
echo "<tr class='mh_tdpage'><td class='mh_tdtitre'>"
."Nombre de Trolls \"VTT\" : ".$nb_trolls_vtt
."</td></tr>\n";

echo "<tr class='mh_tdpage'><td class='mh_tdtitre'>"
."<b>Toutes les Stats ci-dessous ne prennent en compte que les ".$nb_trolls_vtt." trolls renseignés dans le VTT</b>"
."</td></tr>\n";

$query_result = my_mysql_query("SELECT No from "._TABLEVTT_." WHERE `Race` = 'Kastar'");
$nb_kastars = mysql_num_rows($query_result);
$query_result = my_mysql_query("SELECT No from "._TABLEVTT_." WHERE `Race` = 'Tomawak'");
$nb_toms = mysql_num_rows($query_result);
$query_result = my_mysql_query("SELECT No from "._TABLEVTT_." WHERE `Race` = 'Skrim'");
$nb_skrims = mysql_num_rows($query_result);
$query_result = my_mysql_query("SELECT No from "._TABLEVTT_." WHERE `Race` = 'Durakuir'");
$nb_duraks = mysql_num_rows($query_result);
echo "<tr class='mh_tdpage'><td class='mh_tdtitre'>"
."R&eacute;partition :"
."<ul>"
."<li>Kastars : ".$nb_kastars." (".floor($nb_kastars*100/$nb_trolls_vtt)." %)"
."<li>Tomawaks : ".$nb_toms." (".floor($nb_toms*100/$nb_trolls_vtt)." %)"
."<li>Skrims : ".$nb_skrims." (".floor($nb_skrims*100/$nb_trolls_vtt)." %)"
."<li>Durakuirs : ".$nb_duraks." (".floor($nb_duraks*100/$nb_trolls_vtt)." %)"
."</ul>"
."</td></tr>\n";
$query_result = my_mysql_query("SELECT SUM(niveau_troll) as FF from "._TABLEVTT_.", trolls WHERE id_troll =No AND Race IS NOT NULL");
$row = mysql_fetch_array($query_result);
$FF = $row["FF"];
echo "<tr class='mh_tdpage'><td class='mh_tdtitre'>"
."Force de Frappe : ".$FF
."</td></tr>\n";

$query_result = my_mysql_query("SELECT SUM(niveau_troll) as FFK from "._TABLEVTT_.", trolls WHERE id_troll =No AND Race = 'Kastar'");
$row = mysql_fetch_array($query_result);
$FFK = $row["FFK"];
$query_result = my_mysql_query("SELECT SUM(niveau_troll) as FFT from "._TABLEVTT_.", trolls  WHERE id_troll =No AND Race = 'Tomawak'");
$row = mysql_fetch_array($query_result);
$FFT = $row["FFT"];
$query_result = my_mysql_query("SELECT SUM(niveau_troll) as FFS from "._TABLEVTT_.", trolls WHERE id_troll =No AND Race = 'Skrim'");
$row = mysql_fetch_array($query_result);
$FFS = $row["FFS"];
$query_result = my_mysql_query("SELECT SUM(niveau_troll) as FFD from "._TABLEVTT_.", trolls WHERE id_troll =No AND Race = 'Durakuir'");
$row = mysql_fetch_array($query_result);
$FFD = $row["FFD"];
echo "<tr class='mh_tdpage'><td class='mh_tdtitre'>"
."Niveaux moyens :"
."<ul>"
."<li>Guilde : ".round($FF/$nb_trolls_vtt,2)
."<li>Kastars : ".round($FFK/$nb_kastars,2)
."<li>Tomawaks : ".round($FFT/$nb_toms,2)
."<li>Skrims : ".round($FFS/$nb_skrims,2)
."<li>Durakuirs : ".round($FFD/$nb_duraks,2)
."</ul>\n"
."</td></tr>\n";

#################
# les Meilleurs #
#################
echo "<tr class='mh_tdpage'><td class='mh_tdtitre'>"
."Meilleurs :\n"
."<ul>\n";
$query_result = my_mysql_query("SELECT nom_troll, niveau_troll from "._TABLEVTT_." , trolls WHERE Race = 'Kastar' AND id_troll=No ORDER BY niveau_troll DESC");
$row = mysql_fetch_array($query_result);
$niveau_meilleur_kastar = $row["niveau_troll"];
$niv = $niveau_meilleur_kastar;
echo "<li>Kastar : Niveau ".$niveau_meilleur_kastar." (";
$cpt = 0;
while ($niv == $niveau_meilleur_kastar)
  {
    if ($cpt!=0) {echo ", ";}
    echo $row["nom_troll"];
    $row = mysql_fetch_array($query_result);
    $niv = $row["niveau_troll"];
    $cpt++;
  }
echo ")</li>\n";
$query_result = my_mysql_query("SELECT nom_troll, niveau_troll from "._TABLEVTT_.", trolls WHERE Race = 'Tomawak' AND id_troll = No ORDER BY niveau_troll DESC");
$row = mysql_fetch_array($query_result);
$niveau_meilleur_tom = $row["niveau_troll"];
$niv = $niveau_meilleur_tom;
echo "<li>Tomawak : Niveau ".$niveau_meilleur_tom." (";
$cpt = 0;
while ($niv == $niveau_meilleur_tom)
  {
    if ($cpt!=0) {echo ", ";}
    echo $row["nom_troll"];
    $row = mysql_fetch_array($query_result);
    $niv = $row["niveau_troll"];
    $cpt++;
  }
echo ")</li>\n";
$query_result = my_mysql_query("SELECT nom_troll, niveau_troll from "._TABLEVTT_.", trolls WHERE Race = 'Skrim' AND id_troll = No ORDER BY niveau_troll DESC");
$row = mysql_fetch_array($query_result);
$niveau_meilleur_skrim = $row["niveau_troll"];
$niv = $niveau_meilleur_skrim;
echo "<li>Skrim : Niveau ".$niveau_meilleur_skrim." (";
$cpt = 0;
while ($niv == $niveau_meilleur_skrim)
  {
    if ($cpt!=0) {echo ", ";}
    echo $row["nom_troll"];
    $row = mysql_fetch_array($query_result);
    $niv = $row["niveau_troll"];
    $cpt++;
  }
echo ")</li>\n";
$query_result = my_mysql_query("SELECT nom_troll, niveau_troll from "._TABLEVTT_.",trolls WHERE Race = 'Durakuir' AND id_troll = No ORDER BY niveau_troll DESC");
$row = mysql_fetch_array($query_result);
$niveau_meilleur_durak = $row["niveau_troll"];
$niv = $niveau_meilleur_durak;
echo "<li>Durakuir : Niveau ".$niveau_meilleur_durak." (";
$cpt = 0;
while ($niv == $niveau_meilleur_durak)
  {
    if ($cpt!=0) {echo ", ";}
    echo $row["nom_troll"];
    $row = mysql_fetch_array($query_result);
    $niv = $row["niveau_troll"];
    $cpt++;
  }
echo ")</li>\n";

echo "</ul>\n";
echo "</td></tr>\n";

###############
# les Killers #
###############
echo "<tr class='mh_tdpage'><td class='mh_tdtitre'>"
."Killers :\n"
."<ul>\n";
$query_result = my_mysql_query("SELECT nom_troll, nb_kills_troll from "._TABLEVTT_.", trolls WHERE id_troll = No ORDER BY nb_kills_troll DESC LIMIT 3");
for ($i=0; $i<3; $i++)
  {
    $row = mysql_fetch_array($query_result);
    echo "<li>".$row["nom_troll"]." (".$row["nb_kills_troll"]." meurtres)</li>\n";
  }
echo "</ul>\n";
echo "</td></tr>\n";

###############
# les Décédés #
###############
echo "<tr class='mh_tdpage'><td class='mh_tdtitre'>"
."D&eacute;c&eacute;d&eacute;s :\n"
."<ul>\n";
$query_result = my_mysql_query("SELECT nom_troll, nb_morts_troll from "._TABLEVTT_.", trolls WHERE id_troll = No ORDER BY nb_morts_troll DESC LIMIT 3");
for ($i=0; $i<3; $i++)
  {
    $row = mysql_fetch_array($query_result);
    echo "<li>".$row["nom_troll"]." (".$row["nb_morts_troll"]." d&eacute;c&egrave;s)</li>\n";
  }
echo "</ul>\n";
echo "</td></tr>\n";

####################
# le Troll Parfait #
####################
echo "<tr class='mh_tdpage'><td class='mh_tdtitre'>"
."Le Troll Parfait R&M :\n"
."<ul>\n";
$query_result = my_mysql_query("SELECT nom_troll, DLAH*60+DLAM as DLA, DLAH, DLAM from "._TABLEVTT_.", trolls WHERE DLAH*DLAM IS NOT NULL AND id_troll = No ORDER BY DLA ASC");
$row = mysql_fetch_array($query_result);
$best = $row["DLA"];
echo "<li>DLA : ".$row["DLAH"]."h".$row["DLAM"]." (";
$val = $best;
$cpt = 0;
while ($val == $best)
  {
    if ($cpt!=0) {echo ", ";}
    echo $row["nom_troll"];
    $row = mysql_fetch_array($query_result);
    $val = $row["DLA"];
    $cpt++;
  }
echo ")</li>\n";
$query_result = my_mysql_query("SELECT nom_troll, VUE*60+VUEB as TVUE, VUE, VUEB from "._TABLEVTT_.",trolls WHERE id_troll = No ORDER BY TVUE DESC");
$row = mysql_fetch_array($query_result);
$best = $row["TVUE"];
echo "<li>Vue : ".$row["VUE"].($row["VUEB"]>=0?"+":"").$row["VUEB"]." (";
$val = $best;
$cpt = 0;
while ($val == $best)
  {
    if ($cpt!=0) {echo ", ";}
    echo $row["nom_troll"];
    $row = mysql_fetch_array($query_result);
    $val = $row["TVUE"];
    $cpt++;
  }
echo ")</li>\n";
$query_result = my_mysql_query("SELECT nom_troll, niveau_troll from "._TABLEVTT_.",trolls WHERE id_troll = No ORDER BY niveau_troll DESC");
$row = mysql_fetch_array($query_result);
$best = $row["niveau_troll"];
echo "<li>Niveau : ".$row["niveau_troll"]." (";
$val = $best;
$cpt = 0;
while ($val == $best)
  {
    if ($cpt!=0) {echo ", ";}
    echo $row["nom_troll"];
    $row = mysql_fetch_array($query_result);
    $val = $row["niveau_troll"];
    $cpt++;
  }
echo ")</li>\n";
$query_result = my_mysql_query("SELECT nom_troll, PVs from "._TABLEVTT_.",trolls WHERE id_troll = No ORDER BY PVs DESC");
$row = mysql_fetch_array($query_result);
$best = $row["PVs"];
echo "<li>PVs : ".$row["PVs"]." (";
$val = $best;
$cpt = 0;
while ($val == $best)
  {
    if ($cpt!=0) {echo ", ";}
    echo $row["nom_troll"];
    $row = mysql_fetch_array($query_result);
    $val = $row["PVs"];
    $cpt++;
  }
echo ")</li>\n";
$query_result = my_mysql_query("SELECT nom_troll, REG*2+REGB as TREG, REG, REGB from "._TABLEVTT_.",trolls WHERE id_troll = No  ORDER BY TREG DESC");
$row = mysql_fetch_array($query_result);
$best = $row["TREG"];
echo "<li>REG : ".$row["REG"]."D3".($row["REGB"]>=0?"+":"").$row["REGB"]." (";
$val = $best;
$cpt = 0;
while ($val == $best)
  {
    if ($cpt!=0) {echo ", ";}
    echo $row["nom_troll"];
    $row = mysql_fetch_array($query_result);
    $val = $row["TREG"];
    $cpt++;
  }
echo ")</li>\n";
$query_result = my_mysql_query("SELECT nom_troll, ATT*3.5+ATTB as TATT, ATT, ATTB from "._TABLEVTT_.",trolls WHERE id_troll = No ORDER BY TATT DESC");
$row = mysql_fetch_array($query_result);
$best = $row["TATT"];
echo "<li>ATT : ".$row["ATT"]."D6".($row["ATTB"]>=0?"+":"").$row["ATTB"]." (";
$val = $best;
$cpt = 0;
while ($val == $best)
  {
    if ($cpt!=0) {echo ", ";}
    echo $row["nom_troll"];
    $row = mysql_fetch_array($query_result);
    $val = $row["TATT"];
    $cpt++;
  }
echo ")</li>\n";
$query_result = my_mysql_query("SELECT nom_troll, ESQ*3.5+ESQB as TESQ, ESQ, ESQB from "._TABLEVTT_.",trolls WHERE id_troll = No ORDER BY TESQ DESC");
$row = mysql_fetch_array($query_result);
$best = $row["TESQ"];
echo "<li>ESQ : ".$row["ESQ"]."D6".($row["ESQB"]>=0?"+":"").$row["ESQB"]." (";
$val = $best;
$cpt = 0;
while ($val == $best)
  {
    if ($cpt!=0) {echo ", ";}
    echo $row["nom_troll"];
    $row = mysql_fetch_array($query_result);
    $val = $row["TESQ"];
    $cpt++;
  }
echo ")</li>\n";
$query_result = my_mysql_query("SELECT nom_troll, DEG*2+DEGB as TDEG, DEG, DEGB from "._TABLEVTT_.",trolls WHERE id_troll = No ORDER BY TDEG DESC");
$row = mysql_fetch_array($query_result);
$best = $row["TDEG"];
echo "<li>DEG : ".$row["DEG"]."D3".($row["DEGB"]>=0?"+":"").$row["DEGB"]." (";
$val = $best;
$cpt = 0;
while ($val == $best)
  {
    if ($cpt!=0) {echo ", ";}
    echo $row["nom_troll"];
    $row = mysql_fetch_array($query_result);
    $val = $row["TDEG"];
    $cpt++;
  }
echo ")</li>\n";
$query_result = my_mysql_query("SELECT nom_troll, ARM+ARMB as TARM, ARM, ARMB from "._TABLEVTT_.",trolls WHERE id_troll = No ORDER BY TARM DESC");
$row = mysql_fetch_array($query_result);
$best = $row["TARM"];
echo "<li>ARM : ".$row["ARM"].($row["ARMB"]>=0?"+":"").$row["ARMB"]." (";
$val = $best;
$cpt = 0;
while ($val == $best)
  {
    if ($cpt!=0) {echo ", ";}
    echo $row["nom_troll"];
    $row = mysql_fetch_array($query_result);
    $val = $row["TARM"];
    $cpt++;
  }
echo ")</li>\n";
$query_result = my_mysql_query("SELECT nom_troll, nb_kills_troll from "._TABLEVTT_." ,trolls WHERE id_troll = No ORDER BY nb_kills_troll DESC");
$row = mysql_fetch_array($query_result);
$best = $row["nb_kills_troll"];
echo "<li>KILLs : ".$row["nb_kills_troll"]." (";
$val = $best;
$cpt = 0;
while ($val == $best)
  {
    if ($cpt!=0) {echo ", ";}
    echo $row["nom_troll"];
    $row = mysql_fetch_array($query_result);
    $val = $row["nb_kills_troll"];
    $cpt++;
  }
echo ")</li>\n";
$query_result = my_mysql_query("SELECT nom_troll, nb_morts_troll from "._TABLEVTT_.", trolls WHERE id_troll = No AND nb_morts_troll IS NOT NULL ORDER BY nb_morts_troll ASC");
$row = mysql_fetch_array($query_result);
$best = $row["nb_morts_troll"];
echo "<li>D&eacute;c&egrave;s : ".$row["nb_morts_troll"]." (";
$val = $best;
$cpt = 0;
while ($val == $best)
  {
    if ($cpt!=0) {echo ", ";}
    echo $row["nom_troll"];
    $row = mysql_fetch_array($query_result);
    $val = $row["nb_morts_troll"];
    $cpt++;
  }
echo ")</li>\n";
$query_result = my_mysql_query("SELECT nom_troll, MM+MMB as TMM, MM, MMB from "._TABLEVTT_." ,trolls WHERE id_troll = No ORDER BY TMM DESC");
$row = mysql_fetch_array($query_result);
$best = $row["TMM"];
echo "<li>MM : ".$row["MM"].($row["MMB"]>=0?"+":"").$row["MMB"]." (";
$val = $best;
$cpt = 0;
while ($val == $best)
  {
    if ($cpt!=0) {echo ", ";}
    echo $row["nom_troll"];
    $row = mysql_fetch_array($query_result);
    $val = $row["TMM"];
    $cpt++;
  }
echo ")</li>\n";
$query_result = my_mysql_query("SELECT nom_troll, RM+RMB as TRM, RM, RMB from "._TABLEVTT_." ,trolls WHERE id_troll = No ORDER BY TRM DESC");
$row = mysql_fetch_array($query_result);
$best = $row["TRM"];
echo "<li>RM : ".$row["RM"].($row["RMB"]>=0?"+":"").$row["RMB"]." (";
$val = $best;
$cpt = 0;
while ($val == $best)
  {
    if ($cpt!=0) {echo ", ";}
    echo $row["nom_troll"];
    $row = mysql_fetch_array($query_result);
    $val = $row["TRM"];
    $cpt++;
  }
echo ")</li>\n";
$query_result = my_mysql_query("SELECT nom_troll, NbSorts from "._TABLEVTT_." ,trolls WHERE id_troll = No ORDER BY NbSorts DESC");
$row = mysql_fetch_array($query_result);
$best = $row["NbSorts"];
echo "<li>Nb de Sorts : ".$row["NbSorts"]." (";
$val = $best;
$cpt = 0;
while ($val == $best)
  {
    if ($cpt!=0) {echo ", ";}
    echo $row["nom_troll"];
    $row = mysql_fetch_array($query_result);
    $val = $row["NbSorts"];
    $cpt++;
  }
echo ")</li>\n";

echo "</ul>\n";
echo "</td></tr>\n";



echo "</tbody></table>";



echo "</center>\n";
//echo "<a class=deconnecter href=\"login.php?login=1&id=".$id."\" target=\"_parent\">Se déconnecter</a>";

include_once('../foot.php');
?>

