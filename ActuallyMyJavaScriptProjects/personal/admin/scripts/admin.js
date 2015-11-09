//admin.js - administrator functions
/**
 * checkAdminForm() creates the administrator user who can only log in from the admin page
 */
function checkAdminForm(form) {
	x = form.elements["user"].value;
	y = form.elements["pass"].value;
	$("#passError").css("display", "none");
	$("#userError").css("display", "none");
	if (y == "password" && x == "root"){//Check the password
		return true;
	} else if (x != "root") {
		$("#userError").css("display", "inline");
		return false;
	} else {
		$("#passError").css("display", "inline");
		return false;
	}
}
function makeUserTable() {
	stripURL();
	var display = 10;
	var records = usr.keys.length;
	var page, initial, sort;
	window.pages = Math.floor(records/display) + 1; //Assigning globally for testing purposes

	if (!$.isEmptyObject(queryString)) { //If queryString is set
		//Set the sort
		switch (queryString.s) {
			case "n":
				//Sort by name
				break;
			case "p":
				//Sort by pass
				break;
			case "c":
				//Sort by character name
				break;
			case "l":
				//Sort by character level
				break;
		}
		initial = queryString.i;
		page    = queryString.n;
	} else {
		sort    = "n";
		initial = 0;
		page    = 1;
		window.location.assign("./admin_view_users.html?s="+sort+"&i="+initial+"&n="+page);
	}
	//Table head
	var thead = "<thead>\
					<tr>\
						<td>Edit</td>\
						<td>Delete</td>\
						<td><a href='./admin_view_users.html?'";
}