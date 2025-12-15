<!DOCTYPE html>
<html>
<body>

<?php
function connectDB() {
    $servername = "localhost";
    $username = "pma";
    $password = "password";
    $dbname = "weebshop";
    
    try {
        # stelt verbinding
        $pdo = new PDO(
            "mysql:host=$servername;dbname=$dbname;charset=utf8mb4",
            $username,
            $password
        );

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;

    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
?>

</body>
</html> 
