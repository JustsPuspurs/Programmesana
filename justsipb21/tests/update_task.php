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
    ?>

    <form id="updateTaskForm">
        <label for="title">New Title:</label>
        <input type="text" id="title" name="title"><br>

        <label for="description">New Description:</label>
        <textarea id="description" name="description"></textarea><br>

        <label for="due_date">New Due Date:</label>
        <input type="date" id="due_date" name="due_date"><br>

        <input type="hidden" id="id" name="id" value="<?php echo $taskId; ?>">

        <input type="submit" value="Update Task">
    </form>

    <button id="backToIndexButton">Back to Task List</button>

    <script>
        // Function to handle form submission
        document.getElementById('updateTaskForm').addEventListener('submit', function (event) {
            event.preventDefault();

            const formData = new FormData(this);

            fetch('api.php/tasks', {
                method: 'PUT',
                body: JSON.stringify(Object.fromEntries(formData)),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.message === 'Task updated') {
                    alert('Task updated successfully!');
                    // Redirect to the task list page (index.php) after updating
                    window.location.href = 'index.php';
                } else {
                    alert('Failed to update task.');
                }
            })
            .catch(error => console.error('Error updating task:', error));
        });

        // JavaScript code for the Back to Task List button
        document.getElementById('backToIndexButton').addEventListener('click', function () {
            window.location.href = 'index.php';
        });
    </script>
</body>
</html>
