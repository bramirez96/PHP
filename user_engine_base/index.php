<?php #index.php //Just some shit (I want whiskey)
#Day 2... still want some fucking whiskey

//Define database info
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "brandon");

session_start();
//
$page_title = "Home";
$user = "Guest";

if (isset($_SESSION['user'])) {
	$_POST = [];
	$user = $_SESSION['user'];
}
if (!empty($_POST)) { //Checks if the page was submitted or loaded from a link
	//FORM VALIDATION
	include('./db_connect.php');	
	
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
	if ($content['count'] === 2) {
		$sql = "SELECT password, username, firstname FROM brandon.entity_users WHERE email = '{$content['email']}'";
		if ($response = $connect->query($sql)) {
			if ($response->num_rows != 0) {
				while ($row = $response->fetch_assoc()) {
					//Check to see if this shit is working
					if ($row['password'] === sha1($content['pass'])) {
						$_SESSION['user'] = $row['username'];
						$_SESSION['name'] = $row['firstname'];
					}
				}
				$response->free();
			} else {
				echo "Invalid email";
			}
		}
	}
} else {
	$content = [
		"email" => ""	
	];
	$error = [
		"email" => "",
		"pass"  => "",
		"extras" => ""
	];
}



if (!isset($_SESSION['user'])) { //!Change - if session variable for user is set
	$content['login'] = <<<_END
<form method="post" action="./index.php">
	<h1>Log In:</h1>
	<table id="login">
		<tbody>
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
				<td colspan="2">
					<input type="submit" />
				</td>
			</tr>
		</tbody>
	</table>
</form>
_END;
} else { //If user is logged in
	$content['login'] = <<<_END
<h1>Welcome, {$_SESSION['name']}!</h1>
<p>
	A paragraph.
</p>
_END;
}
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