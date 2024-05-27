<?php

// This is my controller

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
// require the autoload file
require_once('vendor/autoload.php');
require_once ('model/data-layer.php');
require_once ('model/validate.php');

// Instantiate the F3 Base Class
$f3 = Base::instance();



// Define routes

$f3->route('GET /', 'ApplicantController->showHomePage');
$f3->route('GET|POST /personal-info', 'ApplicantController->showPersonalInfoPage');
$f3->route('POST /process-personal-info', 'ApplicantController->processPersonalInfo');
$f3->route('GET /mailing-lists', 'ApplicantController->showMailingListsPage');
$f3->route('POST /process-mailing-lists', 'ApplicantController->processMailingLists');
$f3->route('GET /experience', 'ApplicantController->showExperiencePage');
$f3->route('POST /process-experience', 'ApplicantController->processExperience');
$f3->route('GET /summary', 'ApplicantController->showSummaryPage');

// Run the application

// define default route
$f3->route('GET /', function(){
    //echo '<h1>Hello Fat-Free!</h1>';

    // Render a view page
    $view = new Template();
    echo $view->render('views/home.html');
});




// Run Fat-Free
$f3->run();