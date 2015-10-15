<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>BrandonBook</title>
		<?php
			/**
			* Brandon Ramirez
			* 9/30/15
			* Purpose: Try to make some semblance of a working social network
			*/
			include "class/user.php";
		?>
	</head>
	<body>
		<?php
			
			
		?>
		<form action="register_success.php" method="post">
			<table>
				<tr>
					<td>Name:</td>
					<td><input type="text" name="name"></td>
				</tr>
				<tr>
					<td>Email:</td>
					<td><input type="email" name="email"></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="password" name="password"></td>
				</tr>
				<tr>
					<td>Verify Password:</td>
					<td><input type="password" name="vPassword"></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit"></td>
				</tr>
			</table>
		</form>
		<?php
			
		?>
	</body>
</html>