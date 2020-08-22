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



if(isset($_GET['id'])){
    $id = $_GET['id']; //filtrar esse input
    $editNews = $news->getNews("newsId", $id);
    if($editNews != false) {
        $view = $twig->render('escrever.html', [
            'link' => $editNews['newsLink'],
            'title' => $editNews['newsTitle'],
            'subtitle' => $editNews['newsDescription'],
            'write' => $editNews['newsContent'] 
        ]);
    }else{
        $erro = "Notícia não encontrada";
    }
}
if(!isset($view)){
    $view = $twig->render('escrever.html');
}



echo $twig->render('template.html', [
    'title' => 'Jornal Zero Hora',
    'content' => $view,
    'style' => '<link rel="stylesheet" href="../css/news-write.css">',
    'home' => '../',
    'newsLink' => 'a',
    'coverSrc' => 'a',
    'coverAlt' => 'a'
]);
