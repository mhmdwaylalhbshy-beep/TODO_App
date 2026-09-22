<?php

session_start();

// Connect to MySQL
$conn = mysqli_connect("localhost", "root", "", "todoapp");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get Tasks
$sql = "SELECT * FROM tasks ORDER BY id DESC";

$result = mysqli_query($conn, $sql);


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>To-Do List</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <h1>To-Do List</h1>


    <?php if (isset($_SESSION['success'])): ?>

        <p class="success">
            <?= htmlspecialchars($_SESSION['success']) ?>
        </p>

        <?php unset($_SESSION['success']); ?>

    <?php endif; ?>
    <?php if (isset($_SESSION['error'])): ?>

    <p class="error">
        <?= htmlspecialchars($_SESSION['error']) ?>
    </p>

    <?php unset($_SESSION['error']); ?>

<?php endif; ?>


    <form action="controller/store-task.php" method="POST" id="taskForm">

        <input
            type="text"
            name="title"
            id="taskInput"
            placeholder="Enter your task..."
            autocomplete="off"
        >

        <button type="submit" name="add_task">
            Add
        </button>

    </form>


    <div id="taskList">

        <?php if (mysqli_num_rows($result) === 0): ?>

            <p class="empty">
                No tasks yet.
            </p>

        <?php else: ?>

      <?php while ($task = mysqli_fetch_assoc($result)): ?>

    <div class="task">

        <span class="task-text <?= $task['is_completed'] ? 'completed' : '' ?>">
            <?= htmlspecialchars($task['title']) ?>
        </span>

        <div class="actions">

<a href="controller/complete-task.php?id=<?= $task['id'] ?>"
               class="complete">

                <?= $task['is_completed'] ? 'Undo' : 'Complete' ?>

            </a>

            <a href="controller/delete-task.php?id=<?= $task['id'] ?>"
               class="delete">

                Delete

            </a>
 

    <a href="update.php?id=<?= $task['id'] ?>"
       class="update">
        Update
    </a>



        </div>

    </div>

<?php endwhile; ?>

        <?php endif; ?>

    </div>

</div>


<script src="script.js"></script>

</body>

</html>