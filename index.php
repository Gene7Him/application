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
$f3->route('GET /', 'ApplicantController->showPersonalInfoPage');
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


// info Form
$f3->route('GET|POST /info', function($f3) {


    // If the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == "POST") {


        // Get the data from the post array
        $fName = $_POST['fname'];
        $lName = $_POST['lName'];
        $email = $_POST['email'];
        $Phone = $_POST['Phone'];


        if(true){
            // Add the data to the session array
            $f3->set('SESSION.fName', $fName);
            $f3->set('SESSION.lName', $lName);
            $f3->set('SESSION.email', $email);
            $f3->set('SESSION.Phone', $Phone);

            // Send the user to the next form
            $f3->reroute('experience');
        }

    }

    // Render a view page
    $view = new Template();
    echo $view->render('views/information.html');
});



// experience Form
$f3->route('GET|POST /experience', function($f3) {

  //  var_dump ( $f3->get('SESSION') );

    // If the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        // Get the data from the post array
        $bio = $_POST['bio'];
        $git = $_POST['git'];



        if(true) {
            // Add the data to the session array
            $f3->set('SESSION.bio', $bio);
            $f3->set('SESSION.git', $git);

        }


            if (isset($_POST['ex']) && $_POST['move'])
            $ex = $_POST['ex'];
            $move = $_POST['move'];


        // If the data valid
        if (true) {

            // Add the data to the session array
            $f3->set('SESSION.ex', $ex);
            $f3->set('SESSION.move', $move);

            // Send the user to the next form
            $f3->reroute('mailing');
        }

    }

    // Render a view page
    $view = new Template();
    echo $view->render('views/experience.html');
});



$f3->route('GET|POST /mailing', function($f3) {

    // If the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        //var_dump($_POST);
        // Get the data from the post array
        if (isset($_POST['code']))

            $coding = "code[]";


        // If the data valid
        if (true) {

            // Add the data to the session array
            $f3->set('SESSION.code', $coding);


            // Send the user to the next form
            $f3->reroute('summary');
        }
    }

    // Get the data from the model
    // and add it to the F3 hive
    $code = getJobs();
    $f3->set('code', $code);

    $codes = getVerticles();
    $f3->set('codes', $codes);

    // Render a view page
    $view = new Template();
    echo $view->render('views/mailing.html');
});

// Run Fat-Free
$f3->run();