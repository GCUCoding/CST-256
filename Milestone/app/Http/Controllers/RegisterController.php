<?php

namespace App\Http\Controllers;
use App\Services\Business\BusinessService;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\ProfileModel;

class RegisterController extends Controller
{
    private $businessService;
    public function index(Request $request)
    {
        $this->validateForm($request);
        $this->businessService = new BusinessService();
        $username = $request->input('username');
        $password = $request->input('password');
        $user = new UserModel(null, $username, $password, null);
        if($this->businessService->AddUser($user))
        {
            $this->businessService = new BusinessService();
            $user = $this->businessService->getUserFromUsername($username);
            $this->businessService = new BusinessService();
            $userID = $user->getID();
            $userInfo = new ProfileModel(null, null, null, null, null, null, null, null, $userID);
            $this->businessService->addUserInfo($userInfo);
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
            return View('home');
        }
        else 
        {
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
