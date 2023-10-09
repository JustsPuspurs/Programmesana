<?php
require_once 'TaskManager.php';

if (isset($_GET['id'])) {
    $taskId = $_GET['id'];
    $taskManager = new TaskManager();
    $task = $taskManager->getTaskById($taskId);

    if ($task) {
        // Display the retrieved task information
        echo '<h2>Task Details</h2>';
        echo '<p><strong>ID:</strong> ' . $task['id'] . '</p>';
        echo '<p><strong>Title:</strong> ' . $task['title'] . '</p>';
        echo '<p><strong>Description:</strong> ' . $task['description'] . '</p>';
        echo '<p><strong>Due Date:</strong> ' . $task['due_date'] . '</p>';
        echo '<p><strong>Status:</strong> ' . $task['status'] . '</p>';
        echo '<p><strong>Created At:</strong> ' . $task['created_at'] . '</p>';
    } else {
        echo 'Task not found.';
    }

    $taskManager->closeConnection();
} else {
    echo 'Task ID not provided.';
}
?>