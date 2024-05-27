<?php
/**
 * Class Applicant
 * Represents a job applicant.
 */
class applicant
{
    private $fname;
    private $lname;
    private $email;
    private $state;
    private $phone;
    private $github;
    private $experience;
    private $relocate;
    private $bio;
    private $profilePic;


    public function __construct($fname, $lname, $email, $state, $phone)
    {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->email = $email;
        $this->state = $state;
        $this->phone = $phone;
    }

    // Getters and Setters
    public function getFname()
    {
        return $this->fname;
    }

    public function setFname($fname)
    {
        $this->fname = $fname;
    }

    public function getLname()
    {
        return $this->lname;
    }

    public function setLname($lname)
    {
        $this->lname = $lname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getGithub()
    {
        return $this->github;
    }

    public function setGithub($github)
    {
        $this->github = $github;
    }

    public function getExperience()
    {
        return $this->experience;
    }

    public function setExperience($experience)
    {
        $this->experience = $experience;
    }

    public function getRelocate()
    {
        return $this->relocate;
    }

    public function setRelocate($relocate)
    {
        $this->relocate = $relocate;
    }

    public function getBio()
    {
        return $this->bio;
    }

    public function setBio($bio)
    {
        $this->bio = $bio;
    }

    public function getProfilePic()
    {
        return $this->profilePic;
    }

    public function setProfilePic($profilePic)
    {
        $this->profilePic = $profilePic;
    }

}
