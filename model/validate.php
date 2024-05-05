<?php




function validFName($fName)
{
    return strlen(trim($fName)) >= 3;
}

function validLName($lName)
{
    return strlen(trim($lName)) >= 3;
}

function validEmail($email)
{
    return strlen(trim($email)) >= 3;
}
function validPhone($phone)
{
    return strlen(trim($phone)) >= 3;
}

