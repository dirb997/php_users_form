<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
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

if ($_SERVER["REQUEST_METHOD"] == "DELETE")
{
    $user_id = $_POST["id"];
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