<?php
namespace App\Models;

class JobListingModel
{
    private $id;
    private $title;
    private $startDate;
    private $endDate;
    private $description;
    private $qualifications;
    private $company;
    private $position;
    private $schedule;
    private $pay;
    private $active;
    
    public function __construct($id, $title, $startDate, $endDate, $description, $qualifications, $company, $position, $schedule, $pay, $active)
    {
        $this->id = $id;
        $this->title = $title;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->description = $description;
        $this->qualifications = $qualifications;
        $this->company = $company;
        $this->position = $position;
        $this->schedule = $schedule;
        $this->pay = $pay;
        $this->active = $active;
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
    public function getQualifications()
    {
        return $this->qualifications;
    }
    public function getCompany()
    {
        return $this->company;
    }
    public function getPosition()
    {
        return $this->position;
    }
    public function getSchedule()
    {
        return $this->schedule;
    }
    public function getPay()
    {
        return $this->pay;
    }
    public function getActive()
    {
        return $this->active;
    }
}

