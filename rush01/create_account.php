<h1>Create an Account</h1>
<form action="index.php?page=create" method="post">
    Username <input class = "login" type="text" name="username" value="<?php echo $_POST["username"]; ?>" placeholder="Username" />
    <br />
    <br />
    Password <input class = "login" type="password" name="password" value="" placeholder="Password" />
    <br />
    <br />
    <input class = "login" type="submit" name="submit" value="Create an Account" />
</form>
<?php
$error = "<br /><br />ERROR\n";
if ($_POST["submit"] === "Create an Account")
{
    if ($_POST["username"] !== "" && $_POST["password"] !== "")
    {
        $new_account = array("username"=>$_POST["username"], "password"=>hash("whirlpool", $_POST["password"]));
        if (file_exists("private/accounts"))
        {
            $accounts = unserialize(file_get_contents("private/accounts"));
            $free_username = TRUE;
            foreach ($accounts as $account)
            {
                if ($account["username"] === $new_account["username"])
                {
                    $free_username = FALSE;
                    break ;
                }
            }
            if ($free_username)
            {
                $accounts[] = $new_account;
                file_put_contents("private/accounts", serialize($accounts)."\n");
                header("Location: index.php?page=login");
            }
            else
                echo $error;
        }
        else
        {
            if (!file_exists("private"))
                mkdir("private");
            $accounts = array($new_account);
            file_put_contents("private/accounts", serialize($accounts)."\n");
            header("Location: index.php?page=login");
        }
    }
    else
        echo $error;
}
?>
