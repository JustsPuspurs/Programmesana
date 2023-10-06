<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <?php
        include "db.php";
        include "class.php";
        include "create_task.php"
    ?>
</head>
<body class = "body2">
    <div class = "vidus">
    <h2>Create New Task</h2>
    <form method="POST" action="create_task.php">
        <label>Title:</label>
        <input type="text" name="title" required><br>
        <label>Description:</label>
        <textarea name="description" required></textarea><br>
        <label>Due Date:</label>
        <input type="date" name="due_date" required><br>
        <label>Status:</label>
        <input type="text" name="status" required><br>
        <input type="submit" value="Create Task">
    </form>
    </div>
</body>
</html>