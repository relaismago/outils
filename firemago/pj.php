<?php

	include_once ( "class/c_Item.php" );

	echo "
			var eq = $(\"td:contains('Equipement Utilisé')\").parent();
			var icon = $('<div>').append($('>td:eq(1)>img:eq(1)',eq).clone()).remove().html();
			var html = '';
			$('body').append('<div id=\"infobulle\" flag=\"1\" onClick=\"$(\'#infobulle\').attr(\'flag\',1);$(\'#infobulle\').hide()\" class=\"mh_tdtitre\" style=\"display:none;font-size:15;\"></div>');
		";
	$items = $_REQUEST["arrayItems"];
	$caracs = array( "Attaque" => 0, "AttaqueM" => 0, "Esquive" => 0, "Dégâts" => 0, "DégâtsM" => 0, "Régénération" => 0, "PV" => 0, "Vue" => 0, "RM" => 0, "MM" => 0, "Armure" => 0, "ArmureM" => 0, "Temps" => 0, "TempsEquipement" => 0 );	
	
	foreach ( $items as $i => $item ){
		
		$c_Item = new c_Item($item);
		
		echo "html += icon+'<span id=\"span_".$i."\" onClick=\"$(\'#infobulle\').show();$(\'#infobulle\').attr(\'flag\',\'0\')\" onMouseOut=\"hideInfoBulle();\" onMouseOver=\"displayInfoBulle(\'" .addslashes($c_Item->htmlDisplayItem()). "\',".$i.");\">".addslashes($c_Item->Nom)."</span><br>';";
		
		foreach ( $caracs as $carac => $value )
			$caracs[$carac] = $value + $c_Item->getVar($carac);
		
	}

	$c_Item = new c_Item("");
	$c_Item->constructWithArray($caracs);

	echo "
			$('>td:eq(1)',eq).html(html);
			$('>td:eq(0)',eq).attr('onMouseOut','hideInfoBulle();');
			$('>td:eq(0)',eq).attr('onMouseOver','displayInfoBulle(\'" .addslashes($c_Item->htmlDisplayItem()). "\',0)');	
			$('>td:eq(0)',eq).attr('onClick','$(\'#infobulle\').show();$(\'#infobulle\').attr(\'flag\',0)');							
		";

?>