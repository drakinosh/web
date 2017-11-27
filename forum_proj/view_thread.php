<?php

require_once 'config.php';

session_start();

if (!isset($_SESSION["username"]) || empty($_SESSION["username"])) {
    $logged_in = 'F';
} else {
    $logged_in = 'T';
}

// thread


// get id of requested thread

$id = $_GET["id"];
if (empty($id) || !isset($id)) {
    header("location: index.php");
}

// process submission form
// ---------------------------

//<IMPORTANT> need to add error checking
$stmt = $conn->prepare("SELECT * FROM threads WHERE tid=?");
$stmt2 = $conn->prepare("SELECT * FROM users where uid=?");
$stmt->bindParam(1, $param_tid);
$param_tid = $id;

$stmt->execute();
$row = $stmt->fetch();

$stmt2->bindParam(1, $param_uid);
$param_uid = $row["t_uid"];
$stmt2->execute();
$user_row = $stmt2->fetch();

?>
<html>
<head>
<title><?php echo htmlspecialchars($row["title"]); ?></title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<!-- KU header -->
<div class="page-head">
    <a href="index.php"><img src="ku_logo.png"></a>
    <h1>Kathmandu University Forums</h1>
</div>


<table border="1" id="post-table">
<tr>
    <td class="tuser"><?php echo $user_row["username"]; ?></td>
    <td class="tdetails"><?php echo $row["details"]; ?></td>
</tr>

<!-- Add replies here -->

<?php
unset($stmt);
unset($stmt2);
unset($user_row);

$stmt = $conn->prepare("SELECT * FROM posts WHERE p_tid = ?");
$stmt->bindParam(1, $param_p_tid);
$param_p_tid = $id; # id of current thread;
$stmt->execute();

while ($row=$stmt->fetch()) {

    $stmt2 = $conn->prepare("SELECT * FROM users WHERE uid = ?");
    $stmt2->bindParam(1, $param_p_uid);
    $param_p_uid = $row["p_uid"];
    $stmt2->execute();

    $user_row = $stmt2->fetch();
?>

<div class="thread-reply">
<tr>
    <td class="tuser"><?php echo $user_row["username"]; ?></td>
    <td class="tdetails"><?php echo $row["details"]; ?></td>
</tr>
</div>
<?php
}
?>

</table>

<!-- Allow users to reply -->

<?php
if ($logged_in == 'T') {
?>
<div class="post-reply-div">
<form method="post" action="process_reply.php">
    <div>
        <label class="form-label">Reply:</label>
        <textarea rows="10" cols="50" class="form-body" name="reply_details"></textarea>
    </div>
    <input type="hidden" value="<?php echo $id; ?>" name="thread_id">
    <div>
        <input type="submit" class="form-button" value="Post reply">
    </div>
</form>
</div>
<?php
} else {
    echo "<div class='post-reply-div'>";
    echo "Only members can reply.";
    echo "</div>";
}
?>

</body>
</html>
