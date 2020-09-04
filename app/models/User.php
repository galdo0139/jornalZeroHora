<?php

namespace App\Models;

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


        $_SESSION['profile'] = "user";
        $_SESSION['authorName'] = $result["authorName"];
        $success = password_verify($password, $result['userPassword']);
        if (!$success) {
            $_SESSION['message'] = "Usuário ou senha incorreto";
        }
        return $success;
    }


    public function getUsersList()
    {
        return $this->db->select("users");
    }


    public function getUser(string $id)
    {
        return $this->db->select("users", ["userId" => $id]);
    }

    public function createUser(array $values)
    {
        //filtrar esses valores
        $data = [
            "userFullName" => $values['userFullName'],
            "authorName" => $values['authorName'],
            "userName" => $values['userName'],
            "userPassword" => password_hash($values['userPassword'], PASSWORD_DEFAULT)
        ];

        return $this->db->insert("users", $data);
    }

    public function editUser(array $values, int $id)
    {
        //filtrar esses valores
        $data = [
            "userFullName" => $values['userFullName'],
            "authorName" => $values['authorName'],
            "userName" => $values['userName'],
        ];
        return $this->db->update("users", $values, "userId", $id);
    }

    public function deleteUser(string $id)
    {
        return $this->db->delete("users", "userId", $id);
    }
}

