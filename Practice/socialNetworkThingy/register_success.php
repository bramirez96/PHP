<?php
if (!isset($_POST['name'], $_POST['email']) || $_POST['password'] != $_POST['vPassword']) {
	header("Location: ./index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>You're Registered!</title>
		<?php
			/**
			* Brandon Ramirez
			* 10/2/15
			* Purpose: Return information from $_POST variable if registration is successful, otherwise return to other page
			*/
		?>
	</head>
	<body>
		
	</body>
</html>