
<?php



// Connect to MySQL



$conn = mysqli_connect("localhost", "root", "");

if (!$conn) {

    die("Connection failed: " . mysqli_connect_error());
}

echo "MySQL connected.<br>";



// Create Database
$sql = "CREATE DATABASE IF NOT EXISTS todoapp";

if (mysqli_query($conn, $sql)) {
    echo "Database is ready.<br>";
} else {
    die("Database Error: " . mysqli_error($conn));
}


// Create Table
$sql = "CREATE TABLE IF NOT EXISTS tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";






