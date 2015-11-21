<?php # db_connect.php is used to connect to the database only
//Function to query database
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
$connect->select_db(DB_NAME);
?>



















