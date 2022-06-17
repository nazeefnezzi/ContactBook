<?php



/**
 * import Controller
 */
require_once('./Controller/indexController.php');


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>address Book</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>

    <div class="container">

        <!-- As a heading -->
        <nav class="navbar bg-light">
            <div class="container-fluid">
                <a style="text-decoration: none;" href='<?= $_SERVER['SCRIPT_NAME'] ?>'><span class="navbar-brand mb-0 h1">Address Book</span></a>
                <a href="add.php"><button class="btn btn-outline-success float-end">Add</button></a>
            </div>
        </nav>

        <hr>
        <div class="row">
            <a class="col-2" href="?action=sortname"> <button type="button" class="btn btn-secondary m-2 ">A-z</button></a>
            <a class="col-2" href="?action=sortcity"> <button type="button" class="btn btn-secondary m-2 ">Sort by City</button></a>

            <form class="col-8" action="" method="POST">
                <input type="hidden" name="searchForm">
                <input type="text" name="search" class="col-3 m-2" placeholder="Search Phone Number" id="inputDefault">
                <button type="submit" class="btn btn-secondary col-2 m-2">Search </button>
            </form>
        </div>
        <hr>

        <table class="table table-light table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">City</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Edit / Delete</th>
                </tr>
            </thead>
            <?php if ($allContactObj) : ?>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($allContactObj as $contactArr) : ?>

                        <tr>
                            <th scope="row"><?= $i ?></th>
                            <td><?= htmlspecialchars_decode($contactArr->get_name())  ?></td>
                            <td><?= $contactArr->get_city() ?></td>
                            <td><?= $contactArr->get_phone() ?></td>
                            <td>
                                <a href='edit.php?id=<?= $contactArr->get_id() ?>'><button class="btn btn-outline-info btn-sm">Edit</button></a>
                                <a href='?action=delete&id= <?= $contactArr->get_id() ?>'><button class="btn btn-outline-danger btn-sm">Delete</button></a>
                            </td>
                        </tr>
                        <?php $i++ ?>
                    <?php endforeach ?>

                </tbody>
            <?php else : ?>
                <h4 class="text-warning"> <?= "Keine Datai" ?> </h4>
            <?php endif ?>
        </table>
    </div>

</body>

</html>