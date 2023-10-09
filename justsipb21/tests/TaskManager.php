<?php
require_once 'Database.php';

class TaskManager {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getTasks() {
        $query = "SELECT * FROM tasks";
        $result = $this->db->query($query);
        $tasks = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $tasks[] = $row;
            }
        }

        return $tasks;
    }
    public function getTaskById($taskId) {
        $taskId = $this->db->real_escape_string($taskId); // Sanitize the input to prevent SQL injection

        $query = "SELECT * FROM tasks WHERE id = $taskId";
        $result = $this->db->query($query);

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null; // Task not found
        }
    }

    public function closeConnection() {
        $this->db->close();
    }
}
?>