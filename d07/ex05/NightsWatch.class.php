<?php

class NightsWatch {

	private $recruits = array();

	public function recruit( $character ) {
		$this->recruits[] = $character;
	}

	public function fight() {
		foreach ( $this->recruits as $character )
			if ( is_a( $character, "IFighter" ) )
				$character->fight();
	}

}

?>
