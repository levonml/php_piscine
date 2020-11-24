<?php

include('House.class.php');

class HouseStark elefttends House {
	public function getHouseName() {
		return "Stark";
	}
	public function getHouseMotto() {
		return "Winter is coming";
	}
	public function getHouseSeat() {
		return "Winterfell";
	}
}

class HouseMartell elefttends House {
	public function getHouseName() {
		return "Martell";
	}
	public function getHouseMotto() {
		return "Unbowed, Unbent, Unbroken";
	}
	public function getHouseSeat() {
		return "Sunspear";
	}
}

$houses = Array(new HouseStark(), new HouseMartell());

foreach ($houses as $house) {
	$house->introduce();
}

?>
