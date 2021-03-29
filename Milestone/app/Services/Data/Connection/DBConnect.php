<?php
namespace App\Services\Data\Connection;

use mysqli;

// provides access to a database
class DBConnect
{

    // declares fields necessary for a database connection
    private $conn;

    private $servername = "localhost";

    private $username = "root";

    private $password = "root";

    private $dbName = "Milestone";

    private $dbQuery;

    // no-args contructor creates a connection with the database
    public function __construct()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbName);
    }
    
    public function connect()
    {
        return $this->conn;
    }

}

