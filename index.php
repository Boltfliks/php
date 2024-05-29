<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method="post">
            <lable>enter Product: </lable>
            <input type="text" name="t"><br>
            <lable>enter desc: </lable>
            <input type="text" name="a"><br>
            <label>enter Price: </label>
            <input type="number" name="p"><br>
            <input type="submit">
        </form>
        <br><br>
        <?php
        $servername = "localhost";
        $username = "root"; 
        $password = ""; 
        $dbname = "Firma"; 
        
        $title = $_POST['t'];
        $author = $_POST['a'];
        $price = $_POST['p'];
        
        function updatePrices($conn) {
    $sql = "UPDATE Products SET Price = Price *1.2 WHERE Price < 10";
    if ($conn->query($sql) === TRUE) {
        echo "Prices updated successfully<br>";
    } else {
        echo "Error updating prices: " . $conn->error;
    }
}
        
        function fetchProducts($conn) {
        $sql = "SELECT * FROM Products";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        echo "<br>";
        while($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"]. " - ProductName: " . $row["ProductName"]. " - Description: " . $row["Description"]. " - Price: " . $row["Price"]. "<br>";
        }
    } else {
        echo "No products found<br>";
    }
}

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function dropTable($conn) {
    $sql = "DROP TABLE IF EXISTS Products";
    if ($conn->query($sql) === TRUE) {
        echo "Table 'Products' dropped successfully<br>";
    } else {
        echo "Error dropping table: " . $conn->error;
    }
}


$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error;
}
$conn->close();

$conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        echo "Connected to database successfully<br>";
    }

    // Create table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS Products (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        ProductName VARCHAR(20) NOT NULL,
        Description VARCHAR(20) NOT NULL,
        Price DECIMAL(10, 2) NOT NULL
    )";

    if ($conn->query($sql) === TRUE) {
        echo "Table 'Products' created successfully<br>";
    } else {
        echo "Error creating table: " . $conn->error;
    }


$insert_sql= "INSERT INTO Products (ProductName,Description,Price) VALUES
                    ('$title','$author',$price)";
    if ($conn->query($insert_sql) === TRUE) {
        echo "Product inserted successfully<br>";
    } else {
        echo "Error inserting products: " . $conn->error;
    }
  
   
    $sql = "SELECT * FROM Products";
    $result = $conn->query($sql);

    fetchProducts($conn);
    updatePrices($conn);
    echo "<br><br>";
    fetchProducts($conn)

        ?>
    </body>
</html>
