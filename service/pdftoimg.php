<?php
$imagick = new Imagick();

$imagick->readImage('API.pdf');

$imagick->writeImages('converted.jpg', false);
?>