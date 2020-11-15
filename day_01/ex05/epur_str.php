#!/usr/bin/PHP
<?PHP
if ($argv[1])
echo preg_replace("/  */", " ", trim($argv[1])). "\n";
?>