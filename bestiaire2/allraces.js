// En cas de s�lection de la Famille, redirection sur l'url avec affectation du
// param�tre Famille
function FamilleSelectMenu() // 
{
  var f=getSelectVal(document.select_famille.famille);
  document.select_famille.famille.value=f;
  location.href='allraces.php?Famille='+f;
}

