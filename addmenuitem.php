<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Add Menu Item</title>
</head>
<body>
	<h1>Add Menu Item</h1>
	<form action="addmenuitem.php" method="post">
		<label for="text">Text:</label>
		<input type="text" name="text" required>
		<br>
		<label for="link">Link:</label>
		<input type="text" name="link" required>
		<br>
		<input type="submit" value="Add">
	</form>
	<?php
	// check if the form was submitted
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// read the existing menu items from the file
		$menu_file = "data/menu.txt";
		$menu_data = file_get_contents($menu_file);
		
		// add the new menu item to the file
		$text = $_POST["text"];
		$link = $_POST["link"];
		$new_item = "{" . $text . ":" . $link . "}";
		$menu_data .= $new_item . "\n";
		file_put_contents($menu_file, $menu_data);
		
		// display a success message
		echo "<p>Menu item added successfully!</p>";
	}
	?>
</body>
</html>
