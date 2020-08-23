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



$newsLink = $_POST['link'];
$newsTitle = $_POST['title'];
$newsDescription = $_POST['subtitle'];
// $authorName = $_POST[]newsLink
$newsContent = $_POST['writeContent'];





$action = (isset($_GET['id'])) ? "editNews" : "createNews" ;
$preview = $twig->render('previewControlls.html', [
    'action' => "$action",
    'newsLink' => $newsLink,
    'newsTitle' => $newsTitle,
    'newsSubtitle' => $newsDescription,
    'newsContent' => $newsContent
]);


$view = $twig->render('news.html', [
    'preview' => $preview,
    'newstitle' => $newsTitle,
    'description' => $newsDescription,
    'author' => "Preview",
    'created_at' => date("d/m/Y - H:i"),
    'article' => $newsContent
]);
echo $twig->render('template.html', [
    'title' => 'Jornal Zero Hora',
    'content' => $view,
    'style' => '<link rel="stylesheet" href="../css/news-card.css">
                <link rel="stylesheet" href="../css/news-main.css">',
    'home' =>  '../',
]);