<?php
// filepath: c:\xampp\htdocs\website\db.php
$host = 'localhost';
$db   = 'website'; // your database name
$user = 'root';    // your DB username (default for XAMPP)
$pass = '';        // your DB password (default empty for XAMPP)
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    // echo "Connected successfully"; // (optional) for debugging
} catch (\PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>