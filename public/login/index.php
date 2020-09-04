<?php
namespace App;

use App\Library\Database;
use App\Library\SessionHandler;
use App\Library\TwigConfig;

include '../../app/config/autoloader.php';

$session = new SessionHandler();
if (isset($_SESSION['logged'])) {
    header("Location: ../home");
}

$view = $twig->render('login.html', [
    "message" => $session->getErrorMessage()
]);

echo $twig->renderTemplate('Acessar Conta', $view, ["../css/news-write.css"]);
$session->setErrorMessage("");
