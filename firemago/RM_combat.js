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

function getInfos()
{
	var divList = document.getElementsByTagName( 'div' );
	var comp = 2;
	var male = true;
	var nt = getCookie("NIV_TROLL");
	var mm = getCookie("MM_TROLL");
 
	if ( nt == "" || divList.length <= 2 ) { return; }
	if( divList[2].childNodes[0].nodeValue.indexOf( "Attaque Normale" ) != -1 ) { comp = 1; }

	var pList = document.getElementsByTagName( 'p' );
	var nom = pList[0].childNodes[0].nodeValue;
	var i = 0;
	var rmText = "";
  
	while( !nom || nom.indexOf("Vous avez attaqué un") != 0 )
	{
		i++;
		if( i >= pList.length ) { return; }
		nom = pList[i].childNodes[0].nodeValue;
	}
	
	if ( nom.slice( 20, 21 ) == "e")
	{
		nom = nom.slice( 22, nom.indexOf( "(" ) -1 );
		male = false;
	}
	else
	{
		nom	= nom.slice( 21, nom.indexOf( "(" ) -1 );
	}
	
	for ( var j=i; j < pList.length; j++)
	{
		var texte = pList[j].childNodes[0].nodeValue;
  	if ( texte && texte.indexOf( "Seuil de Résistance de la Cible" ) != -1 )
 		{
			var sr = pList[j].childNodes[0].nextSibling.childNodes[0].nodeValue;
			sr = sr.slice( 0, sr.indexOf( "%" ) -1 );
			var string = "";
			if ( sr == 10 ) 
			{
				rmText = "type=inf&rm=" + Math.round ( ( sr*mm )/50 );
				string = "\u2264 " + Math.round ( ( sr*mm )/50 );
			} 
			else if ( sr <= 50 ) 
			{
				rmText = "type=egal&rm=" + Math.round ( ( sr*mm )/50 );
				string = Math.round ( ( sr*mm )/50 );
			} 
			else if ( sr < 90 )
			{
				rmText = "type=egal&rm=" + Math.round ( 50*mm/( 100-sr ) );
				string = Math.round ( 50*mm/( 100-sr ) );
			} 
			else 
			{
				rmText = "type=sup&rm=" + Math.round ( 50*mm/( 100-sr ) ); 
				string = "\u2265 " + Math.round ( 50*mm/( 100-sr ) ); 
			}
			pList[j].appendChild ( document.createElement ( 'br' ) );
			pList[j].appendChild ( document.createTextNode ( 'RM approximative de la Cible.......: ' ) );
			var myB = document.createElement ( 'b' );
			myB.appendChild ( document.createTextNode ( string ) );
			pList[j].appendChild ( myB );
			break;
		}
	}  
	var bList = document.getElementsByTagName( 'b' );
	for ( var i = 0; i < bList.length; i++ )
	{
		if(bList[i].childNodes[0].nodeValue=="TUÉ")
		{
			var nbPX = "";
			for ( var j = i+1; j < bList.length; j++ )
			{
				if ( bList[j].childNodes[0].nodeValue.indexOf ( "PX" ) != -1)
				{
					nbPX = bList[j].childNodes[0].nodeValue;
					break;
				}
			}
			if ( nbPX == "" ) { return; }
		
			nbPX = parseInt ( nbPX.slice ( 0, nbPX.indexOf ( "P" ) -1 ) );
			
			if ( !nbPX ) { nbPX = 0; }
			
			if( !male ) { chaine = "Elle"; }
			
			else { chaine = "Il"; }
		
			chaine += " était de niveau ";
	
			var niveau = (nbPX*1+2*nt-10-comp)/3;
			if( comp > nbPX )
			{
				chaine += "inférieur ou égal à " + Math.floor ( niveau ) + ".";
			}
			else if( Math.floor ( niveau ) == niveau )
			{
				chaine += niveau + ".";
				/*
					var espace = document.createTextNode('\t');
                	var myButton = document.createElement('input');
                	myButton.setAttribute('type', 'button');
                	myButton.setAttribute('class', 'mh_form_submit');
                	myButton.setAttribute('id', 'CdmButton');
                	myButton.setAttribute('value', "Participer au bestiaire");
                	myButton.setAttribute('onmouseover', "this.style.cursor='pointer'");
                	myButton.setAttribute('onclick', "window.open('" + pageNivURL + "?monstre=" + escape(nom) + "&niveau="+ escape(niveau)+"', 'popupCdm', 'width=400, height=240, toolbar=no, status=no, location=no, resizable=yes'); this.value='Merci de votre participation'; this.disabled = true;");
			var bouton=document.getElementsByName('as_Action')[0]
                	bouton.parentNode.insertBefore(espace,bouton);
                	bouton.parentNode.insertBefore(myButton, espace);
			*/
			}
			else
			{
				chaine = "Firemago n'est pas arrivé à calculer le niveau du monstre.";
			}
			bList[i].parentNode.insertBefore ( document.createElement ( "br" ), bList[i].nextSibling.nextSibling.nextSibling );
			bList[i].parentNode.insertBefore ( document.createTextNode ( chaine ),bList[i].nextSibling.nextSibling.nextSibling );
			//Pour le bouton de partage
			var PXdistrib = nbPX - comp;
			var espace = document.createTextNode('\t');
			var myButton = document.createElement('input');
			myButton.setAttribute('type', 'button');
            myButton.setAttribute('class', 'mh_form_submit');
            myButton.setAttribute('id', 'PartageButton');
            myButton.setAttribute('value', "Partager les PX");
			var URLPartages = URLOutils + 'partagepx/partage.php';
            myButton.setAttribute('onclick', "window.open('" + URLPartages + "?distribpx=" + PXdistrib +"&troll=" + getCookie("NUM_TROLL") + "', 'popupPartages', 'width=" + ( screen.width - 150 ) + ", height=" + ( screen.height - 128) + ", toolbar=no, status=no, location=no, resizable=yes'); this.value='Partage effectué'; this.disabled = true;");
			var bouton=document.getElementsByName('as_Action')[0];
			bouton.parentNode.insertBefore(espace,bouton);
            bouton.parentNode.insertBefore(myButton, espace);
		}
	}
}

//var debut = new Date();
//var pageNivURL="http://resel.enst-bretagne.fr/club/mountyhall/script/v1/niveau_monstre_combat.php";
getInfos();
//var totaltab=document.getElementsByTagName( 'table' );
//getDices();
//var fin = new Date();
//totaltab[totaltab.length-1].childNodes[1].childNodes[0].childNodes[1].appendChild( document.createTextNode( " - [Script exécuté en "+(( fin.getTime() - debut.getTime() )/1000)+" sec]"));
