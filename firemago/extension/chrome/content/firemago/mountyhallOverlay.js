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

const versionFM = "2.3";
const pageNews = "/mountyhall/MH_Play/Play_news.php";
const updateScript = "http://outilsrm.cat-the-psion.net/firemago/update.js";

var ShowUpdate;
var ScriptURL;
var MHURL;
var URLRM;

window.addEventListener("DOMContentLoaded", mzGo, true);

function mzGo() {
	try {
		var branch = Components.classes["@mozilla.org/preferences-service;1"].getService(Components.interfaces.nsIPrefService).getBranch("firemago.");
		if (branch.prefHasUserValue("enabled") && !branch.getBoolPref("enabled"))
			return;

		ShowUpdate = !branch.prefHasUserValue("showupdate") || branch.getBoolPref("showupdate"); // default:true
		ScriptURL = branch.prefHasUserValue("fileURL") ? branch.getCharPref("fileURL") : "chrome://firemago/content/RM_script.js";
		MHURL = branch.prefHasUserValue("URLMH") ? branch.getCharPref("URLMH") : "http://games.mountyhall.com";
		URLRM = branch.prefHasUserValue("URLRM") ? branch.getCharPref("URLRM") : "http://outilsrm.cat-the-psion.net/";
		
	} catch(e) {
		alert(e);
	}
	mzCheckAndParse(window);
}

function mzCheckAndParse(win) {	
	if (win.frames)
		for (var i = win.frames.length; --i >= 0;)
			mzCheckAndParse(win.frames[i]);

	var currentURL = encodeURI(win.location.toString());

	if (currentURL.indexOf(MHURL) == 0) {
		var doc = win.document;

		if (!doc.getElementById('scriptFM')) {
			appendNewScript(doc, "const URLMH='" + MHURL + "';");
			appendNewScript(doc, "const URLRM='" + URLRM + "';");
			appendNewScript(doc, "const currentURL='" + currentURL + "';");

			var scriptableStream = Components.classes["@mozilla.org/scriptableinputstream;1"]
					.getService(Components.interfaces.nsIScriptableInputStream);
			var ioService = Components.classes["@mozilla.org/network/io-service;1"]
					.getService(Components.interfaces.nsIIOService);
			var input = ioService.newChannel(ScriptURL, null, null).open();
			scriptableStream.init(input);

			var newScript = appendNewScript(doc, scriptableStream.read(-1));
			newScript.setAttribute('id', 'scriptFM');

			scriptableStream.close();
			input.close();
		} else if (ShowUpdate && currentURL.indexOf(MHURL + pageNews) == 0 && !doc.getElementById('scriptFM_Version')) {
			appendNewScript(doc, "const numVersionFiremago='" + versionFM + "';");

			var newScript = appendNewScript(doc);
			newScript.setAttribute('id', 'scriptFM_Version');
			newScript.setAttribute('src', updateScript);
		}
	}
	return true;
}

function appendNewScript(doc, txt) {
	var newScript = doc.createElement('script');
	newScript.setAttribute('language', 'JavaScript');
	if (txt)
		newScript.appendChild(doc.createTextNode(txt));
	doc.body.appendChild(newScript);
	return newScript;
}
