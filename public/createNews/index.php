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
    $_POST['title'],
    $_POST['subtitle'],
    $_POST['writeContent'],
    1,
    date("Y-m-d H:i:s"),
    $_POST['link']
];

$fields = [
    'newsTitle',
    'newsDescription',
    'newsContent',
    'newsAuthor',
    'created_at',
    'newsLink'
];

$isCreated = $news->createNews($fields, $data);


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
