<?php

require_once 'config.php';

$username = "";
$password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
    
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (!empty($username) && !empty($password)) {

        #<IMPORTANT> Have skipped checking
        $stmt = $conn->prepare("SELECT username, password, uid FROM users where username = ?");
        $stmt->bindParam(1, $param_username);

        $param_username = $username;

        if ($stmt->execute()) {

            if ($stmt->rowCount() == 1) {

                $row = $stmt->fetch();

                $hashed_pass = $row["password"];
                $uid = $row["uid"];

                if (password_verify($password, $hashed_pass)) {

                    session_start();
                    $_SESSION["username"] = $username;
                    $_SESSION["uid"] = $uid;
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
    <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>

    <!-- KU header -->
    <div class="page-head">
        <a href="index.php"><img src="ku_logo.png"></a>
        <h1>Kathmandu University Forums</h1>
    </div>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

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
    
</body>
</head>
</html>
