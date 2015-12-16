<?php ## conect_to_db.php is used to connect to the database and create database/tables
include('./db_connect.php');

//Including a delete to be removed later
if ($connect->query('DROP DATABASE IF EXISTS ' . DB_NAME) === TRUE) {
	echo "Deleted existing database or it wasn't there. Clean start. <br />";
} else {
	echo "Whoa whoa whoa man: " . $connect->error;
}
//Create the database
$newDB = "CREATE DATABASE " . DB_NAME;
if ($connect->query($newDB) === TRUE) {
	echo "Database created successfully.";
} else {
	die("Database creation failed: " . $connect->error);
}
echo "<br />";
//Select database
$connect->select_db(DB_NAME);
//the following queries create the tables
//!entity_users
$queries[] = "CREATE TABLE IF NOT EXISTS 2601166_entity_users (
	id        INT(6)        NOT NULL AUTO_INCREMENT,
	firstname VARCHAR(20)   NOT NULL,
	lastname  VARCHAR(20)   NOT NULL,
	username  VARCHAR(20)   NOT NULL,
	email     VARCHAR(30)   NOT NULL,
	password  CHAR(40)      NOT NULL,
	about     VARCHAR(8000) DEFAULT '',
	CONSTRAINT PK_Users PRIMARY KEY CLUSTERED (id, email)
)";
//!entity_profiles
$queries[] = "CREATE TABLE IF NOT EXISTS 2601166_entity_profiles (
	id      INT(6)        NOT NULL AUTO_INCREMENT,
	about   VARCHAR(8000),
	CONSTRAINT PK_Profiles PRIMARY KEY CLUSTERED (id)
)";
//!entity_messages
$queries[] = "CREATE TABLE IF NOT EXISTS 2601166_entity_messages (
    id        INT(6)        NOT NULL AUTO_INCREMENT,
    timestamp TIMESTAMP     NOT NULL DEFAULT NOW(),
    message   VARCHAR(8000) NOT NULL,
    CONSTRAINT PK_Messages PRIMARY KEY CLUSTERED (id)
)";
//!entity_statuses
$queries[] = "CREATE TABLE IF NOT EXISTS 2601166_entity_statuses (
    id        INT(6)        NOT NULL AUTO_INCREMENT,
    timestamp TIMESTAMP     NOT NULL DEFAULT NOW(),
    status    VARCHAR(8000) NOT NULL,
    CONSTRAINT PK_Statuses PRIMARY KEY CLUSTERED (id)
)";
//!entity_posts
$queries[] = "CREATE TABLE IF NOT EXISTS 2601166_entity_posts (
    id        INT(6)        NOT NULL AUTO_INCREMENT,
    timestamp TIMESTAMP     NOT NULL DEFAULT NOW(),
    post      VARCHAR(8000) NOT NULL,
    CONSTRAINT PK_Posts PRIMARY KEY CLUSTERED (id)
)";
//!xref_messages
$queries[] = "CREATE TABLE IF NOT EXISTS 2601166_xref_messages (
    xref_id  INT(6) NOT NULL AUTO_INCREMENT,
    send_id  INT(6) NOT NULL,
    recip_id INT(6) NOT NULL,
    CONSTRAINT PK_Xref_Messages   PRIMARY KEY CLUSTERED (xref_id),
    CONSTRAINT FK_Messages_Sender FOREIGN KEY (send_id)  REFERENCES 2601166_entity_users(id),
    CONSTRAINT FK_Messages_Sendee FOREIGN KEY (recip_id) REFERENCES 2601166_entity_users(id)
)";
//!xref_statuses
$queries[] = "CREATE TABLE IF NOT EXISTS 2601166_xref_statuses (
    xref_id   INT(6) NOT NULL AUTO_INCREMENT,
    poster_id INT(6) NOT NULL,
    status_id INT(6) NOT NULL,
    CONSTRAINT PK_Xref_Statuses   PRIMARY KEY CLUSTERED (xref_id),
    CONSTRAINT FK_Statuses_Poster FOREIGN KEY (poster_id) REFERENCES 2601166_entity_users(id),
    CONSTRAINT FK_Statuses_Status FOREIGN KEY (status_id) REFERENCES 2601166_entity_statuses(id)
)";
//!xref_posts
$queries[] = "CREATE TABLE IF NOT EXISTS 2601166_xref_posts (
    xref_id   INT(6) NOT NULL AUTO_INCREMENT,
    poster_id INT(6) NOT NULL,
    post_id   INT(6) NOT NULL,
    CONSTRAINT PK_Xref_Posts    PRIMARY KEY CLUSTERED (xref_id),
    CONSTRAINT FK_Posts_Poster FOREIGN KEY (poster_id) REFERENCES 2601166_entity_users(id),
    CONSTRAINT FK_Posts_Post   FOREIGN KEY (post_id)   REFERENCES 2601166_entity_posts(id)
)";
//!entity_admin
$queries[] = "CREATE TABLE IF NOT EXISTS 2601166_entity_admins (
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
//Insert testing values for other tables
$inserts['entity_users'] = "INSERT INTO 2601166_entity_users (firstname, lastname, username, email, password) VALUES ('Tarahe','Trash','Faasd3','freen@email.com',SHA1('bloopers1234#$')), ('Martin','Ortega','donkey_face','grass@oregano.com',SHA1('password')),('Brandon','Ramirez','ToEndThePeace','bran.ramirez.don@gmail.com',SHA1('Yomommanobama13')),('Bloop','Bleep','Blargh123','bleeperz24@blotch.com',SHA1('TOKYO12345'))";
$inserts[] = "INSERT INTO 2601166_entity_admins (username, email, password) VALUES ('root','bran.ramirez.don@gmail.com',SHA1('admin'))";
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
print_r($queries);
echo "</pre>";
?>



















