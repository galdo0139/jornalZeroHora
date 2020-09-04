<?php
namespace App;

use App\Config\Database;
use App\Config\TwigConfig;
use App\User;
use  App\Config\SessionHandler;

include '../../../../app/config/autoloader.php';


$session = new SessionHandler();
$user = new User($db);



// dd($_POST);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $result = $user->editUser($_POST, $id);
    

    if($result == true){
        $session->setErrorMessage("Usuário editado com sucesso");
        header("Location: ../");
    }else{
        $path = "edit/?id=$id";



        $session->setErrorMessage("Erro ao editar o usuário");
        header("Location: ../$path");
    }
    
}

