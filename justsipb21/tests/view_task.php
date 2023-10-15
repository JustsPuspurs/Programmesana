<!DOCTYPE html>
<html>
<head>
    <title>Task Details</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Task Details</h1>
    <div id="taskDetails">
        <?php
        // Include the TaskAPI class from api.php
        require_once 'api.php';

        // Create a TaskAPI instance
        $api = new TaskAPI();

        if (isset($_GET['id'])) {
            $taskId = $_GET['id']; // Correct variable name
            $task = $api->getTaskById($taskId); // Correct variable name
        
            if ($task) {
                echo '<table>';
                foreach ($task as $key => $value) {
                    if ($key !== 'id') {
                        echo '<tr>';
                        echo '<td>' . $key . '</td>';
                        echo '<td>' . $value . '</td>';
                        echo '</tr>';
                    }
                }
                echo '</table>';
            } else {
                echo 'Task not found.';
            }
        } else {
            echo 'Task ID not provided.';
        }
        
        ?>
    </div>

    <a href="index.php">Back to Task List</a>
</body>
</html>