<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Business\BusinessService;
use App\Models\EducationModel;
use Psy\Command\BufferCommand;

class EducationController extends Controller
{
    private $businessService;
    public function Index(Request $request)
    {
        $this->businessService = new BusinessService();
        $education = $this->businessService->getEducationFromID($request->input('id'));
        $data = ['education' => $education];
        return view('Customer/education')->with($data);
    }
     
    public function edit(Request $request)
    {
        $this->businessService = new BusinessService();
        $education = new EducationModel($request->input('id'), $request->input('startDate'), $request->input('endDate'), $request->input('institution'), $request->input('gpa'), $request->input('title'), $request->input('profileID'));
        $this->businessService->updateEducation($education);
        $user = $this->businessService->getUserFromID(session('userID'));
        $userInfo = $this->businessService->getUserInfo($user);
        $jobHistories = $this->businessService->getJobHistoryFromUserInfo($userInfo);
        $educations = $this->businessService->getEducationFromProfile($userInfo);
        $data = ['user' => $user, 'userInfo' => $userInfo, 'jobHistories' => $jobHistories, 'educations' => $educations];
        return view('Customer/userProfileDetails')->with($data);
    }
    
    public function addEducation()
    {
        return view('Education/addEducation');
    }
    
    public function newEducation(Request $request)
    {
        $this->businessService = new BusinessService();
        $user = $this->businessService->getUserFromID($request->input('userID'));
        $userInfo = $this->businessService->getUserInfo($user);
        $education = new EducationModel(null, $request->input('startDate'), $request->input('endDate'), $request->input('institution'), $request->input('gpa'), $request->input('title'), $userInfo->getID());
        $this->businessService->addEducation($education);
        $jobHistories = $this->businessService->getJobHistoryFromUserInfo($userInfo);
        $educations = $this->businessService->getEducationFromProfile($userInfo);
        $data = ['user' => $user, 'userInfo' => $userInfo, 'jobHistories' => $jobHistories, 'educations' => $educations];
        return view('Customer/userProfileDetails')->with($data);
        
    }

    public function deleteEducation(Request $request)
    {
        $this->businessService = new BusinessService();
        $this->businessService->deleteEducation($this->businessService->getEducationFromID($request->input('id')));
        $user = $this->businessService->getUserFromID(session('userID'));
        $userInfo = $this->businessService->getUserInfo($user);
        $jobHistories = $this->businessService->getJobHistoryFromUserInfo($userInfo);
        $educations = $this->businessService->getEducationFromProfile($userInfo);
        $data = ['user' => $user, 'userInfo' => $userInfo, 'jobHistories' => $jobHistories, 'educations' => $educations];
        return view('Customer/userProfileDetails')->with($data);
    }

}
