<?php
// read the number of messages per page from the tagwall settings file
$tagwall_settings_file = "data/tagwallsettings.txt";
$per_page = intval(file_get_contents($tagwall_settings_file));

// read the messages from the tagwall file
$tagwall_file = "data/tagwall.txt";
$tagwall = array_reverse(file($tagwall_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));

// calculate the current page number based on the number of messages per page
$current_page = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
$total_pages = ceil(count($tagwall) / $per_page);
$offset = ($current_page - 1) * $per_page;
$messages = array_slice($tagwall, $offset, $per_page);

// display the messages on the current page
echo "<ul>";
foreach ($messages as $line) {
    $parts = explode(":", $line);
    $name = $parts[0];
    $message = $parts[1];
    echo "<li><h1>{$name}</h1>{$message}</li>";
}
echo "</ul>";

// display the next page button if there are more messages than the number of messages per page
if ($total_pages > 1 && $current_page < $total_pages +1) {
    $next_page = $current_page + 1;
    $prev_page = $current_page - 1;
    if($current_page > 1){
    echo "<a href=\"tagwall.php?page={$prev_page}\"><--</a>";    
    }
    if($current_page < $total_pages){
    echo "<a href=\"tagwall.php?page={$next_page}\">--></a>";
    }
    
}
if($current_page > $total_pages)
{
    header("Location: tagwall.php?page={$total_pages}");
}
?>
