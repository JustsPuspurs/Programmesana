<?php
require_once 'db.php';
require_once 'class.php';

$database = new Database();
$conn = $database->getConnection();
$taskManager = new Tasks($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];
    $status = $_POST['status'];

    $result = $taskManager->createTask($title, $description, $due_date, $status);

    echo "<p>$result</p>";
}
?>





