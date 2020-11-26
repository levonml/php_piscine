#!/usr/bin/PHP
<?PHP
function ft_split($expr)
{
    $arr = (explode(" ", $expr));
    sort($arr);
    return $arr;
}
?>