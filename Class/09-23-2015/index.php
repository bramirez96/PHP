<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Arrays</title>
		<!--
			Brandon Ramirez
			CIS12 - PHP Programming
			09/23/2015 v1.5
			Purpose: It's like a kind of alright thing, but it could be more
		-->
		<style type="text/css">
			table {
				border-collapse: collapse;
			} table tr th, table tr td {
				font-family: Arial, sans-serif;
				padding: 5px 20px;
				border: 1px solid #000;
				text-align: center;
				font-size: .8em;
				font-weight: 700;
			} table tr th {
				background-color: #000;
				color: #fff;
				font-size: 1em;
			} table tr:nth-child(odd) {
				background-color: #ccc;
			}
		</style>
	</head>
	<body>
		<?php
			//Declare variables
			$nYears =  50;
			$iRate  = .06;
			$prin   = 100;
			//Declare parallel arrays
			$years   = array();
			$savings = array();
			//Fill arrays
			for ($year = 0; $year <= $nYears; $year++) {
				$years[$year]   = $year;
				$savings[$year] = $prin * pow((1 + $iRate), $year);
				$savings[$year] = number_format($savings[$year], 2, ".", "");
			}
			//Create table and headings
			echo "<table>";
			echo "<tr>
					<th>Year</th>
					<th>Savings</th>
				  </tr>";
			for ($year = 0; $year <= $nYears; $year++) {
				echo "<tr>";
					echo "<td>".$years[$year]."</td>";
					echo "<td>$".$savings[$year]."</td>";
				echo "</tr>";
			}
			//End table
			echo "</table>";
			/*
				Homework: Make the interest table a monthly thing
			*/
		?>
	</body>
</html>