<?
session_start();
include_once ( "../admin_functions_db.php3" );

$compoNames = $_REQUEST['compo'];
$rang = $_REQUEST['tr'];
//$begin = $_REQUEST['begin'];

$nbCompos = count ( $compoNames );


if ($_SESSION['AuthGuilde'] == 450)
{
  for ( $i = 0; $i < $nbCompos; $i++ )
	  {
		    //$rang = $i + $begin;
					$race = $compoNames[$i];
					
					$sql = " SELECT id_composant, priorite_composant, id_race_composant";
					$sql .= " FROM composants";
					$sql .= " WHERE id_race_composant = '".addslashes($race)."'";
        	$result = mysql_query ( $sql, $db_vue_rm );
	      	if ( mysql_error () ) { echo "alert ('".mysql_error()."');";}
	      	if ( mysql_num_rows ( $result ) > 0)
	      	{
						$j=$rang[$i];
						echo "arrTr[$j].setAttribute ( 'class', '' );";
						echo "arrTr[$j].setAttribute ( 'style', 'background-color:' + colorSearch );";
					}
		}
}

?>
