<?php
namespace App;

use App\Config\Database;
use App\Config\TwigConfig;
use  App\Config\SessionHandler;

include '../../../app/config/autoloader.php';

$session = new SessionHandler();
$user = new User($db);
$users = $user->getUsersList();

// dd($users);
$view = $twig->render('usuarios/usersList.html', [
    "users" => $users,
    "message" => $session->getErrorMessage()
]);

echo $twig->renderTemplate('Usuários', $view, ["news-list.css"], 2);
$session->setErrorMessage("");
