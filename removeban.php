<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Remove Ban</title>
</head>
<body>
	<h1>Remove Ban</h1>
	
	<?php
	// read the list of banned IP addresses from the file
	$banned_ip_file = "data/bannedIP.txt";
	$banned_ips = file($banned_ip_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	
	// check if any IP address was selected for removal
	if (isset($_POST["remove"])) {
		$remove_ip = $_POST["remove"];
		// remove the selected IP address from the list
		$key = array_search($remove_ip, $banned_ips);
		if ($key !== false) {
			unset($banned_ips[$key]);
			file_put_contents($banned_ip_file, implode("\n", $banned_ips) . "\n");
			echo "<p>IP address {$remove_ip} has been removed from the banned list.</p>";
		}
	}
	
	// display the list of banned IP addresses with delete buttons
	if (count($banned_ips) > 0) {
		echo "<ul>";
		foreach ($banned_ips as $ip) {
			echo "<li>{$ip} <form method=\"post\"><button type=\"submit\" name=\"remove\" value=\"{$ip}\">Delete</button></form></li>";
		}
		echo "</ul>";
	} else {
		echo "<p>No banned IP addresses found.</p>";
	}
	?>
	
	<p><a href="index.html">Back to Home</a></p>
</body>
</html>
