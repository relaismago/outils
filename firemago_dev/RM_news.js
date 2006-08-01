var totaltab = document.getElementsByTagName ( 'table' );

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
insertPoint = totaltab[3];
insertPoint.parentNode.insertBefore ( newline, insertPoint );
insertPoint.parentNode.insertBefore ( myTable, newline );