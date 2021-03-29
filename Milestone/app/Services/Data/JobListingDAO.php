<?php
namespace App\Services\Data;

use Carbon\Exceptions\Exception;
use App\Services\Data\Connection\DBConnect;
use App\Models\JobListingModel;

class JobListingDAO
{

    private $conn;
    private $connection;
    public function __construct()
    {
        $this->conn = new DBConnect();
        $this->connection = $this->conn->connect();
    }
    
    // adds a job listing to the table
    public function addJobListing(JobListingModel $jobListing)
    {
        try
        {
            $dbQuery= "INSERT INTO joblisting (TITLE, STARTDATE, ENDDATE, DESCRIPTION, QUALIFICATIONS, COMPANY, POSITION, SCHEDULE, PAY)
                                VALUES ('" . $jobListing->getTitle() . "', '" . $jobListing->getStartDate() . "', '" . $jobListing->getEndDate() . "', '" . $jobListing->getDescription() . "', '" . $jobListing->getQualifications() . "', '" . $jobListing->getCompany() . "', '" . $jobListing->getPosition() . "', '" . $jobListing->getSchedule() . "', '" . $jobListing->getPay() . "')";
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
    
    // updates a job listing's information based on a given JobListingModel object
    public function updateJobListing(JobListingModel $jobListing)
    {
        try
        {
            
            $dbQuery= "UPDATE joblisting
                                SET TITLE = '" . $jobListing->getTitle() . "', STARTDATE = '" . $jobListing->getStartDate() . "', ENDDATE = '" . $jobListing->getEndDate() . "', DESCRIPTION = '" . $jobListing->getDescription() . "', QUALIFICATIONS = '" . $jobListing->getQualifications() . "', COMPANY = '" . $jobListing->getCompany() . "', POSITION = '" . $jobListing->getPosition() . "', SCHEDULE = '" . $jobListing->getSchedule() . "', PAY = '" . $jobListing->getPay() . "', ACTIVE = '" . $jobListing->getActive() . "'
                                WHERE ID = '" . $jobListing->getID() . "'";
            if ($this->connection->query($dbQuery))
            {
                $this->connection->close();
                return true;
            }
            else
            {
                $this->connection->close();
                return false;
            }
        }
        catch (Exception $e)
        {
        }
    }
    
    // gets a job listing from the database given a JobListingModel object
    public function getJobListing(JobListingModel $jobListing)
    {
        $jobListingID = $jobListing->getID();
        try
        {
            $dbQuery= "SELECT * FROM joblisting WHERE ID = '" . $jobListingID . "'";
            $result = $this->connection->query($dbQuery);
            if (mysqli_num_rows($result) == 1)
            {
                $row = mysqli_fetch_assoc($result);
                $id = $row['ID'];
                $title = $row['TITLE'];
                $startDate = $row['STARTDATE'];
                $endDate = $row['ENDDATE'];
                $description = $row['DESCRIPTION'];
                $qualifications = $row['QUALIFICATIONS'];
                $company = $row['COMPANY'];
                $position = $row['POSITION'];
                $schedule = $row['SCHEDULE'];
                $pay = $row['PAY'];
                $active = $row['ACTIVE'];
                $jobListing = new JobListingModel($id, $title, $startDate, $endDate, $description, $qualifications, $company, $position, $schedule, $pay, $active);
                mysqli_free_result($result);
                $this->connection->close();
                return $jobListing;
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
    
    // returns all job listings from the table as an array
    public function getAllJobListings()
    {
        try
        {
            $dbQuery= "SELECT * FROM joblisting";
            $result = $this->connection->query($dbQuery);
            $jobListings = array();
            while ($row = mysqli_fetch_assoc($result))
            {
                $jobListings[] = new JobListingModel($row['ID'], $row['TITLE'], $row['STARTDATE'], $row['ENDDATE'], $row['DESCRIPTION'], $row['QUALIFICATIONS'], $row['COMPANY'], $row['POSITION'], $row['SCHEDULE'], $row['PAY'], $row['ACTIVE']);
            }
            mysqli_free_result($result);
            $this->connection->close();
            return $jobListings;
        }
        catch (Exception $e)
        {
        }
    }
    
    // deletes a job listing given a JobListingModel object
    public function deleteJobListing(JobListingModel $jobListing)
    {
        try
        {
            $jobListingID = $jobListing->getID();
            $dbQuery= "DELETE FROM joblisting WHERE ID = '" . $jobListingID . "'";
            $this->connection->query($dbQuery);
            $this->connection->close();
            return true;
        }
        catch (Exception $e)
        {
            return false;
        }
    }
    
    // returns all active job listings from the table as an array
    public function getActiveJobListings()
    {
        try
        {
            $dbQuery= "SELECT * FROM joblisting WHERE ACTIVE = 1 LIMIT 10";
            $result = $this->connection->query($dbQuery);
            $jobListings = array();
            while ($row = mysqli_fetch_assoc($result))
            {
                $jobListings[] = new JobListingModel($row['ID'], $row['TITLE'], $row['STARTDATE'], $row['ENDDATE'], $row['DESCRIPTION'], $row['QUALIFICATIONS'], $row['COMPANY'], $row['POSITION'], $row['SCHEDULE'], $row['PAY'], $row['ACTIVE']);
            }
            mysqli_free_result($result);
            $this->connection->close();
            return $jobListings;
        }
        catch (Exception $e)
        {
        }
    }
    
    // returns all active job listings from the table as an array
    public function getInactiveJobListings()
    {
        try
        {
            $dbQuery= "SELECT * FROM joblisting WHERE ACTIVE = 0";
            $result = $this->connection->query($dbQuery);
            $jobListings = array();
            while ($row = mysqli_fetch_assoc($result))
            {
                $jobListings[] = new JobListingModel($row['ID'], $row['TITLE'], $row['STARTDATE'], $row['ENDDATE'], $row['DESCRIPTION'], $row['QUALIFICATIONS'], $row['COMPANY'], $row['POSITION'], $row['SCHEDULE'], $row['PAY'], $row['ACTIVE']);
            }
            mysqli_free_result($result);
            $this->connection->close();
            return $jobListings;
        }
        catch (Exception $e)
        {
        }
    }
    
    // gets a job listing from the database given the id of the job listing
    public function getJobListingFromID(int $jobListingID)
    {
        try
        {
            $dbQuery= "SELECT * FROM joblisting WHERE ID = '" . $jobListingID . "'";
            $result = $this->connection->query($dbQuery);
            if (mysqli_num_rows($result) == 1)
            {
                $row = mysqli_fetch_assoc($result);
                $id = $row['ID'];
                $title = $row['TITLE'];
                $startDate = $row['STARTDATE'];
                $endDate = $row['ENDDATE'];
                $description = $row['DESCRIPTION'];
                $qualifications = $row['QUALIFICATIONS'];
                $company = $row['COMPANY'];
                $position = $row['POSITION'];
                $schedule = $row['SCHEDULE'];
                $pay = $row['PAY'];
                $active = $row['ACTIVE'];
                $jobListing = new JobListingModel($id, $title, $startDate, $endDate, $description, $qualifications, $company, $position, $schedule, $pay, $active);
                mysqli_free_result($result);
                $this->connection->close();
                return $jobListing;
            }
            else
            {
                $this->connection->close();
                return null;
            }
        }
        catch (Exception $e)
        {
        }
    }
    
    public function searchJobListings(string $query)
    {
        try
        {
            $dbQuery= "SELECT * FROM joblisting WHERE TITLE LIKE '%" . $query . "%' OR DESCRIPTION LIKE '%" . $query ."%' OR POSITION LIKE '%" . $query . "%' OR COMPANY LIKE '%" . $query . "%'";
            if($result = $this->connection->query($dbQuery))
            {
                $jobListings = array();
                while($row = mysqli_fetch_assoc($result))
                {
                    $id = $row['ID'];
                    $title = $row['TITLE'];
                    $startDate = $row['STARTDATE'];
                    $endDate = $row['ENDDATE'];
                    $description = $row['DESCRIPTION'];
                    $qualifications = $row['QUALIFICATIONS'];
                    $company = $row['COMPANY'];
                    $position = $row['POSITION'];
                    $schedule = $row['SCHEDULE'];
                    $pay = $row['PAY'];
                    $active = $row['ACTIVE'];
                    $jobListing = new JobListingModel($id, $title, $startDate, $endDate, $description, $qualifications, $company, $position, $schedule, $pay, $active);
                    $jobListings[] = $jobListing;
                }
                return $jobListings;
            }
            else
            {
                echo mysqli_error($this->conn);
            }
        }
        catch (Exception $e)
        {
            
        }
    }
    
}

