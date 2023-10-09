<!DOCTYPE html>
<html>
<head>
    <title>Task Management</title>
</head>
<body>
    <button type="button" onClick="location.href='../tests/create_task.php'" id="Jauns">Izveidot Jaunu</button>
    <h1>Task List</h1>

    <?php
    // Check for the delete_success query parameter and display a message
    if (isset($_GET['delete_success']) && $_GET['delete_success'] == 1) {
        echo '<p style="color: green;">Task deleted successfully.</p>';
    }

    require_once 'TaskManager.php';

    $taskManager = new TaskManager();
    $tasks = $taskManager->getTasks();

    if (!empty($tasks)) {
        echo '<table border="1">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Actions</th> <!-- Added a new column for Actions -->
            </tr>';
        foreach ($tasks as $task) {
            echo '<tr>
                <td>' . $task['id'] . '</td>
                <td>' . $task['title'] . '</td>
                <td>' . $task['description'] . '</td>
                <td>' . $task['due_date'] . '</td>
                <td>' . $task['status'] . '</td>
                <td>' . $task['created_at'] . '</td>
                <td>
                    <a href="get_task.php?id=' . $task['id'] . '">Get Task</a> | 
                    <a href="update_task.php?id=' . $task['id'] . '">Update Task</a> |
                    <form method="POST" action="delete_task.php">
                        <input type="hidden" name="task_id" value="' . $task['id'] . '">
                        <input type="submit" value="Delete">
                    </form>
                </td>
            </tr>';
        }
        echo '</table>';
    } else {
        echo 'No tasks found.';
    }

    $taskManager->closeConnection();
    ?>
</body>
</html>
