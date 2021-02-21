<?php
namespace App\Services\Data;

use Carbon\Exceptions\Exception;
use App\Models\ProfileModel;
use App\Models\UserModel;

//provides access to a database
class DataAccessObject
{

    //declares fields necessary for a database connection
    private $conn;

    private $servername = "localhost";

    private $username = "root";

    private $password = "root";

    private $dbName = "Milestone";

    private $dbQuery;

    //no-args contructor creates a connection with the database
    public function __construct()
    {
        $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbName);
    }

    //checks the data in the database to ensure that a provided username is unique
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

    //attempts to add a user to the database
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

    //authenticates whether a user attempting to sign in is valid
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

    //returns the user ID of a user in the database given the username
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

    //returns a user's role given their username
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

    //gets a user given a user's ID
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

    //gets all users in the user's database and returns them in the form of an array
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

    //updates a user in the database given a UserModel object
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

    //gets a user from the database given a username and returns a corresponding UserModel object
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

    //adds a user's UserInfo into the userinfo table, given a foreign key within a ProfileModel object
    public function addUserInfo(ProfileModel $userInfo)
    {
        try
        {
            $this->dbQuery = "INSERT INTO userinfo (EMAIL, PHONE, GENDER, NATIONALITY, DESCRIPTION, SKILLS, CERTIFICATIONS, USERID) 
                                VALUES ('" . $userInfo->getEmail() . "', '" . $userInfo->getPhone() . "', '" . $userInfo->getGender() . "', '" . $userInfo->getNationality() . "', '" . $userInfo->getDescription() . "', '" . $userInfo->getSkills() . "', 
                                '" . $userInfo->getCertifications() . "', '" . $userInfo->getUserID() . "')";
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

    //deletes a user from the database given a UserModel object
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
        }
    }
    
    //gets a user's profile information given a UserModel object
    //returns a ProfileModel object
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
    
    //updates a user's profile information based on a given ProfileModel object
    public function updateUserInfo(ProfileModel $userInfo)
    {
        try
        {
            
            $this->dbQuery = "UPDATE userinfo
                                SET EMAIL = '" . $userInfo->getEmail() . "', PHONE = '" . $userInfo->getPhone() . "', GENDER = '" . $userInfo->getGender() . "', NATIONALITY = '" . $userInfo->getNationality() . 
                                "', DESCRIPTION = '" . $userInfo->getDescription() . "', SKILLS = '" . $userInfo->getSkills() . "', CERTIFICATIONS = '" . $userInfo->getCertifications() . "'
                                WHERE ID = '" . $userInfo->getID() . "'";
            if(mysqli_query($this->conn, $this->dbQuery))
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
}

