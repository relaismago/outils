<?php

	session_start();

	require_once ('../top.php');

	if ( !userIsGroupSpec() && !userIsGuilde() )
		die("Tu n'es pas R&M !");

	$array_data = array();
	$lignes = (is_array($_REQUEST["copiercoller"])) ? explode("!:!", htmlspecialchars_decode(stripslashes(implode("",$_REQUEST["copiercoller"])))) : explode("\n", htmlspecialchars(stripslashes($_REQUEST["copiercoller"])));
	$j=0;
	$sorts=0;
	$nb_sorts=0;
	$nb_comps=0;
	foreach( $lignes as $k => $value ){
		$value = trim($value);
		if ( empty($value) )
			unset($lignes[$k]);
		else
			$lignes[$k] = $value;
	}
	foreach( $lignes as $ligne ){

		if(preg_match("#Identifiants.+ (\d+) - (.+)#",$ligne,$resultat)){
			$id		= trim(htmlspecialchars($resultat[1]));
			$nom	= trim($resultat[2]);
		}
		
		if(preg_match("#[ \t]*Race.+\.+:(.+)#",$ligne,$resultat))
			$array_data["Race"]	= trim($resultat[1]);
		
		if(preg_match("#.+Date Limite d'Action :  (.+)#",$ligne,$resultat))
			$troll_dla_en_cours = trim($resultat[1]);

		if(preg_match("#[ \t]*Il me reste (.+) PA#",$ligne,$resultat))
			$troll_pa = trim($resultat[1]);
		
		if(preg_match("#[ \t]*Dur.+prochai.+:(.+)heures.+et(.+)minutes#",$ligne,$resultat)){
			$array_data["DLAH"]	= trim($resultat[1]);
			$array_data["DLAM"]	= trim($resultat[2]);
		}
		
		if(preg_match("#[ \t]*Position.+X =(.+) .+ Y = (.+) .+ N = (.+)#",$ligne,$resultat)){
			$troll_x = trim($resultat[1]);
			$troll_y = trim($resultat[2]);
			$troll_z = trim($resultat[3]);
		}
		
		if(preg_match("#[ \t]*Vue\.+:[ \t]*([0-9]+)[ \t]*Cases[ \t]*(.+)#",$ligne,$resultat)){
			$array_data["VUE"]		= trim($resultat[1]);
			$array_data["VUEB"]		= trim($resultat[2]);
		}
		
		if(preg_match("#.+Niveau.+ (\d+) .+#",$ligne,$resultat))
			$array_data["Niveau"]	= trim($resultat[1]);
		
		if(preg_match("#[ \t]*Actuels\.+:[ \t]*(.+)#",$ligne,$resultat))
			$array_data["PV_ACTUELS"] = trim($resultat[1]);
		
		if(preg_match("#[ \t]*Maximum\.+:[ \t]*(.+)#",$ligne,$resultat)){
			$resultat = preg_split("#\s+#",$resultat[1]);
			$array_data["PVs"]		= trim($resultat[0]+$resultat[1]);
		}
		
		if(preg_match("#[ \t]*Régénération.+Fatigue du Kastar.+:[ \t]*(.+).+\(#",$ligne,$resultat))
			$troll_fatigue = ($array_data["Race"] == "Kastar") ? trim($resultat[1]) : 0;
		
		if(preg_match("#[ \t]*R.g.n.ration\.+:[ \t]*(.+)[ \t]*D[0-9][ \t]*(.+)[ \t]*-{3}.+#",$ligne,$resultat)){
			$array_data["REG"]	= trim($resultat[1]);
			$resultat = preg_split("#\s+#",$resultat[2]);	
			$array_data["REGB"]	= trim($resultat[0]+$resultat[1]);
		} else if (preg_match("#[ \t]*R.g.n.ration\.+:[ \t]*(.+)[ \t]*D[0-9][ \t]*(.+)#",$ligne,$resultat)){
			$array_data["REG"]	= trim($resultat[1]);
			$resultat = preg_split("#\s+#",$resultat[2]);		
			$array_data["REGB"]	= trim($resultat[0]+$resultat[1]);
		}
		
		if(preg_match("#[ \t]*Atta.+:[ \t]*(.+)[ \t]*D[0-9][ \t]*(.+)#",$ligne,$resultat)){
			$array_data["ATT"]	= trim($resultat[1]);
			$resultat = preg_split("#\s+#",$resultat[2]);		
			$array_data["ATTB"]	= trim($resultat[0]+$resultat[1]);
		}
		
		if(preg_match("#[ \t]*Esquive\.+:[ \t]*(.+)[ \t]*D[0-9][ \t]*(.+)#",$ligne,$resultat)){
			$array_data["ESQ"]	= trim($resultat[1]);
			$resultat = preg_split("#\s+#",$resultat[2]);	
			$array_data["ESQB"]	= trim($resultat[0]+$resultat[1]);
		}
		
		if(preg_match("#[ \t]*D.g.ts\.+:[ \t]*(.+)[ \t]*D[0-9][ \t]*(.+)#",$ligne,$resultat)){
			$array_data["DEG"]	= trim($resultat[1]);
			$resultat = preg_split("#\s+#",$resultat[2]);			
			$array_data["DEGB"]	= trim($resultat[0]+$resultat[1]);
		}
		
		if(preg_match("#[ \t]*Armure\.+:[  \t]+(.+)#",$ligne,$resultat)){
			$resultat = preg_split("#\s+#",$resultat[1]);	
			$array_data["ARM"]	= trim($resultat[0]);
			$array_data["ARMB"]	= trim($resultat[1]);
		}
		
		if(preg_match("#[ \t]*Nombre.+Advers.+:[ \t]*(.+)#",$ligne,$resultat))
			$array_data["KILLs"]		= trim($resultat[1]);
		
		if(preg_match("#[ \t]*Nombre.+D.c.s.+:[ \t]*(.+)#",$ligne,$resultat))
			$array_data["DEADs"]	= trim($resultat[1]);
		
		if(preg_match("#[ \t]*Magie.+R.sistance.+Magie.+:[ \t]*([0-9]+)[ \t]*points*(.+)#",$ligne,$resultat)){
			$array_data["RM"]	= trim($resultat[1]);
			$array_data["RMB"]	= trim($resultat[2]);
		}
		
		if(preg_match("#[ \t]*Ma.trise.+Magie.+:[ \t]*([0-9]+)[ \t]*points*(.+)#",$ligne,$resultat)){
			$array_data["MM"]	= trim($resultat[1]);
			$array_data["MMB"]	= trim($resultat[2]);
		}
			
		if(preg_match("#(.+)-&gt; niveau (\d+) : (\d+)#",$ligne,$resultat)){
			if ($sorts)
				++$nb_sorts;
			else
				++$nb_comps;
			$troll_cs[$j][0] = trim($resultat[1])." niv ".$resultat[2];
			$troll_cs[$j][1] = trim($resultat[3]);			
			$j++;
		}

		if (preg_match("#.*Sorts.*#", $ligne))
			$sorts = 1;
		
	}
	
	$chaine_comps = "";
	for ($i=0; $i<$nb_comps; $i++) 
		$chaine_comps .= ($i==0?"":", ").htmlspecialchars(str_replace( "Utiliser l'action ", "", $troll_cs[$i][0] ), ENT_QUOTES)." (".$troll_cs[$i][1]."%)";

	$chaine_sorts = "";
	for ($i=$nb_comps; $i<($nb_comps+$nb_sorts); $i++) 
		$chaine_sorts.=($i==$nb_comps?"":", ").acronyme($troll_cs[$i][0])." (".$troll_cs[$i][1]."%)";

	$update = 'UPDATE vtt SET';
	$update .= ' `CacherData` = 0';
							
	foreach ($array_data as $sql => $value)
	    $update .= ', `'.$sql.'` = \''.$value.'\'';
		
	$update .= ", `NbSorts` = '$nb_sorts'";
	$update .= ", `Comps` = '$chaine_comps'";
	$update .= ", `Sorts` = '$chaine_sorts'";
	$update .= ", `DateMaj` = NOW()";
	$update .= " WHERE `No` = $id;";

	if ( userIsGuilde() )
		mysql_query($update, $db_vue_rm);

    //MISE EN FORME DES DATES
    $jj_fin_dla = $troll_dla_en_cours[0].$troll_dla_en_cours[1];
	$mm_fin_dla = $troll_dla_en_cours[3].$troll_dla_en_cours[4];
	$aa_fin_dla = $troll_dla_en_cours[6].$troll_dla_en_cours[7].$troll_dla_en_cours[8].$troll_dla_en_cours[9];
	$hh_fin_dla = $troll_dla_en_cours[11].$troll_dla_en_cours[12];
	$min_fin_dla = $troll_dla_en_cours[14].$troll_dla_en_cours[15];			
	
	//CALCULS DES DATES/HEURES DES DLA
	$fin_dla = mktime($hh_fin_dla,$min_fin_dla,0,$mm_fin_dla,$jj_fin_dla,$aa_fin_dla);
	$fin_next_dla = mktime($hh_fin_dla+$array_data["DLAH"],$min_fin_dla+$array_data["DLAM"],0,$mm_fin_dla,$jj_fin_dla,$aa_fin_dla);
	$fin_next2_dla = mktime($hh_fin_dla+2*$array_data["DLAH"],$min_fin_dla+2*$array_data["DLAM"],0,$mm_fin_dla,$jj_fin_dla,$aa_fin_dla);
    
    //UPLOAD DU PROFIL
    $date_maj = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
	$sql = "update ggc_troll set nom_troll = '$nom',"
        . " niveau_troll = '" .$array_data["Niveau"]. "',"
        . " race = '" .$array_data["Race"]. "',"
        . " dla_en_cours = '$fin_dla',"
        . " dla_suivante = '$fin_next_dla',"
        . " dla_prevue = '$fin_next2_dla',"
        . " position_x = '$troll_x',"
        . " position_y = '$troll_y',"
        . " position_z = '$troll_z',"
        . " pv_actuel = '" .$array_data["PV_ACTUELS"]. "',"
        . " pv_max = '" .$array_data["PVs"]. "',"
        . " fatigue_kastar = '$troll_fatigue',"
        . " pa = '$troll_pa',"
        . " date_maj = '$date_maj' where id_troll = $id;";

	mysql_query($sql, $db_vue_rm);
	echo "<table class='mh_tdborder' width='70%' align='center'>
			<tr class='mh_tdtitre' align='center'><td colspan='2'>MaJ du VTT/GGC effectuée !</td></tr>
			<tr class='mh_tdtitre' align='center'><td><a href='vtt.php'>VTT</a></td><td><a href='../ggc/groupe.php'>GGC</a></td></tr>
		</table>";
	
	include("../foot.php");		
	
	function acronyme($chaine)
	{
		
		if (preg_match("#Analyse.+#", $chaine))        {return "AA";}
		if (preg_match("#Armure.+#", $chaine))         {return "AE";}
		if (preg_match("#.+Attaque.*#", $chaine))        {return "AdA";}
		if (preg_match("#.+D.g.ts.*#", $chaine))         {return "AdD";}
		if (preg_match("#.+Esquive.*#", $chaine))        {return "AdE";}
		if (preg_match("#.+Magie.*#", $chaine))          {return "BAM";}
		if (preg_match("#Bulle Magique.+#", $chaine))  {return "BuM";}
		if (preg_match("#Explosion.*#", $chaine))        {return "Explo";}
		if (preg_match("#Faiblesse.+#", $chaine))      {return "FP";}
		if (preg_match("#Flash.+#", $chaine))          {return "Flash";}
		if (preg_match("#Glue.*#", $chaine))             {return "Glue";}
		if (preg_match("#Griffe.+#", $chaine))         {return "GdS";}
		if (preg_match("#Hypnotisme.*#", $chaine))       {return "Hypno";}
		if (preg_match("#Identification.+#", $chaine)) {return "IdT";}
		if (preg_match("#Invisibilit.+#", $chaine))    {return "Invisi";}
		if (preg_match("#Projectile.+#", $chaine))     {return "PM";}
		if (preg_match("#Projection.*#", $chaine))       {return "Projection";}
		if (preg_match("#Rafale.+#", $chaine))         {return "RP";}
		if (preg_match("#Sacrifice.*#", $chaine))        {return "Sacrifice";}
		if (preg_match("#Vampirisme.*#", $chaine))       {return "Vampi";}
		if (preg_match("#Voir.+#", $chaine))           {return "VlC";}
		if (preg_match("#.l.portation.*#", $chaine))    {return "TP";}
		if (preg_match("#.l.kin.sie.*#", $chaine))      {return "T&eacute;l&eacute;kin&eacute;sie";}
		if (preg_match("#.+Accrue.*#", $chaine))         {return "VA";}
		if (preg_match("#.+lointaine.*#", $chaine))      {return "VL";}
		if (preg_match("#Vue.+#", $chaine))            {return "VT";}
		if (preg_match("#L.vitation.+#", $chaine))     {return "L&eacute;vitation";}
		if (preg_match("#Sublifusion.+Medius.*#", $chaine))    {return "Sublifusion Magesque Medius";}
		if (preg_match("#Sublifusion.+Minus.*#", $chaine))    {return "Sublifusion Magesque Minus";}
		if (preg_match("#Sublifusion.+Maexus.*#", $chaine))    {return "Sublifusion Magesque Maexus";}
		
		return htmlspecialchars($chaine, ENT_QUOTES);
		
	}

?>