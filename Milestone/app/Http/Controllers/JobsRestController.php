<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Business\BusinessService;
use App\Models\DTOModel;

class JobsRestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->businessService = new BusinessService();
        $data = $this->businessService->getAllJobListings();
        if(sizeof($data) == 0)
        {
            $errorCode = 456;
            $errorMessage = "No jobs found.";
            $dto = new DTOModel($errorCode, $errorMessage, $data);
        }
        else
        {
            $errorCode = 0;
            $errorMessage = "Successfully found jobs:";
            $dto = new DTOModel($errorCode, $errorMessage, $data);
        }
        return $dto->jsonSerialize();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->businessService = new BusinessService();
        $data = $this->businessService->getJobListingFromID($id);
        if($data == null)
        {
            $errorCode = 456;
            $errorMessage = "No job found.";
            $dto = new DTOModel($errorCode, $errorMessage, $data);
        }
        else
        {
            $errorCode = 0;
            $errorMessage = "Successfully found job:";
            $dto = new DTOModel($errorCode, $errorMessage, $data);
        }
        return $dto->jsonSerialize();
    }

}
