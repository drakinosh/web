<?php

$fp = fopen("captcha.png", "rb");

header("Content-Type: image/png");
header("Content-Length: " . filesize("captcha.png"));
fpassthru($fp);
exit;
?>
