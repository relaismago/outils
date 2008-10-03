var totaltab = document.getElementsByTagName ( 'table' );

// ********************************************************
// Adding login IFRAME
// ********************************************************

function deconn()
{
	var newdeConnScript = document.createElement ( 'script' );
  	newdeConnScript.setAttribute ( 'language', 'JavaScript' );
  	newdeConnScript.setAttribute ( 'src',  URLLoginRM + '?logout=true' );
  	document.body.appendChild ( newdeConnScript );
}

function connect()
{
	var newConnectScript = document.createElement ( 'script' );
  	newConnectScript.setAttribute ( 'language', 'JavaScript' );
  	newConnectScript.setAttribute ( 'src',  URLLoginRM +'?login=true&numTroll='+document.getElementById('numTroll').value +'&password='+document.getElementById('password').value + '&autologin='+document.getElementById('autologin').value );
  	document.body.appendChild ( newConnectScript );
}

var myTable = document.createElement ( 'table' );
myTable.setAttribute ( 'width', '98%' );
myTable.setAttribute ( 'border', '0' );
myTable.setAttribute ( 'align', 'center' );
myTable.setAttribute ( 'cellpadding', '4' );
myTable.setAttribute ( 'cellspacing', '1' );
myTable.setAttribute ( 'class', 'mh_tdborder' );

var myDiv = document.createElement ( 'div' );
myDiv.setAttribute ( 'id', 'conn' );
var newConnScript = document.createElement ( 'script' );
newConnScript.setAttribute ( 'language', 'JavaScript' );
newConnScript.setAttribute ( 'src',  URLLoginRM );

document.body.appendChild ( newConnScript );

var myTr = document.createElement ( 'tr' );
myTr.setAttribute ( 'class','mh_tdtitre' );
myTable.appendChild( myTr );

var myTd = document.createElement ( 'td' );

myTd.appendChild ( myDiv );
myTr.appendChild ( myTd );


var newline = document.createElement ( 'p' );
insertPoint = totaltab[3];
insertPoint.parentNode.insertBefore ( newline, insertPoint );
insertPoint.parentNode.insertBefore ( myTable, newline );