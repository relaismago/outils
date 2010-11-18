<?php
require_once ("../../inc_connect.php");

/*echo date("G:i:s");

$sql="SELECT id_monstre,nbatt_monstre,vitdep_monstre,vlc_monstre,attdist_monstre FROM `best_monstres`;";
if($query=mysql_query($sql,$db_vue_rm))
{
  while($ret=mysql_fetch_array($query))
  {
    $sqlcdm = "select * from best_cdms where id_monstre_cdm=".$ret[0];
    echo $sqlcdm."<br>";
    if ($queryb=mysql_query($sqlcdm,$db_vue_rm))   
    {
    	$monstre['pdvsom_monstre'] = 0;
    	$monstre['pdvnbr_monstre'] = 0;
    	$monstre['attsom_monstre'] = 0;
    	$monstre['attnbr_monstre'] = 0;
    	$monstre['esqsom_monstre'] = 0;
    	$monstre['esqnbr_monstre'] = 0;
    	$monstre['degsom_monstre'] = 0;
    	$monstre['degnbr_monstre'] = 0;
    	$monstre['regsom_monstre'] = 0;
    	$monstre['regnbr_monstre'] = 0;
    	$monstre['armsom_monstre'] = 0;
    	$monstre['armnbr_monstre'] = 0;
    	$monstre['vuesom_monstre'] = 0;
    	$monstre['vuenbr_monstre'] = 0;
    	$monstre['mmsom_monstre'] = 0;
    	$monstre['mmnbr_monstre'] = 0;
    	$monstre['rmsom_monstre'] = 0;
    	$monstre['rmnbr_monstre'] = 0;
    	$monstre['dlasom_monstre'] = 0;
    	$monstre['dlanbr_monstre'] = 0;
    	$monstre['nbatt_monstre']="";
    	$monstre['vitdep_monstre']="";
    	$monstre['vlc_monstre']="";
    	$monstre['attdist_monstre']="";
    	while($cdm=mysql_fetch_array($queryb))
    	{
    		recoup_cdm1("pdv",999);
    		recoup_cdm1("att",99);
    		recoup_cdm1("esq",99);
    		recoup_cdm1("deg",99);
    		recoup_cdm1("reg",99);
    		recoup_cdm1("arm",99);
    		recoup_cdm1("vue",99);
    		recoup_cdm1("mm",99999);
    		recoup_cdm1("rm",99999);
    		recoup_cdm1("dla",99);
    		
    		if ($cdm['vitdep_cdm'] !="" && $monstre['vitdep_monstre'] != $cdm['vitdep_cdm'])
    		{
    			$monstre['vitdep_monstre'] = $cdm['vitdep_cdm'];
    		}
    		
    		if ($cdm['nbatt_cdm'] !="" && $monstre['nbatt_monstre'] != $cdm['nbatt_cdm'])
    		{
    			$monstre['nbatt_monstre'] = $cdm['nbatt_cdm'];
    		}
    		
    		if ($cdm['vlc_cdm'] !="" && $monstre['vlc_monstre'] != $cdm['vlc_cdm'])
    		{
    			$monstre['vlc_monstre'] = $cdm['vlc_cdm'];
    		}
    		
    		if ($cdm['attdist_cdm'] !="" && $monstre['attdist_monstre'] != $cdm['attdist_cdm'])
    		{
    			$monstre['attdist_monstre'] = $cdm['attdist_cdm'];
    		}
    		/*if ( $retb['pdvmax_cdm'] != 999 )
    		{
    			$sompv += $retb['pdvmin_cdm'] + $retb['pdvmax_cdm'];
    			$nbrpv = $nbrpv + 2;
    		}
    	}
    	$sqlupdate  = "update best_monstres set";
    	$sqlupdate .= " pdvsom_monstre = ".$monstre['pdvsom_monstre'];
    	$sqlupdate .= ", pdvnbr_monstre = ".$monstre['pdvnbr_monstre'];
    	$sqlupdate .= ", attsom_monstre = ".$monstre['attsom_monstre'];
    	$sqlupdate .= ", attnbr_monstre = ".$monstre['attnbr_monstre'];
    	$sqlupdate .= ", esqsom_monstre = ".$monstre['esqsom_monstre'];
    	$sqlupdate .= ", esqnbr_monstre = ".$monstre['esqnbr_monstre'];
    	$sqlupdate .= ", degsom_monstre = ".$monstre['degsom_monstre'];
    	$sqlupdate .= ", degnbr_monstre = ".$monstre['degnbr_monstre'];
    	$sqlupdate .= ", regsom_monstre = ".$monstre['regsom_monstre'];
    	$sqlupdate .= ", regnbr_monstre = ".$monstre['regnbr_monstre'];
    	$sqlupdate .= ", armsom_monstre = ".$monstre['armsom_monstre'];
    	$sqlupdate .= ", armnbr_monstre = ".$monstre['armnbr_monstre'];
    	$sqlupdate .= ", vuesom_monstre = ".$monstre['vuesom_monstre'];
    	$sqlupdate .= ", vuenbr_monstre = ".$monstre['vuenbr_monstre'];
    	$sqlupdate .= ", mmsom_monstre = ".$monstre['mmsom_monstre'];
    	$sqlupdate .= ", mmnbr_monstre = ".$monstre['mmnbr_monstre'];
    	$sqlupdate .= ", rmsom_monstre = ".$monstre['rmsom_monstre'];
    	$sqlupdate .= ", rmnbr_monstre = ".$monstre['rmnbr_monstre'];
    	$sqlupdate .= ", dlasom_monstre = ".$monstre['dlasom_monstre'];
    	$sqlupdate .= ", dlanbr_monstre = ".$monstre['dlanbr_monstre'];
    	$sqlupdate .= ", nbatt_monstre = '".$monstre['nbatt_monstre']."'";
    	$sqlupdate .= ", vitdep_monstre = '".$monstre['vitdep_monstre']."'";
    	$sqlupdate .= ", vlc_monstre = '".$monstre['vlc_monstre']."'";
    	$sqlupdate .= ", attdist_monstre = '".$monstre['attdist_monstre']."'";
    	$sqlupdate .= " where id_monstre=".$ret[0].";";
    	echo $sqlupdate."<br>";
    	mysql_query($sqlupdate,$db_vue_rm);
    }
    else
    {
    	echo "big problem pdv min with ".$ret[0];
    }
  }
}

echo "fin";

echo date("G:i:s");

function recoup_cdm1 ($carac,$max)
{
  global $cdm,$monstre;
  if ($cdm[$carac.'max_cdm'] != $max && $cdm[$carac.'max_cdm'] != 0)
  {
  	$monstre[$carac.'som_monstre'] += $cdm[$carac.'max_cdm'] + $cdm[$carac.'min_cdm'];
	$monstre[$carac.'nbr_monstre'] = $monstre[$carac.'nbr_monstre'] + 2;  	
  }
}
*/

$sql = "UPDATE `best_races` SET `niv_base` = '20' WHERE `best_races`.`nom_race` ='Labeilleux' LIMIT 1 ;";
if(mysql_query($sql,$db_vue_rm))
	echo "requête ok";
else
	echo mysql_error();

?>