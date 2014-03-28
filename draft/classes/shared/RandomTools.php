<?php

class RPGRandomTools {

	public static function sRand() {
		list($usec, $sec) = explode(' ', microtime());
		$seed = (float) $sec + ((float) $usec * 100000);
		mt_srand($seed);
	}

	public static function shuffle($items) {
	    for ($i = count($items) - 1; $i > 0; $i--){
	        $j = mt_rand(0, $i);
	        $tmp = $items[$i];
	        $items[$i] = $items[$j];
	        $items[$j] = $tmp;
	    }
	    return $items;
	}

	public static function shuffleAssoc(&$array) {
		$keys = array_keys($array);
		shuffle($keys);
		foreach($keys as $key) {
			$new[$key] = $array[$key];
		}
		$array = $new;
		return true;
	}


	public static function probability($chance, $out_of = 100) {
	    $random = mt_rand(1, $out_of);
	    return $random <= $chance;
	}

	public function getOdd($min, $max){
		$randomValue = mt_rand($min, $max);
		return $randomValue | 1;
	}

	public function getEven($min, $max) {
		$randomValue = mt_rand($min, $max);
		return $randomValue & ~1;
	}
}

?>