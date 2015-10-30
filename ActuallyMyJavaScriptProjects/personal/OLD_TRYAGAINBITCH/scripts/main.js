/**
* checkPassword() ensures that password and confirm
* password are the same before submitting form
*/
function checkPassword() {
	if (document.getElementById("pass").value == document.getElementById("passVer").value) {
		document.getElementById("submit").disabled = false;
	} else {
		document.getElementById("submit").disabled = true;
	}
}
/**
* This function checks username availability
*/
function doTheThing() {
	localStorage.removeItem(undefined);
	if (localStorage.getItem(signup["user"]) != null) {
		document.getElementById("message").setAttribute("style", "display:block");
	} else if (signup != {}) {
		localStorage.setItem(signup["user"], signup["pass"]);
		window.location.assign("./success.html");
	}
};
/**
* Header GUI Piece
*/
function makeHeader(header) {
	header.innerHTML = '
		<nav>
			<ul>
				<li><a href="./home.html" class="menuItem" title="Home">Home</a></li>
				<li><a href="./map.html" class="menuItem" title="Map">Map</a></li>
				<li><a href="./hero.html" class="menuItem" title="Hero">Hero</a></li>
				<li><a href="./inventory.html" class="menuItem" title="Inventory">Inventory</a></li>
			</ul>
		</nav>'
}
/**
* Create a User class that initializes all kinds of stuff
* It's gonna be great I hope
*/
function User(uname, pword) {
	this.username = uname;
	this.password = pword;
	this.characters = [];
}
/**
* This function needs to add an array to the characters array
* based on whichever role is selected on the dropdown
*/
User.prototype.createCharacter = function(name, job) {
	if (job == "warlock") {
		
	} else if (job == "warrior") {
		
	} else if (job == "rogue") {
		
	}
}