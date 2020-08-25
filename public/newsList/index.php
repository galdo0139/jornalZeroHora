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


$newsList = $news->getNewsList();





$view = "";
foreach ($newsList as $item) {
    $author = $news->getAuthorName($item['newsAuthor']);
    
    

    $view .= $twig->render('newsList.html', [
        'newstitle' => $item['newsTitle'],
        'description' => $item['newsDescription'],
        'newsLink' => '../news/?content='.$item['newsLink'],
        'author' => $author,
        'created_at' => $news->getPublishedDate($item['createdAt']),
        'coverSrc' => 'a',
        'coverAlt' => 'a',
        'edit' => '../escrever/?id='.$item['newsId'],
        'delete' => '../delete/?id='.$item['newsId']
    ]);
}

$view .= $twig->render('warning.html');
echo $twig->render('template.html', [
    'title' => 'Jornal Zero Hora',
    'content' => $view,
    'style' => '<link rel="stylesheet" href="../css/news-list.css">',
    'home' =>  '../',    
]);