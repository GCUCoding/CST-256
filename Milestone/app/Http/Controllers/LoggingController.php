<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Data\Utility\ILoggerService;

class LoggingController extends Controller
{
    //protected class variable
    protected $logger;
    
    //constructor - injecting the IloggerService into the controller
    public function __construct(ILoggerService $logger)
    {
        //set the method argument to the logger class variable
        $this->logger = $logger;
    }
    
    //index method
    //call the info method on the logger class vairable
    public function index()
    {
        echo "In index()<br/>";
        $this->logger->info("Entering LoggingCotroller.index()");
        echo "Out of index()";
    }
    
    
}
