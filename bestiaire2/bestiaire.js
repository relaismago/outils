// En cas de sélection de la Race, le Template ou l'Âge
// redirection sur l'url avec affectation des paramètres
function CdmSelectMenu() // 
{
  var r=getSelectVal(document.select_cdm.race_streum);
  var t=getSelectVal(document.select_cdm.template_streum);
  var a=getSelectVal(document.select_cdm.age_streum);
  document.select_cdm.Race.value=r;
  document.select_cdm.Template.value=t;
  document.select_cdm.Age.value=a;
  location.href='bestiaire.php?Race='+r+'&Template='+t+'&IDAge='+a;
}

// Validation du calcul des PX par clic sur le bouton : appelle à la fonction
// javascript pxotron du fichier pxotron.js (c) Kkwet
function calcPx()
{
  var troll=document.calc_px.troll.value;
//   var monstre=document.new_cdm.MLEVEL.value;
  var monstre=document.select_cdm.MLEVEL.value;
  var px=pxotron(troll,monstre);
  var oPx = document.getElementById("oPx");
  oPx.innerHTML = "<font color=#0000FF size=+2>" + px + "</font>";
}

function pxotron(troll,niveau)
{
  var test;
  var test1;
  var test2;
  if ( (niveau != "?") && (niveau != "< 2") && (niveau != "1-3") && (niveau != "2-4") && 
       (niveau != "3-5")&&(niveau != "5-7") && (niveau != "7-9")&&
       (niveau != "4-6")&&(niveau != "6-8") && (niveau != "8-10")&&
       (niveau != "9-11")&&(niveau != "11-13")&&(niveau != "13-15")&&
       (niveau != "10-12")&&(niveau != "12-14")&&(niveau != "14-16")&&
       (niveau != "15-17")&&(niveau != "17-19")&&(niveau != "19-21")&&
       (niveau != "16-18")&&(niveau != "18-20")&&(niveau != "> 20")) { // si niveau fixe
    test = niveau - ( 2 * (troll - niveau)) + 10;
    if (test < "0") test = "0";
  }
  else {
    if (niveau == "?") {
      test = "Niveau monstre inconnu";}
    if (niveau == "< 2") {
      test = 1 - ( 2 * (troll - 1)) + 10;
      if (test < "0") test = "0";
    }
    if (niveau == "1-3") {
      test1 = 1 - ( 2 * (troll - 1)) + 10;
      test2 = 3 - ( 2 * (troll - 3)) + 10;
      if (test1 < "0") test1 = "0";
      if (test2 < "0") test2 = "0";
      if (test2 == test1) test = "0";
      else                test = "" + test1 + '-' + test2;
    }
    if (niveau == "2-4") {
      test1 = 2 - ( 2 * (troll - 2)) + 10;
      test2 = 4 - ( 2 * (troll - 4)) + 10;
      if (test1 < "0") test1 = "0";
      if (test2 < "0") test2 = "0";
      if (test2 == test1) test = "0";
      else                test = "" + test1 + '-' + test2;
    }
    if (niveau == "3-5") {
      test1 = 3 - ( 2 * (troll - 3)) + 10;
      test2 = 5 - ( 2 * (troll - 5)) + 10;
      if (test1 < "0") test1 = "0";
      if (test2 < "0") test2 = "0";
      if (test2 == test1) test = "0";
      else                test = "" + test1 + '-' + test2;
    }
    if (niveau == "4-6") {
      test1 = 4 - ( 2 * (troll - 4)) + 10;
      test2 = 6 - ( 2 * (troll - 6)) + 10;
      if (test1 < "0") test1 = "0";
      if (test2 < "0") test2 = "0";
      if (test2 == test1) test = "0";
      else                test = "" + test1 + '-' + test2;
    }
    if (niveau == "5-7") {
      test1 = 5 - ( 2 * (troll - 5)) + 10;
      test2 = 7 - ( 2 * (troll - 7)) + 10;
      if (test1 < "0") test1 = "0";
      if (test2 < "0") test2 = "0";
      if (test2 == test1) test = "0";
      else                test = "" + test1 + '-' + test2;
    }
    if (niveau == "6-8") {
      test1 = 6 - ( 2 * (troll - 6)) + 10;
      test2 = 8 - ( 2 * (troll - 8)) + 10;
      if (test1 < "0") test1 = "0";
      if (test2 < "0") test2 = "0";
      if (test2 == test1) test = "0";
      else                test = "" + test1 + '-' + test2;
    }
    if (niveau == "7-9") {
      test1 = 7 - ( 2 * (troll - 7)) + 10;
      test2 = 9 - ( 2 * (troll - 9)) + 10;
      if (test1 < "0") test1 = "0";
      if (test2 < "0") test2 = "0";
      if (test2 == test1) test = "0";
      else                test = "" + test1 + '-' + test2;
    }
    if (niveau == "8-10") {
      test1 = 8 - ( 2 * (troll - 8)) + 10;
      test2 = 10 - ( 2 * (troll - 10)) + 10;
      if (test1 < "0") test1 = "0";
      if (test2 < "0") test2 = "0";
      if (test2 == test1) test = "0";
      else                test = "" + test1 + '-' + test2;
    }
    if (niveau == "9-11") {
      test1 = 9 - ( 2 * (troll - 9)) + 10;
      test2 = 11 - ( 2 * (troll - 11)) + 10;
      if (test1 < "0") test1 = "0";
      if (test2 < "0") test2 = "0";
      if (test2 == test1) test = "0";
      else                test = "" + test1 + '-' + test2;
    }
    if (niveau == "10-12") {
      test1 = 10 - ( 2 * (troll - 10)) + 10;
      test2 = 12 - ( 2 * (troll - 12)) + 10;
      if (test1 < "0") test1 = "0";
      if (test2 < "0") test2 = "0";
      if (test2 == test1) test = "0";
      else                test = "" + test1 + '-' + test2;
    }
    if (niveau == "11-13") {
      test1 = 11 - ( 2 * (troll - 11)) + 10;
      test2 = 13 - ( 2 * (troll - 13)) + 10;
      if (test1 < "0") test1 = "0";
      if (test2 < "0") test2 = "0";
      if (test2 == test1) test = "0";
      else                test = "" + test1 + '-' + test2;
    }
    if (niveau == "12-14") {
      test1 = 12 - ( 2 * (troll - 12)) + 10;
      test2 = 14 - ( 2 * (troll - 14)) + 10;
      if (test1 < "0") test1 = "0";
      if (test2 < "0") test2 = "0";
      if (test2 == test1) test = "0";
      else                test = "" + test1 + '-' + test2;
    }
    if (niveau == "13-15") {
      test1 = 13 - ( 2 * (troll - 13)) + 10;
      test2 = 15 - ( 2 * (troll - 15)) + 10;
      if (test1 < "0") test1 = "0";
      if (test2 < "0") test2 = "0";
      if (test2 == test1) test = "0";
      else                test = "" + test1 + '-' + test2;
    }
    if (niveau == "14-16") {
      test1 = 14 - ( 2 * (troll - 14)) + 10;
      test2 = 16 - ( 2 * (troll - 16)) + 10;
      if (test1 < "0") test1 = "0";
      if (test2 < "0") test2 = "0";
      if (test2 == test1) test = "0";
      else                test = "" + test1 + '-' + test2;
    }
    if (niveau == "15-17") {
      test1 = 15 - ( 2 * (troll - 15)) + 10;
      test2 = 17 - ( 2 * (troll - 17)) + 10;
      if (test1 < "0") test1 = "0";
      if (test2 < "0") test2 = "0";
      if (test2 == test1) test = "0";
      else                test = "" + test1 + '-' + test2;
    }
    if (niveau == "16-18") {
      test1 = 16 - ( 2 * (troll - 16)) + 10;
      test2 = 18 - ( 2 * (troll - 18)) + 10;
      if (test1 < "0") test1 = "0";
      if (test2 < "0") test2 = "0";
      if (test2 == test1) test = "0";
      else                test = "" + test1 + '-' + test2;
    }
    if (niveau == "17-19") {
      test1 = 17 - ( 2 * (troll - 17)) + 10;
      test2 = 19 - ( 2 * (troll - 19)) + 10;
      if (test1 < "0") test1 = "0";
      if (test2 < "0") test2 = "0";
      if (test2 == test1) test = "0";
      else                test = "" + test1 + '-' + test2;
    }
    if (niveau == "18-20") {
      test1 = 18 - ( 2 * (troll - 18)) + 10;
      test2 = 20 - ( 2 * (troll - 20)) + 10;
      if (test1 < "0") test1 = "0";
      if (test2 < "0") test2 = "0";
      if (test2 == test1) test = "0";
      else                test = "" + test1 + '-' + test2;
    }
    if (niveau == "19-21") {
      test1 = 19 - ( 2 * (troll - 19)) + 10;
      test2 = 21 - ( 2 * (troll - 21)) + 10;
      if (test1 < "0") test1 = "0";
      if (test2 < "0") test2 = "0";
      if (test2 == test1) test = "0";
      else                test = "" + test1 + '-' + test2;
    }
    if (niveau == "> 20") {
      test1 = 20 - ( 2 * (troll - 20)) + 10;
      if (test1 < "0") test = "> 0";
      else             test = "" + '>' + test1;
    }
  }
  return test;
}

// Validation du calcul des PX par clic sur le bouton : appelle à la fonction
// javascript pxotron du fichier pxotron.js (c) Kkwet
function calcPx()
{
  var troll=document.calc_px.tniv.value;
//   var monstre=document.new_cdm.MLEVEL.value;
  var monstre=document.calc_px.mniv.value;
  var px=pxotron(troll,monstre);
  var pxelt= document.getElementById("px");
  pxelt.innerHTML = px;
      //  px.innerHTML = ""+px+"";
}
