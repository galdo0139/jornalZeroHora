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



if(isset($_GET['id'])){
    $id = $_GET['id']; //filtrar esse input
    $editingNews = $news->getNews("newsId", $id);
    $viewTitle = "Editar Notícia";
    if($editingNews != false) {
        $view = $twig->render('escrever.html', [
            'id' => "?id=$id",
            'link' => $editingNews['newsLink'],
            'title' => $editingNews['newsTitle'],
            'subtitle' => $editingNews['newsDescription'],
            'write' => $editingNews['newsContent'] 
        ]);
    }else{
        $erro = "Notícia não encontrada";
    }
}

if(!isset($view)){
    $view = $twig->render('escrever.html');
    $viewTitle = "Escrever Notícia";
}


echo $twig->renderTemplate($viewTitle, $view, [
    "../css/news-write.css",
    "../css/news-main.css"
]);
