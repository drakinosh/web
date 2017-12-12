<?php

// assume config.php is included
//
function getReplyCount($connection, $thread_id)
{
    
    if (empty($thread_id)) {
        return 0;
    }

    $stmt = $connection->prepare("SELECT pid FROM posts WHERE p_tid = ?");
    $stmt->bindParam(1, $thread_id);
    
    if (!$stmt->execute()) {
        print "getReplyCount: database error";
        return -1;
    }

    $row = $stmt->fetchAll();
    unset($stmt);

    return count($row);
}
?>
