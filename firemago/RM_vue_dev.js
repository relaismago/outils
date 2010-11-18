var totaltab = document.getElementsByTagName ( 'table' );
var x_monstres = totaltab[4].childNodes[0].childNodes;
var x_trolls = totaltab[6].childNodes[0].childNodes;
var x_tresors = totaltab[8].childNodes[0].childNodes;
var x_champignons = totaltab[10].childNodes[0].childNodes;
var x_lieux = totaltab[12].childNodes[0].childNodes;

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
		( (expires) ? "; expires=" + expires.toGMTString () : "; expires="+expdate.toGMTString() ) +
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

function cookifyTxtBox ( txtBox )
{
	setCookie ( "idTroll", txtBox.value );
	return txtBox.value;
}


// ******************************************************************
// Filter functions
// ******************************************************************

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
	return node.childNodes[2].childNodes[0].firstChild.nodeValue.toLowerCase ().indexOf ( eltName ) != -1;
}

function checkMonsterName ( node, eltName )
{
	return node.childNodes[2].childNodes[0].firstChild.nodeValue.toLowerCase ().indexOf ( eltName ) != -1;
}

function checkTrollName ( node, eltName )
{
	return node.childNodes[2].childNodes[1].firstChild.nodeValue.toLowerCase ().indexOf ( eltName ) != -1;
}

function checkTrollClass ( node, eltName )
{
	return node.childNodes[2].childNodes[1].className == eltName;
}

function toggleGG ()
{
	var on = cookifyButton ( document.getElementsByName ( 'delgg' )[0] );
	toggleListElements ( x_tresors, checkTreasureName, "Gigots de Gob", on );
}

function toggleComp ()
{
	var on = cookifyButton ( document.getElementsByName ( 'delcomp' )[0] );
	toggleListElements ( x_tresors, checkTreasureName, "Composant", on );
}

function toggleGowap ()
{
	var on = cookifyButton ( document.getElementsByName ( 'delgowap' )[0] );
	toggleListElements ( x_monstres, checkMonsterName, "Gowap", on );
}

function toggleIntangible ()
{
	var on = cookifyButton ( document.getElementsByName ( 'delint' )[0] );
	toggleListElements ( x_trolls, checkTrollClass, "mh_trolls_0", on );
}

function toggleBidouille ()
{
	var on = cookifyButton ( document.getElementsByName ( 'delbid' )[0] );
//   filterListElements ( x_tresors, checkBidouille, bouton.checked);
   

   for (var i=2;i<x_tresors.length;i++)
   {
      if(x_tresors[i].className == 'mh_tdpage' && x_tresors[i].childNodes.length==6 && x_tresors[i].childNodes[2].childNodes[0].nodeName == "B")
      {
        if((x_tresors[i].childNodes[2].childNodes[0].firstChild.nodeName == "A")||(x_tresors[i].childNodes[2].childNodes[0].childNodes.length >1 && x_tresors[i].childNodes[2].childNodes[0].childNodes[1].nodeName == "A")) 
	 {
	    if(!on)
	       x_tresors[i].style.display='';
	    else
	       x_tresors[i].style.display='none';
         }
      }						       
   }
}

function filterMonsters ()
{
	document.getElementsByName('delgowap')[0].checked=false;
	cookifyButton ( document.getElementsByName('delgowap')[0] );
	if ( document.getElementsByName ( "filterMonsters" )[0].value != '' )
	{
		var nom = document.getElementsByName ( "filterMonsters" )[0].value.toLowerCase ();
		x_monstres[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].nodeValue = "MONSTRES (filtrés sur " + nom + ")";
		filterListElements ( x_monstres, checkMonsterName, nom );
	}
	else
	{
		x_monstres[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].nodeValue="MONSTRES";
		filterListElements ( x_monstres, checkAlwaysTrue, '' );
	}
}

function filterTrolls ()
{
	document.getElementsByName('delint')[0].checked = false;
	cookifyButton ( document.getElementsByName('delint')[0] );
	if ( document.getElementsByName ( "filterTrolls" )[0].value != '' )
	{
		var nom = document.getElementsByName ( "filterTrolls" )[0].value.toLowerCase ();
		x_trolls[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].nodeValue = "TROLLS (filtrés sur " + nom + ")";
		filterListElements ( x_trolls, checkTrollName, nom );
	}
	else
	{
		x_trolls[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].nodeValue="TROLLS";
		filterListElements ( x_trolls, checkAlwaysTrue, '' );
	}
}

function filterTreasures ()
{
	document.getElementsByName('delgg')[0].checked = false;
	cookifyButton ( document.getElementsByName('delgg')[0] );
	document.getElementsByName('delcomp')[0].checked = false;
	cookifyButton ( document.getElementsByName('delcomp')[0] );
	document.getElementsByName('delbid')[0].checked = false;
	cookifyButton ( document.getElementsByName('delbid')[0] );
	if ( document.getElementsByName ( "filterTreasures" )[0].value != '' )
	{
		var nom = document.getElementsByName ( "filterTreasures" )[0].value.toLowerCase ();
		x_tresors[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].nodeValue = "TRESORS (filtrés sur " + nom + ")";
		filterListElements ( x_tresors, checkTreasureName, nom );
	}
	else
	{
		x_tresors[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].nodeValue="TRESORS";
		filterListElements ( x_tresors, checkAlwaysTrue, '' );
	}
}


// ********************************************************
// Adding 2Dview's button
// ********************************************************

//Build the copy/past
function getVueScript() {

	var maChaine = "MA VUE\n";
	var arrtable;
	var tr;
	
	arrtable=totaltab[3];
	var pos=arrtable.getElementsByTagName('li')[0].innerHTML;
	posx=pos.substring(pos.indexOf('=')+2,pos.indexOf(','));
	pos=pos.substr(pos.indexOf(',')+1);
	posy=pos.substring(pos.indexOf('=')+2,pos.indexOf(','));
	posn=pos.substring(pos.lastIndexOf('=')+2,pos.lastIndexOf('</b>'));
	maChaine += "\t* Ma Position Actuelle est : X = "+posx+", Y = "+posy+ ", N = " + posn+"\n";
	pos=arrtable.getElementsByTagName('li')[2].innerHTML;
	var vue=pos.substring(pos.indexOf('à<b>')+5,pos.indexOf('cases')-1);
	maChaine += "\t* Ma Vue porte actuellement à " + vue +" cases\n";
	
	maChaine += "MONSTRES ERRANTS\n";
	for(i=2;i<x_monstres.length;i++)
	{
		tr = x_monstres[i];
		maChaine += tr.childNodes[0].childNodes[0].nodeValue+"\t";
		maChaine += tr.childNodes[1].childNodes[0].nodeValue+"\t";
		maChaine += tr.childNodes[2].childNodes[0].childNodes[0].nodeValue+"\t";
		maChaine += tr.childNodes[3].childNodes[0].nodeValue+"\t";
		maChaine += tr.childNodes[4].childNodes[0].nodeValue+"\t";
		maChaine += tr.childNodes[5].childNodes[0].nodeValue+"\n";
	}
	
	maChaine+="TROLLS\n";
	for(i=2;i<x_trolls.length;i++)
	{
		tr = x_trolls[i];
		maChaine += tr.childNodes[0].childNodes[0].nodeValue+"\t";
		maChaine += tr.childNodes[1].childNodes[0].nodeValue+"\t";
		maChaine += tr.childNodes[2].childNodes[1].childNodes[0].nodeValue;
		//malade
		if(tr.childNodes[2].childNodes.length>2)
		{
			maChaine +=" [M]";
		}
		maChaine +="\t";
		maChaine += tr.childNodes[3].childNodes[0].nodeValue+"\t";
		maChaine += tr.childNodes[4].childNodes[0].nodeValue+"\t";
		//guilde
		if (tr.childNodes[5].childNodes[0].childNodes[0])
			maChaine += tr.childNodes[5].childNodes[0].childNodes[0].nodeValue+"\t";
		else
			maChaine += "\t";
		maChaine += tr.childNodes[6].childNodes[0].nodeValue+"\t";
		maChaine += tr.childNodes[7].childNodes[0].nodeValue+"\t";
		maChaine += tr.childNodes[8].childNodes[0].nodeValue+"\n";
	}
	
	maChaine += "TRESORS\n";
	for(i=2;i<x_tresors.length;i++)
	{
		tr = x_tresors[i];
		maChaine += tr.childNodes[0].childNodes[0].nodeValue+"\t";
		maChaine += tr.childNodes[1].childNodes[0].nodeValue+"\t";
		if (tr.childNodes[2].childNodes[0].childNodes[0].nodeValue!=" ")
			maChaine += tr.childNodes[2].childNodes[0].childNodes[0].nodeValue+"\t";
		else
			maChaine += tr.childNodes[2].childNodes[0].childNodes[1].childNodes[0].nodeValue+"\t";
		maChaine += tr.childNodes[3].childNodes[0].nodeValue+"\t";
		maChaine += tr.childNodes[4].childNodes[0].nodeValue+"\t";
		maChaine += tr.childNodes[5].childNodes[0].nodeValue+"\n";
	}
	
	maChaine += "CHAMPIGNONS\n";
	for(var i=2;i<x_champignons.length;i++)
	{
		tr = x_champignons[i];
		maChaine += tr.childNodes[0].childNodes[0].nodeValue+"\t";
		maChaine += tr.childNodes[1].childNodes[0].nodeValue+"\t";
		maChaine += tr.childNodes[2].childNodes[0].nodeValue+"\t";
		maChaine += tr.childNodes[3].childNodes[0].nodeValue+"\t";
		maChaine += tr.childNodes[4].childNodes[0].nodeValue+"\t";
		maChaine += tr.childNodes[5].childNodes[0].nodeValue+"\n";
	}
	
	maChaine += "LIEUX PARTICULIERS\n";
	for(i=2;i<x_lieux.length;i++)
	{
		tr = x_lieux[i];
		maChaine += tr.childNodes[0].childNodes[0].nodeValue+"\t";
		maChaine += tr.childNodes[1].childNodes[0].nodeValue+"\t";
		if (tr.childNodes[2].childNodes[0].nodeValue==" ")
			maChaine += tr.childNodes[2].childNodes[1].childNodes[0].childNodes[0].nodeValue+"\t";
		else
			maChaine += tr.childNodes[2].childNodes[0].nodeValue+"\t";
		maChaine += tr.childNodes[3].childNodes[0].nodeValue+"\t";
		maChaine += tr.childNodes[4].childNodes[0].nodeValue+"\t";
		maChaine += tr.childNodes[5].childNodes[0].nodeValue+"\n";
	}
	maChaine += "[Contact : dm@mountyhall.com] - [Heure Serveur\n";
	return maChaine;
}

//check the form send by the button
function checkViewForm(form)
{
	var idTroll = form.TROLL.value
	if (isNaN(idTroll))
	{
		alert("Il faut mettre le numéro du troll à qui appartient\ncette vue dans la petite case pour que ça marche !");
		form.TROLL.focus();
		return false;
	}
	else
	{
		form.action=URLVue2D;
		window.open('', 'popupVue', 'width=" + (screen.width-150) + ", height=" + (screen.height-250) + ", toolbar=no, status=no, location=no, resizable=yes, scrollbars=yes');
		form.target='popupVue';
		cookifyTxtBox (form.TROLL);
		form.submit();
		return true;
	}	
}


function getAllText(Element)
{
   if(Element.nodeName == "#text")
   {
      var thisText=Element.nodeValue.replace(/[\t\n\r]/gi,' ');
      thisText=thisText.replace(/[ ]+/gi,' ');
      if(thisText==" ")
         return '';
      return thisText;
   }
   if(Element.nodeName.toLowerCase() == "script" || Element.nodeName.toLowerCase() == "noframes")
      return "";
   var string=''
   if(Element.nodeName.toLowerCase() == "tbody" || Element.nodeName.toLowerCase() == "center" || Element.nodeName.toLowerCase() == "br" || Element.nodeName.toLowerCase() == "p")
      string='\n';
   if(Element.nodeName.toLowerCase() == "li")
      string='';
   for(var i=0;i<Element.childNodes.length;i++)
   {
     //string+=' '+Element.nodeName+' : ';
     string+=getAllText(Element.childNodes[i]);
     if(Element.nodeName.toLowerCase() == "tbody" && i<Element.childNodes.length-1)
        string+='\n';
     else if(Element.nodeName.toLowerCase() =='tr' && i<Element.childNodes.length-1)
        string+=' ';
   }
   if(Element.nodeName.toLowerCase() == "center" || Element.nodeName.toLowerCase() == "li")
      string+='\n';
   return string;
}

//Build the form with the button
var myForm = document.createElement('form');
myForm.setAttribute('method', 'post');
myForm.setAttribute('accept-charset', 'iso-8859-1, iso-8859-15');
myForm.setAttribute('name', 'select_troll');
myForm.setAttribute('onsubmit','return checkViewForm(this)');
myForm.setAttribute('id', 'vue2DForm');
		
var myTA = document.createElement('input');
myTA.setAttribute('type', 'hidden');
myTA.setAttribute('name', 'datas');
myTA.setAttribute('wrap', 'off');
myTA.setAttribute('id', 'vueField');
myTA.setAttribute('value', getAllText(document));
myForm.appendChild(myTA);

var myB = document.createElement('b');
myTA=document.createTextNode('N° du troll : ');
myB.appendChild(myTA);
myForm.appendChild(myB);

var myTA = document.createElement('input');
myTA.setAttribute('type', 'text');
myTA.setAttribute('name', 'TROLL');
myTA.setAttribute('id', 'txtTROLL');
myTA.setAttribute('size', '5');
myTA.setAttribute('maxlength', '5');myTA.setAttribute('value', getCookie ( "idTroll" ));
myForm.appendChild(myTA);

myTA = document.createElement('input');
myTA.setAttribute('type', 'submit');
myTA.setAttribute('class', 'mh_form_submit');
myTA.setAttribute('value', "La Vue 2D R&M");
myTA.setAttribute('name', "Submit");
myTA.setAttribute('onmouseover', "this.style.cursor='pointer'");
myForm.appendChild(myTA);

var arr = document.getElementsByTagName('a');
arr[7].parentNode.appendChild(document.createElement('br'));
arr[7].parentNode.appendChild(myForm);


// ********************************************************
// Adding login IFRAME
// ********************************************************

var myTable = document.createElement ( 'table' );
myTable.setAttribute ( 'width', '98%' );
myTable.setAttribute ( 'border', '0' );
myTable.setAttribute ( 'align', 'center' );
myTable.setAttribute ( 'cellpadding', '4' );
myTable.setAttribute ( 'cellspacing', '1' );
myTable.setAttribute ( 'class', 'mh_tdborder' );

var myTr = document.createElement ( 'tr' );
myTr.setAttribute ( 'class','mh_tdtitre' );
myTable.appendChild( myTr );

var myTd = document.createElement ( 'td' );
myTr.appendChild ( myTd );

var myIFrame = document.createElement ( 'iframe' );
myIFrame.setAttribute ( 'src', URLLoginRM );
myIFrame.setAttribute ( 'width', '100%' );
myIFrame.setAttribute ( 'height', '50' );
myIFrame.setAttribute ( 'frameborder', '0' );
myIFrame.setAttribute ( 'scrolling', 'no' );
myTd.appendChild ( myIFrame );

var newline = document.createElement ( 'p' );
insertPoint = totaltab[4];
insertPoint.parentNode.insertBefore ( newline, insertPoint );
insertPoint.parentNode.insertBefore ( myTable, newline );
		
		
// ********************************************************
// Adding filter inputs
// ********************************************************

var btn;
var tableTitle;

// Add monsters filter buttons
tableTitle = x_monstres[0].childNodes[0];
tableTitle.appendChild ( document.createTextNode (" [ Effaçer : ") );
btn = document.createElement ( 'INPUT' );
btn.setAttribute ( 'NAME', 'delgowap' );
btn.setAttribute ( 'TYPE', 'checkbox' );
btn.setAttribute ( 'onClick', 'toggleGowap()' );
tableTitle.appendChild ( btn );
tableTitle.appendChild ( document.createTextNode ( 'Gowaps' ) );
tableTitle.appendChild ( document.createTextNode (" ] [ Filtrer sur ") );
btn = document.createElement('INPUT');
btn.setAttribute('NAME','filterMonsters');
btn.setAttribute('TYPE','text');
btn.setAttribute('class','TextboxV2');
btn.setAttribute('VALUE','');
btn.setAttribute('size','12');
btn.setAttribute('MAXLENGTH','20');
tableTitle.appendChild ( btn );
btn = document.createElement('INPUT');
btn.setAttribute('TYPE','button');
btn.setAttribute('VALUE','Filtrer');
btn.setAttribute('onClick','filterMonsters()');
btn.setAttribute('class','mh_form_submit');
tableTitle.appendChild ( btn );
tableTitle.appendChild ( document.createTextNode (" ] ") );

// Add trolls filter buttons
tableTitle = x_trolls[0].childNodes[0];
tableTitle.appendChild ( document.createTextNode (" [ Effaçer : ") );
btn = document.createElement ( 'INPUT' );
btn.setAttribute ( 'NAME', 'delint' );
btn.setAttribute ( 'TYPE', 'checkbox' );
btn.setAttribute ( 'onClick', 'toggleIntangible()' );
tableTitle.appendChild ( btn );
tableTitle.appendChild ( document.createTextNode ( 'Intangibles' ) );
tableTitle.appendChild ( document.createTextNode (" ] [ Filtrer sur ") );
btn = document.createElement('INPUT');
btn.setAttribute('NAME','filterTrolls');
btn.setAttribute('TYPE','text');
btn.setAttribute('class','TextboxV2');
btn.setAttribute('VALUE','');
btn.setAttribute('size','12');
btn.setAttribute('MAXLENGTH','20');
tableTitle.appendChild ( btn );
btn = document.createElement('INPUT');
btn.setAttribute('TYPE','button');
btn.setAttribute('VALUE','Filtrer');
btn.setAttribute('onClick','filterTrolls()');
btn.setAttribute('class','mh_form_submit');
tableTitle.appendChild ( btn );
tableTitle.appendChild ( document.createTextNode (" ] ") );

// Add treasures filter buttons
tableTitle = x_tresors[0].childNodes[0];
tableTitle.appendChild ( document.createTextNode (" [ Effaçer : ") );
btn = document.createElement ( 'INPUT' );
btn.setAttribute ( 'NAME', 'delgg' );
btn.setAttribute ( 'TYPE', 'checkbox' );
btn.setAttribute ( 'onClick', 'toggleGG()' );
tableTitle.appendChild ( btn );
tableTitle.appendChild ( document.createTextNode ( 'GGs' ) );
btn = document.createElement ( 'INPUT' );
btn.setAttribute ( 'NAME', 'delcomp' );
btn.setAttribute ( 'TYPE', 'checkbox' );
btn.setAttribute ( 'onClick', 'toggleComp()' );
tableTitle.appendChild ( btn );
tableTitle.appendChild ( document.createTextNode ( 'Composants' ) );
btn = document.createElement ( 'INPUT' );
btn.setAttribute ( 'NAME', 'delbid' );
btn.setAttribute ( 'TYPE', 'checkbox' );
btn.setAttribute ( 'onClick', 'toggleBidouille()' );
tableTitle.appendChild ( btn );
tableTitle.appendChild ( document.createTextNode ( 'Bidouilles' ) );
tableTitle.appendChild ( document.createTextNode (" ] [ Filtrer sur ") );
btn = document.createElement('INPUT');
btn.setAttribute('NAME','filterTreasures');
btn.setAttribute('TYPE','text');
btn.setAttribute('class','TextboxV2');
btn.setAttribute('VALUE','');
btn.setAttribute('size','12');
btn.setAttribute('MAXLENGTH','20');
tableTitle.appendChild ( btn );
btn = document.createElement('INPUT');
btn.setAttribute('TYPE','button');
btn.setAttribute('VALUE','Filtrer');
btn.setAttribute('onClick','filterTreasures()');
btn.setAttribute('class','mh_form_submit');
tableTitle.appendChild ( btn );
tableTitle.appendChild ( document.createTextNode (" ] ") );

if ( uncookifyButton ( document.getElementsByName ( 'delgg' )[0] ) ) 		{ toggleGG (); }
if ( uncookifyButton ( document.getElementsByName ( 'delcomp' )[0] ) ) 	{ toggleComp (); }
if ( uncookifyButton ( document.getElementsByName ( 'delbid' )[0] ) ) 		{ toggleBidouille (); }
if ( uncookifyButton ( document.getElementsByName ( 'delint' )[0] ) ) 		{ toggleIntangible (); }
if ( uncookifyButton ( document.getElementsByName ( 'delgowap' )[0] ) ) 	{ toggleGowap (); }

// ********************************************************
// Monster compendium links
// ********************************************************

for ( var i = 2; i < x_monstres.length; i++ )
{
	// grab style used for monster
	var monsterStyle = new String ( x_monstres[i].childNodes[2].childNodes[0].getAttribute ( 'class' ) );
	
	// grab monster ID text
	var newLinkText = document.createTextNode ( x_monstres[i].childNodes[1].firstChild.nodeValue );
	// create replacement link
	var newLink = document.createElement ( 'a' );
	newLink.appendChild ( newLinkText );
	newLink.setAttribute ( 'class', monsterStyle );
	newLink.setAttribute ( 'href', 'javascript:EMV(' + x_monstres[i].childNodes[1].firstChild.nodeValue + ',750,550)' );
	x_monstres[i].childNodes[1].removeChild ( x_monstres[i].childNodes[1].firstChild );
	x_monstres[i].childNodes[1].appendChild ( newLink );
	
	// grab monster name text
	var monsterDesc = new String ( x_monstres[i].childNodes[2].childNodes[0].firstChild.nodeValue );
	var monsterName = monsterDesc.substring ( 0, monsterDesc.indexOf ( '[' ) - 1 );
	var monsterAge = monsterDesc.substring ( monsterDesc.indexOf ( '[' ) + 1, monsterDesc.indexOf ( ']' ) );
	// create replacement link
	var newLink = document.createElement ( 'a' );
	newLink.appendChild ( document.createTextNode ( monsterDesc ) );
	newLink.setAttribute ( 'class', monsterStyle );
	newLink.setAttribute ( 'href', URLBestiaire + monsterName.replace ( /'/, " " ) + '&Age=' + monsterAge.replace ( /'/, " " ) );
	newLink.setAttribute ( 'target', '\"_blank\"' );
	x_monstres[i].childNodes[2].removeChild ( x_monstres[i].childNodes[2].firstChild );
	x_monstres[i].childNodes[2].appendChild ( newLink );
}


// ********************************************************
// Troll and guild compendium links
// ********************************************************

// WARNING ! troll name <A> has a whitespace before it, thus  
//      var trollName = new String ( x_trolls[i].childNodes[2].childNodes[1].firstChild.nodeValue );
// and not
//      var trollName = new String ( x_trolls[i].childNodes[2].childNodes[0].firstChild.nodeValue );

for ( var i = 2; i < x_trolls.length; i++ )
{
	// grab styles used for troll and guild
	var trollStyle = new String ( x_trolls[i].childNodes[2].childNodes[1].getAttribute ( 'class' ) );
	var guildStyle = new String ( x_trolls[i].childNodes[5].childNodes[0].getAttribute ( 'class' ) );
	
	// grab troll ID
	var trollID = new String ( x_trolls[i].childNodes[1].firstChild.nodeValue );
	var newLinkText = document.createTextNode ( trollID );
	// create link 'troll id' -> MH troll popup
	var newLink = document.createElement ( 'a' );
	newLink.appendChild ( newLinkText );
	newLink.setAttribute ( 'class', trollStyle );
	newLink.setAttribute ( 'href', 'javascript:EPV(' + x_trolls[i].childNodes[1].firstChild.nodeValue + ')' );
	x_trolls[i].childNodes[1].removeChild ( x_trolls[i].childNodes[1].firstChild );
	x_trolls[i].childNodes[1].appendChild ( newLink );
	
	// grab troll name
	var trollName = new String ( x_trolls[i].childNodes[2].childNodes[1].firstChild.nodeValue );
	// create link 'troll name' -> RM troll file
	var newLink = document.createElement ( 'a' );
	newLink.appendChild ( document.createTextNode ( trollName ) );
	newLink.setAttribute ( 'class', trollStyle );
	newLink.setAttribute ( 'href', URLRGTroll + trollID );
	newLink.setAttribute ( 'target', '\"_blank\"' );
	x_trolls[i].childNodes[2].removeChild ( x_trolls[i].childNodes[2].childNodes[1] );
	x_trolls[i].childNodes[2].appendChild ( newLink );
	
	var guildTD = x_trolls[i].childNodes[5];
	// grab guild text
	var guildJS = new String ( guildTD.childNodes[0].getAttribute ( 'href' ) );
	var guildID = guildJS.substring ( 15, guildJS.indexOf ( ',' ) );
	
	var newLink = document.createElement ( 'a' );
	newLink.appendChild ( document.createTextNode ( 'RG' ) );
	newLink.setAttribute ( 'class', guildStyle );
	newLink.setAttribute ( 'href', URLRGGuilde + guildID );
	newLink.setAttribute ( 'target', '\"_blank\"' );
	if ( guildID != '1' )
	{
		x_trolls[i].childNodes[5].insertBefore ( document.createTextNode ( '] - ' ), guildTD.childNodes[0] );
		x_trolls[i].childNodes[5].insertBefore ( newLink, guildTD.childNodes[0] );
		x_trolls[i].childNodes[5].insertBefore ( document.createTextNode ( '[' ), guildTD.childNodes[0] );
	}
	
}


var xy = document.getElementsByTagName('A');

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

// ********************************************************
// insertion d'un nouveau script
// ********************************************************

if(getCookie("MOVE")=="oui")
{
	newScript1 = document.createElement('script');
	newScript1.setAttribute('language',"JavaScript");
	newScript1.setAttribute('src','http://resel.enst-bretagne.fr/club/mountyhall/script/move.js');
	(xy[xy.length-1].parentNode).appendChild(newScript1);
}

// ********************************************************
// Bottom links
// ********************************************************
/*
var listA=document.getElementsByTagName('A');
listA[listA.length-1].parentNode.appendChild(document.createElement('br'));
listA[listA.length-1].parentNode.appendChild(document.createTextNode("[Script développé par "));
var newL=document.createElement('A');
newL.setAttribute('href','mailto:mini.tilk@gmail.com');
newL.setAttribute('class','PJLinks1');
newL.appendChild(document.createTextNode("Mini TilK"));
listA[listA.length-1].parentNode.appendChild(newL);
listA[listA.length-1].parentNode.appendChild(document.createTextNode("] - [Bestaire fourni par "));
newL=document.createElement('A');
newL.setAttribute('href','http://resel.enst-bretagne.fr/club/mountyhall');
newL.setAttribute('target','_blank');
newL.setAttribute('class','PJLinks1');
newL.appendChild(document.createTextNode("Les Teubreux"));
listA[listA.length-1].parentNode.appendChild(newL);
listA[listA.length-1].parentNode.appendChild(document.createTextNode("]"));
*/
