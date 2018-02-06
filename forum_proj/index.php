<?php
require_once 'config.php';
require_once 'helpers/utils.php';
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
<h2 class="top-title">Available Forums</h2>
<div id="forums">

<?php
$stmt = $conn->prepare("SELECT * FROM forums");
$stmt->execute();

?>

<table id="forums-table">
    <tr>
    <th class="ftitle">Name</th>
    <th class="fthreads">Threads</th>
    </tr>

<?php
while ($row = $stmt->fetch()) {
?>
    <tr class="for-row">
    <td class="for-name"><a href="view_forum.php?id=<?php echo $row["id"]; ?>"><?php echo $row["forum_name"]; ?></a>
    <td class="for-threads"><?php echo getForumThreads($conn, $row["id"]); ?></td>
    </tr>
<?php
}


unset($stmt);

?>
</table>

</div>
</body>
</html>
