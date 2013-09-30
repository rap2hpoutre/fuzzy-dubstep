<?php
class RPGDJCells {

	const STD_WALL = 0;
	const STD_VOID = 1;
	const CLOSED_DOOR = -1;

	function getAsJS($class_name) {
		$c = new ReflectionClass($class_name);
		return json_encode($c->getConstants());
	}
}

?>