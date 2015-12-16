<?php #logout.php //Just some shit (I want whiskey)

session_start();
//
$page_title = "Log Out";
$user = "Guest";

session_unset();
session_destroy();
$content['logout'] = <<<_END
<h2>
	You&rsquo;ve successfully logged out.
</h2>
_END;
include("./header.php");
//Put the inside of the #container tag in the following thingy
echo <<<_END
	<div class="grid clearfix">
		<div class="col-1-2">
			{$content['logout']}
		</div>
		<div class="col-1-4">
			
		</div>
	</div>
_END;
include("./footer.php");
?>