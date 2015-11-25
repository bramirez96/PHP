//new_survey.js # Question class that outputs shit to the table
var tbody = document.getElementById('questions');
function Question(x) {
	Question.count++;
	this.qnum = Question.count;
	this.type = (typeof(x) !== "undefined") ? x : 1;
	this.answers = 0;
	tbody.insertAdjacentHTML('beforeend', 
		"<div class=\"grid clearfix\">" +
			"<div class=\"col-1-5\">Question " + this.qnum + ":</div>" +
			"<div class=\"col-4-5\">" +
				"<input type='text' name='q" + this.qnum + "' />" +
				" <label><input type=\"radio\" name=\"t" + this.qnum + "_0\" value=\"1\" checked>Radio Button </label>" +
				" <label><input type=\"radio\" name=\"t" + this.qnum + "_0\" value=\"2\">Checkbox </label>" +
			"</div>" +
		"</div>" +
		"<div class=\"grid clearfix underline_box\">" +
			"<div class=\"col-1-5\">" +
			"<button type=\"button\" onclick=\"q[" + (this.qnum - 1) + "].addAnswer()\">+Add Answer</button>" +
			"</div>" +
			"<div id=\"answers\" class=\"col-4-5\">" +
				"<div class=\"grid clearfix\">" +
					"<div id=\"answers" + this.qnum + "\" class=\"col-1-1\">" +
					"</div>" +
				"</div>" +
			"</div>" +
		"</div>");
	this.addAnswer();
}
Question.count = 0;
Question.getCount = function() {
	return this.count;
}
Question.prototype.addAnswer = function() {
	this.answers++;
	var id = "answers" + this.qnum;
	var z = document.getElementById(id);
	z.insertAdjacentHTML('beforeend',
		"<div id=\"a" + this.qnum + "_" + this.answers + "\" class=\"grid clearfix\">" +
			"<div class=\"col-1-4\">" +
				"Answer " + this.answers + ":" +
			"</div>" +
			"<div class=\"col-3-4\">" +
				"<input type=\"text\" name=\"a" + this.qnum + "_" + this.answers + "\" />"+
				"<input type=\"hidden\" name=\"t" + this.qnum + "_" + this.answers + "\" value=\"1\"> " +
				" <label><input type=\"checkbox\" name=\"t" + this.qnum + "_" + this.answers + "\" value=\"2\">Input Field</label> " +
			"</div>" +
		"</div>");
}
//Call once to create a first question, survey has to have at least one
q = new Array(new Question());