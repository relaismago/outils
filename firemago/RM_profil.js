/*********************************************************************************
*    This file is part of Mountyzilla modified for zoryazilla                    *
*********************************************************************************/

/*********************************************************************************
*   Modifications du DOM              *
*********************************************************************************/
function insertBefore(next, el) {
	next.parentNode.insertBefore(el, next);
}

function appendTr(tbody, clas) {
	var tr = document.createElement('TR');
	if (clas)
		tr.setAttribute('class', clas);
	tbody.appendChild(tr);
	return tr;
}

function insertTr(next, clas) {
	var tr = document.createElement('TR');
	if (clas)
		tr.setAttribute('class', clas);
	insertBefore(next, tr);
	return tr;
}

function appendTd(tr) {
	var td = document.createElement('TD');
	if (tr)
		tr.appendChild(td);
	return td;	
}

function insertTd(next) {
	var td = document.createElement('TD');
	insertBefore(next, td);
	return td;
}

function appendTdText(tr, text, bold) {
	var td = appendTd(tr);
	appendText(td, text, bold);
	return td;
}

function insertTdText(next, text, bold) {
	var td = insertTd(next);
	appendText(td, text, bold);
	return td;
}

function insertTdElement(next, el) {
	var td = insertTd(next);
	if (el)
		td.appendChild(el);
	return td;
}

function insertBr(next) {
	insertBefore(next, document.createElement('br'));
}

function appendBr(paren) {
	paren.appendChild(document.createElement('BR'));
}

function insertText(next, text, bold) {
	if (bold) {
		var b = document.createElement('b');
		appendText(b, text);
		insertBefore(next, b);
	} else
		insertBefore(next, document.createTextNode(text));
}

function appendText(paren, text, bold) {
	if (bold) {
		var b = document.createElement('b');
		b.appendChild(document.createTextNode(text));
		paren.appendChild(b);
	} else
		paren.appendChild(document.createTextNode(text));
}

// Fonctions utiles

function aff(nbr) {
	return nbr >= 0 ? '+' + nbr : nbr;
}

function trim(str) {
	return str.replace(/(^\s*)|(\s*$)/g, '');
}

function str_woa(str) {
	return str.replace(/[����]/g, 'e').replace(/[���]/g, 'a').replace(/[���]/g, 'u')
			.replace(/[��]/g, 'i').replace(/[��]/g, 'o');
}

function resiste(x) {
	x = Math.floor(x);
	if (x > 50)
		return x - 0.25 + degbmm/2;
	var val1 = Math.pow(3, x);
	val1 = x - (Math.floor(val1 / 2) + (x % 2)) / (2 * val1);
	return Math.round(val1 * 100) / 100 + degbmm/2;
}

function getPortee(param) {
	return Math.ceil((Math.sqrt(19 + 8 * (param + 3)) - 7) / 2);
}

// On extrait les valeurs qui nous int�ressent de la page

function cleanValue(val) {
	if(val.tagName=="TR")
		return val;
	val = trim(val.slice(val.indexOf(':') + 1));
	return val.replace(/[\n\r]/, '').replace(/D6/, '').replace(/D3/, '').replace(/Cases/, '').replace(/points/,'')
			.replace(/[\)]/g, '').replace(/[\+\(]/g, '').replace(/[ ]+/g,' ');
}

function extractBonus(val) {
	if(val.tagName=="TR")
	{
		var vals = new Array();
		if(!isNaN(parseInt(val.childNodes[3].childNodes[0].nodeValue)))
			vals.push(parseInt(val.childNodes[3].childNodes[0].nodeValue));
		if(!isNaN(parseInt(val.childNodes[5].childNodes[0].nodeValue)))
			vals.push(parseInt(val.childNodes[5].childNodes[0].nodeValue));
		if(!isNaN(parseInt(val.childNodes[7].childNodes[0].nodeValue)))
			vals.push(parseInt(val.childNodes[7].childNodes[0].nodeValue));
		return vals;
	}
	var vals = trim(val).split(' ');
	if (vals.length == 1)
		vals[1] = 0;
	for (var i = 0; i < vals.length; i++)
		vals[i] = parseInt(vals[i]);
	return vals;
}

function setInfoDateCreation()
{
	var node = document.evaluate("//tr/td/text()[contains(.,'Date de Cr�ation')]",
			arrTable[3], null, XPathResult.FIRST_ORDERED_NODE_TYPE, null).singleNodeValue;
	if(nbjours!=1)
		node.nodeValue+=" ("+nbjours+" jours dans le hall)";
	else
		node.nodeValue+=" (Bienvenue � toi pour ton premier jour dans le hall)";
}

function getDateCreation()
{
	var text = document.evaluate("//tr/td/text()[contains(.,'Date de Cr�ation')]",
			arrTable[3], null, XPathResult.FIRST_ORDERED_NODE_TYPE, null).singleNodeValue.nodeValue;
	text = text.substring(text.indexOf("(")+1,text.indexOf(")"));
	var date = new Date(text.replace(/([0-9]+)\/([0-9]+)\//,"$2/$1/"));
	return date;
}

function getDateActuelle()
{
	var text = document.evaluate("//tr/td/text()[contains(.,'Heure Serveur')]",
			arrTable[3], null, XPathResult.FIRST_ORDERED_NODE_TYPE, null).singleNodeValue.nodeValue;
	text = text.substring(text.indexOf("Heure")+13);
	text = text.substring(text.indexOf(": ")+2,text.indexOf("]"));
	var date = new Date(text.replace(/([0-9]+)\/([0-9]+)\//,"$2/$1/"));
	return date;
}

function init() {
	arrTable = document.getElementsByTagName('table');
	arrTR = document.getElementsByTagName('tr');

	var listeValeurs = new Array();
	listeValeurs['vue'] = arrTable[3].childNodes[1].childNodes[4].childNodes[3].childNodes[3].nodeValue;
	listeValeurs['pva'] = arrTable[3].childNodes[1].childNodes[8].childNodes[3].childNodes[1].childNodes[1].childNodes[0].childNodes[1].childNodes[1].childNodes[0].nodeValue;
	listeValeurs['pvm'] = arrTable[3].childNodes[1].childNodes[8].childNodes[3].childNodes[1].childNodes[1].childNodes[2].childNodes[1].childNodes[0].nodeValue;
	listeValeurs['reg'] = arrTable[3].childNodes[1].childNodes[10].childNodes[3].childNodes[0].childNodes[1].childNodes[0];
	listeValeurs['att'] = arrTable[3].childNodes[1].childNodes[10].childNodes[3].childNodes[0].childNodes[1].childNodes[2];
	listeValeurs['esq'] = arrTable[3].childNodes[1].childNodes[10].childNodes[3].childNodes[0].childNodes[1].childNodes[4];
	listeValeurs['deg'] = arrTable[3].childNodes[1].childNodes[10].childNodes[3].childNodes[0].childNodes[1].childNodes[6];
	listeValeurs['arm'] = arrTable[3].childNodes[1].childNodes[10].childNodes[3].childNodes[0].childNodes[1].childNodes[8];
	listeValeurs['rm'] = arrTable[3].childNodes[1].childNodes[18].childNodes[3].childNodes[0].nodeValue;
	listeValeurs['mm'] = arrTable[3].childNodes[1].childNodes[18].childNodes[3].childNodes[2].nodeValue;
	listeValeurs['niv'] = arrTable[3].childNodes[1].childNodes[6].childNodes[3].childNodes[0].nodeValue;
	for (var key in listeValeurs) {
		listeValeurs[key] = cleanValue(listeValeurs[key]);
		listeValeurs[key] = extractBonus(listeValeurs[key]);
	}

	var a = arrTR[6].childNodes[3].firstChild.nodeValue.split("|");
	posX = a[0].substring(4, a[0].length - 1) * 1;
	posY = a[1].substring(5, a[1].length - 1) * 1;
	posN = a[2].substring(5, a[2].length - 1) * 1;

	vue = listeValeurs['vue'][0];
	vuetotale = Math.max(0, listeValeurs['vue'][0] + listeValeurs['vue'][1]);

	niveau = listeValeurs['niv'][0];

	pvtotal = listeValeurs['pvm'][0];
	pvactuels = listeValeurs['pva'][0];
	
	reg = listeValeurs['reg'][0];
	regbonus = listeValeurs['reg'][1]+listeValeurs['reg'][2];
	regmoy = reg * 2 + regbonus;
	appendTdText(arrTable[3].childNodes[1].childNodes[10].childNodes[3].childNodes[0].childNodes[1].childNodes[0], '(moyenne : ' + regmoy + ')',false);
	
	att = listeValeurs['att'][0];
	attbonus = listeValeurs['att'][1];
	attbmm = listeValeurs['att'][2];
	
	attmoy = 3.5 * att + attbonus + attbmm;
	appendTdText(arrTable[3].childNodes[1].childNodes[10].childNodes[3].childNodes[0].childNodes[1].childNodes[2],'(moyenne : ' + attmoy + ')',false);
	
	esq = listeValeurs['esq'][0];
	esqbonus = listeValeurs['esq'][1]+listeValeurs['esq'][2];
	esqmoy = 3.5 * esq + esqbonus;
	appendTdText(arrTable[3].childNodes[1].childNodes[10].childNodes[3].childNodes[0].childNodes[1].childNodes[4],'(moyenne : ' + esqmoy + ')',false);
	
	deg = listeValeurs['deg'][0];
	degbonus = listeValeurs['deg'][1];
	degbmm = listeValeurs['deg'][2];
	degmoy = deg * 2 + degbonus+degbmm;
	appendTdText(arrTable[3].childNodes[1].childNodes[10].childNodes[3].childNodes[0].childNodes[1].childNodes[6],'(moyenne : ' + degmoy + '/' + (Math.floor(deg * 3 / 2) * 2 + degbonus + degbmm) + ')',false);
	appendTdText(arrTable[3].childNodes[1].childNodes[10].childNodes[3].childNodes[0].childNodes[1].childNodes[8],'(total : ' + (listeValeurs['arm'][0]+listeValeurs['arm'][1]) + ')',false);
	
	rm = listeValeurs['rm'][0];
	rmbonus = listeValeurs['rm'][1];
	rmtotal = rm + listeValeurs['rm'][1];
	mm = listeValeurs['mm'][0];
	mmbonus = listeValeurs['mm'][1];
	mmTroll = mm + listeValeurs['mm'][1];
	arm = listeValeurs['arm'][1];
	armbonus = listeValeurs['arm'][0];
	nbjours = Math.floor((getDateActuelle()-getDateCreation())/1000/60/60/24)+1;
	setInfoDateCreation();
}

function setNextDla() {
		 // Heure de DLA.
		 var dateDla = arrTR[5].childNodes[3].childNodes[1].childNodes[0].nodeValue;
		 strDateDla = dateDla.toString();

		 var dateNext = new Date()
		 // Le jour
		 var posStart = 0;
		 var posEnd = strDateDla.indexOf("/", posStart );
		 dateNext.setDate( strDateDla.substring( posStart, posEnd ) );

		 // Le mois
		 posStart = posEnd + 1;
		 posEnd = strDateDla.indexOf("/", posStart );
		 dateNext.setMonth( strDateDla.substring( posStart, posEnd ) - 1 );

		 // L'ann�e
		 posStart = posEnd + 1;
		 posEnd = strDateDla.indexOf(" ", posStart );
		 dateNext.setYear( strDateDla.substring( posStart, posEnd ) );

		 // Les heures
		 posStart = posEnd + 1;
		 posEnd = strDateDla.indexOf(":", posStart );
		 dateNext.setHours( strDateDla.substring( posStart, posEnd ) );

		 posStart = posEnd + 1;
		 posEnd = strDateDla.indexOf(":", posStart );
		 dateNext.setMinutes( strDateDla.substring( posStart, posEnd ) );

		 posStart = posEnd + 1;
		 dateNext.setSeconds( strDateDla.substring( posStart, posStart+2) );

		 var totalMSec = dateNext.getTime();
		 // Dur�e prochain tour.
		 var DlaLength = arrTR[5].childNodes[3].childNodes[8].childNodes[1].childNodes[0].nodeValue;
		 posStart = DlaLength.indexOf(":", 0 );
		 posStart = posStart + 2;
		 posEnd = DlaLength.indexOf(" ", posStart );
		 // On ajoute les heures de la dur�e de la dla
		 totalMSec = totalMSec + DlaLength.substring( posStart, posEnd ) * 3600000;
		 posStart = DlaLength.indexOf("et ", posEnd )+3;
		 posEnd = DlaLength.indexOf(" ", posStart );
		 // On ajoute les minutes de la dur�e de la dla
		 totalMSec = totalMSec + DlaLength.substring( posStart, posEnd ) * 60000;

		 dateNext.setTime( totalMSec );
		 arrTR[5].childNodes[3].childNodes[8].childNodes[1].innerHTML += "<BR>---> Prochaine DLA (estim�e)............: " + formatDate(dateNext);
}

function addZero(i)
{
	if(i<10)
		return "0"+""+i;
	return i;
}

function formatDate(dateNext)
{
	return addZero(dateNext.getDate())+"/"+addZero(dateNext.getMonth()+1)+"/"+dateNext.getFullYear()+" "+addZero(dateNext.getHours())+":"+addZero(dateNext.getMinutes())+":"+addZero(dateNext.getSeconds());
}
// Fonctions modifiant la page

function setLieu() {
	arrTR[4].childNodes[5].setAttribute('rowspan','11');
	var myTR=document.createElement('tr');
	myTR.setAttribute('class','mh_tdpage');
	var myTD=document.createElement('td');
	myTD.setAttribute('valign','top');
	myTD.setAttribute('class','mh_tdtitre');
	myTD.appendChild(document.createElement('b'));
	myTD.childNodes[0].appendChild(document.createTextNode('Lieux les plus proches :'));
	myTR.appendChild(myTD);
	myTD=document.createElement('td');
	myTD.setAttribute('valign','top');
	myTR.appendChild(myTD);
	var mySpan1=document.createElement('span');
	var mySpan2=document.createElement('span');
	var mySpan3=document.createElement('span');
	var mySpan4=document.createElement('span');
	var mySpan5=document.createElement('span');
	arrTR[8].parentNode.insertBefore(myTR,arrTR[8]);
	var newA=document.createElement('a');
	newA.appendChild(document.createTextNode("Chez les Bricol' Trolls"));
	newA.setAttribute("href","http://trolls.ratibus.net/mountyhall/lieux.php?search=position&orderBy=distance&posx="+posX+"&posy="+posY+"&posn="+posN+"&typeLieu=4");
	newA.setAttribute("target","_blank");
	myTD.appendChild(newA);
}

function setFatigue() {
	var node3183 = arrTable[3].childNodes[1].childNodes[8].childNodes[3].childNodes[1];
	var nodes = document.evaluate("//img[contains(@src,'milieu.gif') or contains(@src,'lifebar.gif')]",
								 document, null, XPathResult.ORDERED_NODE_SNAPSHOT_TYPE, null);
	if (nodes.snapshotLength > 0)
		nodes.snapshotItem(0).setAttribute('title', '1 PV de perdu = +'
				+ Math.floor(2500 / pvtotal) / 10 + ' minute(s) de DLA');

	// heure DLA et heure courante
	var nodes = document.evaluate("//b[contains(preceding::text()[1],'Date Limite d')]/text()[1]",
			document, null, XPathResult.ORDERED_NODE_SNAPSHOT_TYPE, null);
	var dla = nodes.snapshotItem(0).nodeValue;
	dla = dla.substr(dla.lastIndexOf('/') + 6);
	dla = 60 * 60 * dla.substring(0, 2) + 60 * dla.substring(3, 5) + 1 * dla.substring(6, 8);
	nodes = document.evaluate("//td/text()[contains(.,'Heure Serveur : ')]",
			document, null, XPathResult.ORDERED_NODE_SNAPSHOT_TYPE, null);
	var ct = nodes.snapshotItem(0).nodeValue;
	ct = ct.substr(ct.lastIndexOf('/') + 6);
	var ct = 60 * 60 * ct.substring(0, 2) + 60 * ct.substring(3, 5) + 1 * ct.substring(6, 8);
	while (ct > dla)
		dla += 24 * 60 * 60;
//	node.nodeValue += "Estimation DLA suivante : " + ct + " - " + dla_ut;
//	appendBr(node);
//	appendTdText(node, "test2");
//
	nodes = document.evaluate("//td/text()[contains(.,'Fatigue...')]",
			                        document, null, XPathResult.ORDERED_NODE_SNAPSHOT_TYPE, null);
	if (nodes.snapshotLength > 0)
	{
		var node = nodes.snapshotItem(0).nodeValue;
		var td = nodes.snapshotItem(0).parentNode;
		appendBr(td);
		td.setAttribute('colspan',2);
		var pvAcceleration = Math.ceil(Math.floor((dla - ct) / 60) /
				node.substring(node.indexOf('=') + 2, node.indexOf("'")));
		minuteFatigue = parseInt(node.substring(node.indexOf('=') + 2, node.indexOf("'")));
		if (arrTable[3].childNodes[1].childNodes[2].childNodes[3].childNodes[5].childNodes[0].nodeValue.substr(1, 1) < 2)
			appendText(td, "Vous n'avez pas assez de PA pour acc�l�rer.");
		else if (pvactuels > pvAcceleration)
		{
			appendText(td, "Vous devez acc�l�rer d'au moins " + pvAcceleration + " PV pour rejouer de suite");
			if(pvAcceleration!=1)
			{
				var gain_secondes = dla-ct-((pvAcceleration-1)*60*node.substring(node.indexOf('=') + 2, node.indexOf("'")));
				if(gain_secondes%60==0)
				{
					appendText(td, " ("+(pvAcceleration-1)+" PV dans "+Math.floor(gain_secondes/60)+" min)");
				}
				else
				{
					appendText(td, " ("+(pvAcceleration-1)+" PV dans "+Math.floor(gain_secondes/60)+" min "+(gain_secondes%60)+" sec)");
				}
			}
		}
		else
			appendText(td, "Vous ne pouvez pas rejouer de suite.");
	}
}

function setPiForNextLevel() {
	var piForNextLevel = niveau * (niveau + 3) * 5;
	var px_ent = 2 * niveau;

	var parentPx = arrTable[3].childNodes[1].childNodes[6].childNodes[3];

	var nodeLvl = parentPx.childNodes[0];
	var pi_tot = parseInt(nodeLvl.nodeValue.substring(nodeLvl.nodeValue.indexOf('(') + 1,
			nodeLvl.nodeValue.indexOf(' PI')));
	nodeLvl.nodeValue = nodeLvl.nodeValue.substring(0, nodeLvl.nodeValue.length - 1) + " | Niveau "
			+ (niveau + 1) + " : " + piForNextLevel + " PI => ";
	nodeLvl.nodeValue += Math.ceil((piForNextLevel - pi_tot) / px_ent) + " entrainement";
	if (Math.ceil((piForNextLevel - pi_tot) / px_ent) > 1)
		nodeLvl.nodeValue += "s";
	nodeLvl.nodeValue += ")";

	var px = parentPx.childNodes[2].nodeValue;
	var px_per = px.substring(px.indexOf('\n', 10), 5000);
	px_per = parseInt(px_per.substring(px_per.indexOf(':') + 1, 5000));
	px = parseInt(px.substring(px.indexOf(':') + 1, px.indexOf('\n', 10)));

	var nodePx = parentPx.childNodes[3];
	insertBr(nodePx);
	if (px + px_per >= px_ent)
		insertText(nodePx, "Entra�nement possible. Il vous restera " + (px + px_per - px_ent) + " PX.");
	else
		insertText(nodePx, "Il vous manque " + (px_ent - px - px_per) + " PX pour vous entrainer. ");
	
	var span = document.createElement('SPAN');
	span.setAttribute("title",(Math.round(10*(pi_tot+px+px_per)/nbjours)/10)+" PI par jour");
	appendText(span, nodeLvl.nodeValue);
	parentPx.replaceChild(span,nodeLvl);
}

function setRatioKillDeath() {
	var node = arrTable[3].childNodes[1].childNodes[12].childNodes[3].childNodes[1];
	var killnode = node.childNodes[0];
	var kill = killnode.data.substring(killnode.data.indexOf('Nombre d\'Adversaires tu�s....: ') + 30, killnode.data.length) * 1;
	var span = document.createElement('SPAN');
	span.setAttribute("title","Un kill tous les "+(Math.round(10*nbjours/kill)/10)+" jours");
	appendText(span, killnode.nodeValue);
	node.replaceChild(span,killnode);
	var deathnode = node.childNodes[2];
	var death = deathnode.data.substring(deathnode.data.indexOf('Nombre de D�c�s...................: ') + 36, deathnode.data.length) * 1;
	if (death != 0) {
		span = document.createElement('SPAN');
		span.setAttribute("title","Une mort tous les "+(Math.round(10*nbjours/death)/10)+" jours");
		appendText(span, deathnode.nodeValue);
		node.replaceChild(span,deathnode);
		appendBr(node);
		appendText(node, ' Rapport kills/deaths : ' + Math.floor((kill / death) * 1000) / 1000);
	}
}

function setCurrentEsquive() {
	var nodes = document.evaluate("//p/text()[contains(.,'esquive en moins')]",
			document, null, XPathResult.ORDERED_NODE_SNAPSHOT_TYPE, null);
	var esqmod = nodes.snapshotItem(0).nodeValue;
	esqmod = Math.abs(esqmod.substring(esqmod.indexOf(': ') + 2, esqmod.length));
	nodes.snapshotItem(0).nodeValue += ' (Moyenne esquive : ' + Math.max(esqmoy - 3.5 * esqmod, esqbonus) + ')';
	nodes = document.evaluate("//p/text()[contains(.,'attaque en moins')]",
			document, null, XPathResult.ORDERED_NODE_SNAPSHOT_TYPE, null);
	var attmod = nodes.snapshotItem(0).nodeValue;
	attmod = Math.abs(attmod.substring(attmod.indexOf(': ') + 2, attmod.length));
	nodes.snapshotItem(0).nodeValue += ' (Moyenne attaque : ' + Math.max(attmoy - 3.5 * attmod, attbonus) + ')';
	nbattaques = 1*esqmod;
}

function setTotalMagie() {
	var span = document.createElement('SPAN');
	span.setAttribute("title",(Math.round(10*rm/nbjours)/10)+" ("+(Math.round(10*rmtotal/nbjours)/10)+") points de RM par jour | "
		+(Math.round(10*rm/niveau)/10)+" ("+(Math.round(10*rmtotal/niveau)/10)+") points de RM  par niveau");
	appendText(span, arrTable[3].childNodes[1].childNodes[18].childNodes[3].childNodes[0].nodeValue+' (Total : ' + rmtotal + ')');
	arrTable[3].childNodes[1].childNodes[18].childNodes[3].replaceChild(span,arrTable[3].childNodes[1].childNodes[18].childNodes[3].childNodes[0]);
	span = document.createElement('SPAN');
	span.setAttribute("title",(Math.round(10*mm/nbjours)/10)+" ("+(Math.round(10*mmTroll/nbjours)/10)+") points de MM  par jour | "
		+(Math.round(10*mm/niveau)/10)+" ("+(Math.round(10*mmTroll/niveau)/10)+") points de MM  par niveau");
	appendText(span, arrTable[3].childNodes[1].childNodes[18].childNodes[3].childNodes[2].nodeValue+' (Total : ' + mmTroll + ')');
	arrTable[3].childNodes[1].childNodes[18].childNodes[3].replaceChild(span,arrTable[3].childNodes[1].childNodes[18].childNodes[3].childNodes[2]);
}

function setTotalPourcentages() {
	var node = arrTable[8].childNodes[1];	
	var listeComp = node.childNodes[2].childNodes[1].childNodes[0].childNodes[1];
	var listeSort = node.childNodes[2].childNodes[3].childNodes[0].childNodes[1];
	node.childNodes[0].childNodes[1].childNodes[0].childNodes[0].nodeValue += ' (Total : ' + creerInfoBulles(listeComp, "competences") + '%)';
	node.childNodes[0].childNodes[3].childNodes[0].childNodes[0].nodeValue += ' (Total : ' + creerInfoBulles(listeSort, "sortileges") + '%)';
}


// Textes des popups pour les comp�tences et sortil�ges

function competences(comp, niveau) {
	var texte = '';
	if(comp.indexOf('Acceleration du Metabolisme') != -1 && minuteFatigue != null)
		texte = '<b>1</b>PV = <b>'+minuteFatigue+'</b> minutes.';
	else if (comp.indexOf('Attaque Precise') != -1) {
		for(var i=Math.min(niveau+1,5);i>=1;i--)
		{
			if(i>niveau) texte += "<i>";
			texte += 'Attaque (niveau '+i+') : <b>' + Math.min(Math.floor(att*1.5), Math.floor(att+3*i)) + '</b> D6 ' + aff(attbonus+attbmm)+' => ';
			texte += '<b>' + (Math.floor(Math.min(Math.floor(att*1.5), Math.floor(att+3*i))* 7 / 2) + attbonus + attbmm) + '</b><br/>';
			if(i>niveau) texte += "</i>";
		}
		texte += 'D�g�ts : <b>' + deg + '</b> D3 ' + aff(degbonus+degbmm)+' => ';
		texte += '<b>' + degmoy + '/' + (degmoy + Math.floor(deg / 2) * 2) + '</b>';
	} else if(comp.indexOf('Balluchonnage') != -1) {
		texte = 'Un beau noeud �vite souvent de mauvaises surprises...	';
	} else if(comp.indexOf('Bidouille') != -1) {
		texte = 'Bidouiller un tr�sor permet de compl�ter le nom d\'un objet de votre inventaire avec le texte de son choix.';
	} else if (comp.indexOf('Botte Secrete') != -1) {
		texte = 'Attaque : <b>' + Math.floor(att / 2) + '</b> D6 ' + aff(Math.floor((attbonus+attbmm) / 2));
		texte += ' => <b>' + ((Math.floor(att / 2) * 7 / 2) + Math.floor((attbonus+attbmm) / 2)) + '</b><br/>';
		texte += 'D�g�ts : <b>' + Math.floor(att / 2) + '</b> D3 ' + aff(Math.floor((degbonus+degbmm) / 2));
		texte += ' => <b>' + (Math.floor(att / 2) * 2 + Math.floor((degbonus+degbmm) / 2)) + '/'
				+ (Math.floor(Math.floor(att / 2) * 1.5) * 2 + Math.floor((degbonus+degbmm) / 2)) + '</b>';
	} else if(comp.indexOf('Camouflage') != -1) {
		texte =  'Pour conserver son camouflage, <br>il faut r�ussir un jet sous:<hr/>';
		texte += 'D�placement: <b>'+setSortComp('Camouflage')+'</b>.';
		texte += 'Attaque: <b>perte automatique</b>.<br>';
		texte += 'Projectile Magique: <b>25%</b>.';
	} else if (comp.indexOf('Charger') != -1) {
		if (vuetotale <= 0)
			texte = '<b>Impossible de charger</b>';
		else {
			texte = 'Attaque : <b>' + att + '</b> D6 ' + aff(attbonus+attbmm);
			texte += ' => <b>' + attmoy + '</b><br/>';
			texte += 'D�g�ts : <b>' + deg + '</b> D3 ' + aff(degbonus+degbmm);
			texte += ' => <b>' + degmoy + '/' + (degmoy + Math.floor(deg / 2) * 2) + '</b>';
			var aux = Math.ceil(pvactuels / 10) + reg;
			var portee = Math.min(getPortee(aux), vuetotale);
			texte += '<br/>Port�e : <b>' + portee + '</b> case';
			if (portee > 1)
				texte += 's';			
		}
	} else if (comp.indexOf('Connaissance des Monstres') != -1) {
		texte = 'Port�e horizontale : <b>' + vuetotale + '</b> cases<br/>';
		texte += 'Port�e verticale : <b>' + Math.ceil(vuetotale / 2) + '</b> cases';
	} else if (comp.indexOf('Construire un Piege') != -1) {
		texte = 'D�gats du pi�ge � feu : <b>' + Math.floor((esq + vue) / 2) + '</b> D3<hr/>';
		texte += 'D�g�ts moyens : <b>' + Math.floor((esq + vue) / 2) * 2 + ' (';
		texte += resiste((esq + vue) / 2) + ')</b>';
	} else if (comp.indexOf('Contre-Attaquer') != -1) {
		texte = 'Attaque : <b>' + Math.floor(att / 2) + '</b> D6' + aff(Math.floor((attbonus+attbmm)/ 2));
		texte += ' => <b>' + (Math.floor(att / 2) * 3.5 + Math.floor((attbonus+attbmm) / 2))+"</b>";
		texte += '<br/>D�g�ts : <b>' + deg + '</b> D3 ' + aff(degbonus+degbmm);
		texte += ' => <b>' + (degmoy) + '/' + (degmoy + Math.floor(deg / 2) * 2) + '</b>';
	} else if (comp.indexOf('Coup de Butoir') != -1) {
		texte = 'Attaque : <b>' + att + '</b> D6 ' + aff(attbonus+attbmm);
		texte += ' => <b>' + attmoy+"</b>";
		for(var i=Math.min(niveau+1,5);i>=1;i--)
		{
			if(i>niveau) texte+="<i>";
			texte += '<br/>D�g�ts (niveau '+i+') : <b>' + Math.min(Math.floor(deg*1.5), Math.floor(deg+3*i)) + '</b> D3 ' + aff(degbonus+degbmm);
			texte += ' => <b>' + (degmoy + Math.min(Math.floor(deg / 2),Math.floor(3*i)) * 2)
				+ '/' + (degmoy + Math.min(Math.floor(deg / 2),Math.floor(3*i)) * 2 + Math.floor(deg / 2) * 2) + '</b>';
			if(i>niveau) texte+="</i>";
		}
	} else if(comp.indexOf('Deplacement Eclair') != -1) {
		texte = 'Permet d\'�conomiser <b>1</b> PA par rapport au d�placement classique';
	} else if(comp.indexOf('Dressage') != -1) {
		texte = 'Le dressage permet d\'apprivoiser un gowap redevenu sauvage ou un gnu sauvage.';
	} else if(comp.indexOf('Ecriture Magique') != -1) {
		texte = 'R�aliser la copie d\'un sortil�ge apr�s en avoir d�couvert la formule n�cessite de r�unir les composants de cette formule, d\'obtenir un parchemin vierge sur lequel �crire (par le biais de la comp�tence Grattage), et de r�cup�rer un champignon ad�quat pour confectionner l\'encre.';
	} else if (comp.indexOf('Frenesie') != -1) {
		texte = 'Attaque : <b>' + att + '</b> D6 ' + aff(attbonus+attbmm)+" => <b>"+attmoy+"</b>";
		texte += '<br/>D�g�ts : <b>' + deg + '</b> D3 ' + aff(degbonus+degbmm);
		texte += ' => <b>' + degmoy + '/' + (degmoy + Math.floor(deg / 2) * 2) + '</b>';
	} else if(comp.indexOf('Grattage') != -1) {
		texte = 'Permet de confectionner un Parchemin Vierge � partir de composants et de Gigots de Gob\'.'; 
	} else if(comp.indexOf('Hurlement Effrayant') != -1) {
		texte = 'Fait fuir un monstre si tout se passe bien.<br>Lui donne de gros bonus sinon.';
	} else if (comp.indexOf('Identification des Champignons') != -1) {
		texte = 'Port�e horizontale : <b>' + Math.ceil(vuetotale/2) + '</b> cases<br/>';
		texte += 'Port�e verticale : <b>' + Math.ceil(vuetotale / 4) + '</b> cases';
	} else if(comp.indexOf('Insultes') != -1) {
		texte = 'Port�e : <b>1</b> case (horizontale)';
	} else if (comp.indexOf('Lancer de Potions') != -1) {
		texte = 'Port�e : <b>' + (2 + Math.floor(vuetotale / 5)) + '</b> cases';
	} else if(comp.indexOf('Marquage') != -1) {
		texte = 'Marquage permet de rajouter un sobriquet � un monstre. Il faut bien choisir le nom � ajouter car celui-ci sera d�finitif. Il faut se trouver dans la m�me caverne que le monstre pour le marquer..';
	} else if(comp.indexOf('Melange magique') != -1) {
		texte = 'Cette Comp�tence permet d\'utiliser deux Potions pour en r�aliser une nouvelle qui aura comme effet la somme des effets des potions initiales.';
	} else if (comp.indexOf('Miner') != -1) {
		texte = 'Port�e horizontale officieuse : <b>' + (vuetotale*2) + '</b> cases<br/>';
		texte += 'Port�e verticale officieuse : <b>' + (Math.ceil(vuetotale / 2)*2) + '</b> cases';
	} else if(comp.indexOf('Necromancie') != -1) {
		texte = 'La N�cromancie permet � partir des composants d\'un monstre de faire "revivre" ce monstre.';
	} else if (comp.indexOf('Parer') != -1) {
		texte = 'Parade : <b>' + Math.floor(att / 2) + '</b> D6 ';
		texte += aff(Math.floor((attbonus+attbmm) / 2));
		texte += ' => <b>' + (Math.floor(att / 2) * 3.5 + Math.floor((attbonus+attbmm) / 2)) + '</b>';
	} else if (comp.indexOf('Pistage') != -1) {
		texte = 'Port�e horizontale : <b>' + vuetotale * 2 + '</b> cases<br/>';
		texte += 'Port�e verticale : <b>' + Math.ceil(vuetotale / 2) * 2 + '</b> cases';
	} if(comp.indexOf('Planter un champignon') != -1) {
		texte = 'Planter un Champignon est une comp�tence qui vous permet de cr�er des colonies d\'un type et d\'un go�t de champignon � partir de quelques exemplaires pr�alablement enterr�s.';
	} else if (comp.indexOf('Regeneration Accrue') != -1) {
		texte = 'R�g�n�ration : <b>' + Math.floor(pvtotal / 20) + '</b> D3<hr/>';
		texte += 'R�g�n�ration moyenne : <b>' + Math.floor(pvtotal / 20) * 2 + '</b>';
	} else 	if(comp.indexOf('Retraite') != -1) {
		texte = 'Vous jugez la situation avec sagesse et estimez qu\'il serait pr�f�rable de pr�parer un repli strat�gique pour d�concerter l\'ennemi et lui foutre une bonne branl�e ... plus tard. AHAHA ! Quelle intelligence d�moniaque..';
	} else if(comp.indexOf('Shamaner') != -1) {
		texte = 'Permet de contrecarrer certains effets des pouvoirs sp�ciaux des monstres en utilisant des champignons (de 1 � 3).';
	} else if(comp.indexOf('Tailler') != -1) {
		texte = 'Permet d\'augmenter sensiblement la valeur marchande de certain minerai. Mais cette op�ration d�licate n\'est pas sans risques...';
	}
	return texte;
}

function sortileges(sort) {
	var texte = '';
	if (sort.indexOf('Analyse Anatomique') != -1) {
		texte = 'Port�e horizontale : <b>' + Math.floor(vuetotale / 2) + '</b> cases<br/>';
		texte += 'Port�e verticale : <b>' + Math.floor(Math.ceil(vuetotale / 2) / 2) + '</b> cases';
	} else if (sort.indexOf('Armure Etheree') != -1)
		texte = 'Armure : <b>+' + reg + '</b>';
	else if (sort.indexOf('Augmentation') != -1 && sort.indexOf('Attaque') != -1)
		texte = 'Attaque Magique : <b>+' + (1 + Math.floor((att - 3) / 2)) + '</b>';
	else if (sort.indexOf('Augmentation') != -1 && sort.indexOf('Esquive') != -1)
		texte = 'Esquive : +<b>' + (1 + Math.floor((esq - 3) / 2)) + '</b>';
	else if (sort.indexOf('Augmentation des Degats') != -1)
		texte = 'D�g�ts Magiques : +<b>' + (1 + Math.floor((deg - 3) / 2)) + '</b>';
	else if (sort.indexOf('Bulle Anti-Magie') != -1)
		texte = 'RM : <b>+' + Math.floor(rm) + ' (Total : '+(rm+rm+rmbonus)+')</b><br/>MM : <b>-' + Math.floor(mm) + ' (Total : '+(mmbonus)+')</b>';
	else if (sort.indexOf('Bulle Magique') != -1)
		texte = 'MM : <b>+' + Math.floor(mm) + ' (Total : '+(mm+mm+mmbonus)+')</b><br/>RM : <b>-' + Math.floor(rm) + ' (Total : '+(rmbonus)+')</b>';
	else if (sort.indexOf('Explosion') != -1) {
		texte = 'Attaque : <b>Automatique</b><br/>';
		texte += 'D�g�ts : <b>' + Math.floor((deg + Math.floor(pvtotal / 10)) / 2 + 1) + '</b> D3 '+aff(degbmm);
		texte += ' => <b>' + (Math.floor((deg + Math.floor(pvtotal / 10)) / 2 + 1) * 2 + degbmm) + ' (';
		texte += resiste((deg + Math.floor(pvtotal / 10)) / 2 + 1) + ')</b>';
	} else if (sort.indexOf('Faiblesse Passagere') != -1)
		texte = 'D�g�ts : <b>-' + Math.floor((Math.floor((pvactuels - 30) / 10) + deg - 3) / 2 + 1) + '</b>';
	else if (sort.indexOf('Flash Aveuglant') != -1)
		texte = 'Vue, Attaque, Esquive : <b>-' + (1 + Math.floor(vue / 5)) + '</b>';
	else if (sort.indexOf('Glue') != -1)
		texte = 'Port�e : <b>' + (1 + Math.floor(vuetotale / 3)) + '</b> cases';
	else if (sort.indexOf('Griffe du Sorcier') != -1) {
		texte = 'Attaque : <b>' + att + '</b> D6 '+aff(attbmm);
		texte += ' => <b>' + (Math.floor(att * 3.5) + attbmm) + '</b>'+'<br/>';
		texte += 'D�g�ts : <b>' + Math.floor(deg / 2) + '</b> D3 '+aff(degbmm);
		texte += ' => <b>' + (Math.floor(deg / 2) * 2 + degbmm) + '/' + (Math.floor(Math.floor(deg / 2) * 1.5) * 2 + degbmm);
		texte += ' (' + resiste(deg / 2) + '/' + resiste(Math.floor(deg / 2) * 1.5) + ')</b></br>';
		texte += 'Dur�e : <b>' + (1 + Math.floor(vue / 5)) + '</b> tours<br/>';
		texte += 'Poison : <b>' + (1 + Math.floor(pvtotal / 30)) + '</b> D3';
		texte += ' => <b>' + (1 + Math.floor(pvtotal / 30)) * 2 + '</b>';
	} else if (sort.indexOf('Hypnotisme') != -1) {
		texte = 'Esquive : <b>-' + Math.floor(esq * 1.5) + '</b> D�s ';
		texte += '(<b>-' + Math.floor(esq / 3) + '</b> D�s )';
	} else if(sort.indexOf('Identification des tresors') != -1) {
		texte = 'Permet de connaitre les caract�ristiques et effets pr�cis d\'un tr�sor.';
	} else if(sort.indexOf('Invisibilite') != -1) {
		texte = 'Un troll invisible est ind�tectable m�me quand on se trouve sur sa zone. Toute action physique ou sortil�ge d\'attaque fait dispara�tre l\'invisibilit�.';
	} else if (sort.indexOf('Projectile Magique') != -1) {
		texte = 'Attaque : <b>' + vue + '</b> D6 '+aff(attbmm);
		texte += ' => <b>' + (Math.floor(vue * 3.5)+attbmm) + '</b>';
		texte += '<br/>D�g�ts : <b>' + Math.floor(vue / 2) + '</b> D3 '+aff(degbmm);
		texte += ' => <b>' + (Math.floor(vue / 2) * 2 + degbmm) + '/';
		texte += (Math.floor(Math.floor(vue / 2) * 1.5) * 2 + degbmm) + ' (';
		texte += resiste(vue / 2) + '/';
		texte += resiste(Math.floor(vue / 2) * 1.5) + ')</b>';
		var portee = getPortee(vuetotale);
		texte += '<br/>Port�e : <b>' + portee + '</b> case';
		if (portee > 1)
			texte += 's';
	} else if(sort.indexOf('Projection') != -1) {
		texte = 'Si le jet de r�sistance de la victime est rat�:<br>';
		texte +='la victime est <b>d�plac�e</b> et perd <b>1D6</b> en Esquive<hr/>';
		texte += 'Si le jet de r�sistance de la victime est r�ussi:<br>';
		texte +='la victime ne <b>bouge pas</b> mais perd <b>1D6</b> en Esquive.';
	} else if (sort.indexOf('Rafale Psychique') != -1) {
		texte = 'Attaque : <b>Automatique</b><br/>';
		texte += 'D�g�ts : <b>' + deg + '</b> D3 '+aff(degbmm);
		texte += ' => <b>' + (deg * 2 + degbmm) + ' (' + resiste(deg) + ')</b><br/>';
		texte += 'R�g�n�ration : <b>-' + deg + '</b>';
	} else if(sort.indexOf('Sacrifice') != -1) {
		texte += 'Perte : Sacrifice + 1D3 + 1D3 par tranche 5PV.<hr/>';
		texte += '<i><u>Exemple</i></u>:<BR>';
		texte += 'soin de <b>4</b>PV, perte de  <b>5</b> � <b>7</b>PV<BR>';
		texte += 'soin de <b>9</b>PV, perte de <b>11</b> � <b>15</b>PV<BR>';
		texte += 'soin de <b>14</b>PV, perte de <b>17</b> � <b>23</b>PV<BR>';
		texte += 'soin de <b>19</b>PV, perte de <b>23</b> � <b>31</b>PV<BR>';
		texte += 'soin de <b>24</b>PV, perte de <b>29</b> � <b>39</b>PV<BR>';
		texte += 'soin de <b>29</b>PV, perte de <b>35</b> � <b>47</b>PV';
	} else if(sort.indexOf('Telekinesie') != -1) {
		texte = 'Port�e (horizontale uniquement) :<hr/>';
		var  vt= Math.floor(vuetotale/2) + 2; if (vt<0) vt=0;
		texte += '<b>'+vt+'</b>: Les tr�sors d\'une Plum \' et Tr�s L�ger<br>';
		var  vt= Math.floor(vuetotale/2) + 1; if (vt<0) vt=0;
		texte += '<b>'+vt+'</b>: Les tr�sors L�ger<br>';
		var  vt= Math.floor(vuetotale/2); if (vt<0) vt=0;
		texte += '<b>'+vt+'</b>: Les tr�sors Moyen<br>';
		var  vt= Math.floor(vuetotale/2)-1; if (vt<0) vt=0;
		texte += '<b>'+vt+'</b>: Les tr�sors Lourd<br>';
		var  vt= Math.floor(vuetotale/2)-2; if (vt<0) vt=0;
		texte += '<b>'+vt+'</b>: Les tr�sors Tr�s Lourd et d\'une Ton\'';
	} else if (sort.indexOf('Teleportation') != -1) {
		var pmh = Math.floor(20 + vue + getPortee(mmTroll / 5));
		var pmv = Math.floor(3 + getPortee(mmTroll / 5) / 3);
		texte = 'Port�e horizontale  : <b>' + pmh + '</b> cases<br/>Port�e verticale : <b>' + pmv + '</b> cases<br/>';
		texte += '<hr/>';
		texte += 'X compris entre ' + (posX - pmh) + ' et ' + (posX + pmh) + '<br/>';
		texte += 'Y compris entre ' + (posY - pmh) + ' et ' + (posY + pmh) + '<br/>';
		texte += 'N compris entre ' + (posN - pmv) + ' et ' + Math.min(-1, (posN + pmv)) + '<br/>';
	} else if (sort.indexOf('Vampirisme') != -1) {
		texte = 'Attaque : <b>' + Math.floor(deg * 2 / 3) + '</b> D6 '+aff(attbmm);
		texte += ' => <b>' + Math.floor((Math.floor(deg * 2 / 3)) * 3.5 + attbmm) + '</b>';
		texte += '<br/>D�g�ts : <b>' + deg + '</b> D3 '+aff(degbmm);
		texte += ' => <b>' + (deg * 2 + degbmm) + '/' + (Math.floor(deg * 1.5) * 2 + degbmm) + ' ('
				+ resiste(deg) + '/' + resiste(deg * 1.5) + ')</b>';
	} else if (sort.indexOf('Vision Accrue') != -1)
		texte = 'Vue : <b>+' + Math.floor(vue / 2) + '</b>';
	else if(sort.indexOf('Vision lointaine') != -1) {
		texte = 'En ciblant une zone situ�e n\'importe o� dans le Monde Souterrain, votre Tr�ll peut voir comme s\'il s\'y trouvait.';
	} else if (sort.indexOf('Voir le Cache') != -1) {
		texte = 'Port�e horizontale : <b>' + Math.floor(vuetotale / 2) + '</b> cases<br/>';
		texte += 'Port�e verticale : <b>' + Math.floor(vuetotale / 4) + '</b> cases';
	} else if (sort.indexOf('Vue Troublee') != -1)
		texte = 'Vue : <b>-' + Math.floor(vue / 3) + '</b>';
	return texte;
}

// Fonctions cr�ant les infos-bulles

function creerBulle() {
	var newTable = document.createElement('table');
	newTable.setAttribute('id', 'bulle');
	newTable.setAttribute('class', 'mh_tdborder');
	newTable.setAttribute('width', '300');
	newTable.setAttribute('border', '0');
	newTable.setAttribute('cellpadding', '5');
	newTable.setAttribute('cellspacing', '1');
	newTable.setAttribute('style', 'position:absolute;visibility:hidden;z-index:800;height:auto;');
	var tr = appendTr(newTable, 'mh_tdtitre');
	appendTdText(tr, 'Titre');
	tr = appendTr(newTable, 'mh_tdpage');
	appendTdText(tr, 'Contenu');
	var aList = document.getElementsByTagName('a');
	aList[aList.length - 1].parentNode.appendChild(newTable);
}

function setSortComp(nom,pourcentage,niveau) {
	if(niveau == null)	niveau = 1;
	pourcentage = parseInt(pourcentage);

}

function creerInfoBulles(liste, fonction) {

	var i = 0;
	var pourcen = 0;
	while (liste.childNodes[i] != null) {
		if (liste.childNodes[i].childNodes[3] != null) {
			var nom = trim(str_woa(liste.childNodes[i].childNodes[3].childNodes[0].firstChild.nodeValue));
			var str = liste.childNodes[i].childNodes[5].childNodes[0].childNodes[0].nodeValue;
			var niveau = parseInt(str.substring(str.indexOf('niveau')+7,str.indexOf(':')-1));
			creerInfoBulle(liste.childNodes[i].childNodes[3].childNodes[0], fonction,niveau);
			pourcen += str.substring(str.indexOf(':') + 1, str.indexOf('%')) * 1;
			setSortComp(nom,str.substring(str.indexOf(':') + 1, str.indexOf('%')) * 1,niveau);
			for (var j = 3; j < liste.childNodes[i].childNodes[5].childNodes.length; j += 2) {
				str = liste.childNodes[i].childNodes[5].childNodes[j].nodeValue;
				niveau = parseInt(str.substring(str.indexOf('niveau')+7,str.indexOf(':')-1));
				str = str.substring(str.indexOf(':') + 1, str.indexOf('%'));
				setSortComp(nom,str * 1,niveau);
				pourcen += str * 1;
			}
		}
		i += 2;
	}
	return pourcen;
}

function creerInfoBulle(noeud, fonction, niveau) {
	var nom = trim(str_woa(noeud.firstChild.nodeValue));
	noeud.setAttribute("nom",nom);
	noeud.setAttribute("fonction",fonction);
	noeud.setAttribute("niveau",niveau);
	noeud.addEventListener("mouseover", infoBulle,true);
	noeud.addEventListener("mouseout", cacherInfoBulle,true);
}

function infoBulle(evt) {
	var nom = this.getAttribute("nom");
	var fonction = this.getAttribute("fonction");
	var niveau = parseInt(this.getAttribute("niveau"));
	var str="";
	if(fonction=="competences")
		str=competences(nom,niveau);
	else if(fonction=="sortileges")
		str=sortileges(nom,niveau);
	if (str == "")
		return;
	
	var xfenetre, yfenetre, xpage, ypage, element = null;
	var offset = 15;
	var bulleWidth = 300;
	if (!hauteur)
		hauteur = 50;
	element = document.getElementById('bulle');
	xfenetre = evt.clientX;
	yfenetre = evt.clientY;
	xpage = xfenetre;
	ypage = yfenetre;
	if (evt.pageX)
		xpage = evt.pageX;
	if (evt.pageY)
		ypage = evt.pageY;
	if (element) {
		bulleStyle = element.style;
//		element.childNodes[0].childNodes[0].innerHTML = '<b>' + nom + '</b>';
        element.childNodes[0].childNodes[0].innerHTML = '<TABLE><TR><TD><TD><TD valign=center> <b>'+nom+'</b></TD></TR></TABLE>';
		element.childNodes[1].childNodes[0].innerHTML = str;
	}

	if (bulleStyle) {
		if (xfenetre > bulleWidth + offset)
			xpage -= bulleWidth + offset;
		else
			xpage += offset;
		if (yfenetre > hauteur + offset)
			ypage -= hauteur + offset;
		bulleStyle.width = bulleWidth;
		bulleStyle.left = xpage + 'px';
		bulleStyle.top = ypage + 'px';
		bulleStyle.visibility = "visible";
	}
}

function cacherInfoBulle() {
	if (bulleStyle)
		bulleStyle.visibility = "hidden";
}

/*********************************************************************************
*   fonction ZZ            *
*********************************************************************************/
/*function setNewsZZ(news) {
    IdNewZZ=news*1;
    if (zzlink) {
     	var cnews=getCookie("ZZ_NewsID")*1;
     	//alert('Cookie='+cnews+' ZZ='+news);
     	if (cnews<news) {
	        zzlink.innerHTML="<FONT SIZE=-1>(Info ZZ: <IMG height=15px SRC=/mountyhall/Images/New.gif>)</FONT>";   
		}
    }
} 

function newZZ() {    
	var TiD=getCookie("NUM_TROLL");
    if (IdNewZZ>0) {
        var expdate = new Date ();
        expdate.setTime (expdate.getTime() + (24 * 60 * 60 * 1000 * 712));
        setCookie("ZZ_NewsID",IdNewZZ,expdate,"/");
    }
    var Source="MH_Profil$";
	if ((getCookie("IT_"+getCookie('NUM_TROLL'))=="ITM$") && (getCookie("INFOSSGG_"+getCookie('NUM_TROLL')).split('$').length==2)) {
	    var t=getCookie("INFOSSGG_"+TiD).split('$');  
	    Source=Source+escape(getCookie("INFOSSGG_"+getCookie('NUM_TROLL')));
	} else {
	 	var t = new Array(); t[0]=""; t[1]=""; 
	    Source=Source+"StandAlone$StandAlone";
	}	    
	var version="1.0.3";
	try {version=ZZversion;} catch (e) {}			
    Source=Source+"$"+version;		
		
    var PG=escape(getCookie("MH_Package"));
 	document.location.href=ZZDB+'/zoryazilla.php?&Source='+Source+'&action=Newzz&TiD='+TiD+'&CoterieName='+escape(t[0])+'&CoteriePWD='+escape(t[1])+'&PG='+escape(PG);
} 
*/
/*********************************************************************************
*   Main MZ             *
*********************************************************************************/
var hauteur = 50;
var bulleStyle = null;

var arrTable;
var arrTR;

var posX, posY, posN;
var vue, vuetotale;
var pvtotal, pvactuels;
var minuteFatigue;
var reg, regbonus, regmoy;
var att, attbonus, attmoy;
var esq, esqbonus, esqmoy;
var deg, degbonus, degmoy;
var arm, armbonus;
var rm, mm, rmtotal;
var nbattaques;
var nbjours;
var niveau;

init();
creerBulle();
setNextDla();
setPiForNextLevel();
setFatigue();
setCurrentEsquive();
setRatioKillDeath();
setTotalMagie();
setTotalPourcentages();
setLieu();

/*********************************************************************************
*   MMain ZZ            *
*********************************************************************************/
/*
var TiD=arrTR[4].childNodes[3].childNodes[1].getAttribute('href');
TiD=TiD.slice(TiD.indexOf('(')+1,TiD.indexOf(','));
var tName=arrTR[4].childNodes[3].childNodes[1].childNodes[0].nodeValue;
tName=tName.substring(tName.indexOf('-')+2);
var tRace=arrTR[4].childNodes[3].childNodes[4].nodeValue.split(':');
var pTroll=arrTR[6].childNodes[3].childNodes[0].nodeValue.split('|');
var pX=trim(pTroll[0].slice(3));
var pY=trim(pTroll[1].slice(4));
var pN=trim(pTroll[2].slice(4));
var tCam=0;

if (typeof(arrTR[6].childNodes[3].childNodes[1].childNodes[1].childNodes[2])!='undefined') {
    if(arrTR[6].childNodes[3].childNodes[1].childNodes[1].childNodes[2].nodeValue.indexOf('[Camoufl�]')>0) {
        tCam=1; // Le troll est Camoufl�
    }
} 

var IdNewZZ=0;
var data="&TypeData=Profil";
data=data+"&Troll="+escape(trim(tName))+"&Race="+trim(tRace[1])+"&Niveau="+niveau;
data=data+"&TiD="+TiD+"&PVMax="+pvtotal+"&PV="+pvactuels;
data=data+"&PA="+trim(arrTR[5].childNodes[3].childNodes[5].childNodes[0].nodeValue).substr(0,1);;
data=data+"&DLA="+trim(arrTR[5].childNodes[3].childNodes[1].childNodes[0].nodeValue).replace(" ", "_");
var TimeStamp=arrTable[arrTable.length-2].childNodes[1].childNodes[0].childNodes[1].childNodes[3].nodeValue;
TimeStamp=TimeStamp.substr(TimeStamp.indexOf('GMT')-20, 19);
TimeStamp=TimeStamp.replace(" ", "_");
data=data+"&TimeStamp="+TimeStamp;
data=data+"&X="+pX+"&Y="+pY+"&N="+pN+"&Camoufle="+tCam;  

var newScriptZ = document.createElement('script');
newScriptZ.setAttribute('language','JavaScript');
newScriptZ.setAttribute('src',ZZDB+'/mzData.php?'+data);
document.body.appendChild(newScriptZ);
var nodes = document.evaluate("//B/text()[contains(.,'MON PROFIL')]", document, null,XPathResult.ORDERED_NODE_SNAPSHOT_TYPE, null);
if (nodes.snapshotLength==1) {
    var node = nodes.snapshotItem(0);
    node.nodeValue="MON PROFIL  ";
    node.parentNode.appendChild(document.createElement('A'));
    node.parentNode.childNodes[1].setAttribute('CLASS','AllLinks');
    node.parentNode.childNodes[1].setAttribute('href','javascript:newZZ()');
    var zzlink=document.createElement('B')
    zzlink.innerHTML="<FONT SIZE=-1>(Info ZZ)</FONT>";   
    node.parentNode.childNodes[1].appendChild(zzlink);
}*/
