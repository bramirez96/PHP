<?php # users.php # View Users
include('./scripts/db_connect.php');


session_start();
//
$page_title = "View Profile";

if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
}
function cleanInput($input) {
    $search = array(
        '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
        '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
        '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
        '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
    );
    $output = preg_replace($search, '', $input);
    return $output;
}
function sanitize($input) {
    if (is_array($input)) {
        foreach($input as $var=>$val) {
            $output[$var] = sanitize($val);
        }
    }
    else {
        if (get_magic_quotes_gpc()) {
            $input = stripslashes($input);
        }
        $input  = cleanInput($input);
        $output = mysql_real_escape_string($input);
    }
    if (isset($output)) {
        return $output;
    }
}
$_POST = sanitize($_POST);
$_GET  = sanitize($_GET);

$msg = $_POST['msg'];
$recip = $_POST['sendTo'];
$sql[] = "START TRANSACTION;";
$sql[] = "INSERT INTO 2601166_entity_messages (message) VALUES ('$msg');";
$sql[] = "SELECT LAST_INSERT_ID() INTO @CUR_MSG_ID;";
$sql[] = "INSERT INTO 2601166_xref_messages (send_id, recip_id, message_id) VALUES ({$_SESSION['id']}, $recip, @CUR_MSG_ID);";
$sql[] = "COMMIT;";


foreach ($sql as $query) {
	if ($connect->query($query)) {
        $content['status'] = "
            <div class=\"grid clearfix\">
                <div class=\"col-1-1\">
                    Successfully sent message:<br />
                    $msg<br />
                    <a href=\"./view_messages.php?user=$recip\">Click here</a> to view the message.
                </div>
            </div>";
	} else {
		$connect->query("ROLLBACK;");
        $content['status'] = "
            <div class=\"grid clearfix\">
                <div class=\"col-1-1\">
                    Your message could not be sent. <a href=\"./view_messages.php?user=$recip\">Click here</a> to return to your messages and try again.
                </div>
            </div>";
		break;
    }
}
include("./header.php");

//Put the inside of the #container tag in the following thingy
echo $content['status'];
include("./footer.php");
?>