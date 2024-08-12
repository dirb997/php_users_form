<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE");
header('content-type: application/json');

if (!isset($_SESSION["user_id"]))
{
    header("Location: login.php");
    echo json_encode(["status" => "error", "message" => "User not logged in."]);
    exit();
}

$dotenvFile = __DIR__ . '/.env';
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


if ($_SERVER["REQUEST_METHOD"] == "DELETE")
{
    $user_id = $_SESSION["user_id"];
    $sql = "DELETE FROM user_info WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute())
    {
        echo json_encode(["status" => "success"]);
    }
    else
    {
        echo json_encode(["status" => "error"]);
    }

    $stmt->close();
}

$conn->close();