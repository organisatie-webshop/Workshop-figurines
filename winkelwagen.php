<?php
// Session
session_start();

// Connection
require_once 'includes/db.php';
$pdo = connectDB();

?>

<!DOCTYPE html>
<html>
<head>
    <?php
    include_once 'includes/header.php';
    ?>
</head>

<body>
<h1>winkelwagen</h1>
<?php

if (!empty($_SESSION["cart"])){
    echo "<ul>";
    foreach ($_SESSION["cart"] as $cart){
        echo "<li>".$cart."</li>";
    }
} else {
    echo "winkelwagen is leeg";
}

?>

</body>

<footer>
    <?php
    include_once 'includes/footer.php';
    ?>
</footer>
</html>