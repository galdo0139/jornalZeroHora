<?php
namespace App;

use App\Config\Database;
use App\Config\TwigConfig;
use App\News;

include '../../app/config/config.php';

$db = new Database();
$news = new News($db);
$newsList = $news->getNews("newsLink", $_GET['content']);
$author = $news->getAuthorName($newsList['newsAuthor']);
$twig = new TwigConfig();
$twig = $twig->loader();





$view = $twig->render('news.html', [
    'newstitle' => $newsList['newsTitle'],
    'description' => $newsList['newsDescription'],
    'author' => $author,
    'created_at' => $news->getPublishedDate($newsList['created_at']),
    'article' => $newsList['newsContent']
]);

echo $twig->render('template.html', [
    'title' => 'Jornal Zero Hora',
    'content' => $view,
    'style' => '<link rel="stylesheet" href="../css/news-card.css">
                <link rel="stylesheet" href="../css/news-main.css">',
    'home' =>  '../',
]);


