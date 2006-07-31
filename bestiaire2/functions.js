// récupère la valeur sélectionnée dans un sélecteur <SELECT></SELECT>
function getSelectVal(selecteur)
{
  return selecteur.options[selecteur.selectedIndex].label;
}

// récupère la valeur contenu dans un objet d'une FORM
function getVal(obj)
{
  return obj.value;
}

