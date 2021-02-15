<?php
namespace App\Models;


class UserModel
{
    private $businessService;
    private $id;
    private $username;
    private $password;
    private $role;
    
    public function __construct($id, string $username, string $password, $role)
    {
        $this->username = $username;
        $this->password = $password;
        $this->id = $id;
        $this->role = $role;
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
    
}

