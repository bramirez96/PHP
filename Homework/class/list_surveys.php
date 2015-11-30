<?php # list_survey.php # View all surveys you haven't created
include('./db_connect.php');
$page_title = "View Surveys";
session_start();

$query = "SELECT title, username, close FROM brandon.entity_surveys ES
				INNER JOIN brandon.xref_users_surveys XUS
					ON ES.id = XUS.survey_id
				INNER JOIN brandon.entity_users EU
					ON XUS.user_id = EU.id
				WHERE user_id <> {$_SESSION['id']}
				ORDER BY {$_GET['sort']}, close ASC";
if ($result = $connect->query($query)) {
	$content['list'] = "<div class=\"grid clearfix\"><div class=\"col-1-1\">";
	$content['list'] .= "<h1>All Surveys</h1>";
	$thing[1] = "<ul><li class=\"push_bot_5 underline\"><a href=\"./list_surveys.php?sort=title\">Survey Title</a></li>";
	$thing[2] = "<ul><li class=\"push_bot_5 underline\"><a href=\"./list_surveys.php?sort=username\">Created By</a></li>";
	$thing[3] = "<ul><li class=\"push_bot_5 underline\"><a href=\"./list_surveys.php?sort=close\">Open Until</a></li>";
	while ($row = $result->fetch_row()) {
		$x = urlencode($row[0]);
		$thing[1] .= "<li class=\"push_bot_5\">&nbsp;&middot; <a href=\"./take_survey.php?survey=$x\">{$row[0]}</a></li>";
		$thing[2] .= "<li class=\"push_bot_5\">{$row[1]}</li>";
		$thing[3] .= "<li class=\"push_bot_5\">{$row[2]}</li>";
	}
	$thing[1] .= "</ul>";
	$thing[2] .= "</ul>";
	$thing[3] .= "</ul>";
	$content['list'] .= "<div class=\"grid clearfix list_surveys\">
							<div class=\"col-1-3\">
								{$thing[1]}
							</div>
							<div class=\"col-1-3\">
								{$thing[2]}
							</div>
							<div class=\"col-1-3\">
								{$thing[3]}
							</div>
						</div>";
	$content['list'] .= "</div></div>";
}






$content['form'] = "<div class='grid clearfix'><div class='col-1-2'></div><div class='col-1-2'>butts</div></div>";

include('./header.php');
echo $content['list'];
include('./footer.php');
?>