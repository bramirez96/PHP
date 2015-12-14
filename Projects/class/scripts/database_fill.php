<?php ## conect_to_db.php is used to connect to the database and create database/tables
include('../db_connect.php');

for ($s = 1; $s <= 50; $s++) {
	if ($s < 10) {
		$s_num = 0 . $s;
	} else {
		$s_num = $s;
	}
	$sql[] = "START TRANSACTION;";
	$sql[] = "INSERT INTO `2601166_entity_surveys` (`title`,`open`,`close`) VALUES ('Survey$s_num',CURDATE(),CURDATE());";
	$sql[] = "SELECT LAST_INSERT_ID() INTO @CUR_SURVEY_ID;";
	for ($i = 1; $i < 5; $i++) {
		$type = rand(1,2);
		$sql[] = "INSERT INTO brandon.2601166_entity_questions (question, q_num, type_id) VALUES ('Question$i', '$i', '$type');";
		$sql[] = "SELECT LAST_INSERT_ID() INTO @CUR_QUESTION_ID;";
		$sql[] = "INSERT INTO brandon.2601166_xref_surveys_questions (survey_id, question_id) VALUES (@CUR_SURVEY_ID, @CUR_QUESTION_ID);";
		for ($c = 1; $c <= 3; $c++) {
			$type2 = rand(1,2);
			$sql[] = "INSERT INTO brandon.2601166_entity_answers (answer, a_num, type_id) VALUES ('Answer$c', '$c', '$type2');";
			$sql[] = "SELECT LAST_INSERT_ID() INTO @CUR_ANSWER_ID;";
			$sql[] = "INSERT INTO brandon.2601166_xref_questions_answers (question_id, answer_id) VALUES (@CUR_QUESTION_ID, @CUR_ANSWER_ID);";
		}
	}
	$user_thing = rand(1,50);
	$sql[] = "SELECT id FROM brandon.2601166_entity_users WHERE id = '$user_thing' INTO @CUR_USER_ID;";
	$sql[] = "INSERT INTO brandon.2601166_xref_users_surveys (user_id, survey_id) VALUES (@CUR_USER_ID, @CUR_SURVEY_ID);";
	$sql[] = "COMMIT;";
}

foreach ($sql as $query) {
	if (!$connect->query($query)) {
		die('Error on survey inputs: ' . $connect->error);
	} else {
		echo "Query successful.";
	}
}
$sql = ["START TRANSACTION;"];
for ($i = 1; $i <= 100; $i++) {
	if ($i < 10) {
		$i_num = 0 . $i;
	} else {
		$i_num = $i;
	}
	$u_id = rand(1,50);
	$s_id = rand(1,50);
	for ($q = 3; $q >= 0; $q--) {
		$q_id = $s_id * 4 - $q;
		$a_id = $q_id * 3 - rand(0,2);
		$sql[] = "INSERT INTO `2601166_entity_responses` (user_id, survey_id, question_id, answer_id) VALUES ('$u_id', '$s_id', '$q_id', '$a_id')";
	}
}
$sql[] = "COMMIT;";

foreach ($sql as $query) {
	if (!$connect->query($query)) {
		die('Error on response inputs: ' . $connect->error);
	} else {
		echo "Query successful.";
	}
}

//Close sql connection
$connect->close();
?>



















