<?php
session_start();
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

header('Content-Type: application/json');
if (!isset($_SESSION["user_id"]))
{
    header("Location: login.php");
    echo json_encode(["status" => "error", "message" => "User not logged in."]);
    exit();
}

// Database connection setting (referencing the .env file)
$servername = $_ENV['DB_SERVER'];
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];
$dbname = $_ENV['DB_NAME'];
$conn = new mysqli($servername, $username, $password, $dbname);

// Initilize the edit alert constant
$editSuccess = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $user_id = $_SESSION["user_id"];
    $name = $_POST["name"];
    $age = $_POST["age"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $address = $_POST["address"];

    $sql = "UPDATE user_info SET  name = ?, age = ?, email = ?, password = ?, address = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisssi", $name, $age, $email, $password, $address, $user_id);

    if ($stmt->execute())
    {
        echo json_encode(["status" => "success", "message" => "User's information updated succesfully!"]);
    }
    else
    {
        echo json_encode(["status" => "error"]);
    }

    $stmt->close();
}

$conn->close();