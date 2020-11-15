#!/usr/bin/PHP
<?PHP
function ft_split($expr)
{
    $arr = (explode(" ", $expr));
    sort($arr);
    return $arr;
}
print_r(ft_split("Hello World AAA"));
?>