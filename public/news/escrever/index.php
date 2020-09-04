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
    "news-write.css",
    "news-main.css"
], 2);
