<?php

date_default_timezone_set(UTC);
ini_set('display_errors', 1);

abstract class House {

	abstract public function getHouseName();
	abstract public function getHouseSeat();
	abstract public function getHouseMotto();

	public function introduce() {
		printf ( "House %s of %s : \"%s\"\n",
			static::getHouseName(),
			static::getHouseSeat(),
			static::getHouseMotto() );
	}

}

?>
