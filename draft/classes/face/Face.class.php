<?php
class RPGFace {

	private function _get16x16TransparentBackground() {

		$tmp = array_fill(0, 16, array());
		for($i = 0, $c = count($tmp); $i< $c; $i++) {
			$tmp[$i] = array_fill(0, 16, 'NONE');
		}
		return $tmp;
	}

	public function get16x16Key() {
		$k = $this->_get16x16TransparentBackground();
		// <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAK3RFWHRDcmVhdGlvbiBUaW1lAEZyIDI0IEF1ZyAyMDA3IDA5OjAwOjU2ICswMTAwsT3/hwAAAAd0SU1FB9cIGAcNK3pvIw4AAAAJcEhZcwAACxIAAAsSAdLdfvwAAAAEZ0FNQQAAsY8L/GEFAAABsklEQVR42mNkIALUpBnN4/rPFMnBzcbCKMS7o7Bupy9MjpGQ5rpY/Q+xUTr8sho6DOzc7AxXLlxlOH7k/t+0pn0sIHlmfJrLQrWWxkQamEqq6DAsn7GbYd/2iwwOLhYM3MxvmNSVuB13Hn2+gAWfAd8//PFR1ZViWDxnL0Nq7z6wazk42P6lJokxbt3OZQ/iM+Ez4Mu71+9ZeMQZGJn+wsXUdP4x/v/9g+H2mdv/QHy8LmDn5Vq1e8PZ0vgUMwbWP1////zxk8HB0ZJh75LHDK9ffFpF0AAWJmYn52Avhn1zNzE4+oYw/P3+i2H57MMMW1Yd+rTt1fdIvKGf4yR35u+7Jf8Pd9r8B7J3RGoKHg2Q4DrhzMpTTDDe0TSfIahhQDUzI2ueuKbN+Oa2ZQx80pIMT978lXTyUeHbd/DBLqJtPtNn8P/ibLf/v+43////uu1/X7blf0J6wQlJQlNy5oyiiQwHd3xmEBb5yfDk/AmG/OAlDL++MvwjyoCaqSfnXH7wVu7Su39GHfXP/v39zsDAryr59OqzF6KEDMDIjRHq0mpsbCynOUXZHGfuu32OkAEAuQTAdihI7A8AAAAASUVORK5CYII=">
		$k[1][6] = $k[1][7] = $k[1][8] = '000';
		$k[3][6] = $k[3][7] = $k[3][8] = '000';
		$k[6][6] = $k[6][7] = $k[6][8] = '000';
		$k[2][5] = $k[3][5] = $k[4][5] = $k[5][5] = '000';
		$k[2][9] = $k[3][9] = $k[4][9] = $k[5][9] = '000';
	}

	public function get16x16Face() {
		// La couleur de la peau
		if (mt_rand(0,5)) {
			// http://www.makehuman.org/forum/viewtopic.php?f=8&t=1529
			$skin_blue = mt_rand(70, 200);
			$red_multiplicator = mt_rand(147,153)/100; // 1.5 est le mieux
			$green_multiplicator = mt_rand(112,118)/100; // 1.15 est le mieux
			$skin_red = $skin_blue * $red_multiplicator > 255 ? 255 : $skin_blue * $red_multiplicator;
			$skin_green = $skin_blue * $green_multiplicator > 255 ? 255 : $skin_blue * $green_multiplicator;
			$skin_color = dechex(round($skin_red)) . dechex(round($skin_green)) .  dechex($skin_blue);
		} else {
			// Plus improbable
			$skin_red = mt_rand(220,255);
			$skin_green = mt_rand(205,255);
			$skin_blue = mt_rand(190,255);
			$skin_color = dechex($skin_red) . dechex($skin_green) .  dechex($skin_blue);
		}

		$noze_blue_coef = mt_rand(20, 70);
		$noze_blue = $skin_blue - $noze_blue_coef;
		if ($noze_blue < 16) $noze_blue = 16;
		$noze_red = $noze_blue * 1.5;
		$noze_green = $noze_blue * 1.15;
		$noze_color = dechex(round($noze_red)) . dechex(round($noze_green)) .  dechex(round($noze_blue));

		$mouth_color = dechex(round($skin_red - mt_rand(0, $noze_blue_coef))) . dechex(round($noze_green)) .  dechex(round($noze_blue));

		if (mt_rand(0,1)) {
			$eye_color = '00' . '00' .  dechex(mt_rand(16,200));
		} else {
			$eye_color = '00' . dechex(mt_rand(16,200)) .  '00';
		}
		$white_eye_red = ($skin_red + 255)/2;
		$white_eye_green = ($skin_green + 255)/2;
		$white_eye_blue = ($skin_blue + 255)/2;
		$white_eye_color = dechex($white_eye_red < 16 ? 16 : $white_eye_red) . dechex($white_eye_green < 16 ? 16 : $white_eye_green) .  dechex($white_eye_blue < 16 ? 16 : $white_eye_blue);

		// On fait un fond blanc de 16x16
		$face = $this->_get16x16TransparentBackground();

		// Le tour du visage
		for ($i = 0, $i_l = mt_rand(3,5); $i < $i_l; $i++) {
			$face[1][7-$i] = $face[1][8+$i] = '000';
		}
		$face[2][7-$i_l] = $face[2][8+$i_l] = '000';
		for($i = 7-$i_l+1; $i< 8+$i_l; $i++) $face[2][$i] = $skin_color; // skin
		if (mt_rand(0, 1)) {
			$face[2][7-$i_l-1] = $face[2][8+$i_l+1] = '000';
			$i_l++;
		}
		$face[3][7-$i_l-1] = $face[3][8+$i_l+1] = '000';
		for($i = 7-$i_l; $i< 8+$i_l+1; $i++) $face[3 + (isset($j) ? $j : 0)][$i] = $skin_color; // skin
		for($j = 0, $j_l = mt_rand(3,7); $j < $j_l; $j++) {
			$face[4 + $j][7-$i_l-1] = $face[4 + $j][8+$i_l+1] = '000';
			for($i = 7-$i_l; $i< 8+$i_l+1; $i++) $face[4 + $j][$i] = $skin_color; // skin
		}
		for($j = 0, $j_l2 = 8-$j_l; $j < $j_l2; $j++) {
			$face[4 + $j_l + $j][7-$i_l] = $face[4 + $j_l + $j][8+$i_l] = '000';
			for($i = 7-$i_l+1; $i< 8+$i_l; $i++) $face[4 + $j_l + $j][$i] = $skin_color; // skin
		}
		$face[12][7-$i_l+1] = $face[12][8+$i_l-1] = '000';
		for($i = 7-$i_l+2; $i< 8+$i_l-1; $i++) $face[12][$i] = $skin_color; // skin
		$modif = mt_rand(1,2);
		$face[13][7-$i_l+$modif] = $face[13][8+$i_l-$modif] = '000';
		for($i = 7-$i_l+$modif+1; $i< 8+$i_l-$modif; $i++) $face[13][$i] = $skin_color; // skin
		for ($i = 0, $i_l = $i_l-$modif; $i < $i_l; $i++) {
			$face[14][7-$i] = $face[14][8+$i] = '000';
		}

		// Les yeux
		$eye_x = mt_rand(-1,1);
		$eye_y = mt_rand(-1,1);
		$face[5+$eye_y][5+$eye_x] = $face[5+$eye_y][10-$eye_x] = $eye_color;
		if (mt_rand(0,1) == 1 && $eye_x<1) {
			$face[5+$eye_y][5+$eye_x+1] = $face[5+$eye_y][10-$eye_x-1] = $eye_color;
			$face[5+$eye_y][5+$eye_x+mt_rand(0,1)] = $face[5+$eye_y][10-$eye_x-mt_rand(0,1)] = $white_eye_color;
		}

		// Le nez
		$noze_y = mt_rand(0,2);
		$face[7+$noze_y][7] = $face[7+$noze_y][8] = $noze_color;
		$abs_noze_y = 7+$noze_y;

		// La bouche
		$mouth_type = mt_rand(0,5);

		if ($mouth_type < 4) {
			if (mt_rand(0,1)) {
				$mouth_y = $abs_noze_y + mt_rand(0,3);
			} else {
				$mouth_y = $abs_noze_y + 2 + mt_rand(0,1);
			}
			if ($mouth_y == $noze_y +1 && mt_rand(0,5) < 4) {
		  		$mouth_y +=1;
			}
			for ($i = 0, $mouth_l_x = mt_rand(1,3); $i < min($i_l, $mouth_l_x); $i++) {
				$face[$mouth_y][7-$i] = $face[$mouth_y][8+$i] = $mouth_color;
			}
		} elseif ($mouth_type == 4) {
			$mouth_y = $abs_noze_y + 2 + mt_rand(0,1);
			$mouth_length = mt_rand(1,3);
			$face[$mouth_y][7-$mouth_length+1] = $face[$mouth_y][8+$mouth_length-1] = $mouth_color;
			for ($i = 0, $mouth_l_x = $mouth_length -1; $i < min($i_l, $mouth_l_x); $i++) {
				$face[1+$mouth_y][7-$i] = $face[1+$mouth_y][8+$i] = $mouth_color;
			}
		} else {
			$mouth_y = $abs_noze_y + 2 + mt_rand(0,1);
			$mouth_length = mt_rand(1,3);
			for ($i = 0, $mouth_l_x = $mouth_length -1; $i < min($i_l, $mouth_l_x); $i++) {
				$face[$mouth_y][7-$i] = $face[$mouth_y][8+$i] = $mouth_color;
			}
			$face[1+$mouth_y][7-$i] = $face[1+$mouth_y][8+$i] = $mouth_color;
		}
		return $face;
	}

}

?>