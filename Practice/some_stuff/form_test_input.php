<?php # checking how text inputs nested in radio buttons work
if (empty($_POST)) {
	echo "
	<form action=\"./form_test_input.php\" method=\"POST\">
		<label>
			<input type=\"radio\" name=\"check\" value=\"1\" />
			&nbsp;Answer 1
		</label><br />
		<label>
			<input type=\"radio\" name=\"check\" value=\"2\" />
			&nbsp;Answer 2
		</label><br />
		<label>
			<input type=\"radio\" name=\"check\" value=\"3\" />
			<input type=\"text\" name=\"other_check\" />
		</label><br />
		<br />
		<br />
		<label>
			<input type=\"checkbox\" name=\"stuff[]\" value=\"first\" />
			Hahahahaha
		</label><br />
		<label>
			<input type=\"checkbox\" name=\"stuff[]\" value=\"second\" />
			Some tits
		</label><br />
		<label>
			<input type=\"checkbox\" name=\"stuff[]\" value=\"third\" />
			More tits
		</label><br />
		<label>
			<input type=\"checkbox\" name=\"stuff[]\" value=\"OTHER\" />
			Other:<input type=\"text\" name=\"other_stuff\"/>
		</label><br />
		<input type=\"submit\" />
	</form>";
} else {
	echo "<pre>";
	print_r($_POST);
	if ($_POST['check'] == 3) {
		echo $_POST['other_check'];
	} else {
		echo $_POST['check'];
	}
	echo "<br />";
	$x = (count($_POST['stuff']) - 1);
	if ($_POST['stuff'][$x] === "OTHER") {
		foreach ($_POST['stuff'] as $key => $value) {
			if ($key == $x) echo $_POST['other_stuff'];
			else echo $value;
			echo "<br />";
		}
	} else {
		foreach ($_POST['stuff'] as $value) {
			echo $value . "<br />";
		}
	}
	echo "</pre>";
}
$x = 5;
?>