<?php


#************************************#
#************* configuratrion********#
#************************************#

require_once('include/config.inc.php');
require_once('include/db.inc.php');
require_once('include/form.inc.php');

#******* pdo connection ****#

$pdo = dbConnect('adressdb');

#********** Load Class ***********#

require_once('Class/Contact.class.php');

$contact = new Contact();



#*********var intilisation

$successMessage = NULL;
$errorMessage = NULL;
$errorName = NULL;
$errorCity = NULL;
$errorPhone =  NULL;

$contact->set_id($_GET['id']);

$contact->fetchFromDb($pdo);

// $id = $_GET['id'];
if (isset($_POST['editContact'])) {

    $contact->set_name($_POST['name']);
    $contact->set_city($_POST['city']);
    $contact->set_phone($_POST['phone']);

    # *** validation

    $errorName = checkInputString($contact->get_name(), 4);
    $errorCity = checkInputString($contact->get_city(), 3);
    $errorPhone = checkInputString($contact->get_phone(), 3);

    if ($errorName  || $errorCity || $errorPhone) {
    } else {

        if (!$contact->updateToDb($pdo)) {

            $errorMessage = "Es ist ein Fehler aufgetreten! Bitte versuchen Sie es später noch einmal.";
        } else {
            $successMessage = "neuer Kontakt mit folgender ID:" . $contact->get_id() . " zur Datenbank Aktliziert";

            header("location: index.php");
            exit();
        }
    }
}




?>