<?php
namespace App\Models;

use App\Services\Business\BusinessService;

class UserModel
{
    private $businessService;
    private $id;
    private $username;
    private $password;
    private $role;
    
    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
        $this->id = $this->loadID();
        $this->role = $this->loadRole();
    }
    
    public function getID()
    {
        return $this->id;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getRole()
    {
        return $this->role;
    }
    
    public function loadID()
    {
        $this->businessService = new BusinessService();
        $this->id = $this->businessService->getUserID($this->username);
    }
    public function loadRole()
    {
        $this->businessService = new BusinessService();
        $this->role = $this->businessService->getUserRole($this->username);
    }
    
}

