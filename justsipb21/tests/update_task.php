<!DOCTYPE html>
<html>
<head>
    <title>Update Task</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Update Task</h1>
    
    <?php
    $taskId = $_GET['id']; // Get the task ID from the query parameter

    // Fetch the task details based on the task ID and display them in a form
    // You can use PHP to fetch the task details from your database here

    // Replace the following example data with your actual task data
    $taskData = [
        'title' => 'Sample Task',
        'description' => 'This is a sample task.',
        'due_date' => '2023-10-15',
    ];
    ?>

    <form id="update-task-form">
        <input type="hidden" name="id" value="<?php echo $taskId; ?>">
        <label for="title">New Title:</label>
        <input type="text" id="title" name="title" value="<?php echo $taskData['title']; ?>"><br>

        <label for="description">New Description:</label>
        <textarea id="description" name="description"><?php echo $taskData['description']; ?></textarea><br>

        <label for="due_date">New Due Date:</label>
        <input type="date" id="due_date" name="due_date" value="<?php echo $taskData['due_date']; ?>"><br>

        <input type="submit" value="Update Task">
    </form>

    <a href="index.php">Back to Task List</a>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#update-task-form').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'PUT',
                    url: 'api.php',
                    data: $(this).serialize(),
                    success: function (response) {
                        alert('Task updated successfully.');
                    },
                    error: function (xhr, status, error) {
                        alert('Failed to update the task. Please try again.');
                    }
                });
            });
        });
    </script>
</body>
</html>
