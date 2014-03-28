<?php
class RPGHuman {

	public $fname;
	public $lname;

	public $gender;

	public $age;

	public $traits;

	public function getGender() {
		if ($this->gender) {
			if ($this->age < 17) return 'garçon';
			else return 'homme';
		} else {
			if ($this->age < 17) return 'fille';
			else return 'femme';
		}
	}

	public function getFullName() {
		return $this->fname . ' ' . $this->lname;
	}

	public function getTraits() {
		return implode(', ', $this->traits);
	}

}

class RPGHumanBuilder {

	public static $ffnames = null;
	public static $ffnames_count = null;

	public static $mfnames = null;
	public static $mfnames_count = null;

	public static $lnames = null;
	public static $lnames_count = null;

	public function __construct() {}

	public function build() {
		mt_srand();
		if (self::$ffnames === null) {
			$this->_initNames();
		}
		// Nouvel humain
		$human = new RPGHuman();
		// Genre
		$human->gender = mt_rand(0,1);
		// Nom
		if ($human->gender == 0) $human->fname = self::$ffnames[mt_rand(0, self::$ffnames_count-1)];
		elseif ($human->gender == 1) $human->fname = self::$mfnames[mt_rand(0, self::$mfnames_count-1)];
		$human->lname = self::$lnames[mt_rand(0, self::$lnames_count-1)];
		// Age
		mt_srand();
		switch(mt_rand(0,8)) {
			case 0:
				$human->age = mt_rand(5,112);
				break;
			case 1:
			case 2:
				$human->age = mt_rand(15,70);
				break;
			default:
				$human->age = mt_rand(17,45);
				break;
		}
		// L'humain est créé, on le retourne
		return $human;
	}

	private function _initNames() {
		self::$ffnames = file(dirname(__FILE__) . '/assets/txt/' . 'ffname.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		self::$mfnames = file(dirname(__FILE__) . '/assets/txt/' . 'mfname.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		self::$lnames = file(dirname(__FILE__) . '/assets/txt/' . 'lname.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		self::$ffnames_count = count(self::$ffnames);
		self::$mfnames_count = count(self::$mfnames);
		self::$lnames_count = count(self::$lnames);
	}

	public function setLevels() {}
}
?>