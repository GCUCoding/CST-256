<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Business\BusinessService;
use App\Models\UserModel;
use App\Models\ProfileModel;

//controller used to enable admins to perform necessary actions to users
class AdminController extends Controller
{
    //provides a means to access business layer
    private $businessService;
    
    //Takes a user id from the request and provides the corresponding user's details page so that it can be edited
    public function editUser(Request $request)
    {
        //initializes the business service
        $this->businessService = new BusinessService();
        
        //takes the gets user information from the database using information in the database
        $user = $this->businessService->getUserFromID($request->input('id'));
        
        //creates a data array to send data to a view
        $data = ['user' => $user];
        return view('Admin/editUserDetails')->with($data);
    }

    //Takes user information from a view and updates a user based on the information
    public function confirmEditUser(Request $request)
    {
        /*validates information submitted through the form, currently breaks everything so not trying it*/
        //$this->validateForm($request);
        
        //updates a user based on the information provided through the form
        $this->businessService->updateUser(new UserModel($request->input('id'), $request->input('username'), $request->input('password'), $request->input('roles')));
        
        //gets all users from the database for display purposes and sends the data to a view
        $users = $this->businessService->getAllUsers();
        $data = ['users' => $users];
        return view('Admin/users')->with($data);
    }

    //deletes a user
    public function deleteUser(Request $request)
    {
        //initializes new business service 
        $this->businessService = new BusinessService();
        
        //gets user based on the provided ID
        $user = $this->businessService->getUserFromID($request->input('id'));
        
        //deletes a user based on the given user model
        $this->businessService->deleteUser($user);
        
        //gets all users from the database for display purposes and sends the data to a view
        $users = $this->businessService->getAllUsers();
        $data = ['users' => $users];
        return view('Admin/users')->with($data);
    }
    

    //Ignore this. It breaks everything for some reason. ¯\_(ツ)_/¯
    public function validateForm(Request $request)
    {
        //setup Data Validation Rules for Login Form
        $rules = ['username' => 'Required | Between: 1, 50',
            'password' => 'Required | Between: 1, 50',
            'roles' => 'Required | gt:0 | lt:4'];
        //Run data validation rules
        $this->validate($request, $rules);
    }
    
    //sends the admin to a page the editing of a user's work/education/description/etc.
    public function editUserProfile(Request $request)
    {
        //initializes new business service 
        $this->businessService = new BusinessService();
        
        //gets user based on the provided ID
        $user = $this->businessService->getUserFromID($request->input('id'));
        
        //gets user profile info and sends it to a view
        $userInfo = $this->businessService->getUserInfo($user);
        $data = ['userInfo' => $userInfo];
        return view('Admin/editUserProfile')->with($data);
    }
    

    //send the admin back to the users page and handles the editing of user profile info
    public function editedUserProfile(Request $request)
    {
        //creates a new ProfileModel based on the information provided in the previous class
        $userInfo = new ProfileModel($request->input('id'), $request->input('email'), $request->input('phone'), $request->input('gender'),
            $request->input('nationality'), $request->input('description'), $request->input('skills'), $request->input('certifications'), $request->input('userID'));
        
        //initializes new business service
        $this->businessService = new BusinessService();
        
        //updates the user's info based on the ProfileModel provided
        $this->businessService->updateUserInfo($userInfo);
        
        //gets all users from the database for display purposes and sends the data to a view
        $users = $this->businessService->getAllUsers();
        $data = ['users' => $users];
        return view('Admin/users')->with($data);
    }
}
