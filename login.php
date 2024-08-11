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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Site</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/styles/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
</head>
<body>
<main>
    <div class="login-container">
        <h1>Welcome Back!</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <?php if (!empty($error)): ?>
                <div id="errorAlert" class="alert alert-warning alert-dismissible fade show" role="alert">
                <?= $error ?>
                </div>
            <?php elseif(!empty($success)): ?>
                <div id="addAlert" class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $success ?>
                </div>
            <?php endif; ?>
            <div class="col-10">
                <div class="row form-group">
                    <label for="email">User Mail: </label>
                    <input id="email" type="email" name="email" class="form-control" required>
                </div>
                <div class="row form-group">
                    <label for="password">Password: </label>
                    <input id="password" type="password" name="password" class="form-control" required>
                </div>
                <div class="row form-group form-btn">
                    <button type="submit" class="btn btn-primary">LOG IN</button>
                    <button class="btn btn-danger" type="reset">Reset Password</button>
                </div>
            </div>
        </form>
        <div class="link-container">
            <a href="index.php" class="btn btn-info">Don't have an account? Sign up</a>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/app.js"></script>
</body>
</html>