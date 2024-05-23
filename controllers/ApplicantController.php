<?php

/**
 * Class ApplicantController
 * Handles routing and processing for applicant-related operations.
 */
class ApplicantController
{
    public function showPersonalInfoPage($f3)
    {
        // Render the personal information page
        echo Template::instance()->render('personal_info.html');
    }

    public function processPersonalInfo($f3)
    {
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
            $applicant = new Applicant($fname, $lname, $email, $state, $phone);
        }

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
            $f3->reroute('/mailing-lists');
        } else {
            $f3->reroute('/experience');
        }
    }

    public function showMailingListsPage($f3)
    {
        // Render the mailing lists page
        echo Template::instance()->render('mailing_lists.html');
    }

    public function processMailingLists($f3)
    {
        // Process the mailing lists form submission
        $applicant = $_SESSION['applicant'];

        if ($applicant instanceof Applicant_SubscribedToLists) {
            $selectionsJobs = $_POST['jobs'] ?? [];
            $selectionsVerticals = $_POST['verticals'] ?? [];

            $applicant->setSelectionsJobs($selectionsJobs);
            $applicant->setSelectionsVerticals($selectionsVerticals);

            $_SESSION['applicant'] = $applicant;
        }

        $f3->reroute('/experience');
    }

    public function showExperiencePage($f3)
    {
        // Render the experience page
        echo Template::instance()->render('experience.html');
    }

    public function processExperience($f3)
    {
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

        $f3->reroute('/summary');
    }

    public function showSummaryPage($f3)
    {
        // Render the summary page
        $applicant = $_SESSION['applicant'];
        $f3->set('applicant', $applicant);

        echo Template::instance()->render('summary.html');
    }
}

