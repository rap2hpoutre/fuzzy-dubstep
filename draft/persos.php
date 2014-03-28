<?php
for ($i = 0; $i < 16; $i++) {
	$image = imagecreatefrompng('test2.png');
	$border = imagecolorallocate($image,0,0,0);
	$white = imagecolorallocate($image,255,255,255);

	$skin_blue = mt_rand(70, 200);
	$red_multiplicator = mt_rand(147,153)/100; // 1.5 est le mieux
	$green_multiplicator = mt_rand(112,118)/100; // 1.15 est le mieux
	$skin_red = $skin_blue * $red_multiplicator > 255 ? 255 : $skin_blue * $red_multiplicator;
	$skin_green = $skin_blue * $green_multiplicator > 255 ? 255 : $skin_blue * $green_multiplicator;
	$chead = imagecolorallocate($image, $skin_red, $skin_green, $skin_blue);

	$cbody = imagecolorallocate($image, mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
	$clegs = imagecolorallocate($image, mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
	$chair = imagecolorallocate($image, mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));


	imagefilltoborder($image,8,3, $border, $chead);
	imagefilltoborder($image,8,10, $border, $cbody);
	imagefilltoborder($image,5,26, $border, $clegs);
	imagefilltoborder($image,11,26, $border, $clegs);

	imagefilltoborder($image,8,1, $border, $chair);
	imagefilltoborder($image,3,4, $border, $chair);
	imagefilltoborder($image,12,4, $border, $chair);
	imagefilltoborder($image,11,2, $border, $chair);
	imagefilltoborder($image,4,2, $border, $chair);

	imagecolortransparent($image,$white);

	// header('Content-type: image/png');
	imagepng($image, $i == 0 ? 'images/player.png' : 'images/pnj' . $i . '.png');
	imagedestroy($image);
}
?>