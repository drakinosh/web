<?php
require_once 'config.php';
require_once 'helpers/utils.php';

session_start();

if (!isset($_SESSION["uid"])) {
    print "Unprivileged access.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET["id"]; # message id
    $curr_uid = $_SESSION["uid"];

    $stmt = $conn->prepare("SELECT * FROM messages WHERE id=?");
    $stmt->bindParam(1, $id);

    if (!$stmt->execute()) {
        print "Database error.";
        exit;
    }

    $row = $stmt->fetch();

    if ($curr_uid != $row["uid_1"] && $curr_uid != $row["uid_2"]) {
        print "Insufficient privilege to access message.";
        exit;
    }

    // mark as read
    $stmt2 = $conn->prepare("UPDATE messages SET uid_2_read='T' WHERE id=?");
    $stmt2->bindParam(1, $id);
    $stmt2->execute();
?>
<html>
<head>
    <title>Private Message</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="styles/<?php echo getSheet(); ?>" id="main-style">
</head>
<body>

<?php
include 'head.php';
?>
<br>
<br>

<div class="div-mess">

    <div class="mess-sub"><b>Subject:</b> <?php echo $row["title"]; ?></div>
    <div class="mess-sender"><b>Sender:</b> <?php echo getUname($conn, $row["uid_1"]); ?></div>
    <div class="mess-body"><b>Message:</b> 
        <br>
        <?php echo nl2br($row["body"]); ?>
    </div>
</div>

<a href="send_pm.php?recipient=<?php echo getUname($conn, $row["uid_1"]); ?>&subject=<?php echo $row["title"]; ?>&reply=true">
Reply
</a>
</body>
</html>
<?php
}
?>
