<?php

require_once 'config.php';
session_start();

$username = "";
$password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
    
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (!empty($username) && !empty($password)) {

        #<IMPORTANT> Have skipped checking
        $stmt = $conn->prepare("SELECT username, password, uid, level FROM users where username = ?");
        $stmt->bindParam(1, $param_username);

        $param_username = $username;

        if ($stmt->execute()) {

            if ($stmt->rowCount() == 1) {

                $row = $stmt->fetch();

                $hashed_pass = $row["password"];
                $uid = $row["uid"];
                $user_level = $row["level"];

                if (password_verify($password, $hashed_pass)) {

                    session_start();
                    $_SESSION["username"] = $username;
                    $_SESSION["uid"] = $uid;
                    $_SESSION["level"] = $user_level;
                    header("location: index.php");
                } else {
                    print ("Invalid password.");
                }
            } else {
                print "No such user.";
            }
        }
    }

    $stmt = null;
    unset($conn);
}

?>
<html>
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles/<?php echo getSheet(); ?>" type="text/css" id="main-style">
</head>

<body>

<?php
include 'head.php';
?>
    <div class="root-cont">
    <form class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

    <h2>Login</h2>
    <div>
    <label class="form-label">Username:<sup>*</sup></label>
    <input type="text" name="username" class="form-field" value="<?php echo $username; ?>">
    </div>

    <div>
    <label class="form-label">Password:<sup>*</sup></label>
    <input type="password" name="password" class="form-field" value="<?php echo $password; ?>">
    </div>

    <div>
    <input type="submit" class="form-button" value="Login">
    </div>
    <div>
    <input type="reset" class="form-button" value="Reset">
    </div>
    <p><a href="register.php"><strong>Register</strong></a></p>
    </form>
    </div>    

<?php include 'foot.php'; ?>
</body>
</head>
</html>
