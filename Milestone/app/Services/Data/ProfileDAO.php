<?php
namespace App\Services\Data;

use App\Services\Data\Connection\DBConnect;
use Carbon\Exceptions\Exception;
use App\Models\ProfileModel;
use App\Models\UserModel;

class ProfileDAO
{

    private $conn;
    private $connection;
    public function __construct()
    {
        $this->conn = new DBConnect();
        $this->connection = $this->conn->connect();
    }
    
    // adds a user's UserInfo into the userinfo table, given a foreign key within a ProfileModel object
    public function addUserInfo(ProfileModel $userInfo)
    {
        try
        {
            $dbQuery= "INSERT INTO userinfo (USERID)
                                VALUES ('" . $userInfo->getUserID() . "')";
            if ($this->connection->query($dbQuery))
            {
                $this->connection->close();
                return true;
            }
            else
            {
                echo mysqli_error($this->conn);
                $this->connection->close();
                return false;
            }
        }
        catch (Exception $e)
        {
        }
    }
    
    // gets a user's profile information given a UserModel object
    // returns a ProfileModel object
    public function getUserInfo(UserModel $user)
    {
        $userID = $user->getID();
        try
        {
            $dbQuery= "SELECT * FROM userinfo WHERE USERID = '" . $userID . "'";
            $result = $this->connection->query($dbQuery);
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
                $this->connection->close();
                return $userInfo;
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
    
    // updates a user's profile information based on a given ProfileModel object
    public function updateUserInfo(ProfileModel $userInfo)
    {
        try
        {
            
            $dbQuery= "UPDATE userinfo
                                SET EMAIL = '" . $userInfo->getEmail() . "', PHONE = '" . $userInfo->getPhone() . "', GENDER = '" . $userInfo->getGender() . "', NATIONALITY = '" . $userInfo->getNationality() . "', DESCRIPTION = '" . $userInfo->getDescription() . "', SKILLS = '" . $userInfo->getSkills() . "', CERTIFICATIONS = '" . $userInfo->getCertifications() . "'
                                WHERE ID = '" . $userInfo->getID() . "'";
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
    
    // gets a user's profile information given the ID of the profile
    public function getUserInfoFromID($profileID)
    {
        try
        {
            $dbQuery= "SELECT * FROM userinfo WHERE ID = '" . $profileID . "'";
            $result = $this->connection->query($dbQuery);
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
                $userID = $row['USERID'];
                $userInfo = new ProfileModel($id, $email, $phone, $gender, $nationality, $description, $skills, $certifications, $userID);
                mysqli_free_result($result);
                $this->connection->close();
                return $userInfo;
            }
            else
            {
                $this->connection->close();
                return null;
            }
        }
        catch (Exception $e)
        {
        }
    }
    
    // gets a user's profile information given the user's ID
    public function getUserInfoFromUserID($userID)
    {
        try
        {
            $dbQuery= "SELECT * FROM userinfo WHERE USERID = '" . $userID . "'";
            $result = $this->connection->query($dbQuery);
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
                $userID = $row['USERID'];
                $userInfo = new ProfileModel($id, $email, $phone, $gender, $nationality, $description, $skills, $certifications, $userID);
                mysqli_free_result($result);
                $this->connection->close();
                return $userInfo;
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
}

