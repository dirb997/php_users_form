<?php
session_start();
header('Content-Type: application/json');
if (!isset($_SESSION["user_id"]))
{
    header("Location: login.php");
    echo json_encode(["status" => "error", "message" => "User not logged in."]);
    exit();
}

// Database connection setting
$servername = "localhost";
$username = "root";
$password = "diego";
$dbname = "php_form_userdata";
$conn = new mysqli($servername, $username, $password, $dbname);

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
    $stmt->bind_param("sissi", $name, $age, $email, $password, $address, $user_id);

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