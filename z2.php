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
            <lable>enter Title: </lable>
            <input type="text" name="t"><br>
            <lable>enter Author: </lable>
            <input type="text" name="a"><br>
            <label>enter Price: </label>
            <input type="number" name="p"><br>
            <label>enter Avaible Books: </label>
            <input type="number" name="c"><br>
            <input type="submit">
        </form>
        <br><br>
        <form>
            <input type="submit" value="TakeBook">
            <input type="text">
        </form>
        <br>
        <form>
            <input type="submit" value="ReturnBook">
            <input type="text">
        </form>
        
        
        
        <?php
        $servername = "localhost";
        $username = "root"; 
        $password = ""; 
        $dbname = "UniLibrary"; 
        
        $title = $_POST['t'];
        $author = $_POST['a'];
        $price = $_POST['p'];
        $number = $_POST['c'];

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function takeBook($conn,$id){
    $sql = "UPDATE books SET numberOf = numberOf-1 WHERE id = $id AND numberOf > 1";
    if ($conn->query($sql) === TRUE) {
        echo "Book taken<br>";
    } else {
        echo "Error taking Book: " . $conn->error;
    }
}
function returnBook($conn,$id){
    $sql = "UPDATE books SET numberOf = (numberOf+1) WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "Book returned<br>";
    } else {
        echo "Error returning Book: " . $conn->error;
    }
}
function dropTable($conn) {
    $sql = "DROP TABLE IF EXISTS books";
    if ($conn->query($sql) === TRUE) {
        echo "Table 'books' dropped successfully<br>";
    } else {
        echo "Error dropping table: " . $conn->error;
    }
}
function fetchProductsBelowTen($conn) {
    $sql = "SELECT * FROM books";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<br>";
        while($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"]. " - Title: " . $row["Title"]. " - Author: " . $row["Author"]. " - Price: " . $row["price"]. " -  Numbers: " . $row["numberOf"]. "<br>";
        }
    } else {
        echo "No books found<br>";
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

$sql_check_data = "SELECT COUNT(*) as count FROM books";
    $result_check_data = $conn->query($sql_check_data);
    $row_check_data = $result_check_data->fetch_assoc();

if ($row_check_data['count'] = 0){
$sql = "CREATE TABLE IF NOT EXISTS books (
    id INT(6) UNSIGNED AUTO_INCREMENT UNIQUE KEY,
    Title VARCHAR(20) NOT NULL,
    Author VARCHAR(20) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    numberOf Int(2) UNSIGNED
)";
}

if ($conn->query($sql) === TRUE) {
    echo "Table 'books' created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

$insert_sql= "INSERT INTO books (Title,Author,price,numberOf) VALUES
                    ('$title','$author',$price,$number)";
    if ($conn->query($insert_sql) === TRUE) {
        echo "Book inserted successfully<br>";
    } else {
        echo "Error inserting products: " . $conn->error;
    }
  
   
    $sql = "SELECT * FROM books";
    $result = $conn->query($sql);

    if ($result->num_rows >= 3){
        fetchProductsBelowTen($conn);
    }
    takeBook($conn,1);
    returnBook($conn,2);
    takeBook($conn,11);

    if ($result->num_rows >= 3){
        fetchProductsBelowTen($conn);
    }




        ?>
    </body>
</html>
