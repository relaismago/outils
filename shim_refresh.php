<?

/*****
Script utilisé pour le refresh auto des trolls de la guilde
*****/
	include_once("inc_define_vars.php");
	include_once("functions_auth.php");
	include_once("functions.php");

if (md5($_REQUEST['auto']) == MD5_PASS_EXTERNE) {
	if ($_REQUEST['refresh_error'] == 'oui')
		initRefreshAutoError();
	else
		initRefreshAuto();
}

function initRefreshAutoError()
{
	global $db_vue_rm;

  $date=date("Y-m-d H-i-s");
  $date_less_10_min=date("Y-m-d H-i-s", mktime(date("H"), date("i")-10, date("s"), date("m")  , date("d"), date("Y")));
  
  /* on prend une vue en erreur */
  $sql = "SELECT id_troll, nom_troll,date_last_refresh_himself_troll, lock_refresh_troll ";
  $sql .= " FROM trolls ";
  $sql .= " WHERE guilde_troll=".ID_GUILDE;
  $sql .= " AND lock_refresh_troll = 'oui'";
  $sql .= " AND is_pnj_troll = 0";
  $sql .= " AND date_last_refresh_himself_troll < '$date_less_10_min'";
	$sql .= " ORDER BY id_troll LIMIT 1";
	 
	$result=mysql_query($sql,$db_vue_rm);

	if (mysql_affected_rows() ==0)
		die("Pas d'erreur");
	
	echo mysql_error();
	$troll=mysql_fetch_assoc($result);
	
	$date=date("Y-m-d H-i-s");
	$tmpfile=fopen ("vues/list_refresh_auto.txt","a");
	fwrite($tmpfile,$date.":");
	fwrite($tmpfile,$troll[nom_troll]." (".$troll[id_troll].") (vue étant en erreur)\n");
	fclose($tmpfile);

	refreshVue($troll['id_troll'],$_REQUEST['auto']);
}

function initRefreshAuto()
{
	global $db_vue_rm;

	$sql = "SELECT COUNT(id_troll)";
	$sql .= " FROM trolls WHERE guilde_troll=".ID_GUILDE;
	$sql .= " AND pass_troll IS NOT NULL";

	$result=mysql_query($sql,$db_vue_rm);
	echo mysql_error();
	list($max_limite)=mysql_fetch_array($result);

	$limite=rand(0,$max_limite-1);
	 
  $date=date("Y-m-d H-i-s");
  $date_less_5_min=date("Y-m-d H-i-s", mktime(date("H"), date("i")-5, date("s"), date("m")  , date("d"), date("Y")));
 
  /* on regarde si la vue n'est pas en cours de refresh */
  $sql = "SELECT id_troll, nom_troll,date_last_refresh_himself_troll, lock_refresh_troll ";
  $sql .= " FROM trolls ";
  $sql .= " WHERE guilde_troll=".ID_GUILDE;
	$sql .= " AND pass_troll IS NOT NULL";
  //$sql .= " AND lock_refresh_troll = 'non'";
  //$sql .= " AND date_last_refresh_himself_troll > '$date_less_5_min'";
//	$sql .= " AND id_troll = 4570";
	$sql .= " ORDER BY id_troll LIMIT $limite,1";

	$result=mysql_query($sql,$db_vue_rm);
	echo mysql_error();
	$troll=mysql_fetch_assoc($result);
	
	$date=date("Y-m-d H-i-s");
	$tmpfile=fopen ("vues/list_refresh_auto.txt","a");
	fwrite($tmpfile,$date);
	fwrite($tmpfile,":");
	fwrite($tmpfile,$troll[nom_troll]." (".$troll[id_troll].")");
	if (!is_numeric($troll['id_troll'])) {
		fwrite($tmpfile,"Erreur détectée. sql=$sql");
		fwrite($tmpfile,"\n");
		fclose($tmpfile);
		die('Erreur detectée');
	}
	fwrite($tmpfile,"\n");
	fclose($tmpfile);
	refreshVue($troll['id_troll'],$_REQUEST['auto']);
}
?>
