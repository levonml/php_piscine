<?php
class Targaryen{
    public function resistsFire(){
        return False;
    }
    public function getBurned(){
        $rf = $this->resistsFire();
        if ($rf === False)
            return 'burns alive';
        else 
            return 'emerges naked but unharmed';
    
        }
    }

?>