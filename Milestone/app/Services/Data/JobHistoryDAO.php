<?php
namespace App\Services\Data;

use App\Models\JobHistoryModel;
use App\Models\ProfileModel;
use App\Services\Data\Connection\DBConnect;
use Carbon\Exceptions\Exception;

class JobHistoryDAO
{

    private $conn;
    private $connection;
    public function __construct()
    {
        $this->conn = new DBConnect();
        $this->connection = $this->conn->connect();
    }
    
    // Adds a job history to the database
    public function addJobHistory(JobHistoryModel $jobHistory)
    {
        try
        {
            $dbQuery= "INSERT INTO jobhistory (TITLE, STARTDATE, ENDDATE, DESCRIPTION, COMPANY, PROFILEID)
                                VALUES ('" . $jobHistory->getTitle() . "', '" . $jobHistory->getStartDate() . "', '" . $jobHistory->getEndDate() . "', '" . $jobHistory->getDescription() . "', '" . $jobHistory->getCompany() . "', '" . $jobHistory->getProfileID() . "')";
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
    
    // Gets a job history from the table given a JobHistoryModel object
    public function getJobHistory(JobHistoryModel $jobHistory)
    {
        $jobHistoryID = $jobHistory->getID();
        try
        {
            $dbQuery= "SELECT * FROM jobhistory WHERE ID = '" . $jobHistoryID . "'";
            $result = $this->connection->query($dbQuery);
            if (mysqli_num_rows($result) == 1)
            {
                $row = mysqli_fetch_assoc($result);
                $id = $row['ID'];
                $title = $row['TITLE'];
                $startDate = $row['STARTDATE'];
                $endDate = $row['ENDDATE'];
                $description = $row['DESCRIPTION'];
                $company = $row['COMPANY'];
                $profileID = $row['PROFILEID'];
                $jobListingID = $row['JOBLISTINGID'];
                $jobHistory = new JobHistoryModel($id, $title, $startDate, $endDate, $description, $company, $profileID, $jobListingID);
                mysqli_free_result($result);
                $this->connection->close();
                return $jobHistory;
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
    
    // updates a job history in the table
    public function updateJobHistory(JobHistoryModel $jobHistory)
    {
        try
        {
            
            $dbQuery= "UPDATE jobhistory
                                SET STARTDATE = '" . $jobHistory->getStartDate() . "', ENDDATE = '" . $jobHistory->getEndDate() . "', DESCRIPTION = '" . $jobHistory->getDescription() . "', COMPANY = '" . $jobHistory->getCompany() . "', TITLE = '" . $jobHistory->getTitle() . "'
                                WHERE ID = '" . $jobHistory->getID() . "'";
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
    
    // deletes a job history from the database given an JobHistoryModel object
    public function deleteJobHistory(JobHistoryModel $jobHistory)
    {
        try
        {
            $jobHistory = $jobHistory->getID();
            $dbQuery= "DELETE FROM jobhistory WHERE ID = '" . $jobHistory . "'";
            $this->connection->query($dbQuery);
            $this->connection->close();
            return true;
        }
        catch (Exception $e)
        {
            return false;
        }
    }
    
    // Gets a user's full job history from the table given a UserInfo object
    public function getJobHistoryFromUserInfo(ProfileModel $userInfo)
    {
        $profileID = $userInfo->getID();
        try
        {
            $dbQuery= "SELECT * FROM jobhistory WHERE PROFILEID = '" . $profileID . "'";
            $result = $this->connection->query($dbQuery);
            $jobHistories = array();
            while ($row = mysqli_fetch_assoc($result))
            {
                $id = $row['ID'];
                $startDate = $row['STARTDATE'];
                $endDate = $row['ENDDATE'];
                $description = $row['DESCRIPTION'];
                $company = $row['COMPANY'];
                $title = $row['TITLE'];
                $profileID = $row['PROFILEID'];
                $jobListingID = $row['JOBLISTINGID'];
                $jobHistory = new JobHistoryModel($id, $title, $startDate, $endDate, $description, $company, $profileID, $jobListingID);
                $jobHistories[] = $jobHistory;
            }
            mysqli_free_result($result);
            $this->connection->close();
            return $jobHistories;
        }
        catch (Exception $e)
        {
        }
    }
    
    // Gets an edcuation from the table given the ID of the education object
    public function getJobHistoryFromID(int $jobHistoryID)
    {
        try
        {
            $dbQuery= "SELECT * FROM jobhistory WHERE ID = '" . $jobHistoryID . "'";
            $result = $this->connection->query($dbQuery);
            if (mysqli_num_rows($result) == 1)
            {
                $row = mysqli_fetch_assoc($result);
                $id = $row['ID'];
                $startDate = $row['STARTDATE'];
                $endDate = $row['ENDDATE'];
                $description = $row['DESCRIPTION'];
                $company = $row['COMPANY'];
                $title = $row['TITLE'];
                $profileID = $row['PROFILEID'];
                $jobListingID = $row['JOBLISTINGID'];
                $jobHistory = new JobHistoryModel($id, $title, $startDate, $endDate, $description, $company, $profileID, $jobListingID);
                mysqli_free_result($result);
                $this->connection->close();
                return $jobHistory;
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

