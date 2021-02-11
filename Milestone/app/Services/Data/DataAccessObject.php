<?php
namespace App\Services\Data;

use Carbon\Exceptions\Exception;

class DataAccessObject
{

    private $conn;

    private $servername = "localhost";

    private $username = "root";

    private $password = "root";

    private $dbName = "Milestone";

    private $dbQuery;

    public function __construct()
    {
        $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbName, $this->dbQuery);
    }

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

    public function AddUser($username, $password)
    {
        try
        {
            if ($this->isUnique($username))
            {
                $this->dbQuery = "INSERT INTO user (USERNAME, PASSWORD) VALUES ('" . $username . "', '" . $password . "')";
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
                return -1;
            }
        }
        catch (Exception $e)
        {
        }
    }
    
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
                return -1;
            }
        }
        catch (Exception $e)
        {
        }
    }
}

