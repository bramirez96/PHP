<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title><?php echo $page_title; ?></title>
		<link rel="stylesheet" type="text/css" href="./styles/main.css" />
	</head>
	<body>
		<div id="container" class="clearfix">
			<div id="header-wrap">
				<header class="content">
					<a href="./index.php" title="Home" id="logo">Logo</a>
					<div id="notLogo">
						<h1>SurveyWhiz</h1>
						<nav>
							<ul>
								<li><a href="./index.php">Home</a></li>
								<li><a href="#">Create Survey</a></li>
								<li><a href="#">View Users</a></li>
								<li><a href="#">Log Out</a></li>
								<li class="float-right">Logged in as: <?php echo $user; ?></li>
							</ul>
						</nav>
					</div> <!-- End #notLogo -->
				</header>
			</div> <!-- End #header-wrap -->
			<div class="content">