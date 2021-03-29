<?php
namespace App\Services\Business;

class BusinessValidation
{

    public function __construct()
    {
        
    }
    
    public function cleanString($string)
    {
        return str_replace("'", "\'", $string);
    }
}

