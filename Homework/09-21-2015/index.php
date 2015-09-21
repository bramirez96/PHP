<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Interest Table</title>
		<?php
			/*
				Brandon Ramirez
				CIS12 - PHP Programming
				09/21/2015 v1.0
				Purpose: To create a table that returns amount after interest
			*/
		?>
		<style type="text/css">
			table {
				border-collapse: collapse;
				font-family: Arial;
			} table tr:nth-child(even) {
				background-color: #ccc;
			} table tr th, table tr td {
				border: 1px solid #000;
				padding: 10px 15px;
				text-align: center;
				font-size: .8em;
				font-weight: 700;
			} table tr th {
				background-color: #000;
				color: #fff;
				font-size: 1em;
			}
		</style>
	</head>
	<body>
		<table> <!-- Don't forget! -->
			<?php
				//Declare Variables
				$prin   = 100; //Principal value
				$nYears = 50;  //Number of years accruing interest
				$x5		= $prin; 
				$x6		= $prin; //Initializing principals for each column
				$x7		= $prin; //based off of the original principal
				$x8		= $prin; //value for easy changing and debugging.
				$x9 	= $prin;
				$x0		= $prin;
				//Not putting interest values into a variable, 
				//since they are decalred in table head as set
				//Create table head
				echo "<tr>
						<th>Years</th>
						<th>At 5%</th>
						<th>At 6%</th>
						<th>At 7%</th>
						<th>At 8%</th>
						<th>At 9%</th>
						<th>At 10%</th>
					  </tr>";
				for ($year = 1; $year <= $nYears; $year++) {
					//Accrue Interest!
					$x5 *= (1 + 0.05);
					number_format($x5, 2, ".", "");
					$x6 *= (1 + 0.06);
					number_format($x6, 2, ".", "");
					$x7 *= (1 + 0.07);
					number_format($x7, 2, ".", "");
					$x8 *= (1 + 0.08);
					number_format($x8, 2, ".", "");
					$x9 *= (1 + 0.09);
					number_format($x9, 2, ".", "");
					$x0 *= (1 + 0.10);
					number_format($x0, 2, ".", "");
					//Output values to table body
					echo "<tr>
							<td>$year</td>
							<td>$".number_format($x5, 2)."</td>
							<td>$".number_format($x6, 2)."</td>
							<td>$".number_format($x7, 2)."</td>
							<td>$".number_format($x8, 2)."</td>
							<td>$".number_format($x9, 2)."</td>
							<td>$".number_format($x0, 2)."</td>
						  </tr>";
				}
			?>
			</table>
	</body>
</html>