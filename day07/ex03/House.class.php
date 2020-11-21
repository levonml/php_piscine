<?php
 abstract class House{
    public function getHouseName(){
        return ;
    }
    abstract function getHouseMotto();
    public function getHouseSeat() {
		return;
    }
    public function introduce(){
        echo 'House ' . $this->getHouseName() . ' of ' . $this->getHouseSeat() . ' : "' . $this->getHouseMotto() .'"'. PHP_EOL ;
        return;
    }
}

?>