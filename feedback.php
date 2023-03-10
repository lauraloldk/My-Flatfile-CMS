<?php
include "checkip.php";
// Function to sanitize input
function sanitize_input($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

// Create necessary directories if they don't exist
if (!file_exists("data")) {
    mkdir("data", 0777, true);
}

if (!file_exists("data/feedback.txt")) {
    file_put_contents("data/feedback.txt", "");
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get input from form and sanitize it
    $feedbacktitle = sanitize_input($_POST["feedbacktitle"]);
    $content = sanitize_input($_POST["content"]);
    $status = 0; // Default status is 0

    // Create line of feedback in data/feedback.txt
    $line = $feedbacktitle . ":" . $content . ":" . $status . "\n";
    file_put_contents("data/feedback.txt", $line, FILE_APPEND);
}

// Read feedbacks from data/feedback.txt
$feedbacks = file("data/feedback.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

?>

<html>
  <body>
    <div id="createfeedback">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="feedbacktitle">Feedback Title:</label>
        <input type="text" id="feedbacktitle" name="feedbacktitle"><br><br>
        <label for="content">Content:</label>
        <textarea id="content" name="content" rows="5" cols="50"></textarea><br><br>
        <input type="submit" value="Submit Feedback">
      </form>
    </div>
    <div id="feedbacks">
      <h1>Feedbacks</h1>
      <ul>
        <?php foreach ($feedbacks as $feedback) {
            list($feedbacktitle, $content, $status) = explode(":", $feedback);
            $status_text = "";
            switch ($status) {
                case 1:
                    $status_text = "<span style='color:red'>Declined</span>";
                    break;
                case 2:
                    $status_text = "<span style='color:green'>Accepted</span>";
                    break;
                case 3:
                    $status_text = "<span style='color:cyan'>Done</span>";
                    break;
                default:
                    $status_text = "<span style='color:grey'>Not Set</span>";
                    break;
            }
            echo "<li><strong>$feedbacktitle</strong>: $content - $status_text</li>";
        } ?>
      </ul>
    </div>
  </body>
</html>
