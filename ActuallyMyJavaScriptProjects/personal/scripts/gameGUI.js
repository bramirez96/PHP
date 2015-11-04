//CHANGING THE FILE TO CONTROL ALL GAME FUNCTIONS DEAL WITH IT

function loadChars() {
	if (localStorage.char) window.z = localStorage.char;
	else window.z = '[]';
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
	window.key = sessionStorage.num;
	makeGUI();
});
$(window).unload(function() { //Saves character to local variable always, so goood
	if (typeof curChar !== "undefined") char[key] = curChar;
	var x = JSON.stringify(char);
	localStorage.char = x;
});
function makeHeader() { //Calls ajax function that loads header module
	$("#headModule").load("./modules/headModule.html");
}
function makeUser() {
	if (char[key]) { //If user has a character YOU NEED TO REINITIALIZE IT
		loadUserModule(char[key]);
	} else { //If user needs to make a character
		makeNewCharacterModule();
	}
}
function loadUserModule(xyz) { //Ajax function that loads user module and sets character info
	xyz = (typeof xyz !== "undefined") ? xyz : curChar;
	$("#userModule").load("./modules/userModule.html", function() {//REINITIALLIZE IT HERE
		var n = xyz;
		window.curChar = new Character(n.name, n.role, n.bStats, n.stats, n.hp, n.mp, n.xp, n.lvl, n.usrImg);
		setCharacter(curChar);
	});
}
function makeNewCharacterModule() { //
	$("#userModule").load("./modules/newCharacterModule.html");
}
function makeCharacter(name, role) {
	z = new Character(name, role);
	char[key] = z;
}
function setCharacter(x) { //Needs to take character instance object as parameter
	//Use this function to set the stats of the character
	//Should be pulled from the character object.... if that's a thing
	$("#usrImg").attr("src", x.usrImg);
	$("#level").text(x.lvl);
	$("#name").text(x.name);
	var hp    = x.hp[0].toFixed(2); 
	var maxHp = x.hp[1].toFixed(2);
	$("#hpNow").text(hp);
	$("#hp").val(hp);
	$("#hpMax").text(maxHp);
	$("#hp").attr("max", maxHp);
	var mp    = x.mp[0].toFixed(0);
	var maxMp = x.mp[1].toFixed(0);
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
	$("#atk").text(x.stats.atk.toFixed(2));
	$("#mag").text(x.stats.mag.toFixed(2));
	$("#def").text(x.stats.def.toFixed(2));
	$("#spd").text(x.stats.spd.toFixed(2));
}
function checkChar(form) {
	x = form.elements["charName"].value;
	y = $("#newChar input[type=radio]:checked").val();
	$("#nameError").css("display", "none");
	$("#classError").css("display", "none");
	if (x != "" && x.length > 4) {
		makeCharacter(x, y);
		loadUserModule();
		return false; // !!!!!Has to submit eventually, change this!
	}
	else {
		$("#nameError").css("display", "inline");
		return false;
	}
}
/**
* The following code is all information for the character class
*/
function Character(name, role, base, stats, hp, mp, xp, lvl, img) { //Character class
	this.name   = typeof  name !== "undefined" ?  name : "Guest";
	this.role   = typeof  role !== "undefined" ?  role : "mage";
	this.bStats = typeof  base !== "undefined" ?  base : {atk: 0, mag: 0, def: 0, spd: 0, hp: 0, mp: 0};
	this.stats  = typeof stats !== "undefined" ? stats : {atk: 0, mag: 0, def: 0, spd: 0, hp: 0, mp: 0};
	this.hp     = typeof    hp !== "undefined" ?    hp : [0, 0];
	this.mp     = typeof    mp !== "undefined" ?    mp : [0, 0];
	this.xp     = typeof    xp !== "undefined" ?    xp : [0, 8];
	this.lvl    = typeof   lvl !== "undefined" ?   lvl : 1;
	this.usrImg = typeof   img !== "undefined" ?   img : "./images/img_frame.png"; //One day: "./images/char_" + this.name + ".png";
	if (role == "mage" || role == 0) {
		this.role = 0;
		this.bStats.atk = 60;
		this.bStats.mag = 80;
		this.bStats.def = 63;
		this.bStats.spd = 72;
		this.bStats.hp  = 80;
		this.bStats.mp  = 80;
	} else if (role == "warrior" || role == 1) {
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
	this.setStats();
}
Character.prototype.addXP = function(plus) {
	this.xp[0] = this.xp[0] + plus;
	if (this.xp[0] >= this.xp[1]) { //What to do if character levels up
		var cur = this.lvl;
		var z = Math.cbrt(this.xp[0]);
		this.lvl = Math.floor(z);
		this.xp[1] = Math.pow(this.lvl + 1, 3);
		this.setStats();
		alert("Your character has grown from level " + cur + " to level " + this.lvl + "!");
	}
}
Character.prototype.setStats = function() {
	this.stats.atk = (this.bStats.atk * 2 * this.lvl / 100) + 5; //This could easily be put
	this.stats.mag = (this.bStats.mag * 2 * this.lvl / 100) + 5; //into a nice for loop
	this.stats.def = (this.bStats.def * 2 * this.lvl / 100) + 5;
	this.stats.spd = (this.bStats.spd * 2 * this.lvl / 100) + 5;
	this.stats.hp  = (this.bStats.hp  * 2 * this.lvl / 100) + 10 + this.lvl;
	this.stats.mp  = (this.bStats.mp  * 2 * this.lvl / 100) + 10 + this.lvl;
	this.hp = [this.stats.hp, this.stats.hp];
	this.mp = [this.stats.mp, this.stats.mp];
}











