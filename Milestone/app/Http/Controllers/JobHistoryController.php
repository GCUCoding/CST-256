<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Business\BusinessService;
use App\Models\JobHistoryModel;

class JobHistoryController extends Controller
{
    private $businessService;
    public function index(Request $request)
    {
        $this->businessService = new BusinessService();
        $userInfo = $this->businessService->getUserInfoFromID($request->input('profileID'));
        $jobHistories = $this->businessService->getJobHistoryFromUserInfo($userInfo);
        $data = ['jobHistories' => $jobHistories];
        return view('JobHistory/jobHistory')->with($data);
    }
    
    public function addJobHistory(Request $request)
    {
        $this->businessService = new BusinessService();
        $user = $this->businessService->getUserFromID(session('userID'));
        $userInfo = $this->businessService->getUserInfo($user);
        $profileID = $userInfo->getID();
        $data = ['profileID' => $profileID];
        return view('JobHistory/addJobHistory')->with($data);
    }
    
    public function createJobHistory(Request $request)
    {
        $this->businessService = new BusinessService();
        $jobHistory = new JobHistoryModel(null, $request->input('title'), $request->input('startDate'), $request->input('endDate'), $request->input('description'), $request->input('company'), $request->input('profileID'), null);
        $this->businessService->addJobHistory($jobHistory);
        $userInfo = $this->businessService->getUserInfoFromID($request->input('profileID'));
        $jobHistories = $this->businessService->getJobHistoryFromUserInfo($userInfo);
        $data = ['jobHistories' => $jobHistories];
        return view('JobHistory/jobHistory')->with($data);
    }
    
    public function jobHistoryEditPage(Request $request)
    {
        $this->businessService = new BusinessService();
        $jobHistory = $this->businessService->getJobHistoryFromID($request->input('id'));
        $data = ['jobHistory' => $jobHistory];
        return view('JobHistory/editJobHistory')->with($data);
    }
    
    public function editJobHistory(Request $request)
    {
        $this->businessService = new BusinessService();
        $jobHistory = new JobHistoryModel($request->input('id'), $request->input('title'), $request->input('startDate'), $request->input('endDate'), $request->input('description'), $request->input('company'), null, null);
        $this->businessService->updateJobHistory($jobHistory);
        $userInfo = $this->businessService->getUserInfoFromID($request->input('profileID'));
        $jobHistories = $this->businessService->getJobHistoryFromUserInfo($userInfo);
        $data = ['jobHistories' => $jobHistories];
        return view('JobHistory/jobHistory')->with($data);
    }
    
    public function viewJobHistoryDetails(Request $request)
    {
        $this->businessService = new BusinessService();
        $jobHistory = $this->businessService->getJobHistoryFromID($request->input('id'));
        $data = ['jobHistory' => $jobHistory];
        return view('JobHistory/jobHistoryDetails')->with($data);
    }
}
