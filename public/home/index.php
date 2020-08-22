<?php
namespace App;

use App\Config\Database;
use App\Config\TwigConfig;
use App\News;

include '../../app/config/config.php';



$db = new Database();
$news = new News($db);
$newsList = $news->getNewsList();
$twig = new TwigConfig();
$twig = $twig->loader();



$view = "";
foreach ($newsList as $item) {
    $view .= $twig->render('home.html', [
        'newstitle' => $item['newsTitle'],
        'description' => $item['newsDescription'],
        'newsLink' => '../news/?content='.$item['newsLink'],
        'coverSrc' => 'a',
        'coverAlt' => 'a'
    ]);
}
echo $twig->render('template.html', [
    'title' => 'Jornal Zero Hora',
    'content' => $view,
    'style' => '<link rel="stylesheet" href="../css/news-card.css">',
    'home' =>  '../',    
]);

