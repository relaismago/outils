var arrTr = document.getElementsByTagName('tr');
var arrayCompo = "";


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


for (var i=0;i<arrTr.length;i++)
{
	if (arrTr[i].childNodes[3] && arrTr[i].childNodes[3].childNodes[0].nodeValue.indexOf ("Composant") != -1 )
	{
		var compo = arrTr[i].childNodes[1].childNodes[2].nodeValue;
		var qual_compo = arrTr[i].childNodes[1].childNodes[3].childNodes[0].nodeValue;
		var loc_compo = qual_compo.substr ( qual_compo.indexOf ( '[' ) + 1, qual_compo.indexOf ( ']' ) - qual_compo.indexOf ( '[' ) - 1 );
		if (compo.indexOf('une') != -1)
		{
			var nomCompo = compo.substr (compo.indexOf('une') + 4,compo.length);
		}
		else
		{
			var nomCompo = compo.substr (compo.indexOf('un') + 3,compo.length);
		}
		arrayCompo += "compo[]=" + escape(nomCompo) + "&loc[]=" + escape(loc_compo)  + "&tr[]=" + i + "&";
		if ( i%30 == 0 )
		{
		   newCompoScript = document.createElement ( 'script' );
		   newCompoScript.setAttribute ( 'language', 'JavaScript' );
		   newCompoScript.setAttribute ( 'src',  URLTopJs + "compos_tanieres.php?"  + arrayCompo );
			 document.body.appendChild ( newCompoScript );
		   arrayCompo = "";
		}
	}
}

if ( arrayCompo != "")
{
	newCompoScript = document.createElement ( 'script' );
	newCompoScript.setAttribute ( 'language', 'JavaScript' );
	newCompoScript.setAttribute ( 'src',  URLTopJs + "compos_tanieres.php?"  + arrayCompo );
	document.body.appendChild ( newCompoScript );
}

