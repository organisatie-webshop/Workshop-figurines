<?php
// Session
session_start();

// Connection
require_once 'includes/db.php';
$pdo = connectDB();

// Query
$stmt = $pdo->prepare("SELECT * FROM figures");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html>
<head>
    <?php
    include_once 'includes/header.php';
    ?>
</head>

<body>

<?php
echo "<h1>Frontpage</h1>";

foreach($result as $item){
    echo "<form action='item.php' method='GET'>
        <input type='hidden' name='id' value='" . $item['ID'] . "'>
        <button type='submit'>
            <div><h2> ". $item['title'] . "</h2>
            <p>€ " . $item['cost'] . "</p>
            <img src='". $item['img'] ."' alt='". $item['title'] ." width='300' height='360'>
            </div>
        </button>
    </form>";
}


?>

</body>


<footer>
    <?php
    include_once 'includes/footer.php';
    ?>
</footer>
</html>