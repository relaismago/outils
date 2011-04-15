<?php

	include_once '../top.php';
	include_once 'secure.php';
	
	###############
	# vérifications
	###############
	# on peut updater
	$updater = 1;
	# texte expliquant les erreurs
	$constat = "";
	
	# vérification que les données qui suivent sont entières et positives
	if ($updater == 0)
	{
		echo "<div class=alerte>".$constat."</div>\n";
		echo "<br><H1>Les données ne seront pas mises à jour.</H1>\n";
		echo "<br>Veuillez revenir à la page précédente et corriger les erreurs.\n";
	}
	else
	{
		$update = 'UPDATE '._TABLEVTT_.' SET';
		$update .= ' `CacherData` = \''.($_REQUEST["cacherdata"]?'1':'0').'\'';
		$champs = array(
										'Race' => 'troll_race',
										'DLAH' => 'troll_dla_reel_hh',
										'DLAM' => 'troll_dla_reel_mm',
										'VUE' => 'troll_vue_base',
										'VUEB' => 'troll_vue_bm',
										'Niveau' => 'troll_niveau',
										'PV_ACTUELS' => 'troll_pvact',
										'PVs' => 'troll_pv',
										'REG' => 'troll_reg_base',
										'REGB' => 'troll_reg_bm',
										'ATT' => 'troll_att_base',
										'ATTB' => 'troll_att_bm',
										'ESQ' => 'troll_esq_base',
										'ESQB' => 'troll_esq_bm',
										'DEG' => 'troll_deg_base',
										'DEGB' => 'troll_deg_bm',
										'ARM' => 'troll_arm_base',
										'ARMB' => 'troll_arm_bm',
										'KILLs' => 'troll_kill',
										'DEADs' => 'troll_death',
										'RM' => 'troll_rm_base',
										'RMB' => 'troll_rm_bm',
										'MM' => 'troll_mm_base',
										'MMB' => 'troll_mm_bm',
										'Joueur' => 'joueur',
										'AgeJoueur' => 'agejoueur',
										'VilleJoueur' => 'villejoueur',
										'MSN' => 'msn',
										'ICQ' => 'icq',
										'EMail' => 'email',
										'Divers' => 'divers'
										);
		foreach ($champs as $sql => $input)
		    $update .= ', `'.$sql.'` = \''.$_REQUEST[$input].'\'';
			
		$update .= ', `NbSorts` = \''.$_REQUEST["nbsorts"].'\'';
		$update .= ', `Comps` = \''.$_REQUEST["comps"].'\'';
		$update .= ', `Sorts` = \''.$_REQUEST["sortsappris"].'\'';
		$update .= ', `DateMaj` = NOW()';
		$update .= ' WHERE `No` = \''.$_REQUEST["no"].'\';';
		$query_result = my_mysql_query($update);
	
		echo "<br><H1>Mise à jour effectuée.</H1>\n";
		echo "<br><H2>Retour au <a href=\"vtt.php?id=".$_SESSION["AuthTroll"]."&this_one=".$no."\">VisioTrollotron</a>.</H2>\n";
		echo "<br><H2>Retour à la <a href=\"../engine_view.php?troll=".$_SESSION["AuthTroll"]."\">Fiche Engine</a>.</H2>\n";
	}
	
	include_once('../foot.php');

?>

