<?php

class RPGRandomMiscText {

	public static function getDungeonName() {
		$places = array(
			'le donjon',
			'le château',
			'la antre',
			'la caverne',
			'le temple',
			'les ruines',
			'la forteresse',
			'les grottes',
			'le fort',
			'la grotte',
			'le palais',
			'le cabinet',
			'le bordel',
			'la taverne',
			'le labyrinthe',
			'le dédale',
			'les souterrains'
		);
		$name = ucwords($places[mt_rand(0, count($places) - 1)]) . ' de ' . ucfirst(RPGRandomFrenchText::getRandomName());
		$name = RPGRandomFrenchText::replaceHiatus($name);
		return $name;
	}
}

?>