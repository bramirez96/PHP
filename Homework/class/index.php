<?php #index.php //Just some shit (I want whiskey)
#Day 2... still want some fucking whiskey

//Define database info
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "brandon");

//
$page_title = "Home";
$user = "Guest";

if (!empty($_POST)) { //Checks if the page was submitted or loaded from a link
	//!Insert form validation here
	$error['display'] = "table-header-group";
	foreach ($_POST as $key => $value) {
		if (empty($value)) {
			$error[$key] = "*";
			$content[$key] = "";
		} else {
			$error[$key] = "";
			$content[$key] = $value;
			if (!isset($content['count'])) $content['count'] = 1;
			else $content['count'] += 1;
		}
	}
	if ($content['count'] === 7) {
		//DATABASE SHIT BECAUSE THEY FINALLY FUCKING FILLED IT OUT RIGHT
		include('./db_connect.php');
		$sql = "INSERT INTO entity_users (firstname, lastname, username, email, password) " .
			"VALUES ('{$content['fname']}', '{$content['lname']}', '{$content['uname']}', '{$content['email']}', SHA1('{$content['pass']}'))";
		if (!$result = $connect->query($sql)) {
			die("Query error: " . $connect->error);
		} else {
			die("You did it");
		}
	}
} else {
	$content = [
		"fname" => "",
		"lname" => "",
		"uname" => "",
		"email" => ""	
	];
	$error = [
		"fname" => "",
		"lname" => "",
		"uname" => "",
		"email" => "",
		"pass"  => "",
		"cpass" => "",
		"display" => "none"
	];
}







$content['login'] = "Insert login shit here";
$content['module1'] = "<a href='./signup.php'>Sign Up</a>";
$content['module3'] = "<p>Another paragraph</p>";
include("./header.php");
//Put the inside of the #container tag in the following thingy
echo <<<_END
	<div class="grid clearfix">
		<div class="col-1-4">
			{$content['module1']}
		</div>
		<div class="col-1-2">
			{$content['login']}
		</div>
		<div class="col-1-4">
			{$content['module3']}
		</div>
	</div>
_END;
include("./footer.php");
?>