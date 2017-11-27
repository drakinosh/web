<?php

define ('SERVER', 'localhost');
define ('USER', 'sample');
define ('PASS' , 'melon');
define ('DBASE', 'proj_db');

try {
    $conn = new PDO('mysql:host=' . SERVER . ';dbname=' . DBASE,
                    USER, PASS);
} catch (PDOException $e) {
    print "Error: " . $e->getMessage() . "<BR>";
    die();
}

?>
