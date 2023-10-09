<?php
require_once 'Database.php';

class TaskManager {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getTasks() {
        $sql = "SELECT * FROM tasks";
        $result = $this->db->query($sql);

        if ($result) {
            $tasks = [];
            while ($row = $result->fetch_assoc()) {
                $tasks[] = $row;
            }
            return $tasks;
        } else {
            return [];
        }
    }

    public function createTask($title, $description, $dueDate) {
        $conn = $this->db->getConnection();

        // Prepare and execute the SQL query to insert the task
        $stmt = $conn->prepare("INSERT INTO tasks (title, description, due_date) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $description, $dueDate);

        $result = $stmt->execute();

        $stmt->close();

        return $result;
    }

    public function deleteTaskById($taskId) {
        $conn = $this->db->getConnection();
        $taskId = $conn->real_escape_string($taskId);
    
        // Prepare and execute the SQL query to delete the task
        $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ?");
        $stmt->bind_param("s", $taskId);
    
        $result = $stmt->execute();
    
        $stmt->close();
    
        return $result;
    }
    
    public function updateTask($taskId, $title, $description, $dueDate) {
        $conn = $this->db->getConnection();
    
        // Prepare and execute the SQL query to update the task
        $stmt = $conn->prepare("UPDATE tasks SET title = ?, description = ?, due_date = ? WHERE id = ?");
        $stmt->bind_param("sssi", $title, $description, $dueDate, $taskId);
    
        $result = $stmt->execute();
    
        $stmt->close();
    
        return $result;
    }

    public function getTaskById($taskId) {
        $conn = $this->db->getConnection(); // Get the database connection object
        $taskId = $conn->real_escape_string($taskId); // Sanitize the input to prevent SQL injection
    
        $query = "SELECT * FROM tasks WHERE id = '$taskId'";
        $result = $this->db->query($query);
    
        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null; // Task not found
        }
    }
    public function closeConnection() {
        $this->db->closeConnection();
    }
}
?>