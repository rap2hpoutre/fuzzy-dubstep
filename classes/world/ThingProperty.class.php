<?php

abstract class RPGThingProperty {

	public $value;
	public $original_value;
	public $text;

	public function __construct($value, $text) {
		$this->value = $this->original_value = $value;
		$this->text = $text;
	}

	abstract public function sDec();
	abstract public function nDec();
	abstract public function bDec();

	abstract public function sInc();
	abstract public function nInc();
	abstract public function bInc();

	abstract public function getMin();
	abstract public function getMax();
}


class RPGThingMajorProperty extends RPGThingProperty {

	public function sDec(){
		$this->value--;
	}

	public function nDec() {
		$this->value-=2;
	}

	public function bDec() {
		$this->value-=3;
	}

	public function sInc() {
		$this->value+=1;
	}

	public function nInc() {
		$this->value+=2;
	}

	public function bInc() {
		$this->value+=3;
	}

	public function getMin() {
		return 0;
	}

	public function getMax() {
		return 16;
	}
}

class RPGThingMinorProperty extends RPGThingProperty {

	public function sDec(){
		$this->value-=2;
	}

	public function nDec() {
		$this->value-=5;
	}

	public function bDec() {
		$this->value-=10;
	}

	public function sInc() {
		$this->value+=2;
	}

	public function nInc() {
		$this->value+=5;
	}

	public function bInc() {
		$this->value+=10;
	}

	public function getMin() {
		return 0;
	}

	public function getMax() {
		return 128;
	}
}