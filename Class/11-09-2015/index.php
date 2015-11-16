<?php # Script Whatever - index.php #
//SESSION STUFF
//Always start the session IMMEDIATELY
if (false) {
	session_start(); //BUILT IN TO PHP
	//Every page that opens, you have to immediately START THE SESSION
	if (!isset($_SESSION['user_id'])) {
		echo "You're not logged in breh";
	} else {
		$_SESSION['user_id'] = $some_array_of_values_from_db['user_id'];
		$_SESSION['first_name'] = $yada['name'];
	}
}
function end_session_securely() {
	$_SESSION = array();
	session_destroy();
	setcookie('PHPSESSID', '', time() - 3600, '/', '', 0, 0);
}
function login_to_things() {
	session_start();
	
}
function notes() {
	echo "Show all the tables in the admin page";
	echo "Tables need to be editable";
	echo "Before surveys were running, you could edit it, afterwords can't delete questions";
	echo "You can, however, checnge spelling or reword it?";
	echo "Do u have the time breh?"
}
//Vars
$page_title = 'Heck yes';
$page_content = "Wtf man";
//Protips for making your sites
function redirect_user($page = "./index.php") {
	$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
	//Then trim it
}
function check_login($dbc, $email = '', $pass = '') {
	if(empty($email)) {
		$errors[] = "You forgot to enter email";
	}
	$q = "SELECT user_id, first_name FROM users WHERE email='$e' AND pass=SHA1('$p')";
	$r = @mysqli_query($dbc, $q);
}
function set_a_cookie($name, $value) {
	setcookie('name', 'value');
	setcookie($name, $value, time() + 3600, "/", "", 0, 0);
}
function check_login_status() {
	if (!isset($_COOKIE['user_id'])) {
		//require script file with redirect in it
		redirect_user();
	}
}


//Set one cookie that tells if a user is logged in
//Set another cookie that tells if a user is admin
echo <<< _END
	<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="utf-8" />
			<title>$page_title</title>
		</head>
		<body>
			<p>
				$page_content
			</p>
		</body>
	</html>
_END;
?>