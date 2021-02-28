<?php
namespace App\Models;

class ProfileModel
{
    //declares variables to hold the necessary information for a user profile
    private $id;
    private $email;
    private $phone;
    private $gender;
    private $nationality;
    private $description;
    private $skills;
    private $certifications;
    private $userID;

    //full-args constructor
    public function __construct($id, $email, $phone, $gender, $nationality, $description, $skills, $certifications, $userID)
    {
        $this->id = $id;
        $this->email = $email;
        $this->phone = $phone;
        $this->gender = $gender;
        $this->nationality = $nationality;
        $this->description = $description;
        $this->skills = $skills;
        $this->certifications = $certifications;
        $this->userID = $userID;
    }
    
    //getters(models should be read-only)
    public function getID()
    {
        return $this->id;
    }
    
    public function getEmail()
    {
        return $this->email;
    }
    
    public function getPhone()
    {
        return $this->phone;
    }
    
    public function getGender()
    {
        return $this->gender;
    }
    
    public function getNationality()
    {
        return $this->nationality;
    }
    
    public function getDescription()
    {
        return $this->description;
    }
    
    public function getSkills()
    {
        return $this->skills;
    }
    
    public function getCertifications()
    {
        return $this->certifications;
    }
    
    public function getUserID()
    {
        return $this->userID;
    }
}
?>