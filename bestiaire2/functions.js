// r�cup�re la valeur s�lectionn�e dans un s�lecteur <SELECT></SELECT>
function getSelectVal(selecteur)
{
  return selecteur.options[selecteur.selectedIndex].label;
}

// r�cup�re la valeur contenu dans un objet d'une FORM
function getVal(obj)
{
  return obj.value;
}

