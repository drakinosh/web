<?php

require_once 'config.php';

session_start();

// need useraccount to create thread
if (!isset($_SESSION["username"]) || empty($_SESSION["username"])) {
    print "Insufficient privileges for creating thread.";
    header("location: login.php");
    exit;
}

// process data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty($_POST["thread_title"]) || empty($_POST["thread_title"])) {
        
        //NOTE: add error message here
        header("location: index.php");
        exit;
    }

    $title = trim($_POST["thread_title"]);
    $body = trim($_POST["thread_body"]);
    $pub_date = date("Y-m-d H:i:s");
    $uid = $_SESSION["uid"]; // uid of current user

    $stmt = $conn->prepare("INSERT INTO threads (t_uid, title, details, pub_date) VALUES (?, ?, ?, ?)");
    $stmt->bindParam(1, $uid);
    $stmt->bindParam(2, $title);
    $stmt->bindParam(3, $body);
    $stmt->bindParam(4, $pub_date);

    if (!$stmt->execute()) {
        print "Something is wrong.";
    } else {

        $stmt = null;
        header("location: index.php");
        exit;
    }

}

?>

<!--- Input fields -->
<html>
<head>
    <meta charset="utf-8">
    <title>Create Thread</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<p> Create topic: </p>

<form method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <div>
    <label class="form-label"><strong>Title:</strong></label>
    <input type="text" name="thread_title" class="form-field">
    </div>

    <!-- Need to add ways to post images and links -->
    <div>
    <label class="form-label"><strong>Body:</strong></label>
    <textarea class="form-body" name="thread_body" rows="10" cols="50"></textarea>
    </div>
    
    <div>
    <input type="submit" class="form-button" value="Submit">
    </div>
    <div>
    <input type="reset" class="form-button" value="Reset">
    </div>
</form>


</body>
</html>
