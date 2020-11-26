<?php
    require_once('users.php');
    require_once('orders.php');
    require_once('products.php');

    // Function to get the correct quantity to show under the products in
    // in product view. Takes into account the amount in basket
    function get_current_quantity($name, $quantity)
    {
        foreach ($_SESSION['basket'] as $entry)
        {
            if ($name === $entry['name'])
                return $quantity - $entry['quantity'];
        }
        return $quantity;
    }
    // Check if product with name already exists in basket
    function basket_has_entry($name)
    {
        $basket = $_SESSION['basket'];
        for ($i = 0; $i < count($basket); $i++)
        {
            if ($basket[$i]['name'] === $name)
                return $i;
        }
        return FALSE;
    }
    // If user wants to remove 1 amount of item form bakset
    if ($_GET['remove'] != "")
    {
        for ($i = 0; $i < count($_SESSION['basket']); $i++)
        {
            if ($_GET['remove'] === $_SESSION['basket'][$i]['name'])
            {
                if ($_SESSION['basket'][$i]['quantity'] == 1)
                {
                    array_splice($_SESSION['basket'], $i, 1);
                    if (count($_SESSION['basket']) === 0)
                        $_SESSION['view'] = "product";
                }
                else
                {
                    $_SESSION['basket'][$i]['quantity'] -= 1;
                    $_SESSION['basket'][$i]['sum'] -= $_SESSION['basket'][$i]['price'];
                }
                break;
            }
        }
    }
    // Logs user out if form posted with submit value === log_out
    if ($_POST['submit'] === "log_out")
        $_SESSION['user'] = "";
    // username exists, passoword exists and submit is OK from login form,
    // logs user in if user is valid which check against database.
    if ($_POST['username'] != "" && $_POST['password'] != "" && $_POST['submit'] === "OK")
    {
        $hash = hash('whirlpool', $_POST['password']);
        if (user_is_valid($_POST['username'], $hash))
            $_SESSION['user'] = $_POST['username'];
        else
            $_SESSION['error'] = TRUE;
        // this $_SESSION['error'] = TRUE; is taken into account in the login form for error message
    }
    // If order button is pressed so the order value in GET is 1 and user is logged in
    // and basket is not empty
    if ($_GET['order'] === "1" && $_SESSION['user'] != "" && $_SESSION['basket'] != "")
    {
        $ret = add_order_for_user($_SESSION['user'], $_SESSION['basket']);
        if ($ret === 1)
        {
            // Order was a success!
            unset($_SESSION['basket']);
            unset($_SESSION['view']);
        }
        else
            echo "Order failed --> $ret";
    }
    // Category was pressed on the sidebar
    if ($_GET['category'])
    {
        $_SESSION['category'] = $_GET['category'];
        $_SESSION['view'] = "product";
    }
    // view parameter exist in url then possible to change product and basket view
    // if basket is empty user must be in product view
    if ($_GET['view'] != "" && $_SESSION['basket'] != "")
        $_SESSION['view'] = $_GET['view'];
    else if ($_SESSION['basket'] == "")
        $_SESSION['view'] = "product";
    // name/price exists it means that an item has been added to basket
    if ($_POST['name/price'] != "")
    {
        $exp = explode("/", $_POST['name/price']);
        if (($ret = basket_has_entry($exp[0])) === FALSE)
        {
            $_SESSION['basket'][] =
                array("name" => $exp[0], "price" => $exp[1], "quantity" => $_POST['amount'], "sum" => $exp[1] * $_POST['amount']);
        }
        else
        {
            $_SESSION['basket'][$ret]['quantity'] += $_POST['amount'];
            $_SESSION['basket'][$ret]['sum'] = $exp[1] * $_SESSION['basket'][$ret]['quantity'];
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <META CHARSET="UTF-8">
        <title>MY SHOP</title>
        <link href = "rush.css" type = "text/css" rel = "stylesheet">
    </head>
    <body>
        <nav id = "topBar" >
            <div id = "top-container">
                <div id = logo>
                    <span class = "light">L</span>
                    <span class = "dark">O</span>
                    <span class = "light">G</span>
                    <span class = "dark">O</span>
                </div>
            </div> <!--logoMenu-->
        </nav> <!--topBar -->
        <div id = "container">
            <h1 class="h1"><?php if ($_SESSION['view'] === "product") echo "Products"; else echo "Basket"; ?> </h1>
            <?php
                // Button to go back to products in basket view
                if ($_SESSION['view'] === 'basket')
                    echo "<a href='?view=product' id='basket-btn' style='float: left;'>To Products</a>";
            ?>
            <div class="product-list">
                <?php
                    if ($_SESSION['view'] === 'basket')
                    {
                        // Basket view items generation
                        foreach ($_SESSION['basket'] as $item)
                        {
                            $name = $item['name'];
                            $price = $item['price'];
                            $quantity = $item['quantity'];
                            $sum = $item['sum'];
                            echo "<div class='vert-flex basket-item'>
                                <p class='basket-title'>$name</p>
                                <p class='basket-price'>Price: $price €</p>
                                <p class='basket-price'>Amount: $quantity</p>
                                <p class='basket-sum'>Total: $sum €</p>
                                <button class='basket-remove'>
                                    <a href='?remove=$name'>Remove 1</a>
                                </button>
                            </div>";
                        }
                    }
                    else
                    {
                        // Product view items generation
                        if ($_SESSION['category'] === "all" || $_SESSION['category'] == "")
                            $data = get_all_existing_products();
                        else
                            $data = get_products_by_category($_SESSION['category']);
                        $printed = 0;
                        foreach ($data as $item)
                        {
                            $name = $item['name'];
                            $price = $item['price'];
                            $quantity = get_current_quantity($name, $item['quantity']);
                            if ($quantity <= 0)
                                continue ;
                            $printed++;
                            echo "
                            <div class='product'>
                                <p id='design'>$name - $price €</p>
                                <div class='ml-1'>
                                    <p class='count'>$quantity in storage</p>
                                    <div class='amount'>
                                        <form method='POST' action='index.php' name='index.php'>
                                            <select class='select' name='amount'>";
                            for ($i = 1; $i <= $quantity; $i++)
                                echo "<option value='$i'>$i</option>";
                            echo "
                                            </select>
                                            <button type='submit' name='name/price' value='$name/$price'>Add to basket</button>
                                        </form>
                                    </div>
                                </div>
                            </div>";
                        }
                        if ($printed === 0)
                            echo "<div class='vert-flex'><p id='empty'>Out of products...</p>
                            <p id='empty-subtitle'>Products are sold out or in the basket</p></div>";
                    }
                ?>
            </div>
            <?php
                // User needs to be logged in to be able to purchase products!
                if ($_SESSION['view'] === 'basket' && $_SESSION['user'] != "")
                {
                    echo "<div class='purchase'>
                        <button class='order'><a href='?order=1'>Place order</a></button>
                    </div>";
                }
                else if ($_SESSION['view'] === 'basket')
                    echo "<div class='purchase'>
                        <p style='font-size: 20px; color: gray;'>Log in to place an order</p>
                    </div>";
            ?>
            <div> <!--postList-->
                <div id = "right-panel">
                    <div id = "category" class = "right-panel">
                        <?php
                            // Log out form in user logged in, else log in form
                            if ($_SESSION['user'] != "")
                                echo "<form method='POST' action='rush.php' name='rush.php'>
                                    <button id='login' type='submit' name='submit' value='log_out'>Log Out</button>
                                </form>";
                            else
                            {
                                echo "<form method='POST' action='rush.php' name='rush.php'>
                                    <input class='login' type='text' name='username' placeholder='Username' required>
                                    <input class='login' type='password' name='password' placeholder='Password' required><br />";
                                // If error is given then its login error...
                                if ($_SESSION['error'] === TRUE)
                                {
                                    $_SESSION['error'] = FALSE;
                                    echo "<p style='color:red;'>Wrong Credentials...</p>";
                                }
                                echo "<button id='login' type='submit' name='submit' value='OK'>Log In</button>
                                </form>";
                            }
                        ?>
                    </div>
                    <div class = "right-panel clearfix">
                        <h3 class="h3">Product Categories</h3>
                        <ul class ="clearfix">
                            <?php
                                // Category names and selected category is highlighted
                                echo '<li><a ';
                                if ($_SESSION['view'] === "product" &&
                                ($_SESSION['category'] === "all" || $_SESSION['category'] == ""))
                                    echo 'class="selected" ';
                                echo 'href="?category=all">All</a></li>';
                                $cats = get_all_category_names();
                                foreach ($cats as $cat)
                                {
                                    echo '<li><a ';
                                    if ($_SESSION['category'] === $cat && $_SESSION['view'] === "product")
                                        echo 'class="selected" ';
                                    echo 'href="?category='.$cat.'">'.$cat.'</a></li>';
                                }
                            ?>
                        </ul>
                    </div>
                    <div class = "right-panel clearfix">
                        <h3 class="h3">
                            Basket
                            <span style="float: right;">
                                <?php
                                    // Button to go to basket when in product view
                                    if ($_SESSION['view'] === "product" && $_SESSION['basket'] != "" && !empty($_SESSION['basket']))
                                        echo "<a href='?view=basket' id='basket-btn'>To Basket</a>"
                                ?>
                            </span>
                        </h3>
                        <?php
                            $count = 0;
                            $price = 0.00;
                            // TO show data about the basket
                            if ($_SESSION['basket'] != "" && !empty($_SESSION['basket']))
                            {
                                foreach ($_SESSION['basket'] as $entry)
                                {
                                    $count += $entry['quantity'];
                                    $price += $entry['sum'];
                                }
                            }
                            echo "<p class='basket-p' style='margin-bottom: 10px;'>Number of items in basket: <span>$count</span></p>
                                  <p class='basket-p'>Price of the basket: <span>$price €</span></p>";
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <footer>My Shop &copy; 2020</footer>
    </body>
</html>
