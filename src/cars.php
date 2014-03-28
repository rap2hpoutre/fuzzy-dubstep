<?php

for ($i = 0; $i < 3; $i++) {
	$image = imagecreatefrompng(dirname(__FILE__) . '/assets/img/car2.png');
	$border = imagecolorallocate($image,0,0,0);
	$white = imagecolorallocate($image,255,255,255);


	$cf = array(mt_rand(20,255),mt_rand(20,255),mt_rand(20,255));
	$cc = array(mt_rand(0,$cf[0]),mt_rand(0,$cf[1]),mt_rand(0,$cf[2]));
	$cs = array(mt_rand(0,$cf[0]),mt_rand(0,$cf[1]),mt_rand(0,$cf[2]));

	$cbody = imagecolorallocate($image, $cf[0], $cf[1], $cf[2]);
	$ctoit = imagecolorallocate($image, $cc[0], $cc[1], $cc[2]);
	$ctruc = imagecolorallocate($image, $cs[0], $cs[1], $cs[2]);

	imagefilltoborder($image,82,28, $border, $cbody);
	imagefilltoborder($image,59,49, $border, $cbody);

	imagefilltoborder($image,76,15, $border, $ctoit);
	imagefilltoborder($image,18,39, $border, $ctoit);
	imagefilltoborder($image,155,35, $border, $ctoit);

	imagefilltoborder($image,144,23, $border, $ctoit);
	imagefilltoborder($image,169,49, $border, $ctoit);

	imagecolortransparent($image,$white);

	imagepng($image, dirname(__FILE__) . '/../public/images/car' . $i . '.png');
	imagedestroy($image);
}

?>