<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Practice</title>
		<?
			/*
				Brandon Ramirez
				RCC PHP Class
				Version 1.0
				Purpose: Switch case example.
			*/
		?>
	</head>
	
	<body>
		<?php
			//Switch statement, mothafucka
			$score = 83;
			if ($score >= 0 && $score <= 100) {
				$iscore = (int)($score/10);
				switch ($iscore) {
					case 9:
						$grade = "A";
						break;
					case 8:
						$grade = "B";
						break;
					case 7:
						$grade = "C";
						break;
					case 6:
						$grade = "D";
						break;
					case 5:
					case 4:
					case 3:
					case 2:
					case 1:
					case 0:
						$grade = "F";
						break;
					default:
						$grade = "INVALID";
				};
			}
			else {
				$grade = "INVALID";
			}
			echo $grade;
			/*
				HOMEWORK:
				Straight time is 20 hours, double time at 40 hours, anything above it triple time.
				COULD be done in a switch statement? omg he said use if, if-else, switch, and ternary op
			*/
		?>
	</body>
</html>