<?
include_once ("../functions_auth.php");
include_once ( "../admin_functions_db.php" );

setlocale (LC_TIME, 'fr_FR.ISO8859-1');

$placesId = $_REQUEST['placesId'];
$begin = $_REQUEST['begin'];

if ($_SESSION['AuthGuilde'] == 450) 
{
	echo "try { \n";
	
	for ( $i = 0; $i < count ( $placesId ); $i++ )
	{
		$rang = $i*2 + $begin;
		
		$sql = " SELECT id_troll_taniere";
		$sql .= " FROM tanieres";
		$sql .= " WHERE id_taniere = $placesId[$i]";

		$result=mysql_query($sql,$db_vue_rm);
    	if (mysql_error()) { echo "alert('".mysql_error()."');"; }

	    if (mysql_num_rows($result)>0)
	    {
			  echo "tablePlaces[$rang].setAttribute ( 'class', '' ); \n";
			  echo "tablePlaces[$rang].setAttribute ( 'style', 'background-color:' + colorRM ); \n";
	    }
	}
echo "} catch ( e ) { error ( e, 'Troll Colouring error' ); } \n";
}

?>
