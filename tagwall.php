<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tagwall</title>
</head>
<body>
    <h1>Tagwall</h1>
    
    <form method="post">
        <?php
        // get the visitor's IP address
        $ip = $_SERVER['REMOTE_ADDR'];
        
        // check if the IP address has a profile
        $profiles = file('data/IPprofiles.txt');
        $found = false;
        foreach ($profiles as $profile) {
            list($profile_ip, $username, $isadmin) = explode(':', $profile);
            if ($ip === $profile_ip) {
                $found = true;
                break;
            }
        }
        
        if ($found) {
            // use the username from the profile
            echo '<input type="text" id="name" name="name" value="' . htmlspecialchars($username) . '" readonly>';
        } else {
            // use a default name
            echo '<input type="text" id="name" name="name" value="Anonymous">';
        }
        ?>
        <label for="message">Message:</label>
        <input type="text" id="message" name="message">
        <input type="submit" value="Post">
    </form>
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // get the name and message from the form
        $name = $_POST["name"];
        $message = $_POST["message"];
        
        // add the message to the tagwall file
        $tagwall_file = "data/tagwall.txt";
        $line = "{$name}:{$message}\n";
        file_put_contents($tagwall_file, $line, FILE_APPEND);
    }
    ?>
    
    <?php include "tagwallposts.php"; ?>
    
    <p><a href="index.html">Back to Home</a></p>
</body>
</html>
