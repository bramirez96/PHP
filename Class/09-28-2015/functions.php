<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Functions</title>
		<?php
			/*
				Brandon Ramirez
				CIS-12 PHP Programming
				09/28/2015 v1.0
				Purpose: To utilize functions
			*/
			function save1($pv, $int, $n) {
				for ($year = 1; $year <= $n; $year++) {
					$pv *= 1 + $int;
				}
				return $pv;
			}
			function save2($pv, $int, $n) {
				return $pv*pow(1+$int, $n);
			}
			function save3($pv, $int, $n) {
				return $pv*exp($n * log(1 + $int));
			}
			function save4($pv, $int, $n) {
				if ($n <= 0)return $pv;
				return save4($pv, $int, $n-1) * (1 + $int);
			}
			function save5($pv, $n, $int = .06) {
				for ($year = 1; $year <= $n; $year++) {
					$pv *= 1 + $int;
				}
				return $pv;
			}
			function save6($pv, $int, $n, &$fv) {
				$fv = $pv * exp($n * log(1 + $int));
			}
			function save7($pv, $int, $n) {
				//Declare an array
				$fv = [$pv];
				//Fill array
				for ($year = 1; $year <= $n; $year++) {
					$fv[$year] = $fv[$year - 1] * (1 + $int);
				}
				return $fv;
			}
			function disp7($anArray) {
				echo "<table>";
				echo "<tr><th>Year</th><th>Savings</th></tr>";
				for ($year = 0; $year < count($anArray); $year++) {
					echo "<tr>";
					echo "<td>$year</td>";
					echo "<td>".number_format($anArray[$year], 2)."</td>";
					echo "</tr>";
				}
				echo "</table>";
			}
		?>
	</head>
	<body>
		<?php
			//Declare variables
			$pv     = 100; //Present value in $
			$int    = .06; //Interest rate
			$nYears =  50; //Number of compunding periods in years
			$f1     = save1($pv, $int, $nYears);
			$f2     = save2($pv, $int, $nYears);
			$f3     = save3($pv, $int, $nYears);
			$f4     = save4($pv, $int, $nYears);
			$f5     = save5($pv, $nYears);
			$f6;
			save6($pv, $int, $nYears, $f6);
			echo "<p>Present Value = $$pv</p>";
			echo "<p>Interest Rate = ".($int * 100)."%</p>";
			echo "<p>Number of Years = $nYears</p>";
			echo "<p>Future Value 1 = $".number_format($f1, 2)."</p>";
			echo "<p>Future Value 2 = $".number_format($f2, 2)."</p>";
			echo "<p>Future Value 3 = $".number_format($f3, 2)."</p>";
			echo "<p>Future Value 4 = $".number_format($f4, 2)."</p>";
			echo "<p>Future Value 5 = $".number_format($f5, 2)."</p>";
			echo "<p>Future Value 6 = $".number_format($f6, 2)."</p>";
			disp7(save7($pv, $int, $nYears));
		?>
	</body>
</html>