<?php
$tmp = array();
define('BASEDIR', '');
require(BASEDIR . 'classes/world/Human.class.php');
$builder = new RPGHumanBuilder();

for ($i = 0; $i < 11; $i++) {
	$image = imagecreatefrompng('test3.png');
	$border = imagecolorallocate($image,0,0,0);
	$white = imagecolorallocate($image,255,255,255);

	// Peau
	$skin_blue = mt_rand(70, 200);
	$red_multiplicator = mt_rand(147,153)/100; // 1.5 est le mieux
	$green_multiplicator = mt_rand(112,118)/100; // 1.15 est le mieux
	$skin_red = $skin_blue * $red_multiplicator > 255 ? 255 : $skin_blue * $red_multiplicator;
	$skin_green = $skin_blue * $green_multiplicator > 255 ? 255 : $skin_blue * $green_multiplicator;
	$chead = imagecolorallocate($image, $skin_red, $skin_green, $skin_blue);

	// Vetements
	$cbr = mt_rand(0,255);
	$cbg = mt_rand(0,255);
	$cbb = mt_rand(0,255);
	$cbody = imagecolorallocate($image, $cbr, $cbg, $cbb);


	$clr = mt_rand(0,255);
	$clg = mt_rand(0,255);
	$clb = mt_rand(0,255);
	$clegs = imagecolorallocate($image, $clr, $clg, $clb);

	$chr = mt_rand(0,255);
	$chg = mt_rand(0,255);
	$chb = mt_rand(0,255);
	$chair = imagecolorallocate($image, $chr, $chg, $chb);

	// Création de l'image

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


	imagetruecolortopalette($image, true, 32);
	$index = imagecolorclosest ($image,255,0,0);
	imagecolorset($image,$index, $cbr, $cbg, $cbb);
	$index = imagecolorclosest ($image,0,255,0);
	imagecolorset($image,$index, $clr, $clg, $clb);
	$index = imagecolorclosest ($image,255,255,0);
	imagecolorset($image,$index, $skin_red, $skin_green, $skin_blue);
	$index = imagecolorclosest ($image,0,255,255);
	imagecolorset($image,$index, $chr, $chg, $chb);

	imagepng($image, $i == 0 ? 'images/player.png' : 'images/pnj' . $i . '.png');
	imagedestroy($image);

	if ($i > 0) {
		$j = $i-1;
		// Maintenant on crée le JS
		$human = $builder->build();
		$bg_text_color = "rgba($cbr,$cbg,$cbb,0.95)";

		$text_color = "black";
		$luma = 0.2126 * $cbr + 0.7152 * $cbg + 0.0722 * $cbb; // per ITU-R BT.709
		if ($luma < 40) {
			$text_color = "white";
		}

		if (rand(0,1)) {
			$vx = mt_rand(-8,8) * 10;
		} else {
			$vx = '0';
		}


		$tmp_js[] =
			'pnjs.push(
				stage.insert(
					new Q.NPC({
						x: Math.round((houses.p.cx - Math.floor(Math.random()*houses.p.w))/16)*16,
						y: Math.floor(Math.random()*60)+360,
						nname: "' . utf8_encode($human->getFullName()) . '",
						bg_text_color: "' . $bg_text_color . '",
						text_color: "' . $text_color . '",
						sprite: "pnj' . ($j+1) . '",
						sheet: "pnj' . ($j+1) . '",
						vx: ' . $vx . '
					})
				)
			);

			pnjs[' . $j . '].p.z = pnjs[' . $j . '].p.y;
			pnjs[' . $j . '].p.points = [
				[pnjs[' . $j . '].p.cx*-1, pnjs[' . $j . '].p.cy*.1],
				[pnjs[' . $j . '].p.cx,pnjs[' . $j . '].p.cy*.1],
				[pnjs[' . $j . '].p.cx*-1, pnjs[' . $j . '].p.cy],
				[pnjs[' . $j . '].p.cx, pnjs[' . $j . '].p.cy]
			];';
	}
}


$js = 'var pnjs = [];';
$js .= implode('', $tmp_js);
file_put_contents('testraf.js', $js);
?>