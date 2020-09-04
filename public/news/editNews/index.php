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
    'newsLink' => $_POST['link'],
    'isEdited' => 1,
    'newsCoverPath' => $_POST['cover'],
];

$tmpCoverPath = $_POST['cover'];


$id = $_GET['id'];

$newsData = $news->getNews('id', $id);
dd($newsData);
$successCreatingNews = $news->editNews($data, $id);

if ($successCreatingNews) {
    $view = "Notícia editada com sucesso";
    $news->saveCoverDefinitely($tmpCoverPath);
}else {
    $view = "Ocorreu um erro ao editar sua notícia";
}


echo $twig->renderTemplate($view , $view, [
    "news-card.css",
    "css/news-main.css"
], 2);