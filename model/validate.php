<?php

/**
 * Function to check if a name contains only alphabetic characters.
 *
 * @param string $name
 * @return bool
 */
function validFName($fname) {
    return preg_match('/^[a-zA-Z]+$/', $fname);
}

function validLName($lname) {
    return preg_match('/^[a-zA-Z]+$/', $lname);
}

/**
 * Function to check if a given string is a valid GitHub URL.
 *
 * @param string $url
 * @return bool
 */
function validGithub($url) {
    return filter_var($url, FILTER_VALIDATE_URL) !== false;
}

/**
 * Function to check if a string is a valid "value" property.
 * Customize this function based on your definition of valid "value".
 *
 * @param string $experience
 * @return bool
 */
function validExperience($experience) {

    return is_numeric($experience) && $experience >= 0 && $experience <= 50;
}

/**
 * Function to check if a phone number is valid.
 * Customize this function based on the desired phone number format.
 *
 * @param string $phone
 * @return bool
 */
function validPhone($phone) {

    return preg_match('/^\d{10}$/', $phone);
}

/**
 * Function to check if an email address is valid.
 *
 * @param string $email
 * @return bool
 */
function validEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}


