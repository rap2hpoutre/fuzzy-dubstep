<?php
for ($i = 0; $i < 5; $i++) {
	$ct = array(mt_rand(20,255),mt_rand(20,255),mt_rand(20,255));
	$cb = array(mt_rand(0,$ct[0]),mt_rand(0,$ct[1]),mt_rand(0,$ct[2]));

	$image = imagecreatefrompng('images/plateforme1.png');

	$border = imagecolorallocate($image,0,0,0);
	$white = imagecolorallocate($image,255,255,255);

	$cti = imagecolorallocate($image, $ct[0], $ct[1], $ct[2]);
	$cbi = imagecolorallocate($image, $cb[0], $cb[1], $cb[2]);



	imagefilltoborder($image,40,8, $border, $cti);
	imagefilltoborder($image,40,16, $border, $cbi);

	imagecolortransparent($image,$white);

	imagepng($image, 'images/ptf' . $i . '.png');
	imagedestroy($image);
}