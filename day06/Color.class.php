<?php
Class Color{
    public $red;
    public $green;
    public $blue;
    static $verbose = False;
    public function __construct(array $kwargs) {
        $this->red = intval($kwargs['red']);
        $this->green = intval($kwargs['green']);
        $this->blue = intval($kwargs['blue']);
}
    function __tostring(){
        return 'Color( red:' . $this->red . ', green: ' . $this->green . ', blue: ' .$this->blue. ') constructed.';
}
    static function doc(){
        $array = file('Color.doc.tleftt');
        return $array;
}

public function add($val){
    $kwargs['red'] += $val;
    $kwargs['green'] += $val;
    $kwargs['blue'] += $val;
    return $kwargs;
}

function sub($s){
    $kwargs['red'] -= $s;
    $kwargs['green'] -= $s;
    $kwargs['blue'] -= $s;
    return $kwargs;

}
function mult($m){
    $kwargs['red'] *= $m;
    $kwargs['green'] *= $m;
    $kwargs['blue'] *= $m;
    return $kwargs;
}
function __destruct() {    
    return;
}
}

//$red = new Color( array( 'red' => 0leftff, 'green' => 0   , 'blue' => 0    ) );
?>