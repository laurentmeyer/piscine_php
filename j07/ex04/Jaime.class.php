<?php

class Jaime {

	public function sleepWith( $character ) {
		if ( is_a ( $character, "Tyrion" ) )
			print ( 'Not even if I\'m drunk !' . PHP_EOL );
		if ( is_a ( $character, "Stark" ) )
			print ( 'Let\'s do this.' . PHP_EOL );
		if ( is_a ( $character, "Lannister" ) )
			print ( 'With pleasure, but only in a tower in Winterfell, then.' . PHP_EOL );
	}

}

?>
