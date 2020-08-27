<?php
namespace App;

use App\Config\Database;
use App\Config\TwigConfig;
use App\News;
use  App\Config\SessionHandler;

include '../../app/config/config.php';


$session = new SessionHandler();
$twig = new TwigConfig();
if (isset($_SESSION['logged'])) {
    header("Location: ../home");
}

$view = $twig->render('login.html', [
    "message" => $session->getErrorMessage()
]);

echo $twig->renderTemplate('Acessar Conta', $view, ["../css/news-write.css"]);
$session->setErrorMessage("");
