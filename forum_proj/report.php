<?php

require_once 'config.php';
session_start();

if (!isset($_SESSION["uid"])) {
    header("location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $pid = trim($_GET["pid"]);
    $p_tid = trim($_GET["p_tid"]);

    $stmt = $conn->prepare("INSERT INTO reports (pid, p_tid) VALUES (?, ?)");
    $stmt->bindParam(1, $pid);
    $stmt->bindParam(2, $p_tid);

    if ($stmt->execute()) {
        print "Report successfully logged.";
    } else {
        print "Database erorr. Try again later.";
        exit;
    }
}
?>
