<?php

session_start();

require_once 'config.php';
require_once 'helpers/utils.php';

# this uses a kind of side-pane implemented using includes
# what we do is this - if we GET a __opt__ value, set the right pane
# according to it. If it is unset, we show user statistics

# prevent non-users from seeing 
if (!isset($_SESSION["uid"])) {
    echo "Insufficient privileges to see this page.";
    header("location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $uid = $_GET["uid"];
    $opt = $_GET["opt"];
    $stmt = $conn->prepare("SELECT * FROM users WHERE uid = ?");
    $stmt->bindParam(1, $uid);

    if (!$stmt->execute()) {
        echo "Database error.";
    }

    $user_row = $stmt->fetch();
    $user_uname = $user_row["username"];

    # check the page belongs to the current user
    $self = 'F';
    if ($uid == $_SESSION["uid"]) {
        $self = 'T';
    }
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
echo "&nbsp;&nbsp;";
echo "<a id='link' href='logout.php'>Logout</a>";
?>

<div class="page-head">
    <a href="index.php"><img src="ku_logo.png"></a>
    <h1>Kathmandu University Forums</h1>
</div>

<h3> Stats for <?php echo $user_uname; ?> </h3>

<div class="user-data">
    <?php
    if ($self == 'T') {
    ?>
        <div class="mem-div" id="mem-pane">
        <a href="member.php?uid=<?php echo $uid; ?>">Profile</a>
        <br>
        <!--<a href="read_pm.php">Inbox</a> -->
        <a href="member.php?opt=1&uid=<?php echo $uid; ?>">Inbox</a>
        <br>
        <a href="member.php?opt=2&uid=<?php echo $uid;  ?>">Outbox</a>
        <br>
        <a href="send_pm.php">Send PM</a>
        <br>
        <?php if (isset($_SESSION["level"]) && $_SESSION["level"] == 'A') {
                echo "<a href='admin_page.php'>Admin Page</a>";
              }
        ?>
        </div>

    <?php
    }
    ?>
        <div class="mem-div" id="data-pane">
    <?php
    if ($self == 'F' || !isset($opt)) {
    ?>
        <img src="getimage.php?uid=<?php echo $uid; ?>" class="avatar-img">
        <h4>Joined:</h4> <?php echo $user_row["joined"]; ?>
        <br>
        <h4>Posts:</h4> <?php echo getUserPosts($conn, $user_row["uid"]); ?>
        <br>
        <?php 
        if ($self == 'F') {
            echo "\n<a href='send_pm.php?recipient=" . $user_row["username"] 
                 .  "'><h4>Send Private Message</h4></a>";
        }
        ?>
    <?php
    }

    if ($self == 'T' && $opt == '1') {
        include 'read_pm.php';
    } else if ($self == 'T' && $opt == '2') {
        include 'read_sent_pm.php';
    }
    ?>
    </div>

</div>

</body>
</html>

<?php
unset($stmt);
?>
