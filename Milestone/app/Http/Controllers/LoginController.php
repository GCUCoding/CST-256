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
            session_start();
            $_SESSION['userID'] = $user->getID();
            if($user->getRole() == 1 || $user->getRole() == 2)
            {
                $this->businessService = new BusinessService();
                $users = $this->businessService->getAllUsers();
                $data = ['users' => $users];
                return view('Admin/users')->with($data);
            }
            else 
            {
                return view('home')->with($data);
            }
        }
        else 
        {
            return view('login');
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
