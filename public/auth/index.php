<?php
namespace App;

use App\Config\Database;
use App\Config\SessionHandler;
use App\Config\TwigConfig;
use App\News;


include '../../app/config/config.php';


$session = new SessionHandler();
$db = new Database();
$user = new User($db);
$result = $user->authenticate($_POST);


$_SESSION['data'] = $_POST;
$redirectTo = "login";

if ($result) {
    $_SESSION['logged'] = true;
    $redirectTo = "home";
}

header("location: ../$redirectTo");
