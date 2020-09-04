<?php
namespace App;

use App\Library\Database;
use App\Library\SessionHandler;
use App\Library\TwigConfig;
use App\Models\User;

include '../../../../app/config/autoloader.php';


$user = new User($db);
$session = new SessionHandler();


$id = $_GET['id'];
$userData = $user->getUser($id);

$view = $twig->render('usuarios/createUser.html', [
    "action" => "../update/?id=$id",
    "user" => $userData,
    "message" => $session->getErrorMessage()
]);

echo $twig->renderTemplate('Acessar Conta', $view, ["news-write.css"],3);
$session->setErrorMessage("");