<?php
session_start();
// Connect to MySQL
$conn = mysqli_connect("localhost", "root", "", "todoapp"); 

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "MySQL connected.<br>";


    

// Add Task
    if (isset($_POST['add_task']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = trim(htmlspecialchars(htmlentities($_POST['title' ])));
        
        $sql="INSERT INTO tasks (title) VALUES ('$title')";
$res=(mysqli_query($conn, $sql));// go to database
if (mysqli_affected_rows($conn)==1) // 1 or 0 or -1
    $_SESSION['success'] ='Task added successfully.'; // 1 or 0 or -1 
header("Location: ../index.php");
    }