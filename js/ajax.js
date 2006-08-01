/* The following function creates an XMLHttpRequest object... */

function createRequestObject(){
	var request_o; //declare the variable to hold the object.
	var browser = navigator.appName; //find the browser name
	if(browser == "Microsoft Internet Explorer"){
		/* Create the object using MSIE's method */
		request_o = new ActiveXObject("Microsoft.XMLHTTP");
	}else{
		/* Create the object using other browser's method */
		request_o = new XMLHttpRequest();
	}
	return request_o; //return the object
}

/* You can get more specific with version information by using 
	parseInt(navigator.appVersion)
	Which will extract an integer value containing the version 
	of the browser being used.
*/
/* The variable http will hold our new XMLHttpRequest object. */
var http = createRequestObject(); 
