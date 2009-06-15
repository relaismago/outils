// Loads preferences into the UI.
var defaultURL = "chrome://firemago/content/RM_script.js";
var defaultMH = "http://games.mountyhall.com";
var defaultRM = "http://outilsrm.cat-the-psion.net/";

function loadPrefWindow() {

	try {
		var prefObj = Components.classes["@mozilla.org/preferences-service;1"].getService(Components.interfaces.nsIPrefService);
		var Branch = prefObj.getBranch("firemago.");
		var Enabled = !Branch.prefHasUserValue("enabled") || Branch.getBoolPref("enabled"); // default:true
		var ShowUpdate = !Branch.prefHasUserValue("showupdate") || Branch.getBoolPref("showupdate");
		var fileURL = Branch.prefHasUserValue("fileURL") ? Branch.getCharPref("fileURL") : defaultURL;
		var pathURLMH = Branch.prefHasUserValue("URLMH") ? Branch.getCharPref("URLMH") : defaultMH;
		var pathURLRM = Branch.prefHasUserValue("URLRM") ? Branch.getCharPref("URLRM") : defaultRM;
		
 		var enablebox = document.getElementById("enabled");
		enablebox.checked = Enabled;
		var updatebox = document.getElementById("showupdate");
		updatebox.checked = ShowUpdate;
		var url = document.getElementById("newScript");
		url.value = fileURL;
		var urlMH = document.getElementById("newURLMH");
		urlMH.value = pathURLMH;
		var urlRM = document.getElementById("newURLRM");
		urlRM.value = pathURLRM;
	
		
	} catch(e) {alert(e)}
}

function findfile() {
	var fp = Components.classes["@mozilla.org/filepicker;1"].createInstance(Components.interfaces.nsIFilePicker);

	fp.init(window, "Sélectionnez un script", fp.modeOpen);
	fp.appendFilter("Java Script","*.js");
	fp.appendFilter("Tous","*");

	if (fp.show() != fp.returnCancel) {
		var url = document.getElementById("newScript");
		url.value = fp.fileURL.spec;
	}
}
function setDefault() {
	var url = document.getElementById("newScript");
	url.value = defaultURL;
	var urlMH = document.getElementById("newURLMH");
	urlMH.value = defaultMH;
	var urlRM = document.getElementById("newURLRM");
	urlRM.value = defaultRM;
}

function setDev() {
	var url = document.getElementById("newScript");
	url.value = devURL;
}

// Save the settings and close the window.
function saveSettings() {
	var prefObj = Components.classes["@mozilla.org/preferences-service;1"].getService(Components.interfaces.nsIPrefService);
	var Branch = prefObj.getBranch("firemago.");
	
	var enablebox = document.getElementById("enabled");
	Branch.setBoolPref("enabled", enablebox.checked);
	
	var updatebox = document.getElementById("showupdate");
	Branch.setBoolPref("showupdate", updatebox.checked);
	
	var newScript = document.getElementById("newScript");
	Branch.setCharPref("fileURL",newScript.value);
	
	var newURLMH = document.getElementById("newURLMH");
	Branch.setCharPref("URLMH",newURLMH.value);

	var newURLRM = document.getElementById("newURLRM");
	Branch.setCharPref("URLRM",newURLRM.value);

	window.close(); // close out. -- triggers an 'onclose' handler to call "loadSettings()" *in the overlay*
}
