<?php
namespace App\Services\Data;

use App\Models\GroupMemberModel;
use App\Models\GroupModel;
use App\Models\UserModel;
use App\Services\Data\Connection\DBConnect;
use Carbon\Exceptions\Exception;

class GroupMemberDAO
{

    private $conn;
    private $connection;
    public function __construct()
    {
        $this->conn = new DBConnect();
        $this->connection = $this->conn->connect();
    }
    
    // Adds a job history to the database
    public function addGroupMember(GroupMemberModel $groupMember)
    {
        try
        {
            $dbQuery= "INSERT INTO groupmember (USERID, GROUPID, ISADMINORLEADER)
                                VALUES ('" . $groupMember->getUserID() . "', '" . $groupMember->getGroupID() . "', '" . $groupMember->getIsAdminOrLeader() . "')";
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
    
    // Gets a job history from the table given a GroupMemberModel object
    public function getGroupMember(GroupMemberModel $groupMember)
    {
        $groupMemberID = $groupMember->getID();
        try
        {
            $dbQuery= "SELECT * FROM groupmember WHERE ID = '" . $groupMemberID . "'";
            $result = $this->connection->query($dbQuery);
            if (mysqli_num_rows($result) == 1)
            {
                $row = mysqli_fetch_assoc($result);
                $id = $row['ID'];
                $userID = $row['USERID'];
                $groupID = $row['GROUPID'];
                $isAdminOrLeader = $row['ISADMINORLEADER'];
                $groupMember = new GroupMemberModel($id, $userID, $groupID, $isAdminOrLeader);
                mysqli_free_result($result);
                $this->connection->close();
                return $groupMember;
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
    public function updateGroupMember(GroupMemberModel $groupMember)
    {
        try
        {
            
            $dbQuery= "UPDATE groupmember
                                SET USERID = '" . $groupMember->getUserID() . "', GROUPID = '" . $groupMember->getGroupID() . "'
                                WHERE ID = '" . $groupMember->getID() . "'";
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
    
    // deletes a job history from the database given an GroupMemberModel object
    public function deleteGroupMember(GroupMemberModel $groupMember)
    {
        try
        {
            $groupMemberID = $groupMember->getID();
            $dbQuery= "DELETE FROM groupmember WHERE ID = '" . $groupMemberID . "'";
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
    public function getGroupMembersFromGroupID(int $groupID)
    {
        try
        {
            $dbQuery= "SELECT * FROM groupmember WHERE groupID = '" . $groupID . "'";
            $result = $this->connection->query($dbQuery);
            $groupMembers = array();
            while ($row = mysqli_fetch_assoc($result))
            {
                $id = $row['ID'];
                $userID = $row['USERID'];
                $groupID = $row['GROUPID'];
                $isAdminOrLeader = $row['ISADMINORLEADER'];
                $groupMember = new GroupMemberModel($id, $userID, $groupID, $isAdminOrLeader);
                $groupMembers[] = $groupMember;
            }
            mysqli_free_result($result);
            $this->connection->close();
            return $groupMembers;
        }
        catch (Exception $e)
        {
        }
    }
    
    // Gets an edcuation from the table given the ID of the education object
    public function getGroupMemberFromID(int $groupMemberID)
    {
        try
        {
            $dbQuery= "SELECT * FROM groupmember WHERE ID = '" . $groupMemberID . "'";
            $result = $this->connection->query($dbQuery);
            if (mysqli_num_rows($result) == 1)
            {
                $row = mysqli_fetch_assoc($result);
                $id = $row['ID'];
                $userID = $row['USERID'];
                $groupID = $row['GROUPID'];
                $isAdminOrLeader = $row['ISADMINORLEADER'];
                $groupMember = new GroupMemberModel($id, $userID, $groupID, $isAdminOrLeader);
                mysqli_free_result($result);
                $this->connection->close();
                return $groupMember;
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
    
    public function getNumOfGroupMembers(GroupModel $group)
    {
        $groupID = $group->getID();
        try
        {
            $dbQuery= "SELECT * FROM groupmember WHERE GROUPID = '" . $groupID . "'";
            $result = $this->connection->query($dbQuery);
            $count = mysqli_num_rows($result);
            mysqli_free_result($result);
            $this->connection->close();
            return $count;
        }
        catch (Exception $e)
        {
        }
    }
    
    public function isMemberInGroup(GroupModel $group, UserModel $user)
    {
        $userID = $user->getID();
        $groupID = $group->getID();
        try
        {
            $dbQuery= "SELECT * FROM groupmember WHERE GROUPID = '" . $groupID . "' AND USERID = '" . $userID . "'";
            $result = $this->connection->query($dbQuery);
            if (mysqli_num_rows($result) > 0)
            {
                mysqli_free_result($result);
                $this->connection->close();
                return true;
            }
            else
            {
                mysqli_free_result($result);
                $this->connection->close();
                return false;
            }
        }
        catch (Exception $e)
        {
        }
    }
    
    public function getGroupMemberFromUserID(GroupModel $group, int $userID)
    {
        $groupID = $group->getID();
        $dbQuery= "SELECT * FROM groupmember WHERE GROUPID = '" . $groupID . "' AND USERID = '" . $userID . "'";
        $result = $this->connection->query($dbQuery);
        $row = mysqli_fetch_assoc($result);
        $groupMember = new GroupMemberModel($row['ID'], $row['USERID'], $row['GROUPID'], $row['ISADMINORLEADER']);
        $this->connection->close();
        return $groupMember;
    }
    
}

