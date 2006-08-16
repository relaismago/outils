<?php

if (defined("_INC_CONNECT")) return;
define("_INC_CONNECT", "1");

$GLOBALS['base_vue'] = 'outilsrm';
$GLOBALS['user_vue'] = 'root';
$GLOBALS['pass_vue'] = '';

if ($GLOBALS['db_vue_rm'] = mysql_pconnect('localhost',$GLOBALS['user_vue'],$GLOBALS['pass_vue'])) {
  if (mysql_select_db($GLOBALS['base_vue'])) {
    $GLOBALS['db_vue_rm_ok'] = !!mysql_num_rows(mysql_query('SELECT * FROM trolls',$db_vue_rm));
  } else { echo "VUE RM ". mysql_error();}
} else { echo "Erreur de connexion à la base.". mysql_error();}

?>
