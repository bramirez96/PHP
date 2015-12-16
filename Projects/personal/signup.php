<?php #index.php //Just some shit (I want whiskey)
#Day 2... still want some fucking whiskey

include('./scripts/db_connect.php');

session_start();
//
$page_title = "Sign Up";
$user = "Guest";

if (isset($_SESSION['user'])) {
	$_POST = [];
	$user = $_SESSION['user'];
}

function clean_str(&$x) { //Use this on all the names
	$replace = array(" " => "", "/" => "", "\\" => "", ";" => "", "&#39", "'");
	$x = strtr($x, $replace);
	$x = filter_var($x, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
}
if (!empty($_POST)) { //Run this if form was submitted
	$error['extras'] = "";
	if (!empty($_POST['email'])) {
		$_POST['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
		$_POST['email'] = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
		$sql = "SELECT email FROM 2601166_entity_users WHERE email = '{$_POST['email']}'";
		$response = $connect->query($sql);
		if ($response === null) {
			//Do nothing
		} else if ($response->num_rows != 0) { //Do this if email is taken
			$error['extras'] = "<br />Email already in use!";
			$_POST['email'] = "";
		} else {
			$error['extras'] = "";
		}
	}
	if (!empty($_POST['uname'])) {
		clean_str($_POST['uname']);
		$sql = "SELECT username FROM 2601166_entity_users WHERE username = '{$_POST['uname']}'";
		$response = $connect->query($sql);
		if ($response === null) {
			//Do nothing
		} else if ($response->num_rows != 0) {
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
		foreach ($content as $key => $value) {
			$content[$key] = mysql_real_escape_string($value);
		}
		$sql = "INSERT INTO 2601166_entity_users (firstname, lastname, username, email, password) " .
			"VALUES ('{$content['fname']}', '{$content['lname']}', '{$content['uname']}', '{$content['email']}', SHA1('{$content['pass']}'))";
		if (!$result = $connect->query($sql)) {
			echo "Query error: " . $connect->error;
		}
		$_POST = [];
	}
}
if (empty($_POST)) { //If post is empty, or if data was inputted to database and post was reset
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






if (!isset($_SESSION['user'])) {
	$content['signup'] = <<<_END
<div class="grid clearfix">
    <div class="col-1-1">
        <form method="post" action="./signup.php">
        	<input type="hidden" name="posted" value="TRUE" />
        	<h1>Sign Up:</h1>
        	<div id="signup" class="grid clearfix nopad">
        		<div class="col-1-1">
        			<div class="grid clearfix" style="display:{$error['display']};">
        			    <div class="col-1-1 red">
        				    You didn&rsquo;t input valid form data! {$error['extras']}
                        </div>
                    </div>
                    <div class="grid clearfix">
                        <div class="col-1-8">
                            First Name:
                        </div>
                        <div class="col-7-8">
                            <input type="text" name="fname" value="{$content['fname']}" />
        					<span class="red">{$error['fname']}</span>
                        </div>
                    </div>
                    <div class="grid clearfix">
                        <div class="col-1-8">
                            Last Name:
                        </div>
                        <div class="col-7-8">
                            <input type="text" name="lname" value="{$content['lname']}" />
        					<span class="red">{$error['lname']}</span>
                        </div>
                    </div>
        			<div class="grid clearfix">
        			    <div class="col-1-8">
        			        Username:
        			    </div>
        			    <div class="col-7-8">
        			        <input type="text" name="uname" value="{$content['uname']}" />
        					<span class="red">{$error['uname']}</span>
        			    </div>
        			</div>
        			<div class="grid clearfix">
        			    <div class="col-1-8">
        			        Email:
        			    </div>
        			    <div class="col-7-8">
        			        <input type="text" name="email" value="{$content['email']}" />
        					<span class="red">{$error['email']}</span>
        			    </div>
        			</div>
        			<div class="grid clearfix">
        			    <div class="col-1-8">
        			        Password:
        			    </div>
        			    <div class="col-7-8">
        			        <input type="password" name="pass" />
        					<span class="red">{$error['pass']}</span>
        			    </div>
        			</div>
        			<div class="grid clearfix">
        			    <div class="col-1-8">
        			        Confirm Password:
        			    </div>
        			    <div class="col-7-8">
        			        <input type="password" name="cpass" />
        					<span class="red">{$error['cpass']}</span>
        			    </div>
        			</div>
                </div>
            </div>            
			<div class="grid clearfix">
			    <div class="col-1-1">
			        <input type="submit" />
			    </div>
            </div>
        </form>
    </div>
</div>
_END;
} else {
	$content['signup'] = <<<_END
<p>
	You&rsquo;re logged in! Please log out before you sign up!
</p>
_END;
}
include("./header.php");
echo <<<_END
	<div class="grid clearfix">
		<div class="col-1-1">
			{$content['signup']}
		</div>
	</div>
_END;
include("./footer.php");
?>