<?php # take_survey.php # Take the survey and push values to the database
include('./db_connect.php');
$page_title = "View Survey";
session_start();

include('./scripts/make_form.php');

$content['form'] = make_form($_GET['survey'], $connect);


include('./header.php');
if (empty($_POST)) {
	echo $content['form'];
} else {
	echo "<div class=\"grid clearfix\">
		<div class=\"col-1-1\">";
	$data['survey_id'] = $_POST['survey_id'];
	$data['user_id'] = $_SESSION['id'];
	for ($i = 1; $i < count($_POST); $i++) {
		$x = array_keys($_POST)[$i];
		foreach ($_POST[$x] as $ans_id) {
			$data['question_id'][] = $x;
			$data['answer_id'][] = $ans_id;
		}
	}
	$queries[] = "START TRANSACTION;";
	foreach ($data['answer_id'] as $key => $value) {
		$queries[] = "INSERT INTO brandon.2601166_entity_responses (user_id, survey_id, question_id, answer_id) VALUES ('{$data['user_id']}', '{$data['survey_id']}', '{$data['question_id'][$key]}', '{$value}')";
	}
	$queries[] = "COMMIT;";
	foreach ($queries as $sql) {
		$connect->query($sql);
		if ($connect->error) {
			run_query($connect, "ROLLBACK;");
			$message = "Data could not be submitted. Please take the survey again.";
			break;
		}
		$message = "Data successfully inputted!";
	}
	echo "$message</div>
	</div>";
}
include('./footer.php');
?>