<?php
#require_once 'config.php';
#require_once 'helpers/utils.php';
# ^ these are already required by the member.php page

#session_start();
#^ the session has already been started

if (empty($_SESSION["uid"])) {
    header("location: index.php");
    exit;
}


// read mail
$uid = $_SESSION["uid"];
$stmt = $conn->prepare("SELECT * FROM messages WHERE uid_2 = ?");
// user2 is the reciever
$stmt->bindParam(1, $uid);

$stmt->execute();
?>

<form class="inbox-form" action="inbox_proc.php" method="post">
    <div class="mail-buttons">
        <input name="delete_mail" type="submit" value="Delete">
        <input name="mark_as_read" type="submit" value="Mark as Read">
    </div>

    <br>

    <table border="1" id="inbox-table">
        <th>Sender</th>
        <th>Subject</th>
        <th>Sent</th>
        <th></th>
    <?php
    while ($row = $stmt->fetch()) {
    ?>
        
        <?php
        if ($row["uid_2_read"] == 'F') {
            echo "<tr>";
        } else {
            echo "<tr class='mess-read'>";
        }
        ?>
        <td class="t-pm-sender">
            <a style="text=decoration:none;" href="member.php?uid=<?php echo $row["uid_1"]; ?>">
            <?php echo getUname($conn, $row["uid_1"]); ?>
            </a>
        </td>
        <td class="t-pm-subject">
            <a style="text-decoration:none;" href="show_message.php?id=<?php echo $row["id"]; ?>">
            <?php echo $row["title"]; ?>
            </a>
        </td>
        <td class="t-pm-sent"><?php echo $row["send_date"]; ?></td>
        <td class="t-pm-check">
            <input type="checkbox" name="pm_check[]" value="<?php echo $row["id"]; ?>">
        </td>
        </tr>
    <?php
    }
    ?>
    </table>
</form>
