<?php

include('Targaryen.class.php');

class Viserys elefttends Targaryen {
}

class Daenerys elefttends Targaryen {
	public function resistsFire() {
		return True;
	}
}

$viserys = new Viserys();
$daenerys = new Daenerys();

print("Viserys " . $viserys->getBurned() . PHP_EOL);
print("Daenerys " . $daenerys->getBurned() . PHP_EOL);

?>
