<html>
<head>
    <meta charset="utf-8">
    <title>Req process</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php

session_start();

require_once 'config.php';

if (!isset($_SESSION["uid"])) {
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // the checkbox values are in the ph_check array

    if (isset($_POST["delete_mail"])) {
        $a_stmt = $conn->prepare("UPDATE messages SET uid_2=-1 WHERE id=?");
    } else if (isset($_POST["mark_as_read"])) {
        $a_stmt = $conn->prepare("UPDATE messages SET uid_2_read='T' WHERE id=?");
    }

    $a_stmt->bindParam(1, $check_m_id);

    // at least one set
    if (!empty($_POST["pm_check"])) {
        foreach ($_POST["pm_check"] as $pm_cbox_val) {
            $check_m_id = $pm_cbox_val;

            if (!$a_stmt->execute()) {
                print "Database error.";
            }
        }
    }

    unset($a_stmt);
}

?>

<a href="javascript:history.go(-1)">Go back</a>
</body>
</html>
