function updateTextArea(){
	
	text = "";
	$j(".hidden_element").each(function(index) {
		text += $j(this).val()+"\n";
	  });	
	$j("#textarea").val(text);
	
}

function updateHidden( id, text ){
	
	$j("#"+id).val(text);
	updateTextArea();
	
}

function updateRatio(){

	ratio = 110;
	$j(".composant_taniere").each(function(index) {
		ratio += $j(this).val()*1;
	  });
	
	c = "white";
	if ( ratio > 0 )
		c = "green";
	if ( ratio < 0 )
		c = "red";
	
	$j("#ajustement").html("<span style='color:"+c+";'>"+ratio+"%</span>");
	
}

function getTaniere( type, emplacement, id ){
	$j.ajax({
		type: "POST",
		url: "http://outilsrm.free.fr/easyem/ajax/get_taniere.php",
		contentType: "application/x-www-form-urlencoded;charset=ISO-8859-1",		
		data: "type="+type+"&id="+id,
		success: function(item){
			$j("#td_"+emplacement).html(item);		
		}
	});
}

function getComposant(type){
	
	nom = $j("select[name='nom_monstre']").val();
	emplacement = $j("select[name='emplacement']").val();
	$j.ajax({
		type: "POST",
		url: "http://outilsrm.free.fr/easyem/ajax/get_composant.php",
		contentType: "application/x-www-form-urlencoded;charset=ISO-8859-1",		
		data: "type="+type+"&nom="+nom+"&emplacement="+emplacement,
		success: function(item){
			$j("select[name='nom_composant']").html(item);		
		}
	});
	
}

function getCompoTroll(){
	emplacement = "";
	$j(".emplacement:checked").each(function(index) {
		emplacement += $j(this).val()+"|";
	});	
	$j.ajax({
		type: "POST",
		url: "http://outilsrm.free.fr/easyem/ajax/get_composant.php",
		contentType: "application/x-www-form-urlencoded;charset=ISO-8859-1",		
		data: "type=recherchecompotroll&famille="+$j("#famille_montres").val()+"&nom="+$j("#nom_monstre").val()+"&emplacement="+emplacement+"&min="+$j("#min").val()+"&max="+$j("#max").val(),
		success: function(item){
			$j("#table_result").html(item);		
		}
	});	
}

function getComposantBySortilege(){
	$j.ajax({
		type: "POST",
		url: "http://outilsrm.free.fr/easyem/ajax/get_composant_taniere.php",
		contentType: "application/x-www-form-urlencoded;charset=ISO-8859-1",		
		data: "type=sortilege&nom="+$j("#sortilege").val(),
		success: function(item){
			$j("#composant_taniere").html(item);		
		}
	});
}

function getComposantByMundidey(){
	$j.ajax({
		type: "POST",
		url: "http://outilsrm.free.fr/easyem/ajax/get_composant_taniere.php",
		contentType: "application/x-www-form-urlencoded;charset=ISO-8859-1",		
		data: "type=mundidey&nom="+$j("#mundidey").val(),
		success: function(item){
			$j("#composant_taniere").html(item);		
		}
	});
}

function updateSelect(){
	$j.ajax({
		type: "POST",
		url: "http://outilsrm.free.fr/easyem/ajax/get_monstre.php",
		contentType: "application/x-www-form-urlencoded;charset=ISO-8859-1",		
		data: "famille="+$j("#famille_montres").val(),
		success: function(item){
			$j("#nom_monstre").html(item);		
			getCompoTroll();
		}
	});
}

function updateNiveau(){
	if ( $j("#nom_monstre").val() )
		$j.ajax({
			type: "POST",
			url: "http://outilsrm.free.fr/easyem/ajax/get_level.php",
			contentType: "application/x-www-form-urlencoded;charset=ISO-8859-1",		
			data: "nom="+$j("#nom_monstre").val(),
			success: function(item){
				$j("#min").val(item);	
				$j("#max").val(item);	
				getCompoTroll();
			}
		});
	else{
		$j("#min").val(0);	
		$j("#max").val(40);
		getCompoTroll();
	}
}

