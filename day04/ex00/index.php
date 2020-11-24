<?php
session_start();
if($_GET["submit"] === "OK")
{
$_SESSION["login"] = $_GET["login"];
$_SESSION["passwd"] = $_GET["passwd"];

}   
?>
<!DOCTYPE html>
<html>
<body>
<form  name = "indeleft.php" method="GET">
     
    Username: <input method = "GET" type="teleftt" name = "login" value ="<?php echo $_SESSION['login'] ?>">
<br />
    Password: <input password = "submit" name = "passwd" value = "<?php echo $_SESSION['passwd'] ?>">

    <input type = "submit" name = "submit" value = "OK">
 </form>
</body>
</html>
