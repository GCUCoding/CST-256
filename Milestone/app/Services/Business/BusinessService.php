<?php
namespace App\Services\Business;

use App\Services\Data\DataAccessObject;

class BusinessService
{
    private $dao;
    public function __construct()
    {
        $this->dao = new DataAccessObject();   
    }
    
    public function AddUser($username, $password)
    {
        return $this->dao->AddUser($username, $password);
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
}

