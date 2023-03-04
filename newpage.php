<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>New Page</title>
</head>
<body>
	<h1>New Page</h1>
	
	<form method="post">
		<label for="title">Title:</label>
		<input type="text" id="title" name="title">
		<br>
		<label for="content">Content:</label>
		<textarea id="content" name="content"></textarea>
		<br>
		<input type="submit" value="Create Page">
	</form>
	
	<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// read the existing pages from the file
		$pages_file = "data/pages.txt";
		$pages_data = file_get_contents($pages_file);
		
		// generate a new page ID
		$page_id = uniqid();
		
		// get the title and content from the form
		$title = $_POST["title"];
		$content = $_POST["content"];
		
		// append the new page to the pages file
		$new_page = "{$page_id}:{$title}\n";
		$pages_data .= $new_page;
		file_put_contents($pages_file, $pages_data);
		
		// create the new page file
		$page_file = "data/pages/{$page_id}.txt";
		file_put_contents($page_file, $content);
		
		// redirect to the new page
		header("Location: pagelist.php");
		exit;
	}
	?>
</body>
</html>
