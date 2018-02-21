<?php
require_once 'config.php';
require_once 'helpers/rep_count.php';
require_once 'helpers/utils.php';

session_start();

?>

<html>
<head>
    <title>KU Forums</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="styles/<?php echo getSheet(); ?>" id="main-style">
</head>
<body>

<?php
include 'head.php';
?>
<div class="root-cont">
<div id="threads">
<!-- Show the threads -->
<?php

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {

    echo "<h2 class='top-title' id='forum-title'>" . getForumName($conn, $_GET["id"]) . "</h2>\n";

    $stmt = $conn->prepare("SELECT * FROM threads WHERE forum_id=? ORDER BY isSticky='N'");
    $stmt->bindParam(1, $for_id);
    
    $for_id = $_GET["id"];
    $stmt->execute();

    ?>
    
    <a class="forum-link" href="create_thread.php?forum_id=<?php echo $_GET["id"]; ?>">Create Thread</a>

    <table class="thread-table" border="1">
        <tr>
        <th class="tid">Id</th>
        <th class="ttitle">Title</th>
        <th class="treplies">Replies</th>
        </tr>

    <?php
    while ($row = $stmt->fetch()) {
        if ($row["isSticky"] == "Y") {
            echo "<tr class='thread-sticky'>\n";
        } else {
            echo "<tr>\n";
        }
    ?>
        <td><?php echo $row["tid"]; ?></td>
        <td>
            <a href="view_thread.php?id=<?php echo $row["tid"]; ?>&page=1"><?php echo $row["title"]; ?></a>
        <?php if ($row["isSticky"] == "Y") { ?>
            <p style="display: inline;">[Sticky]</p>
        <?php } ?> 
        </td>
        <td><?php echo getReplyCount($conn, $row["tid"]); ?></td>
        </tr>
    <?php
    }

    unset($stmt);

    ?>
    </table>
    </div>
</div>
    </body>
    </html>
<?php
}
?>
