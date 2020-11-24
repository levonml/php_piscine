#!#/usr/bin/PHP
<?PHP


 $tab = file($argv[1]);
 foreach ($tab as $elem)
 {
     $str = implode($elem);
 }
echo "$str\n";
?>