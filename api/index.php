<?php
require_once '../mvc/controller.php';
session_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$dentist = new Controller();

switch ($_GET["type"]) {
    case 'dentist':
        switch ($_GET["status"]) {
            case 'update':
                echo $dentist->updateDentist($_GET["data"]);
                break;
            case 'connservice':
                echo $dentist->updateDentistService($_GET["data"]);
                break;
            case 'book':
                echo $dentist->bookDentist($_GET["data"]);
                break;
            };
        break;
    case 'service':
        switch ($_GET["status"]) {
            case 'update':
                echo $dentist->updateService($_GET["data"]);
                break;
            case 'create':
                echo $dentist->createService($_GET["data"]);
                break;
            case 'delete':
                echo $dentist->deleteService($_GET["data"]);
                break;
            }
        break;
    case 'threatment':
        switch ($_GET["status"]) {
            case 'create':
                echo $dentist->createThreatment($_GET["data"]);
                break;
            case 'get':
                echo $dentist->getThreatment($_GET["data"]);
                break;
            }
        break;
    case 'users':
        switch ($_GET["status"]) {
            case 'block':
                echo $dentist->cancelUser($_GET["data"]);
                break;
            case 'update':
                echo $dentist->updateUser($_GET["data"]);
                break;
            case 'negative':
                echo $dentist->negativeUser($_GET["data"]);
                break;
            };
        break;
    case 'appointment':
        switch ($_GET["status"]) {
            case 'cancel':
                echo $dentist->cancelAppointment($_GET["data"]);
                break;
            case 'delete':
                echo $dentist->deleteAppointment($_GET["data"]);
                break;
            case 'get':
                echo $dentist->getAppointment($_GET["data"]);
                break;
            case 'update':
                echo $dentist->updateAppointment($_GET["data"]);
                break;
            };
        break;
    default:
        break;
}

?>