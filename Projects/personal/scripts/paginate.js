//paginate.js # Script that displays and hides list items in order to paginate without refreshing the page (hopefully)
function O(obj) {
	return document.getElementById(obj);
}
function Pages(name, results, col, inc) {
	if (typeof inc !== 'undefined') this.inc = inc;
	else if (this.total < 10) this.inc = this.total;
	else this.inc = 10;
	this.name = name;
	this.total  = results;
	this.cols   = col;
	this.offset = 0;
	this.npages = Math.ceil(this.total / this.inc);
	if (this.npages == 1) {
    	O(this.name + '_nav').style.display = "none";
	}
	this.page   = 1;
	O(this.name + '_back').setAttribute("onclick", this.name + ".stepBack()");
	O(this.name + '_next').setAttribute("onclick", this.name + ".stepNext()");
	this.showPage();
	this.setRange();
}
Pages.prototype.setRange = function() {
	var x = O(this.name + '_range');
	while (x.firstChild) {
		x.removeChild(x.firstChild);
	}
	for (var i = 1; i <= this.npages; i++) {
		var butt = document.createElement('button');
		var text = document.createTextNode(i);
		butt.appendChild(text);
		if (i == this.page) butt.setAttribute('class', 'alt select');
		else butt.setAttribute('class', 'alt');
		butt.setAttribute("onclick", this.name + ".setPage(" + i + ")")	
		x.appendChild(butt);
	}
}
Pages.prototype.clearAll = function() {
	var x = document.querySelectorAll('[data-item-num-' + this.name + ']');
	for (var i = 0; i < x.length; i++) {
		x[i].style.display = 'none';
	}
}
Pages.prototype.showPage = function() {
	this.clearAll();
	for (var i = 1 + this.offset; i <= this.offset + this.inc; i++) {
		for (var c = 0; c < this.cols; c++) {
			document.querySelectorAll('[data-item-num-' + this.name +'="'+ i +'"]')[c].style.display = 'list-item';
		}
	}
}
Pages.prototype.setPage = function(newPage) {
	this.page = newPage;
	this.offset = (this.page - 1) * this.inc;
	this.setRange();
	this.showPage();
}
Pages.prototype.stepNext = function() {
	if (this.page != this.npages) this.setPage(this.page + 1);
}
Pages.prototype.stepBack = function() {
	if (this.page != 1) this.setPage(this.page - 1)
}