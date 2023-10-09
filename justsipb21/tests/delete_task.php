<?php
require_once 'TaskManager.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['task_id'])) {
        $taskId = $_POST['task_id'];

        $taskManager = new TaskManager();
        $success = $taskManager->deleteTaskById($taskId);

        if ($success) {
            // Redirect back to index.php with a success message
            header("Location: index.php?delete_success=1");
            exit(); // Terminate script execution after redirection
        } else {
            echo 'Error deleting task.';
        }

        $taskManager->closeConnection();
    } else {
        echo 'Task ID not provided.';
    }
} else {
    echo 'Invalid request method.';
}
?>