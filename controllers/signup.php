<?php
session_start();
$name = "";
$age = "";
$address ="";
$emailAddress = "";
$password = "";
$checkbox = "";

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

//Check the connection to the database
if ($conn->connect_error)
{
    $error = "Connection failed: " . $conn->connect_error;
}

// Retrieve the data from the POST request
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (empty($_POST["name"]) || empty($_POST["age"]) || empty($_POST["address"]) || empty($_POST["email"]) || empty($_POST["password"]))
    {
        $error = "All the input fields are required";
    }
    else
    {
        $name = htmlspecialchars($_POST["name"]);
        $age = htmlspecialchars($_POST["age"]);
        $address = htmlspecialchars($_POST["address"]);
        $emailAddress = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);
        $checkbox = isset($_POST["t-and-c"]) ? "Accepted" : "Not Accepted";

        // Validation to check if the email address is already in use
        $emailCheck = $conn->prepare("SELECT * FROM user_info WHERE email= ?");
        $emailCheck->bind_param("s", $emailAddress);
        $emailCheck->execute();
        $emailCheck->store_result();

        if ($emailCheck->num_rows > 0) {
            $error = "Email address already in use. Please choose another.";
        } else {
            if($age < 18) {
                $error = "You must be at least 18 years old to sign up.";
            }

            if (strlen($password) < 8) {
                $error = "Your password must be at least 8 characters long.";
            }

            if (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
                $error = "The email address you entered is invalid.";
            }

            else
            {
                $password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO user_info (name, age, address, email, password, terms) VALUES (?, ?, ?, ?, ?, ?)");
                if ($stmt === false) {
                    die("Prepare failed: " . $conn->error);
                }

                $stmt->bind_param("sissss", $name, $age, $address, $emailAddress, $password, $checkbox);

                if($stmt->execute())
                {
                    $_SESSION['success'] = "New record created successfully";

                    // Define the settings to send a confirmation email
                    $to = $emailAddress;
                    $subject = "Confirmation of the sign up";
                    $message = "Dear $name, Your account has been created. \nPlease log in to start using our services.";
                    $headers = "From: noreply@example.com";

                    if (mail($to, $subject, $message, $headers))
                    {
                        error_log("Mail sent successfully to $to");
                        $_SESSION['success'] = "Thanks for signing up! \nCheck your inbox to check the confirmation email.";
                    }
                    else
                    {
                        error_log("Mail failed to send to $to");
                        $_SESSION['error'] = "There was an error sending your message. Your confirmation email has not been sent.";
                    }

                    header("Location: /");
                }
                else
                {
                    $error = "Error: " . $sql . "<br>" . $conn->error;
                }
                $stmt->close();
            }
        }
    }
}

require 'views/signup.view.php';
