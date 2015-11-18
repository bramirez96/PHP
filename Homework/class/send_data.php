<?php #index.php //Just some shit (I want whiskey)
#Day 2... still want some fucking whiskey
//Admins are GOD
//Users, products
//Shopping cart is some products
//An order is a shopping cart + a user
define("DB_NAME", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
$complete = false;
$page_title = "Index";
$user = "User1234";
$content = [];

$error = [
	"fname" => "*",
	"lname" => "*",
	"uname" => "*",
	"email" => "*",
	"pass"  => "*",
	"cpass" => "*",
	"count" => 6
];
//preg_match(regex, string, match array)
foreach ($_POST as $key => $value) {
	if (!empty($_POST[$key])) {
		$error[$key] = "";
		$error['count'] -= 1;
	}
}
if ($error['count'] === 0) {
	$complete = true;
}
if (!$complete) {
	$content['login'] = <<<_END
<form method="post" action="send_data.php">
	<h1>Log In:</h1>
	<table id="login">
		<thead>
			<tr>
				<td colspan="2" class="red">You didn't input all form data!</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>First Name:</td>
				<td>
					<input type="text" name="fname" value="{$_POST['fname']}" />
					<span class="red">{$error['fname']}</span>
				</td>
			</tr>
			<tr>
				<td>Last Name:</td>
				<td>
					<input type="text" name="lname" value="{$_POST['lname']}" />
					<span class="red">{$error['lname']}</span>
				</td>
			</tr>
			<tr>
				<td>Username:</td>
				<td>
					<input type="text" name="uname" value="{$_POST['uname']}" />
					<span class="red">{$error['uname']}</span>
				</td>
			</tr>
			<tr>
				<td>Email:</td>
				<td>
					<input type="text" name="email" value="{$_POST['email']}" />
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
} else {
	//Run through regex and post to databse HERE
	$content['login'] = "You 've successfully signed up.";
}
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