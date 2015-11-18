<?php #index.php //Just some shit (I want whiskey)
#Day 2... still want some fucking whiskey
//Admins are GOD
//Users, products
//Shopping cart is some products
//An order is a shopping cart + a user
define("DB_NAME", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
$page_title = "Index";
$user = "User1234";
$content = [];

$content['login'] = <<<_END
<form method="post" action="send_data.php">
	<h1>Log In:</h1>
	<table id="login">
		<tbody>
			<tr>
				<td>First Name:</td>
				<td>
					<input type="text" name="fname" />
				</td>
			</tr>
			<tr>
				<td>Last Name:</td>
				<td>
					<input type="text" name="lname" />
				</td>
			</tr>
			<tr>
				<td>Username:</td>
				<td>
					<input type="text" name="uname" />
				</td>
			</tr>
			<tr>
				<td>Email:</td>
				<td>
					<input type="text" name="email" />
				</td>
			</tr>
			<tr>
				<td>Password:</td>
				<td>
					<input type="password" name="pass" />
				</td>
			</tr>
			<tr>
				<td>Confirm Password:</td>
				<td>
					<input type="password" name="cpass" />
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