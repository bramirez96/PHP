//main.js main functions for thingamajig
function reset() { //For testing only
	localStorage.clear();
	sessionStorage.clear();
}
var queryString = {}; //set it as global for use by functions
function stripURL() {
	var myExp = /([^?&]+)=([^=&]*)/g; //regex to get query string from the end of a url
	var url = location.href;
	var x;
	do {
		x = myExp.exec(url);
		if (x) {
			queryString[x[1]] = x[2];
		}
	} while (x);
};
/**
* loadUsers() loads stored JSON strings and parses them into objects
* Eventually move this to a game-specific file
*/
function loadUsers() {
	if (localStorage.user) var z = localStorage.user;
	else z = '{"keys":[]}';
	window.usr = JSON.parse(z);
}
function logOut() {
	sessionStorage.clear();
	alert("You will now be returned to the login screen.");
	window.location.assign("./index.html");
}
/**
* checkInput() is really only for the signup form and exists to avoid confusion with plus signs
* in case user tries to input a space... 
* DON'T FORGET TO IMPLEMENT THIS
* YOU'RE GONNA NEED TO REWRITE THE SIGNUP CODE... AGAIN
*/
function checkInput(x) {
	var myExp = /^[^\s]{6,20}$/; //regex for NOT ALLOWING SPACES ASDGBFSDAFJS;KDFASDL;KFASD;jh;kljgf;
	var z = myExp.test(x);
	return z;
}
/**
* checkLoginForm() stops form submit and displays errors 
* if invalid username or password are submitted
*/
function checkLoginForm(form) {
	x = form.elements["user"].value;
	y = form.elements["pass"].value;
	$("#passError").css("display", "none");
	$("#userError").css("display", "none");
	if (usr[x]) {//If storage item exists
		//alert("username exists");
		if ((usr[x]["pass"]) == y){//Check the password
			//alert("and your password is right");
			form.elements["key"].value = usr[x]["key"];
			return true;
		} else {
			$("#passError").css("display", "inline");
			//alert("but your password is wrong");
			return false;
		}
	} else {
		//alert("username doesnt exist");
		$("#userError").css("display", "inline");
		$("#passError").css("display", "inline");
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
	$("#userError").css("display", "none");
	$("#passError").css("display", "none");
	$("#nullError").css("display", "none");
	if (usr[x] == null) { //If username isn't taken
		if (y != "") {
			if (y == z) {
				return true;
			} else {
				$("#passError").css("display", "inline");
				return false;
			}
		} else {
			$("#nullError").css("display", "inline");
			return false;
		}
	} else {
		$("#userError").css("display", "inline");
		if (y == "") {
			$("#nullError").css("display", "inline");
		}
		if (y != z) {
			$("#passError").css("display", "inline");
		}
		return false;
	}
}