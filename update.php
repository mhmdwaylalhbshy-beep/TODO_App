<?php

session_start();

$conn = mysqli_connect("localhost", "root", "", "todoapp");

if (!$conn) {
    $_SESSION['error'] = "Connection failed: " . mysqli_connect_error();
        header("Location: index.php");
          exit;
}

if (!isset($_GET['id'])) {
      mysqli_close($conn);
          header("Location: index.php");
             exit;
}

$id = (int) $_GET['id'];

     $sql = "SELECT * FROM tasks WHERE id = ?";
       $stmt = mysqli_prepare($conn, $sql);
          mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
       $result = mysqli_stmt_get_result($stmt);

if (!$result) {
    $_SESSION['error'] = "Query failed: " . mysqli_error($conn);
              mysqli_stmt_close($stmt);
    mysqli_close($conn);
                        header("Location: index.php");
    exit;
}

      $task = mysqli_fetch_assoc($result);

if (!$task) {
    $_SESSION['error'] = "Data does not exist.";
            mysqli_stmt_close($stmt);
    mysqli_c lose($conn);
           header("Location: index.php");
    exit;
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Update Task</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="update-page">

        <div class="update-card">

            <h1>Update Task</h1>

            <form
                action="controller/update-task.php"
                method="POST"
                class="update-form"
            >

                <input
                    type="hidden"
                    name="id"
                    value="<?= $task['id'] ?>"
                >

                <label for="task-title" class="update-label">
                    Task title
                </label>

                <input
                    id="task-title"
                    class="update-input"
                    type="text"
                    name="title"
                    value="<?= htmlspecialchars($task['title']) ?>"
                    placeholder="Enter task title"
                >

                <div class="update-actions">

                    <button type="submit" class="btn-primary">
                        Update
                    </button>

                    <a href="index.php" class="btn-secondary">
                        Back
                    </a>

                </div>

            </form>

        </div>

    </div>

</body>

</html>
