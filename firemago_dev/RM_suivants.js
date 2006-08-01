function flattenNode ( node )
{
  var result = '';
  for ( var i = 0; i < node.childNodes.length; i++ )
  {
    if ( node.childNodes[i].hasChildNodes () )
    {
      if ( node.childNodes[i].nodeName == "TD" || node.childNodes[i].nodeName == "TR" ) 
			{
				if (node.childNodes[i].getAttribute ('bgcolor') == "#ffffee")
				{
					node.childNodes[i].setAttribute ('class','mh_tdpage');
				}
				if (node.childNodes[i].getAttribute ('bgcolor') == "#99ccff")
				{
					node.childNodes[i].setAttribute ('class','mh_tdtitre');
				}
			}
			if ( node.childNodes[i].nodeName == "TABLE" )
			{
				if (node.childNodes[i].getAttribute ('bgcolor') == "#000000")
				{
					node.childNodes[i].setAttribute ('class','mh_tdborder');
				}
			}
      flattenNode ( node.childNodes[i] );
    }
  }
}

var anchorCss = document.getElementsByTagName ( 'link' )[0]; // ANCHOR
if ( anchorCss.getAttribute ( 'href' ).indexOf ( 'www.mountyhall.com' ) == -1 )
{
	flattenNode ( document ) ;
}
