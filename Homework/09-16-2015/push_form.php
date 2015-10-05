<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Paycheck</title>
		<!--
			
			Brandon Ramirez
			CIS12 - PHP Programming
			09-15-2015 Version 1.0
			Purpose: To demonstrate understanding of conditional statements in PHP
			
		-->
	</head>
	<body>
		
		<p>
			<?php
				$wage = 15; //Given in $/hr
				$x 	  = $_POST["hours"];
				if 		(!is_numeric($x)) $str = "You did not enter a number!"; //Checks if input is a number
				else if ($x < 0)          $str = "You did not enter a valid number!"; //Checks if input is positive integer
				else if ($x >= 168)       $str = "You can't work that much in a week!";
				else {
					$amt = ($x <= 20) ? $x * $wage 						   : (
					       ($x <= 40) ? ($x - 20) * $wage * 2 + 20 * $wage : (
						   				($x - 40) * $wage * 3 + 20 * $wage * 2 + 20 * $wage));
					$str = "You made $".$amt." this week! Go you!";
				}
				echo $str;
			?>
		</p>
		
	</body>
</html>