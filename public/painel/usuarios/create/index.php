<?php
namespace App;

use App\Library\Database;
use App\Library\SessionHandler;
use App\Library\TwigConfig;
use App\Models\User;

include '../../../../app/config/autoloader.php';


$session = new SessionHandler();


$view = $twig->render('usuarios/createUser.html', [
    "action" => "../register/",
    "message" => $session->getErrorMessage()
]);


echo $twig->renderTemplate('Acessar Conta', $view, ["news-write.css"], 3);
$session->setErrorMessage("");
