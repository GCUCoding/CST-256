<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Business\BusinessService;
use App\Models\JobListingModel;

class JobListingController extends Controller
{
    private $businessService;
    public function index(Request $request)
    {
        $this->businessService = new BusinessService();
        $jobListings = $this->businessService->getActiveJobListings();
        $data = ['jobListings' => $jobListings];
        return view('JobListings/joblistings')->with($data);
    }
    
    public function addJobPage(Request $request)
    {
        $this->businessService = new BusinessService();
        if($request->input('role') > 2 || $request->input('role') < 1)
        {
            $jobListings = $this->businessService->getActiveJobListings();
            $data = ['jobListings' => $jobListings];
            return view('JobListings/joblistings')->with($data);
        }
        else
        {
            return view('JobListings/addJob');
        }
    }
    
    public function createNewJob(Request $request)
    {
        $this->businessService = new BusinessService();
        $jobListing = new JobListingModel(null, $request->input('title'), $request->input('startDate'), $request->input('endDate'), $request->input('description'), $request->input('qualifications'), $request->input('company'), $request->input('position'), $request->input('schedule'), $request->input('pay'), null);
        $this->businessService->addJobListing($jobListing);
        $jobListings = $this->businessService->getActiveJobListings();
        $data = ['jobListings' => $jobListings];
        return view('JobListings/joblistings')->with($data);
    }
    
    public function viewJobDetails(Request $request)
    {
        $this->businessService = new BusinessService();
        $jobListing = $this->businessService->getJobListingFromID($request->input('id'));
        $data = ['jobListing' => $jobListing];
        return view('JobListings/jobDetails')->with($data);
    }
    
    public function editJobListing(Request $request)
    {
        $this->businessService = new BusinessService();
        $jobListing = new JobListingModel($request->input('id'), $request->input('title'), $request->input('startDate'), $request->input('endDate'), $request->input('description'), $request->input('qualifications'), $request->input('company'), $request->input('position'), $request->input('schedule'), $request->input('pay'), $request->input('active'));
        $this->businessService->updateJobListing($jobListing);
        $jobListing = $this->businessService->getJobListingFromID($request->input('id'));
        $data = ['jobListing' => $jobListing];
        return view('JobListings/jobDetails')->with($data);
    }
    
    public function viewEditPage(Request $request)
    {
        $this->businessService = new BusinessService();
        $jobListing = $this->businessService->getJobListingFromID($request->input('id'));
        $data = ['jobListing' => $jobListing];
        return view('JobListings/editJob')->with($data);
    }
}
