<?php

session_start();

require_once 'config.php';
include 'helpers/utils.php';

# prevent non-users from seeing 
if (!isset($_SESSION["uid"])) {
    echo "Insufficient privileges to see this page.";
    header("location: " . $_SERVER['HTTP_REFERER']);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $uid = $_GET["uid"];
    $stmt = $conn->prepare("SELECT * FROM users WHERE uid = ?");
    $stmt->bindParam(1, $uid);

    if (!$stmt->execute()) {
        echo "Database error.";
    }

    $user_row = $stmt->fetch();
    $user_uname = $user_row["username"];
}
?>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>User <?php echo $user_uname; ?></title>
</head>
<body>

<?php 
echo "<a id='username' href='member.php?uid=" . $_SESSION["uid"] . "'><strong>".$_SESSION["username"]."</strong></a>";
?>

<div class="page-head">
    <a href="index.php"><img src="ku_logo.png"></a>
    <h1>Kathmandu University Forums</h1>
</div>

<h3> Stats for <?php echo $user_uname; ?> </h3>

<div class="user-data">
    <h4>Joined:</h4> <?php echo $user_row["joined"]; ?>
    <h4>Posts:</h4> <?php echo getUserPosts($conn, $user_row["uid"]); ?>
</div>

<?php
if ($user_row["uid"] == $_SESSION["uid"]) {
?>
    <a href="read_pm.php">Inbox</a>
    <a href="send_pm.php">Send mail</a>
<?php
}
?>

</body>
</html>

<?php
unset($stmt);
?>
