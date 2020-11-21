<?php

class Tyrion {
    public function sleepWith($arg){
        if (get_class($arg) == 'Jaime')
        echo "Not even if I'm drunk !".PHP_EOL;
        if (get_class($arg) == 'Sansa')
        echo "Let's do this.".PHP_EOL;
        if (get_class($arg) == 'Cersei')
        echo "Not even if I'm drunk !".PHP_EOL;
        return;
    }
}

?>