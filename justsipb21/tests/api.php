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

    public function createTask($title, $description, $due_date)
    {
        $query = "INSERT INTO tasks (title, description, due_date) VALUES (:title, :description, :due_date)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':due_date', $due_date);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getTaskById($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM tasks WHERE id = ?');
        $stmt->execute([$id]);
        $task = $stmt->fetch(PDO::FETCH_ASSOC);
        return $task;
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
$tasks = array();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $task = $api->getTaskById($id);
        if ($task) {

        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Task not found']);
        }
    } else {
        $tasks = $api->getAllTasks();
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];

    if ($api->createTask($title, $description, $due_date)) {
        echo "Task created successfully!";
    } else {
        echo "Failed to create the task. Please try again.";
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    parse_str(file_get_contents("php://input"), $data);
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
?>
