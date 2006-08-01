domok = document.getElementById;
if (domok)
	{
	skn = document.getElementById("topdecklink").style;
	if(navigator.appName.substring(0,3) == "Net")
		document.captureEvents(Event.MOUSEMOVE);
	document.onmousemove = get_mouse;
	}

function changeJourTroll()
{
	document.formulaire_compo.date_fin_composant.value=
	  document.formulaire_compo.jour.value+
		document.formulaire_compo.mois.value*28+
		document.formulaire_compo.cycle.value*378;
}

function updateStatic(msg)
{
	if (domok)
		{
	  	document.getElementById("staticdecklink").innerHTML = document.getElementById("topdecklink").innerHTML;
  		}
}

function poplink(msg)
{

var content ="<TABLE class='floatWin' BORDER=0 CELLPADDING=0 CELLSPACING=0><TR><TD><TABLE class='inner' WIDTH=100% BORDER=0 CELLPADDING=2 CELLSPACING=1><TR><TD><FONT COLOR=#FFFFFF SIZE=1 face='Georgia, Times New Roman, Times, serif'>"+msg+"</TD></TR></TABLE></TD></TR></TABLE>";

	if (domok)
		{
	  	document.getElementById("topdecklink").innerHTML = content;
	  	skn.visibility = "visible";
  		}
}

function get_mouse(e)
	{
	var x = (navigator.appName.substring(0,3) == "Net") ? e.pageX : event.x+document.body.scrollLeft;
	var y = (navigator.appName.substring(0,3) == "Net") ? e.pageY : event.y+document.body.scrollTop;
	skn.left = x - 0;
	skn.top = y+20;
	}

function killlink()
	{
	if (domok)
  		skn.visibility = "hidden";
	}


function getMouseX(EventObjName)
{
    if(document.all)
    {
        return document.body.scrollLeft + event.clientX 
    }
    else
    {
        return EventObjName.pageX
    }
}

function getMouseY(EventObjName)
{
    if(document.all)
    {
        return document.body.scrollTop + event.clientY
    }
    else
    {
        return EventObjName.pageY       
    }
}

function call_zoom(x, y)
{
        var offset_x = 52;
        var offset_y = 75;

        var tmp_x = ( (x-offset_x)/5 )-100;
        var tmp_y = 100 - ( (y-offset_y)/5 );
        
        var new_x = 10*Math.floor(tmp_x/10);
        var new_y = 10*(Math.floor(tmp_y/10)+1);
        //alert(new_x+" - "+new_y);
        var url = "gps_zoom.php?ax="+new_x+"&ay="+new_y;
        window.open(url);
}

function EnterPJView(IdCible,Largeur,Hauteur){
        DetailView = window.open("","DetailView",'width=' + Largeur + ',height=' + Hauteur + ',toolbar=0,location=0,directories=0,status=0,menubar=0,resizable=1,scrollbars=1');
        DetailView.location = "http://games.mountyhall.com/mountyhall/View/PJView.php?ai_IDPJ=" + IdCible;
}

