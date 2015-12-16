<?php # users.php # View Users
include('./scripts/db_connect.php');


session_start();
//
$page_title = "View Profile";

if (isset($_SESSION['user'])) {
	$_POST = [];
	$user = $_SESSION['user'];
}

$sql = "SELECT DISTINCT SEND.username AS send, SEND.id AS send_id, RECIP.username AS recip, RECIP.id AS recip_id FROM 2601166_entity_messages EM
        	INNER JOIN 2601166_xref_messages XM
        		ON EM.id = XM.message_id
        	INNER JOIN 2601166_entity_users SEND
        		ON SEND.id = XM.send_id
        	INNER JOIN 2601166_entity_users RECIP
        		ON RECIP.id = XM.recip_id
            WHERE SEND.id = {$_SESSION['id']} OR RECIP.id = {$_SESSION['id']};";
if ($response = $connect->query($sql)) {
    $messages = [];
    while ($row = $response->fetch_assoc()) {
        if (!isset($messages[$row['send_id']])) {
            $messages[$row['send_id']] = $row['send'];
        }
        if (!isset($messages[$row['recip_id']])) {
            $messages[$row['recip_id']] = $row['recip'];
        }
    }
    unset($messages[$_SESSION['id']]);
}

$content['messages']  = "<div class=\"grid clearfix\">";
$content['messages'] .= "<div class=\"col-1-1\">";
$content['messages'] .= "<h1>Messages</h1>";
$thing = "<ul><li class=\"underline push_bot_5\"><a>Message Threads</a></li>";
$result_id = 0;
foreach ($messages as $key => $value) {
    $result_id++;
    $thing .= "<li class=\"push_bot_5\" data-item-num-msg=\"$result_id\"><a href=\"view_messages.php?user=$key\">$value</a></li>";
}
$thing .= "</ul>";
$content['messages'] .= "<div class=\"grid clearfix list_surveys\">
                            <div class=\"col-1-1\">
                                $thing
                            </div>
                        </div>
                        <div id=\"msg_nav\" class=\"grid clearfix\">
                            <div class=\"col-1-2\">
                                <button id=\"msg_back\">&lt;</button>
                                <span id=\"msg_range\"></span>
                                <button id=\"msg_next\">&gt;</button>
                            </div>
                        </div>";
$content['messages'] .= "</div></div>";
$content['messages'] .= <<<_END
<script type="text/javascript">
	var users = new Pages('msg', $result_id, 1, 10);
</script>
_END;






include("./header.php");

//Put the inside of the #container tag in the following thingy
echo $content['messages'];
include("./footer.php");
?>