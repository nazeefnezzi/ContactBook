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

#*********var intilisation

$successMessage = NULL;
$errorMessage = NULL;
$allContactObj = NULL;
$contactArr   =  NULL;


$contact = new Contact();

#************Delete Action **********#
#************************************#

if (isset($_GET['action'])) {
    $action = cleanString($_GET['action']);

    if ($action == "delete") {

        $contactId = cleanString($_GET['id']);

        $contact->deleteFromDb($pdo, $contactId);
    }
}

$allContactObj = $contact::fetchAllfromDb($pdo);


#********************************************************************************************#

#***************Url route********#

if (isset($_GET['action'])) {

    $action = cleanString($_GET['action']);

    if ($action == "sortname") {
        $allContactObj = $contact::sortByName($pdo);
    } elseif ($action == "sortcity") {

        $allContactObj = $contact::sortByCity($pdo);
    }
}

#********************************************************************************************#

#************ Search Phone **********#
#************************************#


if (isset($_POST['searchForm'])) {


    $contact->set_phone($_POST['search']);

    $errorPhone = checkInputString($contact->get_phone());

    if ($errorPhone) {

        $errorMessage = "keine Datai";
    } else {
        $allContactObj = $contact->searchPhoneNumber($pdo);
    }
}



?>