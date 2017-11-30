<?php

require_once 'config.php';

$uid = $_GET["uid"];

$stmt = $conn->prepare("SELECT * FROM users where uid = ?");
$stmt->bindParam(1, $param_uid);
$param_uid = $uid;
$stmt->execute();

$row = $stmt->fetch();
//<IMPORTANT> add checking, db connection?

header("Content-type: image/jpeg");
echo $row["avatar"];
unset($stmt);
?>
