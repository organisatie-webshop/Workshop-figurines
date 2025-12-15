<?php
// Session
session_start();

// Connection
require_once 'includes/db.php';
$pdo = connectDB();

// Remove item from cart
if (isset($_GET['remove']) && isset($_GET['cart_index'])) {
    unset($_SESSION['cart'][$_GET['cart_index']]);
}
// Clearcart
if ($_GET['clear_cart']?? null) {
    unset($_SESSION['cart']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <?php include_once 'includes/header.php'; ?>
</head>

<body>
<h1>winkelwagen</h1>

<?php
if (!empty($_SESSION["cart"])) {
    echo "<ul>";

    foreach ($_SESSION["cart"] as $index => $cartItem) {

        // Use prepared statement safely
        $stmt = $pdo->prepare("SELECT * FROM figures WHERE id = ?");
        $stmt->execute([$cartItem]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        echo "<li>";
        echo htmlspecialchars($result['title']);

        // Remove button
        echo "
            <form method='get' style='display:inline'>
                <input type='hidden' name='cart_index' value='{$index}'>
                <button type='submit' name='remove'>Remove</button>
            </form>
        ";

        echo "</li>";
    }
    echo "</ul>";
    echo '<form action="winkelwagen.php" method="get">
    <input type="hidden">
    <input type="submit" name="clear_cart" value="remove all">
</form>';
} else {
    echo "<p>Winkelwagen is leeg</p>";
}
?>

</body>

<footer>
    <?php include_once 'includes/footer.php'; ?>
</footer>
</html>
