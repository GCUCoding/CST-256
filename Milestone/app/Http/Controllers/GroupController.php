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
        $data = ['groupMembers' => $groupMembers, 'user' => $user];
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
}
