<?php
$im = imagecreatefrompng("images/test.png");

//header('Content-Type: image/png');

imagepng($im);
imagedestroy($im);
?>
