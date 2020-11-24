<?php
session_start();

if (!isset($_GET["page"]) || $_GET["page"] === "home")
    $redirect = "home.php";
else if ($_GET["page"] === "chat")
    $redirect = "chat.php";
else if ($_GET["page"] === "create")
    $redirect = "create_account.php";
else if ($_GET["page"] === "login")
    $redirect = "log_in.php";
else if ($_GET["page"] === "modify")
    $redirect = "modify_account.php";
else if ($_GET["page"] === "logout")
    $redirect = "log_out.php";
else if ($_GET["page"] === "start")
    $redirect = "start.php";
?>

<html>
    <head>
        <title>Awesome Battleships Battles</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div> <?php include "header.php" ?> </div>
        <div class="main"> <?php include $redirect ?> </div>
        <div> <?php include "footer.php" ?> </div>
    </body>
</html>
