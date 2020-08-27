<?php
namespace App;

use App\Config\Database;
use App\Config\TwigConfig;
use  App\Config\SessionHandler;

include '../../../app/config/config.php';


$db = new Database();
$session = new SessionHandler();
$twig = new TwigConfig();
$user = new User($db);
$users = $user->getUsersList();

$view = $twig->render('login.html', [
    "message" => $session->getErrorMessage()
]);

$view = "";
foreach ($users as $item) {
    foreach ($item as $key => $value) {
        $view .= "$value<br>";
    }
    
}
// $view = "";

echo $twig->renderTemplate('Usuários', $view, ["../../css/news-write.css"], 2);
$session->setErrorMessage("");
