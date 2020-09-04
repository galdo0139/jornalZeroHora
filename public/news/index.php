<?php
namespace App;

use App\Library\Database;
use App\Library\SessionHandler;
use App\Library\TwigConfig;
use App\Models\News;

include '../../app/config/autoloader.php';

$session = new SessionHandler();
$news = new News($db);
$newsList = $news->getNews("newsLink", $_GET['content']);
$authorName = $news->getAuthorName($newsList['newsAuthor']);
$isEdited = ($newsList['isEdited']) ? " - Editado": "";






$view = $twig->render('news.html', [
    'newsTitle' => $newsList['newsTitle'],
    'description' => $newsList['newsDescription'],
    'author' => $authorName,
    'createdAt' => $news->getPublishedDate($newsList['createdAt']),
    'isEdited' => $isEdited,
    'article' => $newsList['newsContent']
]);




echo $twig->renderTemplate($newsList['newsTitle'], $view, [
    "news-card.css",
    "news-main.css"
]);


