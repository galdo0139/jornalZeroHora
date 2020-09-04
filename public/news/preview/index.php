<?php
namespace App;

use App\Library\Database;
use App\Library\SessionHandler;
use App\Library\TwigConfig;
use App\Models\News;

include '../../../app/config/autoloader.php';

$session = new SessionHandler();
$news = new News($db);
$session->Authorize();


$newsLink = $_POST['link'];
$newsTitle = $_POST['title'];
$newsDescription = $_POST['subtitle'];
// $authorName = $_POST[]newsLink
$newsContent = $_POST['writeContent'];








$action = (isset($_GET['id'])) ? "editNews/?id={$_GET['id']}" : "createNews/" ;



$coverPath = $news->SaveTemporaryCoverImage();



$previewControlls = $twig->render('previewControlls.html', [
    'action' => "$action",
    'newsLink' => $newsLink,
    'newsTitle' => $newsTitle,
    'newsSubtitle' => $newsDescription,
    'newsContent' => $newsContent,
    'cover' => $coverPath
]);


$previewCard = $twig->render('card.html', [
    'newstitle' => $newsTitle,
    'description' => $newsDescription,
    'coverSrc' => $coverPath,
    'coverAlt' => 'a'
]);


$view = $twig->render('news.html', [
    'preview' => $previewControlls,
    'newsTitle' => $newsTitle,
    'description' => $newsDescription,
    'author' => "Preview",
    'createdAt' => date("d/m/Y - H:i"),
    'article' => $newsContent,
    'previewCard' => $previewCard
]);





echo $twig->renderTemplate('Pré-visualizar notícia', $view, [
    "news-main.css",
    "news-card.css"
],2);

