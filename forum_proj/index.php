<?php
require_once 'config.php';
require_once 'helpers/rep_count.php';
?>

<html>
<head>
    <title>KU Forums</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div>
<?php
session_start();
if (!empty($_SESSION["username"])) {
    echo "<a id='username' href='member.php?uid=" . $_SESSION["uid"] . "'><strong>".$_SESSION["username"]."</strong></a>\n";
    echo "&nbsp;&nbsp;";
    echo "<a id='link' href='logout.php'>Logout</a>";
} else {
    echo "<a id='link' href='login.php'>Login</a>";
}
echo "<br>";
?>
</div>

<div class="page-head">
    <a href="index.php"><img src="ku_logo.png"></a>
    <h1>Kathmandu University Forums</h1>
</div>

<div>



<p>
<a href="create_thread.php">Create Thread</a>
<div id="threads">
<!-- Show the threads -->

<?php
//$stmt = $conn->prepare("SELECT (tid, title, replies) FROM threads LIMIT=10");
$stmt = $conn->prepare("SELECT tid, title FROM threads");
$stmt->execute();

?>

<table>
    <tr>
    <th class="tid">Id</th>
    <th class="ttitle">Title</th>
    <th class="treplies">Replies</th>
    </tr>

<?php
while ($row = $stmt->fetch()) {
?>
    <tr>
    <td><?php echo $row["tid"]; ?></td>
    <td><a href="view_thread.php?id=<?php echo $row["tid"]; ?>"><?php echo $row["title"]; ?></a>
    <td><?php echo getReplyCount($conn, $row["tid"]); ?></td>
    </tr>
<?php
}

unset($stmt);

?>
</table>
</body>
</html>
