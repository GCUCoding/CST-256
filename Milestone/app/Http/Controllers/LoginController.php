<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use App\Services\Business\BusinessService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

//handles logging in
class LoginController extends Controller
{
    //declares a variable to hold a BusinessService Object
    private $businessService;
    
    //logs a user in and routes them to the proper login page
    public function index(Request $request)
    {
        //initializes a new BusinessService object
        $this->businessService = new BusinessService();
        
        //validates that the login information is properly formatted
        $this->validateForm($request);
        
        //gets the username and password input in the previous form
        $username = $request->input('username');
        $password = $request->input('password');
        
        //ensures that the user is in the database
        if($this->businessService->Authenticate($username, $password))
        {
            
            //gets a UserModel object from the database with the corresponding 
            $user = $this->businessService->getUserFromUsername($username);

            //setting up the session ID allows for potential automatic login
            if(null == session('userID'))
            {
                
                //sends the user Id and role to the session
                session_start();
                session(['userID' => $user->getID()]) ;
                session(['role' => $user->getRole()]) ;
            }
            else
            {
                //restarts the session
                session_abort();
                session_start();
                session(['userID' => $user->getID()]) ;
                session(['role' => $user->getRole()]) ;
            }
            //returns the admin view if the user is an admin or has extended permissions
            if($user->getRole() == 1 || $user->getRole() == 2)
            {
                $users = $this->businessService->getAllUsers();
                $data = ['users' => $users];
                return view('Admin/users')->with($data);
            }
            //returns a special view for our sweet sweet suspended users
            else if($user->getRole() == -1)
            {
                return view('Customer/suspended');
            }
            //returns the customer view for customers
            else 
            {
                $userInfo = $this->businessService->getUserInfo($user);
                $data = ['userInfo' => $userInfo];
                return view('Customer/userProfile')->with($data);
            }
        }
        else 
        {
            //returns the login view if login fails
            return view('login');
        }
    }
    
    //returns the user to different functionality after they have reached pages after login
    public function userAccess()
    {
        //returns the suspended view if someone either has not logged in or is suspended
        if(null === session('role') || session('role') == -1)
        {
            return view('Customer/suspended');
        }
        //returns the users view if admin
        else if(session('role') == 1 || session('role') == 2)
        {
            $this->businessService = new BusinessService();
            $users = $this->businessService->getAllUsers();
            $data = ['users' => $users];
            return view('Admin/users')->with($data);
        }
        //returns the user's profile if the user is a customer
        else 
        {
            $this->businessService = new BusinessService();
            $user = $this->businessService->getUserFromID(session('userID'));
            $userInfo = $this->businessService->getUserInfo($user);
            $data = ['userInfo' => $userInfo];
            return view('Customer/userProfile')->with($data);
        }
    }
    
    public function profile(Request $request)
    {
        $this->businessService = new BusinessService();
        $user = $this->businessService->getUserFromID(session('userID'));
        $userInfo = $this->businessService->getUserInfo($user);
        $data = ['userInfo' => $userInfo];
        return view('Customer/userProfile')->with($data);
    }
    //logs user out and destroys the session
    public function logout()
    {
        Session::flush();
        return view('home');
    }
    
    //validates user login input
    private function validateForm(Request $request)
    {
        //setup Data Validation Rules for Login Form
        $rules = ['username' => 'Required | Between: 1, 50',
            'password' => 'Required | Between: 1, 50'];
        //Run data validation rules
        $this->validate($request, $rules);
    }
}
