<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Interest Table</title>
		<?php
			/*
				Brandon Ramirez
				CIS12 - PHP Programming
				09/21/2015 v2.0
				Purpose: To make a super flexible table that takes cool inputs and makes different tables
			*/
		?>
		<style type="text/css">
			table {
				border-collapse: collapse;
				font-family: Arial;
			} table tr:nth-child(odd) {
				background-color: #ccc;
			} table tr th, table tr td {
				border: 1px solid #000;
				padding: 5px 10px;
				text-align: center;
				font-size: .8em;
				font-weight: 700;
			} table tr th {
				background-color: #000;
				color: #fff;
				font-size: 0.9em;
			}
		</style>
	</head>
	<body>
		<table>
			<?php
				//Declare Variables
				$prin     = 100; //Principal value
				$nYears   =  50;  //Number of years accruing interest
				$intBegin = .05;
				$intEnd   =  .1;
				$intInc   = .01;
				$index    =   0; //REPRESENTS COLUMNS IN LATER EXPRESSIONS
				//Declare arrays
				$iRate   = array();
				$savings = array(); //Dimension for year
				//Fill arrays
				for ($index = 0, $int = $intBegin; $int <= $intEnd; $index++, $int += $intInc) {
					$iRate[$index] = $int;
					$savings[$index] = array();//Initializes savings as a 2d array for interest
					/****
						For every dimension of the index, create an array in savings
						THESE ARRAYS REPRESENT EACH OF THE COLUMNS
						AND IT MAKES THEM PARALLEL
					****/
				}
				//The following code 
				for ($year = 0; $year <= $nYears; $year++) {
					for ($index = 0, $int = $intBegin; $int <= $intEnd; $index++, $int += $intInc) {
						$savings[$index][$year] = $prin * pow((1 + $iRate[$index]), $year);
						//array,  col,    row
						$savings[$index][$year] = number_format($savings[$index][$year], 2, ".", "");
					}
				}
				echo "<tr>
						<th>Years</th>";
				for ($index = 0, $int = $intBegin; $int <= $intEnd; $index++, $int += $intInc) {
					echo "<th>".($iRate[$index] * 100)."% Savings</th>";
				}
				echo "</tr>";
				for ($year = 0; $year <= $nYears; $year++) {
					echo "<tr>
							<td>".($year)."</td>";
							for ($index = 0; $index < count($savings); $index++) {
								echo "<td>$".(number_format($savings[$index][$year], 2))."</td>";
							}
						 "</tr>";
				}
				/*
					$index = 0, $int = $intBegin; $int <= $intEnd; $index++, $int += $intInc
					use array indices, and start from beginning integer, end on end integer
					
				*/
			?>
			</table>
	</body>
</html>