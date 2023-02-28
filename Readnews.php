<?php
// Get the article ID from the query string
if (isset($_GET['id'])) {
    $article_id = $_GET['id'];

    // Load the list of article IDs and titles
    $ids_file = file("/storage/ssd3/504/20352504/public_html/data/news/id.txt");
    $titles_file = file("/storage/ssd3/504/20352504/public_html/data/news/title.txt");

    // Find the line in the IDs file that matches the submitted ID
    $id_line = array_search($article_id . "\n", $ids_file);

    if ($id_line !== false) {
        // Get the title from the titles file
        $title = rtrim($titles_file[$id_line], "\n");

        // Load the article content from the article file
        $article_file = "/storage/ssd3/504/20352504/public_html/data/news/articles/{$article_id}.txt";
        $article = file_get_contents($article_file);

        // Get the date and time from the date-time file
        $datetime_file = fopen("/storage/ssd3/504/20352504/public_html/data/news/date-time.txt", "r");
        fseek($datetime_file, $id_line * 20);
        $datetime = rtrim(fread($datetime_file, 20), "\n");
        fclose($datetime_file);

        // Create an array of article data for the template
        $article_data = array(
            'id' => $article_id,
            'title' => $title,
            'article' => $article,
            'datetime' => $datetime,
        );

        // Render the template with the article data
        $template = file_get_contents('readnews.html');
        foreach ($article_data as $key => $value) {
            $template = str_replace("{{ article.{$key} }}", $value, $template);
        }
        echo $template;
    } else {
        // Redirect to the newslist page if the article ID is invalid
        header("Location: index.html");
        exit;
    }
} else {
    // Redirect to the newslist page if no ID was provided
    header("Location: index.html");
    exit;
}
?>
