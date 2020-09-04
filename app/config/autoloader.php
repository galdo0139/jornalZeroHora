<?php

use App\Library\Database;
use App\Library\TwigConfig;

header("Content-type: text/html; charset=utf-8");
date_default_timezone_set('America/Sao_Paulo');

include __DIR__ .'/../../vendor/autoload.php';


$db = new Database();
$twig = new TwigConfig();

function dd($var)
{
    var_dump($var);
    die();
}


