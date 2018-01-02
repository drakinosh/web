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
?>
<html>
<head>
    <title>Private Message</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>


<div class="page-head">
    <a href="index.php"><img src="ku_logo.png"></a>
    <h1>Kathmandu University Forums</h1>
</div>

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

<a href="#">Reply</a> <!-- add call to send_pm with params later -->
</body>
</html>
<?php
}
?>
