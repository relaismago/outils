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

function getCookie ( name ) 
{
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

function setCookie ( name, value, expires, path, domain, secure ) 
{
	var expdate = new Date ();
	expdate.setTime ( expdate.getTime () + (24 * 60 * 60 * 1000 * 31 ) );
	var curCookie = name + "=" + escape ( value ) +
		( (expires) ? "; expires=" + expires.toGMTString () : "; expires=" + expdate.toGMTString () ) +
		( (path) ? "; path=" + path : path ) +
		( (domain) ? "; domain=" + domain : "" ) +
		( (secure) ? "; secure" : "" );
	document.cookie = curCookie;
}

function deleteCookie( name, path, domain ) 
{
  if (getCookie(name)) 
	{
     document.cookie = name + "=" +
     ((path) ? "; path=" + path : "") +
     ((domain) ? "; domain=" + domain : "") +
     "; expires=Thu, 01-Jan-70 00:00:01 GMT";
  }
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
// Clean Value
// ********************************************************

function trim ( string ) 
{
   	return string.replace ( /(^\s*)|(\s*$)/g, '' );
}

function str_woa( str ) {
        str = str.replace( /[éèêë]/g, 'e');
        str = str.replace( /[àâä]/g, 'a' );
        str = str.replace( /[ùûü]/g, 'u' );
        str = str.replace( /[ïî]/g, 'i' );
        str = str.replace( /[öô]/g, 'o' );

        return str;
}

function cleanValue ( val ) 
{
        val = val.slice ( val.indexOf( ':' ) + 1 );
        val = trim ( val );
        val = val.replace ( /[\n\r]/, '');
        val = val.replace ( /D6/, '');
        val = val.replace ( /D3/, '');
        val = val.replace ( /Cases/, '');
        val = val.replace ( /[ \)]/g, '');
        val = val.replace ( /[\+\(]/, ' ');
        val = val.replace ( /[\-]/g, ' -');

        return val;
}

function extractBonus ( val ) 
{
	var vals = val.split ( ' ' );
	
	if ( vals.length == 1 ) { vals[1] = 0; }
	for ( var i = 0; i < vals.length; i++ ) 
	{
		vals[i] = parseInt ( vals[i] );
	}
	return vals;
}

// Averages for fight part
function fightAverage ( anchor )
{
	if ( anchor.nodeValue.indexOf ( "D6" ) != -1 ) { fact = 3.5; } else { fact = 2; }
	value = extractBonus ( cleanValue ( anchor.nodeValue ) );
	De = value[0];
	Bonus = value[1];
	Average = fact * De + Bonus;
	try { anchor.nodeValue += " --> " + Average + " "; } catch ( e ) { error ( e, 'Average error' ); }
	return value;
}

// Total for magik
function totalMagik ( anchor )
{
	value = extractBonus ( cleanValue ( anchor.nodeValue ) );
	total = value[0] + value[1]
	try { anchor.nodeValue += " = " + total + ""; } catch ( e ) { error ( e, 'Total error' ); }
	return value;
}

// fight sorts which are resisted
function resiste(x)
{
  if(x>50)
     return x-0.25;
  var val1= Math.pow(3,x);
  var val2= Math.floor(val1/2)+(x % 2);
  val1=val2/(2*val1);
  val1=x-val1;
  val1 = Math.round(val1*100)/100;
  return val1;
}

function porte(param)
{
   return Math.ceil((Math.sqrt(19+8*(param+3))-7)/2);
}

// ********************************************************
// SORTS AND COMPETENCES
// ********************************************************

// competences
function competences(comp)
{
	var texte = '';
	var moyenne = '';
	var degmoy = deg[0] * 2 + deg[1];
	var attmoy = att[0] * 3.5 + att[1];
	if(comp.indexOf('Attaque Precise') != -1){
		texte = 'Attaque : <b>' + Math.floor(att[0]*1.5) + '</b> D6 ';
		if(att[1] >= 0)
			texte += '+' + att[1];
		else
			texte += att[1];
		texte += '<br/>Dégâts : <b>' + deg[0] + '</b> D3 ';
		if(deg[1] >= 0)
			texte += '+';
		texte += deg[1];
		texte += '<hr/>';
		texte += 'Attaque moyenne : <b>' + 
			(Math.floor(Math.floor(att[0]*1.5)*7/2)+att[1]) + '</b><br/>';
		texte += 'Dégâts moyens : <b>' + degmoy + '/' + 
			(degmoy+Math.floor(deg[0]/2)*2)+'</b>';
	}
	if(comp.indexOf('Botte Secrete') != -1){
		texte = 'Attaque : <b>' + Math.floor(att[0]/2) + '</b> D6 ';
		if(att[1] >=0)
			texte += '+' + Math.floor(att[1]/2);
		else
			texte += Math.floor(att[1]/2);
		texte += '<br/>Dégâts : <b>' + Math.floor(att[0]/2) + '</b> D3 ';
		if(deg[1] >=0)
			texte += '+';
		texte += Math.floor(deg[1]/2);
		texte += '<hr/>';
		texte += 'Attaque moyenne : <b>' + 
			((Math.floor(att[0]/2)*7/2)+Math.floor(att[1]/2)) + '</b><br/>';
		texte += 'Dégâts moyens : <b>' + 
			(Math.floor(att[0]/2)*2+Math.floor(deg[1]/2)) + '/' + 
			(Math.floor(Math.floor(att[0]/2)*1.5)*2+Math.floor(deg[1]/2))+'</b>';
	}
	if(comp.indexOf('Charger') != -1)
	{
		texte = 'Attaque : <b>' + att[0] + '</b> D6 ';
		if(att[1] >=0)
			texte += '+' + att[1];
		else
			texte += att[1];
		texte += '<br/>Dégâts : <b>' + deg[0] + '</b> D3 ';
		if(deg[1] >=0)
			texte += '+';
		texte += deg[1];
		var aux = Math.ceil(pvactuels/10)+regen[0];
		var portee = 0;
		if(aux<=4)
			portee = 1;
		else if(aux<=9)
			portee = 2;
		else if(aux<=15)
			portee = 3;
		else if(aux<=22)
			portee = 4;
		else if(aux<=30)
			portee = 5;
		else if(aux<=39)
			portee = 6;
		portee=porte(aux);
		portee=Math.min(portee,vuetotale);
		texte += '<br/>Portée : <b>' + portee + '</b> case';
		if(portee>1)
			texte += 's';
		texte += '<hr/>';
		texte += 'Attaque moyenne : <b>' + attmoy + '</b><br/>';
		texte += 'Dégâts moyens : <b>' + degmoy + '/' + (degmoy+Math.floor(deg[0]/2)*2)+'</b>';
	}
	if(comp.indexOf('Connaissance des Monstres') != -1)
		texte = 'Portée horizontale : <b>' + vuetotale + '</b> cases<br/> Portée verticale : <b>' + Math.ceil(vuetotale/2) + '</b> cases';
	if(comp.indexOf('Construire un Piege') != -1)
	{
		texte = 'Dégats du piège à feu : <b>' + Math.floor((esq[0]+vue)/2) + '</b> D3<hr/>';
		texte += 'Dégâts moyens : <b>' + Math.floor((esq[0]+vue)/2)*2 + ' (';
		texte += '' + resiste(Math.floor((esq[0]+vue)/2))+')</b>';
	}
	if(comp.indexOf('Contre-Attaquer') != -1)
	{
		texte = 'Attaque : <b>' + Math.floor(att[0]/2) + '</b> D6';
		if(att[1] >=0)
			texte += '+' + Math.floor(att[1]/2);
		else
			texte += Math.floor(att[1]/2);
		texte += '<br/>Dégâts : <b>' + deg[0] + '</b> D3 ';
		if(deg[1] >= 0)
			texte += '+';
		texte += deg[1];
		texte += '<hr/>';
		texte += 'Attaque moyenne : <b>' + (Math.floor(att[0]/2)*3.5+Math.floor(att[1]/2));
		texte += '</b><br/>Dégâts moyens : <b>' + (degmoy) +'/' + (degmoy+Math.floor(deg[0]/2)*2)+'</b>';
		
	}
	if(comp.indexOf('Coup de Butoir') != -1)
	{
		texte = 'Attaque : <b>' + att[0] + '</b> D6 ';
		if(att[1] >= 0)
			texte += '+' + att[1];
		else
			texte += att[1];
		texte += '<br/>Dégâts : <b>' + Math.floor(deg[0]*1.5) + '</b> D3 ';
		if(deg[1] >=0)
			texte += '+';
		texte += deg[1];
		texte += '<hr/>';
		texte += 'Attaque moyenne : <b>' + attmoy;
		texte += '</b><br/>Dégâts moyens : <b>' + (degmoy+Math.floor(deg[0]/2)*2) + '/' + (deg[0]*2*2+deg[1])+'</b>';
	}
	if(comp.indexOf('Frenesie') != -1)
	{
		texte = 'Attaque : <b>' + att[0] + '</b> D6 ';
		if(att[1] >=0)
			texte += '+' + att[1];
		else
			texte += att[1];
		texte += '<br/>Dégâts : <b>' + deg[0] + '</b> D3 ';
		if(deg[1] >=0)
			texte += '+';
		texte += deg[1];
		texte += '<hr/>';
		texte += 'Attaque moyenne : <b>' + attmoy;
		texte += '</b><br/>Dégâts moyens : <b>' + degmoy + '/' + (degmoy+Math.floor(deg[0]/2)*2)+'</b>';
	}
	if(comp.indexOf('Lancer de Potions') != -1)
	{
		texte = 'Portée : <b>' + (2+Math.floor(vuetotale/5))+ '</b> cases';
	}
        if(comp.indexOf('Parer') != -1)
        {
                texte = 'Parade : <b>' +Math.floor(att[0]/2) + '</b> D6 ';
		if(att[1] >=0)
                        texte += '+' + Math.floor(att[1]/2);
                else
                        texte += Math.floor(att[1]/2);
		texte +='<hr/>';
		texte += 'Parade moyenne : <b>' + (Math.floor(att[0]/2)*3.5+Math.floor(att[1]/2))+'</b>';
        }
	if ( comp.indexOf ( 'Pistage' ) != -1 )
		texte = 'Portée horizontale : <b>' + vuetotale*2 + '</b> cases<br/>Portée verticale : <b>' + Math.ceil(vuetotale/2)*2 + '</b> cases';
	if ( comp.indexOf ( 'Identification des Champignons' ) != -1 )
		texte = 'Portée horizontale : <b>' + Math.floor(vuetotale/2) + '</b> cases<br/>Portée verticale : <b>' + Math.floor(Math.ceil(vuetotale/2)/2) + '</b> cases';
	if(comp.indexOf('Regeneration Accrue') != -1){
		texte = 'Régénération : <b>' + Math.floor(pvtotal/20) + '</b> D3<hr/>';
		texte += 'Régénération moyenne : <b>' + Math.floor(pvtotal/20)*2+'</b>';
	}
	
	return texte;
}

// Sorts
function sortileges(sort)
{
	var texte = '';
	var totalMM = MM[0]+MM[1];
	if(sort.indexOf('Analyse Anatomique') != -1)
		texte = 'Portée horizontale : <b>' + Math.floor(vuetotale/2) + '</b> cases<br/>Portée verticale : <b>' + Math.floor(Math.ceil(vuetotale/2)/2) + '</b> cases';
	if(sort.indexOf('Armure Etheree') != -1)
		texte = 'Armure : <b>+'+regen[0]+'</b>';
	if(sort.indexOf('Augmentation') != -1 && sort.indexOf('Attaque')!=-1)
		texte = 'Attaque : <b>+'+(1+Math.floor((att[0]-3)/2))+'</b>';
	if(sort.indexOf('Augmentation') != -1 && sort.indexOf('Esquive')!=-1)
		texte = 'Esquive : +<b>'+(1+Math.floor((esq[0]-3)/2))+'</b>';
	if(sort.indexOf('Augmentation des Degats') != -1)
		texte = 'Dégâts : +<b>'+(1+Math.floor((deg[0]-3)/2))+'</b>';
	if(sort.indexOf('Bulle Anti-Magie') != -1)
		texte = 'RM : <b>+' + Math.floor(RM[0]) + '</b><br/>MM : <b>-' + Math.floor(MM[0]) + '</b>';
	if(sort.indexOf('Bulle Magique') != -1)
		texte = 'MM : <b>+' + Math.floor(MM[0]) + '</b><br/>RM : <b>-' + Math.floor(RM[0]) + '</b>';
	if(sort.indexOf('Explosion') != -1)
	{
		texte = 'Attaque : <b>Automatique</b><br/>'; 
		texte += 'Dégâts : <b>' + Math.floor(1+(deg[0]+Math.floor(pvtotal/10))/2) + '</b> D3 (effet de zone)<hr/>';
		texte += 'Moyenne Dégâts : <b>' + Math.floor(1+(deg[0]+Math.floor(pvtotal/10))/2)*2 + ' (';
		texte += resiste(Math.floor(1+(deg[0]+Math.floor(pvtotal/10))/2))+')</b>';
	}
	if(sort.indexOf('Faiblesse Passagere') != -1)
		texte = 'Dégâts : <b>-' + Math.floor((Math.ceil((pvactuels-30)/10)+deg[0]-3)/2+1) + '</b>';
	if(sort.indexOf('Flash Aveuglant') != -1)
		texte = 'Vue, Attaque, Esquive : <b>-'+(1+Math.floor(vue/5))+'</b>';
	if(sort.indexOf('Glue') != -1)
		texte = 'Portée : <b>'+(1+Math.floor(vue/3))+'</b> cases';
	if(sort.indexOf('Griffe du Sorcier') != -1)
	{
		texte = 'Attaque : <b>' + att[0] + '</b> D6<br/>Dégâts : <b>' + Math.floor(deg[0]/2) + '</b> D3<br/>';
		texte += 'Durée : <b>'+(1+Math.floor(vue/5))+'</b> tours<br/>Poison : <b>'+(1+Math.floor(pvtotal/30))+'</b> D3<hr/>';
		texte += 'Attaque moyenne : <b>'+Math.floor(att[0]*3.5)+'</b><br/>';
		texte += 'Dégats moyens : <b>'+(Math.floor(deg[0]/2)*2)+'/'+Math.floor(Math.floor(deg[0]/2)*1.5)*2;
		texte += ' ('+resiste(Math.floor(deg[0]/2))+'/'+resiste(Math.floor(Math.floor(deg[0]/2)*1.5))+')</b></br>';
		texte += 'Poison : <b>'+(1+Math.floor(pvtotal/30))*2+'</b>';
	}
	if(sort.indexOf('Hypnotisme') != -1)
	{
		texte = 'Esquive : <b>-' + Math.floor(esq[0]*1.5) + '</b> Dés ';
		texte += '(<b>-' + Math.floor(esq[0]/3) + '</b> Dés )';
	}
	if(sort.indexOf('Projectile Magique') != -1)
	{
		texte = 'Attaque : <b>' + vue + '</b> D6<br/>dég : <b>' + Math.floor(vue/2) + '</b> D3<br/>';
		var portee = 0;
		if(vuetotale<=4)
			portee = 1;
		else if(vuetotale<=9)
			portee = 2;
		else if(vuetotale<=15)
			portee = 3;
		else if(vuetotale<=22)
			portee = 4;
		else if(vuetotale<=30)
			portee = 5;
		else if(vuetotale<=39)
			portee = 6;
		else if(vuetotale<=49)
			portee = 7;
		else if(vuetotale<=60)
			portee = 8;
		else if(vuetotale<=72)
			portee = 9;
		else if(vuetotale<=85)
			portee = 10;
		portee=porte(vuetotale);
		texte += 'Portée : <b>' + portee + '</b> case';
		if(portee>1)
			texte += 's';
		texte += '<hr/>';
		texte += 'Attaque moyenne : <b>' + Math.floor(vue*3.5) + 
'</b><br/>';
		texte += 'Dégâts moyens : <b>' + Math.floor(vue/2)*2 + '/';
		texte += Math.floor(Math.floor(vue/2)*1.5)*2 + ' (';
		texte += resiste(Math.floor(Math.floor(vue/2))) + '/';
		texte += resiste(Math.floor(Math.floor(vue/2)*1.5))+')</b>';
	}
	if(sort.indexOf('Rafale Psychique') != -1)
	{
		texte = 'Attaque : <b>Automatique</b><br/>Dégâts : <b>' + deg[0] + '</b> D3<br/>Régénération : <b>-' + deg[0] + '</b><hr/>';
		texte += 'Dégâts moyens : <b>' + deg[0]*2 + ' (';
		texte += resiste(deg[0])+')</b>';
	}
	if(sort.indexOf('Teleportation') != -1)
	{
		texte = 'Portée horizontale  : <b>'+Math.floor(20+vue+porte(totalMM/5))+'</b> cases<br/>Portée verticale : <b>'+Math.floor(3+porte(totalMM/5)/3)+'</b> cases';
	}
	if(sort.indexOf('Vampirisme') != -1)
	{
		texte = 'Attaque : <b>' + Math.floor(deg[0]*2/3) + '</b> D6<br/>Dégâts : <b>' + deg[0] + '</b> D3<hr/>';
		texte += 'Attaque moyenne : <b>' + 
Math.floor((Math.floor(deg[0]*2/3))*3.5) + '</b><br/>';
		texte += 'Dégâts moyens : <b>' + deg[0]*2 + '/';
		texte += Math.floor(deg[0]*1.5)*2 + ' (';
		texte += resiste(deg[0]) + '/';
		texte += resiste(Math.floor(deg[0]*1.5))+')</b>';
	}
	if(sort.indexOf('Vision Accrue') != -1)
		texte = 'Vue : <b>+' + Math.floor(vue/2) + '</b>';
	if(sort.indexOf('Voir le Cache') != -1)
		texte = 'Portée horizontale : <b>'+Math.floor(vuetotale/2)+'</b> cases<br/>Portée verticale : <b>'+Math.floor(vuetotale/4)+'</b> cases';
	if(sort.indexOf('Vue Troublee') != -1)
		texte = 'Vue : <b>-'+Math.floor(vue/3)+'</b>';
	if(sort.indexOf('Telekinesie') != -1)
	{
		texte = 'Trésor ciblables (portée horizontale) : <hr> une plume à <b>'+Math.floor(vuetotale/2 + 2)+'</b> cases<br/>';
		texte += 'léger à <b>'+Math.floor(vuetotale/2 + 1)+'</b> cases<br/>';
		texte += 'moyen à <b>'+Math.floor(vuetotale/2)+'</b> cases<br/>';
		texte += 'lourd à <b>'+Math.floor(vuetotale/2 - 1)+'</b> cases<br/>';
		texte += 'trés lourd à <b>'+Math.floor(vuetotale/2 - 2)+'</b> cases<br/>';
	}
	return texte;
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
        noeud.setAttribute( 'onmouseover', "infoBulle('"+nom+"',event,'"+fonction+"');" );
        noeud.setAttribute( 'onmouseout', "cacherInfoBulle();" );
}

function infoBulle( nom, evt, fonction ) {
        var str;
        var val = nom.replace( /[ ]/g, '');
        val = nom.replace( /\W/g, '');
        val = val.toLowerCase();

        eval ( "str = "+fonction+"('"+nom+"');" );
	if(str=="")
		return;
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
// FATIGUE DU KASTAR
// ********************************************************

function fatigue()
{
        var nodes = document.evaluate("descendant::img[contains(@src,'milieu.gif') or contains(@src,'lifebar.gif')]", anchorAllTables[3].childNodes[1].childNodes[8].childNodes[3], null,XPathResult.ORDERED_NODE_SNAPSHOT_TYPE, null);
        if(nodes.snapshotLength>0)
        {
            var node = nodes.snapshotItem(0);
            node.setAttribute('title','1 PV de perdu = + '+Math.floor(250/pvtotal)+' minutes de DLA');
        }
			    
	var td = anchorAllTables[3].childNodes[1].childNodes[8].childNodes[3].childNodes[1].childNodes[1].childNodes[4].childNodes[3];
	if(td.childNodes[0].nodeValue.indexOf("Fatigue")!=-1)
	{
	   anchorAllTables[3].childNodes[1].childNodes[8].childNodes[3].childNodes[1].childNodes[1].childNodes[2].appendChild(td);
	   anchorAllTables[3].childNodes[1].childNodes[8].childNodes[3].childNodes[1].childNodes[1].childNodes[0].childNodes[3].setAttribute('rowspan',0);
	   var ntd = document.createElement("td");
	   //var dla = anchorAllTables[3].childNodes[1].childNodes[2].childNodes[3].childNodes[1].childNodes[0].nodeValue;
	   var pa = anchorAllTables[3].childNodes[1].childNodes[2].childNodes[3].childNodes[5].childNodes[0].nodeValue;
	   dla=dla.substr(dla.lastIndexOf('/')+1,5000);
	   dla=dla.substr(dla.indexOf(' ')+1,5000);
	   pa=pa.substr(1,1)*1;
	   var ut=60*60*dla.substring(0,2)+60*dla.substring(3,5)+1*dla.substring(6,8);
	   var ct=arrTr[arrTr.length-1].childNodes[1].childNodes[3].nodeValue;
	   if(ct.indexOf('AM')!=-1)
	     ct=60*60*ct.substr(ct.indexOf('AM')-9,2)+60*ct.substr(ct.indexOf('AM')-6,2)+1*ct.substr(ct.indexOf('AM')-3,2);
	   else
	     ct=60*60*ct.substr(ct.indexOf('PM')-9,2)+60*ct.substr(ct.indexOf('PM')-6,2)+1*ct.substr(ct.indexOf('PM')-3,2);
	   while(ct>ut)
	     ut+=60*60*24;
	   var nbmin=1*td.childNodes[0].nodeValue.substring(td.childNodes[0].nodeValue.indexOf('=')+2,td.childNodes[0].nodeValue.indexOf("'"));
	   if(pa<2)
	     ntd.appendChild(document.createTextNode("Vous n'avez pas assez de PA pour accélérer"));
	   else if(pvactuels>(Math.ceil(Math.floor((ut-ct)/60)/nbmin)))
 	     ntd.appendChild(document.createTextNode("Vous devez accélérer d'au moins "+(Math.ceil(Math.floor((ut-ct)/60)/nbmin))+" PV pour rejouer de suite"));
	   else
	     ntd.appendChild(document.createTextNode("Vous ne pouvez pas rejouer de suite"));
	   anchorAllTables[3].childNodes[1].childNodes[8].childNodes[3].childNodes[1].childNodes[1].childNodes[4].appendChild(ntd);
	}
}


// ********************************************************
// MAIN CODE
// ********************************************************

var anchorAllTables = document.getElementsByTagName ( 'table' ); // ANCHOR
var anchorMainTr = anchorAllTables[3].getElementsByTagName ( 'tr' ); // ANCHOR
var arrTr = document.getElementsByTagName('tr');

try 
{ 
	var text = new String ();
	
	text = anchorMainTr[0].getElementsByTagName ( 'a' )[0].innerHTML;
	var trollNomId = text.substring ( text.indexOf ( '.: ' ), text.indexOf ( ' - ' ) + 1 );
	
	//var trollRM = anchorMainTr[13].innerHTML;
} catch ( e ) { error ( e, 'Data collect error' ); }

try 
{
	anchorAllTables[2].getElementsByTagName ( 'tr' )[0].getElementsByTagName ( 'td' )[0].setAttribute ( 'colspan', '2' );
} catch ( e ) { error ( e, 'Title display error' ); }

// ********************************************************
// Adding login IFRAME
// ********************************************************

var myTr = newTR();
var myTd = document.createElement ( 'td' );
myTd.setAttribute ( 'colspan', '3' );
var myIFrame = document.createElement ( 'iframe' );

var anchorCss = document.getElementsByTagName ( 'link' )[0];
URLLoginRM = URLLoginRM + "?URLStylesheet=" + anchorCss.getAttribute('href');

myIFrame.setAttribute ( 'src', URLLoginRM );
myIFrame.setAttribute ( 'width', '100%' );
myIFrame.setAttribute ( 'height', '50' );
myIFrame.setAttribute ( 'frameborder', '0' );
myIFrame.setAttribute ( 'scrolling', 'no' );
myTd.appendChild ( myIFrame );
myTr.appendChild ( myTd );
try { anchorAllTables[2].appendChild ( myTr ); } catch ( e ) { error ( e, 'Auth R&M error' ); }

// ********************************************************
// GGC and VVT links
// ********************************************************

var profil;
try { profil = flattenNode ( anchorAllTables[3] ) + "Compétences " + flattenNode ( anchorAllTables[9] ) + "\n" + flattenNode ( anchorAllTables[10] );  } catch ( e ) { error ( e, 'Profile flattening error' ); }

myTr = newTR ();
myTr.appendChild ( myTd1 = newTD () );
myTd1.setAttribute ( 'align', 'right' );
myTr.appendChild ( myTd2 = newTD () );
myTd2.setAttribute ( 'align', 'center' );
myTr.appendChild ( myTd3 = newTD () );
myTd3.setAttribute ( 'align', 'left' );

// VTT
myTd1.appendChild ( myForm = newForm ( 'formVTT', URLVtt ) );
var onSubmit = "window.open('', 'popupVtt', 'width=" + ( screen.width - 150 ) + ", height=" + ( screen.height - 250 ) +
	", toolbar=no, status=no, location=no, resizable=yes, scrollbars=yes'); this.target='popupVtt'";
myForm.setAttribute ( 'onsubmit', onSubmit );
myForm.appendChild ( newHidden ( 'copiercoller', profil ) );
myForm.appendChild ( newHidden ( 'firemago', 'on' ) );
myForm.appendChild ( newButton ( 'soumettre', 'Renseigner le VTT' ) );

// GGC
myTd2.appendChild ( myForm = newForm ( 'formGGC', URLGgc ) );
var onSubmit = "window.open('', 'popupGgc', 'width=" + ( screen.width - 150 ) + ", height=" + ( screen.height - 250) +
	", toolbar=no, status=no, location=no, resizable=yes, scrollbars=yes'); this.target='popupGgc'";
myForm.setAttribute ( 'onsubmit', onSubmit );
myForm.appendChild ( newHidden ( 'copiercoller', profil ) );
myForm.appendChild ( newHidden ( 'firemago', 'on' ) );
myForm.appendChild ( newHidden ( 'action', 'add' ) );
myForm.appendChild ( newButton ( 'soumettre', 'Renseigner le GGC' ) );

//Partages
var URLPartages = URLOutils + 'partagepx/partage.php';
myTd3.appendChild ( myForm = newForm ( 'formPartages', URLPartages + '?modif=1&troll=' + trim ( trollNomId ) +'' ) );
var onSubmit = "window.open('', 'popupPartages', 'width=" + ( screen.width - 150 ) + ", height=" + ( screen.height - 128) +
	", toolbar=no, status=no, location=no, resizable=yes, scrollbars=yes'); this.target='popupPartages'";
myForm.setAttribute ( 'onsubmit', onSubmit );
myForm.appendChild ( newButton ( 'soumettre', 'Partages' ) );

try { anchorAllTables[2].appendChild ( myTr ); } catch ( e ) { error ( e, 'GGC and VTT error' ); }


// ********************************************************
// Divers
// ********************************************************

// Number of the troll
var numTroll = anchorMainTr[0].childNodes[3].childNodes[1].getAttribute('href');
numTroll = numTroll.slice ( numTroll.indexOf ( '(' ) + 1, numTroll.indexOf ( ',' ) );

// Next Level
var anchorCellLevel = anchorMainTr[4].childNodes[3].firstChild;
var levelDesc = anchorCellLevel.nodeValue;
var level = levelDesc.substring( levelDesc.indexOf ( ":" ) + 2, levelDesc.indexOf ( "(" ) - 8 );
var nextLevel = level * 1 + 1;
var PINextLevel = level * ( level * 1 + 3 ) * 5;
try 
{
	anchorCellLevel.nodeValue = levelDesc.substring ( 0, levelDesc.length - 1 ) + " | Niveau " + ( level * 1 + 1 ) + " : " + ( level * ( level * 1 + 3 ) * 5 ) + " PI)";
} catch ( e ) { error ( e, 'Next level info error' ); }

// Regen
var anchorCellRegen = anchorMainTr[9].childNodes[1].firstChild;
var regen = fightAverage ( anchorCellRegen );

// Attaque
var anchorCellAtt = anchorMainTr[10].childNodes[3].childNodes[0];
var att = fightAverage ( anchorCellAtt );

// Esquive
var anchorCellEsq = anchorMainTr[10].childNodes[3].childNodes[2];
var esq = fightAverage ( anchorCellEsq );

// Dégats
var anchorCellDeg = anchorMainTr[10].childNodes[3].childNodes[4];
var deg = fightAverage ( anchorCellDeg );

// Esquive after attak subie
var anchorCellAttEsq = anchorMainTr[10].childNodes[3].childNodes[7].childNodes[0];
var nbAttak = cleanValue ( anchorCellAttEsq.nodeValue );
if ( nbAttak != 0 )
{
	var esqmodmoy = Math.max ( esq[0] * 3.5 + esq[1] - 3.5 * nbAttak, esq[1] );
	anchorCellAttEsq.nodeValue += "(moy esquive = " + esqmodmoy + ")";
}

// RM
var anchorCellRM = anchorMainTr[14].childNodes[3].childNodes[0];
var RM = totalMagik ( anchorCellRM );

// MM
var anchorCellMM = anchorMainTr[14].childNodes[3].childNodes[2];
var MM = totalMagik ( anchorCellMM );

// PV
var anchorPvTotal = anchorAllTables[3].childNodes[1].childNodes[8].childNodes[3].childNodes[1].childNodes[1].childNodes[2].childNodes[1].childNodes[0].nodeValue;
pvtotal = cleanValue(anchorPvTotal);
var anchorPvActuels = anchorAllTables[3].childNodes[1].childNodes[8].childNodes[3].childNodes[1].childNodes[1].childNodes[0].childNodes[1].childNodes[1].childNodes[0].nodeValue;
pvactuels = cleanValue(anchorPvActuels);

// view
var anchorView = anchorAllTables[3].childNodes[1].childNodes[4].childNodes[3].childNodes[3].nodeValue;
var arrView = extractBonus ( cleanValue ( anchorView ) );
var vue = arrView[0];
var vuetotale = arrView[0] + arrView[1];

// Date of the next DLA
try
{
	var dla= anchorMainTr[2].childNodes[3].childNodes[1].firstChild.nodeValue;
	var dlaNext = anchorMainTr[2].childNodes[3].childNodes[8].childNodes[1].firstChild.nodeValue;

	var datArr = dla.split(" ");
	var dayArr = datArr[1].split("/");
	var timeArr = datArr[2].split(":");

	var d = new Date ( dayArr[2], dayArr[1]-1, dayArr[0], timeArr[0], timeArr[1], timeArr[2]);

	var dataDlaNext = dlaNext.substring(38,dlaNext.length);
	var dataDlaNextArr = dataDlaNext.split("heures et ");
	var nbHours = trim(dataDlaNextArr[0]) * 1;

	var nbMinutes = trim ( dataDlaNextArr[1].substring(0,2)) * 1;

	d.setHours(d.getHours()+nbHours);
	d.setMinutes(d.getMinutes()+nbMinutes);

	var itDlaNext = document.createElement("i");
	var txtDlaNext = document.createTextNode("Prochaine dla : " + d.toLocaleString());
	itDlaNext.appendChild(txtDlaNext);
	anchorMainTr[2].childNodes[3].appendChild(itDlaNext);
}
catch ( e ) { error ( e, 'Next DLA error' ); }

// fatigue
fatigue();


// *********************************************
// Competences and sorts popups
// *********************************************

var hauteur = 50;
var bulleStyle = null;
//var listeComp = anchorAllTables[3].childNodes[1].childNodes[20].childNodes[1].childNodes[1].childNodes[1];
var listeComp = anchorAllTables[8].childNodes[1].childNodes[2].childNodes[1].childNodes[1].childNodes[1];
//var listeSort = anchorAllTables[3].childNodes[1].childNodes[24].childNodes[1].childNodes[1].childNodes[1];
var listeSort = anchorAllTables[8].childNodes[1].childNodes[2].childNodes[3].childNodes[1].childNodes[1];

creerBulle();
creerInfoBulles( listeComp , "competences" );
creerInfoBulles( listeSort , "sortileges" );

// *********************************************
// Update cookies
// *********************************************
var expdate = new Date ();
expdate.setTime ( expdate.getTime() + ( 24 * 60 * 60 * 1000 * 7 ) );
deleteCookie ( "MM_TROLL", "/" );
setCookie ( "MM_TROLL", MM[0] + MM[1], expdate, "/" );
deleteCookie ( "NIV_TROLL", "/" );
setCookie ( "NIV_TROLL", level, expdate, "/" );
deleteCookie ( "NUM_TROLL", "/" );
setCookie( "NUM_TROLL", numTroll, expdate, "/" );
deleteCookie ( "RM_TROLL", "/" );
setCookie( "RM_TROLL", RM[0] + RM[1], expdate, "/" );

displayErrors ( anchorAllTables[3] );
displayDebug ( anchorAllTables[3] );
