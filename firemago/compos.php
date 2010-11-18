<?
session_start();
include_once ( "../admin_functions_db.php" );


$compoIds = $_REQUEST['composId'];
$compoNames = $_REQUEST['compo'];
$begin = $_REQUEST['begin'];
$script = $_REQUEST['script'];

$nbCompos = count ( $compoIds );

if ($_SESSION['AuthGuilde'] == 450)
{
  for ( $i = 0; $i < $nbCompos; $i++ )
	  {
		      $rang = $i + $begin;

				//On cherche la race du composant (situé entre d'un(e) et de Qualité)

				$pos = strpos($compoNames[$i], "une");
				$nbcar = 4;
				if ($pos === false )
				{
					$pos = strpos($compoNames[$i], "un");
					$nbcar = 3;
				}

				//Si on trouve "d'un" ou "d'une" alors on cherche la race
				if ( $pos )
				{

					$race = substr ( $compoNames[$i], $pos + $nbcar, strpos ( $compoNames[$i], "de Qualité" ) - $pos - $nbcar -1);
					$loc = substr ($compoNames[$i],strpos ( $compoNames[$i], "["), strpos ( $compoNames[$i], "]") - strpos ( $compoNames[$i], "[")+1);
					$loc = htmlentities($loc);
					
					$sql = " SELECT id_composant, priorite_composant, commentaire_composant";
					$sql .= " FROM composants";
					$sql .= " WHERE id_race_composant = '".addslashes($race)."' AND ( commentaire_composant like '".$loc."' OR commentaire_composant like 'Mundidey%' )";
        	$result = mysql_query ( $sql, $db_vue_rm );
	      	if ( mysql_error () ) { echo "alert ('".mysql_error()."');";}
	      	if ( mysql_num_rows ( $result ) > 0 )
	      	{
					  	if ( $script == "gt" )
							{
								echo "nodes.snapshotItem($rang).childNodes[1].setAttribute ( 'class', '' );";
								echo "nodes.snapshotItem($rang).childNodes[3].setAttribute ( 'class', '' );";
								echo "nodes.snapshotItem($rang).childNodes[5].setAttribute ( 'class', '' );";
							}
							echo "nodes.snapshotItem($rang).setAttribute ( 'class', '' );";
							echo "nodes.snapshotItem($rang).setAttribute ( 'style', 'background-color:' + colorSearch );";
					}
				}
		}
}

?>
