<div class="page-head">
    <a href="index.php" class="logo-top"></a>
</div>
<?php
session_start();
if (!empty($_SESSION["username"])) {
    echo "<div class='user-toparea'>\n";
    echo "<a id='username' href='member.php?uid=" . $_SESSION["uid"] . "'><strong>".$_SESSION["username"]."</strong></a>\n";
    echo "&nbsp;&nbsp;";
    echo "<br>\n";
    //echo "<a id='link' class='site-but' href='logout.php'>Logout</a>";
    echo "<input type='button'  onclick='location.href=\"logout.php\";' value='Logout'>\n";
    echo "</div>";
} else {
    //echo "<a id='link' class='site-but' href='login.php'>Login</a>";
    echo "<div class='user-toparea'>\n";
    echo "<input type='button' onclick='location.href=\"login.php\";' value='Login'>\n";
    echo "</div>\n";
}
?>
