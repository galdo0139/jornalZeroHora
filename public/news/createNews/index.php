<?php
namespace App;

use App\Library\Database;
use App\Library\SessionHandler;
use App\Library\TwigConfig;
use App\Models\News;

include '../../../app/config/autoloader.php';


$session = new SessionHandler();
$news = new News($db);
$session->Authorize();

$data = [
    'newsTitle' => $_POST['title'],
    'newsDescription' => $_POST['subtitle'],
    'newsContent' => $_POST['writeContent'],
    'newsAuthor' => 1,
    'createdAt' => date("Y-m-d H:i:s"),
    'newsLink' => $_POST['link'],
    'newsCoverPath' => $_POST['cover'],
];

$tmpCoverPath = $_POST['cover'];




$successCreatingNews = $news->createNews($data);



if ($successCreatingNews) {
    $view = "Notícia cadastrada com sucesso";
    $news->saveCoverDefinitely($tmpCoverPath);
}else {
    $view = "Ocorreu um erro ao cadastrar sua notícia";
}


echo $twig->renderTemplate($view, $view, [
    "news-card.css",
    "news-main.css"
], 2);