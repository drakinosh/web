<?php

function closeThread($conn, $tid)
{


    if (!isset($tid)) {
        return -1;
    }

    $stmt = $conn->prepare("UPDATE threads SET open='N' WHERE tid=?");
    $stmt->bindParam(1, $tid);

    if (!$stmt->execute()) {
        print "Thread Close: Database error.";
        exit;
    }

};

function makeSticky($conn, $tid)
{

    if (!isset($tid)) {
        return -1;
    }

    $stmt = $conn->prepare("UPDATE threads SET isSticky='Y' WHERE tid=?");
    $stmt->bindParam(1, $tid);

    if (!$stmt->execute()) {
        print "Thread Sticky: Database error.";
        exit;
    }
}
