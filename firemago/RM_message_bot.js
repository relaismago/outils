
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
if ( !currentDocument || !( "body" in currentDocument ) ) 
{
	//return false;
}

var table = currentDocument.getElementsByTagName ( 'table' ) [0];
var titleHTML = table.getElementsByTagName ( 'tr' ) [0].getElementsByTagName ( 'td' ) [0].getElementsByTagName ( 'font' ) [0].innerHTML;

if ( titleHTML.indexOf ( '[MountyHall] CdM' ) != -1 ||  titleHTML.indexOf ( '[MountyHall] Compétence CdM' ) != -1) 
{
	processCdM ();
}

if ( titleHTML.indexOf ( 'Résultat d\'utilisation d\'un Sortilège' ) != -1 ) 
{
  message = flattenNode ( table );
	if ( message.indexOf ( 'a les caractéristiques suivantes' ) != -1 ) 
	{
		processAA ( message );
	}
}

if ( titleHTML.indexOf ( '[MountyHall] Insulte' ) != -1 ) 
{
//	processMessage ( URLMessageProcessCompInsulte );
}

if ( titleHTML.indexOf ( '[MountyHall] Résultat de Combat - Attaquant' ) != -1 ) 
{
//	processMessage ( URLMessageProcessAttaque );
}

if ( titleHTML.indexOf ( '[MountyHall] Résultat de Combat - Défenseur' ) != -1 ) 
{
//	processMessage ( URLMessageProcessDefense );
}

function processCdM () 
{
	var cdmHTML = table.getElementsByTagName ( 'tr' ) [4].getElementsByTagName ( 'td' ) [0].innerHTML;
	var cdm = cdmHTML.replace ( /<br>/g, "\n" );

	var myForm= newForm ( 'processCdM', URLMessageProcessCompCdM );
	myForm.appendChild ( newHidden ( 'copiercoller', cdm ) );
	myForm.appendChild ( newButton ( 'soumettre', "Renseigner le bestiaire" ) );
	
	var espace = currentDocument.createTextNode ( '\t' );
	var buttonZone = table.getElementsByTagName ( 'tr' ) [5].getElementsByTagName ( 'td' ) [0];
	buttonZone.insertBefore ( espace, currentDocument.getElementsByName ( 'bClose' )[0] );
	buttonZone.insertBefore ( myForm, espace);
}


function processAA ( aa ) 
{
	var anchorTrollDesc = document.getElementsByTagName ( 'a' )[0]; // ANCHOR
	trollName = ( flattenNode ( anchorTrollDesc ) );
	//URLMessageProcessSortAA = "http://outils.relaismago.com/vue2d/anatomique/anatomique.php?id_troll=new";
  var myForm= newForm ( 'form_anat', URLMessageProcessSortAA );
  myForm.appendChild ( newHidden ( 'copiercoller', aa ) );
	myForm.appendChild ( newHidden ( 'id_troll', 'newdb' ) );
	myForm.appendChild ( newHidden ( 'source', trollName ) );
  myForm.appendChild ( newButton ( 'soumettre', 'Renseigner le trolliaire' ) );

  var espace = currentDocument.createTextNode ( '\t' );
	var buttonZone =  currentDocument.getElementsByName ( 'bClose' )[0].parentNode ;
  buttonZone.insertBefore ( espace, currentDocument.getElementsByName ( 'bClose' )[0] );
  buttonZone.insertBefore ( myForm, espace);
}


// POUR FUTURE INFO ?
// INSULTE
// var sr = msgHTML.substring ( msgHTML.indexOf ( ': ' ) + 1,  msgHTML.indexOf ( ' %' ) );

function processMessage ( URL ) 
{
	var trollHTML = table.getElementsByTagName ( 'tr' ) [2].getElementsByTagName ( 'td' ) [1].innerHTML;
	var msgHTML = table.getElementsByTagName ( 'tr' ) [4].getElementsByTagName ( 'td' ) [0].innerHTML;
	
	var myForm= newForm ( 'process', URL, 'get' );
	myForm.appendChild ( newHidden ( 'cpTitle', titleHTML ) );
	myForm.appendChild ( newHidden ( 'cpTroll', trollHTML ) );
	myForm.appendChild ( newHidden ( 'cpMsg', msgHTML ) );
	myForm.appendChild ( newButton ( 'soumettre', "Renseigner la base R&M" ) );
	
	var espace = currentDocument.createTextNode ( '\t' );
	var buttonZone = table.getElementsByTagName ( 'tr' ) [5].getElementsByTagName ( 'td' ) [0];
	buttonZone.insertBefore ( espace, currentDocument.getElementsByName ( 'bClose' )[0] );
	buttonZone.insertBefore ( myForm, espace);
}
