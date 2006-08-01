// ******************************************************************
// HTML display functions
// ******************************************************************

function newForm ( name, URL, method, target )
{
	if ( typeof method == "undefined" ) { method = 'post'; }
	var myForm= document.createElement ( 'form' );
	myForm.setAttribute ( 'method', method );
	myForm.setAttribute ( 'action', URL );
	myForm.setAttribute ( 'name', name );
	if ( typeof target != "undefined" ) { myForm.setAttribute ( 'target', target ); }
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

function newButton ( name, value, onClick )
{
	myInput = document.createElement ( 'input' );
	myInput.setAttribute ( 'name', name );
	myInput.setAttribute ( 'type', 'submit' );
	myInput.setAttribute ( 'value', value );
	myInput.setAttribute( 'class', 'mh_form_submit' );
	if ( typeof onClick != "undefined" ) { myInput.setAttribute ( 'onClick', onClick ); }
	return myInput;
}

function newText ( name, value, size, max )
{
	var myInput = document.createElement ( 'input' );
	myInput.setAttribute ( 'type', 'text' );
	myInput.setAttribute ( 'class', 'TextboxV2' );
	myInput.setAttribute ( 'name', name );
	myInput.setAttribute ( 'wrap', 'off' );
	myInput.setAttribute ( 'value', value );
	if ( typeof size != "undefined" ) { myInput.setAttribute ( 'size', size ); }
	if ( typeof max != "undefined" ) { myInput.setAttribute ( 'maxlength', max ); }
	return myInput;
}

function newCheckbox ( name, onClick )
{
	myInput = document.createElement ( 'input' );
	myInput.setAttribute ( 'name', name );
	myInput.setAttribute ( 'type', 'checkbox' );
	if ( typeof onClick != "undefined" ) { myInput.setAttribute ( 'onClick', onClick ); }
	return myInput;
}

function newTable ( name )
{
	myElt = document.createElement ( 'table' );
	myElt.setAttribute ( 'name', name );
	myElt.setAttribute ( 'width', '98%' );
	myElt.setAttribute ( 'border', '0' );
	myElt.setAttribute ( 'align', 'center' );
	myElt.setAttribute ( 'cellpadding', '4' );
	myElt.setAttribute ( 'cellspacing', '1' );
	myElt.setAttribute ( 'class', 'mh_tdborder' );
	return myElt;
}

function newTR ()
{
	myElt = document.createElement ( 'tr' );
	myElt.setAttribute ( 'class','mh_tdtitre' );
	return myElt;
}

function newTD ()
{
	myElt = document.createElement ( 'td' );
	myElt.setAttribute ( 'class','mh_tdtitre' );
	return myElt;
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

// ******************************************************************
// Error logging functions
// ******************************************************************

var errorLog = '';

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

var debugLog = '';

function debug ( msg )
{
	debugLog += msg + '\n';
}

function displayDebug ( insertPoint )
{
	if ( debugLog != '' )
	{
		var myTable = newTable ( 'FMdebug' );
		myTable.appendChild ( myTR = newTR () );
		myTR.appendChild ( myTD = newTD () );
		myTD.innerHTML = '<b> Firemago a généré les messages de debug suivants : </b> \n' + debugLog;
		
		try { insertBeforeCR ( myTable, insertPoint ); } catch ( e ) { alert ( 'Could not display FireMago debug : ' + e ); }
	}
}

// ******************************************************************
// Cookies functions
// ******************************************************************

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

function cookifyButton ( btn )
{
	var btnName = btn.getAttribute ( "NAME" );
	if ( btn.checked == true ) { setCookie ( btnName, "true" ); } else { setCookie ( btnName, "false" ); }
	return btn.checked;
}

function uncookifyButton ( btn )
{
	if ( getCookie ( btn.getAttribute ( "NAME" ) ) == "true" ) { btn.checked = true; }
	return btn.checked;
}

function cookifyInput ( input )
{
	setCookie ( input.getAttribute ( "NAME" ), input.value );
	return input.value;
}

function uncookifyInput ( input )
{
	input.value = getCookie ( input.getAttribute ( "NAME" ) );
	return input.value;
}

// ******************************************************************
// node to text functions
// ******************************************************************

function flattenNode ( node )
{
	var result = '';
	for ( var i = 0; i < node.childNodes.length; i++ ) 
	{
		if ( node.childNodes[i].hasChildNodes () )
		{
			if ( node.childNodes[i].nodeName == "TR" ) { result += "\n"; }
			if ( node.childNodes[i].nodeName == "LI" ) { result += "\n"; }
			if ( node.childNodes[i].nodeName == "TD" ) { result += "\t"; }
			if ( node.childNodes[i].nodeName == "P" ) { result += "\n"; }
			result += flattenNode ( node.childNodes[i] );
		}
		else
		{
			if ( node.childNodes[i].nodeName == "BR" ) { result += "\n"; }
			if ( node.childNodes[i].nodeValue != null )
			{
				var text = new String ( node.childNodes[i].nodeValue );
				result += text.replace ( /\s+/g, " " );
			}
		}
	}
	return result;
}


// ********************************************************
// MAIN CODE
// ********************************************************

var anchorAllTables = document.getElementsByTagName ( 'table' ); // ANCHOR
var anchorMainTr = anchorAllTables[3].getElementsByTagName ( 'tr' ); // ANCHOR

try { 
	var anchorCss = document.getElementsByTagName ( 'link' )[0]; // ANCHOR
	var anchorEquip = anchorAllTables[3].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].nodeValue;
	if (  anchorCss.getAttribute ( 'href' ).indexOf ( 'www.mountyhall.com' ) == -1 && anchorCss.getAttribute ( 'href' ).indexOf ( 'parchemin' ) == -1 && anchorEquip == "MON ÉQUIPEMENT" )
	{
		anchorAllTables[5].setAttribute('style','background-color:#b2b2b2;background-image:url(http://outils.relaismago.com/images/profil_background.jpg);background-repeat: no-repeat;background-position: left center;');
	}
} catch ( e ) { error ( e, 'Background Image error' ); }


// ********************************************************
// Adding login IFRAME
// ********************************************************
/*
var myTr = document.createElement ( 'tr' );
myTr.setAttribute ( 'class','mh_tdtitre' );
var myTd = document.createElement ( 'td' );
myTd.setAttribute ( 'colspan', '2' );
var myIFrame = document.createElement ( 'iframe' );
myIFrame.setAttribute ( 'src', URLLoginRM );
myIFrame.setAttribute ( 'width', '100%' );
myIFrame.setAttribute ( 'height', '50' );
myIFrame.setAttribute ( 'frameborder', '0' );
myIFrame.setAttribute ( 'scrolling', 'no' );
myTd.appendChild ( myIFrame );
myTr.appendChild ( myTd );
try { anchorAllTables[2].appendChild ( myTr ); } catch ( e ) { error ( e, 'Auth R&M error' ); }
*/
// ********************************************************
// GGC and VVT links
// ********************************************************

/*
var profil;
try { profil = flattenNode ( anchorAllTables[3] );  } catch ( e ) { error ( e, 'Profile flattening error' ); }
*/
displayErrors ( anchorAllTables[3] );
displayDebug ( anchorAllTables[3] );
