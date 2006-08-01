<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>

<HEAD>
    <TITLE>AMotron</TITLE>
<STYLE type="text/css">
<?php
	include('stylesheet.css');
?>	 
</STYLE>
</HEAD>

<BODY bgcolor="#30395D" TEXT="#00FF00" link="red" vlink="black">

<center>
<?php
function heure($temps)
{
	$h = floor($temps / 60);
	$m = $temps % 60;
	return $h."h".($m<10?"0":"").$m;
}
#$DLA = 618; # durée de la DLA
#$PE = 108; # poids de l'équipement
#$BDLA = 80; # bonus de DLA
#$REG = 12; # régèn moyenne
#$maxPVs = 70;
# déterminer l'accélération maximale

$DLA = $_REQUEST["DLA"];
$PE =  $_REQUEST["PE"];
$BDLA =  $_REQUEST["BDLA"];
$REG =  $_REQUEST["REG"];
$maxPVs =  $_REQUEST["maxPVs"];

$AMmax = floor(($DLA + (($PE-$BDLA)>0?($PE-$BDLA):0))/30)+1;
$params = array (
		  5 => 3,
		  6 => 4,
		  7 => 4,
		  8 => 3,
		  9 => 4,
		 10 => 4,
		 11 => 4,
		 12 => 3,
		 13 => 3,
		 14 => 4,
		 15 => 4,
		 16 => 4,
		 17 => 4,
		 18 => 3,
		 19 => 3,
		 20 => 3,
		 21 => 4,
		 22 => 4,
		 23 => 4,
		 24 => 4,
		 25 => 4,
		 26 => 4,
		 27 => 3
		);
echo "<table cellspacing=2 cellpadding=2 border=1>\n";
echo "<tr>\n";
echo "<th rowspan=2>Fatigue visée</th>\n";
echo "<th colspan=2>Temps pour jouer 1 PA</th>\n";
echo "<th colspan=2>Temps pour jouer 6 PAs</th>\n";
echo "<th rowspan=2>Nb de PAs<br>joués en 24h<br>\n";
echo "</tr>\n";
echo "<tr>\n";
echo "<th>min</th>\n";
echo "<th>hhmm</th>\n";
echo "<th>min</th>\n";
echo "<th>hhmm</th>\n";
echo "</tr>\n";
foreach($params as $FATciblee => $FATdepart)
  {
  	if ($FATciblee > $AMmax) {break;}
#  	echo "FATciblee=".$FATciblee." FATdepart=".$FATdepart."<br>\n";
    $reg_insuffisante = 0;
    # ================================
    # ==== 8 cycles avec AM réussie ====
    # ================================
    # ==== 1ère DLA ====
    # calcul du malus de départ
    $MT = $PE - $BDLA;
    $MT = ($MT<0?0:$MT);
#		echo "malus MT=".$MT."<br>\n";
    $T = $DLA + $MT - 30*($FATciblee-$FATdepart); # temps total
#    echo "1er T = ".heure($T)."<br>\n";
    $PAs = 4;
#    echo "1er PAs = ".$PAs."<br>\n";
    $PVs = $FATciblee-$FATdepart; # PVs en manque
#    echo "1er PVs = ".$PVs."<br>\n";
    # ==== DLAs successives
    $FATencours = floor($FATciblee / 1.5);
#    echo "calcul fatigue pour 2ème DLA, FATencours = ".$FATencours."<br>\n";
    $noDLA=1;
    while ($FATencours > 4)
      {
      	$noDLA++;
#    		echo "Début DLA no = ".$noDLA."<br>\n";      	
				$MT = $PE + floor($PVs / $maxPVs * 250) - $BDLA;
				$MT = ($MT<0?0:$MT);
#				echo "malus MT=".$MT."<br>\n";
				$T += $DLA + $MT;
#				echo $noDLA."ème T = ".heure($T)."<br>\n";
    		$PAs += 6;
#				echo $noDLA."ème PAs = ".$PAs."<br>\n";
    		$PVs -= $REG;
				if ($PVs < 0) {$PVs=0;}
#				echo $noDLA."ème PVs (après REG) = ".$PVs."<br>\n";
				$FATencours = floor($FATencours / 1.5);
#				echo "calcul fatigue pour ".($noDLA+1)."ème DLA, FATencours = ".$FATencours."<br>\n";
      }
    # on regarde si la regen est suffisante
    if ($PVs - $REG > 0) {$reg_insuffisante = 1;}

    # on multiplie par 8 pour obtenir le résultat sur 8 DLAs
    $T *= 8;
    $PAs *= 8;
#		echo "pour les 8 cycles T = ".heure($T)."<br>\n";
#    echo "pour les 8 cycles PAs = ".$PAs."<br>\n";
    				

    # ====================================================
    # ==== 1 cycle raté enchaîné avec 1 cycle réussi ====
    # ====================================================
    # ==== cycle raté ====
#    echo "début cycle raté<br>\n";
    $MT = $PE - $BDLA;
    $MT = ($MT<0?0:$MT);
#    echo "malus MT=".$MT."<br>\n";

    $T += $DLA + $MT;
#    echo "1er T = ".heure($T)."<br>\n";
    $PAs += 4;
#    echo "1er PAs = ".$PAs."<br>\n";
   

    # ==== cycle réussi
#    echo "début cycle réussi<br>\n";
    $FATdepart = floor($FATdepart / 1.5);
#    echo "nouveau FATdepart=".$FATdepart."<br>\n";
    $T += $DLA + $MT - 30*($FATciblee-$FATdepart);
#    echo "1er T = ".heure($T)."<br>\n";
    $PAs += 4;
#    echo "1er PAs = ".$PAs."<br>\n";
   	$PVs = $FATciblee-$FATdepart;
#    echo "1er PVs = ".$PVs."<br>\n";
		# ==== DLAs successives
    $FATencours = floor($FATciblee / 1.5);
#    echo "calcul fatigue pour 2ème DLA, FATencours = ".$FATencours."<br>\n";
    $noDLA=1;
    while ($FATencours > 4)
      {
				$noDLA++;
#    		echo "Début DLA no = ".$noDLA."<br>\n";      	
				$MT = $PE + floor($PVs / $maxPVs * 250) - $BDLA;
				$MT = ($MT<0?0:$MT);
#				echo "malus MT=".$MT."<br>\n";
				$T += $DLA + $MT;
#				echo $noDLA."ème T = ".heure($T)."<br>\n";
    		$PAs += 6;
#				echo $noDLA."ème PAs = ".$PAs."<br>\n";
    		$PVs -= $REG;
				if ($PVs < 0) {$PVs=0;}
#				echo $noDLA."ème PVs (après REG) = ".$PVs."<br>\n";
				$FATencours = floor($FATencours / 1.5);
#				echo "calcul fatigue pour ".($noDLA+1)."ème DLA, FATencours = ".$FATencours."<br>\n";
      }
    # on regarde si la regen est suffisante
    if ($PVs - $REG > 0) {$reg_insuffisante = 1;}

    # ================================
    # ==== affichage du résultat ====
    # ================================
    echo "<tr><td align=center><b>".$FATciblee."</b></td>";
    if ($reg_insuffisante)
      {
				echo "<td colspan=5 align=center>REG insuffisante</td>";
      }
    else
      {
				printf("<td align=center>%.2f</td>", $T / $PAs);
				echo "<td align=center>".heure(floor($T / $PAs))."</td>\n";
				printf("<td align=center>%.2f</td>", $T / $PAs * 6);
				echo "<td align=center>".heure(floor($T / $PAs * 6))."</td>\n";
				printf("<td align=center code=alerte>%.2f</td>", $PAs * 60 * 24 / $T);
			}
    echo "</tr>\n";
 }
echo "</table>\n";

?>
</center>

</BODY>
</HTML>
