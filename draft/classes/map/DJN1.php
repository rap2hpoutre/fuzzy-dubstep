<?php
class RPGDJN1 {

	public $size_x, $size_y, $iterations; // Si size_x et size_y font 51, iterations doit faire 64
	public $doors = array();
	public $rooms = array();
	public $map;
	// Par défaut les portes sont creuses
	public $doors_value;

	public function __construct() {
		$this->doors_value = RPGDJCells::CLOSED_DOOR;
	}

	public function build() {
		$size_x = $this->size_x;
		$size_y = $this->size_y;
		$iterations = $this->iterations;
		$doors = $this->doors;

		if (!$size_x || !$size_y || !$iterations || !is_a($doors[0], 'RPGDJN1Door')) trigger_error('RPGDJN1 : Variables non définies', E_USER_ERROR);

		RPGRandomTools::sRand();

		$cells = array_fill(0, $size_y, array());
		for($i = 0, $c = count($cells); $i< $c; $i++) {
			$cells[$i] = array_fill(0, $size_x, RPGDJCells::STD_WALL);
		}
		$this->map = $cells;

		for ($i = 0; $i < $iterations; $i++) {
			$current_door = array_pop($doors);

			if ($current_door) {

				// dessine une chambre
				$drawned = false;
				$room_size_x = RPGRandomTools::getOdd(3,7);
				$room_size_y = RPGRandomTools::getOdd(3,7);

				while(!$drawned && $room_size_x > 1 && $room_size_y > 1) {
					$found = true;
					$draw_cells = array();

					// On détermine les bords x et y (le périmètre)
					if ($current_door->direction == 'R' || $current_door->direction == 'L') {
						$current_border_y1 = $current_door->y - floor($room_size_y/2) -1;
						$current_border_y2 = $current_door->y + ceil($room_size_y/2);
						if ($current_door->direction == 'R') {
							$current_border_x1 = $current_door->x;
							$current_border_x2 = $current_door->x + $room_size_x + 1;
						} else {
							$current_border_x1 = $current_door->x - $room_size_x - 1;
							$current_border_x2 = $current_door->x;
						}
					} else {
						$current_border_x1 = $current_door->x - floor($room_size_x/2) -1;
						$current_border_x2 = $current_door->x +  ceil($room_size_x/2);
						if ($current_door->direction == 'D') {
							$current_border_y1 = $current_door->y;
							$current_border_y2 = $current_door->y + $room_size_y + 1;
						} else {
							$current_border_y1 = $current_door->y - $room_size_y - 1;
							$current_border_y2 = $current_door->y;
						}
					}

					// On regarde si on a la place de dessiner une pièce
					for($tmp_y = $current_border_y1; $tmp_y < $current_border_y2 + 1; $tmp_y++) {
						$draw_cells[$tmp_y] = array();
						for($tmp_x = $current_border_x1; $tmp_x < $current_border_x2+1; $tmp_x++) {
							if ($tmp_x > $current_border_x1 && $tmp_x < $current_border_x2 && $tmp_y > $current_border_y1 && $tmp_y < $current_border_y2) {
								$draw_cells[$tmp_y][$tmp_x] = 1;
							}
							$found &= $tmp_y < $size_y && $tmp_x < $size_x && $tmp_y >= 0 && $tmp_x >= 0 && ($cells[$tmp_y][$tmp_x] == 0);
						}
					}

					// Si on a la place on dessine
					if ($found) {
						if (DBG) echo "i : $i - OK <br /> ";
						$cells[$current_door->y][$current_door->x] = $this->doors_value;
						foreach($draw_cells as $ky => $vy) {
							foreach($vy as $kx => $vx) {
								$cells[$ky][$kx] = $vx;
							}
						}
						$drawned = true;

						// On crée toutes les prochaines sortie possibles
						$next_doors = array();

						for ($tmp_door_x = $current_border_x1+1; $tmp_door_x < $current_border_x2; $tmp_door_x++) {
							array_push($next_doors, (object)array('x' =>$tmp_door_x, 'y' =>$current_border_y2, 'direction' =>'D'));
							array_push($next_doors, (object)array('x' =>$tmp_door_x, 'y' =>$current_border_y1, 'direction' =>'U'));
						}

						for ($tmp_door_y = $current_border_y1+1; $tmp_door_y < $current_border_y2; $tmp_door_y++) {
							array_push($next_doors, (object)array('x' =>$current_border_x2, 'y' =>$tmp_door_y, 'direction' =>'R'));
							array_push($next_doors, (object)array('x' =>$current_border_x1, 'y' =>$tmp_door_y, 'direction' =>'L'));
						}

						// Et on en ajoute entre 2 et 4 pour les tests suivants
						$next_doors = RPGRandomTools::shuffle($next_doors);
						for ($zou = 0, $c_zou = mt_rand(2,4); $zou < $c_zou; $zou++) {
							$next_door = array_pop($next_doors);
							array_push($doors, $next_door);
						}
						$doors = RPGRandomTools::shuffle($doors);
					// Sinon on tente de réduire la chambre
					} else {
						if ($room_size_y == 3) {
							$room_size_x -= 2;
						} else {
							$room_size_y -= 2;
						}
						if ($room_size_y == 1 || $room_size_x == 1) {
							if (count($next_doors)) {
								$room_size_x = RPGRandomTools::getOdd(3,7);
								$room_size_y = RPGRandomTools::getOdd(3,7);
								$next_door = array_pop($next_doors);
								array_push($doors, $next_door);
								$current_door = array_pop($doors);
							}
						}
						if (DBG) echo "i: $i room ($room_size_x, $room_size_y) next_door ($next_door->x, $next_door->y, $next_door->direction)<br /> ";
				 	}
				}
			}
		}
		$this->map = $cells;
	}

	// On obtient une position x y dans laquelle on peut poser un truc
	// On peut préciser qu'on la veut loin d'une autre
	public function getEmptyCell($far_from__x_y_distance = null) {
		$tmp = $this->map;
		RPGRandomTools::shuffleAssoc($tmp);
		foreach($tmp as $k => $v) {
			RPGRandomTools::shuffleAssoc($v);
			foreach($v as $k2 => $v2) {
				if ($v2 > 0) {
					if ($far_from__x_y_distance) {
						if (abs($k - $far_from__x_y_distance[1]) < $far_from__x_y_distance[2]/2 || abs($k2 - $far_from__x_y_distance[0]) < $far_from__x_y_distance[2]/2) continue;
					}
					return array($k2, $k);
				}
			}
		}
	}

	public function addDoors($count) {
		$y_s = RPGRandomTools::shuffle(range(0, $this->size_y-1));
		$x_s = RPGRandomTools::shuffle(range(0, $this->size_x-1));
		while ($count && (list($kx, $x) = each($x_s))) {
			reset($y_s);
			while ($count && (list($ky, $y) = each($y_s))) {
				if ($x > 1 && $y > 1 && $x < $this->size_x-2 && $y < $this->size_y-2 && $this->map[$y][$x] == 0) {
					$can_open_door_vertical = $this->map[$y][$x+1] == 0 && $this->map[$y][$x-1] == 0 && $this->map[$y-1][$x] == 1 && $this->map[$y+1][$x] == 1;
					$can_open_door_vertical = $can_open_door_vertical && $this->map[$y][$x+2] == 0 && $this->map[$y][$x-2] == 0;
					$can_open_door_horizontal = $this->map[$y][$x+1] == 1 && $this->map[$y][$x-1] == 1 && $this->map[$y-1][$x] == 0 && $this->map[$y+1][$x] == 0;
					$can_open_door_horizontal = $can_open_door_horizontal && $this->map[$y-2][$x] == 0 && $this->map[$y+2][$x] == 0;
					if ($can_open_door_vertical || $can_open_door_horizontal) {
						$this->map[$y][$x] = $this->doors_value;
						$count--;
					}
				}
			}
		}
	}

}

class RPGDJN1Room {
	public $id;
	public $border_x1, $border_x2, $border_y1, $border_y2;
	public $doors_id;
}

class RPGDJN1Door {
	public $id;
	public $x, $y, $direction;
	public $prev_room_id, $next_room_id;
}

?>