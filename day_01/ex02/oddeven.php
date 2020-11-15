#!/usr/bin/PHP
<?PHP
    $prog = fopen("php://stdin", "r");
    while ($prog && !feof($prog))
    {
        echo "Entre a input: ";
        $input = fgets($prog);   
        if($input)
        {
            $input = str_replace("\n", "", "$input");
            if (is_numeric($input)) 
            {
                if ($input % 2 == 0)
                    echo "The input $input is even\n";
                else
                    echo "The input $input is odd\n";
            } 
            else
                echo "'$input' is not a input\n";
        }
    }
        fclose($prog);
    echo "\n";
?>