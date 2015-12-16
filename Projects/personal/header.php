<?php
$logged_in = FALSE;
if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
	$logged_in = TRUE;
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title><?php echo $page_title . " - SocialMongoose"; ?></title>
		<link rel="stylesheet" type="text/css" href="./styles/main.css" />
		<script type="text/javascript" src="./scripts/paginate.js"></script>
	</head>
	<body>
		<div id="container" class="clearfix">
			<div id="header-wrap">
				<header class="content">
					<div id="notLogo">
						<h1>Social<span class="light">Mongoose</span></h1>
						<nav>
							<ul>
								<?php
									if ($logged_in) {
										echo "<li><a href=\"./index.php\">Home</a></li>
										    <li><a href=\"./users.php\">View Users</a></li>
										    <li><a href=\"./messages.php\">Messages</a></li>
											<li class=\"float-right\"><a href=\"./logout.php\">Log Out</a></li>
										    <li class=\"float-right\"><a href=\"./profile.php?user={$_SESSION['id']}\">My Profile</a></li>
											<li class=\"float-right\">Logged in as: <span class=\"blue\">" . $user . "</span></li>";
									} else {
										echo "<li><a href=\"./index.php\">Log In</a></li>
											<li><a href=\"./signup.php\">Sign Up</a></li>";
									}
								?>
							</ul>
						</nav>
					</div> <!-- End #notLogo -->
				</header>
			</div> <!-- End #header-wrap -->
			<div class="content">