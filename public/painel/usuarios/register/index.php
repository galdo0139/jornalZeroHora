<?php
namespace App;

use App\Library\Database;
use App\Library\SessionHandler;
use App\Library\TwigConfig;
use App\Models\User;

include '../../../../app/config/autoloader.php';


$session = new SessionHandler();
$user = new User($db);


if($user->createUser($_POST)){
    header("Location: ../");
}
$path = "create";




$session->setErrorMessage("Erro ao cadastrar usuário");
header("Location: ../$path");
