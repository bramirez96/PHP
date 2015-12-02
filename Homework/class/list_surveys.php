<?php # list_survey.php # View all surveys you haven't created
include('./db_connect.php');
$page_title = "View Surveys";
session_start();

$query = "SELECT title, username, close, survey_id FROM brandon.2601166_entity_surveys ES
				INNER JOIN brandon.2601166_xref_users_surveys XUS
					ON ES.id = XUS.survey_id
				INNER JOIN brandon.2601166_entity_users EU
					ON XUS.user_id = EU.id
				WHERE user_id <> {$_SESSION['id']}
				ORDER BY {$_GET['sort']}, close ASC";
if ($result = $connect->query($query)) {
	$content['list'] = "<div class=\"grid clearfix\"><div class=\"col-1-1\">";
	$content['list'] .= "<h1>All Surveys</h1>";
	$thing[1] = "<ul><li class=\"push_bot_5 underline\"><a href=\"./list_surveys.php?sort=title\">Survey Title</a></li>";
	$thing[2] = "<ul><li class=\"push_bot_5 underline\"><a href=\"./list_surveys.php?sort=username\">Created By</a></li>";
	$thing[3] = "<ul><li class=\"push_bot_5 underline\"><a href=\"./list_surveys.php?sort=close\">Open Until</a></li>";
	$result_id = 0;
	while ($row = $result->fetch_row()) {
		$x = urlencode($row[3]);
		$result_id++;
		$thing[1] .= "<li class=\"push_bot_5\" data-item-num=\"$result_id\"><a href=\"./take_survey.php?survey=$x\">{$row[0]}</a></li>";
		$thing[2] .= "<li class=\"push_bot_5\" data-item-num=\"$result_id\">{$row[1]}</li>";
		$thing[3] .= "<li class=\"push_bot_5\" data-item-num=\"$result_id\">{$row[2]}</li>";
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
						</div>
						<div class=\"grid clearfix\">
							<div class=\"col-1-1 center\">
								<button onclick=\"pageBack()\">&lt;</button>
								<button onclick=\"nextPage()\">&gt;</button>
							</div>
						</div>";
	$content['list'] .= "</div></div>";
	$content['list'] .= "<script type=\"text/javascript\">var numResults = $result_id;</script>";
	$content['list'] .= <<<_END
<script type="text/javascript">
	
</script>
_END;
}







include('./header.php');
echo $content['list'];
include('./footer.php');
?>