<?php
namespace App\Services\Data;

use Carbon\Exceptions\Exception;
use App\Models\GroupMemberModel;
use App\Models\GroupModel;
use App\Models\ProfileModel;
use App\Models\UserModel;
use App\Models\EducationModel;
use App\Models\JobListingModel;
use App\Models\JobHistoryModel;

// provides access to a database
class DataAccessObject
{

    // declares fields necessary for a database connection
    private $conn;

    private $servername = "localhost";

    private $username = "root";

    private $password = "root";

    private $dbName = "Milestone";

    private $dbQuery;

    // no-args contructor creates a connection with the database
    public function __construct()
    {
        $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbName);
    }

    /*
     * ====================================================================================================================
     * USER STUFF
     * ====================================================================================================================
     */
    // checks the data in the database to ensure that a provided username is unique
    public function isUnique($username)
    {
        try
        {
            $this->dbQuery = "SELECT USERNAME FROM user WHERE USERNAME = '" . $username . "'";
            $result = mysqli_query($this->conn, $this->dbQuery);
            if (mysqli_num_rows($result) == 0)
            {
                return true;
            }
            else
            {
                mysqli_free_result($result);
                return false;
            }
        }
        catch (Exception $e)
        {
        }
    }

    // attempts to add a user to the database
    public function AddUser(UserModel $user)
    {
        try
        {
            if ($this->isUnique($user->getUsername()))
            {
                $this->dbQuery = "INSERT INTO user (USERNAME, PASSWORD) VALUES ('" . $user->getUsername() . "', '" . $user->getPassword() . "')";
                mysqli_query($this->conn, $this->dbQuery);
                mysqli_close($this->conn);
                return true;
            }
            else
            {
                return false;
            }
        }
        catch (Exception $e)
        {
        }
    }

    // authenticates whether a user attempting to sign in is valid
    public function Authenticate($username, $password)
    {
        try
        {
            $this->dbQuery = "SELECT * FROM user WHERE USERNAME = '" . $username . "' AND PASSWORD = '" . $password . "'";
            $result = mysqli_query($this->conn, $this->dbQuery);
            if (mysqli_num_rows($result) == 1)
            {
                mysqli_free_result($result);
                mysqli_close($this->conn);
                return true;
            }
            else
            {
                mysqli_close($this->conn);
                return false;
            }
        }
        catch (Exception $e)
        {
        }
    }

    // returns the user ID of a user in the database given the username
    public function getUserID($username)
    {
        try
        {
            $this->dbQuery = "SELECT ID FROM user WHERE USERNAME = '" . $username . "'";
            $result = mysqli_query($this->conn, $this->dbQuery);
            if (mysqli_num_rows($result) == 1)
            {
                $id = mysqli_fetch_assoc($result)['ID'];
                mysqli_free_result($result);
                mysqli_close($this->conn);
                return $id;
            }
            else
            {
                mysqli_close($this->conn);
                return - 1;
            }
        }
        catch (Exception $e)
        {
        }
    }

    // returns a user's role given their username
    public function getUserRole($username)
    {
        try
        {
            $this->dbQuery = "SELECT ROLE FROM user WHERE USERNAME = '" . $username . "'";
            $result = mysqli_query($this->conn, $this->dbQuery);
            if (mysqli_num_rows($result) == 1)
            {
                $role = mysqli_fetch_assoc($result)['ROLE'];
                mysqli_free_result($result);
                mysqli_close($this->conn);
                return $role;
            }
            else
            {
                mysqli_close($this->conn);
                return - 1;
            }
        }
        catch (Exception $e)
        {
        }
    }

    // gets a user given a user's ID
    public function getUserFromID($id)
    {
        try
        {
            $this->dbQuery = "SELECT * FROM user WHERE ID = '" . $id . "'";
            $result = mysqli_query($this->conn, $this->dbQuery);
            if (mysqli_num_rows($result) == 1)
            {
                $row = mysqli_fetch_assoc($result);
                $username = $row['USERNAME'];
                $password = $row['PASSWORD'];
                $role = $row['ROLE'];
                $user = new UserModel($id, $username, $password, $role);
                mysqli_free_result($result);
                mysqli_close($this->conn);
                return $user;
            }
            else
            {
                mysqli_close($this->conn);
                return - 1;
            }
        }
        catch (Exception $e)
        {
        }
    }

    // gets all users in the user's database and returns them in the form of an array
    public function getAllUsers()
    {
        try
        {
            $this->dbQuery = "SELECT * FROM user";
            $result = mysqli_query($this->conn, $this->dbQuery);
            $users = array();
            while ($row = mysqli_fetch_assoc($result))
            {
                $users[] = new UserModel($row['ID'], $row['USERNAME'], $row['PASSWORD'], $row['ROLE']);
            }
            mysqli_free_result($result);
            mysqli_close($this->conn);
            return $users;
        }
        catch (Exception $e)
        {
        }
    }

    // updates a user in the database given a UserModel object
    public function updateUser(UserModel $user)
    {
        try
        {

            $this->dbQuery = "UPDATE user 
                                SET USERNAME = '" . $user->getUsername() . "', PASSWORD = '" . $user->getPassword() . "', ROLE = '" . $user->getRole() . "' 
                                WHERE ID = '" . $user->getID() . "'";
            if (mysqli_query($this->conn, $this->dbQuery))
            {
                mysqli_close($this->conn);
                return true;
            }
            else
            {
                mysqli_close($this->conn);
                return false;
            }
        }
        catch (Exception $e)
        {
        }
    }

    // gets a user from the database given a username and returns a corresponding UserModel object
    public function getUserFromUsername($username)
    {
        try
        {
            $this->dbQuery = "SELECT * FROM user WHERE USERNAME = '" . $username . "'";
            $result = mysqli_query($this->conn, $this->dbQuery);
            if (mysqli_num_rows($result) == 1)
            {
                $row = mysqli_fetch_assoc($result);
                $id = $row['ID'];
                $password = $row['PASSWORD'];
                $role = $row['ROLE'];
                $user = new UserModel($id, $username, $password, $role);
                mysqli_free_result($result);
                mysqli_close($this->conn);
                return $user;
            }
            else
            {
                mysqli_close($this->conn);
                return - 1;
            }
        }
        catch (Exception $e)
        {
        }
    }

    // deletes a user from the database given a UserModel object
    public function deleteUser(UserModel $user)
    {
        try
        {
            $userID = $user->getID();
            $this->dbQuery = "DELETE FROM user WHERE ID = '" . $userID . "'";
            mysqli_query($this->conn, $this->dbQuery);
            mysqli_close($this->conn);
            return true;
        }
        catch (Exception $e)
        {
            return false;
        }
    }

    /*
     * ====================================================================================================================
     * PROFILE STUFF
     * ====================================================================================================================
     */
    // adds a user's UserInfo into the userinfo table, given a foreign key within a ProfileModel object
    public function addUserInfo(ProfileModel $userInfo)
    {
        try
        {
            $this->dbQuery = "INSERT INTO userinfo (USERID) 
                                VALUES ('" . $userInfo->getUserID() . "')";
            if (mysqli_query($this->conn, $this->dbQuery))
            {
                mysqli_close($this->conn);
                return true;
            }
            else
            {
                echo mysqli_error($this->conn);
                mysqli_close($this->conn);
                return false;
            }
        }
        catch (Exception $e)
        {
        }
    }

    // gets a user's profile information given a UserModel object
    // returns a ProfileModel object
    public function getUserInfo(UserModel $user)
    {
        $userID = $user->getID();
        try
        {
            $this->dbQuery = "SELECT * FROM userinfo WHERE USERID = '" . $userID . "'";
            $result = mysqli_query($this->conn, $this->dbQuery);
            if (mysqli_num_rows($result) == 1)
            {
                $row = mysqli_fetch_assoc($result);
                $id = $row['ID'];
                $email = $row['EMAIL'];
                $phone = $row['PHONE'];
                $gender = $row['GENDER'];
                $nationality = $row['NATIONALITY'];
                $description = $row['DESCRIPTION'];
                $skills = $row['SKILLS'];
                $certifications = $row['CERTIFICATIONS'];
                $userInfo = new ProfileModel($id, $email, $phone, $gender, $nationality, $description, $skills, $certifications, $userID);
                mysqli_free_result($result);
                mysqli_close($this->conn);
                return $userInfo;
            }
            else
            {
                mysqli_close($this->conn);
                return - 1;
            }
        }
        catch (Exception $e)
        {
        }
    }

    // updates a user's profile information based on a given ProfileModel object
    public function updateUserInfo(ProfileModel $userInfo)
    {
        try
        {

            $this->dbQuery = "UPDATE userinfo
                                SET EMAIL = '" . $userInfo->getEmail() . "', PHONE = '" . $userInfo->getPhone() . "', GENDER = '" . $userInfo->getGender() . "', NATIONALITY = '" . $userInfo->getNationality() . "', DESCRIPTION = '" . $userInfo->getDescription() . "', SKILLS = '" . $userInfo->getSkills() . "', CERTIFICATIONS = '" . $userInfo->getCertifications() . "'
                                WHERE ID = '" . $userInfo->getID() . "'";
            if (mysqli_query($this->conn, $this->dbQuery))
            {
                mysqli_close($this->conn);
                return true;
            }
            else
            {
                mysqli_close($this->conn);
                return false;
            }
        }
        catch (Exception $e)
        {
        }
    }

    // gets a user's profile information given the ID of the profile
    public function getUserInfoFromID($profileID)
    {
        try
        {
            $this->dbQuery = "SELECT * FROM userinfo WHERE ID = '" . $profileID . "'";
            $result = mysqli_query($this->conn, $this->dbQuery);
            if (mysqli_num_rows($result) == 1)
            {
                $row = mysqli_fetch_assoc($result);
                $id = $row['ID'];
                $email = $row['EMAIL'];
                $phone = $row['PHONE'];
                $gender = $row['GENDER'];
                $nationality = $row['NATIONALITY'];
                $description = $row['DESCRIPTION'];
                $skills = $row['SKILLS'];
                $certifications = $row['CERTIFICATIONS'];
                $userID = $row['USERID'];
                $userInfo = new ProfileModel($id, $email, $phone, $gender, $nationality, $description, $skills, $certifications, $userID);
                mysqli_free_result($result);
                mysqli_close($this->conn);
                return $userInfo;
            }
            else
            {
                mysqli_close($this->conn);
                return - 1;
            }
        }
        catch (Exception $e)
        {
        }
    }

    // gets a user's profile information given the user's ID
    public function getUserInfoFromUserID($userID)
    {
        try
        {
            $this->dbQuery = "SELECT * FROM userinfo WHERE USERID = '" . $userID . "'";
            $result = mysqli_query($this->conn, $this->dbQuery);
            if (mysqli_num_rows($result) == 1)
            {
                $row = mysqli_fetch_assoc($result);
                $id = $row['ID'];
                $email = $row['EMAIL'];
                $phone = $row['PHONE'];
                $gender = $row['GENDER'];
                $nationality = $row['NATIONALITY'];
                $description = $row['DESCRIPTION'];
                $skills = $row['SKILLS'];
                $certifications = $row['CERTIFICATIONS'];
                $userID = $row['USERID'];
                $userInfo = new ProfileModel($id, $email, $phone, $gender, $nationality, $description, $skills, $certifications, $userID);
                mysqli_free_result($result);
                mysqli_close($this->conn);
                return $userInfo;
            }
            else
            {
                mysqli_close($this->conn);
                return - 1;
            }
        }
        catch (Exception $e)
        {
        }
    }

    /*
     * ====================================================================================================================
     * EDUCATION STUFF
     * ====================================================================================================================
     */
    // Adds an education to the database
    public function addEducation(EducationModel $education)
    {
        try
        {
            $this->dbQuery = "INSERT INTO education (PROFILEID)
                                VALUES ('" . $education->getProfileID() . "')";
            if (mysqli_query($this->conn, $this->dbQuery))
            {
                mysqli_close($this->conn);
                return true;
            }
            else
            {
                echo mysqli_error($this->conn);
                mysqli_close($this->conn);
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
            $this->dbQuery = "SELECT * FROM education WHERE ID = '" . $educationID . "'";
            $result = mysqli_query($this->conn, $this->dbQuery);
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
                mysqli_close($this->conn);
                return $education;
            }
            else
            {
                mysqli_close($this->conn);
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

            $this->dbQuery = "UPDATE education
                                SET STARTDATE = '" . $education->getStartDate() . "', ENDDATE = '" . $education->getEndDate() . "', INSTITUTION = '" . $education->getInstitution() . "', GPA = '" . $education->getGPA() . "', TITLE = '" . $education->getTitle() . "'
                                WHERE ID = '" . $education->getID() . "'";
            if (mysqli_query($this->conn, $this->dbQuery))
            {
                mysqli_close($this->conn);
                return true;
            }
            else
            {
                echo mysqli_error($this->conn);
                mysqli_close($this->conn);
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
            $this->dbQuery = "DELETE FROM education WHERE ID = '" . $educationID . "'";
            mysqli_query($this->conn, $this->dbQuery);
            mysqli_close($this->conn);
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
            $this->dbQuery = "SELECT * FROM education WHERE PROFILEID = '" . $profileID . "'";
            $result = mysqli_query($this->conn, $this->dbQuery);
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
            mysqli_close($this->conn);
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
            $this->dbQuery = "SELECT * FROM education WHERE ID = '" . $educationID . "'";
            $result = mysqli_query($this->conn, $this->dbQuery);
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
                mysqli_close($this->conn);
                return $education;
            }
            else
            {
                mysqli_close($this->conn);
                return - 1;
            }
        }
        catch (Exception $e)
        {
        }
    }

    /*
     * ====================================================================================================================
     * JOB LISTING STUFF
     * ====================================================================================================================
     */
    // adds a job listing to the table
    public function addJobListing(JobListingModel $jobListing)
    {
        try
        {
            $this->dbQuery = "INSERT INTO joblisting (TITLE, STARTDATE, ENDDATE, DESCRIPTION, QUALIFICATIONS, COMPANY, POSITION, SCHEDULE, PAY)
                                VALUES ('" . $jobListing->getTitle() . "', '" . $jobListing->getStartDate() . "', '" . $jobListing->getEndDate() . "', '" . $jobListing->getDescription() . "', '" . $jobListing->getQualifications() . "', '" . $jobListing->getCompany() . "', '" . $jobListing->getPosition() . "', '" . $jobListing->getSchedule() . "', '" . $jobListing->getPay() . "')";
            if (mysqli_query($this->conn, $this->dbQuery))
            {
                mysqli_close($this->conn);
                return true;
            }
            else
            {
                echo mysqli_error($this->conn);
                mysqli_close($this->conn);
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

            $this->dbQuery = "UPDATE joblisting
                                SET TITLE = '" . $jobListing->getTitle() . "', STARTDATE = '" . $jobListing->getStartDate() . "', ENDDATE = '" . $jobListing->getEndDate() . "', DESCRIPTION = '" . $jobListing->getDescription() . "', QUALIFICATIONS = '" . $jobListing->getQualifications() . "', COMPANY = '" . $jobListing->getCompany() . "', POSITION = '" . $jobListing->getPosition() . "', SCHEDULE = '" . $jobListing->getSchedule() . "', PAY = '" . $jobListing->getPay() . "', ACTIVE = '" . $jobListing->getActive() . "'
                                WHERE ID = '" . $jobListing->getID() . "'";
            if (mysqli_query($this->conn, $this->dbQuery))
            {
                mysqli_close($this->conn);
                return true;
            }
            else
            {
                mysqli_close($this->conn);
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
            $this->dbQuery = "SELECT * FROM joblisting WHERE ID = '" . $jobListingID . "'";
            $result = mysqli_query($this->conn, $this->dbQuery);
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
                mysqli_close($this->conn);
                return $jobListing;
            }
            else
            {
                mysqli_close($this->conn);
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
            $this->dbQuery = "SELECT * FROM joblisting";
            $result = mysqli_query($this->conn, $this->dbQuery);
            $jobListings = array();
            while ($row = mysqli_fetch_assoc($result))
            {
                $jobListings[] = new JobListingModel($row['ID'], $row['TITLE'], $row['STARTDATE'], $row['ENDDATE'], $row['DESCRIPTION'], $row['QUALIFICATIONS'], $row['COMPANY'], $row['POSITION'], $row['SCHEDULE'], $row['PAY'], $row['ACTIVE']);
            }
            mysqli_free_result($result);
            mysqli_close($this->conn);
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
            $this->dbQuery = "DELETE FROM joblisting WHERE ID = '" . $jobListingID . "'";
            mysqli_query($this->conn, $this->dbQuery);
            mysqli_close($this->conn);
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
            $this->dbQuery = "SELECT * FROM joblisting WHERE ACTIVE = 1";
            $result = mysqli_query($this->conn, $this->dbQuery);
            $jobListings = array();
            while ($row = mysqli_fetch_assoc($result))
            {
                $jobListings[] = new JobListingModel($row['ID'], $row['TITLE'], $row['STARTDATE'], $row['ENDDATE'], $row['DESCRIPTION'], $row['QUALIFICATIONS'], $row['COMPANY'], $row['POSITION'], $row['SCHEDULE'], $row['PAY'], $row['ACTIVE']);
            }
            mysqli_free_result($result);
            mysqli_close($this->conn);
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
            $this->dbQuery = "SELECT * FROM joblisting WHERE ACTIVE = 0";
            $result = mysqli_query($this->conn, $this->dbQuery);
            $jobListings = array();
            while ($row = mysqli_fetch_assoc($result))
            {
                $jobListings[] = new JobListingModel($row['ID'], $row['TITLE'], $row['STARTDATE'], $row['ENDDATE'], $row['DESCRIPTION'], $row['QUALIFICATIONS'], $row['COMPANY'], $row['POSITION'], $row['SCHEDULE'], $row['PAY'], $row['ACTIVE']);
            }
            mysqli_free_result($result);
            mysqli_close($this->conn);
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
            $this->dbQuery = "SELECT * FROM joblisting WHERE ID = '" . $jobListingID . "'";
            $result = mysqli_query($this->conn, $this->dbQuery);
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
                mysqli_close($this->conn);
                return $jobListing;
            }
            else
            {
                mysqli_close($this->conn);
                return - 1;
            }
        }
        catch (Exception $e)
        {
        }
    }

    /*
     * ====================================================================================================================
     * JOB HISTORY STUFF
     * ====================================================================================================================
     */
    // Adds a job history to the database
    public function addJobHistory(JobHistoryModel $jobHistory)
    {
        try
        {
            $this->dbQuery = "INSERT INTO jobhistory (TITLE, STARTDATE, ENDDATE, DESCRIPTION, COMPANY, PROFILEID)
                                VALUES ('" . $jobHistory->getTitle() . "', '" . $jobHistory->getStartDate() . "', '" . $jobHistory->getEndDate() . "', '" . $jobHistory->getDescription() . "', '" . $jobHistory->getCompany() . "', '" . $jobHistory->getProfileID() . "')";
            if (mysqli_query($this->conn, $this->dbQuery))
            {
                mysqli_close($this->conn);
                return true;
            }
            else
            {
                echo mysqli_error($this->conn);
                mysqli_close($this->conn);
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
            $this->dbQuery = "SELECT * FROM jobhistory WHERE ID = '" . $jobHistoryID . "'";
            $result = mysqli_query($this->conn, $this->dbQuery);
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
                mysqli_close($this->conn);
                return $jobHistory;
            }
            else
            {
                mysqli_close($this->conn);
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

            $this->dbQuery = "UPDATE jobhistory
                                SET STARTDATE = '" . $jobHistory->getStartDate() . "', ENDDATE = '" . $jobHistory->getEndDate() . "', DESCRIPTION = '" . $jobHistory->getDescription() . "', COMPANY = '" . $jobHistory->getCompany() . "', TITLE = '" . $jobHistory->getTitle() . "'
                                WHERE ID = '" . $jobHistory->getID() . "'";
            if (mysqli_query($this->conn, $this->dbQuery))
            {
                mysqli_close($this->conn);
                return true;
            }
            else
            {
                echo mysqli_error($this->conn);
                mysqli_close($this->conn);
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
            $this->dbQuery = "DELETE FROM jobhistory WHERE ID = '" . $jobHistory . "'";
            mysqli_query($this->conn, $this->dbQuery);
            mysqli_close($this->conn);
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
            $this->dbQuery = "SELECT * FROM jobhistory WHERE PROFILEID = '" . $profileID . "'";
            $result = mysqli_query($this->conn, $this->dbQuery);
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
            mysqli_close($this->conn);
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
            $this->dbQuery = "SELECT * FROM jobhistory WHERE ID = '" . $jobHistoryID . "'";
            $result = mysqli_query($this->conn, $this->dbQuery);
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
                mysqli_close($this->conn);
                return $jobHistory;
            }
            else
            {
                mysqli_close($this->conn);
                return - 1;
            }
        }
        catch (Exception $e)
        {
        }
    }

    /*
     * ====================================================================================================================
     * GROUP STUFF
     * ====================================================================================================================
     */
    // Adds a job history to the database
    public function addGroup(GroupModel $group)
    {
        if ($this->checkUniqueGroup($group))
        {
            try
            {
                $this->dbQuery = "INSERT INTO groups (TITLE, DESCRIPTION)
                                VALUES ('" . $group->getTitle() . "', '" . $group->getDescription() . "')";
                if (mysqli_query($this->conn, $this->dbQuery))
                {
                    mysqli_close($this->conn);
                    return true;
                }
                else
                {
                    echo mysqli_error($this->conn);
                    mysqli_close($this->conn);
                    return false;
                }
            }
            catch (Exception $e)
            {
            }
        }
        else
        {
            echo "Not a unique group.";
        }
    }

    // Gets a job history from the table given a GroupModel object
    public function getGroup(GroupModel $group)
    {
        $groupID = $group->getID();
        try
        {
            $this->dbQuery = "SELECT * FROM groups WHERE ID = '" . $groupID . "'";
            $result = mysqli_query($this->conn, $this->dbQuery);
            if (mysqli_num_rows($result) == 1)
            {
                $row = mysqli_fetch_assoc($result);
                $id = $row['ID'];
                $title = $row['TITLE'];
                $description = $row['DESCRIPTION'];
                $group = new GroupModel($id, $title, $description);
                mysqli_free_result($result);
                mysqli_close($this->conn);
                return $group;
            }
            else
            {
                mysqli_close($this->conn);
                return - 1;
            }
        }
        catch (Exception $e)
        {
        }
    }

    // updates a job history in the table
    public function updateGroup(GroupModel $group)
    {
        try
        {

            $this->dbQuery = "UPDATE groups
                                SET DESCRIPTION = '" . $group->getDescription() . "', TITLE = '" . $group->getTitle() . "'
                                WHERE ID = '" . $group->getID() . "'";
            if (mysqli_query($this->conn, $this->dbQuery))
            {
                mysqli_close($this->conn);
                return true;
            }
            else
            {
                echo mysqli_error($this->conn);
                mysqli_close($this->conn);
                return false;
            }
        }
        catch (Exception $e)
        {
        }
    }

    // deletes a job history from the database given an GroupModel object
    public function deleteGroup(GroupModel $group)
    {
        try
        {
            $groupID = $group->getID();
            $this->dbQuery = "DELETE FROM groups WHERE ID = '" . $groupID . "'";
            mysqli_query($this->conn, $this->dbQuery);
            mysqli_close($this->conn);
            return true;
        }
        catch (Exception $e)
        {
            return false;
        }
    }

    // Gets a user's full job history from the table given a UserInfo object
    public function getGroupsFromUserID(int $userID)
    {
        try
        {
            $this->dbQuery = "SELECT * FROM groups WHERE PROFILEID = '" . $userID . "'";
            $result = mysqli_query($this->conn, $this->dbQuery);
            $groups = array();
            while ($row = mysqli_fetch_assoc($result))
            {
                $id = $row['ID'];
                $description = $row['DESCRIPTION'];
                $title = $row['TITLE'];
                $group = new GroupModel($id, $title, $description);
                $groups[] = $group;
            }
            mysqli_free_result($result);
            mysqli_close($this->conn);
            return $groups;
        }
        catch (Exception $e)
        {
        }
    }
    
    public function getGroupFromTitle(string $groupTitle)
    {
        try
        {
            $this->dbQuery = "SELECT * FROM groups WHERE TITLE = '" . $groupTitle . "'";
            $result = mysqli_query($this->conn, $this->dbQuery);
            if (mysqli_num_rows($result) == 1)
            {
                $row = mysqli_fetch_assoc($result);
                $id = $row['ID'];
                $description = $row['DESCRIPTION'];
                $title = $row['TITLE'];
                $group = new GroupModel($id, $title, $description);
                mysqli_free_result($result);
                mysqli_close($this->conn);
                return $group;
            }
            else
            {
                echo mysqli_error($this->conn);
                mysqli_close($this->conn);
                return - 1;
            }
        }
        catch (Exception $e)
        {
        }
    }

    // Gets an edcuation from the table given the ID of the education object
    public function getGroupFromID(int $groupID)
    {
        try
        {
            $this->dbQuery = "SELECT * FROM groups WHERE ID = '" . $groupID . "'";
            $result = mysqli_query($this->conn, $this->dbQuery);
            if (mysqli_num_rows($result) == 1)
            {
                $row = mysqli_fetch_assoc($result);
                $id = $row['ID'];
                $description = $row['DESCRIPTION'];
                $title = $row['TITLE'];
                $group = new GroupModel($id, $title, $description);
                mysqli_free_result($result);
                mysqli_close($this->conn);
                return $group;
            }
            else
            {
                mysqli_close($this->conn);
                return - 1;
            }
        }
        catch (Exception $e)
        {
        }
    }

    public function checkUniqueGroup(GroupModel $group)
    {
        try
        {
            $this->dbQuery = "SELECT TITLE FROM groups WHERE TITLE = '" . $group->getTitle() . "'";
            $result = mysqli_query($this->conn, $this->dbQuery);
            if (mysqli_num_rows($result) == 0)
            {
                return true;
            }
            else
            {
                mysqli_free_result($result);
                return false;
            }
        }
        catch (Exception $e)
        {
        }
    }

    public function getAllGroups()
    {
        try
        {
            $this->dbQuery = "SELECT * FROM groups";
            if ($result = mysqli_query($this->conn, $this->dbQuery))
            {
                $groups = array();
                while ($row = mysqli_fetch_assoc($result))
                {
                    $id = $row['ID'];
                    $title = $row['TITLE'];
                    $description = $row['DESCRIPTION'];
                    $group = new GroupModel($id, $title, $description);
                    $groups[] = $group;
                }
                mysqli_close($this->conn);
                return $groups;
            }
            else
            {
                echo mysqli_error($this->conn);
                mysqli_close($this->conn);
                return false;
            }
        }
        catch (Exception $e)
        {
        }
    }

    /*
     * ====================================================================================================================
     * GROUP MEMBER STUFF
     * ====================================================================================================================
     */
    // Adds a job history to the database
    public function addGroupMember(GroupMemberModel $groupMember)
    {
        try
        {
            $this->dbQuery = "INSERT INTO groupmember (USERID, GROUPID, ISADMINORLEADER)
                                VALUES ('" . $groupMember->getUserID() . "', '" . $groupMember->getGroupID() . "', '" . $groupMember->getIsAdminOrLeader() . "')";
            if (mysqli_query($this->conn, $this->dbQuery))
            {
                mysqli_close($this->conn);
                return true;
            }
            else
            {
                echo mysqli_error($this->conn);
                mysqli_close($this->conn);
                return false;
            }
        }
        catch (Exception $e)
        {
        }
    }

    // Gets a job history from the table given a GroupMemberModel object
    public function getGroupMember(GroupMemberModel $groupMember)
    {
        $groupMemberID = $groupMember->getID();
        try
        {
            $this->dbQuery = "SELECT * FROM groupmember WHERE ID = '" . $groupMemberID . "'";
            $result = mysqli_query($this->conn, $this->dbQuery);
            if (mysqli_num_rows($result) == 1)
            {
                $row = mysqli_fetch_assoc($result);
                $id = $row['ID'];
                $userID = $row['USERID'];
                $groupID = $row['GROUPID'];
                $isAdminOrLeader = [
                    'ISADMINORLEADER'
                ];
                $groupMember = new GroupMemberModel($id, $userID, $groupID, $isAdminOrLeader);
                mysqli_free_result($result);
                mysqli_close($this->conn);
                return $groupMember;
            }
            else
            {
                mysqli_close($this->conn);
                return - 1;
            }
        }
        catch (Exception $e)
        {
        }
    }

    // updates a job history in the table
    public function updateGroupMember(GroupMemberModel $groupMember)
    {
        try
        {

            $this->dbQuery = "UPDATE groupmember
                                SET USERID = '" . $groupMember->getUserID() . "', GROUPID = '" . $groupMember->getGroupID() . "'
                                WHERE ID = '" . $groupMember->getID() . "'";
            if (mysqli_query($this->conn, $this->dbQuery))
            {
                mysqli_close($this->conn);
                return true;
            }
            else
            {
                echo mysqli_error($this->conn);
                mysqli_close($this->conn);
                return false;
            }
        }
        catch (Exception $e)
        {
        }
    }

    // deletes a job history from the database given an GroupMemberModel object
    public function deleteGroupMember(GroupMemberModel $groupMember)
    {
        try
        {
            $groupMemberID = $groupMember->getID();
            $this->dbQuery = "DELETE FROM groupmember WHERE ID = '" . $groupMemberID . "'";
            mysqli_query($this->conn, $this->dbQuery);
            mysqli_close($this->conn);
            return true;
        }
        catch (Exception $e)
        {
            return false;
        }
    }

    // Gets a user's full job history from the table given a UserInfo object
    public function getGroupMembersFromGroupID(int $groupID)
    {
        try
        {
            $this->dbQuery = "SELECT * FROM groupmember WHERE groupID = '" . $groupID . "'";
            $result = mysqli_query($this->conn, $this->dbQuery);
            $groupMembers = array();
            while ($row = mysqli_fetch_assoc($result))
            {
                $id = $row['ID'];
                $userID = $row['USERID'];
                $groupID = $row['GROUPID'];
                $isAdminOrLeader = [
                    'ISADMINORLEADER'
                ];
                $groupMember = new GroupMemberModel($id, $userID, $groupID, $isAdminOrLeader);
                $groupMembers[] = $groupMember;
            }
            mysqli_free_result($result);
            mysqli_close($this->conn);
            return $groupMembers;
        }
        catch (Exception $e)
        {
        }
    }

    // Gets an edcuation from the table given the ID of the education object
    public function getGroupMemberFromID(int $groupMemberID)
    {
        try
        {
            $this->dbQuery = "SELECT * FROM groupmember WHERE ID = '" . $groupMemberID . "'";
            $result = mysqli_query($this->conn, $this->dbQuery);
            if (mysqli_num_rows($result) == 1)
            {
                $row = mysqli_fetch_assoc($result);
                $id = $row['ID'];
                $userID = $row['USERID'];
                $groupID = $row['GROUPID'];
                $isAdminOrLeader = [
                    'ISADMINORLEADER'
                ];
                $groupMember = new GroupMemberModel($id, $userID, $groupID, $isAdminOrLeader);
                mysqli_free_result($result);
                mysqli_close($this->conn);
                return $groupMember;
            }
            else
            {
                mysqli_close($this->conn);
                return - 1;
            }
        }
        catch (Exception $e)
        {
        }
    }

    public function getNumOfGroupMembers(GroupModel $group)
    {
        $groupID = $group->getID();
        try
        {
            $this->dbQuery = "SELECT * FROM groupmember WHERE GROUPID = '" . $groupID . "'";
            $result = mysqli_query($this->conn, $this->dbQuery);
            $count = mysqli_num_rows($result);
            mysqli_free_result($result);
            mysqli_close($this->conn);
            return $count;
        }
        catch (Exception $e)
        {
        }
    }
    
    public function isMemberInGroup(GroupModel $group, UserModel $user)
    {
        $userID = $user->getID();
        $groupID = $group->getID();
        try
        {
            $this->dbQuery = "SELECT * FROM groupmember WHERE GROUPID = '" . $groupID . "' AND USERID = '" . $userID . "'";
            $result = mysqli_query($this->conn, $this->dbQuery);
            if(mysqli_num_rows($result) > 0)
            {
                mysqli_free_result($result);
                mysqli_close($this->conn);
                return true;
            }
            else 
            {
                mysqli_free_result($result);
                mysqli_close($this->conn);
                return false;
            }
            
        }
        catch (Exception $e)
        {
        }
    }
}

