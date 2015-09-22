<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Interest Table</title>
		<?php
			/*
				Brandon Ramirez
				CIS12 - PHP Programming
				09/21/2015 v1.2
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
				$x1	= $x2 = $x3	= $x4 = $x5 = $x6 = $prin; //Initialize variables for each column to $prin value
				$i1 = .05; //Interest values for each column
				$i2 = .06;
				$i3 = .07;
				$i4 = .08;
				$i5 = .09;
				$i6 = .10;
				//Create table head
				echo "<tr>
						<th>Years</th>
						<th>At ".($i1 * 100)."%</th>
						<th>At ".($i2 * 100)."%</th>
						<th>At ".($i3 * 100)."%</th>
						<th>At ".($i4 * 100)."%</th>
						<th>At ".($i5 * 100)."%</th>
						<th>At ".($i6 * 100)."%</th>
					  </tr>";
				for ($year = 1; $year <= $nYears; $year++) {
					//Accrue Interest!
					$x1 *= (1 + $i1);
					number_format($x1, 2, ".", "");
					$x2 *= (1 + $i2);
					number_format($x2, 2, ".", "");
					$x3 *= (1 + $i3);
					number_format($x3, 2, ".", "");
					$x4 *= (1 + $i4);
					number_format($x4, 2, ".", "");
					$x5 *= (1 + $i5);
					number_format($x5, 2, ".", "");
					$x6 *= (1 + $i6);
					number_format($x6, 2, ".", "");
					//Output values to table body
					echo "<tr>
							<td>$year</td>
							<td>$".number_format($x1, 2)."</td>
							<td>$".number_format($x2, 2)."</td>
							<td>$".number_format($x3, 2)."</td>
							<td>$".number_format($x4, 2)."</td>
							<td>$".number_format($x5, 2)."</td>
							<td>$".number_format($x6, 2)."</td>
						  </tr>";
				}
			?>
			</table>
	</body>
</html>