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
    'newsLink' => $_POST['link'],
    'isEdited' => 1
];

$id = $_GET['id'];
$isCreated = $news->editNews($data, $id);

$view = "Notícia editada com sucesso";
if (!$isCreated) {
    $view = "Ocorreu um erro ao cadastrar sua notícia";
}

echo $twig->renderTemplate('Editar Notícia', $view, [
    "../css/news-card.css",
    "../css/news-main.css"
]);