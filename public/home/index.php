<?php
namespace App;

use App\Config\Database;
use App\Config\SessionHandler;
use App\Config\TwigConfig;
use App\News;

include '../../app/config/config.php';


$session = new SessionHandler();
$db = new Database();
$news = new News($db);
$newsList = $news->getNewsList();
$twig = new TwigConfig();




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


echo $twig->renderTemplate('Jornal Zero Hora', $view, ["../css/news-card.css"]);

