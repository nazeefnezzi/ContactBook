<?php

#************************************#
#************* Add contact View******#
#************************************#


/**
 * improt add contact controller
 */

require_once('./Controller/addController.php');



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>address Book Add page</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>

    <div class="container">

        <!-- As a heading -->
        <nav class="navbar bg-light">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1">Add to Address Book</span>
                <a href="index.php"><button class="btn btn-outline-success float-end">
                        << back to Dashboard </button></a>
            </div>
        </nav>

        <hr>

        <form method="POST">
            <input type="hidden" name="addContact">
            <div class="row justify-content-center">

                <div class="form-group col-6">
                    <?php if ($successMessage) : ?>
                        <div class="alert alert-dismissible alert-success" id="sucalert">
                            <button type="button" class="btn-close" onclick="document.getElementById('sucalert').hidden = true"></button>
                            <?= $successMessage ?>
                        </div>
                    <?php elseif ($errorMessage) :  ?>
                        <div class="alert alert-dismissible alert-warning" id="erralert">
                            <button type="button" class="btn-close" onclick="document.getElementById('erralert').hidden = true"></button>
                            <?= $errorMessage ?>
                        </div>
                    <?php endif ?>

                    <div class="mb-3">
                        <label for="name" class="form-label">NAME <?= '<span class="text-danger">' . $errorName . '</span>' ?></label>
                        <input type="text" name="name" value="<?= $contact->get_name() ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">City <?= '<span class="text-danger">' . $errorCity . '</span>' ?></label>
                        <input type="text" name="city" value="<?= $contact->get_city() ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="phone number" class="form-label">Phone Number <?= '<span class="text-danger">' . $errorPhone . '</span>' ?></label>
                        <input type="text" name="phone" value="<?= $contact->get_phone() ?>" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary float-end">Add</button>
                </div>

            </div>

        </form>
    </div>
</body>

</html>