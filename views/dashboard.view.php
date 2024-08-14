<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/styles/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/x-icon" href="/assets/images/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <?php if (!empty($editSuccess)): ?>
            <div id="editAlert" class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $editSuccess ?>
            </div>
        <?php endif; ?>
        <h1>Welcome to your dashboard!, <?php echo htmlspecialchars($userInfo["name"]) ?></h1>
        <div class="container user-data">
            <ul>
                <li><strong>Name: </strong><?php echo htmlspecialchars($userInfo["name"])?></li>
                <li><strong>Age: </strong><?php echo htmlspecialchars($userInfo["age"])?></li>
                <li><strong>Address: </strong><?php echo htmlspecialchars($userInfo["address"])?></li>
                <li><strong>Email: </strong><?php echo htmlspecialchars($userInfo["email"])?></li>
                <li><strong>Password: </strong><?php echo preg_replace("|.|", "*", $userInfo["password"]); ?></li>
            </ul>
        </div>
        <div class="container dashboard-btn dashboard-btn-main">
            <button class="btn btn-info" id="edit-btn">EDIT</button>
            <button class="btn btn-danger" id="delete-btn">DELETE</button>
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
        <div class="container dashboard-btn">
            <a href="../logout.php" type="button" class="btn btn-outline-secondary">SIGN OUT</a>
        </div>
    </div>

    <!-- When Edit button is clicked this modal is shown -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Edit user's information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                </div>
                <form id="editForm">
                    <div class="mb-4">
                        <label for="edit-name">Name:</label>
                        <input type="text" class="form-control" id="edit-name" name="name" value="<?php echo htmlspecialchars($userInfo["name"]) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="edit-age"></label>
                        <input type="number" class="form-control" id="edit-age" name="age" value="<?php echo htmlspecialchars($userInfo["age"]) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="edit-address"></label>
                        <input type="text" class="form-control" id="edit-address" name="address" value="<?php echo htmlspecialchars($userInfo["address"]) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="edit-email"></label>
                        <input type="email" class="form-control" id="edit-email" name="email" value="<?php echo htmlspecialchars($userInfo["email"]) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="edit-password"></label>
                        <input type="password" class="form-control" id="edit-password" name="password" value="<?php echo htmlspecialchars($userInfo["password"]) ?>">
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="model-close-btn">Close</button>
                    <button type="button" class="btn btn-primary" id="save-btn">SAVE CHANGES</button>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>