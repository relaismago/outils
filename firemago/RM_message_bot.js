var currentDocument = window.self.document;
var table = currentDocument.getElementsByTagName ( 'table' ) [0];
var titleHTML = table.getElementsByTagName ( 'tr' ) [0].getElementsByTagName ( 'td' ) [0].getElementsByTagName ( 'font' ) [0].innerHTML;

if ( titleHTML.indexOf ( '[MountyHall] CdM' ) != -1 ||  titleHTML.indexOf ( 'Connaissance des Monstres' ) != -1) 
{
	processCdM ();
}

if ( titleHTML.indexOf ( 'Compétence' ) != -1 ) 
{
	processCompetence ();
}

if ( titleHTML.indexOf ( 'Sortilège' ) != -1 ) 
{
	processSortilege ();
}

if ( titleHTML.indexOf ( 'Attaquant' ) != -1 ) 
{
	processAttaque ();
}

if ( titleHTML.indexOf ( 'Défenseur' ) != -1 ) 
{
	processDefense ();
}

if ( titleHTML.indexOf ( 'un pouvoir' ) != -1 ) 
{
	processPouvoir ();
}

if ( titleHTML.indexOf ( 'Analyse Anatomique' ) != -1 ) 
{
  message = flattenNode ( table );
  processAA ( message );
}

if ( titleHTML.indexOf ( 'Déclenchement de Piège' ) != -1 ) 
{
	removeTrap ();
}

function removeTrap(){
	
	var trapHTML = table.getElementsByTagName ( 'tr' ) [4].getElementsByTagName ( 'td' ) [0].innerHTML;
	var trap = trapHTML.replace ( /<br>/g, "\n" ).split(/\*+/);	
	trap = formatString(trap[1]);	

	newScript = document.createElement ( 'script' );
	newScript.setAttribute ( 'language', 'JavaScript' );
	newScript.setAttribute ( 'src',  URLMessageProcessGGC+'?trapInfo='+trap+'&idLanceur='+getCookie ('NUM_TROLL') );
	document.body.appendChild ( newScript );		
	
}

function processPouvoir ()
{

	var pouvoirHTML = table.getElementsByTagName ( 'tr' ) [4].getElementsByTagName ( 'td' ) [0].innerHTML;
	var pouvoir = pouvoirHTML.replace ( /<br>/g, "\n" ).split(/\*+/);	
	var nomPouvoir = pouvoirHTML.match(/capacité spéciale : .+<br>Elle a pour/);
	var date = getDate();
	var idCible = pouvoirHTML.match(/Trõll n°\d+/g).toString().match(/\d+/);

	if ( nomPouvoir )
		nomPouvoir = nomPouvoir.toString().replace(/capacité spéciale : /,'').toString().replace(/<br>Elle a pour/,'');
	else
		nomPouvoir = "POUVOIR";
	pouvoir = formatString(pouvoir[1]);	

	newScript = document.createElement ( 'script' );
	newScript.setAttribute ( 'language', 'JavaScript' );
	newScript.setAttribute ( 'src',  URLMessageProcessGGC+'?type=POUVOIR&nom='+nomPouvoir+stripcopiercoller( pouvoir )+'&date='+date+'&idCible='+idCible+'&idLanceur='+getIdCible() );
	document.body.appendChild ( newScript );	
	
}

function processAttaque ()
{
	
	var espace = currentDocument.createTextNode ( '\t' );
	var buttonZone = table.getElementsByTagName ( 'tr' ) [5].getElementsByTagName ( 'td' ) [0];	
	var attaqueHTML = table.getElementsByTagName ( 'tr' ) [4].getElementsByTagName ( 'td' ) [0].innerHTML;
	var attaque = attaqueHTML.replace ( /<br>/g, "\n" ).split(/\*+/);	
	var myForm= newForm ( 'processGGC', URLMessageProcessGGC );
	var type = "COMBAT";
	
	attaque = formatString(attaque[1]);	
	if ( attaque.match(/TUÉ/g) )
		type = "MORT";	
		
	myForm.appendChild ( newHidden ( 'copiercoller', attaque ) );	
	myForm.appendChild ( newHidden ( 'type', type ) );	
	myForm.appendChild ( newHidden ( 'nom', 'AttaqueBot' ) );
	myForm.appendChild ( newHidden ( 'date', getDate() ) );	
	myForm.appendChild ( newHidden ( 'idLanceur', getCookie ('NUM_TROLL') ) );	
	myForm.appendChild ( newHidden ( 'idCible', getIdCible() ) );
	myForm.appendChild ( newButton ( 'soumettre', "Enregistrer l'attaque pour le GGC" ) );
	buttonZone.insertBefore ( espace, currentDocument.getElementsByName ( 'bClose' )[0] );
	buttonZone.insertBefore ( myForm, espace);	
	
}

function processDefense ()
{
	
	var attaqueHTML = table.getElementsByTagName ( 'tr' ) [4].getElementsByTagName ( 'td' ) [0].innerHTML;
	var attaque = attaqueHTML.replace ( /<br>/g, "\n" ).split(/\*+/);	
	var myForm= newForm ( 'processGGC', URLMessageProcessGGC );
	var type = "COMBAT";	
	var idCible = attaqueHTML.match(/Trõll n°\d+/g).toString().match(/\d+/);
	var date = getDate();
	
	attaque = formatString(attaque[1]);	
	if ( attaque.match(/TUÉ/g) )
		type = "MORT";
		
	newScript = document.createElement ( 'script' );
	newScript.setAttribute ( 'language', 'JavaScript' );
	newScript.setAttribute ( 'src',  URLMessageProcessGGC+'?type='+type+'&nom='+type+stripcopiercoller( attaque )+'&date='+getDate()+'&idCible='+idCible+'&idLanceur='+getIdCible() );
	document.body.appendChild ( newScript );	
	
}

function processCompetence ()
{

	var competenceHTML = table.getElementsByTagName ( 'tr' ) [4].getElementsByTagName ( 'td' ) [0].innerHTML;
	var competence = competenceHTML.replace ( /<br>/g, "\n" ).split(/\*+/);	
	var nomCompetence = titleHTML.match(/Compétence .* sur/);
	var idCible = getIdCible();
	var date = getDate();
	
	competence = formatString(competence[1]);	
	if ( nomCompetence )
		nomCompetence = trim(nomCompetence.toString().match(/ .* /).toString()).replace(/^: /g,'');
	else
		nomCompetence = "EM";
	
	if ( nomCompetence.match(/Bidouille|Pistage|EM/) )
		idCible = getCookie ('NUM_TROLL');	
	
	addToBdd( 'COMPETENCE', nomCompetence, competence, date, idCible );
	
}

function processSortilege ()
{
	
	var SortilegeHTML = table.getElementsByTagName ( 'tr' ) [4].getElementsByTagName ( 'td' ) [0].innerHTML;
	var sortilege = SortilegeHTML.replace ( /<br>/g, "\n" ).split(/\*+/);	
	var nomSortilege = titleHTML.match(/: .*/).toString().replace(/^: /g, '').replace(/\s+$/g, '');
	var idCible = $('html>body>form>table>tbody>tr>td>b>font').text().match(/\(\d+\)/);
	var date = getDate();

	sortilege = formatString(sortilege[1]);	
	idCible = (idCible) ? idCible.toString().match(/\d+/): $('html>body>form>table>tbody>tr:eq(4)>td').text().match(/\(\d+\)/);
	idCible = (idCible) ? idCible.toString().match(/\d+/): getCookie ('NUM_TROLL');	
	
	if (nomSortilege.match(/Sacrifice/))
		nomSortilege = "Sacro";

	if (nomSortilege.match(/Téléportation/)) {
		nomSortilege = "TP";
		idCible = getCookie ('NUM_TROLL');
	}

	if (nomSortilege.match(/Identification des trésors/)) {
		nomSortilege = "IdT";
		idCible = getCookie ('NUM_TROLL');
	}	
	
	if (nomSortilege.match(/Vision Accrue/)) {
		nomSortilege = "VA";
		idCible = getCookie ('NUM_TROLL');
	}		
	
	addToBdd( 'SORTILEGE', nomSortilege, sortilege, date, idCible );
	
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

// Ajoute l'action à la bdd
function addToBdd( type, name, attaque, date, idCible )
{
	
	newScript = document.createElement ( 'script' );
	newScript.setAttribute ( 'language', 'JavaScript' );
	newScript.setAttribute ( 'src',  URLMessageProcessGGC+'?type='+type+'&nom='+name+'&date='+date+'&idCible='+idCible+'&idLanceur='+getCookie ('NUM_TROLL')+stripcopiercoller( attaque ) );
	document.body.appendChild ( newScript );
	
}

function stripcopiercoller( string )
{
	retour = '&copiercoller[]=';
	if ( string.length > 50 )
		return retour+string.substr(0,50)+stripcopiercoller( string.substr(50) );
	return retour+string;	
}

function formatString(string)
{
	return trim(string).toString().replace(/\+/g,'%2B').replace(/&gt;/g,'>').replace(/\n/g,'<|>');
}

function trim( string )
{
	return string.replace ( /<br>/g, "\n" ).replace(/^\s+/g, '').replace(/\s+$/g, '');
}

function getDate()
{
	return $('html>body>form>table>tbody>tr:eq(1)>td:eq(3)').text();	
}

function getIdCible()
{
	id = $('html>body>form>table>tbody>tr>td>b>font').text().match(/\(\d+\)/)
	if ( id )
		return id.toString().match(/\d+/);
	else
		return $('html>body>form>table>tbody>tr>td>b>font').text().match(/n°\d+/).toString().match(/\d+/);
}

function newForm ( name, URL, method )
{
	if ( typeof method == "undefined" ) { method = 'post'; }
	var myForm= document.createElement ( 'form' );
	myForm.setAttribute ( 'method', method );
	myForm.setAttribute ( 'action', URL );
	myForm.setAttribute ( 'name', name );
	myForm.setAttribute( 'target', '_blank' );	
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

// Récupère un cookie
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