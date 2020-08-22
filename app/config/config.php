<?php


header("Content-type: text/html; charset=utf-8");
date_default_timezone_set('America/Sao_Paulo');


include __DIR__ . '/../lib/Database.php';

include __DIR__ .'/../lib/TwigConfig.php';
include __DIR__ .'/../../vendor/autoload.php';
include __DIR__ .'/../models/News.php';