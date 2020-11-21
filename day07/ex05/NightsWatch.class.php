<?php
class NightsWatch{
   
    public function recruit($arg){
        if(get_class($arg) == 'JonSnow')
            print("* looses his wolf on the enemy, and charges with courage *" . PHP_EOL);
        if(get_class($arg) == 'SamwellTarly')
            print("* flees, finds a girl, grows a spine, and defends her to the bitter end *" . PHP_EOL);
    }
    public function fight(){
        
    }

}
?>