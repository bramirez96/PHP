<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Savings While Loop</title>
		<?php
			/*
				Brandon Ramirez
				CIS12 - PHP Programming
				09/21/2015 v1.1
				Purpose: To demonstrate understanding of loop statements
			*/
		?>
		<style type="text/css">
			table {
				border-collapse: collapse;
				font-family: "Arial", sans-serif;
				font-weight: 700;
			}
			table tr td, table tr th {
				border: 1px solid black;
				padding: 5px 20px;
				text-align: center;
				font-size: .8em;
			}
			table tr th {
				font-size: 16px;
				background-color: #000;
				color: #fff;
				border-width: 0 1px;
			}
		</style>
	</head>
	<body>
		<?php
			//Declare variables
			$prin   = 100;	//Principle balance given in $
			$nYears = 50;	//Number of years in table
			$iRate  = 0.06; //Interest rate
			//Create headings in table
			echo "<table>";
			echo "<tr>
					<th>Years</th>
					<th>". $iRate*100 ."% Savings</th>
				  </tr>";
			//Populate table with information using a for loop
			$year = 0;
			while (++$year <= $nYears) {
				$prin 	*= (1 + $iRate);
				$output = number_format($prin, 2);
				echo "<tr>
						<td>$year</td>
						<td>$$output</td>
					  </tr>";
			};
			echo "</table>";
		?>
	</body>
</html>