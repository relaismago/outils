// En cas de sélection du Race, redirection sur l'url avec affectation du
// paramètre Race
function RaceSelectMenu() // 
{
  var r=getSelectVal(document.select_cdm.race_streum);
//   document.new_cdm.Race.value=r;
  document.select_cdm.Race.value=r;
  document.new_template.Race.value=r;
  document.new_age.Race.value=r;
  var a=getSelectVal(document.select_cdm.age_streum);
  var age=a.substr(a.indexOf('-')+2);
  location.href='bestiaire.php?Race='+r+'&Age='+age;
}
// En cas de sélection d'un monstre, récupération de la race et du monstre et
// redirection sur l'url avec affectation des paramètres Race et Monstre
function MonstreSelectMenu()
{
  var r=getSelectVal(document.select_cdm.race_streum);
//   document.new_cdm.Race.value=r;
  document.select_cdm.Race.value=r;
  document.new_template.Race.value=r;
  document.new_age.Race.value=r;
  var m=getSelectVal(document.select_cdm.name_streum);
//   document.new_cdm.Monstre.value=m;
  document.select_cdm.Monstre.value=m;
  var a=getSelectVal(document.select_cdm.age_streum);
  var age=a.substr(a.indexOf('-')+2);
  location.href='bestiaire.php?Race='+r+'&Monstre='+m+'&Age='+a;
}
// En cas de sélection d'un age, récupération de la race, du monstre, de l'âge et
// redirection sur l'url avec affectation des paramètres Race et Monstre et Age
function AgeSelectMenu()
{
  var r=getSelectVal(document.select_cdm.race_streum);
//   document.new_cdm.Race.value=r;
  document.select_cdm.Race.value=r;
  document.new_template.Race.value=r;
  document.new_age.Race.value=r;
  var m=getSelectVal(document.select_cdm.name_streum);
//   document.new_cdm.Monstre.value=m;
  document.select_cdm.Monstre.value=m;
  var a=getSelectVal(document.select_cdm.age_streum);
  var age=a.substr(a.indexOf('-')+2);
//   document.new_cdm.Age.value=age;
  document.select_cdm.Age.value=age;
  location.href='bestiaire.php?Race='+r+'&Monstre='+m+'&Age='+age;
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
