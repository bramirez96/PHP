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
$(window).unload(function() { //Saves character to local variable always, so goood
	x = JSON.stringify(char);
	localStorage.char = x;
});
function makeHeader() {
	$("#headModule").load("./modules/headModule.html");
}
function makeUser() {
	if (char[key]) { //user has a character
		$("#userModule").load("./modules/userModule.html", function() {
			setCharacter(char[key]);
			curChar = char[key];
		});
	} else {
		$("#userModule").load("./modules/newCharacterModule.html");
	}
	
}
function setCharacter(x) { //Needs to take character instance object as parameter
	//Use this function to set the stats of the character
	//Should be pulled from the character object.... if that's a thing
	$("#usrImg").attr("src", x.usrImg);
	$("#level").text(x.lvl);
	var hp    = x.hp[0]; 
	var maxHp = x.hp[1];
	$("#hpNow").text(hp);
	$("#hp").val(hp);
	$("#hpMax").text(maxHp);
	$("#hp").attr("max", maxHp);
	var mp    = x.mp[0]; 
	var maxMp = x.mp[1];
	$("#mpNow").text(mp);
	$("#mp").val(mp);
	$("#mpMax").text(maxMp);
	$("#mp").attr("max", maxMp);
	var xp    = x.xp[0]; 
	var maxXp = x.xp[1];
	$("#xpNow").text(xp);
	$("#xp").val(xp);
	$("#xpMax").text(maxXp);
	$("#xp").attr("max", maxXp);
	$("#atk").text(x.stats.atk);
	$("#mag").text(x.stats.mag);
	$("#def").text(x.stats.def);
	$("#spd").text(x.stats.spd);
}
function checkChar(form) {
	x = form.elements["charName"].value;
	y = $("#newChar input[type=radio]:checked").val();
	$("#nameError").css("display", "none");
	$("#classError").css("display", "none");
	if (x != "" && x.length > 4) {
		makeCharacter(x, y);
		return true; // !!!!!Has to submit eventually, change this!
	}
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
	this.bStats = {atk: 0, mag: 0, def: 0, spd: 0, hp: 0, mp: 0};
	this.stats = {atk: 0, mag: 0, def: 0, spd: 0, hp: 0, mp: 0};
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
		this.bStats.hp  = 72;
		this.bStats.mp  = 60;
	} else {
		this.role = 2;
		this.bStats.atk = 75;
		this.bStats.mag = 75;
		this.bStats.def = 55;
		this.bStats.spd = 85;
		this.bStats.hp  = 65;
		this.bStats.mp  = 75;
	}
	this.lvl = 1;
	this.usrImg = "./images/img_frame.png";//One day: "./images/char_" + this.name + ".png";
	this.hp = [0, 0];
	this.mp = [0, 0];
	this.xp = [0, 8];
	this.addXP = function(plus) {
		this.xp[0] = this.xp[0] + plus;
		if (this.xp[0] >= this.xp[1]) { //What to do if character levels up
			var cur = this.lvl;
			var z = Math.cbrt(this.x[0]);
			this.lvl = Math.floor(z);
			this.xp[1] = Math.pow(this.lvl + 1, 3);
			this.setStats();
			alert("Your character has grown from level " + cur + " to level " + this.lvl + "!");
		}
	}
	this.setStats = function() {
		this.stats.atk = (this.bStats.atk * 2 * this.lvl / 100) + 5; //This could easily be put
		this.stats.mag = (this.bStats.mag * 2 * this.lvl / 100) + 5; //into a nice for loop
		this.stats.def = (this.bStats.def * 2 * this.lvl / 100) + 5;
		this.stats.spd = (this.bStats.spd * 2 * this.lvl / 100) + 5;
		this.stats.hp  = (this.bStats.hp  * 2 * this.lvl / 100) + 10 + this.lvl;
		this.stats.mp  = (this.bStats.mp  * 2 * this.lvl / 100) + 10 + this.lvl;
		this.hp = [this.stats.hp, this.stats.hp];
		this.mp = [this.stats.mp, this.stats.mp];
	}
	this.setStats();
}
function makeCharacter(name, role) {
	z = new Character(name, role);
	char[key] = z;
}











