<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Tagwall</title>
</head>
<body>
	<h1>Tagwall</h1>
	
	<form method="post">
		<label for="name">Name:</label>
		<input type="text" id="name" name="name">
		<label for="message">Message:</label>
		<input type="text" id="message" name="message">
		<input type="submit" value="Post">
	</form>
	
	<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// get the name and message from the form
		$name = $_POST["name"];
		$message = $_POST["message"];
		
		// add the message to the tagwall file
		$tagwall_file = "data/tagwall.txt";
		$line = "{$name}:{$message}\n";
		file_put_contents($tagwall_file, $line, FILE_APPEND);
	}
	?>
	
	<?php include "tagwallposts.php"; ?>
	
	<p><a href="index.html">Back to Home</a></p>
</body>
</html>
