<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Business\BusinessService;
use App\Models\ProfileModel;

//enables users to edit their own data
class CustomerController extends Controller
{
    //creates a placeholder for BusinessService objects to be used later
    private $businessService;
    
    //allows user to edit their own Profile information
    public function editUserInfo(Request $request)
    {
        //creates a new ProfileModel object based on form information sent
        $userInfo = new ProfileModel($request->input('id'), $request->input('email'), $request->input('phone'), $request->input('gender'), 
                $request->input('nationality'), $request->input('description'), $request->input('skills'), $request->input('certifications'), $request->input('userID'));
        
        //initializes a new BusinessService object
        $this->businessService = new BusinessService();
        
        //updates the user info based on the profile information provided
        $this->businessService->updateUserInfo($userInfo);
        $user = $this->businessService->getUserFromID(session('userID'));
        $userInfo = $this->businessService->getUserInfo($user);
        $jobHistories = $this->businessService->getJobHistoryFromUserInfo($userInfo);
        $educations = $this->businessService->getEducationFromProfile($userInfo);
        $data = ['user' => $user, 'userInfo' => $userInfo, 'jobHistories' => $jobHistories, 'educations' => $educations];
        return view('Customer/userProfileDetails')->with($data);
    }
}
