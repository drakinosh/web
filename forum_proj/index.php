<?php
require_once 'config.php';
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
    echo "<strong id='username'>".trim($_SESSION["username"])."</strong>";
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
$stmt = $conn->prepare("SELECT tid, title, replies FROM threads");
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
    <td><?php echo $row["replies"]; ?></td>
    </tr>
<?php
}
?>
</table>
</body>
</html>
