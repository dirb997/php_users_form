<?php
session_start();

//Call the variables of the .env file
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

if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}
$error = "";
$success = "";
$successDelete = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);

    $sql = "SELECT * FROM user_info WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows === 1)
    {
        $user = $result->fetch_assoc();
        if(password_verify($password, $user["password"]))
        {
            $_SESSION["user_id"] = $user["id"];
            header("location: dashboard.php");
            exit();
        }
        else
        {
            $error = "Wrong password. Please try again.";
        }
    }
    else if($result->num_rows === 0)
    {
        $error = "The information was not found. Please sign up.";
    }

    $stmt->close();
}

if (isset($_SESSION['success']))
{
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
}

if (isset($_SESSION['deleteSuccess']))
{
    $successDelete = $_SESSION['deleteSuccess'];
    unset($_SESSION['deleteSuccess']);
}

require 'views/login.view.php';