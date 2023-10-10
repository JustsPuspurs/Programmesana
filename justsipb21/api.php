<?php
header('Content-Type: application/json');

$host = 'localhost';
$dbname = 'task_managment';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        // Get a specific item by ID
        $id = $_GET['id'];
        $stmt = $conn->prepare('SELECT * FROM tasks WHERE id = ?');
        $stmt->execute([$id]);
        $task = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($task) {
            echo json_encode($task);
        } else {
            http_response_code(404); // Not Found
            echo json_encode(['message' => 'Task not found']);
        }
    } else {
        // Get all items
        $stmt = $conn->query('SELECT * FROM tasks');
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($tasks);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Create a new item
    $data = json_decode(file_get_contents('php://input'), true);
    $title = $data['title'];
    $description = $data['description'];
    $due_date = $data['due_date'];

    $stmt = $conn->prepare('INSERT INTO tasks (title, description, due_date) VALUES (?, ?, ?)');
    $stmt->execute([$title, $description, $due_date]);
    echo json_encode(['message' => 'Task created']);
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Update an existing item
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id']; // Assuming the client sends the ID of the task to be updated.
    $title = $data['title'];
    $description = $data['description'];
    $due_date = $data['due_date'];

    $stmt = $conn->prepare('UPDATE tasks SET title = ?, description = ?, due_date = ? WHERE id = ?');
    $stmt->execute([$title, $description, $due_date, $id]);
    echo json_encode(['message' => 'Task updated']);
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Delete an item by ID
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id']; // Assuming the client sends the ID of the task to be deleted.

    $stmt = $conn->prepare('DELETE FROM tasks WHERE id = ?');
    $stmt->execute([$id]);
    $rowCount = $stmt->rowCount();
    if ($rowCount > 0) {
        echo json_encode(['message' => 'Task deleted']);
    } else {
        http_response_code(404); // Not Found
        echo json_encode(['message' => 'Task not found']);
    }
}
?>
