<?php
namespace App\Services\Data;

use App\Services\Data\Connection\DBConnect;
use Carbon\Exceptions\Exception;
use App\Models\EducationModel;
use App\Models\ProfileModel;

class EducationDAO
{
    private $conn;
    private $connection;
    public function __construct()
    {
        $this->conn = new DBConnect();
        $this->connection = $this->conn->connect();
    }
    
    // Adds an education to the database
    public function addEducation(EducationModel $education)
    {
        try
        {
            $dbQuery= "INSERT INTO education (STARTDATE, ENDDATE, INSTITUTION, GPA, TITLE, PROFILEID)
                                VALUES ('" . $education->getStartDate() . "', '" . $education->getEndDate() . "', '" . $education->getInstitution() . "', '" . $education->getGPA() . "', '" . $education->getTitle() . "', '" . $education->getProfileID() . "')";
            if ($this->connection->query($dbQuery))
            {
                $this->connection->close();
                return true;
            }
            else
            {
                echo mysqli_error($this->conn);
                $this->connection->close();
                return false;
            }
        }
        catch (Exception $e)
        {
        }
    }
    
    // Gets an education from the table given an EducationModel object
    public function getEducation(EducationModel $education)
    {
        $educationID = $education->getID();
        try
        {
            $dbQuery= "SELECT * FROM education WHERE ID = '" . $educationID . "'";
            $result = $this->connection->query($dbQuery);
            if (mysqli_num_rows($result) == 1)
            {
                $row = mysqli_fetch_assoc($result);
                $id = $row['ID'];
                $startDate = $row['STARTDATE'];
                $endDate = $row['ENDDATE'];
                $institution = $row['INSTITUTION'];
                $gpa = $row['GPA'];
                $title = $row['TITLE'];
                $profileID = $row['PROFILEID'];
                $education = new EducationModel($id, $startDate, $endDate, $institution, $gpa, $title, $profileID);
                mysqli_free_result($result);
                $this->connection->close();
                return $education;
            }
            else
            {
                $this->connection->close();
                return - 1;
            }
        }
        catch (Exception $e)
        {
        }
    }
    
    // updates an education in the table
    public function updateEducation(EducationModel $education)
    {
        try
        {
            
            $dbQuery= "UPDATE education
                                SET STARTDATE = '" . $education->getStartDate() . "', ENDDATE = '" . $education->getEndDate() . "', INSTITUTION = '" . $education->getInstitution() . "', GPA = '" . $education->getGPA() . "', TITLE = '" . $education->getTitle() . "'
                                WHERE ID = '" . $education->getID() . "'";
            if ($this->connection->query($dbQuery))
            {
                $this->connection->close();
                return true;
            }
            else
            {
                echo mysqli_error($this->conn);
                $this->connection->close();
                return false;
            }
        }
        catch (Exception $e)
        {
        }
    }
    
    // deletes an education from the database given an EducationModel object
    public function deleteEducation(EducationModel $education)
    {
        try
        {
            $educationID = $education->getID();
            $dbQuery= "DELETE FROM education WHERE ID = '" . $educationID . "'";
            $this->connection->query($dbQuery);
            $this->connection->close();
            return true;
        }
        catch (Exception $e)
        {
            return false;
        }
    }
    
    // Gets an education from the table given a UserInfo object
    public function getEducationFromProfile(ProfileModel $userInfo)
    {
        $profileID = $userInfo->getID();
        try
        {
            $educations = array();
            $dbQuery= "SELECT * FROM education WHERE PROFILEID = '" . $profileID . "'";
            $result = $this->connection->query($dbQuery);
            while ($row = mysqli_fetch_assoc($result))
            {
                $id = $row['ID'];
                $startDate = $row['STARTDATE'];
                $endDate = $row['ENDDATE'];
                $institution = $row['INSTITUTION'];
                $gpa = $row['GPA'];
                $title = $row['TITLE'];
                $profileID = $row['PROFILEID'];
                $education = new EducationModel($id, $startDate, $endDate, $institution, $gpa, $title, $profileID);
                $educations[] = $education;
            }
            mysqli_free_result($result);
            $this->connection->close();
            return $educations;
        }
        catch (Exception $e)
        {
        }
    }
    
    // Gets an edcuation from the table given the ID of the education object
    public function getEducationFromID(int $educationID)
    {
        try
        {
            $dbQuery= "SELECT * FROM education WHERE ID = '" . $educationID . "'";
            $result = $this->connection->query($dbQuery);
            if (mysqli_num_rows($result) == 1)
            {
                $row = mysqli_fetch_assoc($result);
                $id = $row['ID'];
                $startDate = $row['STARTDATE'];
                $endDate = $row['ENDDATE'];
                $institution = $row['INSTITUTION'];
                $gpa = $row['GPA'];
                $title = $row['TITLE'];
                $profileID = $row['PROFILEID'];
                $education = new EducationModel($id, $startDate, $endDate, $institution, $gpa, $title, $profileID);
                mysqli_free_result($result);
                $this->connection->close();
                return $education;
            }
            else
            {
                $this->connection->close();
                return - 1;
            }
        }
        catch (Exception $e)
        {
        }
    }
}

