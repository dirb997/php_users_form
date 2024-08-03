<?php
// Database connection setting
$servername = "localhost";
$username = "root";
$password = "diego";
$dbname = "php_form_userdata";
$conn = new mysqli($servername, $username, $password, $dbname);

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
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/styles/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1>Welcome to your dashboard!</h1>
</div>
<h2>Recently added user's information: </h2>
<div class="submitted-data-main">
    <?php if(count($lastThreeUsersInfo) > 0) : ?>
        <?php foreach($lastThreeUsersInfo as $user):?>
            <div class="submitted-data container">
                <p><strong>Name: </strong><?php echo htmlspecialchars($user["name"]); ?></p><br>
                <p><strong>Age: </strong><?php echo htmlspecialchars($user["age"]); ?></p><br>
                <p><strong>Address: </strong><?php echo htmlspecialchars($user["address"]); ?></p><br>
                <p><strong>Email: </strong><?php echo htmlspecialchars($user["email"]); ?></p><br>
                <p><strong>Terms: </strong><?php echo $user["terms"]; ?></p><br>
            </div>
        <?php endforeach ?>
    <?php else: ?>
        <div class="alert alert-primary">There is no recent data available</div>
    <?php endif ?>
</div>
</body>
</html>