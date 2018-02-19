<?php

define ('SERVER', 'localhost');
define ('USER', 'sample');
define ('PASS' , 'melon');
define ('DBASE', 'proj_db');

define ('PARSE_BBCODE', 'TRUE');

const FLAG_STUDENT = 0b00000001; // 1
const FLAG_MAINTAINER = 0b00000010; // 2

try {
    $conn = new PDO('mysql:host=' . SERVER . ';dbname=' . DBASE,
                    USER, PASS);
} catch (PDOException $e) {
    print "Error: " . $e->getMessage() . "<BR>";
    die();
}

function getSheet() {
    if (isset($_COOKIE["style_sheet"])) {
        return $_COOKIE["style_sheet"];
    }
    return "style_blue.css";
}

function dbase_die() {
    print "Database Error.";
    exit;
}
?>
