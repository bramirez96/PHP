<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>What's Your Grade?</title>
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
