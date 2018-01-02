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


$uid = $_SESSION["uid"];
$stmt = $conn->prepare("SELECT * FROM messages WHERE uid_2 = ?");
$stmt->bindParam(1, $uid);

$stmt->execute();
?>

<table border="1" id="inbox-table">
    <th>Sender</th>
    <th>Subject</th>
    <th>Sent</th>
<?php
while ($row = $stmt->fetch()) {
?>
    <tr>
    <td class="t-pm-sender"><?php echo getUname($conn, $row["uid_1"]); ?></td>
    <td class="t-pm-subject">
    <a style="text-decoration:none;" href="show_message.php?id=<?php echo $row["id"]; ?>">
        <?php echo $row["title"]; ?>
    </a>
    </td>
    <td class="t-pm-sent"><?php echo $row["send_date"]; ?></td>
    </tr>
<?php
}
?>
</table>
