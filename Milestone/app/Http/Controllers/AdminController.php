<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Business\BusinessService;
use App\Models\UserModel;
use App\Models\ProfileModel;

class AdminController extends Controller
{
    private $businessService;
    public function editUser(Request $request)
    {
        $this->businessService = new BusinessService();
        $user = $this->businessService->getUserFromID($request->input('id'));
        $data = ['user' => $user];
        return view('Admin/editUserDetails')->with($data);
    }
    
    public function confirmEditUser(Request $request)
    {
        //$this->validateForm($request);
        $this->businessService = new BusinessService();
        $this->businessService->updateUser(new UserModel($request->input('id'), $request->input('username'), $request->input('password'), $request->input('roles')));
        $this->businessService = new BusinessService();
        $users = $this->businessService->getAllUsers();
        $data = ['users' => $users];
        return view('Admin/users')->with($data);
    }
    
    public function deleteUser(Request $request)
    {
        $this->businessService = new BusinessService();
        $user = $this->businessService->getUserFromID($request->input('id'));
        $this->businessService = new BusinessService();
        $this->businessService->deleteUser($user);
        $this->businessService = new BusinessService();
        $users = $this->businessService->getAllUsers();
        $data = ['users' => $users];
        return view('Admin/users')->with($data);
    }
    
    public function validateForm(Request $request)
    {
        //setup Data Validation Rules for Login Form
        $rules = ['username' => 'Required | Between: 1, 50',
            'password' => 'Required | Between: 1, 50',
            'roles' => 'Required | gt:0 | lt:4'];
        //Run data validation rules
        $this->validate($request, $rules);
    }
    
    public function editUserProfile(Request $request)
    {
        $this->businessService = new BusinessService();
        $user = $this->businessService->getUserFromID($request->input('id'));
        $this->businessService = new BusinessService();
        $userInfo = $this->businessService->getUserInfo($user);
        $data = ['userInfo' => $userInfo];
        return view('Admin/editUserProfile')->with($data);
    }
    
    public function editedUserProfile(Request $request)
    {
        $userInfo = new ProfileModel($request->input('id'), $request->input('email'), $request->input('phone'), $request->input('gender'),
            $request->input('nationality'), $request->input('description'), $request->input('skills'), $request->input('certifications'), $request->input('userID'));
        $this->businessService = new BusinessService();
        $this->businessService->updateUserInfo($userInfo);
        $this->businessService = new BusinessService();
        $users = $this->businessService->getAllUsers();
        $data = ['users' => $users];
        return view('Admin/users')->with($data);
    }
}
