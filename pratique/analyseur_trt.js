var race="";


//compétences et sortilèges de race
var competenceRace = new Array;
competenceRace['tom'] = "Camouflage";
competenceRace['durak'] = "Régénération accrue";
competenceRace['kastar'] = "Accélération métabolique";
competenceRace['skrim'] = "Botte secrète";

var sortilegeRace = new Array;
sortilegeRace['tom'] = "Projectile Magique";
sortilegeRace['durak'] = "Rafale psychique";
sortilegeRace['kastar'] = "Vampirisme";
sortilegeRace['skrim'] = "Hypnotisme";

//coût par carac
var cout = new Array;
cout['ATT'] = 16;
cout['ESQ'] = 16;
cout['DEG'] = 16;
cout['REG'] = 30;
cout['VUE'] = 16;
cout['PV'] = 16;
cout['DLA'] = 18;

//nombre d'amélioration par carac
var amelio = new Array;
amelio['ATT'] = 0;
amelio['ESQ'] = 0;
amelio['DEG'] = 0;
amelio['REG'] = 0;
amelio['VUE'] = 0;
amelio['PV'] = 0;
amelio['DLA'] = 0;

//base par race et par carac
var base = new Array;
base["tom"]=new Array;
base["durak"]=new Array;
base["kastar"]=new Array;
base["skrim"]=new Array;
base[""]=new Array;
base["tom"]['ATT'] = 3;
base["tom"]['ESQ'] = 3;
base["tom"]['DEG'] = 3;
base["tom"]['REG'] = 1;
base["tom"]['VUE'] = 4;
base["tom"]['PV'] = 30;
base["tom"]['DLA'] = 720;
base["durak"]['ATT'] = 3;
base["durak"]['ESQ'] = 3;
base["durak"]['DEG'] = 3;
base["durak"]['REG'] = 1;
base["durak"]['VUE'] = 3;
base["durak"]['PV'] = 40;
base["durak"]['DLA'] = 720;
base["kastar"]['ATT'] = 3;
base["kastar"]['ESQ'] = 3;
base["kastar"]['DEG'] = 4;
base["kastar"]['REG'] = 1;
base["kastar"]['VUE'] = 3;
base["kastar"]['PV'] = 30;
base["kastar"]['DLA'] = 720;
base["skrim"]['ATT'] = 4;
base["skrim"]['ESQ'] = 3;
base["skrim"]['DEG'] = 3;
base["skrim"]['REG'] = 1;
base["skrim"]['VUE'] = 3;
base["skrim"]['PV'] = 30;
base["skrim"]['DLA'] = 720;
base[""]['ATT'] = 3;
base[""]['ESQ'] = 3;
base[""]['DEG'] = 3;
base[""]['REG'] = 1;
base[""]['VUE'] = 3;
base[""]['PV'] = 30;
base[""]['DLA'] = 720;

//carac est en train d'être éditée
var isEdit = new Array;
isEdit["ATT"] = false;
isEdit["ESQ"] = false;
isEdit["DEG"] = false;
isEdit["REG"] = false;
isEdit["VUE"] = false;
isEdit["PV"] = false;
isEdit["DLA"] = false;

//valeurs de pi
var piDepenses = new Number(0);
var piDepensesCarac = new Number(0);
var piDepensesComp = new Number(0);

//********************************************************************
//************************ TRAITEMENTS DIVERS ************************
//********************************************************************

function inverser(str1, str2) {
	obj1 = document.getElementById(str1);
	obj2 = document.getElementById(str2);
	var temp = obj1.innerHTML;
	obj1.innerHTML = obj2.innerHTML;
	obj2.innerHTML = temp;
}

function calculePi(niv) {
	var nivSup = niv + 1;
	var res = (5*nivSup*nivSup + 5*nivSup - 10) -1;
	return res;
}

function calculeNiv(pi) {
	var delta = 2.25+0.2*pi;
	var resFloat = -0.5 + Math.sqrt(delta);
	var res = Math.floor(resFloat);
	return res;
}

function recalculePi(obj) {
	var pi = 0;
	if (obj.value!="" && obj.value!="0")
		pi = calculePi(new Number(obj.value));

	document.getElementById("piReel").value = pi;
	setPiReel(false);
	recalculePiRestants();
}

function recalculeNiv(obj) {
	var niv = 1;
	if (obj.value!="" && obj.value!="0")
		niv = calculeNiv(new Number(obj.value));

	document.getElementById("nivReel").value = niv;
}

function changeRace(obj) {
	race = obj.value
	document.getElementById("compRace").innerHTML = competenceRace[race];
	document.getElementById("sortRace").innerHTML = sortilegeRace[race];
	calculCoutCaracs();
	setDataCompSort();
	reafficheTout();
}

function calculCoutCaracs() {
	cout['ATT'] = 16;
	cout['ESQ'] = 16;
	cout['DEG'] = 16;
	cout['REG'] = 30;
	cout['VUE'] = 16;
	cout['PV'] = 16;
	cout['DLA'] = 18;

	switch (race) {
		case "tom" : cout['VUE']=12; break;
		case "durak" : cout['PV']=12; break;
		case "kastar" : cout['DEG']=12; break;
		case "skrim" : cout['ATT']=12; break;
	}

	recalculeCoutPiCaracs();
}

function modifier(obj,carac) {
	obj.value="";
	if (!isEdit[carac]) inverser("boutons"+carac,"autresBoutons"+carac);
	isEdit[carac] = true;
}

function valider(carac) {
	var nvCarac = document.getElementById(carac).value;

	if (carac=="PV") {
		nvCarac=Math.max(base[race][carac], nvCarac);
		nvCarac = nvCarac - nvCarac%10;
		amelio[carac] = (nvCarac - base[race][carac])/10;

	} else if (carac=="DLA") {
		//rien
	} else {
		nvCarac=Math.max(base[race][carac], nvCarac);
		amelio[carac] = nvCarac - base[race][carac];
	}

	if (isEdit[carac]) inverser("boutons"+carac,"autresBoutons"+carac);
	isEdit[carac] = false;

	recalculeCoutPiCaracs();
	setDataCompSort();
	affiche(carac);
}

function incr(obj,carac) {
	if (carac=="DLA" && amelio["DLA"]>=10)
		{}//on ne fait rien
	else
		amelio[carac]++;
	recalculeCoutPiCaracs();
	setDataCompSort();
	affiche(carac);
}

function decr(obj,carac) {
	if (amelio[carac]>0) amelio[carac]--;
	recalculeCoutPiCaracs();
	setDataCompSort();
	affiche(carac);
}

function affiche(carac) {
	var valeur;
	valeur = base[race][carac] + amelio[carac];

	switch (carac)
	{
		case "ATT" :
		case "ESQ" :
			valeur += "D6";
			break;
		case "DEG" :
		case "REG" :
			valeur += "D3";
			break;
		case "VUE" :
			valeur += " cases";
			break;
		case "PV" :
			valeur = base[race][carac] + amelio[carac]*10;
			break;
		case "DLA" :
			valeur = afficheDla(amelio['DLA']);
			break;
	}

	document.getElementById(carac).value = valeur;
}

function afficheDla(nbAmelio) {
	var tempsMin = base[race]['DLA']-1.5*nbAmelio*(21-nbAmelio);
	var temps = new Date(0,0,0,0,tempsMin,0);

	var minutes = temps.getMinutes().toString();
	if (minutes.length==1) minutes = "0"+minutes;
	valeur = temps.getHours() + "h" + minutes;

	return valeur;
}

function reafficheTout() {
	affiche('ATT');
	affiche('ESQ');
	affiche('DEG');
	affiche('REG');
	affiche('VUE');
	affiche('PV');
	affiche('DLA');
}

function coche(obj) {
	if (obj.checked) piDepensesComp=piDepensesComp+new Number(obj.value);
	else piDepensesComp-=new Number(obj.value);
	setDataCompSort();
	recalculeCoutTotalPi();
}

function recalculeCoutPiCaracs() {
	piDepensesCarac = new Number(0);
	piDepensesCarac += cout['ATT'] * sumAmelio(amelio['ATT']);
	piDepensesCarac += cout['ESQ'] * sumAmelio(amelio['ESQ']);
	piDepensesCarac += cout['DEG'] * sumAmelio(amelio['DEG']);
	piDepensesCarac += cout['REG'] * sumAmelio(amelio['REG']);
	piDepensesCarac += cout['VUE'] * sumAmelio(amelio['VUE']);
	piDepensesCarac += cout['PV'] * sumAmelio(amelio['PV']);
	piDepensesCarac += cout['DLA'] * sumAmelio(amelio['DLA']);

	recalculeCoutTotalPi();
}

function sumAmelio(n) {
	return n*(n+1)/2;
}

function recalculeCoutTotalPi() {
	piDepenses = new Number(piDepensesCarac) + new Number(piDepensesComp);
	document.getElementById("piNecessaires").value = piDepenses;
	document.getElementById("nivNecessaire").value = calculeNiv(piDepenses);

	recalculePiRestants();
}

function recalculePiRestants() {
	var piDispos = document.getElementById("piReel").value;
	document.getElementById("piRestants").value = piDispos - piDepenses;
}

function setPiReel(bool) {
	if (bool)
		document.getElementById("isPiReels").innerHTML = "réels";
	else
		document.getElementById("isPiReels").innerHTML = "estimés";
}

function afficheTout()
{
	var chaine = "ATT : " + cout['ATT'] + " PI\n"
	chaine = chaine + "ESQ : " + cout['ESQ'] + " PI\n"
	chaine = chaine + "DEG : " + cout['DEG'] + " PI\n"
	chaine = chaine + "REG : " + cout['REG'] + " PI\n"
	chaine = chaine + "VUE : " + cout['VUE'] + " PI\n"
	chaine = chaine + "PV : " + cout['PV'] + " PI\n"
	chaine = chaine + "DLA : " + cout['DLA'] + " PI\n"
	alert(chaine);
}

//*************************************************************************
//************************ CALCULS DES COMPETENCES ************************
//*************************************************************************

function setDataCompSort() {
	setDataCompRace();
	setDataAp();
	setDataCharger();
	setDataPiege();
	setDataCa();
	setDataCdb();
	setDataLdp();
	setDataParer();

	setDataSortRace();
	setDataAe();
	setDataAda();
	setDataAde();
	setDataAdd();
	setDataExplo();
	setDataFp();
	setDataTk();
	setDataFa();
	setDataTp();
	setDataGlue();
	setDataVa();
	setDataGds();
	setDataVlc();
	setDataVt();
}

function calculPortee(val) {
	val = new Number(val);
	return Math.ceil(  ( Math.sqrt(19+8*(val+3)) - 7 )  /  2  );
}

function setDataCompRace() {
	var contenu = "";
	switch (race) {
	case "tom" :
		//rien
		break;
	case "durak" :
		contenu = " : régénération " + Math.floor((amelio["PV"] + base["durak"]["PV"])/20) + "D3";
		break;
	case "kastar " :
		//rien
		break;
	case "skrim" :
		var temp = Math.floor((amelio['ATT']+base["skrim"]["ATT"])/2);
		contenu = " : attaque " + temp + "D6, dégâts " + temp + "D3";
		break;
	}

	document.getElementById('dataCompRace').innerHTML = contenu;
}


function setDataAp() {
	if (!document.getElementById('AP').checked)  {
		document.getElementById('dataAp').innerHTML = "";
	} else {
		var deAtt = Math.floor( (amelio['ATT']+base[race]['ATT'])*1.5 );
		var contenu = " : attaque " + deAtt + "D6, dégâts " + (amelio['DEG'] + base[race]['DEG']) + "D3";
		document.getElementById('dataAp').innerHTML = contenu;
	}
}

function setDataCharger() {
	if (!document.getElementById('Charger').checked)  {
		document.getElementById('dataCharger').innerHTML = "";
	} else {
		var total = Math.floor( amelio['PV'] + base[race]['PV']/10 + amelio['REG'] + base[race]['REG']);
		var contenu = " : portée max " + calculPortee(total) + " cases";
		document.getElementById('dataCharger').innerHTML = contenu;
	}
}

function setDataPiege() {
	if (!document.getElementById('Piege').checked)  {
		document.getElementById('dataPiege').innerHTML = "";
	} else {
		var deDeg = Math.floor((amelio['ESQ'] + base[race]['ESQ'] + amelio['VUE'] + base[race]['VUE'])/2);
		var contenu = " : dégâts " + deDeg + "D3";
		document.getElementById('dataPiege').innerHTML = contenu;
	}
}

function setDataCa() {
	if (!document.getElementById('CA').checked)  {
		document.getElementById('dataCa').innerHTML = "";
	} else {
		var deAtt = Math.floor( (amelio['ATT']+base[race]['ATT'])/2 );
		var contenu = " : attaque " + deAtt + "D6, dégâts " + (amelio['DEG'] + base[race]['DEG']) + "D3";
		document.getElementById('dataCa').innerHTML = contenu;
	}
}

function setDataCdb() {
	if (!document.getElementById('CdB').checked)  {
		document.getElementById('dataCdb').innerHTML = "";
	} else {
		var deDeg = Math.floor( (amelio['DEG']+base[race]['DEG'])*1.5 );
		var contenu = " : attaque " + (amelio['ATT'] + base[race]['ATT']) + "D6, dégâts " + deDeg + "D3";
		document.getElementById('dataCdb').innerHTML = contenu;
	}
}

function setDataLdp() {
	if (!document.getElementById('LdP').checked)  {
		document.getElementById('dataLdp').innerHTML = "";
	} else {
		var portee = 2 + Math.floor((amelio['VUE']+base[race]['VUE'])/5);
		var sansMalus = Math.floor((amelio['VUE']+base[race]['VUE'])/10)+1;
		var contenu = " : portée max " + portee + " cases, sans malus " + sansMalus + " cases";
		document.getElementById('dataLdp').innerHTML = contenu;
	}
}

function setDataParer() {
	if (!document.getElementById('Parer').checked)  {
		document.getElementById('dataParer').innerHTML = "";
	} else {
		var parade = Math.floor( (amelio['ATT']+base[race]['ATT'])/2 );
		var contenu = " : jet de parade " + parade + "D6";
		document.getElementById('dataParer').innerHTML = contenu;
	}
}

function setDataSortRace() {
	var contenu = "";

	switch (race) {
	case "tom" :
		var temp= amelio['VUE']+base["tom"]['VUE'];
		contenu = " : attaque " + temp + "D6, dégâts " + Math.floor(temp/2) + "D3";
		break;
	case "durak" :
		var temp= amelio['DEG']+base["durak"]['DEG'];
		contenu = " : dégâts " + temp + "D3";
		break;
	case "kastar" :
		var temp= amelio['DEG']+base["kastar"]['DEG'];
		contenu = " : attaque " + Math.floor(temp*2/3) + "D6, dégâts " + temp + "D3";
		break;
	case "skrim" :
		var temp = amelio['ESQ'] + base["skrim"]["ESQ"];
		contenu = " : -" + Math.floor(temp*1.5) + "D6 d'esquive, -" + Math.floor(temp*1/3) + "D6 en résisté";
		break;
	}

	document.getElementById('dataSortRace').innerHTML = contenu;
}

function setDataAe() {
	if (!document.getElementById('AE').checked)  {
		document.getElementById('dataAe').innerHTML = "";
	} else {
		var contenu = " : armure magique +" + (amelio['REG']+base[race]['REG']);
		document.getElementById('dataAe').innerHTML = contenu;
	}
}

function setDataAda() {
	if (!document.getElementById('AdA').checked)  {
		document.getElementById('dataAda').innerHTML = "";
	} else {
		var temp = 1 + Math.floor( (amelio['ATT']+base[race]['ATT']-3) / 2 )
		var contenu = " : bonus d'attaque +" + temp ;
		document.getElementById('dataAda').innerHTML = contenu;
	}
}

function setDataAde() {
	if (!document.getElementById('AdE').checked)  {
		document.getElementById('dataAde').innerHTML = "";
	} else {
		var temp = 1 + Math.floor( (amelio['ESQ']+base[race]['ESQ']-3) / 2 )
		var contenu = " : bonus d'esquive +" + temp ;
		document.getElementById('dataAde').innerHTML = contenu;
	}
}

function setDataAdd() {
	if (!document.getElementById('AdD').checked)  {
		document.getElementById('dataAdd').innerHTML = "";
	} else {
		var temp = 1 + Math.floor( (amelio['DEG']+base[race]['DEG']-3) / 2 )
		var contenu = " : bonus de dégâts +" + temp ;
		document.getElementById('dataAdd').innerHTML = contenu;
	}
}

function setDataExplo() {
	if (!document.getElementById('Explo').checked)  {
		document.getElementById('dataExplo').innerHTML = "";
	} else {
		var temp = 1 + Math.floor( (amelio['DEG']+base[race]['DEG']+amelio['PV']+base[race]['PV']/10) / 2 )
		var contenu = " : dégâts max " + temp + "D3" ;
		document.getElementById('dataExplo').innerHTML = contenu;
	}
}

function setDataFp() {
	if (!document.getElementById('FP').checked)  {
		document.getElementById('dataFp').innerHTML = "";
	} else {
		var temp = 1 + Math.floor( (amelio['DEG']+base[race]['DEG']+amelio['PV']+base[race]['PV']/10-6) / 2 )
		var contenu = " : malus max aux dégâts -" + temp ;
		document.getElementById('dataFp').innerHTML = contenu;
	}
}

function setDataTk() {
	if (!document.getElementById('TK').checked)  {
		document.getElementById('dataTk').innerHTML = "";
	} else {
		var temp = Math.floor( (amelio['VUE']+base[race]['VUE']) / 2 );
		var contenu = " : portée " + temp +" cases" ;
		document.getElementById('dataTk').innerHTML = contenu;
	}
}

function setDataFa() {
	if (!document.getElementById('FA').checked)  {
		document.getElementById('dataFa').innerHTML = "";
	} else {
		var temp = 1 + Math.floor( (amelio['VUE']+base[race]['VUE']) / 5 );
		var contenu = " : malus de vue, attaque et esquive -" + temp ;
		document.getElementById('dataFa').innerHTML = contenu;
	}
}

function setDataTp() {
	if (!document.getElementById('TP').checked)  {
		document.getElementById('dataTp').innerHTML = "";
	} else {
		var mm = new Number(document.getElementById('MM').value);
		var portee = calculPortee(mm/5);
		var horiz = amelio['VUE'] + base[race]['VUE'] + 20 + portee;
		var vert = Math.floor( (portee) / 3 + 3);
		var contenu = " : portée en XY " + horiz +" cases, en Z " + vert +" cases" ;
		document.getElementById('dataTp').innerHTML = contenu;
	}
}

function setDataGlue() {
	if (!document.getElementById('Glue').checked)  {
		document.getElementById('dataGlue').innerHTML = "";
	} else {
		var temp = 1 + Math.floor( (amelio['VUE']+base[race]['VUE']) / 3 );
		var contenu = " : portee " + temp + " cases";
		document.getElementById('dataGlue').innerHTML = contenu;
	}
}

function setDataVa() {
	if (!document.getElementById('VA').checked)  {
		document.getElementById('dataVa').innerHTML = "";
	} else {
		var temp = Math.floor( (amelio['VUE']+base[race]['VUE']) / 2 );
		var contenu = " : bonus de vue +" + temp + " cases";
		document.getElementById('dataVa').innerHTML = contenu;
	}
}

function setDataGds() {
	if (!document.getElementById('GdS').checked)  {
		document.getElementById('dataGds').innerHTML = "";
	} else {
		var deAtt = amelio['ATT'] + base[race]['ATT'];
		var deDeg = Math.floor( (amelio['DEG']+base[race]['DEG']) / 2 );
		var duree = 1 + Math.floor( (amelio['VUE']+base[race]['VUE']) / 5 );
		var virulence = 1 + Math.floor( (amelio['PV']*10+base[race]['PV']) / 30 );
		var contenu = " : attaque " + deAtt + "D6, dégâts " + deDeg + "D3, durée " + duree + " tour(s), virulence " + virulence + "D3";
		document.getElementById('dataGds').innerHTML = contenu;
	}
}

function setDataVlc() {
	if (!document.getElementById('VlC').checked)  {
		document.getElementById('dataVlc').innerHTML = "";
	} else {
		var temp = Math.floor( (amelio['VUE']+base[race]['VUE']) / 2 );
		var contenu = " : portee XY " + temp + " cases";
		document.getElementById('dataVlc').innerHTML = contenu;
	}
}

function setDataVt() {
	if (!document.getElementById('VT').checked)  {
		document.getElementById('dataVt').innerHTML = "";
	} else {
		var temp = Math.floor( (amelio['VUE']+base[race]['VUE']) / 3 );
		var contenu = " : malus de vue -" + temp + " cases";
		document.getElementById('dataVt').innerHTML = contenu;
	}
}

