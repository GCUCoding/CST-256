<?php
namespace App\Services\Data;
use App\Services\Data\Connection\DBConnect;
use Carbon\Exceptions\Exception;
use App\Models\UserModel;

class UserDAO
{
    private $connector;
    private $connection;
    public function __construct()
    {
        $this->connector = new DBConnect();
        $this->connection = $this->connector->connect();
    }
    // checks the data in the database to ensure that a provided username is unique
    public function isUnique($username)
    {
        try
        {
            $dbQuery = "SELECT USERNAME FROM user WHERE USERNAME = '" . $username . "'";
            $result = $this->connection->query($dbQuery);
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
                $dbQuery = "INSERT INTO user (USERNAME, PASSWORD) VALUES ('" . $user->getUsername() . "', '" . $user->getPassword() . "')";
                $this->connection->query($dbQuery);
                $this->connection->close();
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
            $dbQuery = "SELECT * FROM user WHERE USERNAME = '" . $username . "' AND PASSWORD = '" . $password . "'";
            $result = $this->connection->query($dbQuery);
            if (mysqli_num_rows($result) == 1)
            {
                mysqli_free_result($result);
                $this->connection->close();
                return true;
            }
            else
            {
                $this->connection->close();
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
            $dbQuery = "SELECT ID FROM user WHERE USERNAME = '" . $username . "'";
            $result = $this->connection->query($dbQuery);
            if (mysqli_num_rows($result) == 1)
            {
                $id = mysqli_fetch_assoc($result)['ID'];
                mysqli_free_result($result);
                $this->connection->close();
                return $id;
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
    
    // returns a user's role given their username
    public function getUserRole($username)
    {
        try
        {
            $dbQuery = "SELECT ROLE FROM user WHERE USERNAME = '" . $username . "'";
            $result = $this->connection->query($dbQuery);
            if (mysqli_num_rows($result) == 1)
            {
                $role = mysqli_fetch_assoc($result)['ROLE'];
                mysqli_free_result($result);
                $this->connection->close();
                return $role;
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
    
    // gets a user given a user's ID
    public function getUserFromID($id)
    {
        try
        {
            $dbQuery = "SELECT * FROM user WHERE ID = '" . $id . "'";
            $result = $this->connection->query($dbQuery);
            if (mysqli_num_rows($result) == 1)
            {
                $row = mysqli_fetch_assoc($result);
                $username = $row['USERNAME'];
                $password = $row['PASSWORD'];
                $role = $row['ROLE'];
                $user = new UserModel($id, $username, $password, $role);
                mysqli_free_result($result);
                $this->connection->close();
                return $user;
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
    
    // gets all users in the user's database and returns them in the form of an array
    public function getAllUsers()
    {
        try
        {
            $dbQuery = "SELECT * FROM user";
            $result = $this->connection->query($dbQuery);
            $users = array();
            while ($row = mysqli_fetch_assoc($result))
            {
                $users[] = new UserModel($row['ID'], $row['USERNAME'], $row['PASSWORD'], $row['ROLE']);
            }
            mysqli_free_result($result);
            $this->connection->close();
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
            
            $dbQuery = "UPDATE user
                                SET USERNAME = '" . $user->getUsername() . "', PASSWORD = '" . $user->getPassword() . "', ROLE = '" . $user->getRole() . "'
                                WHERE ID = '" . $user->getID() . "'";
            if ($this->connection->query($dbQuery))
            {
                $this->connection->close();
                return true;
            }
            else
            {
                $this->connection->close();
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
            $dbQuery = "SELECT * FROM user WHERE USERNAME = '" . $username . "'";
            $result = $this->connection->query($dbQuery);
            if (mysqli_num_rows($result) == 1)
            {
                $row = mysqli_fetch_assoc($result);
                $id = $row['ID'];
                $password = $row['PASSWORD'];
                $role = $row['ROLE'];
                $user = new UserModel($id, $username, $password, $role);
                mysqli_free_result($result);
                $this->connection->close();
                return $user;
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
    
    // deletes a user from the database given a UserModel object
    public function deleteUser(UserModel $user)
    {
        try
        {
            $userID = $user->getID();
            $dbQuery = "DELETE FROM user WHERE ID = '" . $userID . "'";
            $this->connection->query($dbQuery);
            $this->connection->close();
            return true;
        }
        catch (Exception $e)
        {
            return false;
        }
    }
}

