<?php

session_start();

$conn = mysqli_connect("localhost", "root", "", "todoapp");

if (!$conn) {
    $_SESSION['error'] = "Connection failed: " . mysqli_connect_error();
    header("Location: ../index.php");
    exit;
}

if (!isset($_POST['id']) || !isset($_POST['title'])) {
    $_SESSION['error'] = "Invalid update request.";
    mysqli_close($conn);
    header("Location: ../index.php");
    exit;
}

$id = (int) $_POST['id'];
$title = trim($_POST['title']);

if ($title === '') {
    $_SESSION['error'] = "Task title cannot be empty.";
    mysqli_close($conn);
    header("Location: ../index.php");
    exit;
}

$sql = "UPDATE tasks SET title = ? WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "si", $title, $id);

if (mysqli_stmt_execute($stmt)) {
    $_SESSION['success'] = "Task updated successfully.";
} else {
    $_SESSION['error'] = "Update failed: " . mysqli_error($conn);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

header("Location: ../index.php");
exit;