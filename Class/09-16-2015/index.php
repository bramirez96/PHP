<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Looping... I Think?</title>
		<?php
			/*
				Brandon Ramirez
				CIS12 - PHP Programming
				09/16/2015 Version 1.0
				Content: DeMorgan's Law, boolean expression examples, Adaptable Nested Switch Statement
			*/
		?>
	</head>
	<body>
	
		<?php
			/*
				For x = T and y = F
				x^y = T
				x^y^x = F
				x^y^y = T
				
				DeMorgan's Law:
					!(x && y) = !x || !y
					!(x || y) = !x && !y
			*/
			
			//FLUID CODING, CAN TAKE ANY VALUES MOTHAFUCKA
			//Declare boring variable things
			$hours   = 15;
			$rate    = 15; //Given in $/hr
			$dblTime = 20;
			$trpTime = 40;
			switch ($hours < 0) {
				case true:
					echo "Invalid hours entered!";
					break;
				case false:
					switch ($hours <= $dblTime) {
						case true:
							//Straight Time
							$amount = $hours * $rate;
							break;
						case false:
							switch ($hours < $trpTime) {
								case true:
									//Double Time
									$amount = ($dblTime * $rate) + (($hours - $dblTime) * $rate * 2);
									break;
								case false:
									//Triple Time
									$amount = ($dblTime * $rate) + (($trpTime - $dblTime) * $rate * 2) + ($hours - $trpTime) * $rate * 3;
							};
					};
			};
			/*
			
				Redo your code so that it takes input values for all of the variables.
				Make sure it's fluid and can be modified with relative ease.
			
			*/
		?>
	
	</body>
</html>