<?
session_start();
include_once ( "../admin_functions_db.php3" );

setlocale (LC_TIME, 'fr_FR.ISO8859-1');

$trollsid = $_REQUEST['trollsid'];
$begin = $_REQUEST['begin'];

if ($_SESSION['AuthGuilde'] == 450) 
{
	echo "try { \n";
	
	for ( $i = 0; $i < count ( $trollsid ); $i++ )
	{
		$lesTrolls = selectDbTrolls ( $trollsid[$i], "" );
		$res = $lesTrolls[1];
		$is_tk_troll = $res[is_tk_troll];
		$is_wanted_troll = $res[is_wanted_troll];
		$statut_troll = $res[statut_troll];
		$id_guilde_troll = $res[id_guilde];
		$rang = $i + $begin;
		//echo "alert($rang + ': ' + $trollsid[$i]);";
		//echo "alert('$id_guilde_troll');";
		

		if ($statut_troll != "neutre" && $statut_troll != "" )
		{
			echo "tableTrolls[$rang].childNodes[1].setAttribute ( 'background', '' ); \n";
    	echo "tableTrolls[$rang].childNodes[2].setAttribute ( 'background', '' ); \n";
			if ( $is_tk_troll == "oui" || $statut_troll == "tk" )
			{
				echo "tableTrolls[$rang].childNodes[1].setAttribute ( 'bgcolor', colorTK ); \n";
				echo "tableTrolls[$rang].childNodes[2].setAttribute ( 'bgcolor', colorTK ); \n";
			}
			if ( $is_wanted_troll == "oui" || $statut_troll == "ennemie")
			{
  			echo "tableTrolls[$rang].childNodes[1].setAttribute ( 'bgcolor', colorEnemy ); \n";
				echo "tableTrolls[$rang].childNodes[2].setAttribute ( 'bgcolor', colorEnemy ); \n";
			}
			if ( $statut_troll == "amie" )
			{
  			echo "tableTrolls[$rang].childNodes[1].setAttribute ( 'bgcolor', colorFriend ); \n";
				echo "tableTrolls[$rang].childNodes[2].setAttribute ( 'bgcolor', colorFriend ); \n";
			}
			if ( $statut_troll == "alliee" )
			{
  			echo "tableTrolls[$rang].childNodes[1].setAttribute ( 'bgcolor', colorAlly ); \n";
				echo "tableTrolls[$rang].childNodes[2].setAttribute ( 'bgcolor', colorAlly ); \n";
			}	
		}
		/*
		if ( $id_guilde_troll == "450" )
		{
			echo "tableTrolls[$rang].childNodes[1].setAttribute ( 'background', '' ); \n";
      echo "tableTrolls[$rang].childNodes[2].setAttribute ( 'background', '' ); \n";
			echo "tableTrolls[$rang].childNodes[1].setAttribute ( 'bgcolor', colorRM ); \n";
			echo "tableTrolls[$rang].childNodes[2].setAttribute ( 'bgcolor', colorRM ); \n";
		}
		*/
	}
echo "} catch ( e ) { error ( e, 'Troll Colouring error' ); } \n";
}

?>
