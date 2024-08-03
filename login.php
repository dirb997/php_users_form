<?php
/*
Here we will check if the input user is already in the database (mail and password)
If The user info is in the DB, then we redirect to the Dashboard, if not, we will show an alert showing
that the user is not registered
*/
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
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
</head>
<body>
<main>
    <div class="container">
        <h1>Welcome Back!</h1>
        <form>
            <div class="col-6">
                <div class="row form-group">
                    <label for="name">User Mail: </label>
                    <input id="name" type="text" name="name" class="form-control" required>
                </div>
                <div class="row form-group">
                    <label for="age">Password: </label>
                    <input id="password" type="password" name="password" class="form-control" required>
                </div>
                <div class="row form-group form-btn">
                    <button type="submit" class="btn btn-primary">LOG IN</button>
                    <button class="btn btn-danger">Reset Password</button>
                </div>
            </div>
        </form>
        <div class="link-container">
            <a href="index.php" class="btn btn-primary">Don't have an account? Sign up</a>
        </div>
    </div>
</main>
</body>
</html>