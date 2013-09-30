<?php

class RPGMaze {

	public $size_x = 21;
	public $size_y = 21;

	public $cells;

	public $proba_glitch = 0;

	public function __construct($size_x, $size_y) {
		$this->size_x = $size_x;
		$this->size_y = $size_y;
		$cells = array_fill(0, $this->size_y, array());
		for($i = 0, $c = count($cells); $i< $c; $i++) {
			$cells[$i] = array_fill(0, $this->size_x, 0);
		}
		$this->cells = $cells;
	}

	public function getMaze($x, $y) {
		$directions = RPGRandomTools::shuffle(array('U', 'D', 'L', 'R'));
		// $directions = array('D', 'U', 'L', 'R');
		foreach($directions as $direction) {
			switch($direction) {
				case 'U':
					if ($y - 2 <= 0) continue;
					if ($this->cells[$y-2][$x] == 0) {
						/* bidouille */
						if (RPGRandomTools::probability($this->proba_glitch) && $y-4 > 0 && $x+2 <= $this->size_x -1 && $this->cells[$y-4][$x] == 0 && $this->cells[$y-4][$x+2] == 0) {
							$this->cells[$y-2][$x] = $this->cells[$y-1][$x] = $this->cells[$y-3][$x] = $this->cells[$y-4][$x] = 1;
							$this->cells[$y-2][$x+1] = $this->cells[$y-1][$x+1] = $this->cells[$y-3][$x+1] = $this->cells[$y-4][$x+1] = 1;
							$this->cells[$y-2][$x+2] = $this->cells[$y-1][$x+2] = $this->cells[$y-3][$x+2] = $this->cells[$y-4][$x+2] = 1;
							$this->getMaze($x, $y-4);
						} else {
						/* end bidouille */
							$this->cells[$y-2][$x] = $this->cells[$y-1][$x] = 1;
							$this->getMaze($x, $y-2);
						}
					}
					break;
				case 'D':
					if ($y + 2 >= $this->size_y -1) continue;
					if ($this->cells[$y+2][$x] == 0) {
						$this->cells[$y+2][$x] =	$this->cells[$y+1][$x] = 1;
						$this->getMaze($x, $y+2);
					}
					break;
				case 'R':
					if ($x + 2 >= $this->size_x -1) continue;
					if ($this->cells[$y][$x+2] == 0) {
						/* bidouille */
						if (RPGRandomTools::probability($this->proba_glitch) && $y+2 < $this->size_y && $x+4 < $this->size_x && $this->cells[$y][$x+4] == 0 && $this->cells[$y+2][$x+4] == 0) {
							$this->cells[$y][$x+2] = $this->cells[$y][$x+1] = $this->cells[$y][$x+3] = $this->cells[$y][$x+4] = 1;
							$this->cells[$y+1][$x+2] = $this->cells[$y+1][$x+1] = $this->cells[$y+1][$x+3] = $this->cells[$y+1][$x+4] = 1;
							$this->cells[$y+2][$x+2] = $this->cells[$y+2][$x+1] = $this->cells[$y+2][$x+3] = $this->cells[$y+2][$x+4] = 1;
							$this->getMaze($x+4, $y);
						} else {
							/* end bidouille */
							$this->cells[$y][$x+2] =	$this->cells[$y][$x+1] = 1;
							$this->getMaze($x+2, $y);
						}
					}
					break;
				case 'L':
					if ($x - 2 <= 0) continue;
					if ($this->cells[$y][$x-2] == 0) {
						$this->cells[$y][$x-2] =	$this->cells[$y][$x-1] = 1;
						$this->getMaze($x-2, $y);
					}
					break;
			}
		}
	}

	public function getIterativeMaze($x, $y) {
		$stack = array(array($x, $y, null, null));
		while(!empty($stack)) {

			list($x, $y, $dir_x, $dir_y) = array_pop($stack);

			if ($dir_x || $dir_y) {
				if ( /* RPGRandomTools::probability(20) || */  $this->cells[$y+$dir_y*2][$x+$dir_x*2] == 0) {
					$this->cells[$y+$dir_y][$x+$dir_x] = $this->cells[$y+$dir_y*2][$x+$dir_x*2] = 1;
					$y += $dir_y*2;
					$x += $dir_x*2;
				}
			} else {
				$this->cells[$y][$x] = 1;
			}

			$directions = RPGRandomTools::shuffle(array('U', 'D', 'L', 'R'));
   			foreach($directions as $direction) {
				switch($direction) {
					case 'U':
						if ($y - 2 <= 0) continue;
						if ($this->cells[$y-2][$x] == 0) {
							array_push($stack, array($x, $y, null, -1));
						}
						break;
					case 'D':
						if ($y + 2 >= $this->size_y -1) continue;
						if ($this->cells[$y+2][$x] == 0) {
							array_push($stack, array($x, $y, null, 1));
						}
						break;
					case 'R':
						if ($x + 2 >= $this->size_x -1) continue;
						if ($this->cells[$y][$x+2] == 0) {
							array_push($stack, array($x, $y, 1, null));
						}
						break;
					case 'L':
						if ($x - 2 <= 0) continue;
						if ($this->cells[$y][$x-2] == 0) {
							array_push($stack, array($x, $y, -1, null));
						}
						break;
				}
			}

		}

	}

}


?>