<?
session_start();
include_once ( "../admin_functions_db.php3" );
include_once ( "../bestiaire2/Libs/functions.php" );
include_once ( "../bestiaire2/DB/inc_initdata.php" );

setlocale (LC_ALL, 'fr_FR.ISO8859-1');

echo "try { \n";
	
$monsterIds = $_REQUEST['monsterIds'];
$monsterNames = $_REQUEST['monsterNames'];
$monsterAges = $_REQUEST['monsterAges'];
$begin = $_REQUEST['begin'];

$nbMonsters = count ( $monsterIds );
	
if ($_SESSION['AuthGuilde'] == 450) 
{
	for ( $i = 0; $i < $nbMonsters; $i++ )
	{
		$rang = $i + $begin;
   
    $name=ereg_replace('[\\]',"",$monsterNames[$i]);
		
	 	$infos = getInfoFromMonstre($name);
		$caracs_moyennes = SelectCaracMoyMonstre($infos['id_race'],$infos['id_template'],$infos['id_age']);
		
		if ($caracs_moyennes[niv]!='?' && $caracs_moyennes[niv]!='') $niv = $caracs_moyennes['niv'];
		else $niv=$infos[niv];
		
		echo "
		var anchorRow = tableMonsters[$rang];
		var anchorCellID = tableMonsters[$rang].childNodes[1]; // ANCHOR
    var anchorCellDesc = tableMonsters[$rang].childNodes[2]; // ANCHOR
    var anchorID = anchorCellID.childNodes[0]; // ANCHOR
    var anchorDesc = anchorCellDesc.getElementsByTagName ( 'a' )[0]; // ANCHOR
		var monsterStyle = new String ( anchorDesc.getAttribute ( 'class' ) );
		";
		
		echo "
		var newTd = document.createElement ( 'td' );
		newTd.setAttribute ( 'align', 'center');
		newTd.appendChild( document.createTextNode ( '$niv' ));
		//anchorRow.insertBefore( newTd, anchorCellDesc );
		anchorRow.appendChild (newTd );
		";
	  
		//Link of the ID
		echo "
		var newLink = document.createElement ( 'a' );
    newLink.appendChild ( document.createTextNode ( '$monsterIds[$i]' ) );
    newLink.setAttribute ( 'class', monsterStyle );
    newLink.setAttribute ( 'href', 'javascript:EMV($monsterIds[$i] ,750,550)' );
   	anchorCellID.removeChild ( tableMonsters[$rang].childNodes[1].childNodes[0] );
   	anchorCellID.appendChild ( newLink );
		var newLink = document.createElement ( 'a' );
		";
		
		//gowap from the guild
		$sql = " SELECT nom_troll, id_troll_gowap";
    $sql .= " FROM gowaps, trolls";
    $sql .= " WHERE id_troll_gowap = id_troll";
    $sql .= " AND id_gowap = $monsterIds[$i]";

		$result2=mysql_query($sql,$db_vue_rm);
    if (mysql_error()) { echo "alert('".mysql_error()."');"; }

    if (mysql_num_rows($result2)>0) 
		{
      $res2 = mysql_fetch_assoc($result2);
      $id_troll_gowap = $res2[id_troll_gowap];
      $nom_troll = ereg_replace("'","\'",$res2[nom_troll]);
			echo "
			anchorRow.setAttribute ( 'class', '' );
			anchorRow.setAttribute ( 'style', 'background-color:' + colorRM );
    	newLink.appendChild ( document.createTextNode ( '$monsterNames[$i] appartient à $nom_troll' ) );
    	newLink.setAttribute ( 'href', URLGowap + '$monsterIds[$i]' );
			";
    }
		else
		{
			//Monster researched (composant)
    	$recherche = "";

    	$sql = " SELECT id_composant, priorite_composant, id_race_composant";
    	$sql .= " FROM composants";
    	$sql .= " WHERE id_race_composant = '".addslashes($infos[race])."'";

    	$result2=mysql_query($sql,$db_vue_rm);
    	if (mysql_error()) {echo "alert('".mysql_error()."');";}
    	if (mysql_num_rows($result2)>0) 
			{
      	$res2 = mysql_fetch_assoc($result2);
      	$recherche = $res2[priorite_composant];
				if ($recherche == 'haute' || $recherche == 'superhaute')
				{
					echo "
      		anchorRow.setAttribute ( 'class', '' );
      		anchorRow.setAttribute ( 'style', 'background-color:' + colorUrg );
					";
				}
 				if ($recherche == 'basse' || $recherche == 'tresbasse' || $recherche == 'moyenne')
        {
          echo "
          anchorRow.setAttribute ( 'class', '' );
          anchorRow.setAttribute ( 'style', 'background-color:' + colorSearch );
          ";
        }
    	}
			else
			{
				//Search for CDM
				if (( $infos[id_template] != "" ) && ($infos[id_age] != "") ) {
        	$tab_cdm = SelectCdMs($infos[race],$infos[id_template],$infos[id_age],"-1","-1", true);
        	if (count($tab_cdm) ==  0)
					{
						echo "
          	anchorRow.setAttribute ( 'class', '' );
          	anchorRow.setAttribute ( 'style', 'background-color:' + colorCdm );
          	";
					}
				}
			}
			$infos[monstre] = ereg_replace("'","\'",$infos[monstre]);
			echo"
   		newLink.appendChild ( document.createTextNode ( '$monsterNames[$i]' ) );
   		newLink.setAttribute ( 'href',  URLBestiaire + escape ('$infos[monstre]') + '&Age=' + escape ('$infos[age]') + '&MH=$monsterIds[$i]' );
			";
		}
		echo "
		newLink.setAttribute ( 'target', '\"_blank\"' );
    newLink.setAttribute ( 'class', monsterStyle );
    anchorCellDesc.removeChild ( anchorCellDesc.getElementsByTagName ( 'a' )[0] );
    anchorCellDesc.appendChild ( newLink );
		";
	}
}

else

{
	for ( $i = 0; $i < $nbMonsters; $i++ )
	{
		$rang = $i + $begin;
		
    $name = ereg_replace('[\\]',"",$monsterNames[$i]);
    $infos = getInfoFromMonstre($name);

		$infos[monstre] = ereg_replace("'","\'",$infos[monstre]);

		$caracs_moyennes = SelectCaracMoyMonstre($infos['id_race'],$infos['id_template'],$infos['id_age']);

		if ($caracs_moyennes[niv]!='?' && $caracs_moyennes[niv]!='') $niv = $caracs_moyennes['niv'];
		else $niv=$infos[niv];

    echo "
    var anchorRow = tableMonsters[$rang];
    var anchorCellID = tableMonsters[$rang].childNodes[1]; // ANCHOR
    var anchorCellDesc = tableMonsters[$rang].childNodes[2]; // ANCHOR
    var anchorID = anchorCellID.childNodes[0]; // ANCHOR
    var anchorDesc = anchorCellDesc.getElementsByTagName ( 'a' )[0]; // ANCHOR
    var monsterStyle = new String ( anchorDesc.getAttribute ( 'class' ) );
    ";
    echo "
    var newTd = document.createElement ( 'td' );
    newTd.setAttribute ( 'align', 'center');
    newTd.appendChild( document.createTextNode ( '$niv' ));
    //anchorRow.insertBefore( newTd, anchorCellDesc );
    anchorRow.appendChild (newTd );
    ";
    //Link of the ID
    echo "
    var newLink = document.createElement ( 'a' );
    newLink.appendChild ( document.createTextNode ( '$monsterIds[$i]' ) );
    newLink.setAttribute ( 'class', monsterStyle );
    newLink.setAttribute ( 'href', 'javascript:EMV($monsterIds[$i] ,750,550)' );
    anchorCellID.removeChild ( tableMonsters[$rang].childNodes[1].childNodes[0] );
    anchorCellID.appendChild ( newLink );
    var newLink = document.createElement ( 'a' );
    ";
		echo"
    newLink.appendChild ( document.createTextNode ( '$monsterNames[$i]' ) );
    newLink.setAttribute ( 'href', URLBestiaire + escape ('$infos[monstre]') + '&Age=' + escape ('$infos[age]') + '&MH=$monsterIds[$i]' );
    ";
    echo "
    newLink.setAttribute ( 'target', '\"_blank\"' );
    newLink.setAttribute ( 'class', monsterStyle );
    anchorCellDesc.removeChild ( anchorCellDesc.getElementsByTagName ( 'a' )[0] );
    anchorCellDesc.appendChild ( newLink );
    ";
		
	}
}
echo "} catch ( e ) { error ( e, 'Monsters Colouring error' ); } \n";

?>
