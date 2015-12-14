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
		$sql = "SELECT password, username, email, id FROM brandon.2601166_entity_admins WHERE email = '{$content['email']}'";
		if ($response = $connect->query($sql)) {
			if ($response->num_rows != 0) {
				while ($row = $response->fetch_assoc()) {
					//Check to see if this shit is working
					if ($row['password'] === sha1($content['pass'])) {
						$_SESSION['user'] = $row['username'];
						$_SESSION['id'] = $row['id'];
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
					<input type="submit" />
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
		$_GET['sort1'] = "title";
		$_GET['sort2'] = "title";
	}
	$sql = "SELECT title, open, close, survey_id FROM brandon.2601166_entity_surveys ES
				INNER JOIN brandon.2601166_xref_users_surveys XUS
					ON ES.id = XUS.survey_id
				INNER JOIN brandon.2601166_entity_users EU
					ON XUS.user_id = EU.id
				WHERE user_id = '{$_SESSION['id']}'
				ORDER BY {$_GET['sort1']} ASC";
	if ($result = $connect->query($sql)) {
		$content['login'] = "<div class=\"grid clearfix\"><div class=\"col-1-1\">";
		$content['login'] .= "<h1>Your Surveys</h1>";
		$sort2 = urlencode($_GET['sort2']);
		$thing[1] = "<ul><li class=\"push_bot_5 underline\"><a href=\"./index.php?sort1=title&sort2=$sort2\">Survey Title</a></li>";
		$thing[2] = "<ul><li class=\"push_bot_5 underline\"><a href=\"./index.php?sort1=open&sort2=$sort2\">Opened On</a></li>";
		$thing[3] = "<ul><li class=\"push_bot_5 underline\"><a href=\"./index.php?sort1=close&sort2=$sort2\">Closes On</a></li>";
		$result_id1 = 0;
		while ($row = $result->fetch_row()) {
			$x = urlencode($row[3]);
			$result_id1++;
			$thing[1] .= "<li class=\"push_bot_5\" data-item-num-my=\"$result_id1\"><a href=\"./view_survey.php?survey=$x\">{$row[0]}</a></li>";
			$thing[2] .= "<li class=\"push_bot_5\" data-item-num-my=\"$result_id1\">{$row[1]}</li>";
			$thing[3] .= "<li class=\"push_bot_5\" data-item-num-my=\"$result_id1\">{$row[2]}</li>";
		}
		$thing[1] .= "</ul>";
		$thing[2] .= "</ul>";
		$thing[3] .= "</ul>";
		$content['login'] .= "<div class=\"grid clearfix list_surveys\">
								<div class=\"col-1-3\">
									{$thing[1]}
								</div>
								<div class=\"col-1-3\">
									{$thing[2]}
								</div>
								<div class=\"col-1-3\">
									{$thing[3]}
								</div>
							</div>
							<div class=\"grid clearfix\">
								<div class=\"col-1-1 center\">
									<button id=\"my_back\">&lt;</button>
									<span id=\"my_range\"></span>
									<button id=\"my_next\">&gt;</button>
								</div>
							</div>";
		$content['login'] .= "</ul></div></div>";
	} else {
		$content['login'] = "<h1>Welcome, {$_SESSION['name']}!</h1>
			<p>
				No surveys were found for this user.
			</p>";
	}
	//Now we get the "surveys you've taken" section
	$sql = "SELECT DISTINCT title, timestamp, survey_id FROM brandon.2601166_entity_surveys ES
				INNER JOIN brandon.2601166_entity_responses ER
					ON ES.id = ER.survey_id
				INNER JOIN brandon.2601166_entity_users EU
					ON EU.id = ER.user_id
				WHERE user_id = '{$_SESSION['id']}'
				ORDER BY {$_GET['sort2']} ASC";
	if ($result = $connect->query($sql)) {
		$content['login'] .= "<h1>Surveys You've Taken</h1>";
		$sort1 = urlencode($_GET['sort1']);
		$content['login'] .= "<div class=\"grid clearfix no_top_pad\"><div class=\"col-1-1\">";
		$thing[1] = "<ul><li class=\"push_bot_5 underline\"><a href=\"./index.php?sort1=$sort1&sort2=title\">Survey Title</a></li>";
		$thing[2] = "<ul><li class=\"push_bot_5 underline\"><a href=\"./index.php?sort1=$sort1&sort2=timestamp\">Date Taken</a></li>";
		$result_id2 = 0;
		while ($row = $result->fetch_row()) {
			$x = urlencode($row[2]);
			$y = urlencode($row[1]);
			$result_id2++;
			$thing[1] .= "<li class=\"push_bot_5\" data-item-num-taken=\"$result_id2\"><a href=\"./view_results.php?survey=$x&timestamp=$y\">{$row[0]}</a></li>";
			$thing[2] .= "<li class=\"push_bot_5\" data-item-num-taken=\"$result_id2\">{$row[1]}</li>";
		}
		$thing[1] .= "</ul>";
		$thing[2] .= "</ul>";
		$content['login'] .= "<div class=\"grid clearfix list_surveys\">
								<div class=\"col-1-3\">
									{$thing[1]}
								</div>
								<div class=\"col-1-3\">
									{$thing[2]}
								</div>
								<div class=\"col-1-3\">
									
								</div>
							</div>
							<div class=\"grid clearfix\">
								<div class=\"col-1-1 center\">
									<button id=\"taken_back\">&lt;</button>
									<span id=\"taken_range\"></span>
									<button id=\"taken_next\">&gt;</button>
								</div>
							</div>";
		$content['login'] .= "</div></div>";
		$content['login'] .= <<<_END
<script type="text/javascript" src="./scripts/paginate.js"></script>
<script type="text/javascript">
	var my = new Pages('my', $result_id1, 3);
	var taken = new Pages('taken', $result_id2, 2);
</script>
_END;
	include('./admin_header.php');
	}
}

//Put the inside of the #container tag in the following thingy
echo $content['login'];
include("./footer.php");
?>