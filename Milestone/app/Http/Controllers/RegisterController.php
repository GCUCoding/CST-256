<?php

namespace App\Http\Controllers;
use App\Services\Business\BusinessService;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\ProfileModel;
use App\Models\EducationModel;

//handles user registration
class RegisterController extends Controller
{
    //declares a variable to be used to hold a BusinessService object
    private $businessService;
    
    //handles registration and "logs user in"
    public function index(Request $request)
    {
        //ensures data entered is in a valid format
        $this->validateForm($request);
        
        //initializes a new BusinessService object
        $this->businessService = new BusinessService();
        
        //takes the username and password from a form
        $username = $request->input('username');
        $password = $request->input('password');
        
        //creates a new UserModel object
        $user = new UserModel(null, $username, $password, null);
        
        //attempts to register a new user
        if($this->businessService->AddUser($user))
        {

            //overwrites the UserModel with its equivalent from the database
            $user = $this->businessService->getUserFromUsername($username);
            

            //gets the user ID from the new user 
            $userID = $user->getID();
            
            //creates a new ProfileModel object with the user's ID to be used as a foreign key
            $userInfo = new ProfileModel(null, null, null, null, null, null, null, null, $userID);
            
            //adds the user's userinfo to the database
            $this->businessService->addUserInfo($userInfo);

            //gets the new ProfileModel from the database
            $userInfo = $this->businessService->getUserInfo($user);
            
            $userInfoID = $userInfo->getID();

            //creates a new EducationModel object with the user info's ID to be used as a foreign key
            $education = new EducationModel(null, null, null, null, 0.00, null, $userInfoID);

            //adds the user's education to the database
            $this->businessService->addEducation($education);
            
            //effectively logs user in
            if(null == session('userID'))
            {
                session_start();
                session(['userID' => $user->getID()]) ;
                session(['role' => $user->getRole()]) ;
            }
            else
            {
                session_abort();
                session_start();
                session(['userID' => $user->getID()]) ;
                session(['role' => $user->getRole()]) ;
            }
            //returns the user to the website home page after registration
            return View('home');
        }
        else 
        {
            //returns the user to registration page if registration fails
            return View('registration');
        }
    }
    
    public function validateForm(Request $request)
    {
        //setup Data Validation Rules for Login Form
        $rules = ['username' => 'Required | Between: 1, 50',
            'password' => 'Required | Between: 1, 50'];
        //Run data validation rules
        $this->validate($request, $rules);
    }
}
