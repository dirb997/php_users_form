<?php 
    $titleExample = "Form practice";
    $name = "";
    $age = "";
    $address ="";
    $emailAddress = "";
    $password = "";
    $checkbox = "";

    // Retrieve the data from the POST request
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $name = htmlspecialchars($_POST["name"]);
        $age = htmlspecialchars($_POST["age"]);
        $address = htmlspecialchars($_POST["address"]);
        $emailAddress = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);
        $checkbox = isset($_POST["t-and-c"]) ? "Accepted" : "Not Accepted";
    }

    // Create a file variable, create a file and save the data in the file
    $file = "userdata.txt";
    $fileData = "Name: $name, Age: $age, Address: $address, Email: $emailAddress, Terms: $checkbox";
    file_put_contents($file, $fileData, FILE_APPEND);

    // Retrieve the saved data to be shown on the website
    $fileSubmitted = [];
    if (file_exists($file))
    {
        $fileSubmitted = file("userdata.txt", FILE_IGNORE_NEW_LINES);
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
</head>
<body>
    <h1>PHP Practice: <?= $titleExample; ?></h1>
    <div class="container">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="col-6">
                <div class="row form-group">
                    <label for="name">Name: </label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="row form-group">
                    <label for="age">Age: </label>
                    <input type="integer" name="age" class="form-control">
                </div>
                <div class="row form-group">
                    <label for="address">Address: </label>
                    <input type="text" name="address" class="form-control">
                </div>
                <div class="row form-group">
                    <label for="email">Email Address: </label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="row form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="form-check">
                    <input type="checkbox" name="t-and-c" id="t-and-c">
                    <label for="t-and-c">Accept terms and conditions</label>
                </div>

                <div class="form-btn">
                    <button type="submit" class="btn btn-primary">SUBMIT</button>
                </div>
            </div>
        </form>
    </div>

    <?php if($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <div class="submitted-data container">
            <h2>Actual Users: </h2>
            <p><strong>Name: </strong><?= $name; ?></p>
            <p><strong>Age: </strong><?= $age; ?></p>
            <p><strong>Address: </strong><?= $address; ?></p>
            <p><strong>Email: </strong><?= $emailAddress; ?></p>
        </div>
    <?php else: ?>
        <div class="container">
        <h2>There is no data available</h2>
        </div>
    <?php endif ?>
</body>
</html>