<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Site</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/styles/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/x-icon" href="/assets/images/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
</head>
<body>
<main>
    <div class="login-container">
        <h1>WELCOME BACK!</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <?php if (!empty($error)): ?>
                <div id="errorAlert" class="alert alert-warning alert-dismissible fade show" role="alert">
                    <?= $error ?>
                </div>
            <?php elseif(!empty($success)): ?>
                <div id="addAlert" class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $success ?>
                </div>
            <?php elseif(!empty($successDelete)): ?>
                <div id="deleteAlert" class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $successDelete ?>
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
            <p>Don't have an account? <a href="/index.php" class="btn btn-secondary">Sign up</a></p>
        </div>
    </div>
</main>
<script src="../assets/js/app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>