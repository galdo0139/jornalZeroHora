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
$newsList = $news->getNewsList();



$id = $_GET['id']; //filtrar esse input
$result = $news->deleteNews($id);


if($result == 1){
    $success = "success" ;
    $session->setErrorMessage("Notícia deletada com sucesso");
}else {
    $success = "failed" ;
    $session->setErrorMessage("Erro ao deletar notícia");
}


header("location: ../../newsList/?deleteResult=$success");

