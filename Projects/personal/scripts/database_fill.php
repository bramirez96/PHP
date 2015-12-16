<?php ## conect_to_db.php is used to connect to the database and create database/tables
include('./db_connect.php');
$sql = [];
for ($s = 1; $s <= 50; $s++) {
	if ($s < 10) {
		$s_num = 0 . $s;
	} else {
		$s_num = $s;
	}
	$sql[] = "INSERT INTO 2601166_entity_users (firstname,lastname,username,email,password) VALUES ('First$s_num','Last$s_num','User$s_num','$s_num@email.com',SHA1('pass$s_num'));";
}

foreach ($sql as $query) {
	if (!$connect->query($query)) {
		die('Error on usr create: ' . $connect->error);
	} else {
		echo "Query successful.";
	}
}

$sql = [];
for ($s = 1; $s <= 50; $s++) {
	$sql[] = "START TRANSACTION;";
	$sql[] = "INSERT INTO 2601166_entity_messages (message) VALUES ('Random Message #$s');";
	$sql[] = "SELECT LAST_INSERT_ID() INTO @CUR_MSG_ID;";
	$sender = rand(1,6);
    do {
    	$recip = rand(1,6);
    } while($recip == $sender);
	$sql[] = "INSERT INTO 2601166_xref_messages (send_id,recip_id,message_id) VALUES ('$sender','$recip',@CUR_MSG_ID);";
	$sql[] = "COMMIT;";
}

foreach ($sql as $query) {
	if (!$connect->query($query)) {
		die('Error on message creation: ' . $connect->error);
	} else {
		echo "Query successful.";
	}
}


$sql = [];
for ($s = 1; $s <= 200; $s++) {
	$sql[] = "START TRANSACTION;";
	$sql[] = "INSERT INTO 2601166_entity_statuses (status) VALUES ('Random Status #$s');";
	$sql[] = "SELECT LAST_INSERT_ID() INTO @CUR_STATUS_ID;";
	$post = rand(1,50);
	$sql[] = "INSERT INTO 2601166_xref_statuses (poster_id,status_id) VALUES ('$post',@CUR_STATUS_ID);";
	$sql[] = "COMMIT;";
}

foreach ($sql as $query) {
	if (!$connect->query($query)) {
		die('Error on status creation: ' . $connect->error);
	} else {
		echo "Query successful.";
	}
}

//Close sql connection
$connect->close();
?>



















