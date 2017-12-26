<?php

require_once 'config.php';
require_once 'helpers/admin_helper.php';

session_start();

if ($_SESSION["level"] != 'A') { // not admin
    header("location: index.php");
    exit;
}

?>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Admin Page</title>
</head>
<body>

<?php
echo "<strong id='username'>".$_SESSION["username"]."</strong>\n";
?>

<div class="page-head">
    <a href="index.php"><img src="ku_logo.png"></a>
    <h1>Kathmandu University Forums</h1>
</div>


<h2>Admin Operations Panel</h2>

<!-- Allow admin to ban users and delete posts directly -->

<form id="admin_form_1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
<select id="a_list_1" name="a_entity">
    <option value="v_user" name="o_user">user</option>
    <option value="v_post" name="v_post">post</option>
    <option value="v_thread" name="v_thread">thread</option>
</select>

<label>Id:</label>
<input type="text" name="e_id"></input>
Action:
<select id="a_list_2" name="a_action">
    <option value="v_ban" name="o_ban">ban</option>
    <option value="v_del" name="o_del">delete</option>
</select>

<input type="submit" name="populate" value="Populate"></input>
<input type="submit" name="execute" value="Execute"></input>
</form>

<div id="entityList">
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    # if populate was clicked
    if (isset($_POST["populate"])) {

        if (isset($_POST["a_entity"])) {

            $val = $_POST["a_entity"];

            if ($val == "v_user") {
                $table = "users";
            } else if ($val == "v_post") {
                $table = "posts";
            } else if ($val == "v_thread") {
                $table = "threads";
            }


            $stmt_1 = $conn->prepare("SELECT * FROM " . $table);

            if (!$stmt_1->execute()) {
                print "Database error.";
                exit;
            }

            createEntityTable($table);
            # create table to populate values
            
            #populate
            displayEntityValues($table, $stmt_1);
            unset($stmt_1);

        } else {
            header("location: index.php");
            exit;
        }
    } else if (isset($_POST["execute"])) {

        if (!isset($_POST["a_entity"]) || !isset($_POST["e_id"]) || !isset($_POST["a_action"])) {
            header("location: index.php");
            exit;
        }

        $e_id = $_POST["e_id"];
        $a_action = $_POST["a_action"];
        $a_entity=  $_POST["a_entity"];

        # extract table name from value (v_user -> users)
        $table = substr($a_entity, 2) . "s";

        if ($a_action  == "v_del") {
            deleteEntity($table, $e_id, $conn);
        }
    }
}
?>

</div>

</body>
</html>
