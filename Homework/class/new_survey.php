<?php #index.php //Just some shit (I want whiskey)
#Day 2... still want some fucking whiskey

//Define database info
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "brandon");

session_start();
//
$page_title = "Home";
$user = "Guest";

if (isset($_SESSION['user'])) {
	$_POST = [];
	$user = $_SESSION['user'];
} else {
	header('Location: ./index.php');
}
if (!empty($_POST)) { //Checks if the page was submitted or loaded from a link
	//FORM VALIDATION
	include('./db_connect.php');	
	
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
		$sql = "SELECT password, username, firstname FROM brandon.entity_users WHERE email = '{$content['email']}'";
		if ($response = $connect->query($sql)) {
			if ($response->num_rows != 0) {
				while ($row = $response->fetch_assoc()) {
					//Check to see if this shit is working
					if ($row['password'] === sha1($content['pass'])) {
						$_SESSION['user'] = $row['username'];
						$_SESSION['name'] = $row['firstname'];
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



$content['login'] = <<<_END
<h1>New Survey:</h1>
<form method="post" action="./check_survey.php" onsubmit="this.num_q.value = Question.count">
	<input id="keep_count" type="hidden" value="0" name="num_q" />
	<div class="grid clearfix underline_box">
		<div class="col-1-5">
			<p>
				Survey Name:
			</p>
		</div>
		<div class="col-4-5">
			<p>
				<input type="text" name="title" />
			</p>
		</div>
	</div>
	<div class="grid clearfix">
		<div id="questions" class="col-1-1">
		
		</div>
	</div>
	<div class="grid clearfix">
		<div class="col-1-1">
			<button type="button" onclick="q.push(new Question())">+Add Question</button>
		</div>
	</div>
	<div class="grid clearfix">
		<div class="col-1-1">
			<p>
				<input type="submit" />
			</p>
		</div>
	</div>
</form>
_END;
include("./header.php");
//Put the inside of the #container tag in the following thingy
echo <<<_END
	<div class="grid clearfix">
		<div class="col-1-1">
			{$content['login']}
		</div>
	</div>
	<script type="text/javascript" src="./scripts/new_survey.js"></script>
_END;
include("./footer.php");
?>