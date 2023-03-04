<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Page List</title>
</head>
<body>
	<h1>Page List</h1>
	
	<?php
	// read the list of pages from the file
	$pages_file = "data/pages.txt";
	$pages_data = file_get_contents($pages_file);
	$pages = explode("\n", $pages_data);
	
	// generate a link for each page
	echo "<ul>";
	foreach ($pages as $page) {
		if (!empty($page)) {
			list($id, $title) = explode(":", $page);
			echo "<li>{$title} <a href=\"viewpage.php?id={$id}\">Show page</a></li>";
		}
	}
	echo "</ul>";
	?>
	
	<p><a href="index.html">Back to Home</a></p>
</body>
</html>
