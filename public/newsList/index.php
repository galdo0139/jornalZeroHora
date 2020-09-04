<?php
namespace App;

use App\Library\Database;
use App\Library\SessionHandler;
use App\Library\TwigConfig;
use App\Models\News;

include '../../app/config/autoloader.php';


$session = new SessionHandler();
$news = new News($db);
$session->Authorize();

$newsList = $news->getNewsList();

$message = "";
if (isset($_GET['deleteResult']) && $_GET['deleteResult'] == "success") {
    $message = $session->getErrorMessage();
    $session->setErrorMessage("");
}




$view = "";
foreach ($newsList as $item) {
    $author = $news->getAuthorName($item['newsAuthor']);
    $view .= $twig->render('newsList.html', 
    [
        'message' => $message,
        'newstitle' => $item['newsTitle'],
        'description' => $item['newsDescription'],
        'newsLink' => '../news/?content='.$item['newsLink'],
        'author' => $author,
        'created_at' => $news->getPublishedDate($item['createdAt']),
        'coverSrc' => 'a',
        'coverAlt' => 'a',
        'edit' => '../news/escrever/?id='.$item['newsId'],
        'delete' => '../news/delete/?id='.$item['newsId']
    ]);
}

$view .= $twig->render('warning.html');



echo $twig->renderTemplate('Minhas Notícias', $view, [
    "news-list.css"
]);