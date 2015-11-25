<?php # check_survey.php only for testing
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "brandon");
include('./db_connect.php');

session_start();
$title = "Survey";
$sql = "SELECT MAX(q_num) FROM brandon.entity_surveys ES
			INNER JOIN brandon.xref_surveys_questions XSQ
				ON ES.id = XSQ.survey_id
			INNER JOIN brandon.entity_questions EQ
				ON XSQ.question_id = EQ.id
			WHERE title = '$title'";
$new = "";
$result = $connect->query($sql);
while ($row = $result->fetch_row()) {
	$maxQ = $row[0];
}
$result->free();
echo "<h1>$title</h1>";
for ($i = 1; $i <= $maxQ; $i++) {
	//Loops through all the queries to get questions
	$query = "SELECT q_num, question, type FROM brandon.entity_surveys ES
					INNER JOIN brandon.xref_surveys_questions XSQ
						ON ES.id = XSQ.survey_id
					INNER JOIN brandon.entity_questions EQ
						ON XSQ.question_id = EQ.id
					INNER JOIN brandon.enum_q_types EQT
						ON EQ.type_id = EQT.enum_id
					WHERE q_num = '$i' AND title = '$title'";
	$result = $connect->query($query);
	while ($row = $result->fetch_assoc()) {
		$questions[$i] = $row;
	}
	$result->free();
	$query = "SELECT MAX(a_num) FROM brandon.entity_surveys ES
					INNER JOIN brandon.xref_surveys_questions XSQ
						ON ES.id = XSQ.survey_id
					INNER JOIN brandon.entity_questions EQ
						ON XSQ.question_id = EQ.id
					INNER JOIN brandon.xref_questions_answers XQA
						ON EQ.id = XQA.question_id
					INNER JOIN brandon.entity_answers EA
						ON XQA.answer_id = EA.id
					WHERE q_num = '$i' AND title = '$title'";
	$result = $connect->query($query);
	while ($row = $result->fetch_row()) {
		$maxAns = $row[0];
	}
	$result->free();
	for ($c = 1; $c <= $maxAns; $c++) {
		$query = "SELECT a_num, answer FROM brandon.entity_surveys ES
						INNER JOIN brandon.xref_surveys_questions XSQ
							ON ES.id = XSQ.survey_id
						INNER JOIN brandon.entity_questions EQ
							ON XSQ.question_id = EQ.id
						INNER JOIN brandon.xref_questions_answers XQA
							ON EQ.id = XQA.question_id
						INNER JOIN brandon.entity_answers EA
							ON XQA.answer_id = EA.id
						WHERE a_num = '$c' AND q_num = '$i' AND title = '$title'";
		$result = $connect->query($query);
		while ($row = $result->fetch_assoc()) {
			$questions[$i]['answers'][$c] = $row;
		}
	}
}


foreach ($questions as $array) {
	echo "{$array['q_num']}. {$array['question']}<br />";
	foreach ($array['answers'] as $ans_array) {
		echo "<label><input type='{$array['type']}' name='balls' />{$ans_array['a_num']} - {$ans_array['answer']}</label><br />";
	}
}

echo "<br /><pre>";
print_r($questions);
echo "</pre>";
?>