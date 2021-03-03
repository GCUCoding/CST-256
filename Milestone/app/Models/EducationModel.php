<?php 
namespace App\Models;
class EducationModel
{
    private $id;
    //start date and end date held in YYYY-MM-DD form. Make this more visually appealing at least on the view side
    private $startDate;
    private $endDate;
    private $institution;
    private $gpa;
    private $title;
    private $profileID;
    
    //full-args constructor
    public function __construct($id, $startDate, $endDate, $institution, $gpa, $title, $profileID)
    {
        $this->id = $id;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->institution = $institution;
        $this->gpa = $gpa;
        $this->title = $title;
        $this->profileID = $profileID;
    }
    
    public function getID()
    {
        return $this->id;
    }
    public function getStartDate()
    {
        return $this->startDate;
    }
    public function getEndDate()
    {
        return $this->endDate;
    }
    public function getInstitution()
    {
        return $this->institution;
    }
    public function getGPA()
    {
        return $this->gpa;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function getProfileID()
    {
        return $this->profileID;
    }
    
}