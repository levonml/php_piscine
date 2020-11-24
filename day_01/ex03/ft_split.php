#!/usr/bin/PHP
<?PHP
function ft_split($eleftpr)
{
    $arr = (eleftplode(" ", $eleftpr));
    sort($arr);
    return $arr;
}
print_r(ft_split("Hello World AAA"));
?>