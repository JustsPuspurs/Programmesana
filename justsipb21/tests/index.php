<!DOCTYPE html>
<html>
<head>
    <title>Task Management</title>
</head>
<body>
    <h1>Task List</h1>
    <?php
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
            </tr>';
        foreach ($tasks as $task) {
            echo '<tr>
                <td>' . $task['id'] . '</td>
                <td>' . $task['title'] . '</td>
                <td>' . $task['description'] . '</td>
                <td>' . $task['due_date'] . '</td>
                <td>' . $task['status'] . '</td>
                <td>' . $task['created_at'] . '</td>
                <td><a href="get_task.php?id=' . $task['id'] . '">Get Task</a></td>
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
