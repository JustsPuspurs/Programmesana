<!DOCTYPE html>
<html>
<head>
    <title>Add Task</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Add New Task</h1>
    <form id="addTaskForm">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea><br>

        <label for="due_date">Due Date:</label>
        <input type="date" id="due_date" name="due_date" required><br>

        <input type="submit" value="Add Task">
    </form>

    <button id="backToIndexButton">Back to Task List</button>

    <script>
        // Function to handle form submission
        document.getElementById('addTaskForm').addEventListener('submit', function (event) {
            event.preventDefault();
            
            const formData = new FormData(this);

            fetch('api.php/tasks', {
                method: 'POST',
                body: JSON.stringify(Object.fromEntries(formData)),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.message === 'Task created') {
                    alert('Task added successfully!');
                    // Redirect to the task list page (index.php)
                    window.location.href = 'index.php';
                } else {
                    alert('Failed to add task.');
                }
            })
            .catch(error => console.error('Error adding task:', error));
        });

        // JavaScript code for the Back to Task List button
        document.getElementById('backToIndexButton').addEventListener('click', function () {
            window.location.href = 'index.php';
        });
    </script>
</body>
</html>
