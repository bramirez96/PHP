<?php # users.php # View Users
include('./scripts/db_connect.php');


session_start();
//
$page_title = "View Profile";

if (isset($_SESSION['user'])) {
	$_POST = [];
	$user = $_SESSION['user'];
}

$sql = "SELECT SEND.username AS send, SEND.id AS send_id, RECIP.username AS recip, RECIP.id AS recip_id, message, timestamp FROM 2601166_entity_messages EM
        	INNER JOIN 2601166_xref_messages XM
        		ON EM.id = XM.message_id
        	INNER JOIN 2601166_entity_users SEND
        		ON SEND.id = XM.send_id
        	INNER JOIN 2601166_entity_users RECIP
        		ON RECIP.id = XM.recip_id
            WHERE (SEND.id = {$_SESSION['id']} OR SEND.id = {$_GET['user']}) AND (RECIP.id = {$_SESSION['id']} OR RECIP.id = {$_GET['user']})
            ORDER BY timestamp DESC;";
if ($response = $connect->query($sql)) {
    $messages = [];
    while ($row = $response->fetch_assoc()) {
        if ($row['send_id'] == $_SESSION['id']) {
            $messages[] = array(
                "message" => $row['message'],
                "time"    => $row['timestamp'],
                "sender"  => $row['send'],
                "send_id" => $row['send_id'],
                "class"   => "left"
            );
        } else {
            $messages[] = array(
                "message" => $row['message'],
                "time"    => $row['timestamp'],
                "send_id" => $row['send_id'],
                "sender"  => $row['send'],
                "class"   => "right"
            );
        }
    }
}
$content['msg'] = "<div class=\"grid clearfix\">
                        <div class=\"col-auto\">
                            <textarea name=\"msg\" maxlength=\"8000\" cols=\"70\" rows=\"5\" placeholder=\"Type message here.\" form=\"newMsg\" autofocus></textarea>
                            <span id=\"empty\" class=\"red\"></span><br />
                            <form id=\"newMsg\" method=\"POST\" action=\"new_message.php\" onsubmit=\"javascript:if (document.getElementsByName('msg')[0].value=='') return dontSubmit();\">
                                <input type=\"submit\" value=\"Send Message\" />
                                <input type=\"hidden\" name=\"sendTo\" value=\"{$_GET['user']}\" />
                            </form>
                        </div>
                    </div>
                    <script type=\"text/javascript\">
                        function dontSubmit() {
                            O('empty').innerHTML = 'Message is empty!';
                            return false;
                        }
                    </script>
                ";
$content['msg'] .= "<div class=\"grid clearfix\">";
$content['msg'] .= "<div class=\"col-1-2\">";
for ($c = 0; $c < count($messages); $c++) {
    $content['msg'] .= "
        <div class=\"grid clearfix\">
            <div class=\"col-1-4 float-{$messages[$c]['class']} {$messages[$c]['class']}\">
                    <img class=\"msg\" src=\"./images/img_frame.png\" />
            </div>
            <div class=\"col-3-4 {$messages[$c]['class']} normal\">
                <h3><a href=\"./profile.php?user={$messages[$c]['send_id']}\">{$messages[$c]['sender']}</a>:</h3>
                <p>
                    {$messages[$c]['message']}<br />
                    <span class=\"tiny\">{$messages[$c]['time']}</span>
                </p>
            </div>
        </div>
    ";
}
$content['msg'] .= "</div><div class=\"col-1-2\"></div></div>";






include("./header.php");

//Put the inside of the #container tag in the following thingy
echo $content['msg'];
include("./footer.php");
?>