<?
include_once('../top.php');
initCalculs();
include_once('../foot.php');

function initCalculs()
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
	var oDescript = document.getElementById("oDes" + value);
	oDescript.innerHTML = descript;
	var oPoid = document.getElementById("oPoid" + value);
	oPoid.innerHTML = poid;
	var oTemp = document.getElementById("oTemp" + value);
	oTemp.innerHTML = temp;
	var oPrice = document.getElementById("oPrice" + value);
	oPrice.innerHTML = price;
}

function fillBok(value)
{
	var bok = document.getElementById("oBok"+value);
	
	box.innerHTML =	
   		"<select id=\"oEquip"+value+"\" onChange=\"fillBok2('"+value+"')\">"+
     			"<option value=\"Parchemins\" selected=''>Parchemins</option>"+
	   			"<option value=\"Potions\">Potions</option>"+
   		"</select>";
   		
	fillBok2(value);
}

function fillBok2(value)
{
	var bok = document.getElementById("oBokM"+value);
	var select = document.getElementById("oEquip"+value);
	var race = select.options[select.selectedIndex].value;
	var text = "<select id=\"oNomm"+value+"\" onChange=\"fillRow('"+value+"')\">";

	switch(race)
	{
	   	case "Parchemins" :
		{
	   		text = text + "<option value=\"Bulle\" selected=''>Bulle Anti-Magie</option>";
	   		text = text + "<option value=\"Idees1\">Idées Confuses 1</option>";
	   		text = text + "<option value=\"Idees2\">Idées Confuses 2</option>";
	   		text = text + "<option value=\"Idees3\">Idées Confuses 3</option>";
	   		text = text + "<option value=\"Idees4\">Idées Confuses 4</option>";
	   		text = text + "<option value=\"Idees5\">Idées Confuses 5</option>";
	   		text = text + "<option value=\"Invention\">Invention Estraordinaire</option>";
	   		text = text + "<option value=\"Plan1\">Plan Génial 1</option>";
	   		text = text + "<option value=\"Plan2\">Plan Génial 2</option>";
	   		text = text + "<option value=\"Plan3\">Plan Génial 3</option>";
	   		text = text + "<option value=\"Plan4\">Plan Génial 4</option>";
	   		text = text + "<option value=\"Plan5\">Plan Génial 5</option>";
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
	   		text = text + "<option value=\"SortAnaAna\">Sortilège : Analyse Anatomique</option>";
	   		text = text + "<option value=\"SortArmEth\">Sortilège : Armure Ethérée</option>";
	   		text = text + "<option value=\"SortAugAtt\">Sortilège : Augmentation de l'Attaque</option>";
	   		text = text + "<option value=\"SortAugEsq\">Sortilège : Augmentation de l'Esquive</option>";
	   		text = text + "<option value=\"SortAugDeg\">Sortilège : Augmentation des Dégâts</option>";
	   		text = text + "<option value=\"SortBulle\">Sortilège : Bulle Anti-Magie</option>";
	   		text = text + "<option value=\"SortExplosion\">Sortilège : Explosion</option>";
	   		text = text + "<option value=\"SortFaiblesse\">Sortilège : Faiblesse Passagère</option>";
	   		text = text + "<option value=\"SortFlash\">Sortilège : Flash Aveuglant</option>";
	   		text = text + "<option value=\"SortGlue\">Sortilège : Glue</option>";
	   		text = text + "<option value=\"SortIdentification\">Sortilège : Identification des Trésors</option>";
	   		text = text + "<option value=\"SortInvisibilite\">Sortilège : Invisibilité</option>";
	   		text = text + "<option value=\"SortProjection\">Sortilège : Projection</option>";
	   		text = text + "<option value=\"SortSacrifice\">Sortilège : Sacrifice</option>";
	   		text = text + "<option value=\"SortTeleportation\">Sortilège : Téléportation</option>";
	   		text = text + "<option value=\"SortTelekinesie\">Sortilège : Télékinésie</option>";
	   		text = text + "<option value=\"SortVisAcc\">Sortilège : Vision Accrue</option>";
	   		text = text + "<option value=\"SortVisLoi\">Sortilège : Vision Lointaine</option>";
	   		text = text + "<option value=\"SortVisTro\">Sortilège : Vision Troublée</option>";
	   		text = text + "<option value=\"SortVoiCac\">Sortilège : Voir le Caché</option>";
	   		text = text + "<option value=\"Traite1\">Traité de Clairvoyance 1</option>";
	   		text = text + "<option value=\"Traite2\">Traité de Clairvoyance 2</option>";
	   		text = text + "<option value=\"Traite3\">Traité de Clairvoyance 3</option>";
	   		text = text + "<option value=\"Traite4\">Traité de Clairvoyance 4</option>";
	   		text = text + "<option value=\"Traite5\">Traité de Clairvoyance 5</option>";
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
	   		text = text + "<option value=\"Grippe1\">Grippe en Conserve 1</option>";
	   		text = text + "<option value=\"Grippe2\">Grippe en Conserve 2</option>";
   			text = text + "<option value=\"Jus1\">Jus de Chronomètre 1</option>";
   			text = text + "<option value=\"Jus2\">Jus de Chronomètre 2</option>";
   			text = text + "<option value=\"Jus3\">Jus de Chronomètre 3</option>";
   			text = text + "<option value=\"Jus4\">Jus de Chronomètre 4</option>";
   			text = text + "<option value=\"Jus5\">Jus de Chronomètre 5</option>";
   			text = text + "<option value=\"Lampe\">Lampe Géniale</option>";
   			text = text + "<option value=\"Pneumonie\">Pneumonie en Conserve</option>";
   			text = text + "<option value=\"Potion1\">Potion de Guérison 1</option>";
   			text = text + "<option value=\"Potion2\">Potion de Guérison 2</option>";
   			text = text + "<option value=\"Potion3\">Potion de Guérison 3</option>";
   			text = text + "<option value=\"Potion4\">Potion de Guérison 4</option>";
   			text = text + "<option value=\"Potion5\">Potion de Guérison 5</option>";
   			text = text + "<option value=\"PufPuf1\">Puf Puf 1</option>";
   			text = text + "<option value=\"PufPuf2\">Puf Puf 2</option>";
   			text = text + "<option value=\"PufPuf3\">Puf Puf 3</option>";
   			text = text + "<option value=\"Rhume1\">Rhume en Conserve 1</option>";
   			text = text + "<option value=\"Rhume2\">Rhume en Conserve 2</option>";
   			text = text + "<option value=\"Sang1\">Sang de Toh Réroh 1</option>";
   			text = text + "<option value=\"Sang2\">Sang de Toh Réroh 2</option>";
   			text = text + "<option value=\"Sang3\">Sang de Toh Réroh 3</option>";
   			text = text + "<option value=\"Sang4\">Sang de Toh Réroh 4</option>";
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
					write(value, "<b>?</b>", "Très Léger", "2,5", "?");
				break;
				case "Idees1" :
					write(value, "<b>Attaque : -1D3 | DLA : +30mn</b>", "Très Léger", "2,5", "200");
				break;
				case "Idees2" :
					write(value, "<b>Attaque : -2D3 | DLA : +60mn</b>", "Très Léger", "2,5", "900");
				break;
				case "Idees3" :
					write(value, "<b>Attaque : -3D3 | DLA : +90mn</b>", "Très Léger", "2,5", "1300");
				break;
				case "Idees4" :
					write(value, "<b>Attaque : -4D3 | DLA : +120mn</b>", "Très Léger", "2,5", "1700");
				break;
				case "Idees5" :
					write(value, "<b>Attaque : -5D3 | DLA : +150mn</b>", "Très Léger", "2,5", "?");
				break;
				case "Invention" :
					write(value, "<b>?</b>", "Très Léger", "2,5", "?");
				break;
				case "Plan1" :
					write(value, "<b>Attaque : +1D3 | Dégâts : +1 | DLA : -15mn</b>", "Très Léger", "2,5", "250");
				break;
				case "Plan2" :
					write(value, "<b>Attaque : +2D3 | Dégâts : +2 | DLA : -30mn</b>", "Très Léger", "2,5", "600");
				break;
				case "Plan3" :
					write(value, "<b>Attaque : +3D3 | Dégâts : +3 | DLA : -45mn</b>", "Très Léger", "2,5", "950");
				break;
				case "Plan4" :
					write(value, "<b>Attaque : +4D3 | Dégâts : +4 | DLA : -60mn</b>", "Très Léger", "2,5", "?");
				break;
				case "Plan5" :
					write(value, "<b>Attaque : +5D3 | Dégâts : +5 | DLA : -75mn</b>", "Très Léger", "2,5", "?");
				break;
				case "RuneC1" :
					write(value, "<b>Attaque : +1D3 | Dégâts : +1 | Vue : -1</b>", "Très Léger", "2,5", "200");
				break;
				case "RuneC2" :
					write(value, "<b>Attaque : +2D3 | Dégâts : +2 | Vue : -2</b>", "Très Léger", "2,5", "200");
				break;
				case "RuneC3" :
					write(value, "<b>Attaque : +3D3 | Dégâts : +3 | Vue : -3</b>", "Très Léger", "2,5", "?");
				break;
				case "RuneC4" :
					write(value, "<b>Attaque : +4D3 | Dégâts : +4 | Vue : -4</b>", "Très Léger", "2,5", "900");
				break;
				case "RuneC5" :
					write(value, "<b>Attaque : +5D3 | Dégâts : +5 | Vue : -5</b>", "Très Léger", "2,5", "1200");
				break;
				case "RuneF1" :
					write(value, "<b>Dégâts : -1 | Vue : -1 | PV : -1D3</b>", "Très Léger", "2,5", "100");
				break;
				case "RuneF2" :
					write(value, "<b>Dégâts : -2 | Vue : -1 | PV : -2D3</b>", "Très Léger", "2,5", "200");
				break;
				case "RuneF3" :
					write(value, "<b>Dégâts : -3 | Vue : -1 | PV : -3D3</b>", "Très Léger", "2,5", "250");
				break;
				case "RuneF4" :
					write(value, "<b>Dégâts : -4 | Vue : -1 | PV : -4D3</b>", "Très Léger", "2,5", "350");
				break;
				case "RuneE1" :
					write(value, "<b>PV : -1D3 | Effet de Zone</b>", "Très Léger", "2,5", "50");
				break;
				case "RuneE2" :
					write(value, "<b>PV : -2D3 | Effet de Zone</b>", "Très Léger", "2,5", "100");
				break;
				case "RuneE3" :
					write(value, "<b>PV : -3D3 | Effet de Zone</b>", "Très Léger", "2,5", "120");
				break;
				case "RuneE4" :
					write(value, "<b>PV : -4D3 | Effet de Zone</b>", "Très Léger", "2,5", "?");
				break;
				case "RuneE5" :
					write(value, "<b>PV : -5D3 | Effet de Zone</b>", "Très Léger", "2,5", "?");
				break;
				case "RuneE6" :
					write(value, "<b>PV : -6D3 | Effet de Zone</b>", "Très Léger", "2,5", "?");
				break;
				case "RuneE8" :
					write(value, "<b>PV : -8D3 | Effet de Zone</b>", "Très Léger", "2,5", "?");
				break;
				case "RuneE10" :
					write(value, "<b>PV : -10D3 | Effet de Zone</b>", "Très Léger", "2,5", "?");
				break;
				case "SortAnaAna" :
					write(value, "<b>Permet d'apprendre le sort : Analyse Anatomique</b>", "Très Léger", "2,5", "2000");
				break;
				case "SortArmEth" :
					write(value, "<b>Permet d'apprendre le sort : Armure Etherée</b>", "Très Léger", "2,5", "?");
				break;
				case "SortAugAtt" :
					write(value, "<b>Permet d'apprendre le sort : Augmentation de l'Attaque</b>", "Très Léger", "2,5", "?");
				break;
				case "SortAugEsq" :
					write(value, "<b>Permet d'apprendre le sort : Augmentation de l'Esquive</b>", "Très Léger", "2,5", "?");
				break;
				case "SortAugDeg" :
					write(value, "<b>Permet d'apprendre le sort : Augmentation des Dégâts</b>", "Très Léger", "2,5", "?");
				break;
				case "SortBulle" :
					write(value, "<b>Permet d'apprendre le sort : Bulle Anti-Magie</b>", "Très Léger", "2,5", "?");
				break;
				case "SortExplosion" :
					write(value, "<b>Permet d'apprendre le sort : Explosion</b>", "Très Léger", "2,5", "?");
				break;
				case "SortFaiblesse" :
					write(value, "<b>Permet d'apprendre le sort : Faiblesse Passagère</b>", "Très Léger", "2,5", "?");
				break;
				case "SortFlash" :
					write(value, "<b>Permet d'apprendre le sort : Flash Aveuglant</b>", "Très Léger", "2,5", "?");
				break;
				case "SortGlue" :
					write(value, "<b>Permet d'apprendre le sort : Glue</b>", "Très Léger", "2,5", "?");
				break;
				case "SortIdentification" :
					write(value, "<b>Permet d'apprendre le sort : Identification des Trésors</b>", "Très Léger", "2,5", "2000");
				break;
				case "SortInvisibilite" :
					write(value, "<b>Permet d'apprendre le sort : Invisibilité</b>", "Très Léger", "2,5", "?");
				break;
				case "SortProjection" :
					write(value, "<b>Permet d'apprendre le sort : Projection</b>", "Très Léger", "2,5", "?");
				break;
				case "SortSacrifice" :
					write(value, "<b>Permet d'apprendre le sort : Sacrifice</b>", "Très Léger", "2,5", "?");
				break;
				case "SortTeleportation" :
					write(value, "<b>Permet d'apprendre le sort : Téléportation</b>", "Très Léger", "2,5", "?");
				break;
				case "SortTelekinesie" :
					write(value, "<b>Permet d'apprendre le sort : Télékinésie</b>", "Très Léger", "2,5", "?");
				break;
				case "SortVisAcc" :
					write(value, "<b>Permet d'apprendre le sort : Vision Accrue</b>", "Très Léger", "2,5", "?");
				break;
				case "SortVisLoi" :
					write(value, "<b>Permet d'apprendre le sort : Vision Lointaine</b>", "Très Léger", "2,5", "2500");
				break;
				case "SortVisTro" :
					write(value, "<b>Permet d'apprendre le sort : Vision TRoublée</b>", "Très Léger", "2,5", "?");
				break;
				case "SortVoiCac" :
					write(value, "<b>Permet d'apprendre le sort : Voir le Caché</b>", "Très Léger", "2,5", "?");
				break;
				case "Traite1" :
					write(value, "<b>Vue : +1 | DLA : -30mn</b>", "Très Léger", "2,5", "300");
				break;
				case "Traite2" :
					write(value, "<b>Vue : +2 | DLA : -60mn</b>", "Très Léger", "2,5", "650");
				break;
				case "Traite3" :
					write(value, "<b>Vue : +3 | DLA : -90mn</b>", "Très Léger", "2,5", "1200");
				break;
				case "Traite4" :
					write(value, "<b>Vue : +4 | DLA : -120mn</b>", "Très Léger", "2,5", "1500");
				break;
				case "Traite5" :
					write(value, "<b>Vue : +5 | DLA : -150mn</b>", "Très Léger", "2,5", "1800");
				break;
			}
		break;
		case "Potions" :
			switch(version)
			{
				case "Elixir1" :
					write(value, "<b>Vue : +1</b>", "Très Léger", "5", "90");
				break;
				case "Elixir2" :
					write(value, "<b>Vue : +2</b>", "Très Léger", "5", "150");
				break;
				case "Elixir3" :
					write(value, "<b>Vue : +3</b>", "Très Léger", "5", "250");
				break;
				case "Elixir4" :
					write(value, "<b>Vue : +4</b>", "Très Léger", "5", "?");
				break;
				case "Elixir5" :
					write(value, "<b>Vue : +5</b>", "Très Léger", "5", "?");
				break;
				case "Elixir8" :
					write(value, "<b>Vue : +8 | DLA : -120mn</b>", "Très Léger", "5", "?");
				break;
				case "Essence1" :
					write(value, "<b>Vue : +1 | Régénération : +1</b>", "Très Léger", "5", "150");
				break;
				case "Essence2" :
					write(value, "<b>Vue : +2 | Régénération : +2</b>", "Très Léger", "5", "400");
				break;
				case "Essence3" :
					write(value, "<b>Vue : +3 | Régénération : +3 | PV : +2D3</b>", "Très Léger", "5", "?");
				break;
				case "Essence4" :
					write(value, "<b>Vue : +4 | Régénération : +4 | PV : +2D3</b>", "Très Léger", "5", "1000");
				break;
				case "Essence5" :
					write(value, "<b>Vue : +5 | Régénération : +5 | PV : +4D3</b>", "Très Léger", "5", "1000");
				break;
				case "Extrait1" :
					write(value, "<b>Dégâts : +1 | Régénération : +1 | PV : +2D3</b>", "Très Léger", "5", "200");
				break;
				case "Extrait2" :
					write(value, "<b>Dégâts : +2 | Régénération : +2 | PV : +2D3</b>", "Très Léger", "5", "600");
				break;
				case "Extrait3" :
					write(value, "<b>Dégâts : +3 | Régénération : +3 | PV : +2D3</b>", "Très Léger", "5", "?");
				break;
				case "Extrait4" :
					write(value, "<b>Dégâts : +4 | Régénération : +4 | PV : +2D3</b>", "Très Léger", "5", "1200");
				break;
				case "Extrait5" :
					write(value, "<b>Dégâts : +5 | Régénération : +5 | PV : +2D3</b>", "Très Léger", "5", "1200");
				break;
				case "Grippe1" :
					write(value, "<b>Attaque : -3D3 | Esquive : -3D3 | Dégâts : -3 | Régénération : -3</b>", "Très Léger", "5", "?");
				break;
				case "Grippe2" :
					write(value, "<b>Attaque : -4D3 | Esquive : -4D3 | Dégâts : -4 | Régénération : -4</b>", "Très Léger", "5", "?");
				break;
				case "Jus1" :
					write(value, "<b>DLA : -30mn</b>", "Très Léger", "5", "150");
				break;
				case "Jus2" :
					write(value, "<b>DLA : -60mn</b>", "Très Léger", "5", "450");
				break;
				case "Jus3" :
					write(value, "<b>DLA : -90mn</b>", "Très Léger", "5", "650");
				break;
				case "Jus4" :
					write(value, "<b>DLA : -120mn</b>", "Très Léger", "5", "?");
				break;
				case "Jus5" :
					write(value, "<b>DLA : -150mn</b>", "Très Léger", "5", "?");
				break;
				case "Lampe" :
					write(value, "<b>?</b>", "Très Léger", "5", "?");
				break;
				case "Pneumonie" :
					write(value, "<b>Attaque : -5D3 | Esquive : -5D3 | Dégâts : -5 | Régénération : -5</b>", "Très Léger", "5", "?");
				break;
				case "Potion1" :
					write(value, "<b>PV : +2D3</b>", "Très Léger", "5", "80");
				break;
				case "Potion2" :
					write(value, "<b>PV : +4D3</b>", "Très Léger", "5", "140");
				break;
				case "Potion3" :
					write(value, "<b>PV : +6D3</b>", "Très Léger", "5", "160");
				break;
				case "Potion4" :
					write(value, "<b>PV : +8D3</b>", "Très Léger", "5", "?");
				break;
				case "Potion5" :
					write(value, "<b>PV : +10D3</b>", "Très Léger", "5", "?");
				break;
				case "PufPuf1" :
					write(value, "<b>Vue : -1 | Effet de Zone</b>", "Très Léger", "5", "30");
				break;
				case "PufPuf2" :
					write(value, "<b>Attaque : -1D3 | Esquive : -1D3 | Vue : -2 | Effet de Zone</b>", "Très Léger", "5", "150");
				break;
				case "PufPuf3" :
					write(value, "<b>Attaque : -2D3 | Esquive : -2D3 | Vue : -3 | PV : -2D3 | Effet de Zone</b>", "Très Léger", "5", "150");
				break;
				case "Rhume1" :
					write(value, "<b>Attaque : -1D3 | Esquive : -1D3 | Dégâts : -1 | Régénération : -1</b>", "Très Léger", "5", "150");
				break;
				case "Rhume2" :
					write(value, "<b>Attaque : -2D3 | Esquive : -2D3 | Dégâts : -2 | Régénération : -2</b>", "Très Léger", "5", "350");
				break;
				case "Sang1" :
					write(value, "<b>Attaque : +1D3 | Esquive : +1D3</b>", "Très Léger", "5", "100");
				break;
				case "Sang2" :
					write(value, "<b>Attaque : +2D3 | Esquive : +2D3</b>", "Très Léger", "5", "300");
				break;
				case "Sang3" :
					write(value, "<b>Attaque : +3D3 | Esquive : +3D3 | Vue : +1</b>", "Très Léger", "5", "?");
				break;
				case "Sang4" :
					write(value, "<b>Attaque : +4D3 | Esquive : +4D3 | Vue : +1</b>", "Très Léger", "5", "?");
				break;
				case "Toxine1" :
					write(value, "<b>PV : -1D3</b>", "Très Léger", "5", "?");
				break;
				case "Toxine2" :
					write(value, "<b>PV : -2D3</b>", "Très Léger", "5", "50");
				break;
				case "Toxine4" :
					write(value, "<b>PV : -4D3</b>", "Très Léger", "5", "?");
				break;
				case "Toxine6" :
					write(value, "<b>PV : -6D3</b>", "Très Léger", "5", "100");
				break;
				case "Toxine8" :
					write(value, "<b>PV : -8D3</b>", "Très Léger", "5", "?");
				break;
				case "Toxine10" :
					write(value, "<b>PV : -10D3</b>", "Très Léger", "5", "?");
				break;
				case "Zet1" :
					write(value, "<b>Attaque : -1D3 | Esquive : -1D3 | Vue : -1 | PV : +2D3</b>", "Très Léger", "5", "60");
				break;
				case "Zet2" :
					write(value, "<b>Attaque : -2D3 | Esquive : -2D3 | Vue : -1 | PV : +4D3</b>", "Très Léger", "5", "200");
				break;
				case "Zet3" :
					write(value, "<b>Attaque : -3D3 | Esquive : -3D3 | Vue : -1 | PV : +6D3</b>", "Très Léger", "5", "250");
				break;
				case "Zet4" :
					write(value, "<b>Attaque : -4D3 | Esquive : -4D3 | Vue : -1 | PV : +8D3</b>", "Très Léger", "5", "?");
				break;
				case "Zet5" :
					write(value, "<b>Attaque : -5D3 | Esquive : -5D3 | Vue : -1 | PV : +10D3</b>", "Très Léger", "5", "500");
				break;
			}
		break;
	}
}
</script>
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

function write(value, effet, description)
{
	var oEffet = document.getElementById("oEffet" + value);
	oEffet.innerHTML = effet;
	var oDescription = document.getElementById("oDescription" + value);
	oDescription.innerHTML = description;
}

function fillBox(value)
{
	var box = document.getElementById("oBox"+value);
	
	box.innerHTML =	
   		"<select id=\"oAttaquant"+value+"\" onChange=\"fillBox2('"+value+"')\">"+
	   			"<option value=\"Deplacer\" selected=''>Se Déplacer</option>"+
     			"<option value=\"Goinfrer\">Se Goinfrer</option>"+
   		"</select>";
   		
	fillBox2(value);
}

function fillBox2(value)
{
	var box = document.getElementById("oBoxM"+value);
	var select = document.getElementById("oAttaquant"+value);
	var race = select.options[select.selectedIndex].value;
	var text = "<select id=\"oVictime"+value+"\" onChange=\"fillRow('"+value+"')\">";
	
	switch(race)
	{
	   	case "Goinfrer" :
		{
			text = text + "<option value=\"Beuark\" selected=''>Beuark</option>";
			text = text + "<option value=\"Burps\">Burps</option>";
			text = text + "<option value=\"Clonk\">Clonk</option>";
			text = text + "<option value=\"Grrrouar\">Grrrouar</option>";
			text = text + "<option value=\"Miam\">Miam</option>";
			text = text + "<option value=\"Oulalala\">Oulalala</option>";
			text = text + "<option value=\"Pssschit\">Pssschit</option>";
			text = text + "<option value=\"Vaterzouille\">Vaterzouille</option>";
			text = text + "<option value=\"Ventheux\">Ventheux</option>";
		}
		break;
	   	case "Deplacer" :
		{
			text = text + "<option value=\"BienRepose1\" selected=''>Bien Reposé 1</option>";
			text = text + "<option value=\"BienRepose2\">Bien Reposé 2</option>";
			text = text + "<option value=\"Chemin\">Chemin Dégagé</option>";
			text = text + "<option value=\"Chute\">Chute</option>";
			text = text + "<option value=\"Foudre\">Foudre (surface)</option>";
			text = text + "<option value=\"Piege\">Piege à Feu</option>";
			text = text + "<option value=\"Precision\">Précision Diabolique</option>";
			text = text + "<option value=\"Reflexes\">Réflexes Emoussés</option>";
			text = text + "<option value=\"Tornade\">Tornade (surface)</option>";
			text = text + "<option value=\"Vigilance\">Vigilance Accrue</option>";
			text = text + "<option value=\"Vue\">Vue Encombrée</option>";
		}
		break;
	}
	
	text = text + "</select>";

	box.innerHTML = text;

	fillRow(value);
}

function fillRow(value)
{
	var select = document.getElementById("oAttaquant"+value);
	var name = select.options[select.selectedIndex].value;

	var select2 = document.getElementById("oVictime"+value);
	var version = select2.options[select2.selectedIndex].value;

	switch(name)
	{
		case "Goinfrer" :
			switch(version)
			{
				case "Beuark" :
					write(value, "<b>PV : -1D3</b>", "Pas bon, pas bon !! Ca tord les boyaux et pique aux yeux, il devait être pourri celui là.");
				break;
				case "Burps" :
					write(value, "<b>Aucun</b>", "Le trésor a un drole de goût mais aucun effet. Ce fut une bonne expérience mais complétement infructueuse.");
				break;
				case "Clonk" :
					write(value, "<b>Armure : +1</b>", "Un peu dur mais cela renforce les dents. Ce qui ne nous tue pas nous rend plus fort.");
				break;
				case "Grrrouar" :
					write(value, "<b>Dégâts : +1</b>", "Il faut que je mange encore quelque chose, ce petit en-cas m'a mis en appétit.");
				break;
				case "Miam" :
					write(value, "<b>PV : +1D3</b>", "Excellent ce petit en-cas. Foi de Troll, il y avait longtemps que je n'avais aussi bien mangé.");
				break;
				case "Oulalala" :
					write(value, "<b>DLA : +7,5mn</b>", "C'est un peu lourd à digérer ce truc. Il faut que je me repose 5 minutes.");
				break;
				case "Pssschit" :
					write(value, "<b>Esquive : +1D3</b>", "Ouah, quel impression bizarre, ça pétille et ça me donne envie de danser.");
				break;
				case "Vaterzouille" :
					write(value, "<b>Dégâts : +1</b>", "Ca me rappelle la soupe aux légume que me faisait ma grand mère avec plein de morceaux de viande dedans. Elle me disait toujours: Mange ta soupe pour devenir grand et fort comme ton père.");
				break;
				case "Ventheux" :
					write(value, "<b>DLA : -15mn</b>", "C'est très léger et je me sens pousser des ailes. On court un peu pour se dégourdir les jambes ?");
				break;
			}
		break;
		case "Deplacer" :
			switch(version)
			{
				case "BienRepose1" :
					write(value, "<b>PV : +X | Attaque : +Y | Esquive : +Z</b>", "Vous vous êtes parfaitement bien reposé et vous avez retrouvé des couleurs malgré la morosité des lieux. Cela vous a permis de régénérer X points de vie. Vous avez, de plus, pris confiance en vos coups et gagnez temporairement Y points en Attaque et Z points en Esquive.");
				break;
				case "BienRepose2" :
					write(value, "<b>PV : +X</b>", "Vous vous êtes assez bien reposé et vous avez retrouvé des couleurs malgré la morosité des lieux. Cela vous a permis de régénérer X points de vie.");
				break;
				case "Chemin" :
					write(value, "<b>PA : +X</b>", "Le chemin est dégagé et cela vous permet de progresser rapidement; vous venez donc de gagner X Points d'Action.");
				break;
				case "Chute" :
					write(value, "<b>PV : -X | Y niveaux plus bas</b>", "Le sol s'est effondré sous vos pas et vous vous retrouvez Y niveaux plus bas. Vous vous êtes fortement blessé et perdez X points de vie.");
				break;
				case "Foudre" :
					write(value, "<b>PV : -X</b>", "Alors que vous étiez à la surface de MountyHall, un gros orage a éclaté. Incapable de vous mettre à l'abri rapidement, vous avez été touché par la foudre qui est tombé près de vous. Cela vous a fait perdre X points de Vie.");
				break;
				case "Piege" :
					write(value, "<b>PV : -X | Attaque : -Y | Esquive : -Z</b>", "Vous avez marché sur un Piège à Feu qui a explosé à votre passage vous infligeant X points de Dégâts. Vous êtes de plus légèrement étourdi et perdez temporairement Y points en Attaque et Z points en Esquive.");
				break;
				case "Precision" :
					write(value, "<b>Attaque : +X</b>", "Confiant dans la maîtrise de vos techniques de combat, vous êtes particulièrement conscient des faiblesses que vos adversaires pourraient présenter. Cela vous fait gagner de manière temporaire X points en Attaque.");
				break;
				case "Reflexes" :
					write(value, "<b>Esquive : -X</b>", "Fatigué par une longue période de marche, vous n'êtes plus aussi vigilant et perdez temporairement X points en Esquive");
				break;
				case "Tornade" :
					write(value, "<b>PV : -X</b>", "Une énorme Tornade éclate au dessus de votre tête alors que vous étiez paisiblement sorti du Monde Souterrain. Surpris par la violence de la Nature, vous avez chuté et vous vous êtes perdu. La chute vous a occasionné une blessure de X points de vie.");
				break;
				case "Vigilance" :
					write(value, "<b>Esquive : +X</b>", "Très attentif à tout ce qui vous entoure, vous ne laissez échapper aucun des mouvement suspect qui se déroulent dans votre champ de vision. Cela vous fait gagner temporairement X points en Esquive.");
				break;
				case "Vue" :
					write(value, "<b>Vue : -X</b>", "La Zone où vous vous trouvez est pleine d'éboulis et vous n'y voyez plus rien du tout. Votre Vue est diminuée provisoirement de X Cases.");
				break;
			}
		break;
	}
}

function writee(value, niveau, pi, race, pa, descript)
{
	var oNiveau = document.getElementById("oNiveau" + value);
	oNiveau.innerHTML = niveau;
	var oPi = document.getElementById("oPi" + value);
	oPi.innerHTML = pi;
	var oRace = document.getElementById("oRace" + value);
	oRace.innerHTML = race;
	var oPa = document.getElementById("oPa" + value);
	oPa.innerHTML = pa;
	var oDescript = document.getElementById("oDescript" + value);
	oDescript.innerHTML = descript;
}

function fillBoxe(value)
{
	var boxe = document.getElementById("oBoxe"+value);
	
	boxe.innerHTML =	
   		"<select id=\"oSort"+value+"\" onChange=\"fillRowe('"+value+"')\">"+
	   			"<option value=\"Acceleration\" selected=''>Accélération Métabolique</option>"+
	   			"<option value=\"Alchimiste\">Alchimiste</option>"+
	   			"<option value=\"Attaque\">Attaque Précise</option>"+
				"<option value=\"Bidouille\">Bidouille</option>"+
	   			"<option value=\"Botte\">Botte Secrète</option>"+
	   			"<option value=\"Camouflage\">Camouflage</option>"+
	   			"<option value=\"Charger\">Charger</option>"+
	   			"<option value=\"Connaissance\">Connaissance des Monstres</option>"+
	   			"<option value=\"Construire\">Construire un Piège</option>"+
	   			"<option value=\"Contre\">Contre-Attaquer</option>"+
	   			"<option value=\"Coup\">Coup de Butoir</option>"+
	   			"<option value=\"Deplacement\">Déplacement Eclair</option>"+
	   			"<option value=\"Ecriture\">Ecriture Magique</option>"+
	   			"<option value=\"Frenesie\">Frénésie</option>"+
	   			"<option value=\"Hurlement\">Hurlement Effrayant</option>"+
	   			"<option value=\"Hypnotisme\">Hypnotisme</option>"+
     			"<option value=\"Champignons\">Identification des Champignons</option>"+
     			"<option value=\"Tresors\">Identification des Trésors</option>"+
	   			"<option value=\"Insulte\">Insulte</option>"+
	   			"<option value=\"Parer\">Parer</option>"+
	   			"<option value=\"Pistage\">Pistage</option>"+
	   			"<option value=\"Projectile\">Projectile Magique</option>"+
	   			"<option value=\"Rafale\">Rafale Psychique</option>"+
	   			"<option value=\"Regeneration\">Régénération Accrue</option>"+
	   			"<option value=\"Vampirisme\">Vampirisme</option>"+
  		"</select>";
   		
	fillRowe(value);
}

function fillRowe(value)
{
	var select = document.getElementById("oSort"+value);
	var name = select.options[select.selectedIndex].value;

	switch(name)
	{
		case "Acceleration" :
			writee(value, "<b>0</b>", "<b>0</b>", "KASTAR", "2", "En sacrifiant des points de vie, les Kastars peuvent diminuer la durée de leur tour :<br>Pour chaque PV payé, 30 minutes (variable, cfr. ci-dessous) sont décomptées à la DLA actuelle.<br>L'accélération métabolique est liée à un compteur de fatigue (indiqué sur le profil du troll).<br>A chaque accélération, ce compteur est augmenté d'une valeur égale au nombre de points de vie sacrifiés lors de l'accélération.<br>Au début de chaque DLA (Date Limite d'Action), ce compteur est divisé par 1,5.<br>Le gain en minute par PV sacrifié est calculé en fonction de ce compteur, si celui-ci est supérieur à 4, sinon, le gain est toujours de 30 minutes par PV sacrifié.<br>Gain en minutes par PV sacrifié = 30/(25 % du Compteur de Fatigue) minutes.");
		break;
		case "Alchimiste" :
			writee(value, "<b>15</b>", "<b>150</b>", "?", "?", "En développement.");
		break;
		case "Attaque" :
			writee(value, "<b>5</b>", "<b>50</b>", "TOUTES", "4", "L'Attaque précise permet d'asséner une attaque particulièrement ciblée ayant les caractéristiques suivantes :<br>Jet d'Attaque : 3 D6 par 2 Dés d'Attaque + BM d'Attaque<br>Jet de Dégats : 1 D3 par Dé de Dégat + BM de Dégats.");
		break;
		case "Bidouille" :
			writee(value, "<b>2</b>", "<b>20</b>", "TOUTES", "2", " Permet de personnaliser un objet que vous possédez, ou de créer de toute pièce un objet personnalisé.<br>* Pour les bidouilles créées de toutes pièces, le choix du nom et du poids sont totalement libres.");
		break;
		case "Botte" :
			writee(value, "<b>0</b>", "<b>0</b>", "SKRIM", "2", "La Botte secrète permet aux skrims de réaliser, une fois par tour, une attaque rapide ayant les caractéristiques suivantes :<br>Jet d'Attaque : 1 D6 par 2 Dés d'Attaque + 1/2 BM d'Attaque<br>Jet de Dégats : 1 D3 par 2 Dés d'Attaque + 1/2 BM de Dégat.<br>50 % de l'armure physique de la cible est ignorée.");
		break;
		case "Camouflage" :
			writee(value, "<b>0</b>", "<b>0</b>", "TOMAWAK", "2", "Le Tomawak Camouflé ne peut être vu que par les Trolls ou les Monstres situés sur la même zone que lui.<br>Le Camouflage n'a pas de limite de durée mais peut être rompu (automatiquement ou non) si le Trõll réalise certaines actions.<br>Déplacement : un jet de compétence est nécessaire pour conserver le Camouflage (Ce jet ne coûte aucun PA et ne rapporte pas de PX).<br>Attaque de la part du Tomawak : le Camouflage est automatiquement rompu.<br>Projectile Magique : un jet de compétence (à 25% du niveau du sortilège) est nécessaire pour conserver le Camouflage (Ce jet ne coûte aucun PA et ne rapporte pas de PX).<br>Retirer le Camouflage : Action volontaire du Tomawak coutant 1PA");
		break;
		case "Champignons" :
			writee(value, "<b>1</b>", "<b>0</b>", "TOUTES", "2", "En développement.");
		break;
		case "Charger" :
			writee(value, "<b>5</b>", "<b>50</b>", "TOUTES", "4", "Charger permet de se déplacer et frapper dans un même tour pour un coup en PA identique à une attaque traditionnelle.<br>L'attaque est réalisée sur les bases suivantes:<br>Jet d'Attaque : 1 D6 par Dé d'Attaque + BM d'Attaque<br>Jet de Dégats : 1 D3 par Dé de Dégat + BM de Dégat.<br>La Distance parcourue pour atteindre sa cible ne peut dépasser 1 Zone + la moyenne de :<br>1 Zone par tranche entière de 10 PV Actuels au dessus de 30.<br>1 Zone par dé de Régénération au dessus du 1er.<br>NB: La charge déclenche un piège si celui-ci se trouve sur la case d'arrivée.");
		break;
		case "Connaissance" :
			writee(value, "<b>1</b>", "<b>10</b>", "TOUTES", "1", "La Connaissance de Monstre permet de connaitre approximativement les caractéristiques physiques d'un monstre situé à portée de Vue.");
		break;
		case "Construire" :
			writee(value, "<b>5</b>", "<b>50</b>", "TOUTES", "4", "Un piège est posé sur une case définie lors de l'utilisation de cette compétence.<br>Le Piège reste indéfiniment sur la case ciblée. Il existe différents types de Pièges :<br>Piège à feu :<br>Jet de Dégats : ((Vue + Esquive)/2) D3<br>La Résistance Magique s'applique<br>Disparait lorsqu'un Troll marche sur la case où il a été posé.<br>Un seul piège peut être posé sur une même case, et il est impossible de poser un Piège sur un Lieu");
		break;
		case "Contre" :
			writee(value, "<b>2</b>", "<b>20</b>", "TOUTES", "2", "La Contre-Attaque est une réponse rapide à une attaque sur votre Trõll. Les jets de Contre-Attaque utilisent les caractéristiques suivantes:<br>Jet d'Attaque : 1 D6 par 2 Dés d'Attaque + 1/2 BM d'Attaque<br>Jet de Dégats : 1 D3 par Dé de Dégat + BM de Dégat.");
		break;
		case "Coup" :
			writee(value, "<b>5</b>", "<b>50</b>", "TOUTES", "4", "Le Coup de Butoir permet d'asséner une attaque particulièrement violente ayant les caractéristiques suivantes :<br>Jet d'Attaque : 1 D6 par Dé d'Attaque + BM d'Attaque<br>Jet de Dégats : 3 D3 par 2 Dés de Dégat + BM de Dégats.<br>En cas de coup critique, Le Bonus au dégats du Coup de Butoir et du Coup Critique s'additionnent pour un total de 2 D3 par Dé de Dégat + BM de Dégats.");
		break;
		case "Deplacement" :
			writee(value, "<b>2</b>", "<b>20</b>", "TOUTES", "2", "Réussir un Déplacement Eclair permet de diminuer de 1 PA un déplacement (minimum 1 PA). En cas d'échec au jet de compétence, un seul PA est dépensé mais aucun mouvement n'est effectué.<br>Le déplacement Eclair ne peut être utilisé à partir d'une zone située en surface.<br>Remarque : Les déplacement Verticaux coûtent 1PA supplémentaire. Les déplacements à partir d'une case déjà occupée coûtent 1PA supplémentaire.");
		break;
		case "Ecriture" :
			writee(value, "<b>10</b>", "<b>100</b>", "TOUTES", "5", "En développement.");
		break;
		case "Frenesie" :
			writee(value, "<b>10</b>", "<b>100</b>", "TOUTES", "6", "La Frénésie permet à votre Trõll de frapper deux fois en un seul tour avec les caractéristiques suivantes pour les deux attaques :<br>Jet d'Attaque : 1 D6 par Dé d'Attaque + BM d'Attaque<br>Jet de Dégats : 1 D3 par Dés de Dégat + BM de Dégat.<br>Si la première attaque est esquivée ou parée par votre adversaire, il ne sera pas possible de réaliser la deuxième.<br>Esquive réduite à zéro jusu'à la prochaine DLA.");
		break;
		case "Hurlement" :
			writee(value, "<b>2</b>", "<b>20</b>", "TOUTES", "2", "En développement.");
		break;
		case "Hypnotisme" :
			writee(value, "<b>0</b>", "<b>0</b>", "SKRIMS", "4", "L'hypnotisme permet de cibler un Trõll ou un Monstre. La cible de l'hypnotisme perd tous les PA qui lui restaient et vois son esquive réduite de 1,5 X vos Dés d'Esquive jusqu'à la fin de son Tour. Toutes les Actionséventuellement programmées (parade, contre-attaque) sont également annulées.<br>Un Jet de Résistance réussi de la part de la Cible lui permet de ne pas subir la perte des PA et de n'avoir qu'un malus de 1D en Esquive par 3 Dés d'Esquive que vous possédez.");
		break;
		case "Insulte" :
			writee(value, "<b>1</b>", "<b>10</b>", "TOUTES", "1", "Permet d'insulter un monstre situé sur votre zone ou une zone adjacente sur le même niveau. S'il rate son Jet de Résistance, le monstre vous prendra comme cible privilégée et sera enclin à vous attaquer en priorité.");
		break;
		case "Parer" :
			writee(value, "<b>2</b>", "<b>20</b>", "TOUTES", "2", "Si votre Trõll est attaqué et qu'une parade a été programmée avec succès, un Jet de Parade est lancé basé sur :<br>Jet de Parade : 1 D6 par 2 Dés d'Attaque + 1/2 BM d'Attaque<br>Si ce jet est supérieur au Jet d'Attaque de votre assaillant, l'attaque est parée et aucun dégat n'est infligé.<br>La Parade est une compétence programmée et qui n'a donc un effet que si votre troll est attaqué après qu'elle ait été réussie et durant le tour où elle est utilisée");
		break;
		case "Pistage" :
			writee(value, "<b>1</b>", "<b>10</b>", "TOUTES", "1", "Le Pistage permet à votre Trõll de connaître la direction qu'il faut suivre pour rejoindre sa cible par le plus court chemin. Si la cible de la compétence (monstre ou Trõll) se trouve à plus de deux fois la vue de votre Trõll (bonus inclus), elle sera impossible à pister.");
		break;
		case "Projectile" :
			writee(value, "<b>0</b>", "<b>0</b>", "TOMAWAK", "4", "Les Projectiles Magiques lancés par les Tomawak sont des attaques à distance ayant les caractéristiques suivantes :<br>Jet d'Attaque : 1 D6 par Zone de Vue<br>Jet de Dégats : 1 D3 par 2 Zones de Vue.<br>La Portée maximale du projectile magique sa cible dépend de la somme de la vue et des BM de vue et vaut : 1-4 => 1 case, 5-9 => 2 cases, 10-15 => 3 cases, 16-22 => 4 cases, 23-30 => 5 cases, 31-39 => 6 cases), etc...<br>Un Jet de Résistance réussi de la part de la Cible lui permet de ne subir que la moitié des dégats infligés.<br>Une attaque de Projectile Magique n'annule pas automatiquement le camouflage éventuel du Tomawak : un jet de camouflage sous 25% du niveau de la compétence permettra au Trõll de garder son camouflage effectif.");
		break;
		case "Rafale" :
			writee(value, "<b>0</b>", "<b>0</b>", "DURAKUIR", "4", "La Rafale Psychique est une attaque insidieuse qui ne laisse aucune chance à la victime du sortilège. L'attaque a les caractéristiques suivantes :<br>Jet d'Attaque : Automatiquement réussi<br>Jet de Dégats : 1 D3 par D3 Dégats.<br>Un effet secondaire (mais très utile) du sortilège est que la victime subit un malus à sa régénération durant deux Tours équivalent au nombre de Dés de Dégats du Durakuir assaillant. Le Régénération de la victime peut ainsi être quasi nulle pendant 2 Tours mais ne peut devenir négative.<br>Un Jet de Résistance réussi de la part de la Cible lui permet de ne subir que la moitié des dégats infligés et de n'avoir un malus de régénération que durant 1 Tour.<br>Cette attaque ne réduit pas l'esquive de l'adversaire de 1D comme le font les autres attaques.");
		break;
		case "Regeneration" :
			writee(value, "<b>0</b>", "<b>0</b>", "DURAKUIR", "2", "La régénération accrue permet aux Durakuirs de gagner des points de vie à raison de 1 D3 par tranche de 20 PV (40PV = 2D3, 60PV = 3D3, 80PV = 4D3, etc...).");
		break;
		case "Tresors" :
			writee(value, "<b>1</b>", "<b>0</b>", "TOUTES", "1", "Lancé sur une des pièces d'équipement par votre Trõll, l'Identification des Trésors permet d'en connaitre les caractéristiques et effets précis.<br>La nature Magique ou l'alliage spécial utilisé seront également découverts.<br>Une tradition vieille comme le temps veut qu'on mette une Titétikette sur un objet identifié afin de se rappeler ce que c'est. Un objet identifié l'est à jamais.");
		break;
		case "Vampirisme" :
			writee(value, "<b>0</b>", "<b>0</b>", "KASTAR", "4", "Le Vampirisme permet une attaque magique particulièrement dévastatrice pour la victime mais bénéfique pour l'assaillant. Ce dernier gagne en effet autant de PV que la moitié des dégats infligés à sa cible.<br>L'attaque par Vampirisme a les caractéristiques suivantes :<br>Jet d'Attaque : 2 D6 par 3 D3 Dégats<br>Jet de Dégats : 1 D3 par D3 Dégats.<br>Vampirisme : 50 % des Dégats infligés.<br>Un Jet de Résistance réussi de la part de la Cible lui permet de ne subir que la moitié des dégats infligés.");
		break;
	}
}
</script>

<table width="100%"  border="0" cellspacing="3" cellpadding="3">
  <tr>
    <td valign="top"><script language="Javascript">

function processPX()
{
	var troll = parseInt(document.MyForme.troll.value, 10);

	if (isNaN(troll))
	{
	  alert("Vous devez remplir Niveau du Troll avec un nombre");
	  return;
	}

	var monstre = parseInt(document.MyForme.monstre.value, 10); 
	
	if (isNaN(monstre))
	{
	  alert("Vous devez remplir Niveau du Monstre avec un nombre");
	  return;
	}

	var moyen = 0;
	if (document.MyForme.moyen[0].checked)
	{
	   moyen = 1;
	}
	else
	{
	   moyen = 2;
	}

	var test = monstre - ( 2 * (troll - monstre)) + 10 + moyen;
	if (test < "0")
		test = "0";

	var oPx = document.getElementById("oPx");
	oPx.innerHTML = test;
}

function processNiv()
{
	var troll = parseInt(document.MyForme.troll2.value, 10);

	if (isNaN(troll))
	{
	  alert("Vous devez remplir Niveau du Troll avec un nombre");
	  return;
	}

	var px = parseInt(document.MyForme.px2.value, 10); 
	
	if (isNaN(px))
	{
	  alert("Vous devez remplir PX Totaux avec un nombre");
	  return;
	}

	var moyen = 0;
	if (document.MyForme.moyen2[0].checked)
	{
	   moyen = 1;
	}
	else
	{
	   moyen = 2;
	}

	var niv = (px - moyen - 10 + 2 * troll) % 3;
	
	if (niv != 0)
	{
	  alert("Tu t'es trompé ! Recommence !");
	  return;
	}
	
	var niv = (px - moyen - 10 + 2 * troll) / 3;
	
	var oNiv = document.getElementById("oNiv");
	oNiv.innerHTML = niv;
}

function processRM()
{
	var mm = parseInt(document.MyForme.mm.value, 10);

	if (isNaN(mm))
	{
	  alert("Vous devez remplir MM du Troll avec un nombre");
	  return;
	}

	var sr = parseInt(document.MyForme.sr.value, 10); 
	
	if (isNaN(sr))
	{
	  alert("Vous devez remplir Seuil de Résistance avec un nombre (ex.: 50)");
	  return;
	}

	var rm = 0;
	if (sr <= 50)
	{
		rm = (sr * mm) / 50
	}
	else
	{
		rm = (mm * 50) / (100 - sr)
	}

	rm = parseInt(rm, 10);
	
	if (sr == 5)
	{
		rm = "moins de " + rm;
	}
	
	if (sr == 95)
	{
		rm = "plus de " + rm;
	}
	
	var oRM = document.getElementById("oRM");
	oRM.innerHTML = rm;
}

function processMM()
{
	var rm = parseInt(document.MyForme.rm.value, 10);

	if (isNaN(rm))
	{
	  alert("Vous devez remplir RM du Troll avec un nombre");
	  return;
	}

	var sr = parseInt(document.MyForme.sr2.value, 10); 
	
	if (isNaN(sr))
	{
	  alert("Vous devez remplir Seuil de Résistance avec un nombre (ex.: 50)");
	  return;
	}

	var mm = 0;
	if (sr <= 50)
	{
		mm = (rm * 50) / sr
	}
	else
	{
		mm = (rm * (100 - sr)) / 50
	}

	mm = parseInt(mm, 10);
	
	if (sr == 5)
	{
		mm = "plus de " + mm;
	}
	
	if (sr == 95)
	{
		mm = "moins de " + mm;
	}
	
	var oMM = document.getElementById("oMM");
	oMM.innerHTML = mm;
}

function processSR()
{
	var mm = parseInt(document.MyForme.mm2.value, 10);

	if (isNaN(mm))
	{
	  alert("Vous devez remplir MM du Troll avec un nombre");
	  return;
	}

	var rm = parseInt(document.MyForme.rm2.value, 10); 
	
	if (isNaN(rm))
	{
	  alert("Vous devez remplir RM du Monstre avec un nombre");
	  return;
	}

	var sr = 0.0;

	if (rm <= mm)
	{
		sr = (rm / mm) * 50
	}
	else
	{
		sr = 100 - ((mm * 50) / rm)
	}

	sr = parseInt(sr, 10);
	
	if (sr > 95)
	{
		sr = 95
	}
	
	if (sr < 5)
	{
		sr = 5
	}
	
	var mmposs = "";
	
	if (sr < 15)
	{
		mmposs = "+1"
	}
	else
	{
		if (sr < 45)
		{
			mmposs = "+1D3+1"
		}
		else
		{
			if (sr < 75)
			{
				mmposs = "+2D3+2"
			}
			else
			{
				mmposs = "+3D3+3"
			}
		}
	}
	
	var oSR = document.getElementById("oSR");
	oSR.innerHTML = sr;
	var oMMposs = document.getElementById("oMMposs");
	oMMposs.innerHTML = mmposs;
}

function processPI()
{
	var niv = parseInt(document.MyForme.niv.value, 10);

	if (isNaN(niv))
	{
	  alert("Vous devez remplir le niveau à atteindre");
	  return;
	}

	var pi = parseInt(document.MyForme.pi.value, 10);
	
	if (isNaN(pi))
	{
	  pi = "0";
	}

	var test = ( niv * ( niv + 1 ) - 2 ) * 5 ;
	
	var pii = test - pi;

	var oPi = document.getElementById("oPi");
	oPi.innerHTML = test;
	var oPii = document.getElementById("oPii");
	oPii.innerHTML = pii;
}

function processBlessure()
{
	var pv = parseInt(document.MyForme.pv.value, 10);

	if (isNaN(pv))
	{
	  alert("Vous devez remplir le niveau à atteindre");
	  return;
	}

	var deg = parseInt(document.MyForme.deg.value, 10);
	
	if (isNaN(deg))
	{
	  deg = "0";
	}

	var bless = 100 - (( Math.floor( (deg * 10) / pv ) ) * 10 );
	
	var malus =  Math.round(( (pv-deg)/pv ) * 250 );
	
	var hmalus = 0;
	while ( malus > 59 )
	{
		malus = malus - 60;
		hmalus = hmalus + 1;
	}	

	var mal = "";
	mal = mal + hmalus + " h " + malus + " mn";


	var oBless = document.getElementById("oBless");
	oBless.innerHTML = bless;
	var oMalbless = document.getElementById("oMalbless");
	oMalbless.innerHTML = mal;
}

function processDLA()
{
	var DebDLAh = parseInt(document.MyForme.DebDLAh.value, 10);
	var DebDLAm = parseInt(document.MyForme.DebDLAm.value, 10);
	var DurDLAh = parseInt(document.MyForme.DurDLAh.value, 10);
	var DurDLAm = parseInt(document.MyForme.DurDLAm.value, 10);
	var BonMalm = parseInt(document.MyForme.BonMalm.value, 10);
	var MalBleh = parseInt(document.MyForme.MalBleh.value, 10);
	var MalBlem = parseInt(document.MyForme.MalBlem.value, 10);
	var MalEquh = parseInt(document.MyForme.MalEquh.value, 10);
	var MalEqum = parseInt(document.MyForme.MalEqum.value, 10);

	if (isNaN(DebDLAh))
	{
		  DebDLAh = 0;
	}

	if (isNaN(DebDLAm))
	{
		  DebDLAm = 0;
	}

	if (isNaN(DurDLAh))
	{
		  DurDLAh = 0;
	}

	if (isNaN(DurDLAm))
	{
		  DurDLAm = 0;
	}

	if (isNaN(BonMalm))
	{
		  BonMalm = 0;
	}

	if (isNaN(MalBleh))
	{
		  MalBleh = 0;
	}

	if (isNaN(MalBlem))
	{
		  MalBlem = 0;
	}

	if (isNaN(MalEquh))
	{
		  MalEquh = 0;
	}

	if (isNaN(MalEqum))
	{
		  MalEqum = 0;
	}

	var Totalm = 0;
	if (document.MyForme.bonmal[0].checked)
	{
	   Totalm = Totalm + ( DebDLAh * 60 ) + DebDLAm + ( DurDLAh * 60 ) + DurDLAm - BonMalm + ( MalBleh * 60 ) + MalBlem + ( MalEquh * 60 ) + MalEqum;
	}
	else
	{
	   Totalm = Totalm + ( DebDLAh * 60 ) + DebDLAm + ( DurDLAh * 60 ) + DurDLAm + BonMalm + ( MalBleh * 60 ) + MalBlem + ( MalEquh * 60 ) + MalEqum;
	}
	
	if ( Totalm > 1440 )
	{
		Totalm = Totalm - 1440;
	}
	
	var hdla = 0;
	while ( Totalm > 59 )
	{
		Totalm = Totalm - 60;
		hdla = hdla + 1;
	}	

	var dla = "";
	dla = dla + hdla + " h " + Totalm + " mn";


	var oDebDLA = document.getElementById("oDebDLA");
	oDebDLA.innerHTML = dla;
}

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
</script>

<div align="center"><left> 
  <FORM name=MyForme>

<table class='mh_tdborder' width='60%' align='center'>
  <tr>
    <td>
	  <table width='100%' cellspacing='0'>
	    <tr class='mh_tdtitre' align="center">
		  <td>
			<img src='../images/titre_calculs.gif'>
		  </td>
		</tr>
	  </table>
    </tr>
  </td>
</table><br>


       <table class='mh_tdborder' width='60%' >
        <tr><td>
          <table width='100%' cellspacing='0'>
            <tr class='mh_tdtitre' align="center">
              <td>
                <h2>PXoTron</h2>
              </td>
            </tr>
          </table>
        </td></tr>
        <tr class='mh_tdpage'><td width='50%'>

    <table width="750" border="0" cellpadding="3" cellspacing="3">
      <tr align="center"> 
        <td width="150" align="center"> 
        <div align="center">Niveau Attaquant</td>
        <td width="150" align="center">Niveau 
        Victime</td>
        <td width="200" align="center">Type 
        d'Attaque</td>
        <td width="100" align="center">Click !</td>
        <td width="150" align="center">PX 
        Gagnés</td>
      </tr>
      <tr align="center"> 
        <td> 
          <input name="troll" type="text" size="5">
          </input>
        </td>
        <td>
          <input name="monstre" type="text" size="5">
          </input>
        </td>
        <td align=left>
          <INPUT type="radio" CHECKED value="1" name="moyen">
          Attaque Normale
          </INPUT>
          <BR>
          <INPUT type="radio" value="2" name="moyen">
          Compétence ou Sortilège
          </INPUT>
        </font></td>
        <td>
          <INPUT onclick="javascript:processPX()"; type="button" value="===>>>">
          </INPUT> 
        </font></td>
        <td id="oPx">&nbsp;</td>
      </tr>
    </table>
		</td></tr>
		</table>

		<br>
       <table class='mh_tdborder' width='60%' >
        <tr><td>
          <table width='100%' cellspacing='0'>
            <tr class='mh_tdtitre' align="center">
              <td>
                <h2>NivoTron</h2>
              </td>
            </tr>
          </table>
        </td></tr>
        <tr class='mh_tdpage'><td width='50%'>

    <table width="750" border="0" cellpadding="3" cellspacing="3">
      <tr align="center"> 
        <td width="150" align="center">Niveau 
        Attaquant</td>
        <td width="150" align="center">PX 
        Gagnés</td>
        <td width="200" align="center">Type 
        d'Attaque</td>
        <td width="100" align="center">Click !</td>
        <td width="150" align="center">Niveau 
        Victime</td>
      </tr>
      <tr align="center"> 
        <td><strong> 
          <input name="troll2" type="text" size="5"></input>
          </strong></td>
        <td> 
          <input name="px2" type="text" size="5"></input>
          </td>
        <td align=left><strong> 
          <INPUT type="radio" CHECKED value="1" name="moyen2">
          Attaque Normale
          </INPUT>
          <BR>
          <INPUT type="radio" value="2" name="moyen2">
          Compétence ou Sortilège
          </INPUT>
          </td>
        <td>
          <INPUT onclick="javascript:processNiv()"; type="button" value="===>>>"></INPUT> 
          </td>
        <td id="oNiv"></td>
      </tr>
    </table>
		</td></tr>
		</table>
			<br>

	       <table class='mh_tdborder' width='60%' >
        <tr><td>
          <table width='100%' cellspacing='0'>
            <tr class='mh_tdtitre' align="center">
              <td>
                <h2>RMoTron</h2>
              </td>
            </tr>
          </table>
        </td></tr>
        <tr class='mh_tdpage'><td width='50%'>	

    <table width="600" border="0" cellpadding="3" cellspacing="3">
      <tr align="center"> 
        <td width="150">MM Attaquant</td>
        <td width="250">Seuil de Résistance (en %)</td>
        <td width="100">Click !</td>
        <td width="100">RM Victime</td>
      </tr>
      <tr align="center"> 
        <td>
          <input name="mm" type="text" size="5"></input>
          </td>
        <td>
          <input name="sr" type="text" size="5"></input>
          </td>
        <td>
          <input type="button" value="==>>"onclick="javascript:processRM();"></input> 
          </td>
        <td id="oRM"></td>
      </tr>
    </table>
		</td></tr>
		</table>
		<br>

	       <table class='mh_tdborder' width='60%' >
        <tr><td>
          <table width='100%' cellspacing='0'>
            <tr class='mh_tdtitre' align="center">
              <td>
                <h2>MMoTron</h2>
              </td>
            </tr>
          </table>
        </td></tr>
        <tr class='mh_tdpage'><td width='50%'>	

    <table width="600" border="0" cellpadding="3" cellspacing="3">
      <tr align="center"> 
        <td width="100">RM Victime</td>
        <td width="250">Seuil de Résistance (en %)</td>
        <td width="100">Click !</td>
        <td width="150">MM Attaquant</td>
      </tr>
      <tr align="center"> 
        <td>
          <input type="text" name="rm" size="5"></input>
          </td>
        <td>
          <input name="sr2" type="text" size="5"></input>
          </td>
        <td>
          <input type="button" value="==>>"onclick="javascript:processMM();"></input> 
          </td>
        <td id="oMM"></td>
      </tr>
    </table>
		</td></tr>
		</table>
		<br>

	       <table class='mh_tdborder' width='60%' >
        <tr><td>
          <table width='100%' cellspacing='0'>
            <tr class='mh_tdtitre' align="center">
              <td>
                <h2>SRoTron</h2>
              </td>
            </tr>
          </table>
        </td></tr>
        <tr class='mh_tdpage'><td width='50%'>	

    <table width="750" border="0" cellpadding="3" cellspacing="3">
      <tr align="center"> 
        <td width="150">MM Attaquant</td>
        <td width="100">RM Victime</td>
        <td width="100">Click !</td>
        <td width="200">Seuil de Résistance(en %)</td>
        <td width="250">Augmentation de MM possible<br>
  (si non résistance de la cible)</td>
      </tr>
      <tr align="center"> 
        <td>
          <input type="text" name="mm2" size="5"></input>
          </td>
        <td>
          <input type="text" name="rm2" size="5"></input>
          </td>
        <td>
          <input type="button" value="==>>"onclick="javascript:processSR();"></input> 
          </td>
        <td id="oSR"></td>
        <td id="oMMposs"></td>
      </tr>
    </table>
		</td></tr>
		</table>
		<br>
	       <table class='mh_tdborder' width='60%' >
        <tr><td>
          <table width='100%' cellspacing='0'>
            <tr class='mh_tdtitre' align="center">
              <td>
                <h2>PIoTron</h2>
              </td>
            </tr>
          </table>
        </td></tr>
        <tr class='mh_tdpage'><td width='50%'>	
    <table width="750" border="0" cellpadding="3" cellspacing="3">
      <tr align="center"> 
        <td align="center" width="150">Niveau à Atteindre</td>
        <td align="center" width="150">PI 
        actuels</td>
        <td width="100">Click !</td>
        <td align="center" width="200">PI 
        pour ce niveau</td>
        <td align="center" width="150">PI 
        manquants</td>
      </tr>
      <tr align="center"> 
        <td><strong> 
          <input type="text" name="niv" size="5"></input>
          </strong></td>
        <td><strong> 
          <input type="text" name="pi" size="5"></input>
          </strong></td>
        <td><strong> 
          <input type="button" value="==>>"onclick="javascript:processPI();"></input> 
          </strong></td>
        <td id="oPi"></td>
        <td id="oPii"></td>
      </tr>
    </table>
		</td></tr>
		</table>
		<br>
	       <table class='mh_tdborder' width='60%' >
        <tr><td>
          <table width='100%' cellspacing='0'>
            <tr class='mh_tdtitre' align="center">
              <td>
                <h2>BlessuroTron</h2>
              </td>
            </tr>
          </table>
        </td></tr>
        <tr class='mh_tdpage'><td width='50%'>	
    <table width="750" border="0" cellpadding="3" cellspacing="3">
      <tr align="center"> 
        <td align="center" width="150">PV 
        totaux</td>
        <td align="center" width="150">PV restants</td>
        <td width="100">Click !</td>
        <td align="center" width="200">Pourcentage 
        de blessure</td>
        <td align="center" width="150">Malus 
        de temps</td>
      </tr>
      <tr align="center"> 
        <td>
          <input type="text" name="pv" size="5">
          </td>
        <td>
          <input type="text" name="deg" size="5">
          </td>
        <td>
          <input name="button" type="button"onclick="javascript:processBlessure();" value="==>>">
          </td>
        <td id="oBless"></td>
        <td id="oMalbless"></td>
      </tr>
    </table>
		</td></tr>
		</table>
		<br>
	       <table class='mh_tdborder' width='60%' >
        <tr><td>
          <table width='100%' cellspacing='0'>
            <tr class='mh_tdtitre' align="center">
              <td>
                <h2>DLAoTron</h2>
              </td>
            </tr>
          </table>
        </td></tr>
        <tr class='mh_tdpage'><td width='50%'>
    <table width="750" border="0" cellpadding="3" cellspacing="3">
      <tr align="center"> 
        <td width="100" align="center">Début DLA</td>
        <td width="100" align="center">Durée DLA</td>
        <td width="100" align="center">Bonus/Malus Temps</td>
        <td width="100" align="center">Malus Blessure</td>
        <td width="100" align="center">Malus Equipement</td>
        <td width="100">Click !</td>
        <td width="150" align="center">Début DLA suivante</td>
      </tr>
      <tr align="center"> 
        <td nowrap><strong> 
          <input type="text" name="DebDLAh" size="2">
          h
          <input type="text" name="DebDLAm" size="2">
          mn
          </strong></td>
        <td nowrap><strong> 
          <input type="text" name="DurDLAh" size="2">
          h
          <input type="text" name="DurDLAm" size="2">
          mn
          </strong></td>
        <td nowrap> 
          <table><tr><td nowrap>
            <INPUT type="radio" CHECKED value="1" name="bonmal">
            <strong>-</strong>
            </INPUT>
            <BR>
            <INPUT type="radio" value="2" name="bonmal">
            <strong>+</strong>
            </INPUT>
          </td><td nowrap>
            <input type="text" name="BonMalm" size="2">
            <strong>mn</strong></td></tr></table></td>
        <td nowrap><strong> 
          <input type="text" name="MalBleh" size="2">
          h
          <input type="text" name="MalBlem" size="2">
          mn
          </strong></td>
        <td nowrap><strong> 
          <input type="text" name="MalEquh" size="2">
          h
          <input type="text" name="MalEqum" size="2">
          mn
          </strong></td>
        <td nowrap><strong> 
          <input name="button" type="button"onclick="javascript:processDLA();" value="==>>">
          </strong></td>
        <td nowrap id="oDebDLA">&nbsp;</td>
      </tr>
	  <tr align='center'><table><tr><td>( Si une case reste vide, sa valeur sera égale à zéro )</td></tr></table></tr>
    </table>
  </FORM>
</div>
  </td>
  </tr>
</table>
<?
}
?>
