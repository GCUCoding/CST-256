<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Business\BusinessService;
use App\Models\GroupModel;
use App\Models\GroupMemberModel;

class GroupController extends Controller
{
    private $businessService;
    public function index(Request $request)
    {
        $this->businessService = new BusinessService();
        $groups = $this->businessService->getAllGroups();
        $groupMemberNums = array();
        foreach($groups as $group)
        {
            $groupMemberNums[] = $this->businessService->getNumOfGroupMembers($group);
        }
        $data = ['groups' => $groups, 'groupMemberNums' => $groupMemberNums];
        return view('Groups/groupList')->with($data);
    }
    
    public function addGroup(Request $request)
    {
        if(session('userID') == null)
        {
            return view('security');
        }
        else
        {
            return view('Groups/addGroup');
        }
    }
    
    public function newGroup(Request $request)
    {
        $this->businessService = new BusinessService();
        $group = new GroupModel(null, $request->input('title'), $request->input('description'));
        if($this->businessService->addGroup($group))
        {
            $group = $this->businessService->getGroupFromTitle($group->getTitle());
            $groupMember = new GroupMemberModel(null, $request->input('userID'), $group->getID(), 1);
            $this->businessService->addGroupMember($groupMember);
            $groups = $this->businessService->getAllGroups();
            $groupMemberNums = array();
            foreach($groups as $group)
            {
                $groupMemberNums[] = $this->businessService->getNumOfGroupMembers($group);
            }
            $data = ['groups' => $groups, 'groupMemberNums' => $groupMemberNums];
            return view('Groups/groupList')->with($data);
        }
        else
        {
            return view('Groups/addGroup');
        }
        
    }
    
    public function viewGroup(Request $request)
    {
        $this->businessService = new BusinessService();
        $group = $this->businessService->getGroupFromID($request->input('id'));
        $user = $this->businessService->getUserFromID($request->input('userID'));
        $groupMembers = $this->businessService->getGroupMembersFromGroupID($group->getID());
        $groupMemberNames = array();
        $isAdminOrLeader = 0;
        $isInGroup = 0;
        foreach($groupMembers as $groupMember)
        {
            $groupMemberNames[] = $this->businessService->getUserFromID($groupMember->getUserID())->getUsername();
            if($groupMember->getUserID() == $user->getID())
            {
                $isInGroup = 1;
            }
            if($groupMember->getUserID() == $user->getID() && $groupMember->getIsAdminOrLeader() == 1)
            {
                $isAdminOrLeader = 1;
            }
        }
        if(session('role') == 1)
        {
            $isAdminOrLeader = 1;
        }

        $data = ['group' => $group, 'groupMembers' => $groupMembers, 'groupMemberNames' => $groupMemberNames, 'user' => $user, 'isAdminOrLeader' => $isAdminOrLeader, 'isInGroup' => $isInGroup];

        return view('Groups/groupDetails')->with($data);
    }
    
    public function joinGroup(Request $request)
    {
        $this->businessService = new BusinessService();
        $group = $this->businessService->getGroupFromID($request->input('groupId'));
        $user = $this->businessService->getUserFromID($request->input('userId'));
        $this->businessService->addGroupMember(new GroupMemberModel(null, $user->getID(), $group->getID(), 0));
        $groupMembers = $this->businessService->getGroupMembersFromGroupID($group->getID());
        $groupMemberNames = array();
        $isAdminOrLeader = 0;
        $isInGroup = 0;
        foreach($groupMembers as $groupMember)
        {
            $groupMemberNames[] = $this->businessService->getUserFromID($groupMember->getUserID())->getUsername();
            if($groupMember->getUserID() == $user->getID())
            {
                $isInGroup = 1;
            }
            if($groupMember->getUserID() == $user->getID() && $groupMember->getIsAdminOrLeader() == 1)
            {
                $isAdminOrLeader = 1;
            }
        }
        if(session('role') == 1)
        {
            $isAdminOrLeader = 1;
        }
        
        $data = ['group' => $group, 'groupMembers' => $groupMembers, 'groupMemberNames' => $groupMemberNames, 'user' => $user, 'isAdminOrLeader' => $isAdminOrLeader, 'isInGroup' => $isInGroup];
        
        return view('Groups/groupDetails')->with($data);
        
    }
    
    public function leaveGroup(Request $request)
    {
        $this->businessService = new BusinessService();
        $group = $this->businessService->getGroupFromID($request->input('groupId'));
        $user = $this->businessService->getUserFromID($request->input('userId'));
        $groupMember = $this->businessService->getGroupMemberFromUserID($group, $user->getID());
        $this->businessService->deleteGroupMember($groupMember);
        $groupMembers = $this->businessService->getGroupMembersFromGroupID($group->getID());
        $groupMemberNames = array();
        $isAdminOrLeader = 0;
        $isInGroup = 0;
        foreach($groupMembers as $groupMember)
        {
            $groupMemberNames[] = $this->businessService->getUserFromID($groupMember->getUserID())->getUsername();
            if($groupMember->getUserID() == $user->getID())
            {
                $isInGroup = 1;
            }
            if($groupMember->getUserID() == $user->getID() && $groupMember->getIsAdminOrLeader() == 1)
            {
                $isAdminOrLeader = 1;
            }
        }
        if(session('role') == 1)
        {
            $isAdminOrLeader = 1;
        }
        //If the person leaving the group is the only one in the goup
        //Delete the group and redirects to the all groups page
        if(sizeof($groupMembers) == 0)
        {
            $this->businessService->deleteGroup($group);
            $groups = $this->businessService->getAllGroups();
            $groupMemberNums = array();
            foreach($groups as $group)
            {
                $groupMemberNums[] = $this->businessService->getNumOfGroupMembers($group);
            }
            $data = ['groups' => $groups, 'groupMemberNums' => $groupMemberNums];
            return view('Groups/groupList')->with($data);
        }
        
        $data = ['group' => $group, 'groupMembers' => $groupMembers, 'groupMemberNames' => $groupMemberNames, 'user' => $user, 'isAdminOrLeader' => $isAdminOrLeader, 'isInGroup' => $isInGroup];
        
        return view('Groups/groupDetails')->with($data);
        
    }
    
    public function editGroup(Request $request)
    {
        $this->businessService = new BusinessService();
        $group = new GroupModel($request->input('id'), $request->input('title'), $request->input('description'));
        $this->businessService->updateGroup($group);
        $groups = $this->businessService->getAllGroups();
        $groupMemberNums = array();
        foreach($groups as $group)
        {
            $groupMemberNums[] = $this->businessService->getNumOfGroupMembers($group);
        }
        $data = ['groups' => $groups, 'groupMemberNums' => $groupMemberNums];
        return view('Groups/groupList')->with($data);
    }
    
    public function toEditGroup(Request $request)
    {
        $this->businessService = new BusinessService();
        $group = $this->businessService->getGroupFromID($request->input('groupId'));
        $groupMembers = $this->businessService->getGroupMembersFromGroupID($group->getID());
        $groupMemberNames = array();
        foreach($groupMembers as $groupMember)
        {
            $groupMemberNames[] = $this->businessService->getUserFromID($groupMember->getUserID())->getUsername();
        }
        
        $data = ['group' => $group, 'groupMembers' => $groupMembers, 'groupMemberNames' => $groupMemberNames];
        return view('Groups/editGroup')->with($data);
        
    }
    
    public function deleteGroup(Request $request)
    {
        $this->businessService = new BusinessService();
        $group = $this->businessService->getGroupFromID($request->input('groupId'));
        $this->businessService->deleteGroup($group);
        $groups = $this->businessService->getAllGroups();
        $groupMemberNums = array();
        foreach($groups as $group)
        {
            $groupMemberNums[] = $this->businessService->getNumOfGroupMembers($group);
        }
        $data = ['groups' => $groups, 'groupMemberNums' => $groupMemberNums];
        return view('Groups/groupList')->with($data);
        
    }
}
