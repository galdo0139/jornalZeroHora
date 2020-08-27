<?php
namespace App;

use App\Config\Database;
use App\Config\SessionHandler;
use App\Config\TwigConfig;
use App\News;

include '../../app/config/config.php';

$db = new Database();
$session = new SessionHandler();
$news = new News($db);
$twig = new TwigConfig();
$session->Authorize();


$newsLink = $_POST['link'];
$newsTitle = $_POST['title'];
$newsDescription = $_POST['subtitle'];
// $authorName = $_POST[]newsLink
$newsContent = $_POST['writeContent'];





$action = (isset($_GET['id'])) ? "editNews/?id={$_GET['id']}" : "createNews/" ;
$preview = $twig->render('previewControlls.html', [
    'action' => "$action",
    'newsLink' => $newsLink,
    'newsTitle' => $newsTitle,
    'newsSubtitle' => $newsDescription,
    'newsContent' => $newsContent
]);


$view = $twig->render('news.html', [
    'preview' => $preview,
    'newsTitle' => $newsTitle,
    'description' => $newsDescription,
    'author' => "Preview",
    'createdAt' => date("d/m/Y - H:i"),
    'article' => $newsContent
]);



echo $twig->renderTemplate('Pré-visualizar notícia', $view, [
    "../css/news-main.css"
]);

