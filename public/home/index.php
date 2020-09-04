<?php
namespace App;

use App\Library\Database;
use App\Library\SessionHandler;
use App\Library\TwigConfig;
use App\Models\News;

include '../../app/config/autoloader.php';

$session = new SessionHandler();
$news = new News($db);
$newsList = $news->getNewsList();




$view = "";
foreach ($newsList as $item) {
    $view .= $twig->render('card.html', [
        'newstitle' => $item['newsTitle'],
        'description' => $item['newsDescription'],
        'newsLink' => '../news/?content='.$item['newsLink'],
        'coverSrc' => substr($item['newsCoverPath'],3),
        'coverAlt' => 'a'
    ]);
}


echo $twig->renderTemplate('Jornal Zero Hora', $view, [
    "news-card.css",
    "home.css"    
]);

