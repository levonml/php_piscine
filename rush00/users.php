<?php
    require_once('database_utils.php');

    /**
     * Returns TRUE if user already exists, else FALSE.
     *
     * @username entered username
     * @hash_pw entered password which is hashed (whirlpool)
     */
    function user_is_valid($username, $hash_pw)
    {
        // Connect to MySQL
        $link = get_link(TRUE);

        $username = mysqli_real_escape_string($link, $username);
        $query = "
        SELECT * FROM User
        WHERE name = '$username' AND hash_pw = '$hash_pw'";
        $result = mysqli_query($link, $query);
        if ($row = mysqli_fetch_array($result))
            return TRUE;
        mysqli_free_result($result);
        mysqli_close($link);
        return FALSE;
    }

    /**
     * Returns 1 if user was registered.
     * Returns 0 if user with the username already exists
     * Returns -1 if something went wrong...
     *
     * @username entered username
     * @hash_pw entered password which is hashed (whirlpool)
     */
    function add_user($username, $hash_pw)
    {
        // Connect to MySQL
        $link = get_link(TRUE);

        $username = mysqli_real_escape_string($link, $username);
        $query = "
        INSERT INTO User (name, hash_pw)
        VALUES ('$username', '$hash_pw')";
        $result = mysqli_query($link, $query);
        if (strstr(mysqli_error($link), "Duplicate entry") !== FALSE)
            return 0;
        if ($result == 1)
            $ret = 1;
        else
            $ret = -1;
        mysqli_free_result($result);
        mysqli_close($link);
        return $ret;
    }

    /**
     * Returns TRUE if user password was changed.
     * Returns FALSE if something went wrong, for example username wasnt found, password
     * already is the new_hash_pw
     *
     * @username entered username
     * @new_hash_pw entered new password which is hashed (whirlpool)
     */
    function change_password($username, $new_hash_pw)
    {
        // Connect to MySQL
        $link = get_link(TRUE);

        $username = mysqli_real_escape_string($link, $username);
        $query = "
        UPDATE User
        SET hash_pw = '$new_hash_pw'
        WHERE name = '$username'";
        $result = mysqli_query($link, $query);
        if (mysqli_affected_rows($link) == 1)
            $ret = TRUE;
        else
            $ret = FALSE;
        mysqli_free_result($result);
        mysqli_close($link);
        return $ret;
    }
?>
