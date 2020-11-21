<?php

class Jaime {

    public function sleepWith($arg){
        if (get_class($arg) == 'Tyrion')
            echo "Not even if I'm drunk !".PHP_EOL;
        if (get_class($arg) == 'Sansa')
            echo "Let's do this.".PHP_EOL;
        if (get_class($arg) == 'Cersei')
            echo "With pleasure, but only in a tower in Winterfell, then.".PHP_EOL;
    }
}
?>