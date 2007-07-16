<?
session_start();
include_once ( "../admin_functions_db.php3" );
include_once ( "../bestiaire2/Libs/functions.php" );
include_once ( "../bestiaire2/DB/inc_initdata.php" );

echo "try { \n";
	
$monsterIds = $_REQUEST['monsterIds'];
$monsterNames = $_REQUEST['monsterNames'];
$monsterAges = $_REQUEST['monsterAges'];
$begin = $_REQUEST['begin'];

$nbMonsters = count ( $monsterIds );
	
for ( $i = 0; $i < $nbMonsters; $i++ )
{
	$rang = $i + $begin;
   
    $name=ereg_replace('[\\]',"",$monsterNames[$i]);
	$infos = getInfoFromMonstre($name);
	$caracs_moyennes = SelectCaracMoyMonstre($infos['id_race'],$infos['id_template'],$infos['id_age']);
	$caracs_spe = SelectCapSpe($infos['id_race'],$infos['id_template'],$infos['id_age']);
	$tab_cdm_mh = SelectCdM_mh($monsterIds[$i],$infos['id_race'],$infos['id_age']);
		
		
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

	//si l'utilisateur fait parti de la guilde, on met un peu de couleurs
	if ( $_SESSION['AuthGuilde'] == 450 ) 
	{
		
		//gowap from the guild
		$sql = " SELECT nom_troll, id_troll_gowap";
    	$sql .= " FROM gowaps, trolls";
    	$sql .= " WHERE id_troll_gowap = id_troll";
    	$sql .= " AND id_gowap = $monsterIds[$i]";

		$result2=mysql_query($sql,$db_vue_rm);
    	if ( mysql_error() ) { echo "alert('".mysql_error()."');"; }

    	if ( mysql_num_rows($result2) > 0 ) 
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

    		$result2 = mysql_query( $sql,$db_vue_rm);
    		if ( mysql_error() ) { echo "alert('".mysql_error()."');"; }
    		if ( mysql_num_rows($result2) > 0 ) 
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
				if (( $infos[id_template] != "" ) && ($infos[id_age] != "") ) 
				{
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
		}
	}// fin colorisation
	$infos[monstre] = ereg_replace("'","\'",$infos[monstre]);
	echo"
   	newLink.appendChild ( document.createTextNode ( '$monsterNames[$i]' ) );
   	newLink.setAttribute ( 'href',  URLBestiaire + escape ('$infos[monstre]') + '&Age=' + escape ('$infos[age]') + '&MH=$monsterIds[$i]' );
	";
		
	if ($tab_cdm_mh)
	{
		$last_cdm = count($tab_cdm_mh)-1;
		$titre = "cdm recoupées du monstre au ".$tab_cdm_mh[$last_cdm]['date_cdm'];
		if ( $tab_cdm_mh[$last_cdm]['pdvmax_cdm'] != 999 )
		{
			$pdv = "entre ". $tab_cdm_mh[$last_cdm]['pdvmin_cdm'] ." et ". $tab_cdm_mh[$last_cdm]['pdvmax_cdm'] ." --> <b>".($tab_cdm_mh[$last_cdm]['pdvmin_cdm']+$tab_cdm_mh[$last_cdm]['pdvmax_cdm'])/2 . " </b>PV";
			if ( $tab_cdm_mh[$last_cdm]['blessure_cdm'] != 0 )
			{
				$ble = $tab_cdm_mh[$last_cdm]['blessure_cdm']." % : reste entre ". (floor ( $tab_cdm_mh[$last_cdm]['pdvmin_cdm'] * ( 95 - $tab_cdm_mh[$last_cdm]['blessure_cdm'] ) / 100 ) + 1). " et ". (floor ( $tab_cdm_mh[$last_cdm]['pdvmax_cdm'] * ( 105 - $tab_cdm_mh[$last_cdm]['blessure_cdm'] ) / 100 ));
			}
			else 
			{
				$ble = "0%";
			} 
		}
		else
		{
			$pdv = "> à ".$tab_cdm_mh[$last_cdm]['pdvmin_cdm']." (bestiaire : ".$caracs_moyennes[pdv].")";
			$ble = $tab_cdm_mh[$last_cdm]['blessure_cdm']."%";
		}
		if ( $tab_cdm_mh[$last_cdm]['attmax_cdm'] != 99 )
		{
			$att = "entre ". $tab_cdm_mh[$last_cdm]['attmin_cdm']. " et " . $tab_cdm_mh[$last_cdm]['attmax_cdm']. " --> <b>" . ($tab_cdm_mh[$last_cdm]['attmin_cdm']+$tab_cdm_mh[$last_cdm]['attmax_cdm'])/2 . " </b>D6";
		}
		else
		{
			$att = "> à ".$tab_cdm_mh[$last_cdm]['attmin_cdm']." (bestiaire : ".$caracs_moyennes[att].")";
		}
		if ( $tab_cdm_mh[$last_cdm]['esqmax_cdm'] != 99 )
		{
			$esq = "entre ". $tab_cdm_mh[$last_cdm]['esqmin_cdm']. " et " . $tab_cdm_mh[$last_cdm]['esqmax_cdm']. " --> <b>" .($tab_cdm_mh[$last_cdm]['esqmin_cdm']+$tab_cdm_mh[$last_cdm]['esqmax_cdm'])/2 . " </b>D6";
		}
		else
		{
			$esq = "> à ".$tab_cdm_mh[$last_cdm]['esqmin_cdm']." (bestiaire : ".$caracs_moyennes[esq].")";
		}
		if ( $tab_cdm_mh[$last_cdm]['degmax_cdm'] != 99 )
		{
			$deg = "entre ". $tab_cdm_mh[$last_cdm]['degmin_cdm']. " et " . $tab_cdm_mh[$last_cdm]['degmax_cdm']. " --> <b>" .($tab_cdm_mh[$last_cdm]['degmin_cdm']+$tab_cdm_mh[$last_cdm]['degmax_cdm'])/2 . " </b>D3";
		}
		else
		{
			$deg = "> à ".$tab_cdm_mh[$last_cdm]['degmin_cdm']." (bestiaire : ".$caracs_moyennes[deg].")";
		}
		if ( $tab_cdm_mh[$last_cdm]['regmax_cdm'] != 99 )
		{
			$reg = "entre ". $tab_cdm_mh[$last_cdm]['regmin_cdm']. " et " . $tab_cdm_mh[$last_cdm]['regmax_cdm']. " --> <b>" .($tab_cdm_mh[$last_cdm]['regmin_cdm']+$tab_cdm_mh[$last_cdm]['regmax_cdm'])/2 . " </b>D3";
		}
		else
		{
			$reg = "> à ".$tab_cdm_mh[$last_cdm]['regmin_cdm']." (bestiaire : ".$caracs_moyennes[reg].")";
		}
		if ( $tab_cdm_mh[$last_cdm]['armmax_cdm'] != 99 )
		{
			$arm = "entre ". $tab_cdm_mh[$last_cdm]['armmin_cdm']. " et " . $tab_cdm_mh[$last_cdm]['armmax_cdm']. " --> <b>" . ($tab_cdm_mh[$last_cdm]['armmin_cdm']+$tab_cdm_mh[$last_cdm]['armmax_cdm'])/2 . " </b>";
		}
		else
		{
			$arm = "> à ".$tab_cdm_mh[$last_cdm]['armmin_cdm']." (bestiaire : ".$caracs_moyennes[arm].")";
		}
		if ( $tab_cdm_mh[$last_cdm]['vuemax_cdm'] != 99 )
		{
			$vue = "entre ". $tab_cdm_mh[$last_cdm]['vuemin_cdm']. " et " . $tab_cdm_mh[$last_cdm]['vuemax_cdm']. " --> <b>" .($tab_cdm_mh[$last_cdm]['vuemin_cdm']+$tab_cdm_mh[$last_cdm]['vuemax_cdm'])/2 . " </b>";
		}
		else
		{
			$vue = "> à ".$tab_cdm_mh[$last_cdm]['vuemin_cdm']." (bestiaire : ".$caracs_moyennes[vue].")";
		}
		if ( $tab_cdm_mh[$last_cdm]['mmmax_cdm'] != 99999 )
		{
			$mm = "entre ". $tab_cdm_mh[$last_cdm]['mmmin_cdm']. " et " . $tab_cdm_mh[$last_cdm]['mmmax_cdm']. " --> <b>" .($tab_cdm_mh[$last_cdm]['mmmin_cdm']+$tab_cdm_mh[$last_cdm]['mmmax_cdm'])/2 . " </b>";
		}
		else
		{
			if ( $tab_cdm_mh[$last_cdm]['mmmin_cdm'] != 0)
			{
				$mm = "> à ".$tab_cdm_mh[$last_cdm]['mmmin_cdm']." (bestiaire : ".$caracs_moyennes[mm].")";
			}
			else
			{
				$mm = " ? ";	
			}
		}
		if ( $tab_cdm_mh[$last_cdm]['rmmax_cdm'] != 99999 )
		{
			$rm = "entre ". $tab_cdm_mh[$last_cdm]['rmmin_cdm']. " et " . $tab_cdm_mh[$last_cdm]['rmmax_cdm']. " --> <b>" .($tab_cdm_mh[$last_cdm]['rmmin_cdm']+$tab_cdm_mh[$last_cdm]['rmmax_cdm'])/2 . " </b>";
		}
		else
		{
			if ( $tab_cdm_mh[$last_cdm]['rmmin_cdm'] != 0)
			{
				$rm = "> à ".$tab_cdm_mh[$last_cdm]['rmmin_cdm']." (bestiaire : ".$caracs_moyennes[rm].")";
			}
			else
			{
				$rm = " ? ";	
			}
		}
		if ( $tab_cdm_mh[$last_cdm]['dlamax_cdm'] != 99 )
		{
			$dla = "entre ". $tab_cdm_mh[$last_cdm]['dlamin_cdm']. " et " . $tab_cdm_mh[$last_cdm]['dlamax_cdm']. " --> <b>" .($tab_cdm_mh[$last_cdm]['dlamin_cdm']+$tab_cdm_mh[$last_cdm]['dlamax_cdm'])/2 . " </b>";
		}
		else
		{
			if ( $tab_cdm_mh[$last_cdm]['dlamin_cdm'] != 0)
			{
				$dla = "> à ".$tab_cdm_mh[$last_cdm]['dlamin_cdm']." (bestiaire : ".$caracs_moyennes[dla].")";
			}
			else
			{
				$dla = " ? ";	
			}
		}
		$nbatt = $tab_cdm_mh[$last_cdm]['nbatt_cdm'];
		$vitdep = $tab_cdm_mh[$last_cdm]['vitdep_cdm'];
		$vlc = $tab_cdm_mh[$last_cdm]['vlc_cdm'];
		$attdist = $tab_cdm_mh[$last_cdm]['attdist_cdm'];
		
	}
	else //pas de cdm pour ce monstre, on calcule la moyenne
	{
		$titre = "caracs moyennes du monstre";
		$pdv = $caracs_moyennes[pdv];
		$ble = "???";
		$att = $caracs_moyennes[att];
		$esq = $caracs_moyennes[esq];
		$deg = $caracs_moyennes[deg];
		$reg = $caracs_moyennes[reg];
		$arm = $caracs_moyennes[arm];
		$vue = $caracs_moyennes[vue];
		$mm = $caracs_moyennes[mm];
		$rm = $caracs_moyennes[rm];
		$dla = $caracs_moyennes[dla];
		$nbatt = "?";
		$vitdep = "?";
		$vlc = "?";
		$attdist = "?";
		//$caracs_spe[4].";".$caracs_spe[5];
	}
	$caracTot = $titre.";".$niv.";".$pdv.";".$ble.";".$att.";".$esq.";".$deg.";";
	$caracTot .= $reg.";".$arm.";".$vue.";".$mm.";".$rm.";".$nbatt.";".$vitdep.";".$vlc.";".$attdist.";";
	$caracTot .= $dla.";".$caracs_spe[4].";".$caracs_spe[5];
	$monsterNames[$i] = ereg_replace("\'","&#39;",$monsterNames[$i] );
	echo "
	newLink.setAttribute ( 'target', '\"_blank\"' );
    newLink.setAttribute ( 'class', monsterStyle );
	newLink.setAttribute ( 'onmouseover', 'infoBulle (\'$monsterNames[$i]\',event,\'caracMonster\',\'$caracTot\');');
	newLink.setAttribute ( 'onmouseout', 'cacherInfoBulle();');
    anchorCellDesc.removeChild ( anchorCellDesc.getElementsByTagName ( 'a' )[0] );
    anchorCellDesc.appendChild ( newLink );
	";
}// boucle for
	
echo "} catch ( e ) { error ( e, 'Monsters Colouring error' ); } \n";

?>
