<?php
// asume config.php is included
function getUname($conn, $uid) {

    $stmt = $conn->prepare("SELECT username FROM users WHERE uid=?");
    $stmt->bindParam(1, $uid);
    $stmt->execute();
    $row = $stmt->fetch();

    unset($stmt);

    return $row["username"];
}

function getUserPosts($conn, $uid) {

    $stmt = $conn->prepare("SELECT pid FROM posts WHERE p_uid=?");
    $stmt->bindParam(1, $uid);
    $stmt->execute();
    $rows = $stmt->fetchAll();

    unset($stmt);
    return count($rows);
}

function printStat($level) {

    echo "\n<br>\n";

    if ($level == 'U') {
        echo "User\n";
    } else if ($level == 'A') {
        echo "<font color='gold'>Admin</font>\n";
    } else if ($level == 'M') {
        echo "<font color='blue'>Moderator</font>\n";
    } else if ($level == 'B') {
        echo "<font color='red'>BANNED</font>\n";
    }
}
?>
