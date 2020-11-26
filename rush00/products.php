<?php
    require_once('database_utils.php');

    /**
     * Returns an array of category names.
     * Returns empty array if no category names found.
     */
    function get_all_category_names()
    {
        // Connect to MySQL
        $link = get_link(TRUE);

        $categories = array();
        $query = "SELECT name FROM Category";
        $result = mysqli_query($link, $query);
        while ($row = mysqli_fetch_array($result))
            $categories[] = $row[0];
        mysqli_free_result($result);
        mysqli_close($link);
        return $categories;
    }

    /**
     * Returns array of product arrays, products by their category name.
     * Returns empty array if no products found for category.
     * @category category name
     */
    function get_products_by_category($category_name)
    {
        // Connect to MySQL
        $link = get_link(TRUE);

        $products = array();
        $category_name = mysqli_real_escape_string($link, $category_name);
        $query = "
        SELECT product_id, Product.name, price, quantity
        FROM Product
        INNER JOIN ProductCategories ON prod_id = product_id
        INNER JOIN Category ON cat_id = category_id AND Category.name = '$category_name'";
        $result = mysqli_query($link, $query);
        while ($row = mysqli_fetch_array($result))
            $products[] = array("id" => row[0], "name" => $row[1], "price" => $row[2], "quantity" => $row[3]);
        mysqli_free_result($result);
        mysqli_close($link);
        return $products;
    }

    /**
     * Returns array of product arrays, all the products which has quantity > 0
     */
    function get_all_existing_products()
    {
        // Connect to MySQL
        $link = get_link(TRUE);

        $query = "
        SELECT product_id, name, price, quantity
        FROM Product
        WHERE quantity > 0";
        $result = mysqli_query($link, $query);
        while ($row = mysqli_fetch_array($result))
            $products[] = array("id" => row[0], "name" => $row[1], "price" => $row[2], "quantity" => $row[3]);
        mysqli_free_result($result);
        mysqli_close($link);
        return $products;
    }
?>
