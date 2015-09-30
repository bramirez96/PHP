<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>The Electromagnetic Spectrum (3)</title>
		<?php
			/*
				Brandon Ramirez	
				CIS-12 PHP Programming
				09/28/2015 v1.0
				Purpose: To create a table classifying electromagnetic wavelengths
			*/
			function makeArray($anArray = []) {
				$anArray = [[], [], []];
				for ($index=1, $wave=3; $wave>=-12; $index++, $wave--) {
					array_push($anArray[0], $index);
					array_push($anArray[1], $wave);
					array_push($anArray[2], $wave<=  3 && $wave>= 1 ? "Radio" :(
											$wave<=  0 && $wave>=-3 ? "Microwave" :(
											$wave<= -4 && $wave>=-5 ? "Infrared" :(
											$wave== -6				? "Visiable" :(
											$wave== -7				? "Visiable Ultraviolet" :(
											$wave== -8				? "Ultraviolet" :(
											$wave== -9				? "Ultraviolet X-Ray" :(
											$wave==-10				? "X-Ray" :(
											$wave==-11				? "Gamma X-Ray" :(
																	  "Gamma Ray"))))))))));
				}
				return $anArray;
			}
			function makeTBody($anArray) {
				for ($i = 0; $i < count($anArray[0]); $i++) {
					echo "<tr>";
					echo "<td>".$anArray[0][$i]."</td>";
					echo "<td>10<span class='sup'>".$anArray[1][$i]."</span></td>";
					echo "<td>".$anArray[2][$i]."</td>";
					echo "</tr>";
				}
			}
		?>
		<style type="text/css">
			table {
				border-collapse: collapse;
			} table tbody tr td, table thead tr th {
				font-family: Arial, sans-serif;
				font-size: .8em;
				font-weight: 700;
				text-align: center;
				padding: 10px 15px;
				border: 1px solid #000;
			} table thead tr th {
				font-size: 1em;
				background-color: #000;
				color: #fff;
			} table tbody tr:nth-child(even) {
				background-color: #ccc;
			} .sup {
				font-size: smaller;
				vertical-align: super;
			}
		</style>
	</head>
	<body>
		<table>
			<thead>
				<tr>
					<th>Row</th>
					<th>Wavelength</th>
					<th>Band</th>
				</tr>
			</thead>
			<tbody>
				<?php
					makeTBody(makeArray());
				?>
			</tbody>
		</table>
	</body>
</html>