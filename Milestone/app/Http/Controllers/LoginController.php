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
        $username = $request->input('username');
        $password = $request->input('password');
        if($this->businessService->Authenticate($username, $password))
        {
            $credentials = new UserModel($request->input('username'), $request->input('password'));
            $data = ['credentials' => $credentials];
            return view('home')->with($data);
        }
        else 
        {
            return view('login');
        }
    }
}
