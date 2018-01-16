<?php

require_once 'config.php';

session_start();

$upload_dir = "user_files/";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $reply_details = $_POST["reply_details"];
    $reply_uid = $_SESSION["uid"];
    $tid = $_POST["thread_id"];
    $fname = "t-" . $tid . basename($_FILES["attach_file"]["name"]);
    $upload_file = $upload_dir . $fname;

    $file_name_dbase = "NIL";
    if (move_uploaded_file($_FILES["attach_file"]["tmp_name"], $upload_file)) {
        if ($_FILES["attach_file"]["size"] <= 15728640) { // less than 15 MiB
            $file_name_dbase = $fname; // ready for dbase if all goes well
        }
    }

    $write_stmt = $conn->prepare("INSERT INTO posts (p_tid, p_uid, details, pub_date, attach) VALUES (?, ?, ?, ?, ?)");
    $write_stmt->bindParam(1, $tid);
    $write_stmt->bindParam(2, $reply_uid);
    $write_stmt->bindParam(3, $reply_details);
    $write_stmt->bindParam(4, $datetime);
    $write_stmt->bindParam(5, $file_name_dbase);

    $datetime = date("Y:m:d H:i:s");

    if ($write_stmt->execute()) {
        echo "Successfully posted, " . $_SESSION["username"] . ".";
    } else {
        echo "Database error";
    }

    header("location: view_thread.php?id=".$tid);
    exit;

}
