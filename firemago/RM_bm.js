var table = $('html>body>table>tbody>tr:eq(1)>td>table>tbody>tr>td:eq(1)>form>table>tbody');
var j = 0;
var l = 0;
var totalBM = "";
var stringNom = "";
var arrayNom = new Array();
var arrayP = new Array();
var arrayM = new Array();

$('>tr.mh_tdpage',table).each(function(index) {

	// Récupération du nom,effet et type du bonus/malus
	textes = trim($('>td:eq(3)', this).text()).split(/ \| /);
	type = $('>td:eq(4)', this).text()
	for (var i in textes) {

		// Sépare le Bonus/Malus en Nom Effet
		texte = textes[i].split(/ : /);
		nom = texte[0];
		effet = texte[1];
		
		// ajoute le nom de bonus s'il n'est pas présent
		if (!arrayNom[nom]) {
			++j;
			arrayNom[nom] = nom;
		}
		
		// ajoute le bonus dans le tableau physique s'il l'est
		if (type == "Physique") {
			if ( !arrayP[nom] )
				arrayP[nom] = new Array();
			arrayP[nom].push(effet.replace(/%/,''));
		}

		// ajoute le bonus dans le tableau magique s'il l'est		
		if (type == "Magie") {
			if ( !arrayM[nom] )
				arrayM[nom] = new Array();				
			arrayM[nom].push(effet.replace(/%/,''));
		}
		
	}
	
});	

// Parcours tous les type de bonus
for (var i in arrayNom){

	effetP = 0;
	effetM = 0;	
	totalBM += arrayNom[i] + " : ";
	
	// Ajoute les bonus Physiques entre eux
	for (var k in arrayP[arrayNom[i]])
		effetP = addSign(effetP*1+arrayP[arrayNom[i]][k]*1);

	// Ajoute les bonus Magiques entre eux
	for (var k in arrayM[arrayNom[i]])
		effetM = addSign(effetM*1+arrayM[arrayNom[i]][k]*1);
	
	switch(i){
		
		case "RM" :
		case "MM" :
			totalBM += addSign(effetP*1+effetM*1)+" %";
			break;		
		
		case "ESQ" :
		case "Vue" :
		case "Fatigue" :
			totalBM += addSign(effetP*1+effetM*1);
			break;
		
		default :
			totalBM += effetP;
			if ( effetM )
				totalBM += "\\"+effetM;
			break;
		
	}
	


	++l;

	if ( l < j )
		totalBM += " | ";
		
}

// Ajout du tr contenant tous les Bonus/Malus
if ( totalBM != "" )
	$('>tr:eq(0)',table).before('<tr class="mh_tdpage"><td colspan="6" align="center"><b>'+totalBM+'<b></td></tr>');
	
// Ajout du tr Total Bonus/Malus
$('>tr:eq(0)',table).before('<tr class="mh_tdtitre"><td colspan="6" align="center"><b>Total Bonus/Malus<b></td></tr>');	

// trim
function trim( string )
{
	return string.replace(/^\s+/g, '').replace(/\s+$/g, '');
}

// ajoute le signe +
function addSign( number )
{
	return (number < 0) ? number : '+'+number;
}