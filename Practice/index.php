<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<body>

<?php
	//Line Comment
	/*
		Block
		Comment
	*/
	//Primitive Data Types!!!
	$ix = (int)(9/5); //Integer
	$fx = (float)(9/5); //Float
	$fy = 3.12e1; //Scientific Notation Float
	$fz = 3120e-2; //Other Format
	$hx = 0xff; //Hexadecimal
	$ox = 077; //Octal
	$bx = 00010111001; //Binary
	$xx = True; //Boolean
	$yx = False; //Boolean
	$sx = "Fuck this guy.";
	echo '<p>$ix</p>'; //SINGLE QUOTE ISSUES
	echo "<p>$ix</p>";
	echo "<p>$fx</p>";
	echo "<p>$fy</p>";
	echo "<p>$fz</p>";
	echo "<p>$hx</p>";
	echo "<p>$ox</p>";
	echo "<p>$bx</p>";
	echo "<p>$xx, $yx</p>";
	echo "<p>$sx</p>";
?>

<?php
	//Operator Types
	//Operator precedence = PEMDAS MOTHAFUCKAAA
	//Ternary Operator example CAREFUL OF OPERATOR PRECEDENCE BITCH
	$hours = 24;
	$payrate = 10;
	$paycheck = $hours < 0 ? 0 : 
				($hours >= 20 ? 20 * $payrate + 2 * ($hours - 20) * $payrate : $hours * $payrate);
	echo "<p>Paycheck = $$paycheck</p>";
	
	/*
		HOMEWORK:
		Input a score from 1-100, and ouput a grade on the standard grading scale.
	*/
	$score = 90;
	$grade = $score < 60 ? "F" :
			 ($score < 70 ? "D" :
			 ($score < 80 ? "C" :
			 ($score < 90 ? "B" : "A")));
	echo "<p> Your grade is ".$grade.".</p>";
?>

</body>


</html>
