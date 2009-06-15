/*********************************************************************************
*    This file is part of Mountyzilla.                                           *
*                                                                                *
*    Mountyzilla is free software; you can redistribute it and/or modify         *
*    it under the terms of the GNU General Public License as published by        *
*    the Free Software Foundation; either version 2 of the License, or           *
*    (at your option) any later version.                                         *
*                                                                                *
*    Foobar is distributed in the hope that it will be useful,                   *
*    but WITHOUT ANY WARRANTY; without even the implied warranty of              *
*    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the               *
*    GNU General Public License for more details.                                *
*                                                                                *
*    You should have received a copy of the GNU General Public License           *
*    along with Mountyzilla; if not, write to the Free Software                  *
*    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA  *
*********************************************************************************/

const scriptsMZ = "http://mountyzilla.tilk.info/scripts_0.8/";
//const scriptsMZ = "http://m2m-bugreport.dyndns.org/scripts/";
//const scriptsMZ = "http://leiber.free.fr/mz/";

chargerScript("libs");

// Détection de la page à traiter
if (isPage("Messagerie/ViewMessageBot.php"))
	chargerScript("cdmbot");
else if (isPage("MH_Play/Actions/Competences/Play_a_Competence16b.php"))
	chargerScript("cdmcomp");
else if (isPage("MH_Guildes/Guilde_o_AmiEnnemi.php"))
	chargerScript("diplo");
else if (isPage("MH_Play/Play_equipement.php"))
	chargerScript("equip");
else if (isPage("MH_Play/Actions/Competences/Play_a_Competence10.php"))
	chargerScript("idt");
else if (isPage("MH_Play/Play_menu.php"))
	chargerScript("menu");
else if (isPage("MH_Play/Options/Play_o_Interface.php") || isPage("installPack.php"))
	chargerScript("option");
else if (isPage("View/PJView.php"))
	chargerScript("pjview");
else if (isPage("MH_Play/Play_profil.php"))
	chargerScript("profil");
else if (isPage("MH_Play/Play_profil_rev.php"))
	chargerScript("profilBMM");
else if (isPage("MH_Play/Play_e_ChampComp.php"))
	chargerScript("saccompo");
else if (isPage("MH_Taniere/TanierePJ_o_Stock.php") || isPage("MH_Comptoirs/Comptoir_o_Stock.php"))
	chargerScript("tancompo");
else if (isPage("MH_Play/Play_vue.php"))
	chargerScript("vue");
else if (isPage("MH_Play/Play_news.php"))
	chargerScript("http://echoduhall.free.fr/Echo/tilk.php3");

if (isPage("MH_Play/Actions") || isPage("Messagerie/ViewMessageBot.php"))
	chargerScript("actions");

function isPage(url) {
	return currentURL.indexOf(MHURL + url) == 0;
}

function chargerScript(script) {
	// (mauvaise) Détection du chargement de la page
	if (document.getElementsByTagName('A').length > 0)
		appendNewScript(script.indexOf("http://") != -1 ? script : scriptsMZ + script + "_FF.js");
}

function appendNewScript(src, paren) {
	var newScript = document.createElement('script');
	newScript.setAttribute('language', 'JavaScript');
	newScript.setAttribute('src', src);
	if (!paren)
		paren = document.body;
	paren.appendChild(newScript);
	return newScript;
}
