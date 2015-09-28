<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>The Electromagnetic Spectrum (2)</title>
		<?php
			/*
				Brandon Ramirez	
				CIS-12 PHP Programming
				09/28/2015 v1.0
				Purpose: To create a table classifying electromagnetic wavelengths
			*/
			//Declare Arrays
			$row  = [];
			$len  = [];
			$band = [];
			for ($index=1,$wave=3;$wave>=-12;$index++,$wave--) {
				array_push($row, $index);
				array_push($len, $wave);
				array_push($band, $wave<=  3 && $wave>= 1 ? "Radio" :(
								  $wave<=  0 && $wave>=-3 ? "Microwave" :(
								  $wave<= -4 && $wave>=-5 ? "Infrared" :(
								  $wave== -6			  ? "Visiable" :(
								  $wave== -7			  ? "Visiable Ultraviolet" :(
								  $wave== -8			  ? "Ultraviolet" :(
								  $wave== -9			  ? "Ultraviolet X-Ray" :(
								  $wave==-10		  	  ? "X-Ray" :(
								  $wave==-11			  ? "Gamma X-Ray" :(
															"Gamma Ray"))))))))));
			}
		?>
		<style type="text/css">
		table {
			border-collapse: collapse;
		} table tr td, table tr th {
			font-family: Arial, sans-serif;
			font-size: .8em;
			font-weight: 700;
			text-align: center;
			padding: 10px 15px;
			border: 1px solid #000;
		} table tr th {
			font-size: 1em;
			background-color: #000;
			color: #fff;
		} table tr:nth-child(odd) {
			background-color: #ccc;
		} .sup {
			font-size: smaller;
			vertical-align: super;
		}
		</style>
	</head>
	<body>
		<table>
			<tr>
				<th>Row</th>
				<th>Wavelength</th>
				<th>Band</th>
			</tr>
			<?php
				//Output Table
				for ($i = 0; $i < count($row); $i++) {
					echo "<tr>";
					echo "<td>".$row[$i]."</td>";
					echo "<td>10<span class='sup'>".$len[$i]."</span></td>";
					echo "<td>".$band[$i]."</td>";
					echo "</tr>";
				}
			?>
		</table>
	</body>
</html>