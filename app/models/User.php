<?php

namespace App;

class User{
    private $user = "a";
    protected $db;


    public function __construct(object $db)
    {
        $this->db = $db;
    }

    public function isLogged()
    {
        return (isset($_SESSION['logged']))? true: false;
    }

    public function authenticate(array $loginData)
    {
        $username = $loginData['user'];
        $password = $loginData['password'];
        
       // $password =  password_hash("ABC123", PASSWORD_DEFAULT);
        $result = $this->db->select("users", ["userName" => $username]);
        

        return (password_verify($password, $result['userPassword']));
    }
}