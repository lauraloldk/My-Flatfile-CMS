<?php
// read the list of banned IP addresses from the file
$banned_ip_file = "data/bannedIP.txt";
$banned_ips = file($banned_ip_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// get the visitor's IP address
$visitor_ip = $_SERVER["REMOTE_ADDR"];

// check if the visitor's IP address is in the banned list
if (in_array($visitor_ip, $banned_ips)) {
	// redirect the visitor to the home page
	header("Location: index.html");
	exit;
}
?>
