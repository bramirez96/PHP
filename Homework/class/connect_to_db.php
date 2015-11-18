<?php ## conect_to_db.php is used to connect to the database and create database/tables
//Gonna use this page for CLASS PROJECT
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "brandon");
//Function to call SQL queries
function run_query($con, $sql) {
	if ($con->query($sql) === TRUE) {
		echo "Query executed successfully.";
	} else {
		echo "Query execution failed: " . $con->error;
	}
}
//Connect to host
$connect = new mysqli(DB_HOST, DB_USER, DB_PASS);
//Check the connection status
if ($connect->connect_error) {
	die("Connection failed: " . $connect->error);
}
echo "Connected successfully.";
echo "<br />";
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
$queries[] = "CREATE TABLE IF NOT EXISTS brandon.entity_users (
id        INT(6)        NOT NULL AUTO_INCREMENT,
firstname VARCHAR(20)   NOT NULL,
lastname  VARCHAR(20)   NOT NULL,
username  VARCHAR(20)   NOT NULL,
email     VARCHAR(30)   NOT NULL,
password  CHARACTER(40) NOT NULL,
CONSTRAINT PK_Users PRIMARY KEY CLUSTERED (id, email)
)";
$queries[] = "CREATE TABLE IF NOT EXISTS brandon.entity_surveys (
id      INT(6)      NOT NULL AUTO_INCREMENT,
title   VARCHAR(20) NOT NULL,
open    DATE        NOT NULL,
close   DATE        NOT NULL,
CONSTRAINT PK_Surveys PRIMARY KEY CLUSTERED (id)
)";
$queries[] = "CREATE TABLE IF NOT EXISTS brandon.xref_users_surveys (
xref_id   INT(6) NOT NULL AUTO_INCREMENT,
user_id   INT(6) NOT NULL,
survey_id INT(6) NOT NULL,
CONSTRAINT PK_User_Reference_Survey PRIMARY KEY CLUSTERED (xref_id, user_id, survey_id),
CONSTRAINT FK_User_Survey     		FOREIGN KEY (user_id)   REFERENCES brandon.entity_users(id),
CONSTRAINT FK_Survey_User           FOREIGN KEY (survey_id) REFERENCES brandon.entity_surveys(id)
)";
$queries[] = "CREATE TABLE IF NOT EXISTS brandon.entity_questions (
id         INT(6)      NOT NULL AUTO_INCREMENT,
question   VARCHAR(50) NOT NULL,
type       INT(1)      NOT NULL,
CONSTRAINT PK_Questions PRIMARY KEY CLUSTERED (id)
)";
$queries[] = "CREATE TABLE IF NOT EXISTS brandon.xref_surveys_questions (
xref_id     INT(6) NOT NULL AUTO_INCREMENT,
survey_id   INT(6) NOT NULL,
question_id INT(6) NOT NULL,
CONSTRAINT PK_Survey_Reference_Question PRIMARY KEY CLUSTERED (xref_id, survey_id, question_id),
CONSTRAINT FK_Survey_Question           FOREIGN KEY (survey_id)   REFERENCES brandon.entity_surveys(id),
CONSTRAINT FK_Question_Survey           FOREIGN KEY (question_id) REFERENCES brandon.entity_questions(id)
)";
$queries[] = "CREATE TABLE IF NOT EXISTS brandon.enum_q_types (
enum_id INT(1)      NOT NULL AUTO_INCREMENT,
type    VARCHAR(10) NOT NULL,
CONSTRAINT PK_Enum_Question PRIMARY KEY CLUSTERED (enum_id)
)";
$queries[] = "CREATE TABLE IF NOT EXISTS brandon.entity_answers (
id           INT(6)      NOT NULL AUTO_INCREMENT,
answer       VARCHAR(50) NOT NULL,
CONSTRAINT PK_Answer PRIMARY KEY CLUSTERED (id)
)";
$queries[] = "CREATE TABLE IF NOT EXISTS brandon.xref_questions_answers (
xref_id     INT(6) NOT NULL AUTO_INCREMENT,
question_id INT(6) NOT NULL,
answer_id   INT(6) NOT NULL,
CONSTRAINT PK_Question_Reference_Answer PRIMARY KEY CLUSTERED (xref_id, question_id, answer_id),
CONSTRAINT FK_Question_Answer           FOREIGN KEY (question_id) REFERENCES brandon.entity_questions(id),
CONSTRAINT FK_Answer_Question           FOREIGN KEY (answer_id)   REFERENCES brandon.entity_answers(id)
)";
//Test data to use
foreach ($queries as $key => $value) {
	echo "$key: ";
	run_query($connect, $value);
	echo "<br />";
}
echo "Tables created successfully or already exist.";
//Insert values into tables (enum values arent for testing, they're permanent)
$inserts[] = "INSERT INTO brandon.enum_q_types (type) VALUES ('SHIT');
              INSERT INTO brandon.enum_q_types (type) VALUES ('')";
foreach ($inserts as $key => $value) {
	echo "$key: ";
	run_query($connect, $value);
	echo "<br />";
}
//Close sql connection
$connect->close();
?>



















