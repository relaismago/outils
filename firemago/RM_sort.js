var resultat = $('html>body>table>tbody>tr:eq(1)>td>table>tbody>tr>td:eq(1)>table>tbody>tr>td');
alert(resultat);
// Analyse Anatomique
if ( window.self.location.toString ().match(/ai_IdSort=20/) )
{
	setCookie("nomSort", "AA", "", "/");
}

// Armure Ethérée
if ( window.self.location.toString ().match(/ai_IdSort=16/) )
{
	setCookie("nomSort", "Armure Ethérée", "", "/");
}

// Augmentation de l´Attaque
if ( window.self.location.toString ().match(/ai_IdSort=6^\d/) )
{
	setCookie("nomSort", "AdA", "", "/");
}

// Augmentation de l´Esquive
if ( window.self.location.toString ().match(/ai_IdSort=7^\d/) )
{
	setCookie("nomSort", "AdE", "", "/");
}

// Augmentation des Dégats
if ( window.self.location.toString ().match(/ai_IdSort=5^\d/) )
{
	setCookie("nomSort", "AdE", "", "/");
}

// Bulle Anti-Magie
if ( window.self.location.toString ().match(/ai_IdSort=27/) )
{
	setCookie("nomSort", "BAM", "", "/");
}

// Bulle Magique
if ( window.self.location.toString ().match(/ai_IdSort=29/) )
{
	setCookie("nomSort", "BuM", "", "/");
}

// Explo
if ( window.self.location.toString ().match(/ai_IdSort=8b/) )
{
	setCookie("nomSort", "Explo", "", "/");
}

// Faiblesse Passagère
if ( window.self.location.toString ().match(/ai_IdSort=12/) )
{
	setCookie("nomSort", "Faiblesse Passagère", "", "/");
}

// Flash Aveuglant
/*if ( window.self.location.toString ().match(/ai_IdSort=19b/) )
{
	setCookie("nomSort", "FA", "", "/");
}*/

// Glue
if ( window.self.location.toString ().match(/ai_IdSort=18/) )
{
	setCookie("nomSort", "Glue", "", "/");
}

// Hypno
if ( window.self.location.toString ().match(/ai_IdSort=2^\d/) )
{
	setCookie("nomSort", "Hypno", "", "/");
}

// IdT
if (window.self.location.toString().match(/ai_IdSort=10/))
{
	setCookie("nomSort", "IdT", "", "/");
}

// Invisibilité
if ( window.self.location.toString ().match(/ai_IdSort=15/) )
{
	setCookie("nomSort", "Invi", "", "/");
}

// Lévitation
if ( window.self.location.toString ().match(/ai_IdSort=33/) )
{
	setCookie("nomSort", "Lévitation", "", "/");
}

// Précision Magique
if ( window.self.location.toString ().match(/ai_IdSort=34/) )
{
	setCookie("nomSort", "Précision Magique", "", "/");
}

// Projection
if ( window.self.location.toString ().match(/ai_IdSort=21/) )
{
	setCookie("nomSort", "Projection", "", "/");
}

// Puissance Magique
if ( window.self.location.toString ().match(/ai_IdSort=35/) )
{
	setCookie("nomSort", "Puissance Magique", "", "/");
}

// Sacrifice
if ( window.self.location.toString ().match(/ai_IdSort=17/) )
{
	setCookie("nomSort", "Sacro", "", "/");
}

// Télékinésie
if ( window.self.location.toString ().match(/ai_IdSort=24/) )
{
	setCookie("nomSort", "Télék", "", "/");
}

// Téléportation
if ( window.self.location.toString ().match(/ai_IdSort=13/) )
{
	setCookie("nomSort", "TP", "", "/");
}

// Vision Accrue
if ( window.self.location.toString ().match(/ai_IdSort=22/) )
{
	setCookie("nomSort", "VA", "", "/");
}

// Vision lointaine
if ( window.self.location.toString ().match(/ai_IdSort=9^\d/) )
{
	setCookie("nomSort", "VL", "", "/");
}

// Voir le Caché
if ( window.self.location.toString ().match(/ai_IdSort=23/) )
{
	setCookie("nomSort", "VlC", "", "/");
}

// Vue Troublée
if ( window.self.location.toString ().match(/ai_IdSort=11/) )
{
	setCookie("nomSort", "VT", "", "/");
}

if ( resultat.html().match(/RÉUSSI/g) ) 
{
 
 	if (getCookie("nomSort") != "") {
		
		var idCible = getCookie ('NUM_TROLL');
		
		if ( getCookie("nomSort").match(/AA|Faiblesse Passagère|Explo|FA|Hypno|Projection|Sacro|VT/g) )
			idCible = getIdCible(strip_tags(resultat));
		
		if (getCookie("nomSort") == "AA")
			processAA ();
		addToBdd('SORTILEGE', getCookie("nomSort"), formatString(strip_tags(resultat)), getDate(), idCible);
		setCookie("nomSort", "", "", "/");
		
	}		

}

function processAA () 
{
	
	var table = currentDocument.getElementsByTagName ( 'table' ) [0];
	try { message = flattenNode ( table ); } catch ( e ) { error ( e, 'bot message flattening error' ); }	
	
	var myForm= newForm ( 'form_anat', URLMessageProcessSortAA );
	myForm.setAttribute ( 'target', '_blank' );
	myForm.appendChild ( newHidden ( 'copiercoller', message ) );
	myForm.appendChild ( newHidden ( 'id_troll', 'newdb' ) );
	myForm.appendChild ( newButton ( 'soumettre', 'Renseigner le trolliaire' ) );

	try 
	{
		var espace = currentDocument.createTextNode ( '\t' );
		currentDocument.getElementsByName ( 'as_Action' )[0].parentNode.insertBefore ( espace, currentDocument.getElementsByName ( 'as_Action' )[0] );
		currentDocument.getElementsByName ( 'as_Action' )[0].parentNode.insertBefore ( myForm, espace);
	} catch ( e ) { error ( e, 'AA submit error' ); }
}

// Ajoute l'action à la bdd
function addToBdd( type, name, attaque, date, idCible )
{

	newScript = document.createElement ( 'script' );
	newScript.setAttribute ( 'language', 'JavaScript' );
	newScript.setAttribute ( 'src',  URLMessageProcessGGC+'?type='+type+'&nom='+name+'&date='+date+'&idCible='+idCible+'&idLanceur='+getCookie ('NUM_TROLL')+stripcopiercoller( attaque ) );
	document.body.appendChild ( newScript );
	
}

// Coupe la chaine en plusieurs morceau
function stripcopiercoller( string )
{
	retour = '&copiercoller[]=';
	if ( string.length > 50 )
		return retour+string.substr(0,50)+stripcopiercoller( string.substr(50) );
	return retour+string;	
}

// retourne la date
function getDate()
{
	return $('html>body>table>tbody>tr:eq(1)>td>table>tbody>tr>td:eq(1)>p>table>tbody>tr>td').text().match(/\[Heure Serveur :\s+\d{2}\/\d{2}\/\d{4} \d{2}:\d{2}:\d{2} GMT\+0200\s+\]/).toString().match(/\d{2}\/\d{2}\/\d{4} \d{2}:\d{2}:\d{2}/).toString();
}

// Formatte la string
function formatString(string)
{
	return trim(string).toString().replace(/\+/g,'%2B').replace(/&gt;/g,'>').replace(/\n/g,'<|>');
}

// Trim et format la string
function trim( string )
{
	return string.replace ( /<br>/g, "\n" ).replace(/^\s+/g, '').replace(/\s+$/g, '');
}

// Récupère l'id de la cible
function getIdCible(text)
{
	var idCible = text.match(/\(\d+\)/g);	
	if ( !idCible )
		idCible = text.match(/N°\d+/);	
	return idCible.toString().match(/\d+/);	
}

function newForm ( name, URL, method )
{
	if ( typeof method == "undefined" ) { method = 'post'; }
	var myForm= document.createElement ( 'form' );
	myForm.setAttribute ( 'method', method );
	myForm.setAttribute ( 'action', URL );
	myForm.setAttribute ( 'name', name );
	return myForm;
}

function newHidden ( name, value )
{
	var myInput = document.createElement ( 'input' );
	myInput.setAttribute ( 'type', 'hidden' );
	myInput.setAttribute ( 'name', name );
	myInput.setAttribute ( 'wrap', 'off' );
	myInput.setAttribute ( 'value', value );
	return myInput;
}

function newButton ( name, value )
{
	myInput = document.createElement ( 'input' );
	myInput.setAttribute ( 'name', name );
	myInput.setAttribute ( 'type', 'submit' );
	myInput.setAttribute ( 'value', value );
	myInput.setAttribute( 'class', 'mh_form_submit' );
	return myInput;
}

function insertBeforeCR ( element, insertPoint )
{
	var newline = document.createElement ( 'p' );
	insertPoint.parentNode.insertBefore ( newline, insertPoint );
	newline.parentNode.insertBefore ( element, newline );
}

function insertBeforeTab ( element, insertPoint )
{
	var tab = documentCdm.createTextNode ( '\t' );
	insertPoint.parentNode.insertBefore ( tab, insertPoint );
	newline.parentNode.insertBefore ( element, tab );
}

function error ( e, msg )
{
	errorLog += '<br> [ ' + msg + ' ] ' + e.error + ' : ' + e.message + '\n';
}

function displayErrors ( insertPoint )
{
	if ( errorLog != '' )
	{
		var myTable = newTable ( 'FMerrors' );
		myTable.appendChild ( myTR = newTR () );
		myTR.appendChild ( myTD = newTD () );
		myTD.innerHTML = '<b> Firemago a rencontré les erreurs suivantes : </b> \n' + errorLog;
		
		try { insertBeforeCR ( myTable, insertPoint ); } catch ( e ) { alert ( 'Could not display FireMago errors : ' + e ); }
	}
}

// Supprime les tags html et ajoute des sauts de lignes
function strip_tags(element){

	return element.html().replace(/<\/div>|<\/tr>|<p>|<\/p>|<\/li>|<\/form>|<\/div>|<\b>|<br>/gi,'\n').replace(/<\/?[^>]+>/gi, '');

}

// Définie le cookie
function setCookie ( name, value, expires, path, domain, secure ) {
	var expdate = new Date ();
	expdate.setTime ( expdate.getTime () + (24 * 60 * 60 * 1000 * 31 ) );
	var curCookie = name + "=" + escape ( value ) +
		( (expires) ? "; expires=" + expires.toGMTString () : "; expires=" + expdate.toGMTString () ) +
		( (path) ? "; path=" + path : path ) +
		( (domain) ? "; domain=" + domain : "" ) +
		( (secure) ? "; secure" : "" );
	document.cookie = curCookie;
}

// Récupère le cookie
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