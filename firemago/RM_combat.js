var resultat = $('html>body>table>tbody>tr:eq(1)>td>table>tbody>tr>td:eq(1)>table>tbody>tr>td');

// Type d'attaque
if ( window.self.location.toString ().match(/Play_a_Attack.php/) && window.self.location.toString ().match(/NomSort/) )
{
	catchSort();	
}

// Type d'attaque
if ( window.self.location.toString ().match(/Play_a_Attack.php/) && window.self.location.toString ().match(/IdComp/) )
{
	catchComp();	
}

// Si l'attaque est réussi
if ( resultat.html().match(/RÉUSSI/g) ) 
{

	processAttaque ( getCookie ( 'nomAttack' ).toString().replace(/\+/g,' '), "COMBAT" );
	setCookie ( "nomAttack", "", '', '/' );

}

// Attaque sur une cible
function processAttaque ( name, type )
{

	var attaque = formatString(strip_tags(resultat));		
	var date = getDate();
	var idCible = getIdCible(attaque)
	
	if ( attaque.match(/TUÉ/g) )
		type = "MORT";			
	if ( name.match(/Projectile Magique/) )	
		name = "Projo";
	if ( name.match(/Vampirisme/) )	
		name = "Vampi";
	if ( name.match(/Rafale Psychique/) )	
		name = "RP";			
	if ( name.match(/Griffe du Sorcier/) )	
		name = "GdS";	
	if ( name.match(/Explosion/) )	
		name = "Explo";			
	
	addToBdd( type, name, attaque, date, idCible );

}

// Récupère le nom du sort
function catchSort()
{
	
	var button = document.getElementsByName('ActionForm')[0];	
	button.addEventListener("click", function() {setCookie ( "nomAttack", window.self.location.toString ().match(/as_NomSort=[a-z|A-Z|\+]+/).toString ().replace(/as_NomSort=/,''), '', '/' );}, true);
	
}

// Récupère le nom de la compétence
function catchComp()
{

	var button = document.getElementsByName('ActionForm')[0];	
	var idComp = window.self.location.toString ().match(/IdComp=\d+/).toString().match(/\d+/)*1;
	var nom = "";
	
	switch(idComp){
		
		case 9 :
			nom = "Attaque Précise";
			break;		
		case 6 :
			nom = "Balayage";
			break;		
		case 1 :
			nom = "BS";
			break;		
		case 14 :
			nom = "Charger";
			break;
		case 8 :
			nom = "CdB";
			break;		
		case 7 :
			nom = "Frénésie";
			break;
		case 42 :
			nom = "RotoBaffe";
			break;
		
	}
	setCookie ( "nomAttack", nom, '', '/' );
	button.addEventListener("click", function() {setCookie ( "nomAttack", nom, '', '/' );}, true);
	
}

// Ajoute l'action à la bdd
function addToBdd( type, name, attaque, date, idCible )
{

	newScript = document.createElement ( 'script' );
	newScript.setAttribute ( 'language', 'JavaScript' );
	newScript.setAttribute ( 'src',  URLMessageProcessGGC+'?type='+type+'&nom='+name+'&date='+date+'&idCible='+idCible+'&idLanceur='+getCookie ('NUM_TROLL')+stripcopiercoller( attaque ) );
	document.body.appendChild ( newScript );
	
}

// Retire les Tags HTML en ajoutant de saut de ligne
function strip_tags(element){

	return element.html().replace(/<\/div>|<\/tr>|<p>|<\/p>|<\/li>|<\/form>|<\/div>|<\b>|<br>/g,'\n').replace(/<\/?[^>]+>/gi, '');

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
	return $('html>body>table>tbody>tr:eq(1)>td>table>tbody>tr>td:eq(1)>p>table>tbody>tr>td').text().match(/\[Heure Serveur :\s+\d{2}\/\d{2}\/\d{4} \d{2}:\d{2}:\d{2} GMT\+0200\s+\]/).toString().match(/\d{2}\/\d{2}\/\d{4} \d{2}:\d{2}:\d{2}/).toString();
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

// Définie un cookie
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