var currentDocument = window.self.document;
var resultat = $('html>body>table>tbody>tr:eq(1)>td>table>tbody>tr>td:eq(1)>table>tbody>tr>td');

// Insulte
if ( window.self.location.toString ().match(/Play_a_Competence18.php/) )
{
	catchInsulte();	
}

if ( resultat.html().match(/RÉUSSI/g) ) 
{ 

	var competence = formatString(strip_tags(resultat));	
	var date = getDate();

	// Accel
	if ( window.self.location.toString ().match(/Play_a_Competence3b/) )
	{
		processCompWithoutCible ("Accel");					
	}
	
	// Balayage
	if ( window.self.location.toString ().match(/Play_a_Competence6b/) )
	{
		 processCompWithCible( "Balayage", "COMPETENCE" );					
	}		
	
	// Balluchonnage
	if ( window.self.location.toString ().match(/Play_a_Competence31b/) )
	{
		processCompWithoutCible ("Balluchonnage");					
	}	
	
	// Bidouille
	if ( window.self.location.toString ().match(/Play_a_Competence24c/) )
	{
		processCompWithoutCible ("Bidouille");			
	}			
	
	// Camouflage
	if ( window.self.location.toString ().match(/Play_a_Competence4b/) )
	{
		processCompWithoutCible ("Camouflage");			
	}				
	
	// CdM
	if ( window.self.location.toString().match(/Play_a_Competence16b/) )
	{
		processCdM ();		
	}
	
	// Piège
	if ( window.self.location.toString ().match(/Play_a_Competence15b/) )
	{
		processCompWithoutCible ("Piège");		
		//processTrap ();			
	}		
	
	// Contre-Attaquer
	if ( window.self.location.toString ().match(/Play_a_Competence11b/) )
	{
		 processCompWithoutCible("Contre-Attaquer");					
	}			
	
	// DE
	if ( window.self.location.toString ().match(/ai_IdComp=12/) )
	{
		processCompWithoutCible ("DE");			
	}	
	
	// Dressage
	if ( window.self.location.toString ().match(/Play_a_Competence27b/) )
	{
		 processCompWithCible( "Dressage", "COMPETENCE" );					
	}		
	
	// EM
	if ( window.self.location.toString ().match(/Play_a_Competence19/) )
	{
		processCompWithoutCible ("EM");			
	}	
	
	// Golemologie
	if ( window.self.location.toString ().match(/Play_a_Competence41b/) )
	{
		 processCompWithCible( "Golemologie", "COMPETENCE" );					
	}			
	
	// Grattage
	if ( window.self.location.toString ().match(/Play_a_Competence26b/) )
	{
		processCompWithoutCible ("Grattage");			
	}	
	
	// Hurlement Effrayant
	if ( window.self.location.toString ().match(/Play_a_Competence17b/) )
	{
		 processCompWithCible( "Hurlement Effrayant", "COMPETENCE" );					
	}		
	
	// IdC
	if ( window.self.location.toString ().match(/Play_a_Competence5b/) )
	{
		processCompWithoutCible ("IdC");			
	}			
	
	// Insulte
	if ( window.self.location.toString ().match(/Play_a_Competence18b/) )
	{
		processCompWithCible( "Insulte", "COMPETENCE" );			
	}	
	
	// Lancer de Potions
	if ( window.self.location.toString ().match(/Play_a_Competence23b/) )
	{
		 processCompWithCible( "Lancer de Potions", "COMPETENCE" );					
	}	
	
	// Marquage
	if ( window.self.location.toString ().match(/Play_a_Competence37b/) )
	{
		 processCompWithCible( "Marquage", "COMPETENCE" );					
	}			
	
	// Mélange Magique
	if ( window.self.location.toString ().match(/Play_a_Competence25b/) )
	{
		processCompWithoutCible ("Mélange Magique");			
	}						
	
	// Miner
	if ( window.self.location.toString ().match(/Play_a_Competence29b/) )
	{
		processCompWithoutCible ("Miner");			
	}	
	
	// Nécromancie
	if ( window.self.location.toString ().match(/Play_a_Competence33b/) )
	{
		 processCompWithCible( "Nécromancie", "COMPETENCE" );					
	}		
	
	// Parer
	if ( window.self.location.toString ().match(/Play_a_Competence10b/) )
	{
		processCompWithoutCible ("Parer");			
	}	
	
	// Pistage
	if ( window.self.location.toString ().match(/Play_a_Competence21b/) )
	{
		processCompWithoutCible ("Pistage");					
	}	
	
	// Planter un Champignon
	if ( window.self.location.toString ().match(/Play_a_Competence35b/) )
	{
		processCompWithoutCible ("Planter Champignon");			
	}
	
	// RA
	if ( window.self.location.toString ().match(/Play_a_Competence2b/) )
	{
		processCompWithoutCible ("RA");			
	}

	// Réparation
	if ( window.self.location.toString ().match(/Play_a_Competence40b/) )
	{
		processCompWithoutCible ("Réparation");			
	}

	// Retraite
	if ( window.self.location.toString ().match(/Play_a_Competence38b/) )
	{
		processCompWithoutCible ("Retraite");			
	}
	
	// Shamaner
	if ( window.self.location.toString ().match(/Play_a_Competence28b/) )
	{
		 processCompWithCible( "Shamaner", "COMPETENCE" );					
	}			
	
	// Tailler
	if ( window.self.location.toString ().match(/Play_a_Competence30b/) )
	{
		processCompWithoutCible ("Tailler");			
	}	

}

// Compétence sur le troll lui même
function processCompWithoutCible (name)
{
	
	var type = "COMPETENCE";
	
	if ( name == "DE" )
		type = "DEPLACEMENT";
	
	addToBdd( type, name, competence, date, getCookie ('NUM_TROLL') );
	
}

// Compétence sur une cible
function processCompWithCible ( name, type )
{

	var idCible = "";
	
	if (name == "Insulte" && getCookie("idCibleInsulte") != "") {
		idCible = getCookie("idCibleInsulte");
		setCookie ( "idCibleInsulte", '', '', '/' );
	} else 
		idCible = getIdCible(competence) ;
		
	if ( competence.match(/TUÉ/g) )
		type = "MORT";	
	
	addToBdd( type, name, competence, date, idCible )

}

// Ajoute le bouton de CdM pour le bestiaire
function processCdM ()
{
	var form = currentDocument.getElementsByName ( 'ActionForm' )[0];
	var cdmHTML = form.childNodes[3]; // cdm
	var cdm = flattenNode (cdmHTML);
	
	var myForm= document.createElement ( 'form' );
	myForm.setAttribute ( 'method', 'post' );
	myForm.setAttribute ( 'action', URLMessageProcessCompCdM );
	myForm.setAttribute ( 'name', 'processCdM' );
	myForm.setAttribute ( 'target', '_blank' );
	var myInput = document.createElement ( 'input' );
	myInput.setAttribute ( 'type','hidden' );
	myInput.setAttribute ( 'name','copiercoller' );
	myInput.setAttribute ( 'wrap','off' );
	myInput.setAttribute ( 'value', cdm );
	myForm.appendChild(myInput);
	myInput = document.createElement ( 'input' );
	myInput.setAttribute ( 'name', 'soumettre' );
	myInput.setAttribute ( 'type', 'submit' );
	myInput.setAttribute ( 'value', "Renseigner le bestiaire" );
	myInput.setAttribute( 'class', 'mh_form_submit' );
	myForm.appendChild(myInput);
	
	var documentCdm = window.self.document;
	var espace = documentCdm.createTextNode ( '\t' );
	documentCdm.getElementsByName ( 'as_Action' )[0].parentNode.insertBefore ( espace, documentCdm.getElementsByName ( 'as_Action' )[0] );
	documentCdm.getElementsByName ( 'as_Action' )[0].parentNode.insertBefore ( myForm, espace);
	
	var tableauCdm = cdmHTML.childNodes[1].firstChild;
	var bless_line = tableauCdm.childNodes[2].childNodes[1].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].firstChild.nodeValue; // "95 %"
	var b = parseInt( bless_line.substring(0,bless_line.indexOf(' %')) );
	if ( b != 0 ) 
	{ 
		var pv_line = tableauCdm.childNodes[1].childNodes[1].childNodes[0].firstChild.nodeValue;
		if ( pv_line.indexOf ( 'entre' ) != -1 )
		{ 
			var pv1 = parseInt ( pv_line.substring ( pv_line.indexOf ( '(entre ' ) + 7, pv_line.indexOf ( ' et' ) ) );
			var pv2 = parseInt ( pv_line.substring ( pv_line.indexOf ( 'et ' ) + 3, pv_line.indexOf ( ')' ) ) );
			var pva1 = Math.floor ( pv1 * ( 95 - b ) / 100 ) + 1;
			var pva2 = Math.floor ( pv2 * ( 105 - b ) / 100 );
			var vieTd = document.createElement( 'td' );
			vieTd.appendChild ( document.createTextNode ( 'Points de Vie restants (Approximatif) :' ) );
			vieTd.setAttribute ( 'style', 'font-weight:bold;' );
			vieRestTd = document.createElement ( 'td' );
			vieRestTd.appendChild ( document.createTextNode ( "Entre " + pva1 + " et " + pva2 ) );
			vieRestTd.setAttribute ( 'style', 'font-weight:bold;' );
			vieRestTr = document.createElement ( 'tr' );
			vieRestTr.appendChild ( vieTd );
			vieRestTr.appendChild ( vieRestTd );
			tableauCdm.insertBefore ( vieRestTr,  tableauCdm.childNodes[3]);         
		}
	}
	
	var competence = flattenNode (form);		
	var date = getDate();
	var idCible = getIdCible(competence);
	
	addToBdd( 'COMPETENCE', 'CdM', formatString(competence), date, idCible );
  
}

// Ajoute l'action à la bdd
function addToBdd( type, name, attaque, date, idCible )
{

	newScript = document.createElement ( 'script' );
	newScript.setAttribute ( 'language', 'JavaScript' );
	newScript.setAttribute ( 'src',  URLMessageProcessGGC+'?type='+type+'&nom='+name+'&date='+date+'&idCible='+idCible+'&idLanceur='+getCookie ('NUM_TROLL')+stripcopiercoller( attaque ) );
	document.body.appendChild ( newScript );
	
}

// Récupère l'id de la cible lors d'une insulte
function catchInsulte()
{

	var button = currentDocument.getElementsByName('ActionForm')[0];	
	button.addEventListener("click", function() {setCookie ( "idCibleInsulte", currentDocument.getElementsByName('ai_IDTarget')[0].value.toString().match(/\d+/), '', '/' );}, true);
	
}

// Récupère l'id de la cible
function getIdCible(text)
{
	var idCible = text.match(/\(\d+\)/g);	
	if ( !idCible )
		idCible = text.match(/N°\d+/);	
	return idCible.toString().match(/\d+/);	
}

// retourne la date
function getDate()
{
	return $('html>body>table>tbody>tr:eq(1)>td>table>tbody>tr>td:eq(1)>p>table>tbody>tr>td').text().match(/\[Heure Serveur :\s+\d{2}\/\d{2}\/\d{4} \d{2}:\d{2}:\d{2} GMT\+0100\s+\]/).toString().match(/\d{2}\/\d{2}\/\d{4} \d{2}:\d{2}:\d{2}/).toString();
}

// Supprime les tags html et ajoute des sauts de ligne
function strip_tags(element){

	return element.html().replace(/<\/div>|<\/tr>|<p>|<\/p>|<\/li>|<\/form>|<\/div>|<\b>|<br>/gi,'\n').replace(/<\/?[^>]+>/gi, '');

}

// Convertit le code html en code sans balise avec indentation
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

// Coupe la chaine en plusieurs morceau
function stripcopiercoller( string )
{
	retour = '&copiercoller[]=';
	if ( string.length > 50 )
		return retour+string.substr(0,50)+stripcopiercoller( string.substr(50) );
	return retour+string;	
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