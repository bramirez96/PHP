<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Truth Table</title>
			<?php
				/*
					Brandon Ramirez
					CIS12 - PHP Programming
					09/21/2015 v1.0
					Purpose: Demonstrate knowledge of logical operators
				*/
			?>
			<style type="text/css">
				table {
					border-collapse: collapse;
					font-family: "Arial", sans-serif;
					font-weight: 700;
				}
				table tr:first-of-type td {
					font-size: 16px;
					background-color: #000;
					color: #fff;
					border-width: 0 1px;
				}
				table tr td {
					border: 1px solid black;
					padding: 5px 10px;
					text-align: center;
					font-size: .8em;
				}
			</style>
	</head>
	<body>
		<table>
			<tbody>
				<tr>
					<td>X</td>
					<td>Y</td>
					<td>!X</td>
					<td>!Y</td>
					<td>X && Y</td>
					<td>X || Y</td>
					<td>X ^ Y</td>
					<td>X ^ Y ^ Y</td>
					<td>X ^ Y ^ X</td>
					<td>!(X && Y)</td>
					<td>!X || !Y</td>
					<td>!(X || Y)</td>
					<td>!X && !Y</td>
				</tr>
				<tr>
					<?php
						$x = true;
						$y = true;
						echo "<td>".($x?"T":"F")."</td>";
						echo "<td>".($y?"T":"F")."</td>";
						echo "<td>".(!$x?"T":"F")."</td>";
						echo "<td>".(!$y?"T":"F")."</td>";
						echo "<td>".($x && $y?"T":"F")."</td>";
						echo "<td>".($x || $y?"T":"F")."</td>";
						echo "<td>".($x ^ $y?"T":"F")."</td>";
						echo "<td>".($x ^ $y ^ $y?"T":"F")."</td>";
						echo "<td>".($x ^ $y ^ $x?"T":"F")."</td>";
						echo "<td>".(!($x && $y)?"T":"F")."</td>";
						echo "<td>".(!$x || !$y?"T":"F")."</td>";
						echo "<td>".(!($x || $y)?"T":"F")."</td>";
						echo "<td>".(!$x && !$y?"T":"F")."</td>";
					?>
				</tr>
				<tr>
					<?php
						$x = true;
						$y = false;
						echo "<td>".($x?"T":"F")."</td>";
						echo "<td>".($y?"T":"F")."</td>";
						echo "<td>".(!$x?"T":"F")."</td>";
						echo "<td>".(!$y?"T":"F")."</td>";
						echo "<td>".($x && $y?"T":"F")."</td>";
						echo "<td>".($x || $y?"T":"F")."</td>";
						echo "<td>".($x ^ $y?"T":"F")."</td>";
						echo "<td>".($x ^ $y ^ $y?"T":"F")."</td>";
						echo "<td>".($x ^ $y ^ $x?"T":"F")."</td>";
						echo "<td>".(!($x && $y)?"T":"F")."</td>";
						echo "<td>".(!$x || !$y?"T":"F")."</td>";
						echo "<td>".(!($x || $y)?"T":"F")."</td>";
						echo "<td>".(!$x && !$y?"T":"F")."</td>";
					?>		
				</tr>
				<tr>
					<?php
						$x = false;
						$y = true;
						echo "<td>".($x?"T":"F")."</td>";
						echo "<td>".($y?"T":"F")."</td>";
						echo "<td>".(!$x?"T":"F")."</td>";
						echo "<td>".(!$y?"T":"F")."</td>";
						echo "<td>".($x && $y?"T":"F")."</td>";
						echo "<td>".($x || $y?"T":"F")."</td>";
						echo "<td>".($x ^ $y?"T":"F")."</td>";
						echo "<td>".($x ^ $y ^ $y?"T":"F")."</td>";
						echo "<td>".($x ^ $y ^ $x?"T":"F")."</td>";
						echo "<td>".(!($x && $y)?"T":"F")."</td>";
						echo "<td>".(!$x || !$y?"T":"F")."</td>";
						echo "<td>".(!($x || $y)?"T":"F")."</td>";
						echo "<td>".(!$x && !$y?"T":"F")."</td>";
					?>	
				</tr>
				<tr>
					<?php
						$x = false;
						$y = false;
						echo "<td>".($x?"T":"F")."</td>";
						echo "<td>".($y?"T":"F")."</td>";
						echo "<td>".(!$x?"T":"F")."</td>";
						echo "<td>".(!$y?"T":"F")."</td>";
						echo "<td>".($x && $y?"T":"F")."</td>";
						echo "<td>".($x || $y?"T":"F")."</td>";
						echo "<td>".($x ^ $y?"T":"F")."</td>";
						echo "<td>".($x ^ $y ^ $y?"T":"F")."</td>";
						echo "<td>".($x ^ $y ^ $x?"T":"F")."</td>";
						echo "<td>".(!($x && $y)?"T":"F")."</td>";
						echo "<td>".(!$x || !$y?"T":"F")."</td>";
						echo "<td>".(!($x || $y)?"T":"F")."</td>";
						echo "<td>".(!$x && !$y?"T":"F")."</td>";
					?>		
				</tr>
			</tbody>
		</table>
	</body>
</html>