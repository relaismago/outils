<?
session_start();
include_once ( "../admin_functions_db.php3" );

$compoIds = $_REQUEST['composId'];
$compoNames = $_REQUEST['compo'];
$begin = $_REQUEST['begin'];

$nbCompos = count ( $compoIds );


if ($_SESSION['AuthGuilde'] == 450)
{
  for ( $i = 0; $i < $nbCompos; $i++ )
	  {
		    //$rang = $i + $begin;

				//On cherche la race du composant (situé entre d'un(e) et de Qualité)

				$pos = strpos($compoNames[$i], "un");
				$nbcar = 3;
				if ($pos === false )
				{
					$pos = strpos($compoNames[$i], "une");
					$nbcar = 4;
				}

				//Si on trouve "d'un" ou "d'une" alors on cherche la race
				if ( $pos )
				{

					$race = substr ( $compoNames[$i], $pos + $nbcar, strpos ( $compoNames[$i], "de Qualité" ) - $pos - $nbcar -1);

					$sql = " SELECT id_composant, priorite_composant, id_race_composant";
					$sql .= " FROM composants";
					$sql .= " WHERE id_race_composant = '".addslashes($race)."'";
        	$result = mysql_query ( $sql, $db_vue_rm );
	      	if ( mysql_error () ) { echo "alert ('".mysql_error()."');";}
	      	if ( mysql_num_rows ( $result ) > 0)
	      	{
						echo "nodes.snapshotItem($i).setAttribute ( 'class', '' );";
						echo "nodes.snapshotItem($i).setAttribute ( 'style', 'background-color:' + colorSearch );";
					}
				}
		}
}

?>
