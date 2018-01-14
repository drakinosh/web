<?php

include 'captcha_tools.php';


$str = generateString(8);
generateCaptchaImage($str);

?>
