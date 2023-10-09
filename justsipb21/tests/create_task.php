<!DOCTYPE html>
<html>
<head>
    <title>Create New Task</title>
</head>
<body>
    <button type="button" onClick="location.href='../tests/index.php'" id="Jauns">Back To Task List</button> 
    <h1>Create New Task</h1>
    
    <?php
    require_once 'TaskManager.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Handle form submission
        $title = $_POST['title'];
        $description = $_POST['description'];
        $dueDate = $_POST['due_date'];

        // Validate and sanitize user inputs here if needed

        $taskManager = new TaskManager();
        $success = $taskManager->createTask($title, $description, $dueDate);

        if ($success) {
            echo 'Task created successfully.';
        } else {
            echo 'Error creating task.';
        }
        
        $taskManager->closeConnection();
    }
    ?>

    <form method="POST">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required><br><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea><br><br>

        <label for="due_date">Due Date:</label>
        <input type="date" id="due_date" name="due_date" required><br><br>

        <input type="submit" value="Create Task">
    </form>
</body>
</html>