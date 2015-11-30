<?php # submit_survey.php only for testing
include('./db_connect.php');
$page_title = "Survey Complete";
session_start();


$content['form'] = make_form($_GET['survey'], $connect);
if (isset($_POST)) {
	foreach ($_POST as $key => $value) {
		foreach ($value as $value2) {
			$content['form'] .= "$key: $value2 <br />";
		}
	}
}


include('./header.php');
echo $content['form'];
include('./footer.php');
?>