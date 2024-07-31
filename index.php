<?php 
    $titleExample = "User's information form";
    $name = "";
    $age = "";
    $address ="";
    $emailAddress = "";
    $password = "";
    $checkbox = "";

    // File variable is created
    $file = "userdata-file.txt";

    // Retrieve the data from the POST request
    if ($_SERVER["REQUEST_METHOD"] == "POST")
        if (empty($_POST["name"]) || empty($_POST["age"]) || empty($_POST["address"]) || empty($_POST["email"]) || empty($_POST["password"]) || !isset($_POST["t-and-c"]))
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
            $checkbox = "Accepted";

            // Create a file variable, create a file and save the data in the file
            $fileData = "Name: $name | Age: $age | Address: $address | Email: $emailAddress | Terms: $checkbox \n";
            file_put_contents($file, $fileData, FILE_APPEND);
        }

    // TODO: Add age validation (if age is < 18 cannot upload the form, else upload OK)
    // TODO: Create a simple DB to store the data (change from a .txt file to a simple mysql format)
    // TODO: Add some CSS styling

    // Retrieve the saved data to be shown on the website
    $fileSubmitted = [];
    if (file_exists($file))
    {
        $fileSubmitted = file("userdata-file.txt", FILE_IGNORE_NEW_LINES);
    }

    // Create the variable for the last three added user's information
    $lastThreeUsersInfo = array_slice($fileSubmitted, -3);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP practice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/styles/main.css">
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
    </div>
    <h2>Recently added user's information: </h2>
    <div class="submitted-data-main">
    <?php if($_SERVER["REQUEST_METHOD"] == "POST" && count($lastThreeUsersInfo) > 0) : ?>
        <?php foreach($lastThreeUsersInfo as $user): 
            list ($userName, $userAge, $userAddress, $userEmail, $userCheck) = explode("| ", $user);
            $userName = explode(": ", $userName)[1];
            $userAge = explode(": ", $userAge)[1];
            $userAddress = explode(": ", $userAddress)[1];
            $userEmail = explode(": ", $userEmail)[1];
            $userCheck = explode(": ", $userCheck)[1];
            ?>
            <div class="submitted-data container">
                <p><strong>Name: </strong><?php echo htmlspecialchars($userName); ?></p><br>
                <p><strong>Age: </strong><?php echo htmlspecialchars($userAge); ?></p><br>
                <p><strong>Address: </strong><?php echo htmlspecialchars($userAddress); ?></p><br>
                <p><strong>Email: </strong><?php echo htmlspecialchars($userEmail); ?></p><br>
                <p><strong>Terms: </strong><?php echo htmlspecialchars($userCheck); ?></p>
            </div>
        <?php endforeach ?>
    <?php endif ?>
    </div>
    <h1>User Information:</h1>
    <div class="all-users-info container mt-4">
        <?php if (count($fileSubmitted) > 0): ?>
            <ul>
                <?php foreach ($fileSubmitted as $userInfo): ?>
                <li><?= htmlspecialchars($userInfo) ?></li>
                <?php endforeach ?>
            </ul>
        <?php else: ?>
            <p>There is no data available at this moment.</p>
        <?php endif ?>
    </div>
</body>
</html>