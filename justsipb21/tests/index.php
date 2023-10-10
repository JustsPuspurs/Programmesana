<!DOCTYPE html>
<html>
<head>
    <title>Task Management</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="container">
    <h1>Task List</h1>
    <ul id="taskList"></ul>
</div>
    <button id="addTaskButton">Add New Task</button>

    <script>
        // Function to fetch and display tasks
        function fetchTasks() {
            fetch('api.php/tasks') // Replace 'api.php/tasks' with the actual URL of your API endpoint
                .then(response => response.json())
                .then(data => {
                    const taskList = document.getElementById('taskList');
                    taskList.innerHTML = ''; // Clear the existing list

                    data.forEach(task => {
                        const listItem = document.createElement('li');
                        listItem.textContent = `Title: ${task.title}, Description: ${task.description}, Due Date: ${task.due_date}, Status: ${task.status}, Created At: ${task.created_at}`;
    
                         // Add a button to view task details
                        const viewButton = document.createElement('button');
                        viewButton.textContent = 'View Task';
    
                         // Attach a click event listener to the view button
                        viewButton.addEventListener('click', function () {
                            // Redirect to the view_task.php page with the task ID as a query parameter
                            window.location.href = `view_task.php?id=${task.id}`;
                        });

                        // Add a button to update the task
                        const updateButton = document.createElement('button');
                        updateButton.textContent = 'Update Task';
    
                        // Attach a click event listener to the update button
                        updateButton.addEventListener('click', function () {
                            // Redirect to the update_task.php page with the task ID as a query parameter
                            window.location.href = `update_task.php?id=${task.id}`;
                        });

                        // Add a button to delete the task
                        const deleteButton = document.createElement('button');
                        deleteButton.textContent = 'Delete Task';
    
                        // Attach a click event listener to the delete button
                        deleteButton.addEventListener('click', function () {
                            // Call the deleteTaskById function with the task ID to delete the task
                            deleteTaskById(task.id);
                        });

                        // Append all buttons to the list item
                        listItem.appendChild(viewButton);
                        listItem.appendChild(updateButton);
                        listItem.appendChild(deleteButton);
    
                        taskList.appendChild(listItem);
                    });
                })
                .catch(error => console.error('Error fetching tasks:', error));
        }

        // Call the fetchTasks function when the page loads
        window.addEventListener('load', fetchTasks);

        // Redirect to the add_task.html page when the "Add New Task" button is clicked
        document.getElementById('addTaskButton').addEventListener('click', function () {
            window.location.href = 'add_task.php';
        });

        // Function to delete a task by its ID
        function deleteTaskById(taskId) {
            fetch(`api.php/tasks/${taskId}`, {
                method: 'DELETE'
            })
            .then(response => {
                if (response.status === 204) {
                    alert('Task deleted successfully!');
                    // After deleting, fetch and display the updated task list
                    fetchTasks();
                } else if (response.status === 404) {
                    alert('Task not found.');
                } else {
                    alert('Failed to delete task.');
                }
            })
            .catch(error => console.error('Error deleting task:', error));
        }
    </script>
</body>
</html>

