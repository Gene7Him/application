<?php

// This is my controller

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// require the autoload file
require_once('vendor/autoload.php');

// Instantiate the F3 Base Class
$f3 = Base::instance();

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

        //var_dump($_POST);
        // Get the data from the post array
        if (isset($_POST['conds']))
            $condiments = implode(", ", $_POST['conds']);
        else
            $condiments = "None selected";

        // If the data valid
        if (true) {

            // Add the data to the session array
            $f3->set('SESSION.condiments', $condiments);

            // Send the user to the next form
            $f3->reroute('summary');
        }
        else {
            // Temporary
            echo "<p>Validation errors</p>";
        }
    }

    // Render a view page
    $view = new Template();
    echo $view->render('views/experience.html');
});









// Run Fat-Free
$f3->run();