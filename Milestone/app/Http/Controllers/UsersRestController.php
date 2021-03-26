<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Business\BusinessService;
use App\Models\DTOModel;

class UsersRestController extends Controller
{
    private $businessService;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->businessService = new BusinessService();
        $users = $this->businessService->getAllUsers();
        $data = array();
        foreach ($users as $user)
        {
            $data[] = $this->businessService->getUserInfo($user);
        }
        if(sizeof($data) == 0)
        {
            $errorCode = 456;
            $errorMessage = "No users found.";
            $dto = new DTOModel($errorCode, $errorMessage, $data);
        }
        else
        {
            $errorCode = 0;
            $errorMessage = "Successfully found users:";
            $dto = new DTOModel($errorCode, $errorMessage, $data);
        }
        return $dto->jsonSerialize();
    }

    public function show($id)
    {
        $this->businessService = new BusinessService();
        $data = $this->businessService->getUserInfoFromID($id);
        if($data == null)
        {
            $errorCode = 456;
            $errorMessage = "No users found.";
            $dto = new DTOModel($errorCode, $errorMessage, $data);
        }
        else
        {
            $errorCode = 0;
            $errorMessage = "Successfully found users:";
            $dto = new DTOModel($errorCode, $errorMessage, $data);
        }
        return $dto->jsonSerialize();
    }

}
