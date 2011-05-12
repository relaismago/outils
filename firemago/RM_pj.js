var items = $("td:contains('Equipement Utilisé')").parent();
items = trim($('>td:eq(1)',items).text()).split('\n');
var arrayItems = "";

for (var i in items) {
	arrayItems += 'arrayItems[]=' + trim(items[i]) + '&';
}

newEventScript = document.createElement('script');
newEventScript.setAttribute('language', 'JavaScript');
newEventScript.setAttribute('src', URLPjInfos + arrayItems);
document.body.appendChild(newEventScript);

function trim( string )
{
	return string.replace(/^\s+/g, '').replace(/\s+$/g, '');
}

function displayInfoBulle( string, i )
{
	if ($('#infobulle').attr('flag') == 1) {
		$('#infobulle').css('position', 'absolute');
		$('#infobulle').css('left', $("#span_" + i).position().left + 250);
		$('#infobulle').css('top', $("#span_" + i).position().top - i * 15);
		$('#infobulle').css('border', '1px solid Yellow');
		$('#infobulle').show();
		$('#infobulle').html(string);
	}
}

function hideInfoBulle()
{

	if ( $('#infobulle').attr('flag') == 1 )
		$('#infobulle').hide();
	
}
