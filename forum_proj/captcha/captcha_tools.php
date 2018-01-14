<?php

function generateString($len)
{
    # 0-9, a-z, A-Z
    $digits = range(0, 9);
    $lower = range('a', 'z');
    $upper = range('A', 'Z');
    $chars =  implode($digits) . implode($upper) . implode($lower);
    $chars_len = strlen($chars);

    $random_str = '';

    for ($i=0; $i < $len; $i++) {
        $ind = rand(0, $chars_len - 1);
        $random_str .= ' ' . $chars[$ind];
    }

    return $random_str;
}

function generateCaptchaImage($chars, $fpath)
{


    $img = imagecreatetruecolor(400, 80);

    $white = imagecolorallocate($img, 255 ,255, 255);
    $grey = imagecolorallocate($img, 128, 128, 128);
    $black = imagecolorallocate($img, 0, 0, 0);

    imagefilledrectangle($img, 0, 0, 399, 79, $white);
    $font = dirname(__FILE__) . '/arial.ttf';

    // add text
    imagettftext($img, 20, 0, 120, 30, $black, $font, $chars);

    // add some noise for captcha
    // curved lines
    for ($i = 0; $i < 80; $i++) {
        imagesetthickness($img, rand(1, 5));
        imagearc($img,
            rand(1, 400), // center x
            rand(1, 400), // center y
            rand(1, 300), // width
            rand(1, 300), // height
            rand(1, 360), // starting angle
            rand(1, 360), // ending angle
            (rand(0, 1) ? $black : $grey) // color
        );
    }

    imagepng($img, $fpath);
    imagedestroy($img);
}

