<!DOCTYPE html>
<html lang="en">

<?php include 'partials/head.php' ?>

<body>
<main>
    <div class="login-container">
        <h1>WELCOME BACK!</h1>
        <form method="post" action="/">
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
            <p>Don't have an account? <a href="/signup" class="btn btn-secondary">Sign up</a></p>
        </div>
    </div>
</main>
<script src="../assets/js/app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>