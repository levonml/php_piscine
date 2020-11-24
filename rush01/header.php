<header>
    <div>
        <nav>
            <ul>
                <li><a href="index.php?page=home">Home</a></li>
                <?php
                    if (!isset($_SESSION["logged_user"]) || $_SESSION["logged_user"] === "")
                    {
                        echo "<li><a href=\"index.php?page=create\">Create an Account</a></li>\n";
                        echo "<li><a href=\"index.php?page=login\">Log In</a></li>\n";  
                    }
                    else
                    {
                        echo "<li><a href=\"index.php?page=chat\">Chat</a></li>\n";
                        echo "<li><a href=\"index.php?page=modify\">".$_SESSION["logged_user"]."</a></li>\n";
                        echo "<li><a href=\"index.php?page=logout\">Log Out</a></li>\n";
                        echo "<li><a href=\"index.php?page=start\">Start The Game</a></li>\n";
                    }
                ?>
            </ul>
        </nav>
    </div>
</header>
