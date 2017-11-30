<?php

require_once 'config.php';

$username = "";
$password = "";
$confirm_password = "";

// process data 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //NOTE: assume username and pass is properly filled in
    //<IMPORTANT>
    
    // check if username is taken
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bindParam(1, $param_username);
    $param_username = trim($_POST["username"]);

    if ($stmt->execute()) {

        if ($stmt->rowCount() == 1) {
            print "Username taken.";
        } else {
            $username = trim($_POST["username"]);
        }
    } else {
        print "Database error.";
    }

    unset($stmt);

    $password = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    if ($password !== $confirm_password) {
        print "Passwords do not match.";
        header("location: register.php");
        exit;
    }

    // file input
    // file size and not error
    if ($_FILES["avatar"]["size"] != 0 && $_FILES["avatar"]["error"] == 0) {
        $avatar_image = file_get_contents($_FILES["avatar"]["tmp_name"]);
    }

    // insert user into dbase;
    $stmt = $conn->prepare("INSERT INTO users (username, password, joined, avatar) VALUES (?, ?, ?, ?)");
    $stmt->bindParam(1, $param_username);
    $stmt->bindParam(2, $param_password);
    $stmt->bindParam(3, $param_date);
    $stmt->bindParam(4, $param_avatar);
    
    $param_username = trim($_POST["username"]);
    $param_password = password_hash($password, PASSWORD_DEFAULT);
    $param_date = date("Y:m:d H:i:s");
    $param_avatar = $avatar_image;

    if ($stmt->execute()) {
        header("location: login.php");
    } else {
        echo "Registration error.";
    }

    $conn = null;
}

?>

<html>
<head>
    <title>Register</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>
    <!-- KU Header -->
    <div class="page-head">
        <a href="index.php"><img src="ku_logo.png"></a>
        <h1>Kathmandu University Forums</h1>
    </div>


    <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <h2>Register</h2>
    <div>
    <label class="form-label">Username:<sup>*</sup></label>
    <input type="text" name="username" class="form-field" value="<?php echo $username; ?>">
    </div>

    <div>
    <label class="form-label">Password:<sup>*</sup></label>
    <input type="password" name="password" class="form-field" value="<?php echo $password; ?>">
    </div>

    <div>
    <label class="form-label">Confirm password:<sup>*</sup></label>
    <input type="password" name="confirm_password" class="form-field" value="<?php echo $confirm_password; ?>">
    </div>

    <div>
    <label class="form-label">Upload image:</label>
    <!---<IMPORTANT> add filesize restriction -->
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    <input type="file" name="avatar">
    </div>

    <div>
    <input type="submit" class="form-button" value="Submit">
    </div>
    <div>
    <input type="reset" class="form-button" value="Resert">
    </div>

    </form>
</body>
</head>
</html>
