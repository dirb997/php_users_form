<?php
session_start();
//Call the variables of the .env file
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

if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}
$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars($_POST['email']);
    $new_password = htmlspecialchars($_POST['new_password']);

    $sql = "SELECT * FROM user_info WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if($user)
    {
        if (strlen($new_password) < 8) {
            $error = "The length of new password must be at least 8 characters long";
            include 'controllers/reset.php';
            exit();
        }

        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $update_sql = "UPDATE user_info SET password = ? WHERE email = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->execute([$hashed_password, $email]);

        if ($update_stmt->affected_rows > 0)
        {
            $_SESSION['success'] = 'Your password has been changed';
            header("location: /");
        }
        else
        {
            $error = 'There was an error changing your password';
            include 'controllers/reset.php';
        }
        exit();
    }
    else
    {
        $error = 'The account information you entered does not exist. Please try again.';
        include 'controllers/reset.php';
        exit();
    }

    $stmt->close();
    $update_stmt->close();
    $conn->close();

    include 'controllers/login.php';
}