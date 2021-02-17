<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Business\BusinessService;
use App\Models\ProfileModel;

class CustomerController extends Controller
{
    private $businessService;
    
    public function editUserInfo(Request $request)
    {
        $userInfo = new ProfileModel($request->input('id'), $request->input('email'), $request->input('phone'), $request->input('gender'), 
                $request->input('nationality'), $request->input('description'), $request->input('skills'), $request->input('certifications'), $request->input('userID'));
        $this->businessService = new BusinessService();
        $this->businessService->updateUserInfo($userInfo);
        $this->businessService = new BusinessService();
        $user = $this->businessService->getUserFromID($userInfo->getUserID());
        $this->businessService = new BusinessService();
        $userInfo = $this->businessService->getUserInfo($user);
        $data = ['userInfo' => $userInfo];
        return view('Customer/userProfile')->with($data);
    }
}
