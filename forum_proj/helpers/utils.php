<?php
// asume config.php is included
//
function getUname($conn, $uid) {

    if ($uid == -1) {
        return "[deleted]";
    }

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

function getForumThreads($conn, $forid) {
    $stmt = $conn->prepare("SELECT tid FROM threads WHERE forum_id=?");
    $stmt->bindParam(1, $forid);
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

function getForumName($conn, $id)
{
    $stmt = $conn->prepare("SELECT forum_name FROM forums WHERE id=?");
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $row = $stmt->fetch();

    return $row["forum_name"];
}

function numPages($conn, $thread_id)
{
    $stmt = $conn->prepare("SELECT * FROM posts WHERE p_tid=?");
    $stmt->bindParam(1, $thread_id);
    $stmt->execute();

    $rows = $stmt->fetchAll();

    if (count($rows) <= 19) {
        return 1;
    }
    return ceil(count($rows)/20);
}

function printStatus($conn, $thread_id)
{
    $stmt = $conn->prepare("SELECT * FROM threads WHERE tid=?");
    $stmt->bindParam(1, $thread_id);
    if (!$stmt->execute()) {
        print "Database error.";
        exit;
    }

    $row = $stmt->fetch();
    $clo = "closed";
    $sti = "stickied";

    if ($row["open"] == "Y") {
        $clo = "open";
    }
    if ($row["isSticky"] == "N") {
        $sti = "not stickied";
    }

    echo $clo, " and ", $sti;
}

function showTrophies($user_flags)
{
    if ($user_flags & FLAG_STUDENT) {
        echo "<tr class='trophy'><td><img src='/site_images/student_trophy.png' alt='Student'></td></tr>\n";
    }
    if ($user_flags & FLAG_MAINTAINER) {
        echo "<tr class='trophy'><td><img src='/site_images/mod_trophy.png' alt='Maintainer'></td></tr>\n";
    }
}

?>
