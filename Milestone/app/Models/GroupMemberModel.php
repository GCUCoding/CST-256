<?php
namespace App\Models;

class GroupMemberModel
{
    private $id;
    private $userID;
    private $groupID;
    private $isAdminOrLeader;
    public function __construct($id, $userID, $groupID, $isAdminOrLeader)
    {
        $this->id = $id;
        $this->userID = $userID;
        $this->groupID = $groupID;
        $this->isAdminOrLeader = $isAdminOrLeader;
    }
    
    public function getID()
    {
        return $this->id;
    }
    public function getUserID()
    {
        return $this->userID;
    }
    public function getGroupID()
    {
        return $this->groupID;
    }
    public function getIsAdminOrLeader()
    {
        return $this->isAdminOrLeader;
    }
    
}

