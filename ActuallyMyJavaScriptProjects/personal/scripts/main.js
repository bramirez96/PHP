//main.js main functions for thingamajig
/**
* onPageLoad() loads stored JSON strings and parses them into objects
* Eventually move this to a game-specific file
*/
function onPageLoad() {
	x = sessionStorage.user; //Returns ToEnd
	var usr = JSON.parse(localStorage.getItem(x));
}
function onLeavePage() {
	x = sessionStorage.user; //returns ToEnd
	localStorage.setItem(x, JSON.stringify(usr));
}
//usr is the object with stored "username: user object" pairs stringified

/**
* checkLoginForm() stops form submit and displays errors 
* if invalid username or password are submitted
*/
function checkLoginForm(form) {
	x = form.elements["user"].value;
	y = form.elements["pass"].value;
	document.getElementById("passError").style.display="none";
	document.getElementById("userError").style.display="none";
	if (localStorage.getItem(x)) {//If storage item exists
		if (localStorage.getItem(x) == y){//Check the password
			return true;
		} else {
			document.getElementById("passError").style.display="inline";
			return false;
		}
	} else {
		document.getElementById("userError").style.display="inline";
		if (localStorage.getItem(x) != y) {
			document.getElementById("passError").style.display="inline";
		}
		return false;
	}
}
/**
* checkSignupForm() stops form submit and displays errors
* if username is taken already or passwords don't match
*/
function checkSignupForm(form) {
	x = form.elements["user"].value;
	y = form.elements["pass"].value;
	z = form.elements["pVer"].value;
	document.getElementById("userError").style.display="none";
	document.getElementById("passError").style.display="none";
	document.getElementById("nullError").style.display="none";
	if (localStorage.getItem(x) == null) { //If username isn't taken
		if (y != "") {
			if (y == z) {
				return true;
			} else {
				document.getElementById("passError").style.display="inline";
				return false;
			}
		} else {
			document.getElementById("nullError").style.display="inline";
			return false;
		}
	} else {
		document.getElementById("userError").style.display="inline";
		if (y == "") {
			document.getElementById("nullError").style.display="inline";
		}
		if (y != z) {
			document.getElementById("passError").style.display="inline";
		}
		return false;
	}
}