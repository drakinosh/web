<?php

require_once 'config.php';
require_once 'HTML/BBCodeParser2.php';
require_once 'helpers/utils.php';
session_start();

if (!isset($_SESSION["username"]) || empty($_SESSION["username"])) {
    $logged_in = 'F';
} else {
    $logged_in = 'T';
}

// thread


// get id of requested thread

$id = $_GET["id"];
// page num
$page = 1;
if (isset($_GET["page"])) {
    $page = $_GET["page"];
}

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
$thread_row = $row;

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
    <link rel="stylesheet" type="text/css" href="styles/<?php echo getSheet(); ?>" id="main-style">
    <script type="text/javascript" src="quote_script.js"></script>
</head>
<body>

<?php
include 'head.php';
echo "<h2 class='thread-title-text';'>" . $row["title"]. "</h2>";
echo "<p class='page-num-text''>Page " . $page . " of " . numPages($conn, $id) . "</p>";

// moderator mini-panel
if ($_SESSION["level"] == "M" || $_SESSION["level"] == "A") { ?>
    <div class="mod-panel">
        <a class="mod-but" href="process_mod.php?act=sticky&tid=<?php echo $id;?>">Sticky</a>
        <a class="mod-but" href="process_mod.php?act=close&tid=<?php echo $id;?>">Close</a>
    </div>
<?php
}

if  ($page == 1) {?>
<table border=1 id="first-post" class="post-table" cellspacing="0">
<tr>
    <td class="thead">
    <p class="post-date"><?php echo $row["pub_date"]; ?></p>
    </td>
    <td class="post-num-data">
    <p class="post-num">#1</p>
   </td>
</tr>
<tr>
    <div class="post-ldata">
        <td class="tuser" valign="top"><a href="member.php?uid=<?php echo $user_row["uid"]; ?>"><?php echo  $user_row["username"]; ?></a>
        <?php printStat($user_row["level"]); ?>
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
<?php
}
?>
<!-- Add replies here -->

<?php
unset($stmt);
unset($stmt2);
unset($user_row);

$pid = $id;
if ($page == 1) {
    $low_l = 0; 
    $post_num=19; 
} else  {
    $low_l = ($page-1)*19;
    $post_num = 20;
}

$stmt = $conn->prepare("SELECT * FROM posts WHERE p_tid = :pid LIMIT :low_l, :post_num");
$stmt->bindParam(':pid', $param_p_tid, PDO::PARAM_INT);
$stmt->bindParam(':low_l', $low_l, PDO::PARAM_INT);
$stmt->bindParam(':post_num', $post_num, PDO::PARAM_INT);

$param_p_tid = $id; # id of current thread;
$stmt->execute();

if ($page == 1) {
    $i = 1;
} else {
    $i = ($page-1)*20;
}

while ($row=$stmt->fetch()) {
    
    $i += 1;    // for local post numbers

    $stmt2 = $conn->prepare("SELECT * FROM users WHERE uid = ?");
    $stmt2->bindParam(1, $param_p_uid);
    $param_p_uid = $row["p_uid"];
    $stmt2->execute();

    $user_row = $stmt2->fetch();
    # only admins and mods can see this. 
    # for convenience, not security
    if (isset($_SESSION["level"]) && ($_SESSION["level"] == "A" || $_SESSION["level"] == "M")) {
        echo "<p class='post-global-num'>" . $row["pid"] . "</p>";
    }
?>

<table class="post-table" id="post-<?php echo $row["pid"]; ?>" cellspacing="0" border=1>
<div class="thread-reply">
<tr>
    <td class="thead">
    <p class="post-date"><?php echo $row["pub_date"]; ?></p>
    </td>
    <td class="post-num-data">
    <p class="post-num">#<?php echo $i ?></p>

    </td>
</tr>
<tr>
    <div class="post-ldata">
        <td class="tuser" valign="top"><a href="member.php?uid=<?php echo $user_row["uid"]; ?>"><?php echo $user_row["username"]; ?></a>
        <?php printStat($user_row["level"]) ?>
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
            <!-- Compulsory space after text -->

            <br>

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
            ________________
            <br>

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

<!-- navigation bar -->

<table id="navi-table">
    <tr>
    <?php
    if ($page != 1) { ?>
    <td class="navi-but"><a href="view_thread.php?id=<?php echo $id;?>&page=<?php echo $page-1; ?>">Prev</a></td>
    <?php
    }
    
    if ($page != numPages($conn, $id)) { ?>
    <td class="navi-but"><a href="view_thread.php?id=<?php echo $id;?>&page=<?php echo $page+1; ?>">Next</a></td>
    <?php
    } ?>
    </tr>
</table>

<!-- Allow users to reply -->


<?php
if ($thread_row["open"] == 'N') {
    print "<p>Thread closed. Replies have been disabled.</p>";
    
} else if ($logged_in == 'T') {
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
        <label class="form-label">Attachment(15 MiB max):</label>
        <input type="hidden" name="MAX_FILE_SIZE" value="15728640">
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

unset($row);
?>
</body>
</html>
