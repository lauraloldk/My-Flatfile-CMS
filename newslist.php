<?php
// Load the list of news articles and their IDs
$ids_file = file("data/news/id.txt");
$titles_file = file("data/news/title.txt");

// Combine the IDs and titles into an associative array
$articles = array();
foreach ($ids_file as $key => $id) {
    $articles[trim($id)] = trim($titles_file[$key]);
}

// Render the HTML list of news articles
$template = file_get_contents('newslist.html');
$list_items = "";
foreach ($articles as $id => $title) {
    $list_items .= "<li><a href=\"Readnews.php?id=$id\">$title</a></li>";
}
$output = str_replace('{{ list_items }}', $list_items, $template);
echo $output;
?>
