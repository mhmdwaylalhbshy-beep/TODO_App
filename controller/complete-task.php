<?php

session_start();



// Connect to MySQL


$conn = mysqli_connect("localhost", "root", "", "todoapp");

if (!$conn) {

    
    die("Connection failed: " . mysqli_connect_error());
}


// Complete / Undo Task
if (isset($_GET['id'])) {

    $id = (int) $_GET['id'];

    $sql = "UPDATE tasks
            SET is_completed = NOT is_completed
            WHERE id = $id";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Query Error: " . mysqli_error($conn));
    }

    header("Location: ../index.php");
    exit;
}
