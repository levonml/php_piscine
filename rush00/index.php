<?php
    include 'install.php';
    require_once('database_utils.php');

    // Connect to database
    $link = get_link(FALSE);
    // Check if needed to create shop database
    mysqli_select_db($link, 'shop');
    if (mysqli_error($link) === "Unknown database 'shop'")
    {
        init_database();
        mysqli_select_db($link, 'shop');
    }
    mysqli_close($link);
    include 'rush.php';
?>
