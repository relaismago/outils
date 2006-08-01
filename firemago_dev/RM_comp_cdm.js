
var currentDocument = window.self.document;
if ( !currentDocument || !( "body" in currentDocument ) ) {
//	return false;
}

var cdmForm = currentDocument.getElementsByName ( 'ActionForm' )[0];

if ( cdmForm.innerHTML.indexOf ( 'R�USSI' ) != -1 ) { 
	// La connaissance des monstres a r�sussi
	processCdM ();
}

function processCdM ()
{
	
	var cdmHTML = cdmForm.childNodes[3]; // cdm
	var cdmHTMLTable = cdmHTML.childNodes[1].firstChild; // cdmtableau

	// Monster name
	var cdm = cdmHTML.firstChild.firstChild.nodeValue + "\n";

	cdm += "Niveau : " 				+ cdmHTMLTable.childNodes[0].childNodes[1].childNodes[0].firstChild.nodeValue + "\n";
	cdm += "Points de Vie : " 			+ cdmHTMLTable.childNodes[1].childNodes[1].childNodes[0].firstChild.nodeValue + "\n";
	cdm += "D�s d'Attaque : " 		+ cdmHTMLTable.childNodes[3].childNodes[1].childNodes[0].firstChild.nodeValue + "\n";
	cdm += "D�s d'Esquive : " 		+ cdmHTMLTable.childNodes[4].childNodes[1].childNodes[0].firstChild.nodeValue + "\n";
	cdm += "D�s de D�gat : " 		+ cdmHTMLTable.childNodes[5].childNodes[1].childNodes[0].firstChild.nodeValue + "\n";
	cdm += "D�s de R�g�n�ration : " 	+ cdmHTMLTable.childNodes[6].childNodes[1].childNodes[0].firstChild.nodeValue + "\n";
	cdm += "Armure : " 				+ cdmHTMLTable.childNodes[7].childNodes[1].childNodes[0].firstChild.nodeValue + "\n";
	cdm += "Vue : " 				+ cdmHTMLTable.childNodes[8].childNodes[1].childNodes[0].firstChild.nodeValue + "\n";

	if ( cdmHTMLTable.childNodes[9] ) {
		// If monster has a special ability
		cdm += "Capacit� sp�ciale : " + cdmHTMLTable.childNodes[9].childNodes[1].childNodes[0].firstChild.nodeValue + "\n";
	}

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
}
