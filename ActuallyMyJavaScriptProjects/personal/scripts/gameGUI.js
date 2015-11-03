//CHANGING THE FILE TO CONTROL ALL GAME FUNCTIONS DEAL WITH IT

function loadChars() {
	if (localStorage.char) var z = localStorage.char;
	else z = '[]';
	char = JSON.parse(z);
}
/**
* makeGUI() calls all GUI functions
*/
function makeGUI() {
	makeHeader();
	makeUser();
}
$(document).ready(function() {
	loadChars();
	key = sessionStorage.num;
	makeGUI();
});
function makeHeader() {
	$("#headModule").load("./modules/headModule.html");
}
function makeUser() {
	if (char[key]) { //user has a character
		$("#userModule").load("./modules/userModule.html", function() {
			setCharacter();
		});
	} else {
		$("#userModule").load("./modules/newCharacterModule.html", function() {
			newCharacter();
		})
	}
	
}
function setCharacter() {
	//Use this function to set the stats of the character
	//Should be pulled from the character object.... if that's a thing
	$("#usrImg").attr("src", "./images/img_frame.png");
	$("#level").text(20);
	var hp    = 12; 
	var maxHp = 35;
	$("#hpNow").text(hp);
	$("#hp").val(hp);
	$("#hpMax").text(maxHp);
	$("#hp").attr("max", maxHp);
	var mp    = 12; 
	var maxMp = 35;
	$("#mpNow").text(mp);
	$("#mp").val(mp);
	$("#mpMax").text(maxMp);
	$("#mp").attr("max", maxMp);
	var xp    = 12; 
	var maxXp = 35;
	$("#xpNow").text(xp);
	$("#xp").val(xp);
	$("#xpMax").text(maxXp);
	$("#xp").attr("max", maxXp);
	$("#atk").text(24);
	$("#mag").text(24);
	$("#def").text(24);
	$("#spd").text(24);
}
function checkChar(form) {
	x = form.elements["charName"].value;
	y = $("#newChar [name='class']").attr("checked");
	$("#nameError").css("display", "none");
	$("#classError").css("display", "none");
	if (x != "" && x.length > 4) {
		makeCharacter(x, y);
		return true;
	};
	else {
		$("#nameError").css("display", "inline");
		return false;
	}
}
/**
* The following code is all information for the character class
*/
function Character(name, role) { //Character class
	this.name = name;
	this.bStats = {atk: , def: , mag: , spd: , hp: , mp:};
	if (role == "mage") {
		this.role = 0;
		this.bStats.atk = 60;
		this.bStats.mag = 80;
		this.bStats.def = 63;
		this.bStats.spd = 72;
		this.bStats.hp  = 80;
		this.bStats.mp  = 80;
	} else if (role == "warrior") {
		this.role = 1;
		this.bStats.atk = 85;
		this.bStats.mag = 62;
		this.bStats.def = 78;
		this.bStats.spd = 60;
		this.bStats.hp  = 74;
		this.bStats.mp  = 
	} else {
		this.role = 2;
		this.bStats.atk = 75;
		this.bStats.mag = 75;
		this.bStats.def = 55;
		this.bStats.spd = 85;
		this.bStats.hp  = 57;
	}
	this.stats = {atk: , def: , mag: , spd: , hp: , mp:};
}
Character.prototype.levelUp = function() {
	
}
function makeCharacter(name, role) {
	
}











