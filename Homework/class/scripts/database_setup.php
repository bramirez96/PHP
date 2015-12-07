<?php ## conect_to_db.php is used to connect to the database and create database/tables
include('../db_connect.php');

//Including a delete to be removed later
if ($connect->query('DROP DATABASE IF EXISTS ' . DB_NAME) === TRUE) {
	echo "Deleted existing database or it wasn't there. Clean start. <br />";
} else {
	echo "Whoa whoa whoa man: " . $connect->error;
}
//Create the database
$newDB = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
if ($connect->query($newDB) === TRUE) {
	echo "Database created successfully or already exists.";
} else {
	echo "Database creation failed: " . $connect->error;
}
echo "<br />";
//Select database
$connect->select_db(DB_NAME);
//the following queries create the tables
//!entity_users
$queries[] = "CREATE TABLE IF NOT EXISTS brandon.2601166_entity_users (
	id        INT(6)      NOT NULL AUTO_INCREMENT,
	firstname VARCHAR(20) NOT NULL,
	lastname  VARCHAR(20) NOT NULL,
	username  VARCHAR(20) NOT NULL,
	email     VARCHAR(30) NOT NULL,
	password  CHAR(40)    NOT NULL,
	CONSTRAINT PK_Users PRIMARY KEY CLUSTERED (id, email)
)";
//!entity_surveys
$queries[] = "CREATE TABLE IF NOT EXISTS brandon.2601166_entity_surveys (
	id      INT(6) NOT NULL AUTO_INCREMENT,
	title   TEXT   NOT NULL,
	open    DATE   NOT NULL,
	close   DATE   NOT NULL,
	CONSTRAINT PK_Surveys PRIMARY KEY CLUSTERED (id)
)";
//!xref_user_surveys
$queries[] = "CREATE TABLE IF NOT EXISTS brandon.2601166_xref_users_surveys (
	xref_id   INT(6) NOT NULL AUTO_INCREMENT,
	user_id   INT(6) NOT NULL,
	survey_id INT(6) NOT NULL,
	CONSTRAINT PK_User_Reference_Survey PRIMARY KEY CLUSTERED (xref_id, user_id, survey_id),
	CONSTRAINT FK_User_Survey           FOREIGN KEY (user_id)   REFERENCES brandon.2601166_entity_users(id),
	CONSTRAINT FK_Survey_User           FOREIGN KEY (survey_id) REFERENCES brandon.2601166_entity_surveys(id)
)";
//!enum_q_type
$queries[] = "CREATE TABLE IF NOT EXISTS brandon.2601166_enum_q_types (
	enum_id INT(1)      NOT NULL AUTO_INCREMENT,
	q_type  VARCHAR(10) NOT NULL,
	CONSTRAINT PK_Enum_Q PRIMARY KEY CLUSTERED (enum_id)
)";
//!entity_questions
$queries[] = "CREATE TABLE IF NOT EXISTS brandon.2601166_entity_questions (
	id       INT(6) NOT NULL AUTO_INCREMENT,
	question TEXT   NOT NULL,
	q_num    INT(2) NOT NULL,
	type_id  INT(1) NOT NULL,
	CONSTRAINT PK_Questions PRIMARY KEY CLUSTERED (id),
	CONSTRAINT FK_Enum_Ques FOREIGN KEY (type_id) REFERENCES brandon.2601166_enum_q_types(enum_id)
)";
//!xref_surveys_questions
$queries[] = "CREATE TABLE IF NOT EXISTS brandon.2601166_xref_surveys_questions (
	xref_id     INT(6) NOT NULL AUTO_INCREMENT,
	survey_id   INT(6) NOT NULL,
	question_id INT(6) NOT NULL,
	CONSTRAINT PK_Survey_Reference_Question PRIMARY KEY CLUSTERED (xref_id, survey_id, question_id),
	CONSTRAINT FK_Survey_Question           FOREIGN KEY (survey_id)   REFERENCES brandon.2601166_entity_surveys(id),
	CONSTRAINT FK_Question_Survey           FOREIGN KEY (question_id) REFERENCES brandon.2601166_entity_questions(id)
)";
//!enum_a_types
$queries[] = "CREATE TABLE IF NOT EXISTS brandon.2601166_enum_a_types (
	enum_id INT(1)      NOT NULL AUTO_INCREMENT,
	a_type  VARCHAR(10) NOT NULL,
	CONSTRAINT PK_Enum_A PRIMARY KEY CLUSTERED (enum_id)
)";
//!entity_answers
$queries[] = "CREATE TABLE IF NOT EXISTS brandon.2601166_entity_answers (
	id      INT(6) NOT NULL AUTO_INCREMENT,
	answer  TEXT   NOT NULL,
	a_num   INT(2) NOT NULL,
	type_id INT(1) NOT NULL,
	CONSTRAINT PK_Answer   PRIMARY KEY CLUSTERED (id),
	CONSTRAINT FK_Enum_Ans FOREIGN KEY (type_id) REFERENCES brandon.2601166_enum_a_types(enum_id)
)";
//!xref_questions_answers
$queries[] = "CREATE TABLE IF NOT EXISTS brandon.2601166_xref_questions_answers (
	xref_id     INT(6) NOT NULL AUTO_INCREMENT,
	question_id INT(6) NOT NULL,
	answer_id   INT(6) NOT NULL,
	CONSTRAINT PK_Question_Reference_Answer PRIMARY KEY CLUSTERED (xref_id, question_id, answer_id),
	CONSTRAINT FK_Question_Answer           FOREIGN KEY (question_id) REFERENCES brandon.2601166_entity_questions(id),
	CONSTRAINT FK_Answer_Question           FOREIGN KEY (answer_id)   REFERENCES brandon.2601166_entity_answers(id)
)";
//!xref_responses
$queries[] = "CREATE TABLE IF NOT EXISTS brandon.2601166_entity_responses (
	id          INT(6)    NOT NULL AUTO_INCREMENT,
	timestamp   TIMESTAMP DEFAULT  NOW(),
	user_id     INT(6)    NOT NULL,
	survey_id   INT(6)    NOT NULL,
	question_id INT(6)    NOT NULL,
	answer_id   INT(6)    NOT NULL,
	CONSTRAINT PK_Response_Reference_All      PRIMARY KEY CLUSTERED (id),
	CONSTRAINT FK_Response_Reference_User     FOREIGN KEY (user_id)     REFERENCES brandon.2601166_entity_users(id),
	CONSTRAINT FK_Response_Reference_Survey   FOREIGN KEY (survey_id)   REFERENCES brandon.2601166_entity_surveys(id),
	CONSTRAINT FK_Response_Reference_Question FOREIGN KEY (question_id) REFERENCES brandon.2601166_entity_questions(id),
	CONSTRAINT FK_Response_Reference_Answer   FOREIGN KEY (answer_id)   REFERENCES brandon.2601166_entity_answers(id)
)";
//!entity_admin
$queries[] = "CREATE TABLE IF NOT EXISTS brandon.2601166_entity_admins (
	id       TINYINT(2)  NOT NULL AUTO_INCREMENT,
	username VARCHAR(20) NOT NULL DEFAULT 'root',
	email    VARCHAR(50) NOT NULL,
	password CHAR(40)    NOT NULL,
	CONSTRAINT PK_Admins PRIMARY KEY CLUSTERED (id, email)
)";
//Test data to use
foreach ($queries as $key => $value) {
	echo "$key: ";
	run_query($connect, $value);
	echo "<br />";
}
echo "Tables created successfully or already exist. <br />";
//Insert permanent enumerated table values
$inserts[] = "INSERT INTO brandon.2601166_enum_a_types (a_type) VALUES ('fixed'),('input')";
$inserts[] = "INSERT INTO brandon.2601166_enum_q_types (q_type) VALUES ('radio'),('checkbox')";
//Insert testing values for other tables
$inserts[] = "INSERT INTO brandon.2601166_entity_users (firstname, lastname, username, email, password) VALUES ('Tarahe','Trash','Faasd3','freen@email.com',SHA1('bloopers1234#$')),('Martin','Ortega','donkey_face','grass@oregano.com',SHA1('password')),('Brandon','Ramirez','ToEndThePeace','bran.ramirez.don@gmail.com',SHA1('Yomommanobama13')),('Bloop','Bleep','Blargh123','bleeperz24@blotch.com',SHA1('TOKYO12345'))";
$inserts[] = "INSERT INTO brandon.2601166_entity_admins (username, email, password) VALUES ('root','bran.ramirez.don@gmail.com',SHA1('admin'))";
for ($i = 5; $i <= 50; $i++) {
	if ($i < 10) {
		$u_num = 0 . $i;
	} else {
		$u_num = $i;
	}
	$inserts['entity_users'] .= ",('First$u_num','Last$u_num','User$u_num','$u_num@email.com',SHA1('$u_num'))";
}
$inserts['entity_users'] .= ";";


foreach ($inserts as $key => $value) {
	echo "$key: ";
	run_query($connect, $value);
	echo "<br />";
}
//Close sql connection
$connect->close();
echo "<pre>";
print_r($inserts['entity_users']);
echo "</pre>";
?>



















