<?php

/* createEntityTable: creates table according to given type */
function createEntityTable($table) {

    if ($table == "users") {
        echo "<table border='1' id='userTable' class='entity-table'>\n";
        echo "<th>uid</th>\n";
        echo "<th>username</th>\n";
    } else if ($table == "threads") {
        echo "<table border='1' id='threadTable' class='entity-table'>\n";
        echo "<th>tid</th>\n";
        echo "<th>title</th>\n";
        echo "<th>date</th>\n";
    } else if ($table == "posts") {
        echo "<table border='1' id='postTable' class='entity-table'>\n";
        echo "<th>pid</th>\n";
        echo "<th>thread_id</th>\n";
        echo "<th>date</th>\n";
    }
}

function displayEntityValues($table, $execStatement, $repArray)
{
    // repArray -> array containing all reported post ids

    if ($table == "users") {

        while ($row = $execStatement->fetch()) {
            echo "<tr>\n";
            echo "<td class='idh'>" . $row["uid"] . "</td>\n";
            echo "<td class='username'>" . $row["username"] . "</td>\n";
            echo "</tr>\n";
        }
    } else if ($table == "threads") {
        while ($row = $execStatement->fetch()) {
            echo "<tr>\n";
            echo "<td class='idh'>" . $row["tid"] . "</td>\n";
            echo "<td class='title'>" . $row["title"]. "</td>\n";
            echo "<td class='date'>" . $row["pub_date"] . "</td>\n";
            echo "</tr>\n";
        }
    } else if ($table == "posts") {

        # also, highlight reported posts
        while ($row = $execStatement->fetch()) {
            echo "<tr>\n";
            if (!in_array($row["pid"], $repArray)) {
                echo "<td class='idh'>" . $row["pid"] . "</td>\n";
            } else {
                $l_open = "<a href='../view_thread.php?id=" . $row["p_tid"] . "#post-" . $row["pid"] . "'>";
                echo "<td class='idh reported'>" . $l_open . $row["pid"] . "</a>\n";
                echo "</td>\n";
            }

            echo "<td class='thread_id'>" . $row["p_tid"] . "</td>\n";
            echo "<td class='date'>" . $row["pub_date"] . "</td>\n";
            echo "</tr>\n";
        }
    }

    echo "</table>";
}

function deleteEntity($table, $e_id, $conn) {

    $id = $table[0] . "id"; // e.g. tid, uid, or pid

    $stmt = $conn->prepare("DELETE FROM " . $table . " WHERE " . $id . " = ?");
    $stmt->bindParam(1, $e_id);

    if (!$stmt->execute()) {
        print "adminhelper: database error";
    }

    unset($stmt);
}

function changeUserPriv($u_id, $conn, $level)
{
    $stmt = $conn->prepare("UPDATE users SET level=? WHERE uid=?");
    $stmt->bindParam(1, $level);
    $stmt->bindParam(2, $u_id);
    if (!$stmt->execute()) {
        print "adminhelper: database error";
    }
    unset($stmt);
}
?>
