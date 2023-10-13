<?php
include 'api.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Task Management</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="container">
    <h1>Task List</h1>
    <ul id="taskList">
        <?php foreach ($tasks as $task) : ?>
            <li>
                Title: <?php echo $task['title']; ?><br>
                Description: <?php echo $task['description']; ?><br>
                Due Date: <?php echo $task['due_date']; ?><br>
                Status: <?php echo $task['status']; ?><br>
                Created At: <?php echo $task['created_at']; ?><br>
                <form method="post" action="update_task.php">
                    <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                    <input type="submit" value="Update Task">
                </form>
                <form method="get" action="view_task.php">
                    <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                    <input type="submit" value="View Task">
                </form>
                <form method="post" action="api.php/tasks/<?php echo $task['id']; ?>">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" value="Delete Task">
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<form method="get" action="add_task.php">
    <input type="submit" value="Add New Task">
</form>
</body>
</html>