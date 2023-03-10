<?php
// load the tagwall file
$tagwall_file = "data/tagwall.txt";
$lines = file($tagwall_file);
$lines = array_reverse($lines);

// get the number of posts per page from the settings file
$settings_file = "data/tagwallsettings.txt";
$lines_settings = file($settings_file);
$posts_per_page = intval(trim($lines_settings[0]));

// get the current page number from the URL parameter
$current_page = 1;
if (isset($_GET["page"])) {
    $current_page = intval($_GET["page"]);
}

// calculate the total number of pages
$total_pages = ceil(count($lines) / $posts_per_page);

// calculate the starting index for the current page
$start_index = ($current_page - 1) * $posts_per_page;

// iterate over the lines and print them
for ($i = $start_index; $i < count($lines) && $i < $start_index + $posts_per_page; $i++) {
    // parse the name and message from the line
    list($name, $message) = explode(":", $lines[$i], 2);

    // get the username from the IP profiles file
    $ip_profiles_file = "data/IPprofiles.txt";
    $ip_profiles = file($ip_profiles_file, FILE_IGNORE_NEW_LINES);
    $found = false;
    foreach ($ip_profiles as $ip_profile) {
        list($ip, $username, $isadmin) = explode(":", $ip_profile);
        if ($ip == $_SERVER["REMOTE_ADDR"]) {
            $name = $username;
            $found = true;
            break;
        }
    }

    // print the name and message
    echo "<h3>{$name}</h3>";
    echo "<p>{$message}</p>";

    // add a delete link for admins
    if ($found && $isadmin == 1) {
        echo "<p><a href=\"deletetag.php?id=" . ($i+1) . "\">Delete</a></p>";
    }
}

// print the pagination links
if ($total_pages > 1 && $current_page < $total_pages) {
    $next_page = $current_page + 1;
    $prev_page = $current_page - 1;
    if($current_page > 1){
        echo "<a href=\"tagwall.php?page={$prev_page}\"><--</a>";    
    }
    if($current_page < $total_pages){
        echo "<a href=\"tagwall.php?page={$next_page}\">--></a>";
    }
}
?>
