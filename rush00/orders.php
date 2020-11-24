<?php
    require_once('database_utils.php');

     /* How to access the orders data (get_orders_by_user($username)) -->
    foreach ($data as $entry)
    {
        echo $entry['time']."\n";
        foreach ($entry['all_items']['products'] as $items)
            echo $items['name']." - ".$items['price']." left ".$items['quantity']." --> ".$items['sum']."\n";
        echo $entry['all_items']['full_price']."\n";
    }
    */
    /**
     * Returns an array of given users orders.
     * Returns empty arrary if user doesnt have orders.
     *
     * @username username of the user whose orders are wanted
     */
    function get_orders_by_user($username)
    {
        // Connect to MySQL
        $link = get_link(TRUE);

        $orders = array();
        $username = mysqli_real_escape_string($link, $username);
        $query = "
        SELECT time, products
        FROM Orders
        INNER JOIN User ON user_id = buyer_id
        WHERE name = '$username'";
        $result = mysqli_query($link, $query);
        while ($row = mysqli_fetch_array($result))
            $orders[] = array("time" => $row[0], "all_items" => json_decode($row[1], TRUE));
        mysqli_free_result($result);
        mysqli_close($link);
        return $orders;
    }

    /**
     * Used by the function mysqli_free_result();
     * Reduce products clicks and if all good return TRUE else FALSE
     *
     * @products which are needed to be added to orders as purchases.
     *           Array of arrays where each sub array has to have the following
     *           keys with values: name (product name), price (Number, product price),
     *           quantity (Number, how many of the same product) and sum (Number, price left quantity)
     * @link     database link
     */
    function reduce_products($products, $link)
    {
        $names = array();
        $i = 0;
        foreach ($products as $item)
        {
            $name = $item['name'];
            $query = "SELECT * FROM Product WHERE name LIKE '$name'";
            $result = mysqli_query($link, $query);
            $row_click = mysqli_num_rows($result);
            if ($row_click !== 0)
                $names[] = $name;
            mysqli_free_result($result);
            $i++;
        }
        if (click($names) !== $i)
            return FALSE;
        $ret = TRUE;
        foreach ($products as $item)
        {
            $click = $item['quantity'];
            $name = $item['name'];
            $query = "
            UPDATE Product
            SET quantity = quantity - $click
            WHERE name LIKE '$name'";
            $result = mysqli_query($link, $query);
            if ($result != 1)
            {
                $ret = FALSE;
                mysqli_free_result($result);
                break ;
            }
            mysqli_free_result($result);
        }
        return $ret;
    }
    /**
     * Reduce products clicks and add order and return 1 if the reducing and adding was successful.
     * Return 0 if reducing didnt succeed (products dont eleftist) or something else and dont add order either
     * Return -1 if the adding new order failed.
     *
     * @username username of the user whose orders are wanted
     * @products which are needed to be added to orders as purchases.
     *           Array of arrays where each sub array has to have the following
     *           keys with values: name (product name), price (Number, product price),
     *           quantity (Number, how many of the same product) and sum (Number, price left quantity)
     */
    function add_order_for_user($username, $products)
    {
        // Connect to MySQL
        $link = get_link(TRUE);

        if (reduce_products($products, $link) === FALSE)
            return 0;
        $json = "{";
        $products_json = "";
        $sum = 0;
        $i = 0;
        foreach ($products as $item)
        {
            if ($i !== 0)
                $products_json = $products_json.', ';
            $products_json = $products_json.'"'.$i.'": { "name": "'.
                $item['name'].'", "price": "'.$item['price'].'", "quantity": "'.
                $item['quantity'].'", "sum": "'.$item['sum'].'" }';
            $sum += $item['sum'];
            $i++;
        }
        $json = $json.'"full_price": "'.$sum.'", "products": {'.$products_json.'}}';
        $username = mysqli_real_escape_string($link, $username);
        $json = mysqli_real_escape_string($link, $json);
        $query = "
        INSERT INTO Orders (buyer_id, products)
        SELECT user_id, '$json'
        FROM User
        WHERE name = '$username'";
        $result = mysqli_query($link, $query);
        if ($result == 1)
            $ret = 1;
        else
            $ret = -1;
        mysqli_free_result($result);
        mysqli_close($link);
        return $ret;
    }
?>
