<?php
namespace App\Services\Business;

use App\Services\Data\DataAccessObject;
use Illuminate\Http\Request;

class BusinessService 
{
    private $dao;
    public function __construct()
    {
        $this->dao = new DataAccessObject();   
    }
    
    public function AddUser($user)
    {
        return $this->dao->AddUser($user);
    }
    
    public function isUnique($username)
    {
        return $this->dao->isUnique($username);
    }
    
    public function Authenticate($username, $password)
    {
        return $this->dao->Authenticate($username, $password);
    }
    
    public function getUserID($username)
    {
        return $this->dao->getUserID($username);
    }
    
    public function getUserRole($username)
    {
        return $this->dao->getUserRole($username);
    }
    
    public function getUserFromID($id)
    {
        return $this->dao->getUserFromID($id);
    }
    
    public function getUserFromUsername($username)
    {
        return $this->dao->getUserFromUsername($username);
    }
    
    public function getAllUsers()
    {
        return $this->dao->getAllUsers();
    }
    
    public function updateUser($user)
    {
        return $this->dao->updateUser($user);
    }
    
    public function addUserInfo($userInfo)
    {
        return $this->dao->addUserInfo($userInfo);
    }
    
    public function deleteUser($user)
    {
        return $this->dao->deleteUser($user);
    }
    
}

