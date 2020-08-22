<?php
namespace App;

use App\Config\Database;
use App\Config\TwigConfig;
use App\News;

include '../../app/config/config.php';



$db = new Database();
$news = new News($db);
$newsList = $news->getNewsList();


$id = $_GET['id']; //filtrar esse input
$result = $news->deleteNews($id);

$success = ($result == 1) ? "success" : "failed" ;
header("location: ../newsList/?deleteResult=$success");

