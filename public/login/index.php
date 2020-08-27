<?php
namespace App;

use App\Config\Database;
use App\Config\TwigConfig;
use App\News;
use  App\Config\SessionHandler;

include '../../app/config/config.php';


$session = new SessionHandler();
$twig = new TwigConfig();

$view = $twig->render('login.html', [
    "message" => $_SESSION['message']
]);

echo $twig->renderTemplate('Acessar Conta', $view, ["../css/news-write.css"]);

