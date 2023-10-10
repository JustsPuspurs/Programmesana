<?php
class TaskAPI
{
    private $db;

    public function __construct()
    {
        $host = 'localhost';
        $dbname = 'task_management';
        $username = 'root';
        $password = '';

        try {
            $this->db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            die();
        }
    }

    public function getAllTasks()
    {
        $stmt = $this->db->query('SELECT * FROM tasks');
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $tasks;
    }

    public function getTaskById($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM tasks WHERE id = ?');
        $stmt->execute([$id]);
        $task = $stmt->fetch(PDO::FETCH_ASSOC);
        return $task;
    }

    public function createTask($title, $description, $due_date)
    {
        $stmt = $this->db->prepare('INSERT INTO tasks (title, description, due_date) VALUES (?, ?, ?)');
        $stmt->execute([$title, $description, $due_date]);
        return $this->db->lastInsertId();
    }

    public function updateTask($id, $title, $description, $due_date)
    {
        $stmt = $this->db->prepare('UPDATE tasks SET title = ?, description = ?, due_date = ? WHERE id = ?');
        $stmt->execute([$title, $description, $due_date, $id]);
        return $stmt->rowCount();
    }
    public function deleteTaskById($id)
    {
        $stmt = $this->db->prepare('DELETE FROM tasks WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }

}



$api = new TaskAPI();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $task = $api->getTaskById($id);
        if ($task) {
            echo json_encode($task);
        } else {
            http_response_code(404); // Not Found
            echo json_encode(['message' => 'Task not found']);
        }
    } else {
        $tasks = $api->getAllTasks();
        echo json_encode($tasks);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $title = $data['title'];
    $description = $data['description'];
    $due_date = $data['due_date'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);
        $title = $data['title'];
        $description = $data['description'];
        $due_date = $data['due_date'];
    
        $taskId = $api->createTask($title, $description, $due_date);
        if ($taskId) {
            http_response_code(201); // Created
            echo json_encode(['message' => 'Task created', 'id' => $taskId]);
        } else {
            http_response_code(500); // Internal Server Error
            echo json_encode(['message' => 'Failed to create task']);
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id'];
    $title = $data['title'];
    $description = $data['description'];
    $due_date = $data['due_date'];

    if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'];
        $title = $data['title'];
        $description = $data['description'];
        $due_date = $data['due_date'];
    
        $rowCount = $api->updateTask($id, $title, $description, $due_date);
        if ($rowCount > 0) {
            echo json_encode(['message' => 'Task updated']);
        } else {
            http_response_code(404); // Not Found
            echo json_encode(['message' => 'Task not found']);
        }
    } elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
    
            $rowCount = $api->deleteTaskById($id);
            if ($rowCount > 0) {
                http_response_code(204); // No Content (Task deleted successfully)
            } else {
                http_response_code(404); // Not Found (Task not found)
                echo json_encode(['message' => 'Task not found']);
            }
        } else {
            http_response_code(400); // Bad Request (Missing ID)
            echo json_encode(['message' => 'Task ID is missing']);
        }
    }
}


?>

