<?php

session_start();

// Connect to MySQL
$conn = mysqli_connect("localhost", "root", "", "todoapp");

if (!$conn) {

    $_SESSION['error'] = 'Connect failed: ' . mysqli_connect_error();

    header("Location: ../index.php");
    exit;
}


// Delete Task
if (isset($_GET['id'])) {

    $id = (int) $_GET['id'];

    // Check if task exists
    $sql = "SELECT * FROM tasks WHERE id = $id";

    $result = mysqli_query($conn, $sql);

    if (!$result) {

        $_SESSION['error'] = 'Query failed: ' . mysqli_error($conn);

    } else {

        $row = mysqli_fetch_row($result);

        if (!$row) {

            $_SESSION['error'] = "Data does not exist.";

        } else {

            // Delete task
            $sql = "DELETE FROM tasks WHERE id = $id";

            $res = mysqli_query($conn, $sql);

            if (!$res) {

                $_SESSION['error'] = 'Delete failed: ' . mysqli_error($conn);

            } elseif (mysqli_affected_rows($conn) == 1) {

                $_SESSION['success'] = "Task deleted successfully.";

            }
        }
    }
}


// Redirect to index
header("Location: ../index.php");
exit;