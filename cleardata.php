<!DOCTYPE html>
<html>
<head>
	<title>Clear Data</title>
</head>
<body>
	<h1>Clear Data</h1>
	<form method="post" action="">
		<p>Click the button below to clear all user data:</p>
		<input type="submit" name="clear-user-data" value="Clear user data">
	</form>
</body>
</html>

<?php
if (isset($_POST["clear-user-data"])) {
    // Clear the user data files
    file_put_contents("/storage/ssd3/504/20352504/public_html/data/users/username.txt", "");
    file_put_contents("/storage/ssd3/504/20352504/public_html/data/users/password.txt", "");
    file_put_contents("/storage/ssd3/504/20352504/public_html/data/users/banned.txt", "");
    file_put_contents("/storage/ssd3/504/20352504/public_html/data/users/isAdmin.txt", "");
    file_put_contents("/storage/ssd3/504/20352504/public_html/data/users/id.txt", "");
    file_put_contents("/storage/ssd3/504/20352504/public_html/data/users/adminMenuChecked.txt", "");
    
    echo "<p>User data has been cleared</p>";
}
?>