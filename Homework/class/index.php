<?php #index.php //Just some shit (I want whiskey)
#Day 2... still want some fucking whiskey
include('./db_connect.php');


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
		$sql = "SELECT password, username, firstname, email, id FROM brandon.entity_users WHERE email = '{$content['email']}'";
		if ($response = $connect->query($sql)) {
			if ($response->num_rows != 0) {
				while ($row = $response->fetch_assoc()) {
					//Check to see if this shit is working
					if ($row['password'] === sha1($content['pass'])) {
						$_SESSION['user'] = $row['username'];
						$_SESSION['id'] = $row['id'];
						$_SESSION['name'] = $row['firstname'];
						$_SESSION['email'] = $row['email'];
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
	$content['login'] = "<div class=\"grid clearfix\"><div class=\"col-1-1\">";
	$content['login'] .= <<<_END
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
	$content['login'] .= "</div></div>";
} else { //If user is logged in
	$sql = "SELECT title FROM brandon.entity_surveys ES
				INNER JOIN brandon.xref_users_surveys XUS
					ON ES.id = XUS.survey_id
				INNER JOIN brandon.entity_users EU
					ON XUS.user_id = EU.id
				WHERE user_id = '{$_SESSION['id']}'
				ORDER BY title ASC";
	if ($result = $connect->query($sql)) {
		$content['login'] = "<div class=\"grid clearfix\"><div class=\"col-1-1\">";
		$content['login'] .= "<h1>Your Surveys</h1>";
		$content['login'] .= "<ul class=\"dotted\">";
		while ($row = $result->fetch_row()) {
			$x = urlencode($row[0]);
			$content['login'] .= "<li class=\"push_bot_5\">&middot; <a href=\"./view_survey.php?survey=$x\">{$row[0]}</a></li>";
		}
		$content['login'] .= "</ul></div></div>";
	} else {
		$content['login'] = "<h1>Welcome, {$_SESSION['name']}!</h1>
			<p>
				No surveys were found for this user.
			</p>";
	}
}
include("./header.php");

//Put the inside of the #container tag in the following thingy
echo $content['login'];
include("./footer.php");
?>