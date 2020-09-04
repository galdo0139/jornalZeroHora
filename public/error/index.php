<?php
namespace App;

use App\Library\Database;
use App\Library\SessionHandler;
use App\Library\TwigConfig;

include '../../app/config/autoloader.php';


$session = new SessionHandler();



$view = "";


echo $twig->renderTemplate($_SESSION['message'], $_SESSION['message'], ["../css/news-card.css"]);
$_SESSION['message'] = "";