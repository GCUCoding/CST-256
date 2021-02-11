<?php

namespace App\Http\Controllers;
use App\Services\Business\BusinessService;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    private $businessService;
    public function index(Request $request)
    {
        $this->validateForm($request);
        $this->businessService = new BusinessService();
        $username = $request->input('username');
        $password = $request->input('password');
        if($this->businessService->AddUser($username, $password))
        {
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
        $rules = ['username' => 'Required | Between: 1, 50 | Alpha',
            'password' => 'Required | Between: 1, 50'];
        //Run data validation rules
        $this->validate($request, $rules);
    }
}
