<?php
namespace App;

use App\Config\Database;
use App\Config\TwigConfig;
use App\News;

include '../../app/config/config.php';


$db = new Database();
$news = new News($db);
$twig = new TwigConfig();
$twig = $twig->loader();

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

echo $twig->render('template.html', [
    'title' => 'Jornal Zero Hora',
    'content' => $view,
    'style' => '<link rel="stylesheet" href="../css/news-card.css">
                <link rel="stylesheet" href="../css/news-main.css">',
    'home' =>  '../',
]);
