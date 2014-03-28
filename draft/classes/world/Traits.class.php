<?php

class RPGTraits {

}


class RPGTraitsBuilder {
	public static $ftraits = null;
	public static $ftraits_count = null;

	public static $mtraits = null;
	public static $mtraits_count = null;

	public function build($gender) {
		if (self::$ftraits === null) {
			$tmp = file(dirname(__FILE__) . '/' . 'traits.csv', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
			foreach($tmp as $t) {
				list (self::$mtraits[], self::$ftraits[]) = explode(';', $t);
			}
			self::$mtraits_count = count(self::$mtraits);
			self::$ftraits_count = count(self::$ftraits);
		}
		$traits = array();
		for($i=0, $count=mt_rand(1,3);$i<$count; $i++) {
			$tmp = $gender ? self::$mtraits[mt_rand(0, self::$mtraits_count-1)] : self::$ftraits[mt_rand(0, self::$ftraits_count-1)];
			if (in_array($tmp, $traits)) continue;
			$traits[] = $tmp;
		}
		return $traits;
	}
}
?>