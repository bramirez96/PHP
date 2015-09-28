<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>The Electromagnetic Spectrum (1)</title>
		<?php
			/*
				Brandon Ramirez	
				CIS-12 PHP Programming
				09/28/2015 v1.0
				Purpose: To create a table classifying electromagnetic wavelengths
			*/
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
		<?php
			echo "<table><tr><th>Row</th><th>Wavelength</th><th>Band</th></tr>";
			for ($index=1,$wave=3;$wave>=-12;$index++,$wave--) {
				echo "<tr><td>$index</td>";
				echo "<td>10<span class='sup'>$wave</span></td>";
				echo $wave<=  3 && $wave>= 1 ? "<td>Radio</td>" :(
				     $wave<=  0 && $wave>=-3 ? "<td>Microwave</td>" :(
					 $wave<= -4 && $wave>=-5 ? "<td>Infrared</td>" :(
					 $wave== -6				 ? "<td>Visiable</td>" :(
					 $wave== -7				 ? "<td>Visiable Ultraviolet</td>" :(
					 $wave== -8				 ? "<td>Ultraviolet</td>" :(
					 $wave== -9				 ? "<td>Ultraviolet X-Ray</td>" :(
					 $wave==-10				 ? "<td>X-Ray</td>" :(
					 $wave==-11				 ? "<td>Gamma X-Ray</td>" :(
											   "<td>Gamma Ray</td>")))))))));
			}
			echo "</table>";
		?>
	</body>
</html>