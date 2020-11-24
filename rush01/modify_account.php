
<h1>Hello, <?php echo $_SESSION["logged_user"]; ?>!</h1>
<h2>Change Your Password</h2>
<form action="index.php?page=modify" method="post">
    Password <input class = "login" type="password" name="old_password" value="" placeholder="Password" />
    <br />
    <br />
    New Password: <input class = "login" type="password" name="new_password" value="" placeholder="New Password" />
    <br />
    <br />
    <input class = "login" type="submit" name="submit_modify" value="Change Your Password" />
</form>
<br />
<form action="index.php?page=modify" method="post">
    <h2>Delete Your Account</h2>
    Password <input class = "login" type="password" name="password" value="" placeholder="Password" />
    <br />
    <br />
    <input class = "login" type="submit" name="submit_delete" value="Delete Your Account" />
</form>
<?php
$error = "<br /><br />ERROR\n";
if ($_POST["submit_modify"] === "Change Your Password")
{
    if ($_POST["new_password"] !== "")
    {
        $modify_account = array("username"=>$_SESSION["logged_user"], "password"=>hash("whirlpool", $_POST["old_password"]));
        $accounts = unserialize(file_get_contents("private/accounts"));
        foreach ($accounts as $key=>$account)
        {
            if ($account["username"] === $modify_account["username"] && $account["password"] === $modify_account["password"])
            {
                $accounts[$key]["password"] = hash("whirlpool", $_POST["new_password"]);
                file_put_contents("private/accounts", serialize($accounts)."\n");
                $_SESSION["logged_user"] = "";
                header("Location: index.php?page=login");
                break ;
            }
        }
    }
    else
        echo $error;
}
if ($_POST["submit_delete"] === "Delete Your Account")
{
    $delete_account = array("username"=>$_SESSION["logged_user"], "password"=>hash("whirlpool", $_POST["password"]));
    $accounts = unserialize(file_get_contents("private/accounts"));
    foreach ($accounts as $key=>$account)
    {
        if ($account["login"] === $delete_account["login"] && $account["password"] === $delete_account["password"])
        {
            unset($accounts[$key]);
            $accounts = array_values($accounts);
            file_put_contents("private/accounts", serialize($accounts)."\n");
            $_SESSION["logged_user"] = "";
            header("Location: index.php?page=login");
            break ;
        }
    }
    echo $error;
}

?>
