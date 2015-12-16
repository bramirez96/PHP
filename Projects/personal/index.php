<?php #index.php //Just some shit (I want whiskey)
#Day 2... still want some fucking whiskey
include('./scripts/db_connect.php');


session_start();
//
$page_title = "Home";
$user = "Guest";

if (isset($_SESSION['user'])) {
	$_POST = [];
	$user = $_SESSION['user'];
}
if (!empty($_POST)) { //Checks if the page was submitted or loaded from a link
	$content['count'] = 0;#61a3d7
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
		$sql = "SELECT password, username, firstname, email, id FROM 2601166_entity_users WHERE email = '{$content['email']}'";
		if ($response = $connect->query($sql)) {
			if ($response->num_rows != 0) {
				while ($row = $response->fetch_assoc()) {
					//Check to see if this shit is working
					if ($row['password'] === sha1($content['pass'])) {
						$_SESSION['user'] = $row['username'];
						$_SESSION['id'] = $row['id'];
						$_SESSION['name'] = $row['firstname'];
						$_SESSION['email'] = $row['email'];
					} else {
    					$error['pass'] = "*";
					}
				}
				$response->free();
			} else {
    			$error['email'] = "*";
    			$error['pass'] = "*";
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
	$content['login'] = "<div class=\"grid clearfix\"><div class=\"col-1-1\">";
	$content['login'] .= <<<_END
<div class="grid clearfix">
    <div class="col-1-1">
        <form method="post" action="./index.php">
            <h1>Log In:</h1>
            <div class="grid clearfix nopad">
                <div class="col-1-1">
                    <div class="grid clearfix">
                        <div class="col-1-8">
                            Email:<br />
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
	$content['login'] .= "</div></div>";
} else { //If user is logged in
	$content['login'] = <<<_END
<div class="grid clearfix">
    <div class="col-1-1">
        <h1>Welcome, {$_SESSION['user']}!</h1>
        <p>
            You&rsquo;re totally logged in.
        </p>
    </div>
</div>
_END;
}
include("./header.php");

//Put the inside of the #container tag in the following thingy
echo $content['login'];
include("./footer.php");
?>