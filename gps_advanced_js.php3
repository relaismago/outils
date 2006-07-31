<?php

function javascript_image($x,$y,$vue,$taille_map)
{

?>
	<script Language="JavaScript">

	self.focus();

	var xx, xxx, yy, yyy, oldX, oldY,x,y, zoom, boiboite, backmap;
	var offsetX, offsetY;
	var zoom=0;
	// backimg;


	function init() {
		oldX=0; oldY=0;
		zoom=0;
		if(navigator.appName.substring(0,3) == "Net")
			document.captureEvents(Event.MOUSEMOVE);
		boiboite=document.getElementById("upRect");
		backimg=document.getElementById("carteDyn");
		boiboite.onmousemove = get_mouse;
		backimg.onmousemove = get_mouse;

		// Récupération de la position de l'image
		offsetX=backimg.x;
		offsetY=backimg.y;
	}

	function mouseDown() {
		if (zoom==1) { 
			zoom=0; 
			// backmap.style.cursor="pointer";
			// boiboite.style.cursor="pointer";
			// backimg.style.cursor="crosshair";
			boiboite.onclic=doZoom;
			boiboite.onmousedown=doZoom;
		} else {
			zoom=1; 
			// backmap.style.cursor="pointer";
			// boiboite.style.cursor="se-resize";
			// backimg.style.cursor="se-resize";
			boiboite.onclic=mouseDown;
			boiboite.onmousedown=mouseDown;
		}
		oldX=x;
		oldY=y;
	}

	var offX,offY, coeff, taille_plan, taille_image, offX2, offY2;
	Xp1=<? echo $x-$vue; ?>;
	Xp2=<? echo $x+$vue; ?>;
	Yp1=<? echo $y-$vue; ?>;
	Yp2=<? echo $y+$vue; ?>;
	coeff=<? echo ($vue*2)/$taille_map; ?>; // Par combien on * le xx ou le xxx pour avoir une case

	function doZoom(){
		var newLarg, newHaut, coeff, newXMin, newXMax, newYMin, newYMax, taille, centerX, centerY;

		newLarg=document.form_gps_advanced.XX.value-document.form_gps_advanced.X1.value;
		newHaut=document.form_gps_advanced.YY.value-document.form_gps_advanced.Y1.value;
		
		//On prend le plus grand coté pour faire un carré
		if (newLarg> newHaut)
			taille=newLarg;
		else
			taille=newHaut;
			
		centerX=parseInt(document.form_gps_advanced.X1.value)+parseInt(newLarg/2);
		centerY=parseInt(document.form_gps_advanced.Y1.value)+parseInt(newHaut/2);
		taille=parseInt(taille/2);
		// On cherche une vue modulo 10 (comme la listbox)
		while ((taille % 10) != 0)
		{
			taille++;
		}
		document.form_gps_advanced.x.options[-centerX+200].selected = true;
		document.form_gps_advanced.y.options[-centerY+200].selected = true;
		document.form_gps_advanced.vue.options[taille/10].selected = true;
		document.form_gps_advanced.submit();
	}

	function get_mouse(e)
	{
		x = (navigator.appName.substring(0,3) == "Net") ? e.pageX : event.x+document.body.scrollLeft;
		y = (navigator.appName.substring(0,3) == "Net") ? e.pageY : event.y+document.body.scrollTop;
		if (zoom == 1) {
			if (document.all)
				boiboite.style.filter="progid:DXImageTransform.Microsoft.Alpha(opacity=100)";
		}
		if (zoom==1) {
			if (x<oldX) { xx=x; xxx=oldX; Xdir="w";} else { xx=oldX; xxx=x; Xdir="e";}
			if (y<oldY) { yy=y; yyy=oldY; Ydir="n";} else { yy=oldY; yyy=y; Ydir="s";}
			if (xx==xxx) {xxx=xx+1; }
			if (yy==yyy) {yyy=yy+1; }
			boiboite.style.left = xx;
			boiboite.style.top = yy;
			boiboite.style.width = xxx - xx;
			boiboite.style.height = yyy - yy;
			boiboite.style.border = "3px dotted red";
			boiboite.style.cursor=Ydir + Xdir + "-resize";
			//backimg.style.cursor=Ydir + Xdir + "-resize";
		}
		document.form_gps_advanced.X1.value=(xx-offsetX)*coeff+Xp1;
		document.form_gps_advanced.XX.value=(xxx-offsetX)*coeff+Xp1;
		document.form_gps_advanced.Y1.value=(<? echo $taille_map; ?>-yy+offsetY)*coeff+Yp1;
		document.form_gps_advanced.YY.value=(<? echo $taille_map; ?>-yyy+offsetY)*coeff+Yp1;
		
	}
	</script>
<?
}
?>
<script>
function swapSpan(id,img,id_hid)
{
	obj = document.getElementById(id);
	img = document.getElementById(img);
	id_hid = document.getElementById(id_hid);

	if (id_hid.value == 'block') {
		obj.style.display = 'none';
		img.src='images/triangle-bleu.gif';
		id_hid.value = 'none';
		ret = 'block';
	} else {
		obj.style.display = 'block';
		img.src='images/triangle-bleu-bas.gif';
		id_hid.value = 'block';
		ret = 'none';
	}
	return ret;
}

</script>
<?
?>
