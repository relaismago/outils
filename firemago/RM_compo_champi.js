function getCookie(name)
{
 var dc = document.cookie;
 var prefix = name + "=";
 var begin = dc.indexOf("; " + prefix);
 if (begin == -1) 
 {
  begin = dc.indexOf(prefix);
  if (begin != 0) return '';
 }
 else
  begin += 2;
  var end = document.cookie.indexOf(";", begin);
  if (end == -1)
   end = dc.length;
 return unescape(dc.substring(begin + prefix.length, end));
}


//On récupère les composants
var nodes = document.evaluate("//table[@id='table_Composant']/descendant::tr/descendant::img[@alt = 'Composant - Spécial']/../..", document, null, XPathResult.ORDERED_NODE_SNAPSHOT_TYPE, null);

var texte="";
var arrayCompo = "?";
var begin = 2;

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


for (var i = 0; i < nodes.snapshotLength; i++)
{
 var node = nodes.snapshotItem(i);
 var id_compo = node.childNodes[0].childNodes[1].getAttribute('value');
 texte += id_compo+";"+node.childNodes[2].childNodes[3].childNodes[0].nodeValue+";pas défini\n";
 arrayCompo += "composId[]=" + id_compo +"&compo[]=" + escape (node.childNodes[2].childNodes[3].childNodes[0].nodeValue) + "&";
// Adding script for coloring priorities compos
	
	/*if ( i%30 == 0 )
	{
  	arrayCompo += "begin=" + begin;
  	newCompoScript = document.createElement ( 'script' );
  	newCompoScript.setAttribute ( 'language', 'JavaScript' );
  	newCompoScript.setAttribute ( 'src',  URLTopJs + "compos.php"  + arrayCompo );
		document.body.appendChild ( newCompoScript );
  	arrayCompo = "";
  	begin = i + 1;
	}*/
}

if ( arrayCompo != "")
{
	  arrayCompo += "begin=" + begin;
	  newCompoScript = document.createElement ( 'script' );
	  newCompoScript.setAttribute ( 'language', 'JavaScript' );
	  newCompoScript.setAttribute ( 'src',  URLTopJs + "compos.php"  + arrayCompo );
		document.body.appendChild ( newCompoScript );
}


if(nodes.snapshotLength>0)
{
 var id_taniere=-1;
 var loc='sac';
 var nbsp="\240";
 texte=texte.replace(/\240/g," ").replace(/d'un/g,"d un");
            
 var myForm= document.createElement('form');
 myForm.setAttribute('method','post');
 myForm.setAttribute('align','center');
 myForm.setAttribute('action','http://darkwood.free.fr/divers/compodb.php');
 myForm.setAttribute('target','_blank');
 var myTA=document.createElement('input');
 myTA.setAttribute('type','hidden');
 myTA.setAttribute('name','compo');
 myTA.setAttribute('value',texte);
 myForm.appendChild(myTA);
 myTA=document.createElement('input');
 myTA.setAttribute('type','hidden');
 myTA.setAttribute('name','id_troll');
 myTA.setAttribute('value',getCookie("NUM_TROLL"));
 myForm.appendChild(myTA);
 myTA=document.createElement('input');
 myTA.setAttribute('type','hidden');
 myTA.setAttribute('name','source');
 myTA.setAttribute('value',loc);
 myForm.appendChild(myTA);
 myTA=document.createElement('input');
 myTA.setAttribute('type','hidden');
 myTA.setAttribute('name','id_source');
 myTA.setAttribute('value',id_taniere);
 myForm.appendChild(myTA);
 myTA=document.createElement('input');
 myTA.setAttribute('type','submit');
 myTA.setAttribute('value','Vendre ces composants sur compo land');
 myTA.setAttribute('class','mh_form_submit');
 myTA.setAttribute('onMouseOver','this.style.cursor=\'hand\';');
 myForm.appendChild(myTA);
 myTD=document.createElement('td');
 myTD.setAttribute('align','center');
 myTD.appendChild(myForm);
 myTD.appendChild(document.createTextNode("  "));
 myTR=document.createElement('tr');
 myTR.setAttribute('class','mh_tdpage');
 myTR.appendChild(document.createElement('td'));
 myTR.childNodes[0].appendChild(document.createElement('input'));
 myTR.childNodes[0].childNodes[0].setAttribute('type','hidden');
 myTR.childNodes[0].childNodes[0].setAttribute('value','0');
 myTR.appendChild(myTD);
 nodes.snapshotItem(0).parentNode.insertBefore(myTR,nodes.snapshotItem(0).parentNode.childNodes[0]);
}

