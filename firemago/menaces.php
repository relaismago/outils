<?php
global $Auth, $AuthTroll, $AuthGuilde;

session_start ();

include_once ( "../inc_connect.php" );
include_once ( "inc_FM_authent.php" );

// ----------------------------------------
// Main
// ----------------------------------------
if ( userIsLogged () )
{
	$x = $_REQUEST['x'];
	$y = $_REQUEST['y'];
	$z = $_REQUEST['n'];
	$dist_max = $_REQUEST['distmax'];;
	
	$sql = "SELECT x_monstre, y_monstre, z_monstre, GREATEST( ABS($x - x_monstre), ABS($y - y_monstre), ABS($z - z_monstre)) as dist,";
	$sql .= " id_monstre, nom_monstre";
	$sql .= " FROM monstres, best_races";
	$sql .= " WHERE nom_monstre like CONCAT('%',nom_race,'%')";
	$sql .= " AND commentaire like 'Mythique'";
	$sql .= " AND GREATEST( ABS($x - x_monstre), ABS($y - y_monstre), ABS($z - z_monstre)) <= $dist_max";
	$sql .= " ORDER BY dist";
	//$sql .= " AND is_seen_monstre = 'oui'";
	
	$html="<div>";
	
	$res=mysql_query($sql, $db_vue_rm);
	if (mysql_errror) echo mysql_error();
	if (mysql_num_rows($res) > 0)
	{
		$html.="<table class='mh_tdborder' width='98%' BORDER='0' CELLSPACING='1' CELLPADDING='2'>";
		$html.="<tr class='mh_tdtitre'><th colspan='10'>Les Mythiques</th></tr>";
		$html.="<tr class='mh_tdtitre'><td width='25'><b>Dist</b></td><td width='40'><b>Ref.</b></td><td><b>Nom</b></td><td width='25' align='center'><b>X</b></td><td width='25' align='center'><b>Y</b></td><td width='25' align='center'><b>N</b></td></tr>";
		while ($row = mysql_fetch_array($res))
		{
			$s=preg_split("/[\[\]]/",$row[5]);
  			$Monstre=htmlspecialchars(trim($s[0]));
  			$Age=htmlspecialchars(trim($s[1]));
			$html.="<tr class='mh_tdpage'><td>$row[3]</td><td><a href='javascript:EMV($row[4],750,550)' class='mh_monstres'>".$row[4]."</a></td><td><a href='http://$_SERVER[SERVER_NAME]/bestiaire2/bestiaire.php?Monstre=$Monstre&amp;Age=$Age' class='mh_monstres'>".htmlspecialchars($row[5])."</a></td><td align='center'>".$row[0]."</td><td align='center'>".$row[1]."</td><td align='center'>".$row[2]."</td></tr>";
		}
		$html.="</table>";
	}
	
	$sql = "SELECT x_troll, y_troll, z_troll, GREATEST( ABS($x - x_troll), ABS($y - y_troll), ABS($z - z_troll)) as dist,";
	$sql .= " id_troll, nom_troll, nom_guilde, is_seen_troll, date_format(date_troll,'%d/%m/%Y'), id_guilde";
	$sql .= " FROM trolls, guildes";
	$sql .= " WHERE (is_tk_troll='oui'";
	$sql .= " OR is_wanted_troll='oui' OR statut_guilde IN ('tk','ennemie'))";
	$sql .= " AND GREATEST( ABS($x - x_troll), ABS($y - y_troll), ABS($z - z_troll)) <= $dist_max";
	$sql .= " AND guilde_troll=id_guilde";
	$sql .= " ORDER BY dist";
	
	$res=mysql_query($sql, $db_vue_rm);
	if (mysql_errror) echo mysql_error();
	if (mysql_num_rows($res) > 0)
	{
		$html.="<table class='mh_tdborder' width='98%' BORDER='0' CELLSPACING='1' CELLPADDING='2'>";
		$html.="<tr class='mh_tdtitre'><th colspan='10'>Les méchants trolls</th></tr>";
		$html.="<tr class='mh_tdtitre'><td width='25'><b>Dist</b></td><td width='40'><b>Ref.</b></td><td><b>Nom</b></td><td><b>Guilde</b></td><td width='25' align='center'><b>X</b></td><td width='25' align='center'><b>Y</b></td><td width='25' align='center'><b>N</b></td></tr>";
		while ($row = mysql_fetch_array($res))
		{
			$html.="<tr class='mh_tdpage'><td>$row[3]</td><td><a href='javascript:EPV($row[4],750,550)' class='mh_trolls_1'>".$row[4]."</a></td><td><a href='http://$_SERVER[SERVER_NAME]/engine_view.php?troll=$row[4]' class='mh_trolls_1'>".htmlspecialchars($row[5])."</a>";
			if ( $row[7] == 'non' )
			{
				$html.="<img height='20' src='http://$_SERVER[SERVER_NAME]/images/fantome-fixe.png' title='disparu le $row[8]'/>";
			}
			$html.="</td><td>";
			if ( $row[9] != 1)
			{
				$html.="[<a href='http://$_SERVER[SERVER_NAME]/engine_view.php?guilde=$row[9]' class='mh_links'>RG</a>] - ";
				$html.="<a href='javascript:EAV($row[9],750,550)' class='mh_links'>".htmlspecialchars($row[6])."</a>";
			}
			else
			{
				$html.=htmlspecialchars($row[6]);
			}
			$html.="</td><td align='center'>".$row[0]."</td><td align='center'>".$row[1]."</td><td align='center'>".$row[2]."</td></tr>";
		}
		$html.="</table>";
	}
	$html.="</div>";
}
else
{
	$html = "<p>Vous devez vous connecter pour voir les différentes menaces</p>";
}

echo "document.getElementById('danger').innerHTML=$html;";

?>