<?php

session_start();

if (!isset($_SESSION["level"])) {
    exit;
}

if ($_SESSION["level"] != "M" && $_SESSION["level"] != "A") {
    exit;
}
?>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Mod Page</title>
</head>
<body>
<?php

require_once 'config.php';
require_once 'helpers/mod_helper.php';


if ($_SERVER["REQUEST_METHOD"] == "GET") {


    $act = $_GET["act"];
    $tid = $_GET["tid"];

    if ($act == 'close') {
        print "calling close";
        closeThread($conn, $tid);
    } else if ($act == 'sticky') {
        makeSticky($conn, $tid);
    }

}
unset($stmt);
?>
</body>
</html>
