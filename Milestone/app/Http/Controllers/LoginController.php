<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use App\Services\Business\BusinessService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    private $businessService;
    
    public function index(Request $request)
    {
        
        $this->businessService = new BusinessService();
        $this->validateForm($request);
        $username = $request->input('username');
        $password = $request->input('password');
        if($this->businessService->Authenticate($username, $password))
        {
            $this->businessService = new BusinessService();
            $user = $this->businessService->getUserFromUsername($username);
            $data = ['credentials' => $user];
            //setting up the session ID allows for potential automatic login
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
            //returns the admin view if the user is an admin or has extended permissions
            if($user->getRole() == 1 || $user->getRole() == 2)
            {
                $this->businessService = new BusinessService();
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
                $this->businessService = new BusinessService();
                $userInfo = $this->businessService->getUserInfo($user);
                $data = ['userInfo' => $userInfo];
                return view('Customer/userProfile')->with($data);
            }
        }
        else 
        {
            return view('login');
        }
    }
    
    public function userAccess()
    {
        if(null === session('role') || session('role') == -1)
        {
            return view('Customer/suspended');
        }
        else if(session('role') == 1 || session('role') == 2)
        {
            $this->businessService = new BusinessService();
            $users = $this->businessService->getAllUsers();
            $data = ['users' => $users];
            return view('Admin/users')->with($data);
        }
        else 
        {
            $this->businessService = new BusinessService();
            $user = $this->businessService->getUserFromID(session('userID'));
            $this->businessService = new BusinessService();
            $userInfo = $this->businessService->getUserInfo($user);
            $data = ['userInfo' => $userInfo];
            return view('Customer/userProfile')->with($data);
        }
    }
    
    private function validateForm(Request $request)
    {
        //setup Data Validation Rules for Login Form
        $rules = ['username' => 'Required | Between: 1, 50',
            'password' => 'Required | Between: 1, 50'];
        //Run data validation rules
        $this->validate($request, $rules);
    }
}
