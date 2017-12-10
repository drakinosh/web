<?php

require_once 'config.php';
require_once 'HTML/BBCodeParser2.php';
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


// check bbcode
if (PARSE_BBCODE == 'TRUE') {
    $config = parse_ini_file('HTML/BBCodeParser2.ini', true);
    $options = $config['HTML_BBCodeParser2'];

    $parser = new HTML_BBCodeParser2($options);
}

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
    <div class="post-ldata">
        <td class="tuser"><?php echo $user_row["username"]; ?>
        <img src="getimage.php?uid=<?php echo $row["t_uid"]; ?>" class="avatar-img">
        </td>
    </div>
    <div>
        <td class="tdetails" valign="top">
        <?php
        $parser->setText($row["details"]); $parser->parse();
        echo $parser->getParsed();
        ?>
        </td>
    </div>
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
    <div class="post-ldata">
        <td class="tuser"><?php echo $user_row["username"]; ?>
        <img class="avatar-img" src="getimage.php?uid=<?php echo $user_row["uid"]; ?>"/>
        </td>
    </div>
    <div class="post-rdata">
        <td class="tdetails" valign="top">
        <?php 
        $parser->setText($row["details"]); $parser->parse();
        echo $parser->getParsed();
        ?></td>
    </div>
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
NOTE: BBCode is usable
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
