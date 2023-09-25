<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <?php
        include("db.php");
        include("class.php");
        $tasks = new Tasks($db->conn);
        
    ?>
</head>
<body>
    <div class="mid">
        <?php
        $task = $tasks->getAllTasks();
                foreach ($task as $taskes) {
                    echo '<div class="conten">';
                    echo '<h3>' . $taskes['title'] . '</h3>';
                    echo '<h3>' . $taskes['description'] . '</h3>';
                    echo '<p>' . $taskes['due_date'] . '</p>';
                    echo '<p>' . $taskes['status'] . '</p>';
                    echo '<p>' . $taskes['created_at'] . '</p>';
        echo '</div>';
        }
        ?>
    </div>
</body>
</html>