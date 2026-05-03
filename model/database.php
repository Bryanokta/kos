<?php
class Database
{
    private $host = "localhost";
    private $user = "bryan";
    private $pass = "bryan.04";
    private $db = "kos_management";
    protected $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
}
