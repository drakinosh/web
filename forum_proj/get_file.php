<?php

session_start();

if (!isset($_SESSION["uid"])) {
    # deny files to non-users
    header("location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $fname = $_GET["fname"];
    $upload_dir = "user_files/";
    $full_path = $upload_dir . $fname;

    header('Content-Type: ' . mime_content_type($full_path));
    header('Content-Length: ' . filesize($full_path));
    flush();
    readfile($full_path);

    exit;
}
