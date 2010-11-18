<?php

if (defined("_INC_CONNECT")) return;
define("_INC_CONNECT", "1");

$GLOBALS['base_vue'] = '';
$GLOBALS['user_vue'] = '';
$GLOBALS['pass_vue'] = '';

if ($GLOBALS['db_vue_rm'] = mysql_connect('localhost',$GLOBALS['user_vue'],$GLOBALS['pass_vue'])) {
  if (mysql_select_db($GLOBALS['base_vue'])) {
    mysql_query('SET NAMES LATIN1',$db_vue_rm) or die(mysql_error());
    $GLOBALS['db_vue_rm_ok'] = !!mysql_num_rows(mysql_query('SELECT count(*) FROM trolls',$db_vue_rm));
  } else { echo "VUE RM ". mysql_error();}
} else { echo "VUE RM ". mysql_error();}



?>
