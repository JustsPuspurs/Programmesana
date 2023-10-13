<!DOCTYPE html>
<html>
<head>
    <title>Add Task</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Add New Task</h1>
    <form action="api.php" method="POST">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea><br>

        <label for="due_date">Due Date:</label>
        <input type="date" id="due_date" name="due_date" required><br>

        <input type="submit" value="Add Task">
    </form>

    <a href="index.php">Back to Task List</a>
</body>
</html>
