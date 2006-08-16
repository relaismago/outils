var totaltab = document.getElementsByTagName ( 'table' );
var tableMonsters = totaltab[4].childNodes[0].childNodes;  // ANCHOR
var tableTrolls = totaltab[6].childNodes[0].childNodes;  // ANCHOR
var tableTreasures = totaltab[8].childNodes[0].childNodes;  // ANCHOR
var tableMushrooms = totaltab[10].childNodes[0].childNodes;  // ANCHOR
var tablePlaces = totaltab[12].childNodes[0].childNodes;  // ANCHOR

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
// Clean Value
// ******************************************************************

function trim ( string )
{
   return string.replace ( /(^\s*)|(\s*$)/g, '' );
}

function str_woa( str ) {
   str = str.replace( /[����]/g, 'e');
   str = str.replace( /[���]/g, 'a' );
   str = str.replace( /[���]/g, 'u' );
   str = str.replace( /[��]/g, 'i' );
   str = str.replace( /[��]/g, 'o' );
   return str;
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
		myTD.innerHTML = '<b> Firemago a rencontr� les erreurs suivantes : </b> \n' + errorLog;
		
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
		myTD.innerHTML = '<b> Firemago a g�n�r� les messages de debug suivants : </b> \n' + debugLog;
		
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

// ******************************************************************
// Filter functions
// ******************************************************************

/*
 * Display or hide elements in a list of MH-TD elements (checked on class name), according to the 
 * result of a validation function.
 * Function checkFunction is called on each list element with parameters (element, checkParam).
 * Whenever function evaluates to true, element is displayed / hidden depending on the hide 
 * parameter. Elements not of class 'mh_tdpage' are ignored.
 */

function toggleListElements ( list, checkFunction, checkParam, hide )
{
	var param = ( new String  ( checkParam ) ).toLowerCase ();
	for ( var i = 2; i < list.length; i++ )
	{
		if ( list[i].className == 'mh_tdpage' && checkFunction ( list[i], param ) )
		{
			if ( hide ) { list[i].style.display='none'; }
			else { list[i].style.display=''; }
		}
	}
}

/*
 * Display or hide elements in a list of MH-TD elements (checked on class name), according to the 
 * result of a validation function.
 * Function checkFunction is called on each list element with parameters (element, checkParam).
 * Whenever function evaluates to true, element is displayed. 
 * Elements not of class 'mh_tdpage' are ignored.
 */
 
function filterListElements ( list, checkFunction, checkParam )
{
	var param = ( new String  ( checkParam ) ).toLowerCase ();
	for ( var i = 2; i < list.length; i++ )
	{
		if ( list[i].className == 'mh_tdpage' && checkFunction ( list[i], param ) ) 
		{
			list[i].style.display='';
		}
		else
		{
			list[i].style.display='none';
		}
	}
}

function checkAlwaysTrue ( node, eltName )
{
	return true;
}

function checkTreasureName ( node, eltName )
{
	return flattenNode ( node.childNodes[2].firstChild ).toLowerCase ().indexOf ( eltName ) != -1;  // ANCHOR
}

function checkMonsterName ( node, eltName )
{
	return node.childNodes[2].childNodes[0].firstChild.nodeValue.toLowerCase ().indexOf ( eltName ) != -1;  // ANCHOR
}

function checkTrollName ( node, eltName )
{
	return node.childNodes[2].getElementsByTagName ( 'a' )[0].firstChild.nodeValue.toLowerCase ().indexOf ( eltName ) != -1;  // ANCHOR
}

function checkTrollClass ( node, eltName )
{
	return node.childNodes[2].getElementsByTagName ( 'a' )[0].className == eltName;  // ANCHOR
}

function toggleGG ()
{
	var on = cookifyButton ( document.getElementsByName ( 'delgg' )[0] );
	toggleListElements ( tableTreasures, checkTreasureName, "Gigots de Gob", on );
}

function toggleComp ()
{
	var on = cookifyButton ( document.getElementsByName ( 'delcomp' )[0] );
	toggleListElements ( tableTreasures, checkTreasureName, "Composant", on );
}

function toggleGowap ()
{
	var on = cookifyButton ( document.getElementsByName ( 'delgowap' )[0] );
	toggleListElements ( tableMonsters, checkMonsterName, "Gowap", on );
}

function toggleIntangible ()
{
	var on = cookifyButton ( document.getElementsByName ( 'delint' )[0] );
	toggleListElements ( tableTrolls, checkTrollClass, "mh_trolls_0", on );
}

function toggleBidouille ()
{
	var on = cookifyButton ( document.getElementsByName ( 'delbid' )[0] );
	toggleListElements ( tableTreasures, checkTreasureName, "Bidouille", on );
}

function filterMonsters ()
{
	var anchorTitle = tableMonsters[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0]; // ANCHOR
	document.getElementsByName ( 'delgowap' )[0].checked=false;
	cookifyButton ( document.getElementsByName ( 'delgowap' )[0] );
	if ( document.getElementsByName ( "filterMonsters" )[0].value != '' )
	{
		var nom = document.getElementsByName ( "filterMonsters" )[0].value.toLowerCase ();
		anchorTitle.nodeValue = "MONSTRES (filtr�s sur " + nom + ")";
		filterListElements ( tableMonsters, checkMonsterName, nom );
	}
	else
	{
		anchorTitle.nodeValue="MONSTRES";
		filterListElements ( tableMonsters, checkAlwaysTrue, '' );
	}
}

function filterTrolls ()
{
	var anchorTitle = tableTrolls[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0]; // ANCHOR
	document.getElementsByName ( 'delint' )[0].checked = false;
	cookifyButton ( document.getElementsByName ( 'delint' )[0] );
	if ( document.getElementsByName ( "filterTrolls" )[0].value != '' )
	{
		var nom = document.getElementsByName ( "filterTrolls" )[0].value.toLowerCase ();
		anchorTitle.nodeValue = "TROLLS (filtr�s sur " + nom + ")";
		filterListElements ( tableTrolls, checkTrollName, nom );
	}
	else
	{
		anchorTitle.nodeValue="TROLLS";
		filterListElements ( tableTrolls, checkAlwaysTrue, '' );
	}
}

function filterTreasures ()
{
	var anchorTitle = tableTreasures[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0]; // ANCHOR
	document.getElementsByName ( 'delgg' )[0].checked = false;
	cookifyButton ( document.getElementsByName ( 'delgg' )[0] );
	document.getElementsByName ( 'delcomp' )[0].checked = false;
	cookifyButton ( document.getElementsByName ( 'delcomp' )[0] );
	document.getElementsByName ( 'delbid' )[0].checked = false;
	cookifyButton ( document.getElementsByName ( 'delbid' )[0] );
	if ( document.getElementsByName ( "filterTreasures" )[0].value != '' )
	{
		var nom = document.getElementsByName ( "filterTreasures" )[0].value.toLowerCase ();
		anchorTitle.nodeValue = "TRESORS (filtr�s sur " + nom + ")";
		filterListElements ( tableTreasures, checkTreasureName, nom );
	}
	else
	{
		anchorTitle.nodeValue="TRESORS";
		filterListElements ( tableTreasures, checkAlwaysTrue, '' );
	}
}


// ********************************************************
// POPUPS
// ********************************************************
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
        newTable.setAttribute( 'border', '0' );
        newTable.setAttribute( 'cellpadding', '5' );
        newTable.setAttribute( 'cellspacing', '1' );
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

function creerInfoBulles( liste ,fonction ) {
        var i = 0;
        while ( true ) {
        	if ( liste.childNodes[i] == null ) {
          	break;
          }
          if ( liste.childNodes[i].childNodes[3] != null ) {
            creerInfoBulle( liste.childNodes[i].childNodes[3].childNodes[1] , fonction );
          }
          if ( liste.childNodes[i].childNodes[9] != null ) {
            creerInfoBulle( liste.childNodes[i].childNodes[9].childNodes[1] , fonction );
          }
          i += 2;
        }
}

function creerInfoBulle( noeud , fonction ) {
        var nom = trim( str_woa( noeud.firstChild.nodeValue ) );
				if ( nom.indexOf ( 'MONSTRES' ) != -1 || nom.indexOf ( 'TROLLS' ) != -1 || nom.indexOf ( 'LIEUX' ) != -1)
					nom = "L�gende couleurs des " + nom;
        noeud.setAttribute( 'onmouseover', "infoBulle('" + nom + "',event,'" + fonction + "','');" );
        noeud.setAttribute( 'onmouseout', "cacherInfoBulle();" );
}

function infoBulle( nom, evt, fonction, paramfct ) {
				//alert (paramfct[0]);
        var str;
        var val = nom.replace( /[ ]/g, '');
        val = nom.replace( /\W/g, '');
        val = val.toLowerCase();

        eval ( "str = "+fonction+"('"+nom+"','"+paramfct+"');" );
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

function cacherInfoBulle() {
        if( bulleStyle )
          bulleStyle.visibility="hidden";
}



// ********************************************************
// Adding 2Dview's button
// ********************************************************

//Build the copy/past string
function getVueScript () 
{
	var maChaine = "MA VUE\n";
	maChaine += flattenNode ( totaltab[3] );
	maChaine += "\nMONSTRES ERRANTS\n";
	maChaine += flattenNode ( tableMonsters[0].parentNode );
	maChaine += "\nTROLLS\n";
	maChaine += flattenNode ( tableTrolls[0].parentNode );
	maChaine += "\nTRESORS\n";
	maChaine += flattenNode ( tableTreasures[0].parentNode );
	maChaine += "\nCHAMPIGNONS\n";
	maChaine += flattenNode ( tableMushrooms[0].parentNode );
	maChaine += "\nLIEUX PARTICULIERS\n";
	maChaine += flattenNode ( tablePlaces[0].parentNode );
	maChaine += "[Contact : dm@mountyhall.com] - [Heure Serveur\n";
	return maChaine;
}


// check the form sent by the button
function checkViewForm ( form )
{
	form = document.select_troll;
	var textboxIdTroll = form.id_troll;
	if ( textboxIdTroll.value == "" || isNaN ( textboxIdTroll.value ) )
	{
		alert ( "Il faut mettre le num�ro du troll � qui appartient\ncette vue dans la petite case pour que �a marche !" );
		textboxIdTroll.focus ();
		return false;
	}
	else
	{
		form.action = URLVue2D;
		window.open ( '', 'popupVue', 'width=" + (screen.width-150) + ", height=" + (screen.height-250) + ", toolbar=no, status=no, location=no, resizable=yes, scrollbars=yes' );
		form.target = 'popupVue';
		//form.target = 'iframe_vue';
		form.submit ();
		return true;
	}	
}


// Build the form with the button
var myForm = newForm ( 'select_troll', '' );
// myForm.setAttribute ( 'accept-charset', 'iso-8859-1, iso-8859-15' );
myForm.setAttribute ( 'onsubmit', 'return checkViewForm(this)' );
myForm.appendChild ( myInput = newHidden ( 'datas', getVueScript () ) );
myForm.appendChild ( document.createElement ( 'b' ).appendChild ( document.createTextNode ( 'N� du troll : ' ) ) );
myForm.appendChild ( myInput = newText ( 'id_troll', getCookie ( "NUM_TROLL" ), 5, 5 ) );
myForm.appendChild ( myInput = newButton ( 'Submit', 'La Vue 2D R&M' ) );

try { insertBeforeCR ( myForm, document.getElementsByTagName( 'a' )[4] ); } catch ( e ) { error ( e, 'vue2d' ); } // ANCHOR


// ********************************************************
// Adding login IFRAME
// ********************************************************

var myTable = newTable ( 'RMauth' );
myTable.appendChild ( myTR = newTR () );
myTR.appendChild ( myTD = newTD () );

var anchorCss = document.getElementsByTagName ( 'link' )[0];
URLLoginRM = URLLoginRM + "?URLStylesheet=" + anchorCss.getAttribute('href');

var myIFrame = document.createElement ( 'iframe' );
myIFrame.setAttribute ( 'name', 'iframe_vue' );
myIFrame.setAttribute ( 'src', URLLoginRM );
myIFrame.setAttribute ( 'width', '100%' );
myIFrame.setAttribute ( 'height', '50' );
myIFrame.setAttribute ( 'frameborder', '0' );
myIFrame.setAttribute ( 'scrolling', 'no' );
myTD.appendChild ( myIFrame );

try { insertBeforeCR ( myTable, totaltab[4] ); } catch ( e ) { error ( e, 'auth RM' ); } // ANCHOR


// ********************************************************
// Adding filter inputs
// ********************************************************

var tableTitle;

// Add monsters filter buttons
try {
	anchorTitle = tableMonsters[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0]; // ANCHOR
	anchorTitle.appendChild ( document.createTextNode (" [ ") );
	anchorTitle.appendChild ( newCheckbox ( 'delgowap', 'toggleGowap()' ) );
	anchorTitle.appendChild ( document.createTextNode ( 'Gowaps' ) );
	anchorTitle.appendChild ( document.createTextNode (" ] ") );
	anchorTitle.appendChild ( newText ( 'filterMonsters', '', 12, 20 ) );
	anchorTitle.appendChild ( newButton ( 'filterMonstersBtn', 'Filtrer', 'filterMonsters()' ) );
} catch ( e ) { error ( e, 'monsterFilters' ); }

// Add trolls filter buttons
try {
	anchorTitle = tableTrolls[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0]; // ANCHOR
	anchorTitle.appendChild ( document.createTextNode (" [ ") );
	anchorTitle.appendChild ( newCheckbox ( 'delint', 'toggleIntangible()' ) );
	anchorTitle.appendChild ( document.createTextNode ( 'Intangibles' ) );
	anchorTitle.appendChild ( document.createTextNode (" ] ") );
	anchorTitle.appendChild ( newText ( 'filterTrolls', '', 12, 20 ) );
	anchorTitle.appendChild ( newButton ( 'filterTrollsBtn', 'Filtrer', 'filterTrolls()' ) );
} catch ( e ) { error ( e, 'trollFilters' ); }

// Add treasures filter buttons
try {
	anchorTitle = tableTreasures[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0]; // ANCHOR
	anchorTitle.appendChild ( document.createTextNode (" [ ") );
	anchorTitle.appendChild ( newCheckbox ( 'delgg', 'toggleGG()' ) );
	anchorTitle.appendChild ( document.createTextNode ( 'GGs' ) );
	anchorTitle.appendChild ( newCheckbox ( 'delcomp', 'toggleComp()' ) );
	anchorTitle.appendChild ( document.createTextNode ( 'Compos' ) );
	anchorTitle.appendChild ( newCheckbox ( 'delbid', 'toggleBidouille()' ) );
	anchorTitle.appendChild ( document.createTextNode ( 'Bidouilles' ) );
	anchorTitle.appendChild ( document.createTextNode (" ] ") );
	anchorTitle.appendChild ( newText ( 'filterTreasures', '', 12, 20 ) );
	anchorTitle.appendChild ( newButton ( 'filterTreasuresBtn', 'Filtrer', 'filterTreasures()' ) );
} catch ( e ) { error ( e, 'treasureFilters' ); }

// restore filters values
try {
	if ( uncookifyButton ( document.getElementsByName ( 'delgg' )[0] ) ) 		{ toggleGG (); }
	if ( uncookifyButton ( document.getElementsByName ( 'delcomp' )[0] ) ) 	{ toggleComp (); }
	if ( uncookifyButton ( document.getElementsByName ( 'delbid' )[0] ) ) 		{ toggleBidouille (); }
	if ( uncookifyButton ( document.getElementsByName ( 'delint' )[0] ) ) 		{ toggleIntangible (); }
	if ( uncookifyButton ( document.getElementsByName ( 'delgowap' )[0] ) ) 	{ toggleGowap (); }
} catch ( e ) { error ( e, 'restoreFilters' ); }

// Defining colors for troll & guild status
var anchorCss = document.getElementsByTagName ( 'link' )[0]; // ANCHOR
if ( anchorCss.getAttribute ( 'href' ).indexOf ( 'www.mountyhall.com' ) != -1 || anchorCss.getAttribute ( 'href' ).indexOf ( 'parchemin' ) != -1)
{
	//alert ("CSS MH");
	var colorEnemy 	= "#ff9f9f";
	var colorTK 		= "#ffde9f";
	var colorFriend = "#9fccff";
	var colorAlly 	= "#9FFF9F";
	var colorRM 		= "#FFFF99";
	var colorUrg		= "#ff7e7e";
	var colorSearch	= "#ff9f9f";
	var colorCdm    = "#40e0c0";
}
else
{
	//alert ("CSS RM");
	var colorEnemy 	= "#FF4422";
	var colorTK 		= "#991111";
	var colorFriend = "#111177";
	var colorAlly 	= "#116611";
	var colorRM 		= "#CC9900";
	var colorUrg		= "#552222";
	var colorSearch	= "#554444";
	var colorCdm		= "#225555";
}


var hauteur = 50;
var bulleStyle = null;
creerBulle();
creerInfoBulle ( tableMonsters[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0],"colorMonsters" );
creerInfoBulle ( tableTrolls[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0],"colorTrolls" );
creerInfoBulle ( tablePlaces[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0],"colorPlaces" );

function colorMonsters()
{
 text = "<table>";
 text += "<tr><td width='15%' bgcolor='" + colorUrg + "'>&nbsp;</td><td>Compo <b>ultra</b> prio pour les scribes !</td></tr>";
 text += "<tr><td width='15%' bgcolor='" + colorSearch + "'>&nbsp;</td><td>Compo prio pour les scribes !</td></tr>";
 text += "<tr><td width='15%' bgcolor='" + colorCdm + "'>&nbsp;</td><td>Vite, fais nous une CdM de la b�te !</td></tr>";
 text += "<tr><td width='15%' bgcolor='" + colorRM + "'>&nbsp;</td><td>Tiens, le gowap d'un pote !</td></tr>";
 text += "</table>";
 return text;
}

function colorTrolls()
{
  text = "<table>";
  text += "<tr><td width='15%' bgcolor='" + colorEnemy + "'>&nbsp;</td><td>Nom d'un streum ! c'est un wanted R&M !</td></tr>";
  text += "<tr><td width='15%' bgcolor='" + colorTK + "'>&nbsp;</td><td>Fais y gaffe c'est un TK !!!</td></tr>";
	text += "<tr><td width='15%' bgcolor='" + colorRM + "'>&nbsp;</td><td>Un R&M !</td></tr>";
  text += "<tr><td width='15%' bgcolor='" + colorFriend + "'>&nbsp;</td><td>Un pote de la guilde !</td></tr>";
  text += "<tr><td width='15%' bgcolor='" + colorAlly + "'>&nbsp;</td><td>Un alli� de la guilde !</td></tr>";
  text += "</table>";
	return text;
}

function colorPlaces()
{
  text = "<table>";
  text += "<tr><td width='15%' bgcolor='" + colorRM + "'>&nbsp;</td><td>Une tani�re R&M !</td></tr>";
  text += "</table>";
  return text;
}


// ********************************************************
// Monster compendium links
// ********************************************************

var myB = document.createElement( 'b' );
myB.appendChild ( document.createTextNode( 'Niveau') );
myTd = newTD();
myTd.setAttribute( 'width', '25' );
myTd.appendChild(myB);
//tableMonsters[1].insertBefore( myTd, tableMonsters[1].childNodes[] );
tableMonsters[1].appendChild( myTd );
tableMonsters[0].childNodes[0].setAttribute ('colspan','7');


arrayMonster = "";
begin = 2;

for ( var i = 2; i < tableMonsters.length; i++ )
{
	try {
		var anchorCellID = tableMonsters[i].childNodes[1]; // ANCHOR
		var anchorCellDesc = tableMonsters[i].childNodes[2]; // ANCHOR
		var anchorID = anchorCellID.childNodes[0]; // ANCHOR
		var anchorDesc = anchorCellDesc.getElementsByTagName ( 'a' )[0]; // ANCHOR
		
		var monsterId = new String ( anchorID.nodeValue );
		var monsterDesc = new String ( flattenNode ( anchorDesc ) );
		var monsterStyle = new String ( anchorDesc.getAttribute ( 'class' ) );
		var monsterName = monsterDesc.substring ( 0, monsterDesc.indexOf ( '[' ) - 1 );
		var monsterAge = monsterDesc.substring ( monsterDesc.indexOf ( '[' ) + 1, monsterDesc.indexOf ( ']' ) );

		arrayMonster += "monsterIds[]=" + monsterId + "&monsterNames[]=" + escape ( monsterDesc ) + "&monsterAges[]=" + escape ( monsterAge.replace ( /'/, " " ) ) + "&";
		
		
		// Adding script for coloring monster's wanted or without cdm
		
		if ( i%30 == 0 )
		{
			arrayMonster += "begin=" + begin;
		  newMonsterScript = document.createElement ( 'script' );
		  newMonsterScript.setAttribute ( 'language', 'JavaScript' );
		  newMonsterScript.setAttribute ( 'src',  URLMonsterInfos  + arrayMonster );
		  ( tablePlaces[tablePlaces.length-1].parentNode.parentNode.parentNode ).appendChild ( newMonsterScript );
			arrayMonster = "";
			begin = i + 1;
		}
	} catch ( e ) { error ( e, 'Monster Compendium error (' + i + ')' ); }
}
// Adding script for coloring monster's wanted or without cdm
if ( arrayMonster != "")
{
	try 
	{
		arrayMonster += "begin=" + begin;
  	newMonsterScript = document.createElement ( 'script' );
  	newMonsterScript.setAttribute ( 'language', 'JavaScript' );
  	newMonsterScript.setAttribute ( 'src',  URLMonsterInfos  + arrayMonster );
  	( tablePlaces[tablePlaces.length-1].parentNode.parentNode.parentNode ).appendChild ( newMonsterScript );
	} catch ( e ) { error ( e, 'Monster Colouring error' ); }
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

function caracMonster ( monster, carac )
{
 var arrCarac = carac.split(";");
 text = "<table width='100%' border='1' align='center'>";
 text += "<tr class='mh_tdtitre'><td align='center'>Niv</td><td align='center'>PdV</td><td align='center'>Att</td><td align='center'>Esq</td><td align='center'>Deg</td><td align='center'>Reg</td><td align='center'>Arm</td><td align='center'>Vue</td></tr>";
 text += "<tr class='mh_tdpage'><td align='center'>" + arrCarac[0] + "</td><td align='center'>" + arrCarac[1] + "</td><td align='center'>" + arrCarac[2] + "</td><td align='center'>" + arrCarac[3] + "</td><td align='center'>" + arrCarac[4] + "</td><td align='center'>" + arrCarac[5] + "</td><td align='center'>" + arrCarac[6] + "</td><td align='center'>" + arrCarac[7] + "</td></tr>";
 if ( arrCarac[8] )
 {
 	text += "<tr class='mh_tdpage'><td colspan='8' align='center'>" + arrCarac[8] + " affecte " + arrCarac[9] + "</td></tr>";
 }
 text += "<tr class='mh_tdpage'><td colspan='8' align='center'>Gain en PX si je le tue : " + gainPX (arrCarac[0]) + "</td></tr>";
 text += "</table>";
 return text;
}



// ********************************************************
// Troll and guild compendium links
// ********************************************************
var arrayTroll = "";
var arrayGuild = "";
begin = 2;
for ( var i = 2; i < tableTrolls.length; i++ )
{
	try {
		var anchorCellTrollID = tableTrolls[i].childNodes[1]; // ANCHOR
		var anchorCellTrollDesc = tableTrolls[i].childNodes[2]; // ANCHOR
		var anchorCellGuildDesc = tableTrolls[i].childNodes[5]; // ANCHOR
		var anchorTrollID = anchorCellTrollID.childNodes[0]; // ANCHOR
		var anchorTrollDesc = anchorCellTrollDesc.getElementsByTagName ( 'a' )[0]; // ANCHOR
		var anchorGuildDesc = anchorCellGuildDesc.getElementsByTagName ( 'a' )[0]; // ANCHOR
		
		// grab styles used for troll and guild
		var styleTroll = new String ( anchorTrollDesc.getAttribute ( 'class' ) );
		var styleGuild = new String ( anchorGuildDesc.getAttribute ( 'class' ) );
		var trollID = new String ( anchorTrollID.nodeValue );
		var trollName = new String ( flattenNode ( anchorTrollDesc ) );
		var guildJS = new String ( anchorGuildDesc.getAttribute ( 'href' ) );
		var guildID = guildJS.substring ( 15, guildJS.indexOf ( ',' ) ); // ANCHOR

		// populate troll and guild list for status coloring
		if ( guildID != '1' ) { arrayGuild += "guildsid[]=" + guildID + ";" + i + "&"; }
		arrayTroll += "trollsid[]=" + trollID + "&";
		
		// create link 'troll id' -> MH troll popup
		var newLink = document.createElement ( 'a' );
		newLink.appendChild ( document.createTextNode ( trollID ) );
		newLink.setAttribute ( 'class', styleTroll );
		newLink.setAttribute ( 'href', 'javascript:EPV(' + trollID + ')' );
		anchorCellTrollID.removeChild ( anchorTrollID );
		anchorCellTrollID.appendChild ( newLink );
	
		// create link 'troll name' -> RM troll file
		var newLink = document.createElement ( 'a' );
		newLink.appendChild ( document.createTextNode ( trollName ) );
		newLink.setAttribute ( 'class', styleTroll );
		newLink.setAttribute ( 'href', URLRGTroll + trollID );
		newLink.setAttribute ( 'target', '\"_blank\"' );
		anchorCellTrollDesc.removeChild ( anchorTrollDesc );
		anchorCellTrollDesc.appendChild ( newLink );
		
		// create link 'RG' -> RM guild file
		var newLink = document.createElement ( 'a' );
		newLink.appendChild ( document.createTextNode ( 'RG' ) );
		newLink.setAttribute ( 'class', styleGuild );
		newLink.setAttribute ( 'href', URLRGGuilde + guildID );
		newLink.setAttribute ( 'target', '\"_blank\"' );
		if ( guildID != '1' )
		{
			anchorCellGuildDesc.insertBefore ( document.createTextNode ( '[' ), anchorGuildDesc );
			anchorCellGuildDesc.insertBefore ( newLink, anchorGuildDesc );
			anchorCellGuildDesc.insertBefore ( document.createTextNode ( '] - ' ), anchorGuildDesc );
		}
		if ( i%30 == 0 )
		{
			// Adding script for coloring tk's and wanted
			arrayTroll += "begin=" + begin;
  		var newTrollScript = document.createElement ( 'script' );
  		newTrollScript.setAttribute ( 'language', 'JavaScript' );
  		newTrollScript.setAttribute ( 'src',  URLTrollInfos  + arrayTroll );
  		( tablePlaces[tablePlaces.length-1].parentNode.parentNode.parentNode ).appendChild ( newTrollScript );
			arrayTroll = "";
			
  		var newGuildeScript = document.createElement ( 'script' );
  		newGuildeScript.setAttribute ( 'language', 'JavaScript' );
  		newGuildeScript.setAttribute ( 'src',  URLGuildeInfos + arrayGuild );
  		( tablePlaces[tablePlaces.length-1].parentNode.parentNode.parentNode ).appendChild ( newGuildeScript );
			arrayGuild = "";

			begin = i + 1;
		}

		
	} catch ( e ) { error ( e, 'Troll and Guild Compendium error (' + i + ')' ); }
}

// Adding script for coloring tk's and wanted
if ( arrayTroll != "" )
{
	try {
	  arrayTroll += "begin=" + begin;
		var newTrollScript = document.createElement ( 'script' );
		newTrollScript.setAttribute ( 'language', 'JavaScript' );
		newTrollScript.setAttribute ( 'src',  URLTrollInfos  + arrayTroll );
		( tablePlaces[tablePlaces.length-1].parentNode.parentNode.parentNode ).appendChild ( newTrollScript );
	} catch ( e ) { error ( e, 'Trolls Colouring error' ); }
}
try
{
	var newGuildeScript = document.createElement ( 'script' );
	newGuildeScript.setAttribute ( 'language', 'JavaScript' );
	newGuildeScript.setAttribute ( 'src',  URLGuildeInfos + arrayGuild );
	( tablePlaces[tablePlaces.length-1].parentNode.parentNode.parentNode ).appendChild ( newGuildeScript );
} catch ( e ) { error ( e, 'Guild Colouring error' ); }

// ********************************************************
// Places colours
// ********************************************************
var arrayPlace = "";
begin = 2;
for ( var i = 2; i < tablePlaces.length; i++ )
{
	try {

    var anchorCellPlaceID = tablePlaces[i].childNodes[1].childNodes[0]; // ANCHOR
		var placeID = anchorCellPlaceID.nodeValue;
		arrayPlace += "placesId[]=" + placeID + "&";

	} catch ( e ) { error ( e, 'Places Colouring error' ); }
	
}

try {
	var newPlaceScript = document.createElement ( 'script' );
	newPlaceScript.setAttribute ( 'language', 'JavaScript' );
	newPlaceScript.setAttribute ( 'src',  URLPlaceInfos  + arrayPlace );
	( tablePlaces[tablePlaces.length-1].parentNode.parentNode.parentNode ).appendChild ( newPlaceScript );
}catch ( e ) { error ( e, 'Places Colouring error' ); }


displayErrors ( totaltab[4] );
displayDebug ( totaltab[4] );



//checkViewForm('formName');

/*
// ********************************************************
// Niveau des monstres
// ********************************************************

if(toto!='')
{
   var newScript1 = document.createElement('script');
   newScript1.setAttribute('language',"JavaScript");
   newScript1.setAttribute('src','http://resel.enst-bretagne.fr/club/mountyhall/script/monstres.php?'+toto);
   (xy[xy.length-1].parentNode).appendChild(newScript1);
}

// http://www.xxx.com/monstres.php?nom[]=diablotin&num_dans_liste[]=1&nom[]=gowap&num_dans_liste[]=2&...
// EXEMPLE DE RESULTAT :
// x[2].childNodes[2].childNodes[0].firstChild.nodeValue=x[2].childNodes[2].childNodes[0].firstChild.nodeValue+' (N: 11-12)';

*/