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

$thread_title = $row["title"];

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
    <script type="text/javascript" src="quote_script.js"></script>
</head>
<body>

<!-- KU header -->
<div class="page-head">
    <a href="index.php"><img src="ku_logo.png"></a>
    <h1>Kathmandu University Forums</h1>
</div>


<table border=1 id="first-post" class="post-table" cellspacing="0">
<tr>
    <td class="thead">
    <p class="post-date"><?php echo $row["pub_date"]; ?></p>
    </td>
    <td class="edit-data">
    </td>
</tr>
<tr>
    <div class="post-ldata">
        <td class="tuser" valign="top"><a href="member.php?uid=<?php echo $user_row["uid"]; ?>"><?php echo  $user_row["username"]; ?></a>
        <img src="getimage.php?uid=<?php echo $row["t_uid"]; ?>" class="avatar-img">
        </td>
    </div>
    <div>
        <td class="tdetails" valign="top">
            <h3 class="post-thread-title"><?php echo $row["title"]; ?></h3>
            <br>
            <?php
            $text=strip_tags($row["details"]); // filter user-input HTML and PHP tags
            $parser->setText($text); $parser->parse();
            echo nl2br($parser->getParsed());
            ?>
        </td>
    </div>
</tr>
</table>
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

    <table class="post-table" id="post-<?php echo $row["pid"]; ?>" cellspacing="0" border=1>
<div class="thread-reply">
<tr>
    <td class="thead">
    <p class="post-date"><?php echo $row["pub_date"]; ?></p>
    </td>
    <td class="edit-data">
    </td>
</tr>
<tr>
    <div class="post-ldata">
        <td class="tuser" valign="top"><a href="member.php?uid=<?php echo $user_row["uid"]; ?>"><?php echo $user_row["username"]; ?></a>
        <img class="avatar-img" src="getimage.php?uid=<?php echo $user_row["uid"]; ?>"/>
        </td>
    </div>
    <div class="post-rdata">
        <td class="tdetails" valign="top">
            <h3 class="thread-title-post" valign="top">Re: <?php echo $thread_title; ?></h3>
            <br>
            <?php
            $text = strip_tags($row["details"]);
            $parser->setText($text); $parser->parse();
            $final =  nl2br($parser->getParsed());
            echo $final;

            $pure = $text;

            ?>
            <div class="butDiv">
            <img src="site_images/quote_but.png"
                 onclick="quoteFill('<?php echo $user_row["username"];?>', String.raw `<?php echo $pure; ?>`);">
             <a href=<?php echo "report.php?pid=" . $row["pid"] . "&p_tid=" . $row["p_tid"]; ?>>
                <img src="site_images/report_but.png">
            </a>
            </div> 
            <?php 
            // add link to attachment, if exists
            if ($row["attach"] != "NIL") {
                $fname = $row["attach"];
            ?>
            <div style="clear:both;">
            ________________<br>
            Attachment: <br>
            <div class="attach-div">
                <a href="get_file.php?fname=<?php echo $fname; ?>"><?php echo $fname; ?></a>
            </div>
            </div>
            <?php
            }?>
        </td>
    </div>
</tr>
</div>
</table>
<?php
}
?>

</table>

<!-- Allow users to reply -->

<?php
if ($logged_in == 'T') {
?>
<div class="post-reply-div">
<p style="text-align: center;">NOTE: BBCode is usable</p>
<form enctype="multipart/form-data" method="post" action="process_reply.php">
    <div>
        <label class="form-label">Reply:</label>
        <textarea rows="10" cols="50" id="thread-reply" class="form-body" name="reply_details"></textarea>
    </div>
    <input type="hidden" value="<?php echo $id; ?>" name="thread_id">
    
    <div>
        <label class="form-label">Attachment(10 MiB max):</label>
        <input type="hidden" name="MAX_FILE_SIZE" value="10485760">
        <input type="file" name="attach_file">
    </div>
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
