<?php
namespace App\Services\Data;

use Carbon\Exceptions\Exception;
use App\Models\ProfileModel;
use App\Models\UserModel;

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
                return - 1;
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
                return - 1;
            }
        }
        catch (Exception $e)
        {
        }
    }

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

