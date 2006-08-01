function getCookie(name) {
  var dc = document.cookie;
  var prefix = name + "=";
  var begin = dc.indexOf("; " + prefix);
  if (begin == -1) {
    begin = dc.indexOf(prefix);
    if (begin != 0) return '';
  } else
    begin += 2;
  var end = document.cookie.indexOf(";", begin);
  if (end == -1)
    end = dc.length;
  return unescape(dc.substring(begin + prefix.length, end));
}

function setCookie(name, value, expires, path, domain, secure) {
  var expdate = new Date ();
  expdate.setTime (expdate.getTime() + (24 * 60 * 60 * 1000 * 31));
  var curCookie = name + "=" + escape(value) +
  ((expires) ? "; expires=" + expires.toGMTString() : "; expires="+expdate.toGMTString()) +
  ((path) ? "; path=" + path : path) +
  ((domain) ? "; domain=" + domain : "") +
  ((secure) ? "; secure" : "");
  document.cookie = curCookie;
}

function putLinks() {
  if(getCookie("URL1")!="")
  {
    var div=document.getElementsByTagName('div')[1];
    var myDivi=document.createElement('DIV');
    myDivi.setAttribute('align','LEFT');
    myDivi.appendChild(document.createElement('A'));
    myDivi.childNodes[0].setAttribute('href',getCookie("URL1"));
    myDivi.childNodes[0].setAttribute('target','_blank');
    myDivi.childNodes[0].setAttribute('CLASS','AllLinks');
    myDivi.childNodes[0].appendChild(document.createTextNode("["+getCookie("NOM1")+"]"));
    if(getCookie("URL2")!="")
    {
      myDivi.appendChild(document.createElement('A'));
      myDivi.childNodes[1].setAttribute('href',getCookie("URL2"));
      myDivi.childNodes[1].setAttribute('target','_blank');
      myDivi.childNodes[1].setAttribute('CLASS','AllLinks');
      myDivi.childNodes[1].appendChild(document.createTextNode("["+getCookie("NOM2")+"]"));

      if(getCookie("URL3")!="")
      {
        myDivi.appendChild(document.createElement('A'));
        myDivi.childNodes[2].setAttribute('href',getCookie("URL3"));
        myDivi.childNodes[2].setAttribute('target','_blank');
        myDivi.childNodes[2].setAttribute('CLASS','AllLinks');
        myDivi.childNodes[2].appendChild(document.createTextNode("["+getCookie("NOM3")+"]"));
      }
    }
    div.parentNode.insertBefore(myDivi,div);
  }
}


function deleteGG()
{
   var bouton=document.getElementsByName('delgg')[0];
   if(bouton.checked == true)
   {
      setCookie("NOGG","true");
   }
   else
   {
      setCookie("NOGG","false");
   }
   for (var i=1;i<x_tresors.length;i++)
   {
      if(x_tresors[i].className == 'mh_tdpage' && x_tresors[i].childNodes.length==6 && x_tresors[i].childNodes[2].childNodes[0].nodeName == "B")
      {
         if(x_tresors[i].childNodes[2].childNodes[0].firstChild.nodeName == "#text" && x_tresors[i].childNodes[2].childNodes[0].firstChild.nodeValue.indexOf("Gigots de Gob")!=-1)
	 {
	    if(bouton.checked == false)
	       x_tresors[i].style.display='';
	    else
	       x_tresors[i].style.display='none';
         }
      }
   }
}

function deleteComp()
{
   var bouton=document.getElementsByName('delcomp')[0];
   if(bouton.checked)
   {
      setCookie("NOCOMP","true");
      var len=x_tresors.length;
      for (var i=1;i<len;i++)
      {
         var tresor=x_tresors[i];
         if(tresor.childNodes[2].childNodes[0].firstChild.nodeName == "#text" && tresor.childNodes[2].childNodes[0].firstChild.nodeValue.substr(0,10)==" Composant")
	 {
	       tresor.style.display='none';
         }
      }
    }
    else
    {
       setCookie("NOCOMP","false");
       var len=x_tresors.length;
       for (var i=1;i<len;i++)
       {
         var tresor=x_tresors[i];
         if(tresor.childNodes[2].childNodes[0].firstChild.nodeName == "#text" && tresor.childNodes[2].childNodes[0].firstChild.nodeValue.substr(0,10)==" Composant")
	 {
	       tresor.style.display='';
         }
       }
    }
}

function getNumeroNomMonstre()
{
   var bouton=document.getElementsByName('delniveau')[0];
   if(bouton.checked)
   	return 2;
   return 3;
}

function deleteGowap()
{
   var bouton=document.getElementsByName('delgowap')[0];
   if(bouton.checked == true)
   {
       setCookie("NOGOWAP","true");
   }
   else
   {
       setCookie("NOGOWAP","false");
   }
   for (var i=1;i<x_monstres.length;i++)
   {
       if(x_monstres[i].childNodes[getNumeroNomMonstre()].childNodes[0].firstChild.nodeValue.indexOf("Gowap Apprivoisé")!=-1 && parseInt( x_monstres[i].childNodes[0].firstChild.nodeValue ) > 1 )
       {
	   if(!bouton.checked)
	       x_monstres[i].style.display='';
           else
               x_monstres[i].style.display='none';
       }
   }
}
function deleteNiveau()
{
   var bouton=document.getElementsByName('delniveau')[0];
   if(!bouton.checked)
   {
       var expdate = new Date ();
       expdate.setTime (expdate.getTime() + (24 * 60 * 60 * 1000 * 31));
       setCookie("NIVEAU","oui",expdate,"/");
       creerOnclickMonstres();
       if(!isLevelComputed)
         putLevel();
   }
   else
   {
       var expdate = new Date ();
       expdate.setTime (expdate.getTime() + (24 * 60 * 60 * 1000 * 31));
       setCookie("NIVEAU","non",expdate,"/");
       for (var i=0;i<x_monstres.length;i++)
       {
          var listeTD=x_monstres[i].getElementsByTagName('td');
          listeNiveau[i]=listeTD[2].childNodes[0].nodeValue;
          listeTD[2].parentNode.removeChild(listeTD[2]);
       }
   }
}


function deleteIntangible()
{
   var bouton=document.getElementsByName('delint')[0];
   if(bouton.checked == true)
   {
      setCookie("NOINT","true");
   }
   else
   {
      setCookie("NOINT","false");
   }
   for (var i=1;i<x_trolls.length;i++)
   {
      if (x_trolls[i].className == 'mh_tdpage' && x_trolls[i].childNodes.length>6 && x_trolls[i].childNodes[2].childNodes[1].className == 'mh_trolls_0')
      {
         if(!bouton.checked)
	    x_trolls[i].style.display='';
	 else
	    x_trolls[i].style.display='none'
      }
   }
}

function deleteBidouille()
{
   var bouton=document.getElementsByName('delbid')[0];
   if(bouton.checked == true)
   {
      setCookie("NOBID","true");
   }
   else
   {
      setCookie("NOBID","false");
   }
   for (var i=1;i<x_tresors.length;i++)
   {
      if(x_tresors[i].className == 'mh_tdpage' && x_tresors[i].childNodes.length==6 && x_tresors[i].childNodes[2].childNodes[0].nodeName == "B")
      {
        if((x_tresors[i].childNodes[2].childNodes[0].firstChild.nodeName == "A")||(x_tresors[i].childNodes[2].childNodes[0].childNodes.length >1 && x_tresors[i].childNodes[2].childNodes[0].childNodes[1].nodeName == "A"))
	 {
	    if(!bouton.checked)
	       x_tresors[i].style.display='';
	    else
	       x_tresors[i].style.display='none';
         }
      }
   }
}

function getScript()
{
   var maChaine="#DEBUT TROLLS\n"
   var arrtable=totaltab[6];
   for(var i=1;i<arrtable.childNodes[1].childNodes.length;i++)
   {
     var tr=arrtable.childNodes[1].childNodes[i];
     maChaine+=tr.childNodes[1].childNodes[0].nodeValue+";"+tr.childNodes[6].childNodes[0].nodeValue+";"+tr.childNodes[7].childNodes[0].nodeValue+";"+tr.childNodes[8].childNodes[0].nodeValue+"\n";
   }
   maChaine+="#FIN TROLLS\n#DEBUT MONSTRES\n";
   arrtable=totaltab[4];
   for(var i=1;i<arrtable.childNodes[1].childNodes.length;i++)
   {
      var tr=arrtable.childNodes[1].childNodes[i];
      var j=getNumeroNomMonstre();
      maChaine+=tr.childNodes[1].childNodes[0].nodeValue+";"+tr.childNodes[j].childNodes[0].childNodes[0].nodeValue+";"+tr.childNodes[j+1].childNodes[0].nodeValue+";"+tr.childNodes[j+2].childNodes[0].nodeValue+";"+tr.childNodes[j+3].childNodes[0].nodeValue+"\n";
   }
   maChaine+="#FIN MONSTRES\n#DEBUT TRESORS\n";
   arrtable=totaltab[8];
   for(var i=1;i<arrtable.childNodes[1].childNodes.length;i++)
   {
      var tr=arrtable.childNodes[1].childNodes[i];
      maChaine+=tr.childNodes[1].childNodes[0].nodeValue+";"+getAllText(tr.childNodes[2]).replace(/^\s+/,"")+";"+tr.childNodes[3].childNodes[0].nodeValue+";"+tr.childNodes[4].childNodes[0].nodeValue+";"+tr.childNodes[5].childNodes[0].nodeValue+"\n";
   }
   maChaine+="#FIN TRESORS\n#DEBUT LIEUX\n";
   arrtable=totaltab[12];
   for(var i=1;i<arrtable.childNodes[1].childNodes.length;i++)
   {
      var tr=arrtable.childNodes[1].childNodes[i];
      maChaine+=tr.childNodes[1].childNodes[0].nodeValue+";"+getAllText(tr.childNodes[2])+";"+tr.childNodes[3].childNodes[0].nodeValue+";"+tr.childNodes[4].childNodes[0].nodeValue+";"+tr.childNodes[5].childNodes[0].nodeValue+"\n";
   }
   maChaine+="#FIN LIEUX\n#DEBUT CHAMPIGNONS\n";
   arrtable=totaltab[10];
   for(var i=1;i<arrtable.childNodes[1].childNodes.length;i++)
   {
      var tr=arrtable.childNodes[1].childNodes[i];
      maChaine+=tr.childNodes[1].childNodes[0].nodeValue+";"+tr.childNodes[2].childNodes[0].nodeValue+";"+tr.childNodes[3].childNodes[0].nodeValue+";"+tr.childNodes[4].childNodes[0].nodeValue+";"+tr.childNodes[5].childNodes[0].nodeValue+"\n";
   }
   maChaine+="#FIN CHAMPIGNONS\n";
   return maChaine;

}

function getVueScript2()
{
   var arrtable=totaltab[3];
   var pos=arrtable.childNodes[1].childNodes[2].childNodes[4].childNodes[1].childNodes[1].childNodes[2].childNodes[0].nodeValue;
   var posx=pos.substring(pos.indexOf('=')+2,pos.indexOf(','));
   pos=pos.substr(pos.indexOf(',')+1);
   var posy=pos.substring(pos.indexOf('=')+2,pos.indexOf(','));
   var posn=pos.substr(pos.lastIndexOf('=')+2);
   pos=arrtable.childNodes[1].childNodes[2].childNodes[4].childNodes[1].childNodes[5].childNodes[2].childNodes[0].nodeValue;
   var vue=pos.substring(1,pos.indexOf('cases')-1);
   return getScript()+"#DEBUT ORIGINE\n"+vue+";"+posx+";"+posy+";"+posn+"\n#FIN ORIGINE\n";
}

function getLieux()
{
   var maChaine="";
   var arrtable=totaltab[3];
   var pos=arrtable.childNodes[1].childNodes[2].childNodes[4].childNodes[1].childNodes[1].childNodes[2].childNodes[0].nodeValue;
   var posx=pos.substring(pos.indexOf('=')+2,pos.indexOf(','));
   pos=pos.substr(pos.indexOf(',')+1);
   var posy=pos.substring(pos.indexOf('=')+2,pos.indexOf(','));
   var posn=pos.substr(pos.lastIndexOf('=')+2);
   pos=arrtable.childNodes[1].childNodes[2].childNodes[4].childNodes[1].childNodes[5].childNodes[2].childNodes[0].nodeValue;
   var vuexy=pos.substring(1,pos.indexOf('cases')-1);
   pos=arrtable.childNodes[1].childNodes[2].childNodes[4].childNodes[1].childNodes[5].childNodes[4].childNodes[0].nodeValue;
   var vuen=pos.substring(1,pos.indexOf('verti')-1);
   maChaine+=posx+";"+posy+";"+posn+";"+vuexy+";"+vuen+"\n";
   arrtable=totaltab[12];
   for(var i=1;i<arrtable.childNodes[1].childNodes.length;i++)
   {
      var tr=arrtable.childNodes[1].childNodes[i];
      maChaine+=tr.childNodes[1].childNodes[0].nodeValue+";"+getAllText(tr.childNodes[2])+";"+tr.childNodes[3].childNodes[0].nodeValue+";"+tr.childNodes[4].childNodes[0].nodeValue+";"+tr.childNodes[5].childNodes[0].nodeValue+"\n";
   }
   return maChaine;
}

function getMonstres()
{
   var maChaine="";
   var arrtable=totaltab[3];
   var pos=arrtable.childNodes[1].childNodes[2].childNodes[4].childNodes[1].childNodes[1].childNodes[2].childNodes[0].nodeValue;
   var posx=pos.substring(pos.indexOf('=')+2,pos.indexOf(','));
   pos=pos.substr(pos.indexOf(',')+1);
   var posy=pos.substring(pos.indexOf('=')+2,pos.indexOf(','));
   var posn=pos.substr(pos.lastIndexOf('=')+2);
   pos=arrtable.childNodes[1].childNodes[2].childNodes[4].childNodes[1].childNodes[5].childNodes[2].childNodes[0].nodeValue;
   var vuexy=pos.substring(1,pos.indexOf('cases')-1);
   pos=arrtable.childNodes[1].childNodes[2].childNodes[4].childNodes[1].childNodes[5].childNodes[4].childNodes[0].nodeValue;
   var vuen=pos.substring(1,pos.indexOf('verti')-1);
   maChaine+=posx+";"+posy+";"+posn+";"+vuexy+";"+vuen+"\n";
   arrtable=totaltab[4];
   var j=getNumeroNomMonstre();
   for(var i=1;i<arrtable.childNodes[1].childNodes.length;i++)
   {
      var tr=arrtable.childNodes[1].childNodes[i];
      maChaine+=tr.childNodes[1].childNodes[0].nodeValue+";"+tr.childNodes[j].childNodes[0].childNodes[0].nodeValue+";"+tr.childNodes[j+1].childNodes[0].nodeValue+";"+tr.childNodes[j+2].childNodes[0].nodeValue+";"+tr.childNodes[j+3].childNodes[0].nodeValue+"\n";
   }
   return maChaine;
}

function getVueScript()
{
   var arrtable=totaltab[3];
   pos=arrtable.childNodes[1].childNodes[2].childNodes[4].childNodes[1].childNodes[5].childNodes[2].childNodes[0].nodeValue;
   var vue=pos.substring(1,pos.indexOf('cases')-1);
   return getScript();
}

function getAllText(Element)
{
   if(Element.nodeName == "#text")
   {
      var thisText=Element.nodeValue.replace(/[\t\n\r]/gi,' ');
      thisText=thisText.replace(/[ ]+/gi,' ');
      if(thisText==" ")
         return '';
      return thisText;
   }
   if(Element.nodeName.toLowerCase() == "script" || Element.nodeName.toLowerCase() == "noframes")
      return "";
   var string=''
   if(Element.nodeName.toLowerCase() == "tbody" || Element.nodeName.toLowerCase() == "center" || Element.nodeName.toLowerCase() == "br")
      string='\n';
   if(Element.nodeName.toLowerCase() == "li")
      string='';
   for(var i=0;i<Element.childNodes.length;i++)
   {
     //string+=' '+Element.nodeName+' : ';
     string+=getAllText(Element.childNodes[i]);
     if(Element.nodeName.toLowerCase() == "tbody" && i<Element.childNodes.length-1)
        string+='\n';
     else if(Element.nodeName.toLowerCase() =='tr' && i<Element.childNodes.length-1)
        string+=' ';
   }
   if(Element.nodeName.toLowerCase() == "center" || Element.nodeName.toLowerCase() == "li")
      string+='\n';
   return string;
}

function create2DBouton(url,id,vue,texte,listeParams)
{
  var myForm= document.createElement('form');
  myForm.setAttribute('method','post');
  myForm.setAttribute('action',url);
  myForm.setAttribute('name','2DBouton');
  myForm.setAttribute('target','_blank');
  var myTA=document.createElement('input');
  myTA.setAttribute('type','hidden');
  myTA.setAttribute('name',id);
  myTA.setAttribute('value','');
  myForm.appendChild(myTA);
  for(var i=0;i<Math.floor(listeParams.length/2);i++)
  {
    myTA=document.createElement('input');
    myTA.setAttribute('type','hidden');
    myTA.setAttribute('name',listeParams[2*i]);
    myTA.setAttribute('value',listeParams[2*i+1]);
    myForm.appendChild(myTA);
  }
  myTA=document.createElement('input');
  myTA.setAttribute('type','submit');
  myTA.setAttribute('value',texte);
  myTA.setAttribute('class','mh_form_submit');
  myTA.setAttribute('onMouseOver','this.style.cursor=\'hand\';');
  myTA.setAttribute('onClick','document.getElementsByName(\''+id+'\')[0].value='+vue+';');
  myForm.appendChild(myTA);
  return myForm;
}

// Le bouton pour la vue 2d
function put2DBouton() {
  var vueext=getCookie("VUEEXT");
  var arr=document.getElementsByTagName('a');
  if(vueext=="" || vueext=="grouky")
  {
    var myForm=create2DBouton('http://ythogtha.org/MH/grouky.py/grouky','vue','getVueScript2(document)','La grouky vue !',new Array('type_vue','V4'));
    arr[7].parentNode.appendChild(document.createElement('br'));
    arr[7].parentNode.appendChild(myForm);
  }
  else if(vueext=="otan")
  {
    var myForm=create2DBouton('http://drunk.cryo.free.fr/resultat_vue.php','txtVue','getVueScript2(document)','La vue OTAN',new Array('txtTypeVue','Mountyzilla'));
    arr[7].parentNode.appendChild(document.createElement('br'));
    arr[7].parentNode.appendChild(myForm);
  }
  else if(vueext=="xtrolls")
  {
    var myForm=create2DBouton('http://thextrolls.free.fr/carte/partage/vue_mozilla.php','vue','getVueScript2(document)','La vue Xtrolls',new Array());
    arr[7].parentNode.appendChild(document.createElement('br'));
    arr[7].parentNode.appendChild(myForm);
  }
  else if(vueext=="lxgt")
  {
    var myForm=create2DBouton('http://fryrd.free.fr/troll/forum/majvuemh.php','vue','getVueScript2(document)','La vue LXGT',new Array());
    arr[7].parentNode.appendChild(document.createElement('br'));
    arr[7].parentNode.appendChild(myForm);
  }
  else if(vueext=="gloumfs2d")
  {
    var myForm=create2DBouton('http://gloumf.free.fr/vue2d.php','vue_mountyzilla','getVueScript2(document)','La vue Gloumfs 2D',new Array());
    arr[7].parentNode.appendChild(document.createElement('br'));
    arr[7].parentNode.appendChild(myForm);
  }
  else if(vueext=="gloumfs3d")
  {
    var myForm=create2DBouton('http://gloumf.free.fr/vue3d.php','vue_mountyzilla','getVueScript2(document)','La vue Gloumfs 3D',new Array());
    arr[7].parentNode.appendChild(document.createElement('br'));
    arr[7].parentNode.appendChild(myForm);
  }
  else if(vueext=="bricol")
  {
    var myForm=create2DBouton('http://trolls.game-host.org/mountyhall/vue_form.php','vue','getVueScript2(document)','La Bricol\' Vue',new Array('mode','vue_SP_Vue2','screen_width',screen.width));
    arr[7].parentNode.appendChild(document.createElement('br'));
    arr[7].parentNode.appendChild(myForm);
  }
  else if(vueext=="kilamo")
  {
    var myForm=create2DBouton('http://zadorateursdekilamo.free.fr/public/pub_chrgvue.php','VUEMH','getVueScript2(document)','La vue KiLaMo',new Array());
    arr[7].parentNode.appendChild(document.createElement('br'));
    arr[7].parentNode.appendChild(myForm);
  }
  else if (vueext=="relaismago")
  {
    var myForm=create2DBouton('http://outils.relaismago.com/vue2d/get_vue.php3','datas','getAllText(document)','La vue R&M !','');
    arr[7].parentNode.appendChild(document.createElement('br'));
    arr[7].parentNode.appendChild(myForm);
  }
/*  else if(vueext=="lso")
  {
    var myForm=create2DBouton('http://janpolontheweb.free.fr/LSO_Visu2D.php','vue',getAllText(document),'La Vue LSO',new Array('action','generer'));
    arr[7].parentNode.appendChild(document.createElement('br'));
    arr[7].parentNode.appendChild(myForm);
  }*/
}

function createCheckbox(name,fonction)
{
  var checkBox=document.createElement('INPUT');
  checkBox.setAttribute('NAME',name);
  checkBox.setAttribute('TYPE','checkbox');
  checkBox.setAttribute('onClick',fonction);
  return checkBox
}

//             Rajout des boutons affichage/effacement des GG...
function putDisabledBoutons()
{
  arr=document.getElementsByName('bLimitView');
  var mytr=arr[0].parentNode.parentNode;
  mytr.setAttribute('class','mh_tdpage');
  mytd=mytr.childNodes[1];
  mytr.removeChild(mytd);
  mytr.appendChild(mytd);
  arr[0].parentNode.setAttribute('align','center');
  var mynewtr=document.createElement('TR');
  mynewtr.setAttribute('class','mh_tdpage');
  mytr.parentNode.insertBefore(mynewtr,mytr);
  totaltab[3].removeChild(totaltab[3].firstChild);
  var noeud = document.createElement('TR');
  noeud.setAttribute('class','mh_tdtitre');
  noeud.appendChild(document.createElement('TD'));
  noeud.firstChild.appendChild(document.createElement('B'));
  noeud.firstChild.firstChild.appendChild(document.createTextNode("INFORMATIONS"));
  noeud.setAttribute( 'onclick', 'toggleTableau(3);' );
  var newThead = document.createElement( 'thead' );
  newThead.appendChild( noeud );
  totaltab[3].insertBefore( newThead , totaltab[3].childNodes[0] );
  totaltab[3].childNodes[0].childNodes[0].childNodes[0].setAttribute( 'colspan', '9' );
  totaltab[3].childNodes[0].childNodes[0].childNodes[0].setAttribute('onmouseover', "this.style.cursor='pointer';this.className='mh_tdpage';");
  totaltab[3].childNodes[0].childNodes[0].childNodes[0].setAttribute('onmouseout', "this.className='mh_tdtitre';");


  var newTD=document.createElement('TD');
  newTD.setAttribute('align','right');
  mynewtr.appendChild(newTD);
  newTD.appendChild(document.createElement("b"));
  newTD.firstChild.appendChild(document.createTextNode("EFFACER : "));
  newTD=document.createElement('TD');
  mynewtr.appendChild(newTD);
  newTD.setAttribute('align','center');
  var newNobr=document.createElement('NOBR');
  newNobr.appendChild(createCheckbox('delgg','deleteGG()'));
  newNobr.appendChild(document.createTextNode('\u00a0Les\u00a0Gigots\u00a0de\u00a0Gob\''));
  newTD.appendChild(newNobr);
  newTD.appendChild(document.createTextNode('\u00a0\u00a0\u00a0'));
  newNobr=document.createElement('NOBR');
  newNobr.appendChild(createCheckbox('delcomp','deleteComp()'));
  newNobr.appendChild(document.createTextNode('\u00a0Les\u00a0Composants'));
  newTD.appendChild(newNobr);
  newTD.appendChild(document.createTextNode('\u00a0\u00a0\u00a0'));
  newNobr=document.createElement('NOBR');
  newNobr.appendChild(createCheckbox('delbid','deleteBidouille()'));
  newNobr.appendChild(document.createTextNode('\u00a0Les\u00a0Bidouilles'));
  newTD.appendChild(newNobr);
  newTD.appendChild(document.createTextNode('\u00a0\u00a0\u00a0'));
  newNobr=document.createElement('NOBR');
  newNobr.appendChild(createCheckbox('delint','deleteIntangible()'));
  newNobr.appendChild(document.createTextNode('\u00a0Les\u00a0Intangibles'));
  newTD.appendChild(newNobr);
  newTD.appendChild(document.createTextNode('\u00a0\u00a0\u00a0'));
  newNobr=document.createElement('NOBR');
  newNobr.appendChild(createCheckbox('delgowap','deleteGowap()'));
  newNobr.appendChild(document.createTextNode('\u00a0Les\u00a0Gowaps'));
  newTD.appendChild(newNobr);
  newTD.appendChild(document.createTextNode('\u00a0\u00a0\u00a0'));
  newNobr=document.createElement('NOBR');
  newNobr.appendChild(createCheckbox('delniveau','deleteNiveau()'));
  newNobr.appendChild(document.createTextNode('\u00a0Les\u00a0Niveaux'));
  newTD.appendChild(newNobr);

}

function synchronizeConfig() {
  if(getCookie("NOGG")=="true")
    {  var bouton=document.getElementsByName('delgg')[0];bouton.checked=true;deleteGG();  }
  if(getCookie("NOCOMP")=="true")
    {  var bouton=document.getElementsByName('delcomp')[0];bouton.checked=true;deleteComp();  }
  if(getCookie("NOBID")=="true")
    {  var bouton=document.getElementsByName('delbid')[0];bouton.checked=true;deleteBidouille();  }
  if(getCookie("NOINT")=="true")
    {  var bouton=document.getElementsByName('delint')[0];bouton.checked=true;deleteIntangible();  }
  if(getCookie("NOGOWAP")=="true")
    {  var bouton=document.getElementsByName('delgowap')[0];bouton.checked=true;deleteGowap();  }
  if(getCookie("NIVEAU")=="non")
    {  var bouton=document.getElementsByName('delniveau')[0];bouton.checked=true;  }
}




function createBouton(url,id,value,text) {
  var myForm= document.createElement('form');
  myForm.setAttribute('method','post');
  myForm.setAttribute('align','right');
  myForm.setAttribute('action',url);
  myForm.setAttribute('name','frmvue');
  myForm.setAttribute('target','_blank');
  var myTA=document.createElement('input');
  myTA.setAttribute('type','hidden');
  myTA.setAttribute('name',id);
  myTA.setAttribute('value','');
  myForm.appendChild(myTA);
  myTA=document.createElement('input');
  myTA.setAttribute('type','submit');
  myTA.setAttribute('value',text);
  myTA.setAttribute('class','mh_form_submit');
  myTA.setAttribute('onMouseOver','this.style.cursor=\'hand\';');
  myTA.setAttribute('onClick','document.getElementsByName(\''+id+'\')[0].value='+value+';');
  myForm.appendChild(myTA);
  return myForm;
}

//Le bouton pour envoyer les lieux de la vue
function putLieuxBouton(arrtable) {
  arrtable.parentNode.insertBefore(createBouton('http://resel.enst-bretagne.fr/club/mountyhall/script/v1/lieux.php','listelieux','getLieux()','Ajouter les lieux à la base'),arrtable);
}

//Le bouton pour envoyer les monstres de la vue
function putMonstresBouton(arrtable) {
  arrtable.parentNode.insertBefore(createBouton('http://resel.enst-bretagne.fr/club/mountyhall/script/v1/get_monstres.php','listemonstres','getMonstres()','Ajouter les monstres à la base'),arrtable);
}


//           Méthode de recherche
function recTroll()
{
   var bouton=document.getElementsByName('delint')[0];
   bouton.checked=false;
   setCookie("NOINT","false");
   if (document.LimitViewForm.rec_troll.value !='')
   {
      var nom=document.LimitViewForm.rec_troll.value.toLowerCase();
      var arrtable=totaltab[6];
      arrtable.childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].nodeValue="TROLLS (filtrés sur "+nom+")";
      for (var i=1;i<x_trolls.length;i++)
      {
         if (x_trolls[i].className == 'mh_tdpage' && x_trolls[i].childNodes.length>6 && (x_trolls[i].childNodes[2].childNodes[1].className == 'mh_trolls_1' || x_trolls[i].childNodes[2].childNodes[1].className == 'mh_trolls_0'))
         {
             if(x_trolls[i].childNodes[2].childNodes[1].firstChild.nodeValue.toLowerCase().indexOf(nom)==-1)
	        x_trolls[i].style.display='none';
	     else
	        x_trolls[i].style.display='';
         }
      }
   }
   else
   {
      var arrtable=totaltab[6];
      arrtable.childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].nodeValue="TROLLS";
      for (var i=1;i<x_trolls.length;i++)
      {
         if (x_trolls[i].className == 'mh_tdpage' && x_trolls[i].childNodes.length>6 && (x_trolls[i].childNodes[2].childNodes[1].className == 'mh_trolls_1' || x_trolls[i].childNodes[2].childNodes[1].className == 'mh_trolls_0'))
	 {
	    x_trolls[i].style.display='';
	 }
      }
   }
}

function recMonstre()
{
   var bouton=document.getElementsByName('delgowap')[0];
   bouton.checked=false;
   setCookie("NOGOWAP","false");
   if (document.LimitViewForm.rec_monstre.value !='')
   {
      var nom=document.LimitViewForm.rec_monstre.value.toLowerCase();
      var arrtable=totaltab[4];
      arrtable.childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].nodeValue="MONSTRES (filtrés sur "+nom+")";
      for (var i=1;i<x_monstres.length;i++)
      {
         if (x_monstres[i].className == 'mh_tdpage')
         {
             if(x_monstres[i].childNodes[3].childNodes[0].firstChild.nodeValue.toLowerCase().indexOf(nom)==-1)
	        x_monstres[i].style.display='none';
	     else
	        x_monstres[i].style.display='';
         }
      }
   }
   else
   {
      var arrtable=totaltab[4];
      arrtable.childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].nodeValue="MONSTRES";
      for (var i=1;i<x_monstres.length;i++)
      {
         if (x_monstres[i].className == 'mh_tdpage')
	 {
	    x_monstres[i].style.display='';
	 }
      }
   }
}

function recTresor()
{
   var bouton=document.getElementsByName('delgg')[0];
   bouton.checked=false;
   bouton=document.getElementsByName('delcomp')[0];
   bouton.checked=false;
   bouton=document.getElementsByName('delbid')[0];
   bouton.checked=false;
   setCookie("NOGG","false");
   setCookie("NOCOMP","false");
   setCookie("NOBID","false");
   if (document.LimitViewForm.rec_tresor.value !='')
   {
      var nom=document.LimitViewForm.rec_tresor.value.toLowerCase();
      var arrtable=totaltab[8];
      arrtable.childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].nodeValue="TRESORS (filtrés sur "+nom+")";
      for (var i=0;i<x_tresors.length;i++)
      {
         if(x_tresors[i].className == 'mh_tdpage' && x_tresors[i].childNodes.length==6 && x_tresors[i].childNodes[2].childNodes[0].nodeName == "B")      
         {
             if((x_tresors[i].childNodes[2].childNodes[0].firstChild.nodeName == "#text" && x_tresors[i].childNodes[2].childNodes[0].firstChild.nodeValue.toLowerCase().indexOf(nom)!=-1) || ((x_tresors[i].childNodes[2].childNodes[0].firstChild.nodeName == "A" && x_tresors[i].childNodes[2].childNodes[0].firstChild.firstChild.nodeValue.toLowerCase().indexOf(nom)!=-1 )||(x_tresors[i].childNodes[2].childNodes[0].childNodes.length >1 && x_tresors[i].childNodes[2].childNodes[0].childNodes[1].nodeName == "A" && x_tresors[i].childNodes[2].childNodes[0].childNodes[1].firstChild.nodeValue.toLowerCase().indexOf(nom)!=-1)) )
	        x_tresors[i].style.display='';
	     else
	        x_tresors[i].style.display='none';
		
         }
      }
   }
   else
   {
      var arrtable=totaltab[8];
      arrtable.childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].nodeValue="TRESORS";
      for (var i=2;i<x_tresors.length;i++)
      {
         if (x_tresors[i].className == 'mh_tdpage' && x_tresors[i].childNodes.length==6 && x_tresors[i].childNodes[2].childNodes[0].nodeName == "B")
	 {
	    x_tresors[i].style.display='';
	 }
      }
   }
}

function recLieu()
{
   if (document.LimitViewForm.rec_lieu.value !='')
   {
      var arr=(document.getElementsByName('lieux'))[0].parentNode.parentNode.parentNode.getElementsByTagName('tr');;
      var nom=document.LimitViewForm.rec_lieu.value.toLowerCase();
      var arrtable=totaltab[12];
      arrtable.childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].nodeValue="LIEUX PARTICULIERS (filtrés sur "+nom+")";
      for (var i=0;i<arr.length;i++)
      {
         if(arr[i].className == 'mh_tdpage')
	 {
	   if(getAllText(arr[i].childNodes[2]).toLowerCase().indexOf(nom)==-1)
	      arr[i].style.display='none';
	   else
	      arr[i].style.display='';
	 }
      }
   }
   else
   {
      var arr=(document.getElementsByName('lieux'))[0].parentNode.parentNode.parentNode.getElementsByTagName('tr');;
      var arrtable=totaltab[12];
      arrtable.childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0].nodeValue="LIEUX PARTICULIERS";
      for (var i=0;i<arr.length;i++)
      {
         arr[i].style.display='';
      }
   }

}

function createSearchInput(name)
{
   var input=document.createElement('INPUT');
   input.setAttribute('NAME',name);
   input.setAttribute('TYPE','text');
   input.setAttribute('class','TextboxV2');
   input.setAttribute('VALUE','');
   input.setAttribute('size','12');
   input.setAttribute('MAXLENGTH','20');
   return input;
}

function createSearchBouton(value,fonction)
{
  var bouton=document.createElement('INPUT');
  bouton.setAttribute('TYPE','button');
  bouton.setAttribute('VALUE',value);
  bouton.setAttribute('onClick',fonction);
  bouton.setAttribute('class','mh_form_submit');
  bouton.setAttribute('onMouseOver','this.style.cursor=\'hand\';');
  return bouton;
}

//          Rajout du moteur de recherche
function putSearchForms()
{
  var arr=document.getElementsByName('bLimitView');
  var newTR=document.createElement('TR');
  newTR.setAttribute('class','mh_tdpage');
  var newTD=document.createElement('TD');
  newTD.setAttribute('align','right');
  (arr[0].parentNode.parentNode.parentNode).insertBefore(newTR,arr[0].parentNode.parentNode);
  newTR.appendChild(newTD);
  newTD.appendChild(document.createElement('b'));
  newTD.firstChild.appendChild(document.createTextNode("RECHERCHER :"));

  newTD=document.createElement('TD');
  newTD.setAttribute('align','center');
  newTR.appendChild(newTD);
  var newNobr=document.createElement('NOBR');
  newNobr.appendChild(createSearchInput('rec_monstre'));
  newNobr.appendChild(document.createTextNode("\u00a0"));
  newNobr.appendChild(createSearchBouton('Monstre','recMonstre()'));
  newTD.appendChild(newNobr);
  newNobr=document.createElement('NOBR');
  newTD.appendChild(document.createTextNode("\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0 "));
  newNobr.appendChild(createSearchInput('rec_troll'));
  newNobr.appendChild(document.createTextNode("\u00a0"));
  newNobr.appendChild(createSearchBouton('Troll','recTroll()'));
  newTD.appendChild(newNobr);
  newNobr=document.createElement('NOBR');
  newTD.appendChild(document.createTextNode("\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0 "));
  newNobr.appendChild(createSearchInput('rec_tresor'));
  newNobr.appendChild(document.createTextNode("\u00a0"));
  newNobr.appendChild(createSearchBouton('Trésor','recTresor()'));
  newTD.appendChild(newNobr);
  newNobr=document.createElement('NOBR');
  newTD.appendChild(document.createTextNode("\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0 "));
  newNobr.appendChild(createSearchInput('rec_lieu'));
  newNobr.appendChild(document.createTextNode("\u00a0"));
  newNobr.appendChild(createSearchBouton('Lieu','recLieu()'));
  newTD.appendChild(newNobr);
}

function putLevel() {
  var toto='';
  var begin=1;
  if(getCookie("NIVEAU")=="non")
    return;
  if(getCookie("MAX_LEVEL")=="")
    var max=Math.min(x_monstres.length,5000);
  else
    var max=Math.min(x_monstres.length,getCookie("MAX_LEVEL")*1);
  isLevelComputed=true;
  for (var i=1;i<max;i++)
  {
    var number=Math.floor((i-1)/50);
    if(!x_monstres[i].childNodes[2].childNodes[0].firstChild)
      toto+='nom[]='+x_monstres[i].childNodes[3].childNodes[0].firstChild.nodeValue+'&';
    else
      toto+='nom[]='+x_monstres[i].childNodes[2].childNodes[0].firstChild.nodeValue+'&';
    if(i%50==0)
    {
      var newScript1 = document.createElement('script');
      newScript1.setAttribute('language',"JavaScript");
      newScript1.setAttribute('src','http://resel.enst-bretagne.fr/club/mountyhall/script/v1/monstres_FF.php?begin='+begin+'&'+toto);
      (x_lieux[x_lieux.length-1].parentNode.parentNode.parentNode).appendChild(newScript1);
      toto="";
      begin=i+1;
    }
  }
  if(toto!="")
  {
    var newScript1 = document.createElement('script');
    newScript1.setAttribute('language',"JavaScript");
    newScript1.setAttribute('src','http://resel.enst-bretagne.fr/club/mountyhall/script/v1/monstres_FF.php?begin='+begin+'&'+toto);
    (x_lieux[x_lieux.length-1].parentNode.parentNode.parentNode).appendChild(newScript1);
  }
}

function creerOnclickMonstres() {
        if(getCookie("NIVEAU")=="non")
                return;
        var newB = document.createElement( 'b' );
        newB.appendChild( document.createTextNode( 'Niveau' ) );
        var newTd = document.createElement( 'td' );
        newTd.setAttribute( 'width', '25' );
        newTd.appendChild( newB );

        x_monstres[0].insertBefore( newTd, x_monstres[0].childNodes[2] );

        for ( var i = 1; i < x_monstres.length; i++ ) {
                var nom = x_monstres[i].childNodes[2].childNodes[0].firstChild.nodeValue;
                nom = nom.replace( /[\']/, "\\'" );
                newTd = document.createElement( 'td' );
                newTd.setAttribute( 'onclick', 'getCDM('+i+',\''+nom+'\')' );
                newTd.setAttribute( 'onmouseover', "this.style.cursor='pointer';this.className='mh_tdtitre'" );
                newTd.setAttribute( 'onmouseout', "this.className='mh_tdpage';" );
                newTd.setAttribute( 'style', "font-weight:bold;text-align:center;" );
                var niveau = '-';
		if(isLevelComputed)
		   niveau=listeNiveau[i];
                newTd.appendChild( document.createTextNode( niveau ) );

                x_monstres[i].insertBefore( newTd, x_monstres[i].childNodes[2] );
        }
}

function getCDM( idRow, nomMonstre ) {
  if(x_monstres[idRow].childNodes[2].childNodes[0].nodeValue!="-")
  {
    if(!rowCdm[idRow] || !document.getElementById( rowCdm[idRow] ))
    {
      rowCdm[idRow]="popupCDM"+nbCDM;
      donneesMonstre = listeCDM[nomMonstre.replace(/\'/," ")];
      afficherCDM( nomMonstre, true );

    }
    else
    {
      cacherPopup(rowCdm[idRow]);
      delete rowCdm[idRow];
    }
  }
}

function afficherCDM( nomMonstre ) {
	var tabCDM = document.getElementById( creerPopupCDM() );
	tabCDM.childNodes[0].childNodes[0].firstChild.nodeValue = 'CDM de ' + nomMonstre;
	tabCDM.childNodes[1].childNodes[1].innerHTML = donneesMonstre[0]+analysePX(donneesMonstre[0]);
	tabCDM.childNodes[2].childNodes[1].firstChild.nodeValue = donneesMonstre[1];
	tabCDM.childNodes[3].childNodes[1].innerHTML = donneesMonstre[2];
	tabCDM.childNodes[4].childNodes[1].innerHTML = donneesMonstre[3];
	tabCDM.childNodes[5].childNodes[1].innerHTML = donneesMonstre[4];
	tabCDM.childNodes[6].childNodes[1].innerHTML = donneesMonstre[5];
	tabCDM.childNodes[7].childNodes[1].innerHTML = donneesMonstre[6];
	tabCDM.childNodes[8].childNodes[1].innerHTML = donneesMonstre[7];
	tabCDM.childNodes[9].childNodes[1].innerHTML = donneesMonstre[8];
	tabCDM.childNodes[10].childNodes[1].firstChild.nodeValue = donneesMonstre[11];
	tabCDM.childNodes[11].childNodes[1].firstChild.nodeValue = donneesMonstre[9];
	tabCDM.childNodes[12].childNodes[1].firstChild.nodeValue = donneesMonstre[10];
	tabCDM.style.display = '';

}

function analysePX(niveau)
{
	var niv_troll=getCookie("NIV_TROLL");
	if(niv_troll=="")
		return "";
	if(niveau.indexOf("+")!=-1)
		return " --> \u2265 <b>"+Math.max(0,11+3*niveau.slice(0,niveau.indexOf("+"))-2*niv_troll)+"</b> PX";
	else if(niveau.slice(1).indexOf("-")!=-1)
		return " --> <b>"+Math.max(0,11+3*niveau.slice(0,niveau.slice(1).indexOf("-")+1)-2*niv_troll)+"</b> \u2264 PX \u2264 <b>"+Math.max(0,11+3*niveau.slice(niveau.slice(1).indexOf("-")+2)-2*niv_troll)+"</b>";
	else
		return " --> <b>"+Math.max(0,11+3*niveau-2*niv_troll)+"</b> PX";
}

function creerPopupCDM() {
	var listeTitres = new Array( 'Niveau', 'Famille', 'Points de vie', 'Attaque', 'Esquive', 'Dégat', 'Régénération', 'Armure', 'Vue', 'Capacité spéciale', 'Maitrise magique', 'Résistance magique');

	creerPopup( 'popupCDM'+nbCDM, listeTitres, 350, 200, (window.innerWidth-365), (200+(30*nbCDM))%(30*Math.floor((window.innerHeight-350)/30)));
	nbCDM++;
	return 'popupCDM'+(nbCDM-1);
}

function creerPopup( titre, listeTitres, width, height, x, y ) {
	var newTable = document.createElement( 'table' );
	newTable.setAttribute( 'class', 'mh_tdborder' );
	newTable.setAttribute( 'id' , titre );
	newTable.setAttribute( 'border', '0' );
	newTable.setAttribute( 'cellspacing' , '1' );
	newTable.setAttribute( 'cellpadding' , '4' );
	newTable.setAttribute( 'style', 'display:none;position:fixed;top:'+y+'px;left:'+x+'px;width:'+width+'px;height:'+height+'px;' );

	var newSpan = document.createElement( 'span' );
	newSpan.setAttribute( 'id', 'progress' );
	newSpan.appendChild( document.createTextNode( '.' ) );

	var newTd = document.createElement( 'td' );
	newTd.setAttribute( 'colspan', '2' );
	newTd.setAttribute( 'style', 'font-weight:bold;' );
	newTd.appendChild( document.createTextNode( 'Recherche en cours.' ) );

	var newTr = document.createElement( 'tr' );
	newTr.setAttribute( 'class', 'mh_tdtitre' );
	newTr.setAttribute( 'style', 'cursor:move;' );
	newTr.appendChild( newTd );

	newTable.appendChild( newTr );

	newTd = document.createElement( 'td' );
	newTd.setAttribute( 'colspan', '2' );
	newTd.setAttribute( 'style', 'text-align:center;font-weight:bold;' );
	newTd.appendChild( document.createTextNode( 'Fermer' ) );

	newTr = document.createElement( 'tr' );
	newTr.setAttribute( 'class', 'mh_tdtitre' );
	newTr.setAttribute('onmouseover', "this.style.cursor='pointer';this.className='mh_tdpage';");
	newTr.setAttribute('onmouseout', "this.className='mh_tdtitre';");
	newTr.setAttribute( 'onclick', "cacherPopup( '"+ titre +"' );this.className='mh_tdtitre';" );
	newTr.appendChild( newTd );

	newTable.appendChild( newTr );

	totaltab[0].parentNode.appendChild( newTable );

	dragElement( titre );

	if ( listeTitres != '' ) {
		for ( var i = 0; i < listeTitres.length; i++ ) {
			newTd = document.createElement( 'td' );
			newTd.setAttribute( 'class', 'mh_tdtitre' );
			newTd.setAttribute( 'style', 'font-weight:bold;' );
			newTd.setAttribute( 'width', '120' );
			newTd.appendChild( document.createTextNode( listeTitres[i] ) );

			newTr = document.createElement( 'tr' );
			newTr.setAttribute( 'class', 'mh_tdpage' );
			newTr.appendChild( newTd );

			newTd = document.createElement( 'td' );
			newTd.setAttribute( 'class', 'mh_tdpage' );
			newTd.appendChild( document.createTextNode( '' ) );
			newTr.appendChild( newTd );

			newTable.insertBefore( newTr, newTable.childNodes[i+1] );
		}
	}

	return newTable;
}

function cacherPopup( objet ) {
	if ( InSearch ) {
		return false;
	}

	if ( objet == 'tabSearch' ) {
		document.getElementById( 'boutonCDM' ).style.display = 'none';
		document.getElementById( 'boutonAA' ).style.display = 'none';
	}
	var obj=document.getElementById( objet );
	obj.parentNode.removeChild(obj);
}

function dragElement( id ) {
	winDrag[id] = new Array( document.getElementById( id ), 0, 0, false );
	document.getElementById( id ).childNodes[0].onmousedown = drag;
	document.getElementById( id ).onmouseup = function(){ winDrag[id][3] = false }
}

function drag( even ) {
	winDrag[this.parentNode.getAttribute( 'id' )][3] = true;
	winCurr = this.parentNode.getAttribute( 'id' );

	var tx = parseInt( winDrag[winCurr][0].style.left );
	var ty = parseInt( winDrag[winCurr][0].style.top );

	this.style.zIndex = 99;

	winDrag[winCurr][1] = even.pageX - tx;
	winDrag[winCurr][2] = even.pageY - ty;

	return false;
}

function track( even ) {
	if( !winDrag[winCurr] || !winDrag[winCurr][3] ) {
		return;
	}

	var x = even.pageX;
	var y = even.pageY;

	winDrag[winCurr][0].style.left = x - winDrag[winCurr][1] + 'px';
	winDrag[winCurr][0].style.top = y - winDrag[winCurr][2] + 'px';

	return false;
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
        totaltab[num].childNodes[0].childNodes[0].childNodes[0].setAttribute( 'colspan', '9' );
        totaltab[num].childNodes[0].childNodes[0].childNodes[0].setAttribute('onmouseover', "this.style.cursor='pointer';this.className='mh_tdpage';");
        totaltab[num].childNodes[0].childNodes[0].childNodes[0].setAttribute('onmouseout', "this.className='mh_tdtitre';");
}

function toggleTableau( num ) {
        var aucun;
	if(cursorOnLink) return;
        if ( !totaltab[num].childNodes[1].getAttribute( 'style' ) || totaltab[num].childNodes[1].getAttribute( 'style' ) == '' ) {
                totaltab[num].childNodes[1].setAttribute( 'style', 'display:none;');
                aucun = 'true';
        }
        else {
                totaltab[num].childNodes[1].setAttribute( 'style', '');
                aucun = 'false';
        }
}

var debut = new Date();
/* Fenêtre glissable */
var winDrag = new Array();
var winCurr = null;
document.onmousemove=track;
var InSearch;
var nbCDM=0;
var cursorOnLink=false;

var donneesMonstre;
var listeCDM=new Array();
var listeNiveau=new Array();
var rowCdm=new Array();
var totaltab=document.getElementsByTagName('table');
var x_monstres = totaltab[4].childNodes[0].childNodes;
var x_trolls = totaltab[6].childNodes[0].childNodes;
var x_tresors = totaltab[8].childNodes[0].childNodes;
var x_lieux = totaltab[12].childNodes[0].childNodes;

var isLevelComputed=false;

for ( var i = 4; i < 13; i+=2 ) {
  creerThead( i );
}
var fin1 = new Date();
putLinks();
var fin2 = new Date();
put2DBouton();
var fin3 = new Date();
putLieuxBouton(totaltab[12]);
var fin4 = new Date();
putMonstresBouton(totaltab[4]);
var fin5 = new Date();
putDisabledBoutons();
var fin6 = new Date();
putSearchForms();
var fin7 = new Date();
creerOnclickMonstres();
var fin8 = new Date();
putLevel();
var fin9 = new Date();
//creerPopupCDM();
synchronizeConfig();
//creerThead(3);






var fin = new Date();
//totaltab[totaltab.length-1].childNodes[1].childNodes[0].childNodes[1].appendChild( document.createTextNode( " - [Script exécuté en "+(( fin.getTime() - debut.getTime() )/1000)+" sec :"+(( fin1.getTime() - debut.getTime() )/1000)+"/"+(( fin2.getTime() - fin1.getTime() )/1000)+"/"+(( fin3.getTime() - fin2.getTime() )/1000)+"/"+(( fin4.getTime() - fin3.getTime() )/1000)+"/"+(( fin5.getTime() - fin4.getTime() )/1000)+"/"+(( fin6.getTime() - fin5.getTime() )/1000)+"/"+(( fin7.getTime() - fin6.getTime() )/1000)+"/"+(( fin8.getTime() - fin7.getTime() )/1000)+"/"+(( fin9.getTime() - fin8.getTime() )/1000)+"/"+(( fin.getTime() - fin9.getTime() )/1000)+"]" ) );
totaltab[totaltab.length-1].childNodes[1].childNodes[0].childNodes[1].appendChild( document.createTextNode( " - [Script exécuté en "+(( fin.getTime() - debut.getTime() )/1000)+" sec]"));
