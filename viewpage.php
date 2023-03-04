<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>View Page</title>
</head>
<body>
	<h1>View Page</h1>
	
	<?php
	// check if the page ID is specified in the query string
	if (!isset($_GET["id"])) {
		echo "<p>Page not found.</p>";
		exit;
	}
	
	$page_id = $_GET["id"];
	
	// read the page title and content from the file
	$page_file = "data/pages/{$page_id}.txt";
	if (file_exists($page_file)) {
		$page_data = file_get_contents($page_file);
		$page_title = "";
		
		// find the page title in the pages file
		$pages_file = "data/pages.txt";
		$pages_data = file_get_contents($pages_file);
		$pages = explode("\n", $pages_data);
		foreach ($pages as $page) {
			if (!empty($page)) {
				list($id, $title) = explode(":", $page);
				if ($id == $page_id) {
					$page_title = $title;
					break;
				}
			}
		}
		
		// display the page title and content
		echo "<h2>{$page_title}</h2>";
		echo "<pre>{$page_data}</pre>";
	} else {
		echo "<p>Page not found.</p>";
	}
	?>
	
	<p><a href="index.html">Back to Home</a></p>
</body>
</html>
