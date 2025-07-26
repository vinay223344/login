<?php

$host = 'localhost';
$db   = 'users';         
$user = 'root';          
$pass = '';            

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("DB Connection failed: " . $e->getMessage());
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $name = $_POST['name'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($name && $username && $password) {
        $stmt = $pdo->prepare("INSERT INTO userdetails (name, username, password) VALUES (?, ?, ?)");
        try {
            $stmt->execute([$name, $username, $password]);
            echo "User registered successfully.";
	    echo "<a href='/login.html'>Login Here!!!</a>";
        } catch (PDOException $e) {
            echo "Error inserting user: " . $e->getMessage();
        }
    } else {
        echo "Please fill all required fields.";
    }
} else {
    echo "Invalid request method.";
}
