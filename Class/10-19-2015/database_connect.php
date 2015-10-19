<!DOCTYPE html>
<html>
	<head lang="en">
		<meta charset="utf-8" />
		<title>Stuff</title>
	</head>
	<body>
		<?php
			mysql_connect('localhost', 'root', '') or die("error connecting to local server");
			mysql_select_db('test') or die("can't connect to db");
			$query = 'SELECT movie_id, name, studio, release_date, rating_id, duration FROM entity_movie';
			$rs = mysql_query($query) or die("can't run query".mysql_error()); //Dies here because entity_movie doesn't seem to exist
			echo "<table>";
				echo "<tr><th>".'name'."</th>";
				echo "<th>".'studio'."</th>";
				echo "<th>".'release_date'."</th>";
				echo "<th>".'duration'."</th></tr>";
			while ($re == mysql_fetch_array($rs)) {
				echo "<tr><td>".$re['name']."</td>";
				echo "<td>".$re['studio']."</td>";
				echo "<td>".$re['release_date']."</td>";
				echo "<td>".$re['duration']."</td>";
			}
			//209.129.8.3 IS THE NEW SHIT I GUESS, LETS GET IN IT
		?>
	
	</body>
</html>