<?php
class Tasks
{
    private $conn;

    private $table_name = "tasks";

    public $id;
    public $title;
    public $description;
    public $due_date;
    public $status;
    public $created_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllTasks()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $result = $this->conn->query($query);

        $tasks = array();

        while ($row = $result->fetch_assoc()) {
            $tasks[] = $row;
        }

        return $tasks;
    }
}
?>