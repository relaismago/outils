<?
session_start();

include_once ( "../admin_functions_db.php3" );

setlocale (LC_TIME, 'fr_FR.ISO8859-1');

$guildsid = $_REQUEST['guildsid'];

if ($_SESSION['AuthGuilde'] == 450) 
{
	echo "try { \n";

	for ( $i = 0; $i < count( $guildsid ); $i++ )
	{
		$arrInfos = explode ( ";", $guildsid[$i] );
		$id_guild = $arrInfos[0];
		$rang = $arrInfos[1];

		$lesGuildes = selectDbGuildes ( $id_guild, "" );
		$res = $lesGuildes[1];
		$statut_guilde = $res[statut_guilde];

		if ($guildsid[$i] == 450 )
		{
				echo "tableTrolls[$rang].childNodes[5].setAttribute( 'background', '' ); \n";
				echo "tableTrolls[$rang].childNodes[5].setAttribute( 'bgcolor', colorRM ); \n";
		}
		else
		{
			if ( $statut_guilde != "neutre" && $statut_guilde != "" )
			{
				echo "tableTrolls[$rang].childNodes[5].setAttribute( 'background', '' ); \n";
				if ( $statut_guilde == "tk" )
				{
					echo "tableTrolls[$rang].childNodes[5].setAttribute( 'bgcolor', colorTK ); \n";
				}
				if ( $statut_guilde == "ennemie")
				{
  				echo "tableTrolls[$rang].childNodes[5].setAttribute( 'bgcolor', colorEnemy ); \n";
				}
				if ( $statut_guilde == "amie" )
				{
  				echo "tableTrolls[$rang].childNodes[5].setAttribute( 'bgcolor', colorFriend ); \n";
				}
				if ( $statut_guilde == "alliee" )
				{
  				echo "tableTrolls[$rang].childNodes[5].setAttribute( 'bgcolor', colorAlly );\n";
				}
			}
		}
	}
echo "} catch ( e ) { error ( e, 'Guild Colouring error' ); }\n";
}

?>
