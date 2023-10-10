<!DOCTYPE html>
<html>
<head>
    <title>Task Details</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Task Details</h1>
    <div id="taskDetails">
        <!-- Task details will be displayed here -->
    </div>

    <button id="backToIndexButton">Back to Task List</button>

    <script>
        // Function to fetch and display task details by ID
        function fetchTaskDetails() {
            const urlParams = new URLSearchParams(window.location.search);
            const taskId = urlParams.get('id');

            fetch('api.php?id=' + taskId) 
                .then(response => response.json())
                .then(task => {
                    const taskDetails = document.getElementById('taskDetails');
                    taskDetails.innerHTML = ''; // Clear the existing content

                    const table = document.createElement('table');
                    const tbody = document.createElement('tbody');

                    // Create rows for each field (except 'id') and its value
                    for (const key in task) {
                        if (task.hasOwnProperty(key) && key !== 'id') {
                            const row = document.createElement('tr');
                            const labelCell = document.createElement('td');
                            labelCell.textContent = key;
                            const valueCell = document.createElement('td');
                            valueCell.textContent = task[key];
                            row.appendChild(labelCell);
                            row.appendChild(valueCell);
                            tbody.appendChild(row);
                        }
                    }

                    table.appendChild(tbody);
                    taskDetails.appendChild(table);
                })
                .catch(error => console.error('Error fetching task details:', error));
        }

        // Call the fetchTaskDetails function when the page loads
        window.addEventListener('load', fetchTaskDetails);

        // JavaScript code for the Back to Task List button
        document.getElementById('backToIndexButton').addEventListener('click', function () {
            window.location.href = 'index.php';
        });
    </script>
</body>
</html>
