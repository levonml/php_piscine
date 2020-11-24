<h1>Log Out</h1>
<form action="index.php?page=logout" method="post">
    <input type="submit" name="submit" value="Log Out" />
</form>
<?php
if ($_POST["submit"] === "Log Out")
{
    $_SESSION["logged_user"] = "";
    header("Location: index.php?page=login");
}
?>
