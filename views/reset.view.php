<!doctype html>
<html lang="en">

<?php include 'partials/head.php' ?>

<body>
<main>
    <div class="container">
        <div class="reset-container">
            <h1>RESET YOUR PASSWORD</h1>
            <form method="post" action="/reset-password">
                <?php if (!empty($error)): ?>
                    <div id="errorAlert" class="alert alert-warning alert-dismissible fade show" role="alert">
                        <?= $error ?>
                    </div>
                <?php elseif(!empty($success)): ?>
                    <div id="addAlert" class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $success ?>
                    </div>
                <?php endif ?>
                <div class="col-12">
                    <div class="row form-group">
                        <label for="email">Email: </label>
                        <input id="email" type="email" name="email" class="form-control" required>
                    </div>
                    <div class="row form-group">
                        <label for="new_password">New Password: </label>
                        <input id="new_password" type="password" name="new_password" class="form-control" required>
                    </div>
                    <div class="row form-group form-btn">
                        <button type="submit" class="btn btn-primary">Reset Password</button>
                        <a type="button" class="btn btn-secondary" href="/">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<script src="../assets/js/app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>