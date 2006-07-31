<?
//***********************************************************************
// fonctions de statistiques
//***********************************************************************

/************************************************************************
* TODO :																*
* pour trolls : valeur avec x, y ou n non fixés
*************************************************************************/

/* fonctions pour troll ***********************************************************************************/

function getNumberOfTrolls($xmin,$xmax,$ymin,$ymax,$nmin,$nmax)
{
	$sql = "SELECT * FROM trolls WHERE";
	$sql .= " (x_troll BETWEEN $xmin AND $xmax)";
	$sql .= " AND (y_troll BETWEEN $ymin AND $ymax)";
	$sql .= " AND (z_troll BETWEEN $nmin AND $nmax)";
	$sql .= " AND is_seen_troll ='oui'";
	
	$result=mysql_query($sql);

	$n=mysql_num_rows($result);
	mysql_free_result($result);
	return $n;
}


/* fonctions pour monstres ********************************************************************************/

function getNumberOfMonsters($xmin,$xmax,$ymin,$ymax,$nmin,$nmax)
{

	$sql = "SELECT * FROM monstres WHERE ";
	$sql .= " (x_monstre BETWEEN $xmin AND $xmax)";
	$sql .= " AND (y_monstre BETWEEN $ymin AND $ymax)";
	$sql .= " AND (z_monstre BETWEEN $nmin AND $nmax);";
	$result=mysql_query($sql);

	$n=mysql_num_rows($result);
	mysql_free_result($result);
	return $n;
}

?>
