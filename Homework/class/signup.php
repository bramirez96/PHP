<?php #index.php //Just some shit (I want whiskey)
#Day 2... still want some fucking whiskey

//Define database info
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "brandon");

//
$page_title = "Sign Up";
$user = "Guest";

function clean_str(&$x) {
	$x = filter_var($x, FILTER_SANITIZE_STRING);
	echo $x;
	$x = preg_replace("/[^a-zA-Z0-9'\-]/", '', $x);
	echo $x;
}
if (!empty($_POST)) { //Run this if form was submitted
	include('./db_connect.php');
	if (isset($_POST['email'])) {
		$_POST['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
		$_POST['email'] = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
		$sql = "SELECT email FROM brandon.entity_users WHERE email = '{$_POST['email']}'";
		$response = $connect->query($sql);
		if ($response->num_rows != 0) { //Do this if email is taken
			$error['extras'] = "<br />Email already in use!";
			$_POST['email'] = "";
		} else {
			$error['extras'] = "";
		}
	}
	if (!empty($_POST['uname'])) {
		clean_str($_POST['uname']);
		$sql = "SELECT username FROM brandon.entity_users WHERE username = '{$_POST['uname']}'";
		$response = $connect->query($sql);
		if ($response->num_rows != 0) {
			$error['extras'] .= "<br />Username already in use!";
			$_POST['uname'] = "";
		}
	}
	if (!empty($_POST['fname'])) clean_str($_POST['fname']);
	if (!empty($_POST['lname'])) clean_str($_POST['lname']);
	if (!empty($_POST['pass']) && !empty($_POST['cpass'])) {
		if ($_POST['pass'] != $_POST['cpass']) {
			$_POST['cpass'] = "";
			$error['extras'] .= "<br />Passwords don't match!";
		}
	}
	$error['display'] = "table-header-group";
	foreach ($_POST as $key => $value) {
		if (empty($value)) {
			$error[$key] = "*";
			$content[$key] = "";
		} else {
			$error[$key] = "";
			$content[$key] = trim($value);
			if (!isset($content['count'])) $content['count'] = 1;
			else $content['count'] += 1;
		}
	}
	if ($content['count'] === 7) {
		//DATABASE SHIT BECAUSE THEY FINALLY FUCKING FILLED IT OUT RIGHT
		$sql = "INSERT INTO entity_users (firstname, lastname, username, email, password) " .
			"VALUES ('{$content['fname']}', '{$content['lname']}', '{$content['uname']}', '{$content['email']}', SHA1('{$content['pass']}'))";
		if (!$result = $connect->query($sql)) {
			echo "Query error: " . $connect->error;
		} else {
			echo "You did it";
		}
	}
} else { //If post is empty
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
		"display" => "none",
		"extras" => ""
	];
}







$content['login'] = <<<_END
<form method="post" action="./signup.php">
	<input type="hidden" name="posted" value="TRUE" />
	<h1>Sign Up:</h1>
	<table id="login">
		<thead style="display: {$error['display']}">
			<tr>
				<td colspan="2" class="red">You didn&rsquo;t input valid form data! {$error['extras']}</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>First Name:</td>
				<td>
					<input type="text" name="fname" value="{$content['fname']}" />
					<span class="red">{$error['fname']}</span>
				</td>
			</tr>
			<tr>
				<td>Last Name:</td>
				<td>
					<input type="text" name="lname" value="{$content['lname']}" />
					<span class="red">{$error['lname']}</span>
				</td>
			</tr>
			<tr>
				<td>Username:</td>
				<td>
					<input type="text" name="uname" value="{$content['uname']}" />
					<span class="red">{$error['uname']}</span>
				</td>
			</tr>
			<tr>
				<td>Email:</td>
				<td>
					<input type="text" name="email" value="{$content['email']}" />
					<span class="red">{$error['email']}</span>
				</td>
			</tr>
			<tr>
				<td>Password:</td>
				<td>
					<input type="password" name="pass" />
					<span class="red">{$error['pass']}</span>
				</td>
			</tr>
			<tr>
				<td>Confirm Password:</td>
				<td>
					<input type="password" name="cpass" />
					<span class="red">{$error['cpass']}</span>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" />
				</td>
			</tr>
		</tbody>
	</table>
</form>
_END;
$content['module1'] = "Whoa";
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