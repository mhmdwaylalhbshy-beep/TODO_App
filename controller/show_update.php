<?php
session_start();
// Connect to MySQL
$conn = mysqli_connect("localhost", "root", "", "todoapp"); 

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();
// Show update form
if (isset($_GET['id'])) {

    $id = (int) $_GET['id'];

    $sql = "SELECT * FROM tasks WHERE id = $id";

    $result = mysqli_query($conn, $sql);

    if (!$result) {

        $_SESSION['error'] = 'Query failed: ' . mysqli_error($conn);

        header("Location: ../index.php");
        exit;
    }

    $task = mysqli_fetch_assoc($result);

    if (!$task) {

        $_SESSION['error'] = "Data does not exist.";

        header("Location: ../index.php");
        exit;
    }
}