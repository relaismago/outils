var totaltab = document.getElementsByTagName ( 'table' );
var etageTroll = $("table:eq(3)>tbody>tr>td>ul>li>b:eq(1)").html().match("N = -?[0-9]+").toString().match("-?[0-9]+");
var errorLog = '';
var debugLog = '';

// Show/Hide Block
var blockTable = $('html>body>table>tbody>tr:eq(1)>td>table>tbody>tr>td:eq(1)>p>table');
$('>tbody>tr>td>table>tbody>tr>td>a',blockTable).attr('onMouseOver','this.style.cursor = \'pointer\'');
$('>tbody>tr>td>table>tbody>tr>td>a',blockTable).attr('onClick','showHide(this);');

// ***********************************************
// Defining colors for troll & guild status
// ***********************************************

var anchorCss = document.getElementsByTagName ( 'link' )[0]; // ANCHOR
if ( anchorCss.getAttribute ( 'href' ).indexOf ( 'www.mountyhall.com' ) != -1 || anchorCss.getAttribute ( 'href' ).indexOf ( 'parchemin' ) != -1)
{
	//alert ("CSS MH");
	var colorEnemy 	= "#ff9f9f";
	var colorTK 		= "#ffde9f";
	var colorFriend = "#9fccff";
	var colorAlly 	= "#9FFF9F";
	var colorRM 		= "#FFFF99";
	var colorUrg		= "gold";
	var colorSearch	= "silver";
	var colorCdm    = "#40e0c0";
}
else
{
	//alert ("CSS RM");
	var colorEnemy 	= "#FF4422";
	var colorTK 		= "#991111";
	var colorFriend = "#111177";
	var colorAlly 	= "#116611";
	var colorRM 		= "#CC9900";
	var colorUrg		= "#552222";
	var colorSearch	= "#554444";
	var colorCdm		= "#225555";
}

var hauteur = 50;
var bulleStyle = null;
creerBulle();

tableLaby='';
for (i=0; i<totaltab.length; i++) {
	var ttab="";
	try {ttab=totaltab[i].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].nodeValue;} catch (e) {}
	if (ttab=="MA VUE") {var tableView = totaltab[i-1];}
	if (ttab=="Murs et Couloirs") {var tableLaby = totaltab[i-1].childNodes[1].childNodes;}
	if (ttab=="MONSTRES ERRANTS") {var tableMonsters = totaltab[i-1].childNodes[1].childNodes;}	
	if (ttab=="TROLLS") {var tableTrolls = totaltab[i-1].childNodes[1].childNodes;}			
	if (ttab=="TR�SORS"){var tableTreasures = totaltab[i-1].childNodes[1].childNodes;}			
	if (ttab=="CHAMPIGNONS") {var tableMushrooms = totaltab[i-1].childNodes[1].childNodes;}		
	if (ttab=="LIEUX PARTICULIERS") {var tablePlaces = totaltab[i-1].childNodes[1].childNodes;}		
}

// Build the form with the button
var myForm = newForm ( 'select_troll', '' );
myForm.setAttribute ( 'onsubmit', 'return checkViewForm(this)' );
var vue = getVueScript ().replace(/\r/,'');
var j = 99999;
for( var i=0; i<vue.length; i+=j ){
	j = ( i+j > vue.length ) ? vue.length : i+j;
	myForm.appendChild ( myInput = newHidden ( 'datas[]', vue.substr(i,j) ) );
}
myForm.appendChild ( document.createElement ( 'b' ).appendChild ( document.createTextNode ( 'N� du troll : ' ) ) );
myForm.appendChild ( myInput = newText ( 'id_troll', getCookie ( "NUM_TROLL" ), 5, 5 ) );
myForm.appendChild ( myInput = newButton ( 'Submit', 'La Vue 2D R&M' ) );

try { insertBeforeCR ( myForm, document.getElementsByTagName( 'a' )[4] ); } catch ( e ) { error ( e, 'vue2d' ); } // ANCHOR

myTR = newTR ();
myTD = newTD ();
myTD.setAttribute ('colspan','2');
myTR.appendChild ( myTD );

var myDiv = document.createElement ( 'div' );
myDiv.setAttribute ( 'id', 'conn' );
var newConnScript = document.createElement ( 'script' );
newConnScript.setAttribute ( 'language', 'JavaScript' );
newConnScript.setAttribute ( 'src',  URLLoginRM );
( tablePlaces[tablePlaces.length-1].parentNode.parentNode.parentNode ).appendChild ( newConnScript );

myTD.appendChild ( myDiv );

try { totaltab[3].childNodes[1].appendChild(myTR); } catch ( e ) { error ( e, 'auth RM' ); } // ANCHOR

// ********************************************************
// Adding danger (Mythics and TK)
// ********************************************************

var totalLi = document.getElementsByTagName ( 'li' );
var pos = totalLi[0].childNodes[2].childNodes[0].nodeValue;
var posX=pos.substring(pos.indexOf('=')+2,pos.indexOf(','));
pos=pos.substr(pos.indexOf(',')+1);
var posY=pos.substring(pos.indexOf('=')+2,pos.indexOf(','));
var posN=pos.substr(pos.lastIndexOf('=')+2);

myDiv = document.createElement ( 'div' );
myDiv.setAttribute ( 'id', 'frmdanger' );
var html = "<form><table ><tr><td>Les menaces sur <input type='text' size='2' maxlength='2' class='TextboxV2' value='30' id='txtDist'/> cases</td>";
html += "<td><input type='button' value='Afficher' onclick='affDanger();' class='mh_form_submit'/></td>";
html += "<td><input type='button' value='Cacher' onclick='hideDanger();' class='mh_form_submit'/></td>";
html += "</tr></table><div id='danger'></div></form>";

myDiv.innerHTML = html;

try { insertBeforeCR ( myDiv, totaltab[4] ); } catch ( e ) { error ( e, 'danger RM' ); } // ANCHOR

$(myDiv).after("<textarea id='cr' style='display:none;' cols='100' rows='20'>CR du "+new Date().toLocaleString()+"\n[quote]</textarea>");
$(myDiv).after("<input onClick='if ( $(\"#cr\").css(\"display\") == \"none\" ) $(\"#cr\").show(); else $(\"#cr\").hide();' style='display:block;' type='submit' value='Voir le C/R !'/>");

// ********************************************************
// Adding filter inputs
// ********************************************************

var tableTitle;

// Add monsters filter buttons

try {
	anchorTitle = tableMonsters[0].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[0]; // ANCHOR
	anchorTitle.appendChild ( document.createTextNode (" [ ") );
	anchorTitle.appendChild ( newCheckbox ( 'delgowap', 'toggleGowap()' ) );
	anchorTitle.appendChild ( document.createTextNode ( 'Gowaps' ) );
	anchorTitle.appendChild ( document.createTextNode (" ] ") );
	anchorTitle.appendChild ( newText ( 'filterMonsters', '', 12, 20 ) );
	anchorTitle.appendChild ( newButton ( 'filterMonstersBtn', 'Filtrer', 'filterMonsters()' ) );
	
} catch ( e ) { error ( e, 'monsterFilters' ); }

// Add trolls filter buttons
try {
	anchorTitle = tableTrolls[0].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[0]; // ANCHOR
	anchorTitle.appendChild ( document.createTextNode (" [ ") );
	anchorTitle.appendChild ( newCheckbox ( 'delint', 'toggleIntangible()' ) );
	anchorTitle.appendChild ( document.createTextNode ( 'Intangibles' ) );
	anchorTitle.appendChild ( document.createTextNode (" ] ") );
	anchorTitle.appendChild ( newText ( 'filterTrolls', '', 12, 20 ) );
	anchorTitle.appendChild ( newButton ( 'filterTrollsBtn', 'Filtrer', 'filterTrolls()' ) );
} catch ( e ) { error ( e, 'trollFilters' ); }

// Add treasures filter buttons
try {
	anchorTitle = tableTreasures[0].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[0]; // ANCHOR
	anchorTitle.appendChild ( document.createTextNode (" [ ") );
	anchorTitle.appendChild ( newCheckbox ( 'delgg', 'toggleGG()' ) );
	anchorTitle.appendChild ( document.createTextNode ( 'GGs' ) );
	anchorTitle.appendChild ( newCheckbox ( 'delcomp', 'toggleComp()' ) );
	anchorTitle.appendChild ( document.createTextNode ( 'Compos' ) );
	anchorTitle.appendChild ( newCheckbox ( 'delbid', 'toggleBidouille()' ) );
	anchorTitle.appendChild ( document.createTextNode ( 'Bidouilles' ) );
	anchorTitle.appendChild ( document.createTextNode (" ] ") );
	anchorTitle.appendChild ( newText ( 'filterTreasures', '', 12, 20 ) );
	anchorTitle.appendChild ( newButton ( 'filterTreasuresBtn', 'Filtrer', 'filterTreasures()' ) );
} catch ( e ) { error ( e, 'treasureFilters' ); }

// restore filters values
try {
	if ( uncookifyButton ( document.getElementsByName ( 'delgg' )[0] ) ) 		{ toggleGG (); }
	if ( uncookifyButton ( document.getElementsByName ( 'delcomp' )[0] ) ) 	{ toggleComp (); }
	if ( uncookifyButton ( document.getElementsByName ( 'delbid' )[0] ) ) 		{ toggleBidouille (); }
} catch ( e ) { error ( e, 'restoreFilters' ); }

//putMsgPXBouton (totaltab[7]);

// ********************************************************
// Monster compendium links
// ********************************************************

var myB = document.createElement( 'b' );
myB.appendChild ( document.createTextNode( 'Niveau') );
myTd = newTD();
myTd.setAttribute( 'width', '25' );
myTd.appendChild(myB);
tableMonsters[2].insertBefore( myTd, tableMonsters[2].childNodes[2] );
myB = document.createElement( 'b' );
myB.appendChild ( document.createTextNode( 'PV') );
myTd = newTD();
myTd.setAttribute( 'width', '25' );
myTd.setAttribute( 'align', 'center' );
myTd.appendChild(myB);
tableMonsters[2].insertBefore( myTd, tableMonsters[2].childNodes[4] );
tableMonsters[0].childNodes[0].setAttribute ('colspan','8');

arrayMonster = "etageTroll=" + etageTroll;
begin = 4;
for ( var i = 4; i < tableMonsters.length; i=i+2 )
{
	try {
		var anchorRow = tableMonsters[i];
		var anchorCellDist = tableMonsters[i].childNodes[0]; // ANCHOR
		var anchorCellID = tableMonsters[i].childNodes[1]; // ANCHOR
		var anchorCellDesc = tableMonsters[i].childNodes[2]; // ANCHOR
		var anchorCellEtage = tableMonsters[i].childNodes[5]; // ANCHOR
		var anchorDist = anchorCellDist.childNodes[0]; // ANCHOR
		var anchorID = anchorCellID.childNodes[0]; // ANCHOR
		var anchorDesc = anchorCellDesc.getElementsByTagName ( 'a' )[0]; // ANCHOR
		var anchorEtage = anchorCellEtage.childNodes[0]; // ANCHOR
		
		var monsterDist = new String ( anchorDist.nodeValue );
		var monsterId = new String ( anchorID.nodeValue );
		var monsterDesc = new String ( flattenNode ( anchorDesc ) );
		var monsterStyle = new String ( anchorDesc.getAttribute ( 'class' ) );
		var monsterName = monsterDesc.substring ( 0, monsterDesc.indexOf ( '[' ) - 1 );
		var monsterAge = monsterDesc.substring ( monsterDesc.indexOf ( '[' ) + 1, monsterDesc.indexOf ( ']' ) );
		var monsterEtage = new String ( anchorEtage.nodeValue );
		
		arrayMonster += "&monsterDists[]=" + monsterDist + "&monsterIds[]=" + monsterId + "&monsterNames[]=" + escape ( monsterDesc ) + "&monsterAges[]=" + escape ( monsterAge.replace ( /'/, " " ) ) + "&monsterEtages[]=" + monsterEtage;
		
		newTdNiv = document.createElement ( 'td' );
		newTdNiv.setAttribute ( 'align', 'center');
		anchorRow.insertBefore ( newTdNiv, anchorCellDesc );
		
		newTdPv = document.createElement ( 'td' );
		newTdPv.setAttribute ( 'align', 'center');
		anchorRow.insertBefore ( newTdPv, tableMonsters[i].childNodes[4] );
		
		if ( i%30 == 0 || i == tableMonsters.length-2 )
		{
			if ( i == tableMonsters.length-2 )
				arrayMonster += "&end=1";
			arrayMonster += "&begin=" + begin;
			newMonsterScript = document.createElement ( 'script' );
			newMonsterScript.setAttribute ( 'language', 'JavaScript' );
			newMonsterScript.setAttribute ( 'src',  URLMonsterInfos  + arrayMonster );
			document.body.appendChild ( newMonsterScript );
			arrayMonster = "etageTroll=" + etageTroll;
			begin = i + 2;
		}
	} catch ( e ) { error ( e, 'Monster Compendium error (' + i + ')' ); }
}

/*var newB = document.createElement( 'b' );
newB.appendChild( document.createTextNode( 'MP/PX' ) );
newTd = document.createElement( 'td' );
newTd.setAttribute( 'width', '5' );
newTd.setAttribute( 'align', 'center' );
newTd.appendChild( newB );
tableTrolls[2].insertBefore( newTd, tableTrolls[2].childNodes[2] );*/
myB = document.createElement( 'b' );
myB.appendChild ( document.createTextNode( 'PV') );
myTd = newTD();
myTd.setAttribute( 'width', '25' );
myTd.setAttribute( 'align', 'center' );
myTd.appendChild(myB);
tableTrolls[2].insertBefore( myTd, tableTrolls[2].childNodes[6] );
tableTrolls[0].childNodes[0].setAttribute ('colspan','11');

var arrayTroll = "etageTroll=" + etageTroll;
var arrayGuild = "";
begin = 4;
for ( var i = 4; i < tableTrolls.length; i = i+2 )
{
	try {
		
		/*var newTd = document.createElement( 'td' );		// Pour la box MP
		newTd.setAttribute( 'width', '5' );
		newTd.setAttribute( 'align', 'center' );*/
		
		$(tableTrolls[i].childNodes[3]).attr( 'title', 'gain de '+gainPX ( tableTrolls[i].childNodes[3].childNodes[0].nodeValue )+' px' );
		
		var anchorCellTrollDist = tableTrolls[i].childNodes[0]; // ANCHOR
		var anchorCellTrollID = tableTrolls[i].childNodes[1]; // ANCHOR
		var anchorCellTrollDesc = tableTrolls[i].childNodes[2]; // ANCHOR
		var anchorCellGuildDesc = tableTrolls[i].childNodes[5]; // ANCHOR
		var anchorCellTrollEtage = tableTrolls[i].childNodes[8]; // ANCHOR	
		var anchorTrollDist = anchorCellTrollDist.childNodes[0]; // ANCHOR
		var anchorTrollID = anchorCellTrollID.childNodes[0]; // ANCHOR
		var anchorTrollDesc = anchorCellTrollDesc.getElementsByTagName ( 'a' )[0]; // ANCHOR
		var anchorTrollEtage = anchorCellTrollEtage.childNodes[0]; // ANCHOR
		if (anchorCellGuildDesc.getElementsByTagName ( 'a' ).length > 0)
		{
			var anchorGuildDesc = anchorCellGuildDesc.getElementsByTagName ( 'a' )[0]; // ANCHOR
			var styleGuild = new String ( anchorGuildDesc.getAttribute ( 'class' ) );
			var guildJS = new String ( anchorGuildDesc.getAttribute ( 'href' ) );
			var guildID = guildJS.substring ( 15, guildJS.indexOf ( ',' ) ); // ANCHOR
		}
		else
		{
			var guildID = '1';
		}
		
		// grab styles used for troll and guild
		var styleTroll = new String ( anchorTrollDesc.getAttribute ( 'class' ) );
		var trollDist = new String ( anchorTrollDist.nodeValue );
		var trollID = new String ( anchorTrollID.nodeValue );
		var trollName = new String ( flattenNode ( anchorTrollDesc ) );
		var trollEtage = new String ( anchorTrollEtage.nodeValue );
		
		// MP check box
		/*tableTrolls[i].insertBefore(newTd,anchorCellTrollDesc);
		var cb=document.createElement('INPUT');
		cb.setAttribute('type','checkbox');
		cb.setAttribute('name','mp_'+trollID);
		cb.setAttribute('value',trollID);
		tableTrolls[i].childNodes[2].appendChild(cb);*/
		
		// populate troll and guild list for status coloring
		if ( guildID != '1' ) { arrayGuild += "guildsid[]=" + guildID + ";" + i + "&"; }
			arrayTroll += "&trollDists[]=" + trollDist + "&trollsid[]=" + trollID + "&trollEtages[]=" + trollEtage;
		
		// create link 'troll id' -> MH troll popup
		var newLink = document.createElement ( 'a' );
		newLink.appendChild ( document.createTextNode ( trollID ) );
		newLink.setAttribute ( 'class', styleTroll );
		newLink.setAttribute ( 'href', 'javascript:EPV(' + trollID + ')' );
		anchorCellTrollID.removeChild ( anchorTrollID );
		anchorCellTrollID.appendChild ( newLink );
		
		// create link 'troll name' -> RM troll file
		var newLink = document.createElement ( 'a' );
		newLink.appendChild ( document.createTextNode ( trollName ) );
		newLink.setAttribute ( 'class', styleTroll );
		newLink.setAttribute ( 'href', URLRGTroll + trollID );
		newLink.setAttribute ( 'target', '\"_blank\"' );
		anchorCellTrollDesc.removeChild ( anchorTrollDesc );
		anchorCellTrollDesc.appendChild ( newLink );
		
		// create link 'RG' -> RM guild file
		var newLink = document.createElement ( 'a' );
		newLink.appendChild ( document.createTextNode ( 'RG' ) );
		newLink.setAttribute ( 'class', styleGuild );
		newLink.setAttribute ( 'href', URLRGGuilde + guildID );
		newLink.setAttribute ( 'target', '\"_blank\"' );
		if ( guildID != '1' )
		{
			anchorCellGuildDesc.insertBefore ( document.createTextNode ( '[' ), anchorGuildDesc );
			anchorCellGuildDesc.insertBefore ( newLink, anchorGuildDesc );
			anchorCellGuildDesc.insertBefore ( document.createTextNode ( '] - ' ), anchorGuildDesc );
		}
		
		// Pour la barre de PV
		newTdPv = document.createElement ( 'td' );
		newTdPv.setAttribute ( 'align', 'center');
		tableTrolls[i].insertBefore ( newTdPv, tableTrolls[i].childNodes[6] );
		
		if ( i%30 == 0 || i == tableTrolls.length-2 )
		{
			// Adding script for coloring tk's and wanted
			arrayTroll += "&begin=" + begin;
			var newTrollScript = document.createElement ( 'script' );
			newTrollScript.setAttribute ( 'language', 'JavaScript' );
			newTrollScript.setAttribute ( 'src',  URLTrollInfos  + arrayTroll );
			document.body.appendChild ( newTrollScript );
			arrayTroll = "etageTroll=" + etageTroll;
			
			var newGuildeScript = document.createElement ( 'script' );
			newGuildeScript.setAttribute ( 'language', 'JavaScript' );
			newGuildeScript.setAttribute ( 'src',  URLGuildeInfos + arrayGuild );
			document.body.appendChild ( newGuildeScript );
			arrayGuild = "";
			
			begin = i + 2;
		}
	
	} catch ( e ) { error ( e, 'Troll and Guild Compendium error (' + i + ')' ); }
}

// ********************************************************
// Places colours
// ********************************************************

var arrayPlace = "";
begin = 4;
for ( var i = 4; i < tablePlaces.length; i=i+2 )
{
	
	try
	{
		var anchorCellPlaceID = tablePlaces[i].childNodes[1].childNodes[0]; // ANCHOR
		var placeID = anchorCellPlaceID.nodeValue;
		arrayPlace += "placesId[]=" + trim(placeID) + "&";
		if ( i%30 == 0 || i == tablePlaces.length-2 )
		{
			arrayPlace += "begin=" + begin;
			var newPlaceScript = document.createElement ( 'script' );
			newPlaceScript.setAttribute ( 'language', 'JavaScript' );
			newPlaceScript.setAttribute ( 'src',  URLPlaceInfos  + arrayPlace );
			document.body.appendChild ( newPlaceScript );
			arrayPlace = "";
			begin = i + 2;
		}
	} catch ( e ) { error ( e, 'Places Colouring error' ); }
	
}

// Color Parchemin
$("table:eq(9)>tbody>tr:contains('Parchemin')").each(function(index) {
	$(this).removeAttr("class");
	$(this).css("background-color","red");
});

arrayTreasure = "etageTroll=" + etageTroll;
begin = 4;

for ( var i = 4; i < tableTreasures.length; i=i+2 )
{
	try {
		var anchorRow = tableTreasures[i];
		var anchorCellDist = tableTreasures[i].childNodes[0]; // ANCHOR
		var anchorCellId = tableTreasures[i].childNodes[1]; // ANCHOR
		var anchorCellEtage = tableTreasures[i].childNodes[5]; // ANCHOR
		var anchorDist = anchorCellDist.childNodes[0]; // ANCHOR
		var anchorId = anchorCellId.childNodes[0];
		var anchorEtage = anchorCellEtage.childNodes[0]; // ANCHOR
		
		var treasureDist = new String ( anchorDist.nodeValue );
		var treasureId = new String( anchorId.nodeValue );
		var treasureEtage = new String ( anchorEtage.nodeValue );

		arrayTreasure += "&treasureDists[]=" + treasureDist + "&treasureIds[]=" + treasureId + "&treasureEtages[]=" + treasureEtage;
		
		if ( i%30 == 0 || i == tableTreasures.length-2 )
		{
		  arrayTreasure += "&begin=" + begin;
		  newTreasureScript = document.createElement ( 'script' );
		  newTreasureScript.setAttribute ( 'language', 'JavaScript' );
		  newTreasureScript.setAttribute ( 'src',  URLTreasureInfos  + arrayTreasure );
		  document.body.appendChild ( newTreasureScript );
		  arrayTreasure = "etageTroll=" + etageTroll;
		  begin = i + 2;
		}
	} catch ( e ) { error ( e, 'Treasure Compendium error (' + i + ')' ); }
}

var position = $('html>body>table>tbody>tr:eq(1)>td>table>tbody>tr>td:eq(1)>form>table>tbody>tr>td>ul>li>b:eq(1)').text().split(',');
var vue = $('html>body>table>tbody>tr:eq(1)>td>table>tbody>tr>td:eq(1)>form>table>tbody>tr>td>ul>li:eq(2)>b:eq(1)').text().match(/\d+/);
// Display piege
newPlaceScript = document.createElement ( 'script' );
newPlaceScript.setAttribute ( 'language', 'JavaScript' );
newPlaceScript.setAttribute ( 'src',  URLPiegeInfos + 'Vue='+vue+'&X='+position[0].match(/.\d+/)+'&Y='+position[1].match(/.\d+/)+'&N='+position[2].match(/.\d+/) );
document.body.appendChild ( newPlaceScript );

// ********************************************************
// Initialisation des filtres
// ********************************************************
var cursorOnLink=false;
var itbid=-1;
for (i=0; i<totaltab.length; i++) {
	var ttab="";	
	try {ttab=totaltab[i].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].nodeValue;} catch (e) {}			
	if (ttab=="MA VUE") {var itinf=i+1; }			
	if (ttab=="MONSTRES ERRANTS") {var itmon=i-1;}	
	if (ttab=="TROLLS") {var ittro=i-1;}			
	if (ttab=="TR�SORS"){var ittre=i-1;}			
	if (ttab=="CHAMPIGNONS") {var itcha=i-1;}		
	if (ttab=="LIEUX PARTICULIERS") {var itlie=i-1;}
	try {ttab=totaltab[i].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].nodeValue;} catch (e) {}			
	if (ttab=="B I D I V I E W") {itbid=i;}			
}

if (itbid>0) var tbid = totaltab[itbid];		
var tinf = totaltab[itinf];		//var tinf = totaltab[3];
var tmon = totaltab[itmon];		//var tmon = totaltab[4];
var ttro = totaltab[ittro];		//var ttro = totaltab[6];
var ttre = totaltab[ittre];		//var ttre = totaltab[8];
var tcha = totaltab[itcha];		//var tcha = totaltab[10];
var tlie = totaltab[itlie];		//var tlie = totaltab[12];

displayErrors ( totaltab[4] );
displayDebug ( totaltab[4] );

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
// Clean Value
// ******************************************************************

function trim ( string )
{
   return string.replace ( /(^\s*)|(\s*$)/g, '' );
}

function str_woa( str ) {
   str = str.replace( /[����]/g, 'e');
   str = str.replace( /[���]/g, 'a' );
   str = str.replace( /[���]/g, 'u' );
   str = str.replace( /[��]/g, 'i' );
   str = str.replace( /[��]/g, 'o' );
   return str;
}


// ******************************************************************
// Error logging functions
// ******************************************************************

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
		myTD.innerHTML = '<b> Firemago a rencontr� les erreurs suivantes : </b> \n' + errorLog;
		
		try { insertBeforeCR ( myTable, insertPoint ); } catch ( e ) { alert ( 'Could not display FireMago errors : ' + e ); }
	}
}

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
		myTD.innerHTML = '<b> Firemago a g�n�r� les messages de debug suivants : </b> \n' + debugLog;
		
		try { insertBeforeCR ( myTable, insertPoint ); } catch ( e ) { alert ( 'Could not display FireMago debug : ' + e ); }
	}
}

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
		( (expires) ? "; expires=" + expires.toGMTString () : "; expires=" + expdate.toGMTString () ) +
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

// ******************************************************************
// Filter functions
// ******************************************************************

function toggleListElements ( list, checkFunction, checkParam, hide )
{
	var param = ( new String  ( checkParam ) ).toLowerCase ();
	for ( var i = 4; i < list.length; i=i+2 )
	{
		if ( list[i].childNodes[0].firstChild.nodeValue < 2 && (checkParam == 'Gowap' || checkParam == 'mh_trolls_0'))
		{
		
		}
		else
		{
			if ( (list[i].className == 'mh_tdpage' || list[i].className == '') && checkFunction ( list[i], param ) )
			{
				if ( hide ) { list[i].style.display='none'; }
				else { list[i].style.display=''; }
			}
		}
	}
}
 
function filterListElements ( list, checkFunction, checkParam )
{
	var param = ( new String  ( checkParam ) ).toLowerCase ();
	for ( var i = 4; i < list.length; i=i+2 )
	{
		if ( (list[i].className == 'mh_tdpage' || list[i].className == '') && checkFunction ( list[i], param ) ) 
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
	return flattenNode ( node.childNodes[2].firstChild ).toLowerCase ().indexOf ( eltName ) != -1;  // ANCHOR
}

function checkMonsterName ( node, eltName )
{
	if (node.childNodes[3].childNodes[0].firstChild)
		return node.childNodes[3].childNodes[0].firstChild.nodeValue.toLowerCase ().indexOf ( eltName ) != -1;  // ANCHOR
	else
		return node.childNodes[4].childNodes[0].firstChild.nodeValue.toLowerCase ().indexOf ( eltName ) != -1;  // ANCHOR
}

function checkTrollName ( node, eltName )
{
	return node.childNodes[2].getElementsByTagName ( 'a' )[0].firstChild.nodeValue.toLowerCase ().indexOf ( eltName ) != -1;  // ANCHOR
}

function checkTrollClass ( node, eltName )
{
	return node.childNodes[2].getElementsByTagName ( 'a' )[0].className == eltName;  // ANCHOR
}

function toggleGG ()
{
	var on = cookifyButton ( document.getElementsByName ( 'delgg' )[0] );
	toggleListElements ( tableTreasures, checkTreasureName, "Gigots de Gob", on );
}

function toggleComp ()
{
	var on = cookifyButton ( document.getElementsByName ( 'delcomp' )[0] );
	toggleListElements ( tableTreasures, checkTreasureName, "Composant", on );
}

function toggleGowap ()
{
	var monsterTable = $('html>body>table>tbody>tr:eq(1)>td>table>tbody>tr>td:eq(1)>p>table:eq(0)>tbody');
	var on = cookifyButton ( document.getElementsByName ( 'delgowap' )[0] );
	if ( $('>tr:contains("Gowap ")',monsterTable).is(":visible") )
		$('>tr:contains("Gowap ")',monsterTable).hide();
	else
		$('>tr:contains("Gowap ")',monsterTable).show();
}

function toggleIntangible ()
{
	var on = cookifyButton ( document.getElementsByName ( 'delint' )[0] );
	toggleListElements ( tableTrolls, checkTrollClass, "mh_trolls_0", on );
}

function toggleBidouille ()
{
	var on = cookifyButton ( document.getElementsByName ( 'delbid' )[0] );
	toggleListElements ( tableTreasures, checkTreasureName, "Bidouille", on );
}

function toggleTableau( num ) {
        var aucun;
        if (num==itmon) ttab=tmon;
        else if (num==ittro) ttab=ttro;
        else if (num==ittre) ttab=ttre;
        else if (num==itcha) ttab=tcha;
        else if (num==itlie) ttab=tlie;
        else if (num==itinf) ttab=tinf;
        else if (num==itbid) ttab=tbid;
        else ttab=totaltab[num];
        
	if(cursorOnLink) return;
    if ( !ttab.childNodes[1].getAttribute( 'style' ) || ttab.childNodes[1].getAttribute( 'style' ) == '' ) {
            ttab.childNodes[1].setAttribute( 'style', 'display:none;');
            aucun = 'true';
    } else {
            ttab.childNodes[1].setAttribute( 'style', '');
            aucun = 'false';
    }
}

function filterMonsters ()
{
	var anchorTitle = tableMonsters[0].childNodes[0].childNodes[1].childNodes[0].childNodes[0]; // ANCHOR
	document.getElementsByName ( 'delgowap' )[0].checked=false;
	cookifyButton ( document.getElementsByName ( 'delgowap' )[0] );
	if ( document.getElementsByName ( "filterMonsters" )[0].value != '' )
	{
		var nom = document.getElementsByName ( "filterMonsters" )[0].value.toLowerCase ();
		anchorTitle.nodeValue = "MONSTRES (filtr�s sur " + nom + ")";
		filterListElements ( tableMonsters, checkMonsterName, nom );
	}
	else
	{
		anchorTitle.nodeValue="MONSTRES";
		filterListElements ( tableMonsters, checkAlwaysTrue, '' );
	}
}

function filterTrolls ()
{
	var anchorTitle = tableTrolls[0].childNodes[0].childNodes[1].childNodes[0].childNodes[0]; // ANCHOR
	document.getElementsByName ( 'delint' )[0].checked = false;
	cookifyButton ( document.getElementsByName ( 'delint' )[0] );
	if ( document.getElementsByName ( "filterTrolls" )[0].value != '' )
	{
		var nom = document.getElementsByName ( "filterTrolls" )[0].value.toLowerCase ();
		anchorTitle.nodeValue = "TROLLS (filtr�s sur " + nom + ")";
		filterListElements ( tableTrolls, checkTrollName, nom );
	}
	else
	{
		anchorTitle.nodeValue="TROLLS";
		filterListElements ( tableTrolls, checkAlwaysTrue, '' );
	}
}

function filterTreasures ()
{
	var anchorTitle = tableTreasures[0].childNodes[0].childNodes[1].childNodes[0].childNodes[0]; // ANCHOR
	document.getElementsByName ( 'delgg' )[0].checked = false;
	cookifyButton ( document.getElementsByName ( 'delgg' )[0] );
	document.getElementsByName ( 'delcomp' )[0].checked = false;
	cookifyButton ( document.getElementsByName ( 'delcomp' )[0] );
	document.getElementsByName ( 'delbid' )[0].checked = false;
	cookifyButton ( document.getElementsByName ( 'delbid' )[0] );
	if ( document.getElementsByName ( "filterTreasures" )[0].value != '' )
	{
		var nom = document.getElementsByName ( "filterTreasures" )[0].value.toLowerCase ();
		anchorTitle.nodeValue = "TRESORS (filtr�s sur " + nom + ")";
		filterListElements ( tableTreasures, checkTreasureName, nom );
	}
	else
	{
		anchorTitle.nodeValue="TRESORS";
		filterListElements ( tableTreasures, checkAlwaysTrue, '' );
	}
}


// ********************************************************
// POPUPS
// ********************************************************

function creerBulle() {
        var newTd = document.createElement( 'td' );
        newTd.appendChild( document.createTextNode( 'Titre' ) );

        var newTr = document.createElement( 'tr' );
        newTr.setAttribute( 'class', 'mh_tdtitre' );
        //newTr.setAttribute( 'onclick', 'clickPop=false;cacherInfoBulle();' );
        newTr.appendChild( newTd );

        var newTable = document.createElement( 'table' );
        newTable.setAttribute( 'id', 'bulle' );
        newTable.setAttribute( 'class', 'mh_tdborder' );
        newTable.setAttribute( 'width', '300' );
        newTable.setAttribute( 'border', '0' );
        newTable.setAttribute( 'cellpadding', '5' );
        newTable.setAttribute( 'cellspacing', '1' );
        newTable.setAttribute( 'onclick', 'cacherInfoBulle();' );
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
				if ( nom.indexOf ( 'MONSTRES' ) != -1 || nom.indexOf ( 'TROLLS' ) != -1 || nom.indexOf ( 'LIEUX' ) != -1)
					nom = "L�gende couleurs des " + nom;
        noeud.setAttribute( 'onmouseover', "infoBulle('" + nom + "',event,'" + fonction + "','');" );
        noeud.setAttribute( 'onmouseout', "cacherInfoBulle();" );
}

function infoBulle( nom, evt, fonction, paramfct ) {
				//alert (paramfct[0]);
        var str;
        var val = nom.replace( /[ ]/g, '');
        val = nom.replace( /\W/g, '');
        val = val.toLowerCase();

        eval ( "str = "+fonction+"('"+nom+"','"+paramfct+"');" );
        if(str=="") return;
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
					 if ( fonction.indexOf ('gainPX') != -1 )
					 	element.childNodes[0].childNodes[0].innerHTML = '<b>Gain en PX en cas de kill</b>';
					 else
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

// *****************************************************
// Barre des PV (monstres et trolls)
// *****************************************************

function createBarrePV(color, pvr, pv, comment) { //color: 0=red, 1=gris
        var size=Math.floor((50*pvr)/pv); if ((size<50) && (size>48)) size=48;   // pour rendre plus joli
		var myTable=document.createElement('table');
		myTable.setAttribute('width','50');
		myTable.setAttribute('border','0');
		myTable.setAttribute('cellspacing','1');
		myTable.setAttribute('cellpadding','0');
		myTable.setAttribute('bgcolor','#000000'); 
		var myTr=document.createElement('tr');
		myTable.appendChild(myTr);
		var myTd=document.createElement('td');
		if (color==0) myTd.setAttribute('bgcolor','#FF0000'); else if (color==1) myTd.setAttribute('bgcolor','#AAAAAA'); else myTd.setAttribute('bgcolor','#FFFFFF');
		myTd.setAttribute('border','0');
		myTd.setAttribute('cellspacing','0');
		myTd.setAttribute('cellpadding','0');
		myTd.setAttribute('height','10');
		myTd.setAttribute('width',size);
		myTr.appendChild(myTd);
		if (size<50) {
			var myTd2=document.createElement('td');
			myTd2.setAttribute('border','0');
			myTd2.setAttribute('cellspacing','0');
			myTd2.setAttribute('cellpadding','0');
			if (color==-3) myTd2.setAttribute('bgcolor','#00FF00'); else myTd2.setAttribute('bgcolor','#FFFFFF');
			myTd2.setAttribute('height','10');
			myTd2.setAttribute('width',50-size);
			myTr.appendChild(myTd2);
		}
		if (comment=='') 
			myTable.setAttribute('title',pvr+'/'+pv+'PV ');
		else 
			myTable.setAttribute('title',comment);
		return myTable;
}


// ********************************************************
// Adding 2Dview's button
// ********************************************************

function getVueScript () 
{
	var maChaine = "MA VUE\n";
	maChaine += flattenNode (tableView.childNodes[1].childNodes[1].childNodes[3].childNodes[12]);
	if (tableLaby !=''){
		maChaine += "\nMurs et Couloirs\n";
		maChaine += flattenNode ( tableLaby[0].parentNode );
	}
	maChaine += "\nMONSTRES ERRANTS\n";
	maChaine += flattenNode ( tableMonsters[0].parentNode );
	maChaine += "\nTROLLS\n";
	maChaine += flattenNode ( tableTrolls[0].parentNode );
	maChaine += "\nTRESORS\n";
	maChaine += flattenNode ( tableTreasures[0].parentNode );
	maChaine += "\nCHAMPIGNONS\n";
	maChaine += flattenNode ( tableMushrooms[0].parentNode );
	maChaine += "\nLIEUX PARTICULIERS\n";
	maChaine += flattenNode ( tablePlaces[0].parentNode );
	maChaine += "\n[Contact : dm@mountyhall.com] - [Heure Serveur\n";
	return maChaine;
}

function checkViewForm ( form )
{
	form = document.select_troll;
	var textboxIdTroll = form.id_troll;
	if ( textboxIdTroll.value == "" || isNaN ( textboxIdTroll.value ) )
	{
		alert ( "Il faut mettre le num�ro du troll � qui appartient\ncette vue dans la petite case pour que �a marche !" );
		textboxIdTroll.focus ();
		return false;
	}
	else
	{
		form.action = URLVue2D;
		//window.open ( '', 'popupVue', 'width=" + (screen.width-150) + ", height=" + (screen.height-250) + ", toolbar=no, status=no, location=no, resizable=yes, scrollbars=yes' );
		window.open ( '', 'popupVue' );
		form.target = 'popupVue';
		//form.target = 'iframe_vue';
		form.submit ();
		return true;
	}	
}

// ********************************************************
// Adding login IFRAME
// ********************************************************

function deconn()
{
	var newdeConnScript = document.createElement ( 'script' );
  	newdeConnScript.setAttribute ( 'language', 'JavaScript' );
  	newdeConnScript.setAttribute ( 'src',  URLLoginRM + '?logout=true' );
  	( tablePlaces[tablePlaces.length-1].parentNode.parentNode.parentNode ).appendChild ( newdeConnScript );
}

function connect()
{
	var newConnectScript = document.createElement ( 'script' );
  	newConnectScript.setAttribute ( 'language', 'JavaScript' );
  	newConnectScript.setAttribute ( 'src',  URLLoginRM +'?login=true&numTroll='+document.getElementById('numTroll').value +'&password='+document.getElementById('password').value + '&autologin='+document.getElementById('autologin').value );
  	( tablePlaces[tablePlaces.length-1].parentNode.parentNode.parentNode ).appendChild ( newConnectScript );
}

function affDanger ()
{
	var distMax = document.getElementById('txtDist').value;
	
	if (!isNaN(distMax) && distMax>0)
	{
		var newDangScript = document.createElement ( 'script' );
		newDangScript.setAttribute ( 'language', 'JavaScript' );
		newDangScript.setAttribute ( 'src',  URLTopJs + 'menaces.php?x=' + posX + '&y=' + posY + '&n=' + posN + '&distmax=' + distMax );
		( tablePlaces[tablePlaces.length-1].parentNode.parentNode.parentNode ).appendChild ( newDangScript );
	}
	else
		alert ("La distance doit �tre un nombre sup�rieur � 0 !");
}

function hideDanger ()
{
	document.getElementById('danger').innerHTML='';
}

function creerThead( num ) {
    var noeud = totaltab[num].childNodes[0].firstChild;
    noeud.setAttribute( 'onclick', 'toggleTableau('+num+');' );
    var newThead = document.createElement( 'thead' );
    newThead.appendChild( noeud );
	var links=noeud.getElementsByTagName('a');
	for(var i=1;i<links.length;i++)
	{
		links[i].setAttribute('onmouseover','cursorOnLink=true;');
        links[i].setAttribute('onmouseout','cursorOnLink=false;');
	}
    totaltab[num].insertBefore( newThead , totaltab[num].childNodes[0]);
    if (num!=itbid) totaltab[num].childNodes[0].childNodes[0].childNodes[0].setAttribute( 'colspan', 9 );
    totaltab[num].childNodes[0].childNodes[0].childNodes[0].setAttribute('onmouseover', "this.style.cursor='pointer';this.className='mh_tdpage';");
    totaltab[num].childNodes[0].childNodes[0].childNodes[0].setAttribute('onmouseout', "this.className='mh_tdtitre';");
}

// ***********************************************
// Messages PX
// ***********************************************

function createMsgPXBouton() 
{
  var myForm=newForm( 'sendMP', '../Messagerie/MH_Messagerie.php?&dest=');
  var myTA=document.createElement('input');
  myTA.setAttribute('type','submit');
  myTA.setAttribute('value','Envoyer un Message Priv�');
  myTA.setAttribute('class','mh_form_submit');
  myTA.setAttribute('onMouseOver','this.style.cursor="pointer";');
  myTA.setAttribute('onClick','sendMessagePrive(3)');
  myForm.appendChild(myTA);

  myForm.appendChild(document.createTextNode(" "));

  var myTA=document.createElement('input');
  myTA.setAttribute('type','submit');
  myTA.setAttribute('value','Partage PX');
  myTA.setAttribute('class','mh_form_submit');
  myTA.setAttribute('onMouseOver','this.style.cursor="pointer";');
  myTA.setAttribute('onClick','sendMessagePrive(8)');
  myForm.appendChild(myTA);
  return myForm;
}  

function sendMessagePrive(cat) 
{
  var MP="../Messagerie/MH_Messagerie.php?cat="+cat+"&dest=";
  for ( var i = 1; i < tableTrolls.length;i++)
  {
		if ( tableTrolls[i].childNodes[2].firstChild.checked ) 
		{
			if (cat==8) MP += '%2C'+tableTrolls[i].childNodes[2].firstChild.value; 
			else MP += '+'+tableTrolls[i].childNodes[2].firstChild.value+'%2C'; 
		}
  }  
  if (cat==8) MP=MP.replace("=%2C", "=");	
  document.sendMP.action=MP;
} 

function putMsgPXBouton(arrtable) 
{
  arrtable.parentNode.insertBefore(createMsgPXBouton(),arrtable);      
}

// ***********************************************
// LEGENDES
// ***********************************************

function colorMonsters()
{
 text = "<table>";
 text += "<tr><td width='15%' bgcolor='" + colorUrg + "'>&nbsp;</td><td>Compo <b>ultra</b> prio pour les scribes !</td></tr>";
 text += "<tr><td width='15%' bgcolor='" + colorSearch + "'>&nbsp;</td><td>Compo prio pour les scribes !</td></tr>";
 text += "<tr><td width='15%' bgcolor='" + colorCdm + "'>&nbsp;</td><td>Vite, fais nous une CdM de la b�te !</td></tr>";
 text += "<tr><td width='15%' bgcolor='" + colorRM + "'>&nbsp;</td><td>Tiens, le gowap d'un pote !</td></tr>";
 text += "</table>";
 return text;
}

function colorTrolls()
{
  text = "<table>";
  text += "<tr><td width='15%' bgcolor='" + colorEnemy + "'>&nbsp;</td><td>Nom d'un streum ! c'est un wanted R&M !</td></tr>";
  text += "<tr><td width='15%' bgcolor='" + colorTK + "'>&nbsp;</td><td>Fais y gaffe c'est un TK !!!</td></tr>";
	text += "<tr><td width='15%' bgcolor='" + colorRM + "'>&nbsp;</td><td>Un R&M !</td></tr>";
  text += "<tr><td width='15%' bgcolor='" + colorFriend + "'>&nbsp;</td><td>Un pote de la guilde !</td></tr>";
  text += "<tr><td width='15%' bgcolor='" + colorAlly + "'>&nbsp;</td><td>Un alli� de la guilde !</td></tr>";
  text += "</table>";
	return text;
}

function colorPlaces()
{
  text = "<table>";
  text += "<tr><td width='15%' bgcolor='" + colorRM + "'>&nbsp;</td><td>Une tani�re R&M !</td></tr>";
  text += "</table>";
  return text;
}

function gainPX ( nivMonstre )
{
	var nivTroll = getCookie("NIV_TROLL");
	if ( nivTroll != "" )
	{
		if ( nivMonstre.indexOf ( '?' ) != -1 )
			return '0';
		else
		{
			var gain = nivMonstre - ( 2 * (nivTroll - nivMonstre)) + 10;
			if ( gain < 0 )
				return "0";
			else
				return gain;
		}
	}
	else
		return "Vas voir sur ton profil que je regarde ton niveau !";
}

function caracMonster ( monster, carac )
{
 var arrCarac = carac.split(";");
 text = "<table width='100%' align='center' class='mh_tdborder'>";
 text += "<tr><td class='mh_tdtitre' colspan='2' align='center'><b>" + arrCarac[0] + "</b></td></tr>";
 text += "<tr><td class='mh_tdtitre' width='20%'>Niv</td><td class='mh_tdpage'>" + arrCarac[1] + "</td></tr>";
 text += "<tr><td class='mh_tdtitre'>PdV</td><td class='mh_tdpage'>" + arrCarac[2] + "</td></tr>";
 text += "<tr><td class='mh_tdtitre'>Blessure</td><td class='mh_tdpage'>" + arrCarac[3] + "</td></tr>";
 text += "<tr><td class='mh_tdtitre'>Att</td><td class='mh_tdpage'>" + arrCarac[4] + "</td></tr>";
 text += "<tr><td class='mh_tdtitre'>Esq</td><td class='mh_tdpage'>" + arrCarac[5] + "</td></tr>";
 text += "<tr><td class='mh_tdtitre'>Deg</td><td class='mh_tdpage'>" + arrCarac[6] + "</td></tr>";
 text += "<tr><td class='mh_tdtitre'>Reg</td><td class='mh_tdpage'>" + arrCarac[7] + "</td></tr>";
 text += "<tr><td class='mh_tdtitre'>Arm</td><td class='mh_tdpage'>" + arrCarac[8] + "</td></tr>";
 text += "<tr><td class='mh_tdtitre'>Vue</td><td class='mh_tdpage'>" + arrCarac[9] + "</td></tr>";
 text += "<tr><td class='mh_tdtitre'>MM</td><td class='mh_tdpage'>" + arrCarac[10] + "</td></tr>";
 text += "<tr><td class='mh_tdtitre'>RM</td><td class='mh_tdpage'>" + arrCarac[11] + "</td></tr>";
 text += "<tr><td class='mh_tdtitre'>Nb Att</td><td class='mh_tdpage'>" + arrCarac[12] + "</td></tr>";
 text += "<tr><td class='mh_tdtitre'>Vit Dep</td><td class='mh_tdpage'>" + arrCarac[13] + "</td></tr>";
 text += "<tr><td class='mh_tdtitre'>VlC</td><td class='mh_tdpage'>" + arrCarac[14] + "</td></tr>";
 text += "<tr><td class='mh_tdtitre'>Att Dist</td><td class='mh_tdpage'>" + arrCarac[15] + "</td></tr>";
 text += "<tr><td class='mh_tdtitre'>Dur�e DLA</td><td class='mh_tdpage'>" + arrCarac[16] + "</td></tr>";
 if ( arrCarac[20] != "")
 	text += "<tr><td class='mh_tdtitre'>DLA</td><td class='mh_tdpage'>" + arrCarac[20] + "</td></tr>";
 if ( arrCarac[21] != "")
 	text += "<tr><td class='mh_tdtitre'>Chargement</td><td class='mh_tdpage'>" + arrCarac[21] + "</td></tr>";
 if ( arrCarac[22] != "")
 	text += "<tr><td class='mh_tdtitre'>B M</td><td class='mh_tdpage'>" + arrCarac[22] + "</td></tr>";
 if ( arrCarac[23] != "")
	 text += "<tr><td class='mh_tdtitre'>Vole</td><td class='mh_tdpage'>" + arrCarac[23] + "</td></tr>";
 if ( arrCarac[24] != "")
	 text += "<tr><td class='mh_tdtitre'>Sang froid</td><td class='mh_tdpage'>" + arrCarac[24] + "</td></tr>";
 if ( arrCarac[17] )
 {
 	text += "<tr><td class='mh_tdtitre'>Capacit�</td><td class='mh_tdpage'>" + arrCarac[17] + " affecte " + arrCarac[18];
 	if ( arrCarac[19] != 0)
 	{
 		text += "<br> Port&eacute;e : " + arrCarac[19];
 	}
 	text += "</tr></td>";
 }
 text += "<tr class='mh_tdpage'><td colspan='2' align='center'>Gain en PX si je le tue : " + gainPX (arrCarac[1]) + "</td></tr>";
 text += "</table>";
 return text;
}

// ********************************************************
// Troll and guild compendium links
// ********************************************************

function caracTroll ( troll, carac )
{
 var arrCarac = carac.split(";");
 text = "<table width='100%' align='center' class='mh_tdborder'>";
 text += "<tr><td class='mh_tdtitre' colspan='2' align='center'><b>" + arrCarac[0] + "</b></td></tr>";
 text += "<tr><td class='mh_tdtitre' width='20%'>DLA</td><td class='mh_tdpage'>" + arrCarac[1] + "</td></tr>";
 text += "<tr><td class='mh_tdtitre'>PdV</td><td class='mh_tdpage'>" + arrCarac[2] + "</td></tr>";
 text += "<tr><td class='mh_tdtitre'>Att</td><td class='mh_tdpage'>" + arrCarac[3] + "</td></tr>";
 text += "<tr><td class='mh_tdtitre'>Esq</td><td class='mh_tdpage'>" + arrCarac[4] + "</td></tr>";
 text += "<tr><td class='mh_tdtitre'>Deg</td><td class='mh_tdpage'>" + arrCarac[5] + "</td></tr>";
 text += "<tr><td class='mh_tdtitre'>Reg</td><td class='mh_tdpage'>" + arrCarac[6] + "</td></tr>";
 text += "<tr><td class='mh_tdtitre'>Arm</td><td class='mh_tdpage'>" + arrCarac[7] + "</td></tr>";
 text += "<tr><td class='mh_tdtitre'>Vue</td><td class='mh_tdpage'>" + arrCarac[8] + "</td></tr>";
 text += "<tr><td class='mh_tdtitre'>MM</td><td class='mh_tdpage'>" + arrCarac[9] + "</td></tr>";
 text += "<tr><td class='mh_tdtitre'>RM</td><td class='mh_tdpage'>" + arrCarac[10] + "</td></tr>";
 text += "</table>";
 return text;
}

function caracTrollAna ( troll, carac )
{
	var arrCarac = carac.split("|");
	text = "<table width='100%' align='center' class='mh_tdborder'>";
	text += "<tr><td class='mh_tdtitre' colspan='2' align='center'><b>AA faite le "+arrCarac[8]+" par "+arrCarac[9]+".</b></td></tr>";
	text += "<tr><td class='mh_tdtitre'>PdV</td><td class='mh_tdpage'>" + arrCarac[1].replace(/\(approximativement\)/,'') + "</td></tr>";
	text += "<tr><td class='mh_tdtitre'>Att</td><td class='mh_tdpage'>" + arrCarac[3] + "</td></tr>";
	text += "<tr><td class='mh_tdtitre'>Esq</td><td class='mh_tdpage'>" + arrCarac[2] + "</td></tr>";
	text += "<tr><td class='mh_tdtitre'>Deg</td><td class='mh_tdpage'>" + arrCarac[4] + "</td></tr>";
	text += "<tr><td class='mh_tdtitre'>Reg</td><td class='mh_tdpage'>" + arrCarac[5] + "</td></tr>";
	text += "<tr><td class='mh_tdtitre'>Arm</td><td class='mh_tdpage'>" + arrCarac[7] + "</td></tr>";
	text += "<tr><td class='mh_tdtitre'>Vue</td><td class='mh_tdpage'>" + arrCarac[6] + "</td></tr>";
	text += "</table>";
	return text;
}

function caracItem ( item, carac )
{
	text = "";
	text += "<table width='100%' align='center' class='mh_tdborder'>";
		text += "<tr><td class='mh_tdtitre' colspan='2'>"+carac+"</td></tr>";
	text += "</table>";
	return text;
}

function showHide(element)
{
	if ( $('>tr:eq(1)',$(element).parent().parent().parent().parent().parent().parent().parent()).is(":visible") )
		$('>tr',$(element).parent().parent().parent().parent().parent().parent().parent()).hide();
	else
		$('>tr',$(element).parent().parent().parent().parent().parent().parent().parent()).show();
	$('>tr:eq(0)',$(element).parent().parent().parent().parent().parent().parent().parent()).show();	
}
