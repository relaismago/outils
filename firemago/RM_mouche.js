var table = $('html>body>table>tbody>tr:eq(1)>td>table>tbody>tr>td:eq(1)>form>table>tbody');
var arrayBonus = new Array();
var nom = "";
var value = "";
var htmlString = "";
var j = 0;

$('>tr.mh_tdpage',table).each(function(index) {

	if ( $('>td:eq(2)', this).text().toString().match(/Héros/g) )
		++j;

	if ($('>td:eq(4)>img', this).attr('alt') == "Là" && !$('>td:eq(2)', this).text().toString().match(/Héros/g) ) {
	
		stats = $('>td:eq(1)', this).text().toString().replace(/\n/g,'').toString().match(/\(.+\)/g).toString().replace(/\(|\)/,'').toString().split(/ : /);
		nom = trim(stats[0])
		value = stats[1].match(/.\d+/g);
		if ( !arrayBonus[nom] )
			arrayBonus[nom] = value*1;		
		else
			arrayBonus[nom] = value*1+arrayBonus[nom]*1;
		++j;
	
	}
	
});	

for (var i in arrayBonus){
	
	htmlString += i+" : "+addSign(arrayBonus[i]);
	
	switch(i){
		
		case "TOUR" :
			htmlString += " min";
			break;
			
		case "PV" :
			htmlString += " PV";
			break;				
		
	}
	
	htmlString += " | ";
	
} 
	

htmlString = htmlString.substr(0,htmlString.length-3);

$('>tr:eq(1)',table).before("<tr class='mh_tdtitre'><td>Total</td><td colspan='3' align='center'>"+htmlString+"</td><td>"+j+"/"+$('>tr.mh_tdpage',table).length+"</td></tr>");

// trim
function trim( string )
{
	return string.replace(/^\s+/g, '').replace(/\s+$/g, '');
}

// ajoute le signe +
function addSign( number )
{
	return (number < 0) ? number : '+'+number;
}