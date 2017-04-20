<?php

class Tyrion {

	public function sleepWith( $character ) {
		if ( is_a ( $character, "Jaime" ) )
			print ( 'Not even if I\'m drunk !' . PHP_EOL );
		if ( is_a ( $character, "Stark" ) )
			print ( 'Let\'s do this.' . PHP_EOL );
		if ( is_a ( $character, "Lannister" ) )
			print ( 'Not even if I\'m drunk !' . PHP_EOL );
	}
}

?>
