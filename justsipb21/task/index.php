<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <?php
        include "db.php";
        include "class.php";
        $tasks = new Tasks($db->conn);
    ?>
</head>
<body class = "body1">
<button type="button" onClick="location.href='../task/jauns.php'" id ="Jauns">Izveidot Jaunu</button>
    <div class="mid">
        <?php foreach ($tasks->getAllTasks() as $task) { ?>
            <div class="conten">
                <h3>Nosaukums:<?= $task['title'] ?></h3>
                <h3>Apraksts:<?= $task['description'] ?></h3>
                <p>Termiņš:<?= $task['due_date'] ?></p>
                <p>Status:<?= $task['status'] ?></p>
                <p>Izveidots:<?= $task['created_at'] ?></p>
                <button type="button">Skatit</button>
            </div>
        <?php } ?>
    </div>
</body>
</html> 
