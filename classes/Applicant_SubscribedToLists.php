<?php

/**
 * Class Applicant_SubscribedToLists
 * Represents an applicant subscribed to mailing lists.
 */
class Applicant_SubscribedToLists extends applicant
{
    private $selectionsJobs = [];
    private $selectionsVerticals = [];

    // Getters and Setters
    public function getSelectionsJobs()
    {
        return $this->selectionsJobs;
    }

    public function setSelectionsJobs($selectionsJobs)
    {
        $this->selectionsJobs = $selectionsJobs;
    }

    public function getSelectionsVerticals()
    {
        return $this->selectionsVerticals;
    }

    public function setSelectionsVerticals($selectionsVerticals)
    {
        $this->selectionsVerticals = $selectionsVerticals;
    }
}

