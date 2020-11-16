<?php
    function get_link($connect_to_shop)
    {
        if ($connect_to_shop)
            $link = mysqli_connect('localhost', 'root', '110297', 'shop');
        else
            $link = mysqli_connect('localhost', 'root', '110297');
        if (mysqli_connect_error())
        {
            $logMessage = 'MySQL Error: ' . mysqli_connect_error();
            echo "ERROR, Could not connect to the database:\n$logMessage";
            exit ;
        }
        return $link;
    }
?>
