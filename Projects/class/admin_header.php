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
		<title><?php echo $page_title . " - SurveyWhiz"; ?></title>
		<link rel="stylesheet" type="text/css" href="./styles/main.css" />
	</head>
	<body>
		<div id="container" class="clearfix">
			<div id="header-wrap">
				<header class="content">
					<div id="notLogo">
						<h1>Survey<span class="light">Whiz</span></h1>
						<nav>
							<ul>
								<li><a href="./admin_index.php?sort=lastname">View Users</a></li>
								<li><a href="./ad_view_surveys.php?sort=title">View Surveys</a></li>
								<li class="float-right"><a href="./logout.php">Log Out</a></li>
								<li class="float-right">Logged in as: <span class="blue"><?php echo $user ?></span></li>
							</ul>
						</nav>
					</div> <!-- End #notLogo -->
				</header>
			</div> <!-- End #header-wrap -->
			<div class="content">