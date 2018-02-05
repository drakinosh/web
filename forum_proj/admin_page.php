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
    <link rel="stylesheet" type="text/css" href="styles/<?php echo getSheet(); ?>">
    <title>Admin Page</title>
</head>
<body>

<?php
include 'head.php';
?>

<h2 style="text-align: center;">Admin Operations Panel</h2>

<!-- Allow admin to ban users and delete posts directly -->

<form id="admin_form_1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
<select id="a_list_1" name="a_entity">
    <option value="v_user" name="o_user">user</option>
    <option value="v_post" name="v_post">post</option>
    <option value="v_thread" name="v_thread">thread</option>
</select>

<label>Id:</label>
<input type="text" name="e_id"></input>
<input type="submit" name="populate" value="Populate"></input>

Action:
<select id="a_list_2" name="a_action">
    <option value="v_ban" name="o_ban">ban</option>
    <option value="v_unban" name="o_unban">unban</option>
    <option value="v_del" name="o_del">delete</option>
    <option value="v_mmod" name="o_mmod">make mod</option>
</select>

<br>

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
            $stmt_r = $conn->prepare("SELECT pid FROM reports");
            if (!$stmt_r->execute()) {
                print "Database error.";
                exit;
            }
            $rep_array = array();
            while ($row= $stmt_r->fetch()) {
                array_push($rep_array, $row["pid"]);
            }

            unset($stmt_r);

            if (!$stmt_1->execute()) {
                print "Database error.";
                exit;
            }

            createEntityTable($table);
            # create table to populate values
            #
        
            
            #populate
            displayEntityValues($table, $stmt_1, $rep_array);
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
        } else if ($a_action == "v_ban") {
            if ($table == "users") {
                changeUserPriv($e_id, $conn, 'B');
            }
        } else if ($a_action == "v_unban") {
            if ($table == "users") {
                changeUserPriv($e_id, $conn, 'U');
            }
        } else if ($a_action == "v_mmod") {
            if ($table == "users") {
                changeUserPriv($e_id, $conn, 'M');
            }
        }
    }
}
?>

</div>

</body>
</html>
