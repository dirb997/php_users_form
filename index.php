<?php
    session_start();
    $titleExample = "User information";
    $name = "";
    $age = "";
    $address ="";
    $emailAddress = "";
    $password = "";
    $checkbox = "";

    // Database connection setting
    $servername = "localhost";
    $username = "root";
    $password = "diego";
    $dbname = "php_form_userdata";
    $conn = new mysqli($servername, $username, $password, $dbname);

    //Check the connection to the database
    if ($conn->connect_error)
    {
        $error = "Connection failed: " . $conn->connect_error;
    }

    // Retrieve the data from the POST request
    if ($_SERVER["REQUEST_METHOD"] == "POST")
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
            $password = password_hash(htmlspecialchars($_POST["password"]), PASSWORD_DEFAULT);
            $checkbox = isset($_POST["t-and-c"]) ? "Accepted" : "Not Accepted";

            if($age < 18)
            {
                $error = "You must be 18 years old to access  ";
            }
            else
            {
                $sql = "INSERT INTO user_info (name, age, address, email, password, terms) VALUES ('$name', '$age', '$address', '$emailAddress', '$password', '$checkbox')";
                if ($conn -> query($sql) === TRUE)
                {
                    $_SESSION['success'] = "New record created successfully";
                    header("location: login.php");
                    exit();
                }
                else
                {
                    $error = "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }

    // TODO: Add some CSS styling

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP practice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/styles/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
</head>
<body>
    <h1><?= $titleExample; ?></h1>
    <div class="container">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="col-6">
                <div class="row form-group">
                    <label for="name">Name: </label>
                    <input id="name" type="text" name="name" class="form-control" value="<?= htmlspecialchars($name) ?>" required>
                </div>
                <div class="row form-group">
                    <label for="age">Age: </label>
                    <input id="age" type="number" name="age" class="form-control" value="<?= htmlspecialchars($age) ?>" required>
                </div>
                <div class="row form-group">
                    <label for="address">Address: </label>
                    <input id="address" type="text" name="address" class="form-control" value="<?= htmlspecialchars($address) ?>">
                </div>
                <div class="row form-group">
                    <label for="email">Email Address: </label>
                    <input id="email" type="email" name="email" class="form-control" value="<?= htmlspecialchars($emailAddress) ?>" required>
                </div>
                <div class="row form-group">
                    <label for="password">Password:</label>
                    <input id="password" type="password" name="password" class="form-control" required>
                </div>

                <div class="form-check">
                    <input type="checkbox" name="t-and-c" id="t-and-c">
                    <label for="t-and-c">Accept terms and conditions</label>
                </div>

                <div class="form-btn">
                    <button type="submit" class="btn btn-primary">SUBMIT</button>
                </div>
            </div>
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>
        </form>
        <div class="link-container">
            <a href="login.php" class="btn btn-primary">Already have an account? Log In</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="app.js"></script>
</body>
</html>