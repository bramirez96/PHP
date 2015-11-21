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







$content['login'] = <<<_END
<form method="post" action="./signup.php">
	<input type="hidden" name="posted" value="TRUE" />
	<h1>Sign Up:</h1>
	<table id="login">
		<thead style="display: {$error['display']}">
			<tr>
				<td colspan="2" class="red">You didn&rsquo;t input valid form data!</td>
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