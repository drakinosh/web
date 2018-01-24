<?php

session_start();
require_once 'config.php';

if (!isset($_SESSION["uid"])) {
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($_SESSION["uid"] != $_POST["uid"]) {
        print "Unauth. Access";
        exit;
    }    

    $uid = $_POST["uid"];
    
    // set style cookie
    $v = $_POST["colours"];
    setcookie("style_sheet", "style_" . $v . ".css", time() + 3600*8);

    // set password
    $old_pass = $_POST["curr_pass"];
    $new_pass = $_POST["new_pass"];
    $conf_new_pass = $_POST["confirm_new_pass"];

    // retrieve old pass
    $stmt = $conn->prepare("SELECT password FROM users WHERE uid=?");
    $stmt->bindParam(1, $uid);
    if (!$stmt->execute()) {
        print "Database error.";
        exit;
    }
    $row = $stmt->fetch();
    unset($stmt);
    $hashed_pass = $row["password"];

    if (!empty($old_pass) && !empty($new_pass) && !empty($conf_new_pass)) {

        if (!password_verify($old_pass, $hashed_pass)) {
            print "Incorrect password.";
            exit;
        }

        // check if the two passes match
        if ($new_pass == $conf_new_pass) {
            $pass = password_hash($new_pass, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE users SET password=? WHERE uid=?");
            $stmt->bindParam(1, $pass);
            $stmt->bindParam(2, $uid);

            if(!$stmt->execute()) {
                dbase_die();
            }

            print "Password Sucessfully Changed.";
        }
    }


    // changing location
    if (isset($_POST["location"])) {
        $stmt = $conn->prepare("UPDATE users SET location=? WHERE uid=?");
        $stmt->bindParam(1, $_POST["location"]);
        $stmt->bindParam(2, $uid);
        $stmt->execute();
        unset($stmt);
    }
}

?>
