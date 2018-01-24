<?php
require_once 'config.php';

?>

<html>
<head>
    <title>KU Forums</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="styles/<?php echo getSheet(); ?>" id="main-style">
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
<h2 style="text-align: center;">Available Forums</h2>
<div id="forums">

<?php
$stmt = $conn->prepare("SELECT * FROM forums");
$stmt->execute();

?>

<table id="forums-table">
    <tr>
    <th class="fid">Id</th>
    <th class="ftitle">Name</th>
    </tr>

<?php
while ($row = $stmt->fetch()) {
?>
    <tr class="for-row">
    <td class="for-id"><?php echo $row["id"]; ?></td>
    <td class="for-name"><a href="view_forum.php?id=<?php echo $row["id"]; ?>"><?php echo $row["forum_name"]; ?></a>
    </tr>
<?php
}


unset($stmt);

?>
</table>
</body>
</html>
