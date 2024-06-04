<?php

// This is my controller

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);


// require the autoload file
require_once('vendor/autoload.php');
require_once ('model/data-layer.php');
require_once ('model/validate.php');
require_once ('classes/applicant.php');
require_once ('classes/Applicant_SubscribedToLists.php');

session_start();
// Instantiate the F3 Base Class
$f3 = Base::instance();

// define default route
$f3->route('GET /', function(){
    // Render a view page
    $view = new Template();
    echo $view->render('views/home.html');
});


// info Form
$f3->route('GET|POST /info', function($f3) {
    // If the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        // Process the personal information form submission
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $state = $_POST['state'];
        $phone = $_POST['phone'];
        $mailingListOptIn = isset($_POST['mailing_list']);

        if ($mailingListOptIn) {
            $applicant = new Applicant_SubscribedToLists($fname, $lname, $email, $state, $phone);
        } else {
            $applicant = new applicant($fname, $lname, $email, $state, $phone);
        }

        $_SESSION['applicant'] = $applicant;

        // Handle file upload
        if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            $uploadFile = $uploadDir . basename($_FILES['profile_pic']['name']);
            if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $uploadFile)) {
                $applicant->setProfilePic($uploadFile);
            }
        }

        $_SESSION['applicant'] = $applicant;

        if ($mailingListOptIn) {
            $f3->reroute('/mailing_lists');
        } else {
            $f3->reroute('/experience');
        }
    }

    // Render a view page
    $view = new Template();
    echo $view->render('views/personal_info.html');
});



// experience Form
$f3->route('GET|POST /experience', function($f3) {


    // If the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        // Process the experience form submission
        $applicant = $_SESSION['applicant'];

        $github = $_POST['github'];
        $experience = $_POST['experience'];
        $relocate = $_POST['relocate'];
        $bio = $_POST['bio'];

        $applicant->setGithub($github);
        $applicant->setExperience($experience);
        $applicant->setRelocate($relocate);
        $applicant->setBio($bio);

        $_SESSION['applicant'] = $applicant;

        // Send the user to the next form
        $f3->reroute('/summary');

    }

    // Render a view page
    $view = new Template();
    echo $view->render('views/experience.html');
});

//  Summary
$f3->route('GET /summary', function($f3) {

    // Render the summary page
    $applicant = $_SESSION['applicant'];
    $f3->set('applicant', $applicant);


    // Render a view page
    $view = new Template();
    echo $view->render('views/summary.html');

    //var_dump ( $f3->get('SESSION') );
   // session_destroy();
});



$f3->route('GET|POST /mailing_lists', function($f3) {

    // If the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        // Process the mailing lists form submission
        $applicant = $_SESSION['applicant'];

        if ($applicant instanceof Applicant_SubscribedToLists) {
            $selectionsJobs = isset($_POST['jobs']) ? $_POST['jobs'] : [];
            $selectionsVerticals = isset($_POST['verticals']) ? $_POST['verticals'] : [];

            $applicant->setSelectionsJobs($selectionsJobs);
            $applicant->setSelectionsVerticals($selectionsVerticals);

            $_SESSION['applicant'] = $applicant;

            // Send the user to the next form
            $f3->reroute('experience');
        }

    }

       // Render a view page
    $view = new Template();
    echo $view->render('views/mailing_lists.html');

});

// Run Fat-Free
$f3->run();