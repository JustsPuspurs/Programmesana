<?php
require_once 'TaskManager.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    $taskId = $_POST['task_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $dueDate = $_POST['due_date'];

    $taskManager = new TaskManager();
    $success = $taskManager->updateTask($taskId, $title, $description, $dueDate);

    if ($success) {
        // Redirect back to index.php with a success message
        header("Location: index.php?update_success=1");
        exit(); // Terminate script execution after redirection
    } else {
        echo 'Error updating task.';
    }

    $taskManager->closeConnection();
} elseif (isset($_GET['id'])) {
    // Display the form for updating the task
    $taskId = $_GET['id'];
    $taskManager = new TaskManager();
    $task = $taskManager->getTaskById($taskId);

    if ($task) {
        // Display the existing task information in the form
        echo '
        <form method="POST">
            <input type="hidden" name="task_id" value="' . $taskId . '">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="' . $task['title'] . '" required><br><br>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required>' . $task['description'] . '</textarea><br><br>
            <label for="due_date">Due Date:</label>
            <input type="date" id="due_date" name="due_date" value="' . $task['due_date'] . '" required><br><br>
            <input type="submit" value="Update Task">
        </form>';
        echo '<a href="index.php">Back to Task List</a>';
    } else {
        echo 'Task not found.';
    }

    $taskManager->closeConnection();
} else {
    echo 'Task ID not provided.';
}
?>