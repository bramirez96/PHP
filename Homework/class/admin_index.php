<?php #index.php //Just some shit (I want whiskey)
#Day 2... still want some fucking whiskey
include('./db_connect.php');


session_start();
//
$page_title = "Admin Login";
$user = "Guest";

if (isset($_SESSION['user'])) {
	$_POST = [];
	$user = $_SESSION['user'];
}
if (!empty($_POST)) { //Checks if the page was submitted or loaded from a link
	$content['count'] = 0;
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
		$sql = "SELECT password, username, id FROM brandon.2601166_entity_admins WHERE email = '{$content['email']}'";
		if ($response = $connect->query($sql)) {
			if ($response->num_rows != 0) {
				while ($row = $response->fetch_assoc()) {
					//Check to see if this shit is working
					if ($row['password'] === sha1($content['pass'])) {
						$_SESSION['user'] = $row['username'];
						$_SESSION['id'] = $row['id'];
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
<form method="post" action="./admin_index.php">
	<h1>Admin Log In:</h1>
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
					<input type="submit" value="Log In" />
				</td>
			</tr>
		</tbody>
	</table>
</form>
_END;
	$content['login'] .= "</div></div>";
	include('./header.php');
} else { //If user is logged in
	//First we get the "Your surveys" section
	if (empty($_GET)) {
		$_GET['sort'] = "lastname";
	}
	$sql = "SELECT lastname, firstname, username, email, id FROM brandon.2601166_entity_users EU
				ORDER BY {$_GET['sort']} ASC";
	if ($result = $connect->query($sql)) {
		$content['login'] = "<div class=\"grid clearfix\"><div class=\"col-1-1\">";
		$content['login'] .= "<h1>Users</h1>";
		$thing[1] = "<ul><li class=\"push_bot_5 underline\"><a href=\"./admin_index.php?sort=lastname\">Last Name</a></li>";
		$thing[2] = "<ul><li class=\"push_bot_5 underline\"><a href=\"./admin_index.php?sort=firstname\">First Name</a></li>";
		$thing[3] = "<ul><li class=\"push_bot_5 underline\"><a href=\"./admin_index.php?sort=username\">Username</a></li>";
		$thing[4] = "<ul><li class=\"push_bot_5 underline\"><a href=\"./admin_index.php?sort=email\">Email</a></li>";
		$thing[5] = "<ul class=\"center\"><li class=\"push_bot_5 underline\"><a href=\"./admin_index.php\">Edit/Delete</a></li>";
		$result_id = 0;
		while ($row = $result->fetch_row()) {
			$result_id++;
			$thing[1] .= "<li class=\"push_bot_5\" data-item-num-users=\"$result_id\">{$row[0]}</li>";
			$thing[2] .= "<li class=\"push_bot_5\" data-item-num-users=\"$result_id\">{$row[1]}</li>";
			$thing[3] .= "<li class=\"push_bot_5\" data-item-num-users=\"$result_id\">{$row[2]}</li>";
			$thing[4] .= "<li class=\"push_bot_5\" data-item-num-users=\"$result_id\">{$row[3]}</li>";
		$thing[5] .= "<li class=\"push_bot_5\" data-item-num-users=\"$result_id\"><a href=\"./ad_edit_user.php?id={$row[4]}\">E</a> | <a href=\"./ad_delete_user.php?id={$row[4]}\">D</a></li>";
		}
		$thing[1] .= "</ul>";
		$thing[2] .= "</ul>";
		$thing[3] .= "</ul>";
		$thing[4] .= "</ul>";
		$thing[5] .= "</ul>";
		$content['login'] .= "<div class=\"grid clearfix list_surveys\">
								<div class=\"col-1-5\">
									{$thing[1]}
								</div>
								<div class=\"col-1-5\">
									{$thing[2]}
								</div>
								<div class=\"col-1-5\">
									{$thing[3]}
								</div>
								<div class=\"col-3-10\">
									{$thing[4]}
								</div>
								<div class=\"col-1-10\">
									{$thing[5]}
								</div>
							</div>
							<div class=\"grid clearfix\">
								<div class=\"col-1-1 center\">
									<button id=\"users_back\">&lt;</button>
									<span id=\"users_range\"></span>
									<button id=\"users_next\">&gt;</button>
								</div>
							</div>";
		$content['login'] .= "</ul></div></div>";
	} else {
		$content['login'] = "<h1>Welcome, {$_SESSION['user']}!</h1>
			<p>
				No surveys were found for this user.
			</p>";
	}
		$content['login'] .= <<<_END
<script type="text/javascript" src="./scripts/paginate.js"></script>
<script type="text/javascript">
	var users = new Pages('users', $result_id, 5, 15);
</script>
_END;
	include('./admin_header.php');
}

//Put the inside of the #container tag in the following thingy
echo $content['login'];
include("./footer.php");
?>