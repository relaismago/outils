function getItemCarac( idTroll, idItem, type ){

	if ( idItem != 0 )
		$j.ajax({
			type: "POST",
			url: "display_item.php",
			contentType: "application/x-www-form-urlencoded;charset=ISO-8859-1",
			data: "idTroll="+idTroll+"&idItem="+idItem+"&type="+type,
			success: function(item){
				$j("#span_"+type).html(item);		
			}
		});
	else
		$j("#span_"+type).html("");	
	
}

function updateTroll(idTroll){	
	
	itemInfo = $j("#Casque").val()+"|Casque;"+$j("#Talisman").val()+"|Talisman;"+$j("#Armure").val()+"|Armure;"+$j("#Arme_1_main").val()+"|Arme_1_main;"+$j("#Arme_2_mains").val()+"|Arme_2_mains;"+$j("#Bouclier").val()+"|Bouclier;"+$j("#Bottes").val()+"|Bottes";
	configArme = $j("input[name=configArme]:checked").val();
	$j.ajax({
		type: "POST",
		url: "update_troll.php",
		contentType: "application/x-www-form-urlencoded;charset=ISO-8859-1",
		data: "idTroll="+idTroll+"&itemInfo="+itemInfo+"&configArme="+configArme,
		success: function(item){		
			$j("#tableProfil").html(item);	
		}
	});
	
}

function resetEquipement(idTroll){
	
	$j.ajax({
		type: "POST",
		url: "update_troll.php",
		contentType: "application/x-www-form-urlencoded;charset=ISO-8859-1",
		data: "idTroll="+idTroll,		
		success: function(item){		
			$j("#tableProfil").html(item);	
		}
	});
	$j(".pmtEquipement").val(0);
	$j(".pmtSpan").html("");						
	
}

function updateSelect( idTroll, type ){
	
	nom = $j("#"+type+"_nom").val();
	template = $j("#"+type+"_template").val();
	mithril = $j("#"+type+"_mithril:checked").val();
	if ( mithril == undefined )
		mithril = "";
	
	$j.ajax({
		type: "POST",
		url: "update_select.php",
		contentType: "application/x-www-form-urlencoded;charset=ISO-8859-1",
		data: "idTroll="+idTroll+"&type="+type+"&nom="+nom+"&template="+template+"&mithril="+mithril,
		success: function(item){
			$j("#"+type).html(item);	
		}
	});	
	
	$j("#"+type).val(0);
	getItemCarac( idTroll, 0, type );
	updateTroll(idTroll);
	
}