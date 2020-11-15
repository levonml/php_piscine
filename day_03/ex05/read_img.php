<?PHP

$image = "../img/42.png";
header("Content-Type: image/png");
readfile($image);

?>