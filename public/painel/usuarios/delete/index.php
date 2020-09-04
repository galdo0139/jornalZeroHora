<?php
namespace App;

use App\Library\Database;
use App\Library\SessionHandler;
use App\Library\TwigConfig;
use App\Models\User;

include '../../../../app/config/autoloader.php';


$session = new SessionHandler();
$user = new User($db);


$id = $_GET['id'];


$session->setErrorMessage("Erro ao excluir usuário");
if($user->deleteUser($id)){
    $session->setErrorMessage("Usuário excluído com sucesso");
}

header("Location: ../");
