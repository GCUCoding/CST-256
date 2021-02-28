<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Business\BusinessService;
use App\Models\EducationModel;

class EducationController extends Controller
{
    private $businessService;
    public function Index(Request $request)
    {
        $this->businessService = new BusinessService();
        $profileID = $request->input('profileID');
        $userInfo = $this->businessService->getUserInfoFromID($profileID);
        $educations = $this->businessService->getEducationFromProfile($userInfo);
        $data = ['educations' => $educations];
        return view('Customer/education')->with($data);
    }
     
    public function edit(Request $request)
    {
        $this->businessService = new BusinessService();
        $education = new EducationModel($request->input('id'), $request->input('startDate'), $request->input('endDate'), $request->input('institution'), $request->input('gpa'), $request->input('title'), $request->input('profileID'));
        $this->businessService->updateEducation($education);
        $education = $this->businessService->getEducation($education);
        $userInfo = $this->businessService->getUserInfoFromID($education->getProfileID());
        $educations = $this->businessService->getEducationFromProfile($userInfo);
        $data = ['educations' => $educations];
        return view('Customer/education')->with($data);
    }
}
