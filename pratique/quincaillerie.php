<?
include_once('../top.php');
initQuincaillerie();
include_once('../foot.php');

function initQuincaillerie()
{
?>
</head>

<body>
<table width="100%"  border="0" cellspacing="3" cellpadding="3">
  <tr>
    <td valign="top">      <CENTER>
    <script language="Javascript">
    
function write(descript, poid, temp, price)
{
	var oDescript = document.getElementById("oDescript");
	oDescript.innerHTML = descript;
	var oPoid = document.getElementById("oPoid");
	oPoid.innerHTML = poid;
	var oTemp = document.getElementById("oTemp");
	oTemp.innerHTML = temp;
	var oPrice = document.getElementById("oPrice");
	oPrice.innerHTML = price;
}    
    
    
    function fillBox()
{
	var box = document.getElementById("oBox");
	
	box.innerHTML =	
   		"<select id=\"oEquip\" onChange=\"fillBox2()\" class=\"mh_selectbox\">"+
     			"<option value=\"Armes\" selected=''>Armes</option>"+
	   			"<option value=\"Armures\">Armures</option>"+
    			"<option value=\"Bottes\">Bottes</option>"+
    			"<option value=\"Boucliers\">Boucliers</option>"+
    			"<option value=\"Casques\">Casques</option>"+
    			"<option value=\"Divers\">Divers</option>"+
    			"<option value=\"Talismans\">Talismans</option>"+
   		"</select>";
   		
	fillBox2();
}

function fillBox2()
{
	var box = document.getElementById("oBoxM");
	var select = document.getElementById("oEquip");
	var race = select.options[select.selectedIndex].value;
	var text = "<select id=\"oNomm\" onChange=\"fillRow()\" class=\"mh_selectbox\">";

	switch(race)
	{
	   	case "Armes" :
		{
	   		text = text + "<option value=\"BatonParade\" selected=''>Bâtons de Parade</option>";
	   		text = text + "<option value=\"Baton\">Bâton Lesté (2 mains)</option>";
	   		text = text + "<option value=\"Boulet\">Boulet et Chaîne</option>";
	   		text = text + "<option value=\"ChaineCloute\">Chaîne Cloutée</option>";
	   		text = text + "<option value=\"Crochet\">Crochet</option>";
	   		text = text + "<option value=\"Dague\">Dague</option>";
	   		text = text + "<option value=\"EpeeCourte\">Epée Courte</option>";
	   		text = text + "<option value=\"EpeeLongue\">Epée Longue</option>";
	   		text = text + "<option value=\"Espadon\">Espadon (2 mains)</option>";
	   		text = text + "<option value=\"Fouet\">Fouet</option>";
	   		text = text + "<option value=\"GanteletAncien\">Gantelet Ancien</option>";
	   		text = text + "<option value=\"GanteletNouveau\">Gantelet Nouveau</option>";
	   		text = text + "<option value=\"Gourdin\">Gourdin</option>";
	   		text = text + "<option value=\"GourdinCloute\">Gourdin Clouté</option>";
	   		text = text + "<option value=\"GrosseRacine\">Grosse Racine</option>";
	   		text = text + "<option value=\"GrosseStalagmite\">Grosse Stalagmite</option>";
	   		text = text + "<option value=\"Hache\">Hache de Bataille (2 mains)</option>";
	   		text = text + "<option value=\"HacheOs\">Hache de Guerre en Os (2 mains)</option>";
	   		text = text + "<option value=\"HachePierre\">Hache de Guerre en Pierre (2 mains)</option>";
	   		text = text + "<option value=\"HacheObsidienne\">Hache d'Obsidienne (2 mains)</option>";
	   		text = text + "<option value=\"Hallebarde\">Hallebarde (2 mains)</option>";
	   		text = text + "<option value=\"LameObsidienne\">Lame d'Obsidienne</option>";
	   		text = text + "<option value=\"LameOs\">Lame en Os</option>";
	   		text = text + "<option value=\"LamePierre\">Lame de Pierre</option>";
	   		text = text + "<option value=\"Machette\">Machette</option>";
	   		text = text + "<option value=\"Masse\">Masse d'Arme</option>";
	   		text = text + "<option value=\"Torche\">Torche</option>";
		}
		break;
	   	case "Armures" :
		{
	   		text = text + "<option value=\"ArmureBois\">Armure de Bois</option>";
	   		text = text + "<option value=\"ArmureCuir\">Armure de Cuir</option>";
	   		text = text + "<option value=\"ArmureAnneaux\">Armure d'Anneaux</option>";
	   		text = text + "<option value=\"ArmurePeaux\">Armure de Peaux</option>";
	   		text = text + "<option value=\"ArmurePierre\">Armure de Pierre</option>";
   			text = text + "<option value=\"ArmurePlates\">Armure de Plates</option>";
   			text = text + "<option value=\"Culotte\">Culotte en Cuir</option>";
   			text = text + "<option value=\"CuirasseEcailles\">Cuirasse d'Ecailles</option>";
   			text = text + "<option value=\"CotteMailles\">Cotte de Mailles</option>";
   			text = text + "<option value=\"Fourrures\">Fourrures</option>";
   			text = text + "<option value=\"HaubertEcailles\">Haubert d'Ecailles</option>";
   			text = text + "<option value=\"HaubertMailles\">Haubert de Mailles</option>";
   			text = text + "<option value=\"PagneCuir\">Pagne en Cuir</option>";
   			text = text + "<option value=\"PagneMaille\">Pagne de Mailles</option>";
   			text = text + "<option value=\"Tunique\">Tunique</option>";
   			text = text + "<option value=\"TuniqueEcailles\">Tunique d'Ecailles</option>";
		}
		break;
   		case "Bottes" :
   			text = text + "<option value=\"Bottes\">Bottes</option>";
   			text = text + "<option value=\"JambieresCuir\">Jambières en Cuir</option>";
   			text = text + "<option value=\"JambieresFourrure\">Jambières en Fourrure</option>";
   			text = text + "<option value=\"JambieresMailles\">Jambières en Mailles</option>";
   			text = text + "<option value=\"JambieresMetal\">Jambières en Métal</option>";
   			text = text + "<option value=\"JambieresOs\">Jambières en Os</option>";
   			text = text + "<option value=\"Sandales\">Sandales</option>";
   		break;
	   	case "Boucliers" :
	   		text = text + "<option value=\"BouclierPointe\">Bouclier à Pointes</option>";
   			text = text + "<option value=\"GrosPorte\">Gros'Porte</option>";
   			text = text + "<option value=\"RondacheBois\">Rondache en Bois</option>";
   			text = text + "<option value=\"RondacheMetal\">Rondache en Métal</option>";
   			text = text + "<option value=\"Targe\">Targe</option>";
	   	break;
	   	case "Casques" :
	   		text = text + "<option value=\"Cagoule\">Cagoule</option>";
   			text = text + "<option value=\"CasqueCornesAncien\">Casque à Cornes Ancien</option>";
   			text = text + "<option value=\"CasqueCornesNouveau\">Casque à Cornes Nouveau</option>";
   			text = text + "<option value=\"CasqueCuir\">Casque en Cuir</option>";
   			text = text + "<option value=\"CasqueMetal\">Casque en Métal</option>";
   			text = text + "<option value=\"Heaume\">Heaume</option>";
   			text = text + "<option value=\"Lorgnons\">Lorgnons</option>";
   			text = text + "<option value=\"Turban\">Turban</option>";
  		break;
	   	case "Divers" :
   			text = text + "<option value=\"PoissonAvril\">Poisson d'Avril</option>";
  		break;
	   	case "Talismans" :
   			text = text + "<option value=\"CollierDents\">Collier de Dents</option>";
   			text = text + "<option value=\"CollierPierre\">Collier de Pierre</option>";
	   		text = text + "<option value=\"GorgeronCuir\">Gorgeron en Cuir</option>";
	   		text = text + "<option value=\"GorgeronMetal\">Gorgeron en Métal</option>";
   			text = text + "<option value=\"TalismanPierre\">Talisman de Pierre</option>";
   			text = text + "<option value=\"TorquePierre\">Torque en Pierre</option>";
  		break;
	}
   	
	text = text + "</select>";

	box.innerHTML = text;

	fillRow();
}


function fillRow()
{
	var select = document.getElementById("oEquip");
	var name = select.options[select.selectedIndex].value;

	var select2 = document.getElementById("oNomm");
	var version = select2.options[select2.selectedIndex].value;

	switch(name)
	{
		case "Armes" :
			switch(version)
			{
				case "Baton" :
					write("<b>Attaque : +1 | Dégâts : -1</b>", "Léger", "7'30", "70");
				break;
				case "Boulet" :
					write("<b>Attaque : -3 | Dégâts : +5</b>", "Léger", "15", "<b>?</b>");
				break;
				case "Dague" :
					write("<b>Dégâts : +1</b>", "Très Léger", "5", "200");
				break;
				case "EpeeCourte" :
					write("<b>Dégâts : +2</b>", "Léger", "10", "300");
				break;
				case "EpeeLongue" :
					write("<b>Attaque : -2 | Dégâts : +4</b>", "Moyen", "20", "<b>?</b>");
				break;
				case "Espadon" :
					write("<b>Attaque : -6 | Dégâts : +8</b>", "Lourd", "40", "1300");
				break;
				case "Fouet" :
					write("<b>Attaque : +4 | Dégâts : -2</b>", "Léger", "15", "300");
				break;
				case "GanteletAncien" :
					write("<b>Attaque : -1 | Dégâts : +2 | Esquive : +1 | Régénération : +2</b>", "Très Léger", "7,5", "<b>?</b>");
				break;
				case "GanteletNouveau" :
					write( "<b>Armure : +2 | Attaque : -2 | Dégâts : +1 | Esquive : +1</b>", "Très Léger", "7,5", "<b>?</b>");
				break;
				case "Gourdin" :
					write( "<b>Attaque : -1 | Dégâts : +2</b>", "Léger", "12,5", "<b>?</b>");
				break;
				case "GourdinCloute" :
					write( "<b>Attaque : -1 | Dégâts : +3</b>", "Léger", "15", "<b>?</b>");
				break;
				case "GrosseRacine" :
					write( "<b>Attaque : -1 | Dégâts : +3</b>", "Moyen", "20", "<b>?</b>");
				break;
				case "Hache" :
					write( "<b>Attaque : -4 | Dégâts : +6</b>", "Moyen", "40", "<b>?</b>");
				break;
				case "HacheOs" :
					write( "<b>Attaque : -4 | Dégâts : +6</b>", "Moyen", "25", "<b>?</b>");
				break;
				case "HachePierre" :
					write( "<b>Attaque : -10 | Dégâts : +14</b>", "Très Lourd", "75", "<b>?</b>");
				break;
				case "Hallebarde" :
					write( "<b>Attaque : -10 | Dégâts : +12</b>", "Lourd", "60", "<b>?</b>");
				break;
				case "LameOs" :
					write( "<b>Dégâts : +2</b>", "Très Léger", "7,5", "<b>?</b>");
				break;
				case "LamePierre" :
					write( "<b>Attaque : -2 | Dégâts : +4</b>", "Moyen", "20", "<b>?</b>");
				break;
				case "Machette" :
					write( "<b>Attaque : +1 | Esquive : -1 | Dégâts : +2</b>", "Moyen", "20", "<b>?</b>");
				break;
				case "Masse" :
					write( "<b>Attaque : -1 | Dégâts : +3</b>", "Léger", "15", "300");
				break;
				case "Torche" :
					write( "<b>Attaque : +1 | Dégâts : +1 | Vue : +1</b>", "Très Léger", "5", "<b>?</b>");
				break;
				case "BatonParade" :
					write( "<b>ATT : -4 | ESQ : +2 | Armure : +2</b>", "Léger", "7", "<b>?</b>");
				break;
				case "ChaineCloute" :
					write( "<b>ATT : -2 | ESQ : +1 | DEG : +4</b>", "?", "35", "<b>?</b>");
				break;
				case "Crochet" :
					write( "<b>Attaque: -2 | Dégâts: +3</b>", "?", "12,5", "<b>?</b>");
				break;
				case "GrosseStalagmite" :
					write( "<b>Attaque: -20 | Esquive: -15 | Dégâts: +28 | Vue: -4</b>", "Très Lourd", "125", "<b>?</b>");
				break;
				case "HacheObsidienne" :
					write( "<b>Attaque: -8 | Dégâts: +16 | Régénération: -4 | -[54%;90%]RM | -[16%;21%]MM</b>", "Très Lourd", "75", "<b>?</b>");
				break;
				case "LameObsidienne" :
					write( "<b>Attaque: +2 | Dégâts: +6 | Régénération: -3 | -[33%;60%]RM | -[11%;20%]MM</b>", "Moyen", "20", "<b>?</b>");
				break;
			}
		break;
		case "Armures" :
			switch(version)
			{
				case "ArmureBois" :
					write( "<b>Armure : +5 | RM : +25-50 | Esquive : -3</b>", "Lourd", "50", "<b>?</b>");
				break;
				case "ArmureCuir" :
					write( "<b>Armure : +2 | RM : +10-20</b>", "Léger ou Moyen", "10 ou 20", "450");
				break;
				case "ArmurePeaux" :
					write( "<b>Armure : +4 | RM : +20-40 | Esquive : -2</b>", "Lourd", "40", "1000");
				break;
				case "ArmurePierre" :
					write( "<b>Armure : +12 | RM : +60-120 | Esquive : -6 ou -10</b>", "Très Lourd", "120", "<b>?</b>");
				break;
				case "ArmurePlates" :
					write( "<b>Armure : +10 | RM : +50-100 | Esquive : -5 ou -8</b>", "Très Lourd", "100", "<b>?</b>");
				break;
				case "CuirasseEcailles" :
					write( "<b>Armure : +6 | RM : +30-70 | Esquive : -3</b>", "Lourd", "60", "<b>?</b>");
				break;
				case "CotteMailles" :
					write( "<b>Armure : +7 | RM : +30-70 | Esquive : -3 ou -4</b>", "Très Lourd", "70", "<b>?</b>");
				break;
				case "Fourrures" :
					write( "<b>Armure : +2 | RM : +10-30</b>", "Léger", "10-15", "<b>?</b>");
				break;
				case "HaubertEcailles" :
					write( "<b>Armure : +8 | RM : +40-80 | Esquive : -4 ou -6</b>", "Très Lourd", "80", "<b>?</b>");
				break;
				case "HaubertMailles" :
					write( "<b>Armure : +9 | RM : +40-90 | Esquive : -4 ou -6</b>", "Très Lourd", "90", "<b>?</b>");
				break;
				case "Tunique" :
					write( "<b>Esquive : +1 | MM : +5-10 | RM : +5-10</b>", "Très Léger", "3", "<b>?</b>");
				break;
				case "TuniqueEcailles" :
					write( "<b>Armure : +3 | RM : +15-30 | Esquive : 0 ou -1</b>", "Moyen", "30", "400");
				break;
				case "Culotte" :
					write( "<b>Esquive +1</b>", "Très Léger", "3", "?");
				break;
				case "PagneCuir" :
					write( "<b>Esquive : +2 | Armure : -1</b>", "Très Léger", "5", "?");
				break;			
				case "PagneMaille" :
					write( "<b>Esquive : +2 | Armure : +1</b>", "Très Léger", "8", "?");
				break;			
				case "ArmureAnneaux" :
					write( "<b>Esquive : -8 | Armure : +8 | RM : +100-?</b>", "?", "80", "?");
				break;							
			}
		break;
		case "Bottes" :
			switch(version)
			{
				case "Bottes" :
					write( "<b>Esquive : +2</b>", "Très Léger", "5", "<b>?</b>");
				break;
				case "JambieresCuir" :
					write( "<b>Armure : +1 | RM : +5-10</b>", "Léger", "10", "<b>?</b>");
				break;
				case "JambieresFourrure" :
					write( "<b>Armure : +1 | RM : +5-10</b>", "Très Léger", "3", "<b>?</b>");
				break;
				case "JambieresMailles" :
					write( "<b>Armure : +3 | RM : +5-10 | Esquive : -1</b>", "Moyen", "20", "<b>?</b>");
				break;
				case "JambieresMetal" :
					write( "<b>Armure : +4 | RM : +5-10 | Esquive : -2</b>", "Moyen", "25", "<b>?</b>");
				break;
				case "JambieresOs" :
					write( "<b>Armure : +2 | RM : +5-10 | Esquive : -1</b>", "Léger", "10", "<b>?</b>");
				break;
				case "Sandales" :
					write( "<b>Esquive : +1</b>", "Très Léger", "3", "<b>?</b>");
				break;
			}
		break;
		case "Boucliers" :
			switch(version)
			{
				case "GrosPorte" :
					write( "<b>Armure : +5 | Esquive : -1 | RM : +10-20</b>", "Lourd", "50", "<b>?</b>");
				break;
				case "RondacheBois" :
					write( "<b>Armure : +1 | Esquive : +1</b>", "Léger", "15", "<b>?</b>");
				break;
				case "RondacheMetal" :
					write( "<b>Armure : +2 | Esquive : +1</b>", "Moyen", "30", "<b>?</b>");
				break;
				case "Targe" :
					write( "<b>Esquive : +1</b>", "Très Léger", "5", "<b>?</b>");
				break;
				case "BouclierPointe" :
					write( "<b>Attaque : +1 | Esquive : -1 | Dégats : +1 | Armure : +4</b>", "Moyen", "35", "<b>?</b>");
				break;				
			}
		break;
		case "Casques" :
			switch(version)
			{
				case "CasqueCornesAncien" :
					write( "<b>Régénération : +3 | Esquive : -1 | Dégâts : +1 | Vue : -1 | RM : +5-15</b>", "Léger", "10", "<b>?</b>");
				break;
				case "CasqueCornesNouveau" :
					write( "<b>Armure : +3 | Esquive : -1 | Dégâts : +1 | Vue : -1 | RM : +5-10</b>", "Léger", "10", "<b>?</b>");
				break;
				case "CasqueCuir" :
					write( "<b>Armure : +1 | RM : +5-10</b>", "Très Léger", "5", "<b>?</b>");
				break;
				case "CasqueMetal" :
					write( "<b>Armure : +2 | Vue : -1 | RM : +5-10</b>", "Léger", "10", "<b>?</b>");
				break;
				case "Heaume" :
					write( "<b>Armure : +4 | Attaque : -1 | Vue : -2 | RM : +10-20</b>", "Moyen", "20", "<b>?</b>");
				break;
				case "Lorgnons" :
					write( "<b>Esquive : -1 | Vue : +1 | MM : +5-10</b>", "Très Léger", "<b>3</b>", "<b>?</b>");
				break;
				case "Turban" :
					write( "<b>RM : +10-20</b>", "Très Léger", "3", "<b>?</b>");
				break;
				case "Cagoule" :
					write( "<b>Esquive +1 | Vue-1 | MM : +6-10</b>", "Très Léger", "3", "<b>?</b>");
				break;
				
				
			}
		break;
		case "Divers" :
			switch(version)
			{
				case "PoissonAvril" :
					write( "<b>A coller dans le dos en Avril</b>", "Très Léger", "0", "<b>?</b>");
				break;
			}
		break;
		case "Talismans" :
			switch(version)
			{
				case "CollierDents" :
					write( "<b>Dégâts : +1 | DLA : +5mn</b>", "Très Léger", "1", "<b>?</b>");
				break;
				case "CollierPierre" :
					write( "<b>MM : +5-10 | RM : +5-10</b>", "Très Léger", "3", "<b>?</b>");
				break;
				case "GorgeronCuir" :
					write( "<b>Armure : +1</b>", "Très Léger", "3", "<b>?</b>");
				break;
				case "GorgeronMetal" :
					write( "<b>Armure : +2 | Régénération : -1</b>", "Très Léger", "5", "<b>?</b>");
				break;
				case "TalismanPierre" :
					write( "<b>Régénération : -1 | MM : +10-20 | RM : +10-20</b>", "Très Léger", "3", "<b>?</b>");
				break;
				case "TorquePierre" :
					write( "<b>Régénération : -2 | MM : +20-40 | RM : +20-40</b>", "Très Léger", "3", "<b>?</b>");
				break;
			}
		break;
	}
}
    
    
    </script>
    
        <table class='mh_tdborder' width='60%' >
				<tr><td>
					<table width='100%' cellspacing='0'>
						<tr class='mh_tdtitre' align="center">
							<td>
		          			  <img src='../images/titre_quincaillerie.gif ' width='168' height='57'>
							</td>
						</tr>
					</table>
				</td></tr>
				<tr class='mh_tdpage'><td width='50%'>
<table width='100%'>
	<tr>
	  <td align="right" id="oBox1" width='30%'>Equipement : </td>
	  <td align="left" id="oBox" width='70%'></td>
    </tr>
	<tr>
	  <td align="right" id="oBox1" width='30%'>Nom : </td>
      <td align="left" id="oBoxM" width='70%'></td>
    </tr>
    <tr> 
      <td align="right" id="oBox1" width='30%'>Description : </td>
      <td align="left" id="oDescript" width='70%'></td>
    </tr>
    <tr> 
      <td align="right" id="oBox1" width='30%'>Poids : </td>
      <td align="left" id="oPoid" width='70%'></td>
    </tr>
    <tr> 
      <td align="right" id="oBox1" width='30%'>Malus de Temps (minutes) : </td>
      <td align="left" id="oTemp" width='70%'></td>
    </tr>
    <tr> 
      <td align="right" id="oBox1" width='30%'>Prix de Négociation (GG') : </td>
      <td align="left" id="oPrice" width='70%'></td>
    </tr>
</table>
			</table>
			<br>

       <table class='mh_tdborder' width='60%'>
				<tr><td width='50%'>
					<table width='100%' cellspacing='0'>
						<tr class='mh_tdtitre' align="center">
							<td>
		          			  <img src='../images/titre_templates.gif' width='160' height='49'>
							</td>
						</tr>
					</table>
				</td></tr>
				
				<tr class='mh_tdpage'>
				<td width='50%'>
<!-- Table des templates -->
<table align="center" border="1" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
  <tr> 
    <td width="40" align="center"><b>Template</b></td>
    <td width="25" align="center"><b>REG</b></td>
    <td width="25" align="center"><b>VUE</b></td>
    <td width="25" align="center"><b>ATT</b></td>
    <td width="25" align="center"><b>ESQ</b></td>
    <td width="25" align="center"><b>DEG</b></td>
    <td width="25" align="center"><b>ARM</b></td>
    <td width="30" align="center"><b>DLA</b></td>
    <td width="40" align="center"><b>Autre</b></td>
  </tr>
  <tr> 
    <td align="center">de la Salamandre</td>
    <td align="center">+1</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr> 
    <td align="center">des Cyclopes</td>
    <td align="center">&nbsp;</td>
    <td align="center">-1</td>
    <td align="center">+1</td>
    <td align="center">&nbsp;</td>
    <td align="center">+1</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr> 
    <td align="center">du Vent</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">+1</td>
    <td align="center">-1</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr> 
    <td align="center">des Tortues</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">+2</td>
    <td align="center">+30 min</td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr> 
    <td align="center">du Temps</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">-30 min</td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr> 
    <td align="center">de l'Aigle</td>
    <td align="center">&nbsp;</td>
    <td align="center">+1</td>
    <td align="center">+1</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr> 
    <td align="center">des Enrag&eacute;s</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">+1</td>
    <td align="center">-1</td>
    <td align="center">+1</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr> 
    <td align="center">du Roc</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">-1</td>
    <td align="center">&nbsp;</td>
    <td align="center">+1</td>
    <td align="center">&nbsp;</td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr> 
    <td align="center">de R&eacute;sistance</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">+1</td>
    <td align="center">&nbsp;</td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr> 
    <td align="center">du Rat</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">+1</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr> 
    <td align="center">de Feu</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">+1</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr> 
    <td align="center">des Vampires</td>
    <td align="center">+1</td>
    <td align="center">&nbsp;</td>
    <td align="center">+1</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr> 
    <td align="center">en Mithril</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="left">Poids de l'objet divis&eacute; par 2 et malus d'attaque divis&eacute; par 2.</td>
  </tr>  
  <tr> 
    <td align="center"><em>du Glacier</em></td>
    <td align="center"><em>+1</em></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center"><em>+1</em></td>
    <td align="center">&nbsp;</td>
    <td align="left"><em>RM +5 %.<br>Ne peut &ecirc;tre trouvé sur un monstre.</em></td>
  </tr>
  <tr> 
    <td align="center"><em>Du Sombre</em></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="left"><em>Ne peut &ecirc;tre trouvé sur un monstre.</em></td>
  </tr>
</table>

<!-- Fin Tables des templates -->
				</td>
				</tr>
				</table>
				<br>
				
			<table width="60%" cellspacing="1" border="0" cellpadding="1" class="mh_tdborder" align="center">
			  <tr class="mh_tdtitre">
			    <td align="center">
			      Dernière Mise à Jour effectuée le : 20/03/2004
		      </td>
			  </tr>
			</table>
			<br>

<script>fillBox();</script>
</div>
</CENTER>
</td>
</tr>
</table>

<?
}
?>
