<?php
session_start();
require_once "config.php";

if ($_SESSION["level"] != 'A') {
    print "AUTH";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $uid = $_POST["uid"];
    
    if (isset($_POST["add_bit"])) {
        $stmt = $conn->prepare("UPDATE `users` SET uflags = uflags | :num WHERE uid=:uid");
        $stmt->bindParam(":num", (int)$_POST["bit_pat"], PDO::PARAM_INT);
        $stmt->bindParam(":uid", (int)$_POST["uid"], PDO::PARAM_INT);
        if(!$stmt->execute()) {
            print "Error.";
        }
    }
}

?>
