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
			if ( node.childNodes[i].nodeName == "TD" ) { result += " "; } //laisser l'espace et ne pas mettre \t sinon marche pas
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


var currentDocument = window.self.document;
var table = currentDocument.getElementsByTagName ( 'table' ) [0];
try { message = flattenNode ( table ); } catch ( e ) { error ( e, 'bot message flattening error' ); }

if ( message.indexOf ( 'a les caractéristiques suivantes' ) != -1 )
{
	processAA ( message );
}

function processAA ( aa ) 
{
	var myForm= newForm ( 'form_anat', URLMessageProcessSortAA );
	myForm.setAttribute ( 'target', '_blank' );
	myForm.appendChild ( newHidden ( 'copiercoller', aa ) );
	myForm.appendChild ( newHidden ( 'id_troll', 'newdb' ) );
	myForm.appendChild ( newButton ( 'soumettre', 'Renseigner le trolliaire' ) );

	try {
		insertBefore Tab ( myForm, currentDocument.getElementsByName ( 'as_Action' )[0] );
	} catch ( e ) { error ( e, 'AA submit error' ); }

	// var espace = currentDocument.createTextNode ( '\t' );
	// currentDocument.getElementsByName ( 'as_Action' )[0].parentNode.insertBefore ( espace, currentDocument.getElementsByName ( 'as_Action' )[0] );
	// currentDocument.getElementsByName ( 'as_Action' )[0].parentNode.insertBefore ( myForm, espace);
}

