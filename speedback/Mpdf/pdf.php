<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Require composer autoload
require_once __DIR__ . '/vendor/autoload.php';
// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();

// Write some HTML code:
$mpdf->WriteHTML('Hello World');

// Output a PDF file directly to the browser
//$mpdf->Output();
$mpdf->Output('demoD.pdf','F');
//$imagick = new Imagick();
//$imagick->readImage('myfile.pdf');
//$imagick->writeImages('converted.jpg', false);

//$image = new Imagick("demoD.pdf");
//$image->setResolution(300, 300);
//$image->setImageFormat("png");
//$image->writeImage("demoD.png");

#$imagick = new Imagick();

#$imagick->readImage('demoD.pdf');

#$imagick->writeImages('converted.jpg', false);
?>