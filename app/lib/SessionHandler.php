<?php

namespace App\Config;

class SessionHandler{
    public function __construct()
    {
        session_start();
    }

    public function Authorize(string $profile = null)
    {
        if(!isset($_SESSION['logged'])){
            $_SESSION['message'] = "Acesso negado. Você não está logado";
            header("Location: ../login");
        }
    }
}