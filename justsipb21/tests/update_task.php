<!DOCTYPE html>
<html>
<head>
    <title>Update Task</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Update Task</h1>
    
    <?php
    $taskId = $_POST['id']; // Get the task ID from the query parameter

    // Fetch the task details based on the task ID and display them in a form
    // You can use PHP to fetch the task details from your database here
    ?>

    <form action="api.php" method="POST">
        <label for="title">New Title:</label>
        <input type="text" id="title" name="title"><br>

        <label for="description">New Description:</label>
        <textarea id="description" name="description"></textarea><br>

        <label for="due_date">New Due Date:</label>
        <input type="date" id="due_date" name="due_date"><br>

        <input type="hidden" name="id" value="<?php echo $taskId; ?>">

        <input type="submit" value="Update Task">
    </form>

    <a href="index.php">Back to Task List</a>
</body>
</html>
