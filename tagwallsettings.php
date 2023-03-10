<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Tagwall Settings</title>
</head>
<body>
	<h1>Tagwall Settings</h1>
	
	<form method="post">
		<label for="per_page">Messages per page:</label>
		<select id="per_page" name="per_page">
			<option value="10">10</option>
			<option value="30">30</option>
			<option value="50">50</option>
		</select>
		<input type="submit" value="Save">
	</form>
	
	<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// get the selected number of messages per page from the form
		$per_page = intval($_POST["per_page"]);
		
		// save the settings to the tagwall settings file
		$tagwall_settings_file = "data/tagwallsettings.txt";
		file_put_contents($tagwall_settings_file, $per_page);
		echo "<p>Tagwall settings saved: {$per_page} messages per page.</p>";
	}
	?>
	
	<p><a href="index.html">Back to Home</a></p>
</body>
</html>
