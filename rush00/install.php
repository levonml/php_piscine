<?php
    function init_database()
    {
        // Connect to MySQL
        $link = get_link(FALSE);
        // Create Database for shop
        $query = "CREATE DATABASE shop";
        mysqli_query($link, $query);
        // Select database shop
        mysqli_select_db($link, 'shop');
        // Create User table
        $query = "CREATE TABLE User (
            user_id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            hash_pw VARCHAR(129) NOT NULL,
            is_admin BOOL DEFAULT 0,
            CONSTRAINT UC_User UNIQUE (name)
        )";
        mysqli_query($link, $query);
        // Create Category table
        $query = "CREATE TABLE Category (
            category_id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL
        )";
        mysqli_query($link, $query);
        // Create Product table
        $query = "CREATE TABLE Product (
            product_id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            price INT NOT NULL,
            quantity INT NOT NULL
        )";
        mysqli_query($link, $query);
        // Create ProductCategories table
        $query = "CREATE TABLE ProductCategories (
            prod_id INT NOT NULL,
            cat_id INT NOT NULL,
            CONSTRAINT PK_ProdCat PRIMARY KEY (prod_id, cat_id),
            FOREIGN KEY (prod_id) REFERENCES Product(product_id),
            FOREIGN KEY (cat_id) REFERENCES Category(category_id)
        )";
        mysqli_query($link, $query);
        // Create Order table
        $query = "CREATE TABLE Orders (
            order_id INT AUTO_INCREMENT PRIMARY KEY,
            buyer_id INT NOT NULL,
            time DATETIME DEFAULT NOW(),
            products JSON NOT NULL,
            FOREIGN KEY (buyer_id) REFERENCES User(user_id)
        )";
        mysqli_query($link, $query);
        // Insert admin
        $query = "INSERT INTO User (name, hash_pw, is_admin)
            VALUES (
                'admin',
                '6a4e012bd9583858a5a6fa15f58bd86a25af266d3a4344f1ec2018b778f29ba83be86eb45e6dc204e11276f4a99eff4e2144fbe15e756c2c88e999649aae7d94',
                1
            )
        ";
        mysqli_query($link, $query);
        // Insert product categories
        $query = "INSERT INTO Category (name) VALUES ('Clothes'), ('Electronics')";
        mysqli_query($link, $query);
        // Insert products
        $query = "INSERT INTO Product (name, price, quantity)
        VALUES ('Watch', 99.99, 5),
            ('E-Cap', 10.50, 2),
            ('Smoothie Maker 2000', 499, 1),
            ('Pink Shirt', 9.89, 10)
        ";
        mysqli_query($link, $query);
        // Insert products
        $query = "INSERT INTO ProductCategories (prod_id, cat_id)
        VALUES (1, 1), (1, 2), (2, 1), (2, 2), (3, 2), (4, 1)
        ";
        mysqli_query($link, $query);
        // Add Order for admin
        $query = 'INSERT INTO Orders (buyer_id, products)
        VALUES (1, \'{"full_price": 204.99, "products": {"0": { "name": "Soap", "price": 99.99, "quantity": 2, "sum": 199.98 }, "1": { "name": "Hammer", "price": 5, "quantity": 1, "sum": 5}}}\')';
        mysqli_query($link, $query);
        // Close connection
        mysqli_close($link);
    }
?>
