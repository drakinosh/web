<?php

require_once 'config.php';
require_once 'HTML/BBCodeParser2.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conig = parse_ini_file('HTML/BBCodeParser2.ini', true);
    $opts = $config['HTML_BBCodeParser2'];


    $reply_details = $_POST["reply_details"];
    
    if (PARSE_BBCODE == 'TRUE')  {
        $parser = new HTML_BBCodeParser2($options=$opts);
        $parser->setText($reply_details);
        $parser->parse();
        $reply_details = $parser->getParsed();
    }

    $reply_uid = $_SESSION["uid"];
    $tid = $_POST["thread_id"];

    $write_stmt = $conn->prepare("INSERT INTO posts (p_tid, p_uid, details, pub_date) VALUES (?, ?, ?, ?)");
    $write_stmt->bindParam(1, $tid);
    $write_stmt->bindParam(2, $reply_uid);
    $write_stmt->bindParam(3, $reply_details);
    $write_stmt->bindParam(4, $datetime);

    $datetime = date("Y:m:d H:i:s");

    if ($write_stmt->execute()) {
        echo "Successfully posted, " . $_SESSION["username"] . ".";
    } else {
        echo "Database error";
    }

    header("location: view_thread.php?id=".$tid);
    exit;

}
