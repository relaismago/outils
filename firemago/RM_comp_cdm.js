var currentDocument = window.self.document;
if ( !currentDocument || !( "body" in currentDocument ) ) 
{
//	return false;
}

var cdmForm = currentDocument.getElementsByName ( 'ActionForm' )[0];

if ( cdmForm.innerHTML.indexOf ( 'RÉUSSI' ) != -1 ) 
{ 
	// La connaissance des monstres a résussi
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
	cdm += "Dés d'Attaque : " 		+ cdmHTMLTable.childNodes[3].childNodes[1].childNodes[0].firstChild.nodeValue + "\n";
	cdm += "Dés d'Esquive : " 		+ cdmHTMLTable.childNodes[4].childNodes[1].childNodes[0].firstChild.nodeValue + "\n";
	cdm += "Dés de Dégat : " 		+ cdmHTMLTable.childNodes[5].childNodes[1].childNodes[0].firstChild.nodeValue + "\n";
	cdm += "Dés de Régénération : " 	+ cdmHTMLTable.childNodes[6].childNodes[1].childNodes[0].firstChild.nodeValue + "\n";
	cdm += "Armure : " 				+ cdmHTMLTable.childNodes[7].childNodes[1].childNodes[0].firstChild.nodeValue + "\n";
	cdm += "Vue : " 				+ cdmHTMLTable.childNodes[8].childNodes[1].childNodes[0].firstChild.nodeValue + "\n";

	if ( cdmHTMLTable.childNodes[9] ) {
		// If monster has a special ability
		cdm += "Capacité spéciale : " + cdmHTMLTable.childNodes[9].childNodes[1].childNodes[0].firstChild.nodeValue + "\n";
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

	/*pour mettre les blessures exactes*/
	var cdm = cdmForm.childNodes[3];
	var tableauCdm = cdm.childNodes[1].firstChild;
  var bless_line = tableauCdm.childNodes[2].childNodes[1].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].firstChild.nodeValue; // "95 %"
  var b = parseInt( bless_line.substring(0,bless_line.indexOf(' %')) );
  if ( b != 0 ) 
  { //monstre blessé
  	var pv_line = tableauCdm.childNodes[1].childNodes[1].childNodes[0].firstChild.nodeValue; // "Remarquable (entre 90 et 110)"
    if ( pv_line.indexOf ( 'entre' ) != -1 )
    { //pas de ligne du type 'Points de Vie : Jamais vu (supérieur à XXX)'
    	var pv1 = parseInt ( pv_line.substring ( pv_line.indexOf ( '(entre ' ) + 7, pv_line.indexOf ( ' et' ) ) );
      var pv2 = parseInt ( pv_line.substring ( pv_line.indexOf ( 'et ' ) + 3, pv_line.indexOf ( ')' ) ) );
      var pva1 = Math.floor ( pv1 * ( 95 - b ) / 100 );
	    if ( b == 95 )
	    {
	    	pva1 = 1;
	    	b = 101;
	    }
      var pva2 = Math.floor ( pv2 * ( 105 - b ) / 100 ) -1;      
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
  /*pour mettre les blessures exactes*/
}
