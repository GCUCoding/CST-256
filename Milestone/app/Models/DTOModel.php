<?php
namespace App\Models;

class DTOModel implements \JsonSerializable
{
    private $errorCode;
    private $errorMessage;
    private $data;
    public function __construct($errorCode, $errorMessage, $data)
    {
        $this->errorCode = $errorCode;
        $this->errorMessage = $errorMessage;
        $this->data = $data;
    }
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

}

