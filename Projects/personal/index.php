<?php #index.php //Just some shit (I want whiskey)
#Day 2... still want some fucking whiskey
include('./scripts/db_connect.php');


session_start();
//
$page_title = "Home";
$user = "Guest";

if (isset($_SESSION['user'])) {
	$_POST = [];
	$user = $_SESSION['user'];
}
if (!empty($_POST)) { //Checks if the page was submitted or loaded from a link
	$content['count'] = 0;#61a3d7
	foreach ($_POST as $key => $value) {
		if (empty($value)) {
			$error[$key] = "*";
			$content[$key] = "";
		} else {
			$error[$key] = "";
			$content[$key] = $value;
			if (!isset($content['count'])) $content['count'] = 1;
			else $content['count'] += 1;
		}
	}
	if ($content['count'] === 2) {
		$sql = "SELECT password, username, firstname, email, id FROM 2601166_entity_users WHERE email = '{$content['email']}'";
		if ($response = $connect->query($sql)) {
			if ($response->num_rows != 0) {
				while ($row = $response->fetch_assoc()) {
					//Check to see if this shit is working
					if ($row['password'] === sha1($content['pass'])) {
						$_SESSION['user'] = $row['username'];
						$_SESSION['id'] = $row['id'];
						$_SESSION['name'] = $row['firstname'];
						$_SESSION['email'] = $row['email'];
					} else {
    					$error['pass'] = "*";
					}
				}
				$response->free();
			} else {
    			$error['email'] = "*";
    			$error['pass'] = "*";
			}
		}
	}
} else {
	$content = [
		"email" => ""	
	];
	$error = [
		"email" => "",
		"pass"  => "",
		"extras" => ""
	];
}



if (!isset($_SESSION['user'])) { //!Change - if session variable for user is set
	$content['login'] = "<div class=\"grid clearfix\"><div class=\"col-1-1\">";
	$content['login'] .= <<<_END
<div class="grid clearfix">
    <div class="col-1-1">
        <form method="post" action="./index.php">
            <h1>Log In:</h1>
            <div class="grid clearfix nopad">
                <div class="col-1-1">
                    <div class="grid clearfix">
                        <div class="col-1-8">
                            Email:<br />
                        </div>
                        <div class="col-7-8">
                            <input type="text" name="email" value="{$content['email']}" />
                            <span class="red">{$error['email']}</span>
                        </div>
                    </div>
                    <div class="grid clearfix">
                        <div class="col-1-8">
                            Password:
                        </div>
                        <div class="col-7-8">
                            <input type="password" name="pass" />
                            <span class="red">{$error['pass']}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid clearfix">
                <div class="col-1-1">
                    <input type="submit" />
                </div>
            </div>
        </form>
    </div>
</div>  
_END;
	$content['login'] .= "</div></div>";
} else { //If user is logged in
    $sql = "SELECT EU.id AS id, firstname, lastname, username, status, timestamp FROM 2601166_entity_statuses ES
            	INNER JOIN 2601166_xref_statuses XS
            		ON XS.status_id = ES.id
            	INNER JOIN 2601166_entity_users EU
            		ON EU.id = XS.poster_id
            	WHERE EU.id <> {$_SESSION['id']}
            	ORDER BY timestamp DESC;";
    if ($response = $connect->query($sql)) {
        $content['feed'] = "<div class=\"grid clearfix\"><div class=\"col-1-1\">";
        $thing = "<ul><li class=\"push_bot_5\"><h2>Live Feed</h2></li>";
        $result_id = 0;
        while ($row = $response->fetch_assoc()) {
            $result_id++;
            $thing .= "<li class=\"push_bot_5\" data-item-num-feed=\"$result_id\">
                            <div class=\"grid clearfix\">
                                <div class=\"col-1-8\">
                                    <img class=\"msg\" src=\"./images/img_frame.png\" />
                                </div>
                                <div class=\"col-7-8 normal\">
                                    <h3><a href=\"./profile.php?user={$row['id']}\">{$row['firstname']} {$row['lastname']}</a> <span class=\"tiny\">{$row['username']}</span></h3>
                                    <p>
                                        {$row['status']}<br />
                                        <span class=\"tiny\">{$row['timestamp']}</span>
                                    </p>
                                </div>
                            </div>
                        </li>";
        }
        $thing .= "</ul>";
        $content['feed'] .= "$thing 
                        <div id=\"feed_nav\" class=\"grid clearfix\">
                            <div class=\"col-1-1 center\">
                                <button id=\"feed_back\">&lt;</button>
                                <span id=\"feed_range\"></span>
                                <button id=\"feed_next\">&gt;</button>
                            </div>
                        </div>
                    </div>
                </div>";
    } else {
        $content['feed'] = "Couldn't load feed.";
    }
	$content['login'] = <<<_END
<div class="grid clearfix">
    <div class="col-1-1">
        <h1>Welcome, {$_SESSION['user']}!</h1>
        <div class="grid clearfix">
            {$content['feed']}
        </div>
    </div>
</div>
<script type="text/javascript">
    var feed = new Pages("feed", $result_id, 1, 10);
</script>
_END;
}
include("./header.php");

//Put the inside of the #container tag in the following thingy
echo $content['login'];
include("./footer.php");
?>