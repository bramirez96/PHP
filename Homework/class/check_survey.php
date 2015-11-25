<?php # check_survey.php only for testing
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "brandon");
include('./db_connect.php');

session_start();

$survey[0] = addslashes($_POST['title']);
function preg_grep_keys($pattern, $input, $flags = 0) { #Function from Daniel Klein on PHP.net, thanks buddy
    return array_intersect_key($input, array_flip(preg_grep($pattern, array_keys($input), $flags)));
}
function getAnsArray($q) {
	$x = preg_grep_keys("/a$q\_\d/", $_POST);
    foreach ($x as $key => $value) {
	    $x[$key] = addslashes($value);
    }
    return $x;
}
function getTypeArray($q) {
	$x = preg_grep_keys("/t$q\_\d/", $_POST);
	unset($x["t".$q."_0"]);
	return $x;
}
for ($i = 1; $i <= $_POST['num_q']; $i++) {
	$survey[] = [
		'question'  => addslashes($_POST['q'.$i]),
		'type'      => $_POST['t' . $i . '_0'],
		'answer'    => getAnsArray($i),
		'ans_types' => getTypeArray($i)
	];
}

//Eventually the below code will append statements to an sql query
$sql   = ["START TRANSACTION;"];
$sql[] = "INSERT INTO `entity_surveys` (`title`,`open`,`close`) VALUES ('{$survey[0]}',CURDATE(),CURDATE());";
$sql[] = "SELECT LAST_INSERT_ID() INTO @CUR_SURVEY_ID;";
for ($i = 1; $i < count($survey); $i++) {
	$sql[] = "INSERT INTO brandon.entity_questions (question, q_num, type_id) VALUES ('{$survey[$i]['question']}', '$i', '{$survey[$i]['type']}');";
	$sql[] = "SELECT LAST_INSERT_ID() INTO @CUR_QUESTION_ID;";
	$sql[] = "INSERT INTO brandon.xref_surveys_questions (survey_id, question_id) VALUES (@CUR_SURVEY_ID, @CUR_QUESTION_ID);";
	for ($c = 1; $c <= count($survey[$i]['answer']); $c++) {
		$sql[] = "INSERT INTO brandon.entity_answers (answer, a_num, type_id) VALUES ('{$survey[$i]['answer']['a'.$i.'_'.$c]}', '$c', '{$survey[$i]['ans_types']['t'.$i.'_'.$c]}');";
		$sql[] = "SELECT LAST_INSERT_ID() INTO @CUR_ANSWER_ID;";
		$sql[] = "INSERT INTO brandon.xref_questions_answers (question_id, answer_id) VALUES (@CUR_QUESTION_ID, @CUR_ANSWER_ID);";
	}
}
$sql[] = "SELECT id FROM brandon.entity_users WHERE email = '{$_SESSION['email']}' INTO @CUR_USER_ID;";
$sql[] = "INSERT INTO brandon.xref_users_surveys (user_id, survey_id) VALUES (@CUR_USER_ID, @CUR_SURVEY_ID);";
$sql[] = "COMMIT;";


foreach ($sql as $query) {
	if ($connect->query($query)) {
		echo "Success!";
	} else {
		$connect->query("ROLLBACK;");
		echo $query."<br />";
		echo "Rolled back, no changes made.";
		break;
	}
}
echo "<pre>";
print_r($_POST);
print_r($survey);
echo "</pre>";
?>