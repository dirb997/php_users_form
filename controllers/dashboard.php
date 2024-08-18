<?php
// Start Session
session_start();

if(!isset($_SESSION["user_id"]))
{
    header("Location: /");
    exit();
}

$dotenvFile = __DIR__ . '/../.env';
if (file_exists($dotenvFile)) {
    $lines = file($dotenvFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (str_contains($line, '=')) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
            if (!empty($key)) {
                $_ENV[$key] = $value;
                $_SERVER[$key] = $value;
            }
        }
    }
}

// Database connection setting (referencing the .env file)
$servername = $_ENV['DB_SERVER'];
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];
$dbname = $_ENV['DB_NAME'];
$conn = new mysqli($servername, $username, $password, $dbname);

// Get actual user information
$user_id = $_SESSION["user_id"];
$userInfo = [];

$sql = "SELECT name, age, address, email, password, terms FROM user_info WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows === 1)
{
    $userInfo = $result->fetch_assoc();
}
$stmt->close();

// Show the last 3 user's information
$lastThreeUsersInfo = [];
$sql = "SELECT name, age, address, email, terms FROM user_info ORDER BY id DESC LIMIT 3";
$result = $conn->query($sql);
if ($result->num_rows > 0)
{
    while($row = $result->fetch_assoc())
    {
        $lastThreeUsersInfo[] = $row;
    }
}

// Initialize the edit alert constant
$editSuccess = "";

require 'views/dashboard.view.php';