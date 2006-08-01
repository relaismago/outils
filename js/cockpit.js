function get_map_center(){
	get_map_go(true);
}

function get_map(){
	get_map_go(false);
}

/* Function called to get the product categories list */
function get_map_go(pcenter,pcentergo){
	/* Create the request. The first argument to the open function is the method (POST/GET),
		and the second argument is the url... 
		document contains references to all items on the page
		We can reference document.form_category_select.select_category_select and we will 		
		be referencing the dropdown list. The selectedIndex property will give us the 
		index of the selected item. 
	*/
	var troll="";
	var position="";
	if (pcenter == true) {
		var cX =document.form_cockpit.cX.value;
		var cY =document.form_cockpit.cY.value;
		var cZ =document.form_cockpit.cZ.value;
		var position = '&cX=' + cX+ '&cY=' + cY	+ '&cZ=' + cZ;
	} else if (pcentergo == true) {
		var cX =document.form_cockpit.cX_direct.value;
		var cY =document.form_cockpit.cY_direct.value;
		var cZ =document.form_cockpit.cZ_direct.value;
		var position = '&cX=' + cX+ '&cY=' + cY	+ '&cZ=' + cZ;
	} else {
		var troll= '&id_troll=' + document.form_cockpit.id_troll.value;
	}

	http.open('get', '/cockpit_request.php?action=get_map' 
			+ troll
			+ '&zoom=' + document.form_cockpit.zoom.value
			+ '&anim=' + document.form_cockpit.anim.value
			+ '&trolls_disparus=' + document.form_cockpit.trolls_disparus.value
			+ position
			+ '&taille_vue=' + document.form_cockpit.taille_vue.value
			+ '&max_pa=' + document.form_cockpit.max_pa_direct.value
			);
			
	/* Define a function to call once a response has been received. This will be our
		handleProductCategories function that we define below. */
	http.onreadystatechange = handle_map; 
	/* Send the data. We use something other than null when we are sending using the POST
		method. */
	http.send(null);
}

function get_trollometer(afficherBouton,pcenter){
	/* Create the request. The first argument to the open function is the method (POST/GET),
		and the second argument is the url... 
		document contains references to all items on the page
		We can reference document.form_category_select.select_category_select and we will 		
		be referencing the dropdown list. The selectedIndex property will give us the 
		index of the selected item. 
	*/

	var cX =document.form_cockpit.cX.value;
	var cY =document.form_cockpit.cY.value;
	var cZ =document.form_cockpit.cZ.value;
	var position = '&cX=' + cX+ '&cY=' + cY	+ '&cZ=' + cZ;

	http.open('get', '/cockpit_request.php?action=display_trollometer&display_trollometer=' 
			+ document.form_cockpit.b_trollometer.value
			+ '&max_pa=' 
			+ document.form_cockpit.max_pa.value
			+ position
			);
	/* Define a function to call once a response has been received. This will be our
		handleProductCategories function that we define below. */
	http.onreadystatechange = handle_trollometer; 
	/* Send the data. We use something other than null when we are sending using the POST
		method. */
	http.send(null);

	if ( afficherBouton ) {
		if ( document.form_cockpit.b_trollometer.value == "Afficher" )
	 		document.form_cockpit.b_trollometer.value = "Cacher";
		else
		 	document.form_cockpit.b_trollometer.value = "Afficher";
	} else
	 		document.form_cockpit.b_trollometer.value = "Cacher";
}

/* Function called to handle the list that was returned from the internal_request.php file.. */
function handle_map(){
	/* Make sure that the transaction has finished. The XMLHttpRequest object 
		has a property called readyState with several states:
		0: Uninitialized
		1: Loading
		2: Loaded
		3: Interactive
		4: Finished */
	if(http.readyState == 1){ 
		new Effect.Appear('status');
//		document.getElementById('status').style.display = "block";
		document.getElementById('background').style.display = "0%";
	} else if(http.readyState == 2){ 
		document.getElementById('background').style.width="50%";
	} else if(http.readyState == 3){ 
		document.getElementById('background').style.width="100%";
	} else if(http.readyState == 4){ //Finished loading the response
		/* We have got the response from the server-side script,
			let's see just what it was. using the responseText property of 
			the XMLHttpRequest object. */
		var response = http.responseText;
		/* And now we want to change the product_categories <div> content.
			we do this using an ability to get/change the content of a page element 
			that we can find: innerHTML. */
//		document.getElementById('status').style.display = "none";

	//	setTimeout(function() {new Effect.Fade('status');}, 1000)
		new Effect.Fade('status');
		document.getElementById('result_cage').innerHTML = response;

		document.getElementById('trollometer_cage').innerHTML = "";
		document.form_cockpit.b_trollometer.value = "Afficher";
		suite_on_load();

	}
}

function handle_trollometer(){
	/* Make sure that the transaction has finished. The XMLHttpRequest object 
		has a property called readyState with several states:
		0: Uninitialized
		1: Loading
		2: Loaded
		3: Interactive
		4: Finished */
	if(http.readyState == 1){ 
		new Effect.Appear('status_trollometer');
//		document.getElementById('status').style.display = "block";
		document.getElementById('background_trollometer').style.display = "0%";
	} else if(http.readyState == 2){ 
		document.getElementById('background_trollometer').style.width="50%";
	} else if(http.readyState == 3){ 
		document.getElementById('background_trollometer').style.width="100%";
	} else if(http.readyState == 4){ //Finished loading the response
		/* We have got the response from the server-side script,
			let's see just what it was. using the responseText property of 
			the XMLHttpRequest object. */
		var response = http.responseText;
		/* And now we want to change the product_categories <div> content.
			we do this using an ability to get/change the content of a page element 
			that we can find: innerHTML. */
		new Effect.Fade('status_trollometer');
		document.getElementById('trollometer_cage').innerHTML = response;
	}
}

function get_choix(){
	http.open('get', '/cockpit_request.php?action=get_choix' 
			+ "&choix_cockpit=" + document.form_cockpit.choix_cockpit.value
			);
	/* Define a function to call once a response has been received. This will be our
		handleProductCategories function that we define below. */
	http.onreadystatechange = handle_choix; 
	
	/* Send the data. We use something other than null when we are sending using the POST
		method. */
	http.send(null);
}

function handle_choix(){
	/* Make sure that the transaction has finished. The XMLHttpRequest object 
		has a property called readyState with several states:
		0: Uninitialized
		1: Loading
		2: Loaded
		3: Interactive
		4: Finished */
	if(http.readyState == 4){ //Finished loading the response
		/* We have got the response from the server-side script,
			let's see just what it was. using the responseText property of 
			the XMLHttpRequest object. */
		var response = http.responseText;
		/* And now we want to change the product_categories <div> content.
			we do this using an ability to get/change the content of a page element 
			that we can find: innerHTML. */
		document.getElementById('choix_cage').innerHTML = response;
		document.getElementById('result_cage').innerHTML = "";
		document.getElementById('trollometer_cage').innerHTML = "";
	}
}

function toggleListElements ( hide ) {
	rowsMonsters = document.getElementById('IdMonstres').rows;
  for ( var i = 0; i < rowsMonsters.length; i++ ) {
  	if ( rowsMonsters[i].className != "mh_tdtitre")
    {
    	if (rowsMonsters[i].childNodes[2].childNodes[0].childNodes[0].childNodes[0].nodeValue.indexOf("Gowap") != -1)
      {
      	if ( hide  ) { rowsMonsters[i].style.display='none';  }
        else {rowsMonsters[i].style.display='';  }
      }
     }
  }
}

function toggleGowap () {
	var on = document.getElementsByName ( 'delgowap' )[0].checked;
	toggleListElements (  on );
}
