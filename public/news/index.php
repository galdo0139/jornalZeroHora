<?php
namespace App;

use App\Config\Database;
use App\Config\TwigConfig;
use App\News;

include '../../app/config/config.php';

$db = new Database();
$news = new News($db);
$newsList = $news->getNews("newsLink", $_GET['content']);
$authorName = $news->getAuthorName($newsList['newsAuthor']);
$isEdited = ($newsList['isEdited']) ? " - Editado": "";
$twig = new TwigConfig();
$twig = $twig->loader();





$view = $twig->render('news.html', [
    'newsTitle' => $newsList['newsTitle'],
    'description' => $newsList['newsDescription'],
    'author' => $authorName,
    'createdAt' => $news->getPublishedDate($newsList['createdAt']),
    'isEdited' => $isEdited,
    'article' => $newsList['newsContent']
]);

echo $twig->render('template.html', [
    'title' => 'Jornal Zero Hora',
    'content' => $view,
    'style' => '<link rel="stylesheet" href="../css/news-card.css">
                <link rel="stylesheet" href="../css/news-main.css">',
    'home' =>  '../',
]);


