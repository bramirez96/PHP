<?php # check_survey.php only for testing
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "brandon");
include('./db_connect.php');

session_start();

$survey[0] = $_POST['title'];
function preg_grep_keys($pattern, $input, $flags = 0) { #Function from Daniel Klein on PHP.net, thanks buddy
    return array_intersect_key($input, array_flip(preg_grep($pattern, array_keys($input), $flags)));
}
function getAnsArray($q) {
	return preg_grep_keys("/a$q\_\d/", $_POST);
}
for ($i = 1; $i <= $_POST['num_q']; $i++) {
	$survey[] = [
		'question' => $_POST['q'.$i],
		'answer' => getAnsArray($i)
	];
}

//Eventually the below code will append statements to an sql query
echo $survey[0] . "<br />";
for ($i = 1; $i < count($survey); $i++) {
	echo "___".$survey[$i]['question'];
	foreach ($survey[$i]['answer'] as $value) {
		echo "<br />______" . $value;
	}
	echo "<br />";
}
$sql = "BEGIN;
	INSERT INTO `entity_surveys` (`title`,`open`,`close`) VALUES ('{$survey[0]}',CURDATE(),CURDATE());
	SELECT LAST_INSERT_ID() INTO @CUR_SURVEY_ID;";
for ($i = 1; $i < count($survey); $i++) {
	$sql .= "
		INSERT INTO brandon.entity_questions (question, type) VALUES ('{$survey[$i]['question']}', '1');
		SELECT LAST_INSERT_ID() INTO @CUR_QUESTION_ID;
		INSERT INTO brandon.xref_surveys_questions (survey_id, question_id) VALUES (@CUR_SURVEY_ID, @CUR_QUESTION_ID);";
	foreach ($survey[$i]['answer'] as $value) {
		$sql .= "
			INSERT INTO brandon.entity_answers (answer) VALUES ('$value');
			SELECT LAST_INSERT_ID() INTO @CUR_ANSWER_ID;
			INSERT INTO brandon.xref_questions_answers (question_id, answer_id) VALUES (@CUR_QUESTION_ID, @CUR_ANSWER_ID);";
	}
}
$sql .= "
	SELECT id FROM brandon.entity_users WHERE email = '{$_SESSION['email']}' INTO @CUR_USER_ID;
	INSERT INTO brandon.xref_users_surveys (user_id, survey_id) VALUES (@CUR_USER_ID, @CUR_SURVEY_ID);
	COMMIT;";
$other = "INSERT INTO entity_surveys (title, `open`, `close`) VALUES ('Survey Bitches', CURDATE(), CURDATE())";
echo "<pre>$sql</pre>";
run_query($connect, $sql);
?>