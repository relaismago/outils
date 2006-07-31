<?php
include "top.php"; # CSS et JavaScript
?>

<style>
table.map	{border:0px; border-collapse:collapse; padding:0px; height:440px;width:440px; margin:auto;}
table.map tr {padding:0px; margin:0px; border:0px;}
table.map td {padding:0px; margin:0px; border:0px;}
table.map table.map	{width:100%; height:100%; padding:0px; margin:0px; border:1px solid #FFFFFF;}
table.map table.map td	{padding:0px; margin:0px; width:20px; height:20px; border:0px;}
table.map table.map td.empty	{background-color:#000000;}
table.map table.map td.low	{background-color:#9ACD32;}
table.map table.map td.medium	{background-color:#FFD700;}
table.map table.map td.high	{background-color:#FFA500;}
table.map table.map td.max	{background-color:#FF0000;}
</style>

<DIV class=popperlink id=topdecklink></DIV>
<SCRIPT language="JavaScript" src="vue.js">
</SCRIPT>

<p>

<?

if (isset($HTTP_POST_VARS['nmin'])) {
	$nmin=min($HTTP_POST_VARS['nmin'],$HTTP_POST_VARS['nmax']);
	$nmax=max($HTTP_POST_VARS['nmin'],$HTTP_POST_VARS['nmax']);
} else {
	$nmin=-100; $nmax=0;
}

include("./inc_connect.php3");
include("./statFunctions.php");

?>

<!--
<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
<p>Limiter la carte aux profondeurs comprises entre <input type="text" size="2" name="nmin" value="<?=$nmin?>" /> et <input type="text" size="2" name="nmax" value="<?=$nmax?>" />
<input type="submit" value="Valider" />
</p>
</form>
-->
  <table class='mh_tdborder' width='60%' align="center">
   <tr><td>
     <table width='100%' cellspacing='0'>
       <tr class='mh_tdtitre' align="center">
         <td>
						<h2>Concentration trollienne</h2>
           </td>
       </tr>
     </table>
    </td></tr>
  </table>
	<br>

 <table class='mh_tdborder' width='60%' align="center">
   <tr><td>
     <table width='100%' cellspacing='0'>
       <tr class='mh_tdpage' align="center">
         <td>
					Cet outil utilise un cache. Le cache expire au bout de 24h et est mis à jour lors du premier appel de cette page suivant son expiration. <br>
					Autrement dit : ça ira assez vite la plupart du temps, mais ça prendra parfois beaucoup plus de temps puisque le cache sera mis à jour.
         </td>
       </tr>
     </table>
   <tr class='mh_tdpage'><td width='50%' align="center">


<?php

if (file_exists("./vues/cache_statistiques.txt")) $date=filemtime("./vues/cache_statistiques.txt");
else $date=0;

if(time()-$date>3600*24) {
	$cache=fopen("./vues/cache_statistiques.txt","w");
	$val=0;
		for($j=1;$j>-3;$j--) {
			for($i=-2;$i<2;$i++) {
				for($y=4;$y>-1;$y--) {
					for($x=0;$x<5;$x++) {
						$n=getNumberOfTrolls(50*$i+10*$x,50*$i+10*$x+9,50*$j+10*$y,50*$j+10*$y+9,$nmin,$nmax);
						fwrite($cache,$n.";");
						$val+=$n;
					}
				}
			}
		}
	fwrite($cache,$val.";");
	fclose($cache);
}

?>

<table class="map">

<?php	

$cache=fopen("./vues/cache_statistiques.txt","r");
$cache_txt=fread($cache,4096);
fclose($cache);
$cache_tab=explode(';',$cache_txt);

$cpt=0;

$val=0;

for($j=1;$j>-3;$j--) {
	echo("<tr>\n");
	
	for($i=-2;$i<2;$i++) {
		echo "<td>";
		echo '<table class="map">';

		for($y=4;$y>-1;$y--) {
			echo "<tr>";

			for($x=0;$x<5;$x++) {
				echo '<td class="';

				$n=$cache_tab[$cpt]; $cpt++;
				if($n==0) echo "empty";
				elseif($n<21) echo "low";
				elseif($n<41) echo "medium";
				elseif($n<61) echo "high";
				else echo "max";

				echo '">';
				echo "</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
		echo "</td>";
	}
	echo "</tr>";
}
?>
</table>
</td></tr>
</table>
<br>

<table width="98%" cellspacing="1" border="0" cellpadding="1" class="mh_tdborder" align="center">
  <tr class="mh_tdpage">
      <td align="center">
<p>Au total : <?=$cache_tab[$cpt]?> trolls.</p>

<p>Chaque zone représente un carré de 10 cases sur 10 cases. Les carrés encadrés de blancs représentent 50 cases sur 50 cases. Le code des couleurs est le suivant :</p>
<ul>
<li>en noir : pas de trolls dans la zone</li>
<li>en vert : 20 trolls ou moins</li>
<li>en jaune : entre 21 et 40 trolls</li>
<li>en orange : entre 41 et 60 trolls</li>
<li>en rouge : 61 trolls ou plus</li>
</ul>
<p>Attention : n'oubliez pas qu'il ne s'agit que des concentrations de trolls vus par des Relais &amp; Mago ! Par conséquent, les trolls camouflés ne sont pas comptés, et la mise à jour ne se fait que lorsqu'un troll se trouve à proximité de la case concernée.</p>

      </td>
  </tr>
</table>
<br>


<? include('foot.php'); ?>
