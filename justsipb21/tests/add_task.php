<!DOCTYPE html>
<html>
<head>
    <title>Add Task</title>
</head>
<body>
    <?php
    include('api.php');
    ?>
    <h1>Add Task</h1>
    <form method="POST">
        <label for="title">Task Title:</label>
        <input type="text" id="title" name="title" required>
        <br>
        <label for="description">Task Description:</label>
        <textarea id="description" name="description" required></textarea>
        <br>
        <label for="due_date">Due Date:</label>
        <input type="date" id="due_date" name="due_date" required>
        <br>
        <button type="submit">Create Task</button>
        <a href="index.php">Back to Task List</a>
    </form>
</body>
</html>
