<?php
$images = "http://127.0.0.1/speedway/media/VMS240313/test1.jpg";
$new_images = "media/VMS240313/mygirl.jpg";
$images = $images;
$new_images = $new_images;
//$width=440; //*** Fix Width & Heigh (3.272727272727273) ***//
//$heigh=160; //*** Fix Width & Heigh (12.21875) ***//
$width=320; //*** Fix Width & Heigh (1.5625) ***//
$heigh=480; //*** Fix Width & Heigh (1.5625) ***//
$size=GetimageSize($images);
$height=round($width*$size[1]/$size[0]);
$images_orig = ImageCreateFromJPEG($images);
$photoX = ImagesX($images_orig);
$photoY = ImagesY($images_orig);
$srcX=$width*1.5625;
$srcY=$heigh*1.5625;
echo $photoX;
$images_fin = ImageCreateTrueColor($width, $heigh);
ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $srcX, $srcY);
ImageJPEG($images_fin,$new_images);
ImageDestroy($images_orig);
ImageDestroy($images_fin);
?>
<b>New Resize</b><br>
<img src="<?php echo $new_images;?>">