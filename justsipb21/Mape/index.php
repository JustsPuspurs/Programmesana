<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <?php 
include("db.php");
include("class.php");
$prece = new Prece($db->conn);
    ?>
</head>
<body>
    <h1>Diski/Rati</h1>
    <div class="inside">
        <button class="button"><p>Login</p></button>    
        <button class="button"><p>Register</p></button>
    </div>
    <div class ="box">
        <?php
        $products = $prece->getAllProducts();
        foreach ($products as $product) {
            echo '<div class="conten">';
            echo '<img src="' . $product['bilde'] . '" alt="' . $product['produkts'] . '">';
            echo '<h3>' . $product['produkts'] . '</h3>';
            echo '<p>' . $product['apraksts'] . '</p>';
            echo '<p>Price: $' . number_format($product['cena'], 2) . '</p>';
            echo '</div>';
        }
        ?>
    </div>
</body>
</html>