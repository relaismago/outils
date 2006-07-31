// En cas de sélection de la Famille, redirection sur l'url avec affectation du
// paramètre Famille
function FamilleSelectMenu() // 
{
  var f=getSelectVal(document.select_famille.famille);
  document.select_famille.famille.value=f;
  location.href='allraces.php?Famille='+f;
}

