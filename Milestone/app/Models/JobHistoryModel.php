<?php
namespace App\Models;

class JobHistoryModel
{
    //start date and end date held in YYYY-MM-DD form. Make this more visually appealing?
    private $id, $title, $startDate, $endDate, $description, $company, $profileID, $jobListingID;
    
    public function __construct($id, $title, $startDate, $endDate, $description, $company, $profileID, $jobListingID)
    {
        $this->id = $id;
        $this->title = $title;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->description = $description;
        $this->company = $company;
        $this->profileID = $profileID;
        $this->jobListingID = $jobListingID;
    }
    
    public function getID()
    {
        return $this->id;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function getStartDate()
    {
        return $this->startDate;
    }
    public function getEndDate()
    {
        return $this->endDate;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getCompany()
    {
        return $this->company;
    }
    public function getProfileID()
    {
        return $this->profileID;
    }
    public function getJobListingID()
    {
        return $this->jobListingID;
    }
}

