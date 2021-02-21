<?php
namespace App\Services\Business;

use App\Services\Data\DataAccessObject;
use Illuminate\Http\Request;

//creates a class to be used for business logic
class BusinessService 
{
    //declares a field to hold a DatabaseAccessObject
    private $dao;
    
    //no-args constructor
    public function __construct()
    {
        //initializes DAO
        $this->dao = new DataAccessObject();   
    }
    
    //tells database to attempt to add a user(registration)
    public function AddUser($user)
    {
        //returns a boolean to show success
        return $this->dao->AddUser($user);
    }
    
    //asks database to test if a user is unique
    public function isUnique($username)
    {
        return $this->dao->isUnique($username);
    }
    
    //asks database to check whether a username and password are unique
    public function Authenticate($username, $password)
    {
        return $this->dao->Authenticate($username, $password);
    }
    
    //asks the database to return the ID of a user given the username
    public function getUserID($username)
    {
        return $this->dao->getUserID($username);
    }
    
    //asks the database to return the Role of a user given the username
    public function getUserRole($username)
    {
        return $this->dao->getUserRole($username);
    }
    
    //returns a user in the form of a UserModel object given the user's ID
    public function getUserFromID($id)
    {
        return $this->dao->getUserFromID($id);
    }
    
    //returns a user in the form of a UserModel given the user's username
    public function getUserFromUsername($username)
    {
        return $this->dao->getUserFromUsername($username);
    }
    
    //returns all users in the form of a list of UserModel objects
    public function getAllUsers()
    {
        return $this->dao->getAllUsers();
    }
    
    //updates a user in the database after being given a UserModel
    public function updateUser($user)
    {
        return $this->dao->updateUser($user);
    }
    
    //asks the database to update a user's info given a ProfileModel object
    public function addUserInfo($userInfo)
    {
        return $this->dao->addUserInfo($userInfo);
    }
    
    //asks the database to delete a user given a corresponding UserModel object
    public function deleteUser($user)
    {
        return $this->dao->deleteUser($user);
    }
    
    //asks the database to provide a user's profile information given the corresponding UserModel object
    public function getUserInfo($user)
    {
        return $this->dao->getUserInfo($user);
    }
    
    //asks the database to update a user's profile information given a ProfileModel object
    public function updateUserInfo($userInfo)
    {
        return $this->dao->updateUserInfo($userInfo);
    }
}

