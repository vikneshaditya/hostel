
<?php
    session_start();
    //PHP CAPTCHA image
    //Generated by https://www.html-code-generator.com/php/captcha-image-code-generator.php



    $width = 130;
    $height = 30;
    $font_size = 20;
    $font = "./verdana.ttf";
    $font = realpath($font);
    $chars_length = 4;

    $captcha_characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $image = imagecreatetruecolor($width, $height);
    $bg_color = imagecolorallocate($image, 255, 0, 0);
    $font_color = imagecolorallocate($image, 255, 255, 255);
    imagefilledrectangle($image, 0, 0, $width, $height, $bg_color);

    //background random-line
    $vert_line = round($width/5);
    $color = imagecolorallocate($image, 255, 255, 255);
    for($i=0; $i < $vert_line; $i++) {
        imageline($image, rand(0,$width), rand(0,$height), rand(0,$height), rand(0,$width), $color);
    }

    $xw = ($width/$chars_length);
    $x = 0;
    $font_gap = $xw/2-$font_size/2;
    $digit = '';
    for($i = 0; $i < $chars_length; $i++) {
        $letter = $captcha_characters[rand(0, strlen($captcha_characters)-1)];
        $digit .= $letter;
        if ($i == 0) {
            $x = 0;
        }else {
            $x = $xw*$i;
        }
        imagettftext($image, $font_size, rand(-20,20), $x+$font_gap, rand(22, $height-5), $font_color, $font, $letter);
    }

    // record token in session variable
    $_SESSION['captcha_token'] = strtolower($digit);

    // display image
    header('Content-Type: image/png');
    imagepng($image);
    imagedestroy($image);
?>
