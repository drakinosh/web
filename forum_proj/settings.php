<?php

session_start();

require_once 'config.php';

if (!isset($_GET["uid"])) {
    exit;
}

if (!($_GET["uid"] == $_SESSION["uid"])) {
    print "Unauthorised Access.\n";
    exit;
}


// gather some relevant data
$stmt = $conn->prepare("SELECT * FROM users WHERE uid=?");
$stmt->bindParam(1, $_SESSION["uid"]);
$stmt->execute();

$row=$stmt->fetch();
unset($stmt);

$loc = $row["location"];

?>

<html>
<head>
    <title>Settings</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="styles/<?php echo getSheet(); ?>" id="main-style">
</head>
<body>
<?php
include 'head.php';
?>

<form action="process_settings.php" method="post">

    <h3 class="setting-head">Style Settings</h3>
    <p>Theme:</p>
    <select name="colours" id="colour-select">
        <option value="blue">Blue(Default)</option>
        <option value="green">Green</option>
        <option value="red">Red</option>
    </select>

    <p>________________________________</p>


    <h3 class="setting-head">Change Password</h3>
    <div>
    <label class="form-label">Current Password:</label>
    <input class="form-field" type="password" name="curr_pass">
    </div>
    
    <div>
    <label class="form-label">New Password:</label>
    <input class="form-field" type="password" name="new_pass">
    </div>

    <div>
    <label class="form-label">Confirm New Password:</label>
    <input class="form-field" type="password" name="confirm_new_pass">
    </div>

    <p>________________________________</p>

    <h3 class="setting-head">Change Location</h3>
    <div>
    <label class="form-label">Location:</label>
    <input class="form-field" type="text" name="location" value="<?php echo $loc; ?>">
    </div>

    <h3 class="setting-head">Add Signature</h3>

    <input type="hidden" name="uid" value="<?php echo $_SESSION["uid"]; ?>">
    <input type="submit" name="sumbit-but" value="Apply"></input>

</body>
</html>
