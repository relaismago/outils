//On récupére les composants

var nodes = document.evaluate("//a[starts-with(@href,'TanierePJ_o_Stock.php?IDLieu=') or starts-with(@href,'Comptoir_o_Stock.php?IDLieu=')]/following::table[@width = '100%']/descendant::tr[contains(td[1]/a/b/text(),']') and td[1]/img/@alt = 'Identifié']", document, null, XPathResult.ORDERED_NODE_SNAPSHOT_TYPE, null);
var texte="";



//On définit la couleur
var anchorCss = document.getElementsByTagName ( 'link' )[0]; // ANCHOR

if ( anchorCss.getAttribute ( 'href' ).indexOf ( 'www.mountyhall.com' ) != -1 || anchorCss.getAttribute ( 'href' ).indexOf ( 'parchemin' ) != -1)
{
  var colorSearch = "#ff9f9f";
}
else
{
  var colorSearch = "#554444";
}

var begin=0;
var arrayCompo = "?script=gt&";

for (var i = 0; i < nodes.snapshotLength; i++)
{
 var node = nodes.snapshotItem(i);
 var debut=node.childNodes[1].childNodes[2].nodeValue.replace(/\n/g,'');
 var id_compo=debut.substring(debut.indexOf('[')+1,debut.indexOf(']'));
 //texte += id_compo+";"+node.childNodes[2].childNodes[3].childNodes[0].nodeValue+";pas défini\n";
 var nomCompo = node.childNodes[1].childNodes[3].firstChild.nodeValue.replace(/\n/g,'')+node.childNodes[1].childNodes[3].childNodes[1].firstChild.nodeValue.replace(/\n/g,'');
 arrayCompo += "composId[]=" + id_compo +"&compo[]=" + escape (nomCompo) + "&";
// Adding script for coloring priorities compos

if ( i != 0 )
{

 if ( i%30 == 0 )
 {
  	arrayCompo += "begin=" + begin;
  	newCompoScript = document.createElement ( 'script' );
  	newCompoScript.setAttribute ( 'language', 'JavaScript' );
  	newCompoScript.setAttribute ( 'src',  URLTopJs + "compos.php"  + arrayCompo );
	document.body.appendChild ( newCompoScript );
  	arrayCompo = "?script=gt&";
  	begin = i + 1;
 }
}

}

if ( arrayCompo != "?script=gt&")
{
	  arrayCompo += "begin=" + begin;
	  newCompoScript = document.createElement ( 'script' );
	  newCompoScript.setAttribute ( 'language', 'JavaScript' );
	  newCompoScript.setAttribute ( 'src',  URLTopJs + "compos.php"  + arrayCompo );
		document.body.appendChild ( newCompoScript );
}


