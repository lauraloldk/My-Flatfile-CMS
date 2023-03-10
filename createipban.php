<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Create IP Ban</title>
</head>
<body>
	<h1>Create IP Ban</h1>
	
	<form method="post">
		<label for="ip">IP Address:</label>
		<input type="text" id="ip" name="ip">
		<input type="submit" value="Add">
	</form>
	
	<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// get the IP address from the form
		$ip = $_POST["ip"];
		
		// check if the IP address is valid
		if (filter_var($ip, FILTER_VALIDATE_IP)) {
			// add the IP address to the banned IP file
			$banned_ip_file = "data/bannedIP.txt";
			$banned_ips = file($banned_ip_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
			if (!in_array($ip, $banned_ips)) {
				$banned_ips[] = $ip;
				file_put_contents($banned_ip_file, implode("\n", $banned_ips) . "\n");
				echo "<p>IP address {$ip} has been added to the banned list.</p>";
			} else {
				echo "<p>IP address {$ip} is already in the banned list.</p>";
			}
		} else {
			echo "<p>Invalid IP address.</p>";
		}
	}
	?>
</body>
</html>
