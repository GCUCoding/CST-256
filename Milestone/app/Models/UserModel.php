<?php
namespace App\Models;


class UserModel implements \JsonSerializable
{
    //declares fields necessary for a User
    private $id;
    private $username;
    private $password;
    private $role;
    
    //full-args constructor
    public function __construct($id, string $username, string $password, $role)
    {
        $this->username = $username;
        $this->password = $password;
        $this->id = $id;
        $this->role = $role;
    }
    
    //getters(Model should be read-only
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
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    
}

