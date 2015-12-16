<?php # check_survey.php only for testing
include('./db_connect.php');
$page_title = "Survey Posted";
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
$sql[] = "INSERT INTO `2601166_entity_surveys` (`title`,`open`,`close`) VALUES ('{$survey[0]}',CURDATE(),'{$_POST['close']}');";
$sql[] = "SELECT LAST_INSERT_ID() INTO @CUR_SURVEY_ID;";
for ($i = 1; $i < count($survey); $i++) {
	$sql[] = "INSERT INTO brandon.2601166_entity_questions (question, q_num, type_id) VALUES ('{$survey[$i]['question']}', '$i', '{$survey[$i]['type']}');";
	$sql[] = "SELECT LAST_INSERT_ID() INTO @CUR_QUESTION_ID;";
	$sql[] = "INSERT INTO brandon.2601166_xref_surveys_questions (survey_id, question_id) VALUES (@CUR_SURVEY_ID, @CUR_QUESTION_ID);";
	for ($c = 1; $c <= count($survey[$i]['answer']); $c++) {
		$sql[] = "INSERT INTO brandon.2601166_entity_answers (answer, a_num, type_id) VALUES ('{$survey[$i]['answer']['a'.$i.'_'.$c]}', '$c', '{$survey[$i]['ans_types']['t'.$i.'_'.$c]}');";
		$sql[] = "SELECT LAST_INSERT_ID() INTO @CUR_ANSWER_ID;";
		$sql[] = "INSERT INTO brandon.2601166_xref_questions_answers (question_id, answer_id) VALUES (@CUR_QUESTION_ID, @CUR_ANSWER_ID);";
	}
}
$sql[] = "SELECT id FROM brandon.2601166_entity_users WHERE email = '{$_SESSION['email']}' INTO @CUR_USER_ID;";
$sql[] = "INSERT INTO brandon.2601166_xref_users_surveys (user_id, survey_id) VALUES (@CUR_USER_ID, @CUR_SURVEY_ID);";
$sql[] = "COMMIT;";


foreach ($sql as $query) {
	if ($connect->query($query)) {
		$content['result'] = "<div class=\"grid clearfix\">
									<div class=\"col-1-1\">
										<p>
											Survey created and stored successfully!
										</p>
									</div>
								</div>";
	} else {
		$connect->query("ROLLBACK;");
		$content['result'] = "<div class=\"grid clearfix\">
									<div class=\"col-1-1\">
										<p>
											We're sorry, but something went wrong when trying to process your survey! <br />
											<a href=\"./new_survey.php\">Click here</a> to start over.
										</p>
									</div>
								</div>";
		break;
	}
}



include('./header.php');
echo $content['result'];
include('./footer.php');
?>