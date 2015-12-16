<?php # users.php # View Users
include('./scripts/db_connect.php');


session_start();
//
$page_title = "Home";
$user = "Guest";

if (isset($_SESSION['user'])) {
	$_POST = [];
	$user = $_SESSION['user'];
}

if (empty($_GET)) {
$_GET['sort'] = "lastname";
}
$sql = "SELECT lastname, firstname, username, email, id FROM 2601166_entity_users WHERE id <> {$_SESSION['id']}
			ORDER BY {$_GET['sort']} ASC";
if ($result = $connect->query($sql)) {
	$content['login'] = "<div class=\"grid clearfix\"><div class=\"col-1-1\">";
	$content['login'] .= "<h1>View Profile</h1>";
	$thing[1] = "<ul><li class=\"push_bot_5 underline\"><a href=\"./users.php?sort=lastname,firstname\">Profiles</a></li>";
	$thing[2] = "<ul><li class=\"push_bot_5 underline\"><a href=\"./users.php?sort=username\">Username</a></li>";
	$thing[3] = "<ul><li class=\"push_bot_5 underline\"><a href=\"./users.php?sort=email\">Email</a></li>";
	$thing[4] = "<ul><li class=\"push_bot_5 underline\"><a>Send Message</a></li>";
	$result_id = 0;
	while ($row = $result->fetch_row()) {
		$result_id++;
		$thing[1] .= "<li class=\"push_bot_5\" data-item-num-users=\"$result_id\"><a href=\"./profile.php?user={$row[4]}\">{$row[1]} {$row[0]}</a></li>";
		$thing[2] .= "<li class=\"push_bot_5\" data-item-num-users=\"$result_id\">{$row[2]}</li>";
		$thing[3] .= "<li class=\"push_bot_5\" data-item-num-users=\"$result_id\">{$row[3]}</li>";
		$thing[4] .= "<li class=\"push_bot_5\" data-item-num-users=\"$result_id\"><a href=\"./view_messages.php?user={$row[4]}\">View Messages</a></li>";
	}
	$thing[1] .= "</ul>";
	$thing[2] .= "</ul>";
	$thing[3] .= "</ul>";
	$content['login'] .= "<div class=\"grid clearfix list_surveys\">
							<div class=\"col-1-4\">
								{$thing[1]}
							</div>
							<div class=\"col-1-4\">
								{$thing[2]}
							</div>
							<div class=\"col-1-4\">
								{$thing[3]}
							</div>
							<div class=\"col-1-4\">
							    {$thing[4]}
							</div>
						</div>
						<div id=\"users_nav\" class=\"grid clearfix\">
							<div class=\"col-1-1 center\">
								<button id=\"users_back\">&lt;</button>
								<span id=\"users_range\"></span>
								<button id=\"users_next\">&gt;</button>
							</div>
						</div>";
	$content['login'] .= "</div></div>";
	$content['login'] .= <<<_END
<script type="text/javascript">
	var users = new Pages('users', $result_id, 4, 15);
</script>
_END;
} else {
	$content['login'] = "<h1>Welcome, {$_SESSION['user']}!</h1>
		<p>
			No surveys were found for this user.
		</p>";
}
include("./header.php");

//Put the inside of the #container tag in the following thingy
echo $content['login'];
include("./footer.php");
?>