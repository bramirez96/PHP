<?php # check_survey.php only for testing
include('./db_connect.php');
$page_title = "View Survey";
session_start();


include('./scripts/make_form.php');

$content['form'] = (!empty($_POST) ? "<div class=\"grid clearfix\"><div class=\"col-1-1\"><p class=\"red\">Survey works! No data saved.</h1></div></div>" : "");
$content['form'] .= make_form($connect->real_escape_string($_GET['survey']), $connect);


include('./header.php');
echo $content['form'];
include('./footer.php');
	
?>