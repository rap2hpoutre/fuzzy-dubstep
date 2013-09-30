<?php
$ps = 32;
$nb_maisons = 5;
for ($i = 0; $i<$nb_maisons; $i++) {
	$w = mt_rand(3,10);
	$h = mt_rand(2,5);
	$z = 1;
	$d = mt_rand(1,$w-2);
	$maisons[] = array('w' => $w, 'h' => $h, 'z' =>$z, 'd' => $d);
}


function drawMaison($maison, $x_start, $max_heigth) {
	global $image;
	global $black, $white;
	$ps = 32;
	$cf = array(mt_rand(20,255),mt_rand(20,255),mt_rand(20,255));
	$cc = array(mt_rand(0,$cf[0]),mt_rand(0,$cf[1]),mt_rand(0,$cf[2]));
	$cs = array(mt_rand(0,$cf[0]),mt_rand(0,$cf[1]),mt_rand(0,$cf[2]));
	$cd = array(mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
	$w = $maison['w'];
	$h = $maison['h'];
	$z = $maison['z'];
	$d = $maison['d'];

	$y_start = ($max_heigth - $h) * $ps;


	imagefilledrectangle($image, $x_start+0, $y_start + $z*$ps, $x_start+$w*$ps, $y_start + $h*$ps+$z*$ps, imagecolorallocate($image, $cf[0], $cf[1], $cf[2]));
	imagerectangle($image, $x_start+0, $y_start + $z*$ps, $x_start+$w*$ps, $y_start + $h*$ps+$z*$ps, $black);

	// Porte
	imagefilledrectangle(
		$image, $x_start+$d*$ps, $y_start + ($h+$z-1)*$ps, $x_start+($d+1)*$ps, $y_start + ($h+$z)*$ps,
		imagecolorallocate($image, $cs[0], $cs[1], $cs[2])
	);
	imagefilledrectangle(
		$image, $x_start+$d*$ps+4, $y_start + ($h+$z-1)*$ps, $x_start+($d+1)*$ps, $y_start + ($h+$z)*$ps-4,
		imagecolorallocate($image, $cc[0], $cc[1], $cc[2])
	);
	imagerectangle($image, $x_start+$d*$ps, $y_start + ($h+$z-1)*$ps, $x_start+($d+1)*$ps, $y_start + ($h+$z)*$ps,$black);

	$values = array(
		$x_start+$d*$ps, $y_start + ($h+$z)*$ps,
		$x_start+$d*$ps+4, $y_start+($h+$z)*$ps-4,
		$x_start+($d+1)*$ps-1, $y_start + ($h+$z)*$ps-4,
		$x_start+($d+1)*$ps-1, $y_start + ($h+$z)*$ps,
	);
	imagefilledpolygon($image, $values, 4, $white);

	imagerectangle($image, $x_start+$d*$ps+4, $y_start+($h+$z-1)*$ps, $x_start+($d+1)*$ps, $y_start+($h+$z)*$ps-4,$black);
	imageline($image, $x_start+$d*$ps, $y_start + ($h+$z)*$ps, $x_start+$d*$ps+4, $y_start+($h+$z)*$ps-4, $black);
	// FIn porte

	// Fenetre test
	for ($i = 0, $nb = mt_rand(0,$w*($h-1)); $i < $nb; $i++) {
		$position_fenetre_x = $x_start + mt_rand(0, $w -1) * $ps;
		$position_fenetre_y = $y_start + mt_rand(0, $h -2) * $ps;

		imagefilledrectangle(
			$image, $position_fenetre_x+8, $position_fenetre_y + $z*$ps+8, $position_fenetre_x+24, $position_fenetre_y + $z*$ps +24,
			imagecolorallocate($image, $cs[0], $cs[1], $cs[2])
		);
		imagefilledrectangle(
			$image, $position_fenetre_x+11, $position_fenetre_y + $z*$ps+8, $position_fenetre_x+24, $position_fenetre_y + $z*$ps +21,
			imagecolorallocate($image, 150, 220, 255)
		);
		imagerectangle($image, $position_fenetre_x+8, $position_fenetre_y + $z*$ps+8, $position_fenetre_x+24, $position_fenetre_y + $z*$ps +24,$black);
		imagerectangle($image, $position_fenetre_x+11, $position_fenetre_y + $z*$ps+8, $position_fenetre_x+24, $position_fenetre_y + $z*$ps +21,$black);
		imageline($image, $position_fenetre_x+8, $position_fenetre_y + $z*$ps +24, $position_fenetre_x+11, $position_fenetre_y + $z*$ps +21, $black);
	}


	// Fnn fenetre test
	$values = array(
		$x_start+ $z*$ps,  $y_start + 0,
		$x_start + $w*$ps + $z*$ps,  $y_start + 0,
		$x_start + $w*$ps,  $y_start + $z*$ps,
		$x_start + 0, $y_start + $z*$ps,
	);
	imagefilledpolygon($image, $values, 4, imagecolorallocate($image, $cc[0], $cc[1], $cc[2]));
	imagepolygon($image, $values, 4, $black);

	$values = array(
		$x_start+ $w*$ps,  $y_start + $z*$ps,
		$x_start+$w*$ps + $z*$ps,  $y_start + 0,
		$x_start+$w*$ps + $z*$ps,  $y_start + $h*$ps,
		$x_start+$w*$ps, $y_start + $h*$ps + $z*$ps,
	);
	imagefilledpolygon($image, $values, 4, imagecolorallocate($image, $cs[0], $cs[1], $cs[2]));
	imagepolygon($image, $values, 4, $black);
}


$tw = 0;
$maxh = 5;
foreach($maisons as $maison){
	$tw+=$maison['w'];
	$maxh = max($maison['h'], $maxh);
}
$z = 1;
$image = imagecreatetruecolor(($tw+$z) * $ps + 16*$nb_maisons, ($maxh+$z) *$ps+1);
$black = imagecolorallocate($image, 0, 0, 0);
$white = imagecolorallocate($image, 255, 255, 255);
imagefilledrectangle($image, 0, 0, ($tw+$z) * $ps + 16*$nb_maisons, ($maxh+$z) *$ps, $white);
$current_x_start= 0;
foreach($maisons as $maison){
	drawMaison($maison, $current_x_start, $maxh);
	$current_x_start+= $maison['w']*$ps + 16;
}

imagecolortransparent($image,$white);

// Affichage de l'image

// header('Content-type: image/png');
imagepng($image, 'images/houses.png');
imagedestroy($image);
?>