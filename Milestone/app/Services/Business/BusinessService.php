<?php
namespace App\Services\Business;

use Illuminate\Http\Request;
use App\Services\Data\UserDAO;
use App\Services\Data\ProfileDAO;
use App\Services\Data\EducationDAO;
use App\Services\Data\JobListingDAO;
use App\Services\Data\JobHistoryDAO;
use App\Services\Data\GroupDAO;
use App\Services\Data\GroupMemberDAO;

//creates a class to be used for business logic
class BusinessService 
{
    //declares a field to hold a DatabaseAccessObject
    private $dao;
    
    /*====================================================================================================================
     *USER STUFF
     *====================================================================================================================*/
    //tells database to attempt to add a user(registration)
    public function AddUser($user)
    {
        $this->dao = new UserDAO();
        //returns a boolean to show success
        return $this->dao->AddUser($user);
    }
    
    //asks database to test if a user is unique
    public function isUnique($username)
    {
        $this->dao = new UserDAO();
        return $this->dao->isUnique($username);
    }
    
    //asks database to check whether a username and password are unique
    public function Authenticate($username, $password)
    {
        $this->dao = new UserDAO();
        return $this->dao->Authenticate($username, $password);
    }
    
    //asks the database to return the ID of a user given the username
    public function getUserID($username)
    {
        $this->dao = new UserDAO();
        return $this->dao->getUserID($username);
    }
    
    //asks the database to return the Role of a user given the username
    public function getUserRole($username)
    {
        $this->dao = new UserDAO();
        return $this->dao->getUserRole($username);
    }
    
    //returns a user in the form of a UserModel object given the user's ID
    public function getUserFromID($id)
    {
        $this->dao = new UserDAO();
        return $this->dao->getUserFromID($id);
    }
    
    //returns a user in the form of a UserModel given the user's username
    public function getUserFromUsername($username)
    {
        $this->dao = new UserDAO();
        return $this->dao->getUserFromUsername($username);
    }
    
    //returns all users in the form of a list of UserModel objects
    public function getAllUsers()
    {
        $this->dao = new UserDAO();
        return $this->dao->getAllUsers();
    }
    
    //updates a user in the database after being given a UserModel
    public function updateUser($user)
    {
        $this->dao = new UserDAO();
        return $this->dao->updateUser($user);
    }
    
    //asks the database to delete a user given a corresponding UserModel object
    public function deleteUser($user)
    {
        $this->dao = new UserDAO();
        return $this->dao->deleteUser($user);
    }
    
    /*====================================================================================================================
     *PROFILE STUFF
     *====================================================================================================================*/
    //asks the database to update a user's info given a ProfileModel object
    public function addUserInfo($userInfo)
    {
        $this->dao = new ProfileDAO();
        return $this->dao->addUserInfo($userInfo);
    }
    
    //asks the database to provide a user's profile information given the corresponding UserModel object
    public function getUserInfo($user)
    {
        $this->dao = new ProfileDAO();
        return $this->dao->getUserInfo($user);
    }
    
    //asks the database to update a user's profile information given a ProfileModel object
    public function updateUserInfo($userInfo)
    {
        $this->dao = new ProfileDAO();
        return $this->dao->updateUserInfo($userInfo);
    }
    
    //asks the database to provide a user's profile information given a profile ID
    public function getUserInfoFromID($profileID)
    {
        $this->dao = new ProfileDAO();
        return $this->dao->getUserInfoFromID($profileID);
    }
    
    /*====================================================================================================================
     *EDUCATION STUFF
     *====================================================================================================================*/
    //asks the database to add an education given a EducationModel object
    public function addEducation($education)
    {
        $this->dao = new EducationDAO();
        return $this->dao->addEducation($education);
    }
    
    //asks the database to provide an education based on a given EducationModel object
    public function getEducation($education)
    {
        $this->dao = new EducationDAO();
        return $this->dao->getEducation($education);
    }
    
    //asks the database to update an education based on a given EducationModel object
    public function updateEducation($education)
    {
        $this->dao = new EducationDAO();
        return $this->dao->updateEducation($education);
    }
    
    //asks the database to delete an education from the database based on a give EducationModel object
    public function deleteEducation($education)
    {
        $this->dao = new EducationDAO();
        return $this->dao->deleteEducation($education);
    }
    
    //asks the database to provide education(s) based on a given ProfileModel object
    public function getEducationFromProfile($userInfo)
    {
        $this->dao = new EducationDAO();
        return $this->dao->getEducationFromProfile($userInfo);
    }
    
    public function getEducationFromID($educationID)
    {
        $this->dao = new EducationDAO();
        return $this->dao->getEducationFromID($educationID);
    }
    
    /*====================================================================================================================
     *JOBLISTING STUFF
     *====================================================================================================================*/
    //asks the database to add a job listing based on a given JobListingModel object
    public function addJobListing($jobListing)
    {
        $this->dao = new JobListingDAO();
        return $this->dao->addJobListing($jobListing);
    }
    
    //asks the database to provide a job listing based on a given JobListingModel object
    public function getJobListing($jobListing)
    {
        $this->dao = new JobListingDAO();
        return $this->dao->getJobListing($jobListing);
    }
    
    //asks the database to provide all job listings
    public function getAllJobListings()
    {
        $this->dao = new JobListingDAO();
        return $this->dao->getAllJobListings();
    }
    
    //asks the database to update a job listing based on a given JobListingModel object
    public function updateJobListing($jobListing)
    {
        $this->dao = new JobListingDAO();
        return $this->dao->updateJobListing($jobListing);
    }
    
    //asks the database to provide all active job listings
    public function getActiveJobListings()
    {
        $this->dao = new JobListingDAO();
        return $this->dao->getActiveJobListings();
    }
    
    //asks the database to provide all inactive job listings
    public function getInactiveJobListings()
    {
        $this->dao = new JobListingDAO();
        return $this->dao->getInactiveJobListings();
    }
 
    //asks the database to get a job listing based on a given job listing ID
    public function getJobListingFromID($jobListingID)
    {
        $this->dao = new JobListingDAO();
        return $this->dao->getJobListingFromID($jobListingID);
    }
    
    //asks the database to get job listings based on a give user query
    public function searchJobListings($query)
    {
        $this->dao = new JobListingDAO();
        return $this->dao->searchJobListings($query);
    }
    
    /*====================================================================================================================
     *JOBHISTORY STUFF
     *====================================================================================================================*/
    //asks the database to add a job history based on a given JobHistoryModel object
    public function addJobHistory($jobHistory)
    {
        $this->dao = new JobHistoryDAO();
        return $this->dao->addJobHistory($jobHistory);
    }
    
    //asks the database to provide a single job history based on a given JobHistoryModel object
    public function getJobHistory($jobHistory)
    {
        $this->dao = new JobHistoryDAO();
        return $this->dao->getJobHistory($jobHistory);
    }
    
    //asks the database to update a jobHistory object based on the 
    public function updateJobHistory($jobHistory)
    {
        $this->dao = new JobHistoryDAO();
        return $this->dao->updateJobHistory($jobHistory);
    }
    
    //asks the database to delete a job history based on a given JobHistoryModel object
    public function deleteJobHistory($jobHistory)
    {
        $this->dao = new JobHistoryDAO();
        return $this->dao->deleteJobHistory($jobHistory);
    }
    
    //asks the database to get a user's complete job history based on a given ProfileModel object
    public function getJobHistoryFromUserInfo($userInfo)
    {
        $this->dao = new JobHistoryDAO();
        return $this->dao->getJobHistoryFromUserInfo($userInfo);
    }
    
    //asks the database to provide a single job history based on a given job history ID
    public function getJobHistoryFromID($jobHistoryID)
    {
        $this->dao = new JobHistoryDAO();
        return $this->dao->getJobHistoryFromID($jobHistoryID);
    }

    /*====================================================================================================================
     *GROUP STUFF
     *====================================================================================================================*/
    //asks the database to add a job history based on a given JobHistoryModel object
    public function addGroup($group)
    {
        $this->dao = new GroupDAO();
        return $this->dao->addGroup($group);
    }
    
    //asks the database to provide a single job history based on a given JobHistoryModel object
    public function getGroup($group)
    {
        $this->dao = new GroupDAO();
        return $this->dao->getGroup($group);
    }

    //asks the database to provide a single job history based on a given JobHistoryModel object
    public function getGroupFromTitle($groupTitle)
    {
        $this->dao = new GroupDAO();
        return $this->dao->getGroupFromTitle($groupTitle);
    }
    
    //asks the database to update a jobHistory object based on the
    public function updateGroup($group)
    {
        $this->dao = new GroupDAO();
        return $this->dao->updateGroup($group);
    }
    
    //asks the database to delete a job history based on a given JobHistoryModel object
    public function deleteGroup($group)
    {
        $this->dao = new GroupDAO();
        return $this->dao->deleteGroup($group);
    }
    
    //asks the database to get a user's complete job history based on a given ProfileModel object
    public function getGroupFromUserID($userID)
    {
        $this->dao = new GroupDAO();
        return $this->dao->getGroupFromUserInfo($userID);
    }
    
    //asks the database to provide a single job history based on a given job history ID
    public function getGroupFromID($groupID)
    {
        $this->dao = new GroupDAO();
        return $this->dao->getGroupFromID($groupID);
    }

    public function getAllGroups()
    {
        $this->dao = new GroupDAO();
        return $this->dao->getAllGroups();
    }
    
    /*====================================================================================================================
     *GROUP MEMBER STUFF
     *====================================================================================================================*/
    //asks the database to add a job history based on a given JobHistoryModel object
    public function addGroupMember($groupMember)
    {
        $this->dao = new GroupMemberDAO();
        return $this->dao->addGroupMember($groupMember);
    }
    
    //asks the database to provide a single job history based on a given JobHistoryModel object
    public function getGroupMember($groupMember)
    {
        $this->dao = new GroupMemberDAO();
        return $this->dao->getGroupMember($groupMember);
    }
   
    
    //asks the database to update a jobHistory object based on the
    public function updateGroupMember($group)
    {
        $this->dao = new GroupMemberDAO();
        return $this->dao->updateGroupMember($group);
    }
    
    //asks the database to delete a job history based on a given JobHistoryModel object
    public function deleteGroupMember($groupMember)
    {
        $this->dao = new GroupMemberDAO();
        return $this->dao->deleteGroupMember($groupMember);
    }
    
    //asks the database to get a user's complete job history based on a given ProfileModel object
    public function getGroupMembersFromGroupID($groupID)
    {
        $this->dao = new GroupMemberDAO();
        return $this->dao->getGroupMembersFromGroupID($groupID);
    }
    
    //asks the database to provide a single job history based on a given job history ID
    public function getGroupMemberFromID($groupMemberID)
    {
        $this->dao = new GroupMemberDAO();
        return $this->dao->getGroupMemberFromID($groupMemberID);
    }
    
    public function getNumOfGroupMembers($group)
    {
        $this->dao = new GroupMemberDAO();
        return $this->dao->getNumOfGroupMembers($group);
    }
    
    public function getGroupMemberFromUserID($group, $userID)
    {
        $this->dao = new GroupMemberDAO();
        return $this->dao->getGroupMemberFromUserID($group, $userID);
    }
}

