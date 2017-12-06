<?php


$uid = $_GET["uid"];

$fname = "./photos/user_avatars/avatar-" . $uid  . ".jpg";
$fp = fopen($fname, "rb");

if (!$fp) {
    print "Image error.";
    exit;
}

// send headers
header("Content-Type: image/jpeg");
header("Content-Length: " . filesize($fname));

fpassthru($fp);
exit;
