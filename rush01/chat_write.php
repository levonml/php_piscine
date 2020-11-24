<html>
    <head>
        <script language="javascript">top.frames["read"].location = "chat_read.php";</script>
    </head>
    <body>
        <form action="chat_write.php" method="post">
            Message <input type="text" name="msg" value="<?php echo $_POST["msg"]; ?>" />
            <input type="submit" name="submit" value="OK" />
        </form>
    </body>
</html>

<?PHP
session_start();
if ($_POST["submit"] === "OK")
{
    $msg = array("username"=>$_SESSION["logged_user"], "time"=>time(), "msg"=>$_POST["msg"]);
    if (file_exists("private/chat"))
    {
        $fd = fopen("private/chat", "r+");
        if (flock($fd, LOCK_EX))
        {
            $chat = unserialize(file_get_contents("private/chat"));
            $chat[] = $msg;
            file_put_contents("private/chat", serialize($chat)."\n");
            flock($fd, LOCK_UN);
            fclose($fd);
        }
    }
    else
    {
        if (!file_exists("private"))
            mkdir("private");
        $chat = array($msg);
        file_put_contents("private/chat", serialize($chat)."\n");
    }
}
?>
