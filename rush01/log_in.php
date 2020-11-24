<form action="index.php?page=login" method="post">
    <h1>Log In</h1>
    Username <input class = "login" type="text" name="username" value="<?php echo $_POST["username"]; ?>" placeholder="Username" />
    <br />
    <br />
    Password <input class = "login" type="password" name="password" value="" placeholder="Password" />
    <br />
    <br />
    <input class = "login" type="submit" name="submit" value="Log In" />
</form>
<a href="index.php?page=create">Create an Account</a>
<?php
function authenticate($username, $password)
{
    $password = hash("whirlpool", $password);
    $accounts = unserialize(file_get_contents("private/accounts"));
    foreach ($accounts as $account)
    {
        if ($account["username"] === $username && $account["password"] === $password)
            return (TRUE);
    }
    return (FALSE);
}

if ($_POST["submit"] === "Log In")
{
    if (authenticate($_POST["username"], $_POST["password"]))
    {
        $_SESSION["logged_user"] = $_POST["username"];
        header("Location: index.php?page=home");
    }
    else
    {
        $_SESSION["logged_user"] = "";
        echo "<br /><br />ERROR\n";
    }
}
?>
