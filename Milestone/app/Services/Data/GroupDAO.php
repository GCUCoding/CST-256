<?php
namespace App\Services\Data;

use Carbon\Exceptions\Exception;
use App\Models\GroupModel;
use App\Services\Data\Connection\DBConnect;


class GroupDAO
{

    private $conn;
    private $connection;
    public function __construct()
    {
        $this->conn = new DBConnect();
        $this->connection = $this->conn->connect();
    }
    
    // Adds a job history to the database
    public function addGroup(GroupModel $group)
    {
        if ($this->checkUniqueGroup($group))
        {
            try
            {
                $dbQuery= "INSERT INTO groups (TITLE, DESCRIPTION)
                                VALUES ('" . $group->getTitle() . "', '" . $group->getDescription() . "')";
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
        else
        {
            echo "Not a unique group.";
        }
    }
    
    // Gets a job history from the table given a GroupModel object
    public function getGroup(GroupModel $group)
    {
        $groupID = $group->getID();
        try
        {
            $dbQuery= "SELECT * FROM groups WHERE ID = '" . $groupID . "'";
            $result = $this->connection->query($dbQuery);
            if (mysqli_num_rows($result) == 1)
            {
                $row = mysqli_fetch_assoc($result);
                $id = $row['ID'];
                $title = $row['TITLE'];
                $description = $row['DESCRIPTION'];
                $group = new GroupModel($id, $title, $description);
                mysqli_free_result($result);
                $this->connection->close();
                return $group;
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
    
    // updates a job history in the table
    public function updateGroup(GroupModel $group)
    {
        try
        {
            
            $dbQuery= "UPDATE groups
                                SET DESCRIPTION = '" . $group->getDescription() . "', TITLE = '" . $group->getTitle() . "'
                                WHERE ID = '" . $group->getID() . "'";
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
    
    // deletes a job history from the database given an GroupModel object
    public function deleteGroup(GroupModel $group)
    {
        try
        {
            $groupID = $group->getID();
            $dbQuery= "DELETE FROM groups WHERE ID = '" . $groupID . "'";
            $this->connection->query($dbQuery);
            $this->connection->close();
            return true;
        }
        catch (Exception $e)
        {
            return false;
        }
    }
    
    // Gets a user's full job history from the table given a UserInfo object
    public function getGroupsFromUserID(int $userID)
    {
        try
        {
            $dbQuery= "SELECT * FROM groups WHERE PROFILEID = '" . $userID . "'";
            $result = $this->connection->query($dbQuery);
            $groups = array();
            while ($row = mysqli_fetch_assoc($result))
            {
                $id = $row['ID'];
                $description = $row['DESCRIPTION'];
                $title = $row['TITLE'];
                $group = new GroupModel($id, $title, $description);
                $groups[] = $group;
            }
            mysqli_free_result($result);
            $this->connection->close();
            return $groups;
        }
        catch (Exception $e)
        {
        }
    }
    
    public function getGroupFromTitle(string $groupTitle)
    {
        try
        {
            $dbQuery= "SELECT * FROM groups WHERE TITLE = '" . $groupTitle . "'";
            $result = $this->connection->query($dbQuery);
            if (mysqli_num_rows($result) == 1)
            {
                $row = mysqli_fetch_assoc($result);
                $id = $row['ID'];
                $description = $row['DESCRIPTION'];
                $title = $row['TITLE'];
                $group = new GroupModel($id, $title, $description);
                mysqli_free_result($result);
                $this->connection->close();
                return $group;
            }
            else
            {
                echo mysqli_error($this->conn);
                $this->connection->close();
                return - 1;
            }
        }
        catch (Exception $e)
        {
        }
    }
    
    // Gets an edcuation from the table given the ID of the education object
    public function getGroupFromID(int $groupID)
    {
        try
        {
            $dbQuery= "SELECT * FROM groups WHERE ID = '" . $groupID . "'";
            $result = $this->connection->query($dbQuery);
            if (mysqli_num_rows($result) == 1)
            {
                $row = mysqli_fetch_assoc($result);
                $id = $row['ID'];
                $description = $row['DESCRIPTION'];
                $title = $row['TITLE'];
                $group = new GroupModel($id, $title, $description);
                mysqli_free_result($result);
                $this->connection->close();
                return $group;
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
    
    public function checkUniqueGroup(GroupModel $group)
    {
        try
        {
            $dbQuery= "SELECT TITLE FROM groups WHERE TITLE = '" . $group->getTitle() . "'";
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
    
    public function getAllGroups()
    {
        try
        {
            $dbQuery= "SELECT * FROM groups";
            if ($result = $this->connection->query($dbQuery))
            {
                $groups = array();
                while ($row = mysqli_fetch_assoc($result))
                {
                    $id = $row['ID'];
                    $title = $row['TITLE'];
                    $description = $row['DESCRIPTION'];
                    $group = new GroupModel($id, $title, $description);
                    $groups[] = $group;
                }
                $this->connection->close();
                return $groups;
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
}

