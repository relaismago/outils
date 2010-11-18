<?
session_start();
include_once ( "../admin_functions_db.php" );

$compoNames = $_REQUEST['compo'];
$compoLoc = $_REQUEST['loc'];
$rang = $_REQUEST['tr'];

$nbCompos = count ( $compoNames );


if ($_SESSION['AuthGuilde'] == 450)
{
  for ( $i = 0; $i < $nbCompos; $i++ )
	  {
					$race = $compoNames[$i];
					
					$sql = " SELECT id_composant, priorite_composant, id_race_composant";
					$sql .= " FROM composants";
					$sql .= " WHERE id_race_composant = '".addslashes($race)."' AND ( commentaire_composant like '[".htmlentities($compoLoc[$i])."]' OR commentaire_composant like 'Mundidey%' )";
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
