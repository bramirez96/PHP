<?php # users.php # View Users
include('./scripts/db_connect.php');


session_start();
//
$page_title = "View Profile";

if (isset($_SESSION['user'])) {
	$_POST = [];
	$user = $_SESSION['user'];
}
$isMe = $_GET['user'] == $_SESSION['id'] ? true : false;
$sql = "SELECT firstname, lastname, username, about, id FROM 2601166_entity_users EU WHERE id = " . $_GET['user'] . ";";
if ($result = $connect->query($sql)) {
    if ($result->num_rows == 1) {
        while ($row = $result->fetch_assoc()) {
            $content['profile'] = "
                <div class=\"grid clearfix\">
                    <div class=\"col-auto\">
                        <img id=\"profile_pic\" src=\"./images/img_frame.png\" />
                    </div>
                    <div class=\"col-auto\">
                        <h1 style=\"margin-bottom:-7px;\">{$row['username']}" . ($isMe ? " <a class=\"tiny\" href=\"edit_profile.php?user={$row['id']}\">Edit Profile</a>" : "") . "</h1>
                        <h2>{$row['firstname']} {$row['lastname']}</h2>
                        <p>
                            {$row['about']}
                        </p>
                    </div>
                </div>";
            if ($isMe) {
                $content['profile'] .= "
                    <div class=\"grid clearfix\">
                        <div class=\"col-auto\">
                            <textarea name=\"status\" maxlength=\"8000\" cols=\"50\" rows=\"5\" placeholder=\"Post a status.\" form=\"newStatus\" autofocus></textarea><br />
                            <form id=\"newStatus\" method=\"POST\" action=\"new_status.php\">
                                <input type=\"submit\" value=\"Post Status\" />
                            </form>
                        </div>
                    </div>
                ";
            }
                $exists = true;
        }
    } else {
        $content['profile'] = "
            <div class=\"grid clearfix\">
                <div class=\"col-1-1\">
                    User not found.
                </div>
            </div>";
        $exists = false;
    }
}
if ($exists) {
//This code is for statuses
    $sql = "SELECT ES.id, timestamp, status FROM 2601166_entity_statuses ES
                INNER JOIN 2601166_xref_statuses XS
                    ON ES.id = XS.status_id
                INNER JOIN 2601166_entity_users EU
                    ON EU.id = XS.poster_id
                WHERE poster_id = {$_GET['user']}
    			ORDER BY timestamp DESC";
    if ($result = $connect->query($sql)) {
    	$content['profile'] .= "<div class=\"grid clearfix\"><div class=\"col-1-1\">";
    	$thing = "<ul>";
    	$result_id = 0;
    	while ($row = $result->fetch_row()) {
    		$result_id++;
    		$thing .= "<li class=\"push_bot_5\" data-item-num-users=\"$result_id\">
    		                <div class=\"grid clearfix\">
    		                    <div class=\"col-1-8\">
    		                        {$_SESSION['user']}:
    		                    </div>
    		                    <div class=\"col-7-8\">
        		                    {$row[2]}<br />
        		                    <span class=\"tiny\">{$row[1]}</span>
                                </div>
    		                </div></li>";
    	}
    	$thing .= "</ul>";
    	$content['profile'] .= "<div class=\"grid clearfix list_surveys\">
    							<div class=\"col-1-1\">
    								$thing
    							</div>
    						</div>
    						<div class=\"grid clearfix\">
    							<div class=\"col-1-1 center\">
    								<button id=\"users_back\">&lt;</button>
    								<span id=\"users_range\"></span>
    								<button id=\"users_next\">&gt;</button>
    							</div>
    						</div>";
    	$content['profile'] .= "</ul></div></div>";
    	$content['profile'] .= <<<_END
    <script type="text/javascript">
    	var users = new Pages('users', $result_id, 1, 15);
    </script>
_END;
    } else {
    	$content['profile'] .= "
    <div class=\"grid clearfix\">
        <div class=\"col-1-1\">	
    		<p>
    			This user hasn't posted any statuses.
    		</p>
        </div>
    </div>";
    }
}
include("./header.php");

//Put the inside of the #container tag in the following thingy
echo $content['profile'];
include("./footer.php");
?>