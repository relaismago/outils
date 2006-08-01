function get_recherche(){
	/* Create the request. The first argument to the open function is the method (POST/GET),
		and the second argument is the url... 
		document contains references to all items on the page
		We can reference document.form_category_select.select_category_select and we will 		
		be referencing the dropdown list. The selectedIndex property will give us the 
		index of the selected item. 
	*/
	http.open('get', '/recherche_request.php?action=get_recherche' 
			+ '&valeur=' + document.getElementById('livesearch').value
			+ '&page=' + document.getElementById('recherche_page').value
		/*	+ '&id_troll=' + document.form_cockpit.id_troll.value
			+ '&zoom=' + document.form_cockpit.zoom.value
			+ '&anim=' + document.form_cockpit.anim.value
			+ '&trolls_disparus=' + document.form_cockpit.trolls_disparus.value
			+ position
			+ '&taille_vue=' + document.form_cockpit.taille_vue.value*/
			);
			
	/* Define a function to call once a response has been received. This will be our
		handleProductCategories function that we define below. */
	http.onreadystatechange = handle_recherche; 
	/* Send the data. We use something other than null when we are sending using the POST
		method. */
	http.send(null);
}

function handle_recherche(){
	/* Make sure that the transaction has finished. The XMLHttpRequest object 
		has a property called readyState with several states:
		0: Uninitialized
		1: Loading
		2: Loaded
		3: Interactive
		4: Finished */
	if(http.readyState == 1){ 
		new Effect.Appear('status_recherche');
//		document.getElementById('status').style.display = "block";
		document.getElementById('background_recherche').style.display = "0%";
	} else if(http.readyState == 2){ 
		document.getElementById('background_recherche').style.width="50%";
	} else if(http.readyState == 3){ 
		document.getElementById('background_recherche').style.width="100%";
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
		new Effect.Fade('status_recherche');
		
		liveSearchHide();
		s = response.split(":");
		if (s[0] == "get_map_id_troll") {
			document.getElementById('recherche_cage').innerHTML = "";
			document.form_cockpit.id_troll.value = s[1];
			get_map();
		} else if (s[0] == "get_map_center") {
			document.getElementById('recherche_cage').innerHTML = "";
			document.form_cockpit.cX_direct.value = s[1];
			document.form_cockpit.cY_direct.value = s[2];
			document.form_cockpit.cZ_direct.value = s[3];
			document.form_cockpit.taille_vue.value = s[4];
			get_map_go(false,true);
		} else if (s[0] == "redirect") {
			document.location.href = s[1];
		} else {
			document.getElementById('recherche_cage').innerHTML = response;
		}
	}
}
