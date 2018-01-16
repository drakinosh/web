<?php
require_once 'config.php';
require_once 'helpers/rep_count.php';
require_once 'helpers/utils.php';

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
<div id="threads">
<!-- Show the threads -->
<?php

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {

    echo "<h3 id='forum-title'>" . getForumName($conn, $_GET["id"]) . "</h3>\n";

    $stmt = $conn->prepare("SELECT tid, title FROM threads WHERE forum_id=?");
    $stmt->bindParam(1, $for_id);
    
    $for_id = $_GET["id"];
    $stmt->execute();

    ?>
    
    <a href="create_thread.php?forum_id=<?php echo $_GET["id"]; ?>">Create Thread</a>

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
        <td><a href="view_thread.php?id=<?php echo $row["tid"]; ?>&page=1"><?php echo $row["title"]; ?></a>
        <td><?php echo getReplyCount($conn, $row["tid"]); ?></td>
        </tr>
    <?php
    }

    unset($stmt);

    ?>
    </table>

    </body>
    </html>
<?php
}
?>
