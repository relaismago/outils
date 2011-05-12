var hauteur = 50;
var bulleStyle = null;
creerBulle();

// Event Monstre 
if ( window.self.location.toString().indexOf(URLEventMonstre) != -1 ) {
	anchorEvent = $('html>body>table:eq(1)>tbody');
}

// Event Joueur
if ( window.self.location.toString().indexOf(URLEvent) != -1 ) {
	anchorEvent = $('html>body>table>tbody>tr:eq(1)>td>table>tbody>tr>td:eq(1)>table:eq(2)>tbody');
}

// Event Troll
if ( window.self.location.toString ().indexOf(URLEventTroll) != -1 ){
	anchorEvent = $('html>body>table:eq(1)>tbody');
}

// Event News
if ( window.self.location.toString().indexOf(URLNews) != -1 ) {
	anchorEvent = $('html>body>table>tbody>tr:eq(1)>td>table>tbody>tr>td:eq(1)>table>tbody>tr>td>p:eq(2)>table:eq(1)>tbody');
}

$('tr:eq(0)>td:eq(1)',anchorEvent).after('<td width="100"><b>Info</b></td>');
var arrayEvent = "";
$('>tr',anchorEvent).each(function(index) {
	$('>td:eq(1)',this).attr('align','center');
	if ( index != 0 ){
		var eventType = $('>td:eq(1)', this).text().replace(/^\s+/g, '').replace(/\s+$/g, '');
		if ( eventType == "MORT" || eventType == "COMBAT" || eventType == "SORTILEGE" || eventType == "COMPETENCE" ) {
			var eventDescArray = $('>td:eq(2)', this).text().split(")");
			idLanceur = eventDescArray[0].match(/\d+/);	
			idCible = eventDescArray[1].match(/\d+/);
			if ( !idCible && eventDescArray[2] )
				idCible = eventDescArray[2].match(/\d+/);
			if ( !idCible )				
				idCible = idLanceur;	
			if ( $('>td:eq(2)', this).text().match(/pouvoir/) )	
				eventType = "POUVOIR";
			arrayEvent += "index[]=" + index + "&idLanceurs[]="+idLanceur+"&idCibles[]="+idCible+"&eventDates[]=" + $('>td:eq(0)', this).text() + "&eventTypes[]=" + eventType + "&";
		}
		$('>td:eq(1)',this).after('<td width="100" align="center"></td>');	
	}
	
});

if (arrayEvent != "") {
	newEventScript = document.createElement('script');
	newEventScript.setAttribute('language', 'JavaScript');
	newEventScript.setAttribute('src', URLEventInfos + arrayEvent);
	document.body.appendChild(newEventScript);
}

function infoBulle( nom, evt, fonction, paramfct ) {
				//alert (paramfct[0]);
        var str;
        var val = nom.replace( /[ ]/g, '');
        val = nom.replace( /\W/g, '');
        val = val.toLowerCase();

        eval ( "str = "+fonction+"('"+paramfct+"');" );
        if(str=="") return;
        var xfenetre, yfenetre, xpage, ypage, element = null;
        var offset= 15;
        var bulleWidth=300;
        if ( !hauteur ) hauteur = 50;

        element = document.getElementById( 'bulle' );
        xfenetre = evt.clientX;
        yfenetre = evt.clientY;
        xpage = xfenetre;
        ypage = yfenetre;
        if( evt.pageX ) xpage = evt.pageX;
        if( evt.pageY ) ypage = evt.pageY;

        if( element ) {
           bulleStyle = element.style;
					 if ( fonction.indexOf ('gainPX') != -1 )
					 	element.childNodes[0].childNodes[0].innerHTML = '<b>Gain en PX en cas de kill</b>';
					 else
           element.childNodes[0].childNodes[0].innerHTML = '<b>'+nom+'</b>';
           element.childNodes[1].childNodes[0].innerHTML = str;
        }

        if( bulleStyle ) {
          if ( xfenetre > bulleWidth + offset ) xpage = xpage - bulleWidth - offset;
          else xpage = xpage + 15;
          if ( yfenetre > hauteur + offset ) ypage = ypage - hauteur - offset;
          bulleStyle.width = bulleWidth;
          bulleStyle.left = xpage + 'px';
          bulleStyle.top = ypage + 'px';
          bulleStyle.visibility = "visible";
        }
}

function gainPX ( nivMonstre )
{
	var nivTroll = getCookie("NIV_TROLL");
	if ( nivTroll != "" )
	{
		if ( nivMonstre.indexOf ( '?' ) != -1 )
			return '0';
		else
		{
			var gain = nivMonstre - ( 2 * (nivTroll - nivMonstre)) + 10;
			if ( gain < 0 )
				return "0";
			else
				return gain;
		}
	}
	else
		return "Vas voir sur ton profil que je regarde ton niveau !";
}

function getCookie ( name ) {
	var dc = document.cookie;
	var prefix = name + "=";
	var begin = dc.indexOf ( "; " + prefix );
	if ( begin == -1 ) 
	{
		begin = dc.indexOf ( prefix );
		if ( begin != 0 ) return '';
	} 
	else { begin += 2; }
	var end = document.cookie.indexOf ( ";", begin );
	if ( end == -1 ) { end = dc.length; }
	return unescape ( dc.substring ( begin + prefix.length, end ) );
}

function cacherInfoBulle() {
        if( bulleStyle )
          bulleStyle.visibility="hidden";
}

function caracMonster ( carac )
{
	var arrCarac = carac.split("<|>");
	text = "";	
	for (var i in arrCarac) {

		if ( arrCarac[i] != "" ){
			arrCarac[i] = arrCarac[i].split(":");
			if (arrCarac[i] && i > 1) 
				if (arrCarac[i][0].match(/Capacité spéciale/)) 
					text += "<tr><td class='mh_tdtitre'>" + arrCarac[i][0] + "</td><td class='mh_tdpage'>" + arrCarac[i][1] + arrCarac[i][2] + "</td></tr>";
				else 
					text += "<tr><td class='mh_tdtitre'>" + arrCarac[i][0] + "</td><td class='mh_tdpage'>" + arrCarac[i][1] + "</td></tr>";
			else 
				if (i != 1) 
					text += "<tr><td class='mh_tdtitre' colspan='2' align='center'><b>" + arrCarac[i][0] + arrCarac[i][1] + "</b></td></tr>";
		}	
			
	} 
	return text.replace(/undefined/,'');
}

function compSort ( desc )
{
	var arrdesc = desc.split("<|>");
	var s = "";
	text = "";	
	for (var i in arrdesc)
	{
		s = trim(arrdesc[i].replace(/<\/?[^>]+>/gi, ''));
		if ( s != "" )
			text += "<tr><td class='mh_tdtitre'>"+s+"</td></tr>";
	} 
	return text;	
}

// Trim et format la string
function trim( string )
{
	return string.replace(/^\s+/g, '').replace(/\s+$/g, '');
}

function creerBulle() {
        var newTd = document.createElement( 'td' );
        newTd.appendChild( document.createTextNode( 'Titre' ) );

        var newTr = document.createElement( 'tr' );
        newTr.setAttribute( 'class', 'mh_tdtitre' );
        newTr.appendChild( newTd );

        var newTable = document.createElement( 'table' );
        newTable.setAttribute( 'id', 'bulle' );
        newTable.setAttribute( 'class', 'mh_tdborder' );
        newTable.setAttribute( 'width', '300' );
        newTable.setAttribute( 'height', '300' );		
        newTable.setAttribute( 'border', '0' );
        newTable.setAttribute( 'cellpadding', '5' );
        newTable.setAttribute( 'cellspacing', '5' );
        newTable.setAttribute( 'onclick', 'cacherInfoBulle();' );
        newTable.setAttribute( 'style', 'position:absolute;visibility:hidden;z-index:800;height:auto;' );
        newTable.appendChild( newTr );

        newTd = document.createElement( 'td' );
        newTd.appendChild( document.createTextNode( 'Contenu' ) );

        newTr = document.createElement( 'tr' );
        newTr.setAttribute( 'class', 'mh_tdpage' );
        newTr.appendChild( newTd );

        newTable.appendChild( newTr );

        var aList = document.getElementsByTagName( 'a' );
        aList[aList.length-1].parentNode.appendChild( newTable );
}