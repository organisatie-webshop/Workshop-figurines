<?php
// Session
session_start();

// Check for "winkelwagen"
if (!$_SESSION["cart"]?? null){
    // Makes session
    $_SESSION["cart"] = []?? null;
}
// ID
$id = $_GET["id"] ?? null;

// Add to cart
if ($_GET["cart"] ?? null){
    array_push($_SESSION["cart"], $id);
}

// Connection
require_once 'includes/db.php';
$pdo = connectDB();

// Checks for $id
if ($id){ 
    $stmt = $pdo->prepare("SELECT * FROM figures WHERE id = $id");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    echo "<p>No ID found</p>";
}

?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="frontpage.css">
<head>
    <?php
    include_once 'includes/header.php';
    ?>
</head>

<body>

<?php
if ($id){
    echo "<h2>" . $result['title'] . "</h2>";
    echo "<p>" . $result['description'] . "</p>";
    echo "<h3>" . $result['cost'] . "</h3>";
    echo '<img src="'. $result['img'] .'" alt="'. $result['title'] .' width="500" height="600">';
    if (in_array($id, $_SESSION["cart"] )) {
        echo "<form action='item.php' method='get'>
            <input type='hidden' name='id' value='" . $id . "'>
            <input type='submit' name='cart' value='in winkelwagen'>
        </form>";
    } else {
        echo "<form action='item.php' method='get'>
            <input type='hidden' name='id' value='" . $id . "'>
            <input type='submit' name='cart' value='in winkelwagen leggen'> 
        </form>";
    }
}

?>

</body>

<footer>
    <?php
    include_once 'includes/footer.php';
    ?>
</footer>

</html>