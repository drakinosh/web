<?php
session_start();
require_once "config.php";

if ($_SESSION["level"] != 'A') {
    print "AUTH";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $uid = $_POST["uid"];
    
    if (isset($_POST["add_pat"])) {
        $stmt = $conn->prepare("UPDATE `users` SET uflags = uflags | ? WHERE uid=?");
        $stmt->bindParam(1, $_POST["bit_pat"]);
        $stmt->bindParam(2, $_POST["uid"]);
        if(!$stmt->execute()) {
            print "Error.";
        }
    } elseif (isset($_POST["del_pat"])) {
        $stmt = $conn->prepare("UPDATE `users` SET uflags = uflags & ~? WHERE uid=?");
        $stmt->bindParam(1, $_POST["bit_pat"]);
        $stmt->bindParam(2, $_POST["uid"]);
        $stmt->execute();
    }

    header("location: member.php?uid=" . $uid);
    exit;

}

?>
