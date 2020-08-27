<?php
namespace App;

use App\Config\Database;
use App\Config\SessionHandler;
use App\Config\TwigConfig;

include '../../app/config/config.php';


$session = new SessionHandler();
$db = new Database();
$twig = new TwigConfig();




$view = "";


echo $twig->renderTemplate($_SESSION['message'], $_SESSION['message'], ["../css/news-card.css"]);
$_SESSION['message'] = "";