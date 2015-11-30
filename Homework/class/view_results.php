<?php # list_survey.php # View all surveys you haven't created
include('./db_connect.php');
$page_title = $_GET['survey'];
session_start();

$title = urldecode($_GET['survey']);
$time = urldecode($_GET['timestamp']);
$query = "SELECT * FROM brandon.entity_responses ER
				INNER JOIN brandon.entity_users EU
					ON ER.user_id = EU.id
				INNER JOIN brandon.entity_surveys ES
					ON ER.survey_id = ES.id
				INNER JOIN brandon.entity_questions EQ
					ON ER.question_id = EQ.id
				INNER JOIN brandon.entity_answers EA
					ON ER.answer_id = EA.id
				WHERE title = '$title' AND user_id = '{$_SESSION['id']}' AND timestamp = '$time'";
$result = $connect->query($query);
while($row = $result->fetch_assoc()) {
	$questions[$row['q_num']][$row['question']][] = $row['answer'];
}
$result->free();

$content = "<div class=\"grid clearfix\"><div class=\"col-1-1\">";
$content .= "<h1>$title - Responses</h1>";
foreach ($questions as $q_num => $array) {
	foreach ($array as $key => $answers) {
		$content .= "<p class=\"push_bot_5 little_big\">$q_num. <span class=\"pink\">$key</span></p>";
		foreach ($answers as $value) {
			$content .= "<p class=\"push_bot_5 indent\">&middot; $value</p>";
		}
	}
}
$content .= "</div></div>";
$content .= "<div class=\"grid clearfix\"><div class=\"col-1-1\">";
$content .= "<p><a class=\"button\" href=\"./index.php\">Return</a></p>";
$content .= "</div></div>";







include('./header.php');
echo $content;
include('./footer.php');
?>