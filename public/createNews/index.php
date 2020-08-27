<?php
namespace App;

use App\Config\Database;
use App\Config\SessionHandler;
use App\Config\TwigConfig;
use App\News;

include '../../app/config/config.php';


$db = new Database();
$session = new SessionHandler();
$news = new News($db);
$twig = new TwigConfig();
$session->Authorize();

$data = [
    'newsTitle' => $_POST['title'],
    'newsDescription' => $_POST['subtitle'],
    'newsContent' => $_POST['writeContent'],
    'newsAuthor' => 1,
    'createdAt' => date("Y-m-d H:i:s"),
    'newsLink' => $_POST['link']
];

$isCreated = $news->createNews($data);


$view = "Notícia cadastrada com sucesso";
if (!$isCreated) {
    $view = "Ocorreu um erro ao cadastrar sua notícia";
}


echo $twig->renderTemplate('Salvar Notícia', $view, [
    "../css/news-card.css",
    "../css/news-main.css"
]);