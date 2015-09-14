<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>What's Your Grade?</title>
	<?php
		/*
			Brandon Ramirez
			Version 1.2
			Create a line of code using ternary operators that takes a number 0-100 and returns a string value with a letter grade.
		*/
	?>
</head>
<body>

<?php
	$score = 100;
	$grade = $score < 60 ? "an F" : (
	         $score < 70 ? "a D"  : (
	         $score < 80 ? "a C"  : (
			 $score < 90 ? "a B"  : 
                           "an A")));
	echo "<p> Your grade is ".$grade.".</p>";
	//Function Version
	function getGrade($score) {
		$grade = $score < 60 ? "an F" : (
				 $score < 70 ? "a D"  : (
				 $score < 80 ? "a C"  : (
				 $score < 90 ? "a B"  : 
							   "an A")));
		echo "<p> Your grade is $grade.</p>";
	}
	getGrade(74);
?>

</body>


</html>
