<?
include_once('../top.php');
initUstensils();
include_once('../foot.php');

function initUstensils()
{
?>

<script language="Javascript">
function droit(e) {
 if (navigator.appName == 'Netscape' && (e.which == 3 || e.which == 2))
return false;
 else if (navigator.appName == 'Microsoft Internet Explorer' &&
(event.button == 2 || event.button == 3)) {
  alert('Clic droit indisponible!')
  return false;
 }
 return true;
}
document.onmousedown=droit;
if (document.layers) window.captureEvents(Event.MOUSEDOWN);
window.onmousedown=droit;

function write(value, descript, poid, temp, price)
{
	var oDescript = document.getElementById("oDescript" + value);
	oDescript.innerHTML = descript;
	var oPoid = document.getElementById("oPoid" + value);
	oPoid.innerHTML = poid;
	var oTemp = document.getElementById("oTemp" + value);
	oTemp.innerHTML = temp;
	var oPrice = document.getElementById("oPrice" + value);
	oPrice.innerHTML = price;
}

function fillBox(value)
{
	var box = document.getElementById("oBox"+value);
	
	box.innerHTML =	
   		"<select id=\"oEquip"+value+"\" onChange=\"fillBox2('"+value+"')\">"+
     			"<option value=\"Parchemins\" selected=''>Parchemins</option>"+
	   			"<option value=\"Potions\">Potions</option>"+
   		"</select>";
   		
	fillBox2(value);
}

function fillBox2(value)
{
	var box = document.getElementById("oBoxM"+value);
	var select = document.getElementById("oEquip"+value);
	var race = select.options[select.selectedIndex].value;
	var text = "<select id=\"oNomm"+value+"\" onChange=\"fillRow('"+value+"')\">";

	switch(race)
	{
	   	case "Parchemins" :
		{
	   		text = text + "<option value=\"Bulle\" selected=''>Bulle Anti-Magie</option>";
	   		text = text + "<option value=\"Idees1\">Id�es Confuses 1</option>";
	   		text = text + "<option value=\"Idees2\">Id�es Confuses 2</option>";
	   		text = text + "<option value=\"Idees3\">Id�es Confuses 3</option>";
	   		text = text + "<option value=\"Idees4\">Id�es Confuses 4</option>";
	   		text = text + "<option value=\"Idees5\">Id�es Confuses 5</option>";
	   		text = text + "<option value=\"Invention\">Invention Estraordinaire</option>";
	   		text = text + "<option value=\"Plan1\">Plan G�nial 1</option>";
	   		text = text + "<option value=\"Plan2\">Plan G�nial 2</option>";
	   		text = text + "<option value=\"Plan3\">Plan G�nial 3</option>";
	   		text = text + "<option value=\"Plan4\">Plan G�nial 4</option>";
	   		text = text + "<option value=\"Plan5\">Plan G�nial 5</option>";
	   		text = text + "<option value=\"RuneC1\">Rune des Cyclopes 1</option>";
	   		text = text + "<option value=\"RuneC2\">Rune des Cyclopes 2</option>";
	   		text = text + "<option value=\"RuneC3\">Rune des Cyclopes 3</option>";
	   		text = text + "<option value=\"RuneC4\">Rune des Cyclopes 4</option>";
	   		text = text + "<option value=\"RuneC5\">Rune des Cyclopes 5</option>";
	   		text = text + "<option value=\"RuneF1\">Rune des Foins 1</option>";
	   		text = text + "<option value=\"RuneF2\">Rune des Foins 2</option>";
	   		text = text + "<option value=\"RuneF3\">Rune des Foins 3</option>";
	   		text = text + "<option value=\"RuneF4\">Rune des Foins 4</option>";
	   		text = text + "<option value=\"RuneE1\">Rune Explosive 1</option>";
	   		text = text + "<option value=\"RuneE2\">Rune Explosive 2</option>";
	   		text = text + "<option value=\"RuneE3\">Rune Explosive 3</option>";
	   		text = text + "<option value=\"RuneE4\">Rune Explosive 4</option>";
	   		text = text + "<option value=\"RuneE5\">Rune Explosive 5</option>";
	   		text = text + "<option value=\"RuneE6\">Rune Explosive 6</option>";
	   		text = text + "<option value=\"RuneE8\">Rune Explosive 8</option>";
	   		text = text + "<option value=\"RuneE10\">Rune Explosive 10</option>";
	   		text = text + "<option value=\"SortAnaAna\">Sortil�ge : Analyse Anatomique</option>";
	   		text = text + "<option value=\"SortArmEth\">Sortil�ge : Armure Eth�r�e</option>";
	   		text = text + "<option value=\"SortAugAtt\">Sortil�ge : Augmentation de l'Attaque</option>";
	   		text = text + "<option value=\"SortAugEsq\">Sortil�ge : Augmentation de l'Esquive</option>";
	   		text = text + "<option value=\"SortAugDeg\">Sortil�ge : Augmentation des D�g�ts</option>";
	   		text = text + "<option value=\"SortBulle\">Sortil�ge : Bulle Anti-Magie</option>";
	   		text = text + "<option value=\"SortExplosion\">Sortil�ge : Explosion</option>";
	   		text = text + "<option value=\"SortFaiblesse\">Sortil�ge : Faiblesse Passag�re</option>";
	   		text = text + "<option value=\"SortFlash\">Sortil�ge : Flash Aveuglant</option>";
	   		text = text + "<option value=\"SortGlue\">Sortil�ge : Glue</option>";
			text = text + "<option value=\"SortGrif\">Sortil�ge : Griffe du Sorcier</option>";
	   		text = text + "<option value=\"SortIdentification\">Sortil�ge : Identification des Tr�sors</option>";
	   		text = text + "<option value=\"SortInvisibilite\">Sortil�ge : Invisibilit�</option>";
	   		text = text + "<option value=\"SortProjection\">Sortil�ge : Projection</option>";
	   		text = text + "<option value=\"SortSacrifice\">Sortil�ge : Sacrifice</option>";
	   		text = text + "<option value=\"SortTeleportation\">Sortil�ge : T�l�portation</option>";
	   		text = text + "<option value=\"SortTelekinesie\">Sortil�ge : T�l�kin�sie</option>";
	   		text = text + "<option value=\"SortVisAcc\">Sortil�ge : Vision Accrue</option>";
	   		text = text + "<option value=\"SortVisLoi\">Sortil�ge : Vision Lointaine</option>";
	   		text = text + "<option value=\"SortVisTro\">Sortil�ge : Vision Troubl�e</option>";
	   		text = text + "<option value=\"SortVoiCac\">Sortil�ge : Voir le Cach�</option>";
	   		text = text + "<option value=\"Traite1\">Trait� de Clairvoyance 1</option>";
	   		text = text + "<option value=\"Traite2\">Trait� de Clairvoyance 2</option>";
	   		text = text + "<option value=\"Traite3\">Trait� de Clairvoyance 3</option>";
	   		text = text + "<option value=\"Traite4\">Trait� de Clairvoyance 4</option>";
	   		text = text + "<option value=\"Traite5\">Trait� de Clairvoyance 5</option>";
		}
		break;
	   	case "Potions" :
		{
	   		text = text + "<option value=\"Elixir1\" selected=''>Elixir de Longue-Vue 1</option>";
	   		text = text + "<option value=\"Elixir2\">Elixir de Longue-Vue 2</option>";
	   		text = text + "<option value=\"Elixir3\">Elixir de Longue-Vue 3</option>";
	   		text = text + "<option value=\"Elixir4\">Elixir de Longue-Vue 4</option>";
	   		text = text + "<option value=\"Elixir5\">Elixir de Longue-Vue 5</option>";
	   		text = text + "<option value=\"Elixir8\">Elixir de Longue-Vue 8</option>";
			text = text + "<option value=\"Elixir9\">Elixir de Bonne Bouffe</option>";
			text = text + "<option value=\"Elixir10\">Elixir de Corruption</option>";
			text = text + "<option value=\"Elixir11\">Elixir de fertilit�</option>";
			text = text + "<option value=\"Elixir12\">Elixir de Feu</option>";
	   		text = text + "<option value=\"Essence1\">Essence de KouleMann 1</option>";
	   		text = text + "<option value=\"Essence2\">Essence de KouleMann 2</option>";
	   		text = text + "<option value=\"Essence3\">Essence de KouleMann 3</option>";
	   		text = text + "<option value=\"Essence4\">Essence de KouleMann 4</option>";
	   		text = text + "<option value=\"Essence5\">Essence de KouleMann 5</option>";
	   		text = text + "<option value=\"Extrait1\">Extrait de DjhinTonik 1</option>";
	   		text = text + "<option value=\"Extrait2\">Extrait de DjhinTonik 2</option>";
	   		text = text + "<option value=\"Extrait3\">Extrait de DjhinTonik 3</option>";
	   		text = text + "<option value=\"Extrait4\">Extrait de DjhinTonik 4</option>";
	   		text = text + "<option value=\"Extrait5\">Extrait de DjhinTonik 5</option>";
			text = text + "<option value=\"Extrait6\">Extrait du Glacier</option>";
	   		text = text + "<option value=\"Grippe1\">Grippe en Conserve 1</option>";
	   		text = text + "<option value=\"Grippe2\">Grippe en Conserve 2</option>";
   			text = text + "<option value=\"Jus1\">Jus de Chronom�tre 1</option>";
   			text = text + "<option value=\"Jus2\">Jus de Chronom�tre 2</option>";
   			text = text + "<option value=\"Jus3\">Jus de Chronom�tre 3</option>";
   			text = text + "<option value=\"Jus4\">Jus de Chronom�tre 4</option>";
   			text = text + "<option value=\"Jus5\">Jus de Chronom�tre 5</option>";
   			text = text + "<option value=\"Lampe\">Lampe G�niale</option>";
   			text = text + "<option value=\"Pneumonie\">Pneumonie en Conserve</option>";
   			text = text + "<option value=\"Potion1\">Potion de Gu�rison 1</option>";
   			text = text + "<option value=\"Potion2\">Potion de Gu�rison 2</option>";
   			text = text + "<option value=\"Potion3\">Potion de Gu�rison 3</option>";
   			text = text + "<option value=\"Potion4\">Potion de Gu�rison 4</option>";
   			text = text + "<option value=\"Potion5\">Potion de Gu�rison 5</option>";
   			text = text + "<option value=\"PufPuf1\">Puf Puf 1</option>";
   			text = text + "<option value=\"PufPuf2\">Puf Puf 2</option>";
   			text = text + "<option value=\"PufPuf3\">Puf Puf 3</option>";
   			text = text + "<option value=\"Rhume1\">Rhume en Conserve 1</option>";
   			text = text + "<option value=\"Rhume2\">Rhume en Conserve 2</option>";
   			text = text + "<option value=\"Sang1\">Sang de Toh R�roh 1</option>";
   			text = text + "<option value=\"Sang2\">Sang de Toh R�roh 2</option>";
   			text = text + "<option value=\"Sang3\">Sang de Toh R�roh 3</option>";
   			text = text + "<option value=\"Sang4\">Sang de Toh R�roh 4</option>";
   			text = text + "<option value=\"Toxine1\">Toxine Violente 1</option>";
   			text = text + "<option value=\"Toxine2\">Toxine Violente 2</option>";
   			text = text + "<option value=\"Toxine4\">Toxine Violente 4</option>";
   			text = text + "<option value=\"Toxine6\">Toxine Violente 6</option>";
   			text = text + "<option value=\"Toxine8\">Toxine Violente 8</option>";
   			text = text + "<option value=\"Toxine10\">Toxine Violente 10</option>";
   			text = text + "<option value=\"Zet1\">Zet Crackdedand 1</option>";
   			text = text + "<option value=\"Zet2\">Zet Crackdedand 2</option>";
   			text = text + "<option value=\"Zet3\">Zet Crackdedand 3</option>";
   			text = text + "<option value=\"Zet4\">Zet Crackdedand 4</option>";
   			text = text + "<option value=\"Zet5\">Zet Crackdedand 5</option>";
		}
		break;
	}
   	
	text = text + "</select>";

	box.innerHTML = text;

	fillRow(value);
}


function fillRow(value)
{
	var select = document.getElementById("oEquip"+value);
	var name = select.options[select.selectedIndex].value;

	var select2 = document.getElementById("oNomm"+value);
	var version = select2.options[select2.selectedIndex].value;

	switch(name)
	{
		case "Parchemins" :
			switch(version)
			{
				case "Bulle" :
					write(value, "<b>?</b>", "Tr�s L�ger", "2,5", "?");
				break;
				case "Idees1" :
					write(value, "<b>Attaque : -1D3 | DLA : +30mn</b>", "Tr�s L�ger", "2,5", "200");
				break;
				case "Idees2" :
					write(value, "<b>Attaque : -2D3 | DLA : +60mn</b>", "Tr�s L�ger", "2,5", "900");
				break;
				case "Idees3" :
					write(value, "<b>Attaque : -3D3 | DLA : +90mn</b>", "Tr�s L�ger", "2,5", "1300");
				break;
				case "Idees4" :
					write(value, "<b>Attaque : -4D3 | DLA : +120mn</b>", "Tr�s L�ger", "2,5", "1700");
				break;
				case "Idees5" :
					write(value, "<b>Attaque : -5D3 | DLA : +150mn</b>", "Tr�s L�ger", "2,5", "?");
				break;
				case "Invention" :
					write(value, "<b>?</b>", "Tr�s L�ger", "2,5", "?");
				break;
				case "Plan1" :
					write(value, "<b>Attaque : +1D3 | D�g�ts : +1 | DLA : -15mn</b>", "Tr�s L�ger", "2,5", "250");
				break;
				case "Plan2" :
					write(value, "<b>Attaque : +2D3 | D�g�ts : +2 | DLA : -30mn</b>", "Tr�s L�ger", "2,5", "600");
				break;
				case "Plan3" :
					write(value, "<b>Attaque : +3D3 | D�g�ts : +3 | DLA : -45mn</b>", "Tr�s L�ger", "2,5", "950");
				break;
				case "Plan4" :
					write(value, "<b>Attaque : +4D3 | D�g�ts : +4 | DLA : -60mn</b>", "Tr�s L�ger", "2,5", "?");
				break;
				case "Plan5" :
					write(value, "<b>Attaque : +5D3 | D�g�ts : +5 | DLA : -75mn</b>", "Tr�s L�ger", "2,5", "?");
				break;
				case "RuneC1" :
					write(value, "<b>Attaque : +1D3 | D�g�ts : +1 | Vue : -1</b>", "Tr�s L�ger", "2,5", "200");
				break;
				case "RuneC2" :
					write(value, "<b>Attaque : +2D3 | D�g�ts : +2 | Vue : -2</b>", "Tr�s L�ger", "2,5", "200");
				break;
				case "RuneC3" :
					write(value, "<b>Attaque : +3D3 | D�g�ts : +3 | Vue : -3</b>", "Tr�s L�ger", "2,5", "?");
				break;
				case "RuneC4" :
					write(value, "<b>Attaque : +4D3 | D�g�ts : +4 | Vue : -4</b>", "Tr�s L�ger", "2,5", "900");
				break;
				case "RuneC5" :
					write(value, "<b>Attaque : +5D3 | D�g�ts : +5 | Vue : -5</b>", "Tr�s L�ger", "2,5", "1200");
				break;
				case "RuneF1" :
					write(value, "<b>D�g�ts : -1 | Vue : -1 | PV : -1D3</b>", "Tr�s L�ger", "2,5", "100");
				break;
				case "RuneF2" :
					write(value, "<b>D�g�ts : -2 | Vue : -1 | PV : -2D3</b>", "Tr�s L�ger", "2,5", "200");
				break;
				case "RuneF3" :
					write(value, "<b>D�g�ts : -3 | Vue : -1 | PV : -3D3</b>", "Tr�s L�ger", "2,5", "250");
				break;
				case "RuneF4" :
					write(value, "<b>D�g�ts : -4 | Vue : -1 | PV : -4D3</b>", "Tr�s L�ger", "2,5", "350");
				break;
				case "RuneE1" :
					write(value, "<b>PV : -1D3 | Effet de Zone</b>", "Tr�s L�ger", "2,5", "50");
				break;
				case "RuneE2" :
					write(value, "<b>PV : -2D3 | Effet de Zone</b>", "Tr�s L�ger", "2,5", "100");
				break;
				case "RuneE3" :
					write(value, "<b>PV : -3D3 | Effet de Zone</b>", "Tr�s L�ger", "2,5", "120");
				break;
				case "RuneE4" :
					write(value, "<b>PV : -4D3 | Effet de Zone</b>", "Tr�s L�ger", "2,5", "?");
				break;
				case "RuneE5" :
					write(value, "<b>PV : -5D3 | Effet de Zone</b>", "Tr�s L�ger", "2,5", "?");
				break;
				case "RuneE6" :
					write(value, "<b>PV : -6D3 | Effet de Zone</b>", "Tr�s L�ger", "2,5", "?");
				break;
				case "RuneE8" :
					write(value, "<b>PV : -8D3 | Effet de Zone</b>", "Tr�s L�ger", "2,5", "?");
				break;
				case "RuneE10" :
					write(value, "<b>PV : -10D3 | Effet de Zone</b>", "Tr�s L�ger", "2,5", "?");
				break;
				case "SortAnaAna" :
					write(value, "<b>Permet d'apprendre le sort : Analyse Anatomique</b>", "Tr�s L�ger", "2,5", "2000");
				break;
				case "SortArmEth" :
					write(value, "<b>Permet d'apprendre le sort : Armure Ether�e</b>", "Tr�s L�ger", "2,5", "?");
				break;
				case "SortAugAtt" :
					write(value, "<b>Permet d'apprendre le sort : Augmentation de l'Attaque</b>", "Tr�s L�ger", "2,5", "?");
				break;
				case "SortAugEsq" :
					write(value, "<b>Permet d'apprendre le sort : Augmentation de l'Esquive</b>", "Tr�s L�ger", "2,5", "?");
				break;
				case "SortAugDeg" :
					write(value, "<b>Permet d'apprendre le sort : Augmentation des D�g�ts</b>", "Tr�s L�ger", "2,5", "?");
				break;
				case "SortBulle" :
					write(value, "<b>Permet d'apprendre le sort : Bulle Anti-Magie</b>", "Tr�s L�ger", "2,5", "?");
				break;
				case "SortExplosion" :
					write(value, "<b>Permet d'apprendre le sort : Explosion</b>", "Tr�s L�ger", "2,5", "?");
				break;
				case "SortFaiblesse" :
					write(value, "<b>Permet d'apprendre le sort : Faiblesse Passag�re</b>", "Tr�s L�ger", "2,5", "?");
				break;
				case "SortFlash" :
					write(value, "<b>Permet d'apprendre le sort : Flash Aveuglant</b>", "Tr�s L�ger", "2,5", "?");
				break;
				case "SortGlue" :
					write(value, "<b>Permet d'apprendre le sort : Glue</b>", "Tr�s L�ger", "2,5", "?");
				break;
				case "SortGrif" :
					write(value, "<b>Permet d'apprendre le sort : Griffe du Sorcier</b>", "Tr�s L�ger", "2,5", "?");
				break;
				case "SortIdentification" :
					write(value, "<b>Permet d'apprendre le sort : Identification des Tr�sors</b>", "Tr�s L�ger", "2,5", "2000");
				break;
				case "SortInvisibilite" :
					write(value, "<b>Permet d'apprendre le sort : Invisibilit�</b>", "Tr�s L�ger", "2,5", "?");
				break;
				case "SortProjection" :
					write(value, "<b>Permet d'apprendre le sort : Projection</b>", "Tr�s L�ger", "2,5", "?");
				break;
				case "SortSacrifice" :
					write(value, "<b>Permet d'apprendre le sort : Sacrifice</b>", "Tr�s L�ger", "2,5", "?");
				break;
				case "SortTeleportation" :
					write(value, "<b>Permet d'apprendre le sort : T�l�portation</b>", "Tr�s L�ger", "2,5", "?");
				break;
				case "SortTelekinesie" :
					write(value, "<b>Permet d'apprendre le sort : T�l�kin�sie</b>", "Tr�s L�ger", "2,5", "?");
				break;
				case "SortVisAcc" :
					write(value, "<b>Permet d'apprendre le sort : Vision Accrue</b>", "Tr�s L�ger", "2,5", "?");
				break;
				case "SortVisLoi" :
					write(value, "<b>Permet d'apprendre le sort : Vision Lointaine</b>", "Tr�s L�ger", "2,5", "2500");
				break;
				case "SortVisTro" :
					write(value, "<b>Permet d'apprendre le sort : Vision TRoubl�e</b>", "Tr�s L�ger", "2,5", "?");
				break;
				case "SortVoiCac" :
					write(value, "<b>Permet d'apprendre le sort : Voir le Cach�</b>", "Tr�s L�ger", "2,5", "?");
				break;
				case "Traite1" :
					write(value, "<b>Vue : +1 | DLA : -30mn</b>", "Tr�s L�ger", "2,5", "300");
				break;
				case "Traite2" :
					write(value, "<b>Vue : +2 | DLA : -60mn</b>", "Tr�s L�ger", "2,5", "650");
				break;
				case "Traite3" :
					write(value, "<b>Vue : +3 | DLA : -90mn</b>", "Tr�s L�ger", "2,5", "1200");
				break;
				case "Traite4" :
					write(value, "<b>Vue : +4 | DLA : -120mn</b>", "Tr�s L�ger", "2,5", "1500");
				break;
				case "Traite5" :
					write(value, "<b>Vue : +5 | DLA : -150mn</b>", "Tr�s L�ger", "2,5", "1800");
				break;
			}
		break;
		case "Potions" :
			switch(version)
			{
				case "Elixir1" :
					write(value, "<b>Vue : +1</b>", "Tr�s L�ger", "5", "90");
				break;
				case "Elixir2" :
					write(value, "<b>Vue : +2</b>", "Tr�s L�ger", "5", "150");
				break;
				case "Elixir3" :
					write(value, "<b>Vue : +3</b>", "Tr�s L�ger", "5", "250");
				break;
				case "Elixir4" :
					write(value, "<b>Vue : +4</b>", "Tr�s L�ger", "5", "?");
				break;
				case "Elixir5" :
					write(value, "<b>Vue : +5</b>", "Tr�s L�ger", "5", "?");
				break;
				case "Elixir8" :
					write(value, "<b>Vue : +8 | DLA : -120mn</b>", "Tr�s L�ger", "5", "?");
				break;
				case "Elixir9" :
					write(value, "<b>DEG : +3  | REG : +3</b>", "Tr�s L�ger", "5", "?");
				break;
				case "Elixir10" :
					write(value, "<b>ATT : +3 D3 | ESQ : -3 D3 | DEG : +3 | REG : -3 | Vue : -3 | Armure : +3|</b>", "Tr�s L�ger", "5", "?");
				break;
				case "Elixir11" :
					write(value, "<b>ATT: +5 D3 | DEG:+5 </b>", "Tr�s L�ger", "5", "?");
				break;
				case "Elixir12" :
					write(value, "<b>ESQ : +4 D3 | Vue : +4 |</b>", "Tr�s L�ger", "5", "?");
				break;
				case "Essence1" :
					write(value, "<b>Vue : +1 | R�g�n�ration : +1</b>", "Tr�s L�ger", "5", "150");
				break;
				case "Essence2" :
					write(value, "<b>Vue : +2 | R�g�n�ration : +2</b>", "Tr�s L�ger", "5", "400");
				break;
				case "Essence3" :
					write(value, "<b>Vue : +3 | R�g�n�ration : +3 | PV : +2D3</b>", "Tr�s L�ger", "5", "?");
				break;
				case "Essence4" :
					write(value, "<b>Vue : +4 | R�g�n�ration : +4 | PV : +2D3</b>", "Tr�s L�ger", "5", "1000");
				break;
				case "Essence5" :
					write(value, "<b>Vue : +5 | R�g�n�ration : +5 | PV : +4D3</b>", "Tr�s L�ger", "5", "1000");
				break;
				case "Extrait1" :
					write(value, "<b>D�g�ts : +1 | R�g�n�ration : +1 | PV : +2D3</b>", "Tr�s L�ger", "5", "200");
				break;
				case "Extrait2" :
					write(value, "<b>D�g�ts : +2 | R�g�n�ration : +2 | PV : +2D3</b>", "Tr�s L�ger", "5", "600");
				break;
				case "Extrait3" :
					write(value, "<b>D�g�ts : +3 | R�g�n�ration : +3 | PV : +2D3</b>", "Tr�s L�ger", "5", "?");
				break;
				case "Extrait4" :
					write(value, "<b>D�g�ts : +4 | R�g�n�ration : +4 | PV : +2D3</b>", "Tr�s L�ger", "5", "1200");
				break;
				case "Extrait5" :
					write(value, "<b>D�g�ts : +5 | R�g�n�ration : +5 | PV : +2D3</b>", "Tr�s L�ger", "5", "1200");
				break;
				case "Extrait6" :
					write(value, "<b>REG : +5 | Armure : +5|</b>", "Tr�s L�ger", "5", "?");
				break;
				case "Grippe1" :
					write(value, "<b>Attaque : -3D3 | Esquive : -3D3 | D�g�ts : -3 | R�g�n�ration : -3</b>", "Tr�s L�ger", "5", "?");
				break;
				case "Grippe2" :
					write(value, "<b>Attaque : -4D3 | Esquive : -4D3 | D�g�ts : -4 | R�g�n�ration : -4</b>", "Tr�s L�ger", "5", "?");
				break;
				case "Jus1" :
					write(value, "<b>DLA : -30mn</b>", "Tr�s L�ger", "5", "150");
				break;
				case "Jus2" :
					write(value, "<b>DLA : -60mn</b>", "Tr�s L�ger", "5", "450");
				break;
				case "Jus3" :
					write(value, "<b>DLA : -90mn</b>", "Tr�s L�ger", "5", "650");
				break;
				case "Jus4" :
					write(value, "<b>DLA : -120mn</b>", "Tr�s L�ger", "5", "?");
				break;
				case "Jus5" :
					write(value, "<b>DLA : -150mn</b>", "Tr�s L�ger", "5", "?");
				break;
				case "Lampe" :
					write(value, "<b>?</b>", "Tr�s L�ger", "5", "?");
				break;
				case "Pneumonie" :
					write(value, "<b>Attaque : -5D3 | Esquive : -5D3 | D�g�ts : -5 | R�g�n�ration : -5</b>", "Tr�s L�ger", "5", "?");
				break;
				case "Potion1" :
					write(value, "<b>PV : +2D3</b>", "Tr�s L�ger", "5", "80");
				break;
				case "Potion2" :
					write(value, "<b>PV : +4D3</b>", "Tr�s L�ger", "5", "140");
				break;
				case "Potion3" :
					write(value, "<b>PV : +6D3</b>", "Tr�s L�ger", "5", "160");
				break;
				case "Potion4" :
					write(value, "<b>PV : +8D3</b>", "Tr�s L�ger", "5", "?");
				break;
				case "Potion5" :
					write(value, "<b>PV : +10D3</b>", "Tr�s L�ger", "5", "?");
				break;
				case "PufPuf1" :
					write(value, "<b>Vue : -1 | Effet de Zone</b>", "Tr�s L�ger", "5", "30");
				break;
				case "PufPuf2" :
					write(value, "<b>Attaque : -1D3 | Esquive : -1D3 | Vue : -2 | Effet de Zone</b>", "Tr�s L�ger", "5", "150");
				break;
				case "PufPuf3" :
					write(value, "<b>Attaque : -2D3 | Esquive : -2D3 | Vue : -3 | PV : -2D3 | Effet de Zone</b>", "Tr�s L�ger", "5", "150");
				break;
				case "Rhume1" :
					write(value, "<b>Attaque : -1D3 | Esquive : -1D3 | D�g�ts : -1 | R�g�n�ration : -1</b>", "Tr�s L�ger", "5", "150");
				break;
				case "Rhume2" :
					write(value, "<b>Attaque : -2D3 | Esquive : -2D3 | D�g�ts : -2 | R�g�n�ration : -2</b>", "Tr�s L�ger", "5", "350");
				break;
				case "Sang1" :
					write(value, "<b>Attaque : +1D3 | Esquive : +1D3</b>", "Tr�s L�ger", "5", "100");
				break;
				case "Sang2" :
					write(value, "<b>Attaque : +2D3 | Esquive : +2D3</b>", "Tr�s L�ger", "5", "300");
				break;
				case "Sang3" :
					write(value, "<b>Attaque : +3D3 | Esquive : +3D3 | Vue : +1</b>", "Tr�s L�ger", "5", "?");
				break;
				case "Sang4" :
					write(value, "<b>Attaque : +4D3 | Esquive : +4D3 | Vue : +1</b>", "Tr�s L�ger", "5", "?");
				break;
				case "Toxine1" :
					write(value, "<b>PV : -1D3</b>", "Tr�s L�ger", "5", "?");
				break;
				case "Toxine2" :
					write(value, "<b>PV : -2D3</b>", "Tr�s L�ger", "5", "50");
				break;
				case "Toxine4" :
					write(value, "<b>PV : -4D3</b>", "Tr�s L�ger", "5", "?");
				break;
				case "Toxine6" :
					write(value, "<b>PV : -6D3</b>", "Tr�s L�ger", "5", "100");
				break;
				case "Toxine8" :
					write(value, "<b>PV : -8D3</b>", "Tr�s L�ger", "5", "?");
				break;
				case "Toxine10" :
					write(value, "<b>PV : -10D3</b>", "Tr�s L�ger", "5", "?");
				break;
				case "Zet1" :
					write(value, "<b>Attaque : -1D3 | Esquive : -1D3 | Vue : -1 | PV : +2D3</b>", "Tr�s L�ger", "5", "60");
				break;
				case "Zet2" :
					write(value, "<b>Attaque : -2D3 | Esquive : -2D3 | Vue : -1 | PV : +4D3</b>", "Tr�s L�ger", "5", "200");
				break;
				case "Zet3" :
					write(value, "<b>Attaque : -3D3 | Esquive : -3D3 | Vue : -1 | PV : +6D3</b>", "Tr�s L�ger", "5", "250");
				break;
				case "Zet4" :
					write(value, "<b>Attaque : -4D3 | Esquive : -4D3 | Vue : -1 | PV : +8D3</b>", "Tr�s L�ger", "5", "?");
				break;
				case "Zet5" :
					write(value, "<b>Attaque : -5D3 | Esquive : -5D3 | Vue : -1 | PV : +10D3</b>", "Tr�s L�ger", "5", "500");
				break;
			}
		break;
	}
}
</script>
<script  language="JavaScript1.1">
for (var i=0; i<document.images.length; i++)
document.images[i].onmousedown=droit;
for (var i=0; i<document.links.length; i++)
document.links[i].onmousedown=droit;
</script>

        <table class='mh_tdborder' width='60%' align='center'>
        <tr><td>
          <table width='100%' cellspacing='0'>
            <tr class='mh_tdtitre' align="center">
              <td>
                <img src='../images/titre_ustensiles.gif' width='166' height='62'>
              </td>
            </tr>
          </table>
        </td></tr>
        <tr class='mh_tdpage'><td>

				<table width="100%">
			    <tr align="center"> 
			      <td>Ustensiles</td>
			      <td id="oBox1"></td>
			    </tr>
			    <tr align="center"> 
			      <td>Nom</td>
			      <td id="oBoxM1"></td>
			    </tr>
			    <tr align="center"> 
			      <td>Description</td>
			      <td id="oDescript1"></td>
			    </tr>
			    <tr align="center"> 
			      <td>Poids</td>
			      <td id="oPoid1"></td>
			    </tr>
			    <tr align="center"> 
			      <td>Malus de Temps (minutes)</td>
			      <td id="oTemp1"></td>
			    </tr>
			    <tr align="center"> 
			      <td>Prix de N�gociation (GG')</td>
			      <td id="oPrice1"></td>
			    </tr>
			  </table>
			</td></tr>
			</table>
			<br>

      <table width="60%" cellspacing="1" border="0" cellpadding="1" class="mh_tdborder" align="center">
        <tr class="mh_tdtitre">
          <td align="center">
          	54 Parchemins et 50 Potions Recens�s
          </td>
        </tr>
      </table>
			<br>	


<script>
	fillBox("1");
</script>
</div>
<?
}
?>
