<!DOCTYPE html>
<html lang="en">

<?php include 'partials/head.php' ?>

<body>
<div class="container">
    <div class="signup-container">
        <h1>REGISTRATION FORM</h1>
        <form method="POST" action="/signup">
            <div class="col-10 col-lg-8">
                <div class="row form-group">
                    <label for="name">Name: </label>
                    <input id="name" type="text" name="name" class="form-control" value="<?= htmlspecialchars($name) ?>">
                </div>
                <div class="row form-group">
                    <label for="age">Age: </label>
                    <input id="age" type="number" name="age" class="form-control" value="<?= htmlspecialchars($age) ?>">
                </div>
                <div class="row form-group">
                    <label for="address">Address: </label>
                    <input id="address" type="text" name="address" class="form-control" value="<?= htmlspecialchars($address) ?>">
                </div>
                <div class="row form-group">
                    <label for="email">Email Address: </label>
                    <input id="email" type="text" name="email" class="form-control" value="<?= htmlspecialchars($emailAddress) ?>">
                </div>
                <div class="row form-group">
                    <label for="password">Password:</label>
                    <input id="password" type="password" name="password" class="form-control">
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
                <div class="alert alert-danger" id="infoAlert"><?= $error ?></div>
            <?php endif; ?>
        </form>
        <div class="link-container">
            <p>Already have an account? <a href="/" class="btn btn-secondary">Log In</a></p>
        </div>
    </div>
</div>

<script src="../assets/js/app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>