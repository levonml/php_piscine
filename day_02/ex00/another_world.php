#!/usr/bin/PHP
<?PHP
if ($argv[1])
{
$space = preg_replace("/[ \t]+/", " ", trim($argv[1]));
echo "$space\n";
}
?>