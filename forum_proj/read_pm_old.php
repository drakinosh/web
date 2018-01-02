<?php
require_once 'config.php';
require_once 'helpers/utils.php';
session_start();

if (empty($_SESSION["uid"])) {
    header("location: index.php");
    exit;
}


$uid = $_SESSION["uid"];
$stmt = $conn->prepare("SELECT * FROM messages WHERE uid_2 = ?");
$stmt->bindParam(1, $uid);

$stmt->execute();
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Inbox</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php
echo "<strong id='username'>".$_SESSION["username"]."</strong>\n";
?>


<!-- KU header -->
<div class="page-head">
    <a href="index.php"><img src="ku_logo.png"></a>
    <h1>Kathmandu University Forums</h1>
</div>

<h2>Inbox</h2>

<table border="1">
    <th>Sender</th>
    <th>Subject</th>
    <th>Sent</th>
<?php
while ($row = $stmt->fetch()) {
?>
    <tr>
    <td class="t-pm-sender"><?php echo getUname($conn, $row["uid_1"]); ?></td>
    <td class="t-pm-subject">
    <a style="text-decoration:none;" href="show_message.php?id=<?php echo $row["id"]; ?>">
        <?php echo $row["title"]; ?>
    </a>
    </td>
    <td class="t-pm-sent"><?php echo $row["send_date"]; ?></td>
    </tr>
<?php
}
?>
</body>
</html>
