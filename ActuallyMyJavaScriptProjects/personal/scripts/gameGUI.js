//gameGUI.js for use in game pages to automatically set up page

/**
* makeGUI() calls all GUI functions
*/
function makeGUI() {
	$("#headModule").load("./modules/headModule.html");
	$("#userModule").load("./modules/userModule.html");
}
$(document).ready(function() {
	makeGUI();
});