<?
function editDbOptions($id_troll_option,$display_mouches_option,$display_noms_mouches_option,$refresh_dla_option)
{
  global $db_vue_rm;

  $date_option = date("Y-m-d H-i-s");
	
	$sql = "UPDATE options ";
	$sql .= "SET display_mouches_option = '$display_mouches_option', ";
	$sql .= " display_noms_mouches_option = '$display_noms_mouches_option', ";
	$sql .= " refresh_dla_option = '$refresh_dla_option', ";
	$sql .= " date_option = '$date_option' ";
	$sql .= "WHERE id_troll_option = $id_troll_option ";
	
	mysql_query($sql);

	return mysql_error();
}

function selectDbOptions($id_troll="")
{
	global $db_vue_rm;
	
	if ($id_troll == "")
		$id_troll = $_SESSION['AuthTroll'];
		
	$sql = " SELECT id_troll_option, date_option, display_mouches_option, display_noms_mouches_option,";
	$sql .= " refresh_dla_option";

	$sql .= " FROM options";
	$sql .= " WHERE id_troll_option = $id_troll";

	if (!$result=mysql_query($sql,$db_vue_rm)) {
	  echo mysql_error();
	} else {
		$i=1;
		while ($options = mysql_fetch_assoc($result)) {
			$lesOptions[$i]['id_troll_option']=$options['id_troll_option'];
			$lesOptions[$i]['date_option']=$options['date_option'];
			$lesOptions[$i]['display_mouches_option']=$options['display_mouches_option'];
			$lesOptions[$i]['display_noms_mouches_option']=$options['display_noms_mouches_option'];
			$lesOptions[$i]['refresh_dla_option']=$options['refresh_dla_option'];
			$i++;
		}
	}

	return $lesOptions;
	
	}

?>
